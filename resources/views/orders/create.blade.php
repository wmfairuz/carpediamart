@extends('layouts.foogra')

@push('styles')
    <link href="{{ asset('css/detail-page-delivery.css') }}" rel="stylesheet">
@endpush

@section('fb')
    @include('layouts.salesiq')
@endsection

@push('scripts')
    <script>
        document.getElementById("file").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("image").src = e.target.result;
                document.getElementById("image").classList.add('imgBorder');
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };
    </script>
@endpush

@section('content')
    <div class="bg_gray pattern margin_60_40">
        <div class="container margin_60_40">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="box_booking">
                        <div class="head">
                            <h3>Order</h3>
                        </div>
                        <!-- /head -->
                        <div class="main row">
                            <div class="col-lg-6 col-sm-12" style="border-right: 1px solid #ededed;">
                                <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <h6>Product / Brand</h6>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       placeholder="Product / Brand (eg Potatoes)"
                                                       name="name" id="name" required autofocus>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                 </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Description / Notes</h6>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control @error('notes') is-invalid @enderror"
                                                       placeholder="Description / Notes (eg Only big ones)"
                                                       name="notes" id="notes">
                                                @error('notes')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                 </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Quantity</h6>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="number"
                                                       class="form-control @error('quantity') is-invalid @enderror"
                                                       placeholder="Product quantity"
                                                       name="quantity" id="quantity" required>
                                                @error('quantity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                 </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Estimated Price</h6>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="number"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       placeholder="Estimated price for a piece"
                                                       name="price" id="price" step="0.01" required>
                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                 </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Photo</h6>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group file-upload">
                                                <div class="row">
                                                    <div class="col-6"><input id="file" type="file" name="file"
                                                                              accept="image/*"></div>
                                                    <div class="col-6"><img style="width: 100%" id="image"/></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn_1 full-width mb_5">Add to Cart</button>
                                </form>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div style="text-align: right" class="add_bottom_15">
                                    <a class="btn btn-sm btn-dark" href="{{ route('orders.clear') }}">Clear Cart</a>
                                </div>
                                <ul class="clearfix">
                                    @foreach ($items as $item)
                                        <li>
                                            <a href="{{ route('orders.remove', ['product' => $item->associatedModel->id]) }}"
                                               id="product-{{ $item->associatedModel->id }} }}">{{ $item->quantity }}
                                                x {{ $item->name  }}</a><span>@ringgit($item->associatedModel->price)</span>
                                            <div class="row add_top_5">
                                                <div class="col-2">
                                                    @if ($item->associatedModel->getFirstMediaUrl('images', 'thumb'))
                                                        <img class="imgBorder-small" style="width: 100%"
                                                             src="{{ $item->associatedModel->getFirstMediaUrl('images', 'thumb') }}"/>
                                                    @else
                                                        <img class="imgBorder-small" style="width: 100%"
                                                             src="{{ asset('img/grocery.jpeg') }}"/>
                                                    @endif
                                                </div>
                                                <div class="col-8"><small>{{ $item->associatedModel->notes }}</small>
                                                </div>
                                                <div class="col-2" style="text-align: right"><small>@ringgit($item->associatedModel->price
                                                        * $item->quantity)</small></div>
                                            </div>
                                        </li>
                                    @endforeach
                                    @if (count($items) == 0)
                                        No items
                                    @endif
                                </ul>

                                <ul class="clearfix">
                                    <li>Estimated Subtotal<span>@ringgit($subtotal)</span></li>
                                    @foreach ($conditions as $condition)
                                        <li>{{ $condition->getName() }}<span>@ringgit($condition->getValue())</span>
                                        </li>
                                    @endforeach
                                    <li class="total">Estimated Total<span>@ringgit($total)</span></li>
                                </ul>

                                <a href="" class="btn_1 full-width mb_5">Checkout</a>
                                <div class="text-center"><small>You will be asked for your delivery details in the next
                                        step</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection