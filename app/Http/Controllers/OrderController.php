<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\FeeService;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class OrderController extends Controller
{
    /**
     * @var FeeService
     */
    private $feeService;
    /**
     * @var Cart
     */
    private $cart;

    /**
     * OrderController constructor.
     * @param Cart $cart
     * @param FeeService $feeService
     * @throws \Exception
     */
    public function __construct(FeeService $feeService)
    {
        $this->feeService = $feeService;

//        session()->flush();
//        if(!session()->has('user_uuid')) {
//            \Log::info('Create new user_uuid');
//            $uuid = Uuid::uuid4()->toString();
//            if (Auth::check()) {
//                $uuid = Auth::user()->uuid;
//            }
//            session(['user_uuid' => $uuid]);
//            \Log::info(session('user_uuid'));
//        }
//
//        \Log::info('construct');
//        \Log::info(session('user_uuid'));
//        $this->cart = Cart::session(session('user_uuid'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $uuid = $this->setCart();
        $items = $this->cart->getContent();
        $subtotal = $this->cart->getSubTotal();
        $total = $this->cart->getTotal();
        $quantity = $this->cart->getTotalQuantity();
        $conditions = $this->cart->getConditions();

        return view('orders.create', compact('items', 'subtotal', 'total', 'quantity', 'conditions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $uuid = $this->setCart();

        \Log::info($request->all());

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'notes' => 'nullable|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price*100,
            'user_uuid' => $uuid,
            'notes' => $request->notes
        ]);

        if($request->hasFile('file') ){
            \Log::info('has file');
        }

        if($request->hasFile('file') && $request->file('file')->isValid()){
            $product->addMediaFromRequest('file')->toMediaCollection('images');
        }

        $this->cart->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => [],
            'associatedModel' => $product
        ]);

        $this->cart->clearCartConditions();
        $this->cart->condition(new CartCondition([
            'name' => 'Delivery Fee',
            'type' => 'shipping',
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $this->feeService->getDeliveryFee($this->cart->getSubTotalWithoutConditions()),
            'order' => 1
        ]));

        return redirect()->route('orders.create');
    }

    public function removeProductFromCart(Product $product)
    {
        $uuid = $this->setCart();
        $this->cart->remove($product->id);
        if($this->cart->getTotalQuantity() == 0) {
            $this->cart->clearCartConditions();
        }

        return redirect()->route('orders.create');
    }

    public function clearCart()
    {
        $uuid = $this->setCart();
        $this->cart->clearCartConditions();
        $this->cart->clear();

        return redirect()->route('orders.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function setCart()
    {
        if(!session()->has('user_uuid')) {
            if (Auth::check()) {
                session(['user_uuid' => Auth::user()->uuid]);
            } else {
                session(['user_uuid' => Uuid::uuid4()->toString()]);
            }
        }

        if(Auth::check() && session('user_uuid') != Auth::user()->uuid) {

        }

        $this->cart = Cart::session(session('user_uuid'));
        return session('user_uuid');
    }
}
