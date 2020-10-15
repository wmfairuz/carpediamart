<?php

namespace App\Http\Controllers;

use App\Mail\OrderSuccess;
use App\Payment;
use App\Product;
use App\Services\FeeService;
use Billplz\Laravel\Billplz;
use Billplz\PaymentCompletion;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
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

        $this->cart->condition(new CartCondition([
            'name' => 'Refundable Deposit',
            'type' => 'deposit',
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $this->feeService->getDeposit($this->cart->getSubTotalWithoutConditions()),
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

    public function checkout(Request $request){
        $uuid = $this->setCart();
        $items = $this->cart->getContent();
        $subtotal = $this->cart->getSubTotal();
        $total = $this->cart->getTotal();
        $quantity = $this->cart->getTotalQuantity();
        $conditions = $this->cart->getConditions();
        $user = auth()->user();

        if($items->count() == 0) {
            flash()->overlay('No item in the cart', 'Carpedia Mart');
            return redirect()->route('orders.create');
        }

        return view('orders.checkout', compact('items', 'subtotal', 'total', 'quantity', 'conditions', 'user'));
    }

    public function payment(Request $request){
        $uuid = $this->setCart();
        $items = $this->cart->getContent();
        $subtotal = $this->cart->getSubTotal();
        $total = $this->cart->getTotal();
        $quantity = $this->cart->getTotalQuantity();
        $conditions = $this->cart->getConditions();

        $user = auth()->user();
        $name = $user->name;
        $email = $user->email;
        $phone = $user->phone;
        $is_production = config('services.billplz.sandbox') ? 0 : 1;
        $collection_id = config('services.billplz.collection');
        $description = config('services.billplz.description');
        $amount = \Duit\MYR::given($total * 100);
        $paymentCompletion = new PaymentCompletion(config('services.billplz.callback_url'), config('services.billplz.redirect_url'));

        $bill_resource = Billplz::bill();
        $bill_o = $bill_resource->create($collection_id, $email, $phone, $name, $amount, $paymentCompletion, $description);

        if ($bill_o) {
            \Log::info('Bill successfully created');
            $bill = $bill_o->toArray();

            $payment = [
                'name' => $bill["name"],
                'email' => $bill["email"],
                'mobile' => $bill["mobile"],
                'user_uuid' => $uuid,
                'bill_id' => $bill["id"],
                'collection_id' => $bill["collection_id"],
                'paid' => $bill["paid"],
                'state' => $bill["state"],
                'amount' => $bill["amount"] ? $bill["amount"]->getAmount() : 0,
                'paid_amount' => $bill["paid_amount"] ? $bill["paid_amount"]->getAmount() : 0,
                'due_at' => $bill["due_at"],
                'url' => $bill["url"],
                'redirect_url' => $bill["redirect_url"],
                'callback_url' => $bill["callback_url"],
                'description' => $bill["description"],
                'reference_1_label' => $bill["reference_1_label"],
                'reference_2_label' => $bill["reference_2_label"],
                'reference_1' => $bill["reference_1"],
                'reference_2' => $bill["reference_2"],
                'is_production' => $is_production
            ];

            \Log::info($payment);
            Payment::create($payment);

            return Redirect::to($bill["url"]);
        } else {
            \Log::info('Bill creation failed');
            \Log::info($uuid);
            \Log::info($name);
            \Log::info($email);
            \Log::info($phone);

            return view('landing');
        }
    }

    public function redirect(Request $request){
        \Log::info('redirect');
        \Log::info($request->all());

//        $bill_resource = Billplz::bill();
//        $data = $bill_resource->redirect($_GET);
//        \Log::info('>>>>>> redirect');
//        \Log::info($data);

        $host = parse_url(request()->headers->get('referer'), PHP_URL_HOST);

        \Log::info(request()->headers->get('referer'));

        $data = $request->all();
        $billplz = $data['billplz'];

        $payment = Payment::whereBillId($billplz['id'])->first();

        if ($payment) {
            if (!$payment->paid) {
                $payment->paid = $billplz['paid'] == 'true' ? 1 : 0;
                $payment->paid_at = $billplz['paid_at'] ? Carbon::parse($billplz['paid_at']) : null;
                $payment->x_signature = $billplz['x_signature'];
                $payment->save();

                $uuid = $this->setCart();
                $this->cart->clearCartConditions();
                $this->cart->clear();

                if ($payment->paid) {
                    Mail::to($payment->email)->send(new OrderSuccess($payment));
                    flash()->overlay('Order successful. Your order details will be sent to your email address.', 'Carpedia Mart');
                } else {
                    flash()->overlay('Payment failed. Please use different payment option and try again.', 'Carpedia Mart');
                }
            } else {
                Mail::to($payment->email)->send(new OrderSuccess($payment));
                flash()->overlay('Order successful. Your order details will be sent to your email address.', 'Carpedia Mart');
            }
        } else {
            flash()->overlay('No order found', 'Carpedia Mart');
        }

        return redirect()->route('landing');
    }

    public function webhook(Request $request){
        \Log::info('webhook');
        \Log::info($request->all());

//        $bill_resource = Billplz::bill();
//        $data = $bill_resource->webhook($_POST);
//        \Log::info('>>>>>> webhook');
//        \Log::info($data);

        $data = $request->all();
        $payment = Payment::whereBillId($data['id'])->first();

        if ($payment) {
            if (!$payment->paid && $data['paid'] == 'true') {
                $payment->collection_id = $data['collection_id'];
                $payment->paid = $data['paid'] == 'true' ? 1 : 0;
                $payment->state = $data['state'];
                $payment->amount = $data['amount'];
                $payment->paid_amount = $data['paid_amount'];
                $payment->due_at = $data['due_at'];
                $payment->url = $data['url'];
                $payment->paid_at = $data['paid_at'] ? Carbon::parse($data['paid_at']) : null;
                $payment->x_signature = $data['x_signature'];
                $payment->save();
            }
        }
    }
}
