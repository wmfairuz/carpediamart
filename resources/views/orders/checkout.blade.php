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
                            <h3>Order Summary</h3>
                        </div>
                        <!-- /head -->
                        <div class="main row">
                            <div class="col-lg-6 col-sm-12" style="border-right: 1px solid #ededed;">
                                <h4>{{ $items->count() }} Items</h4>
                                <ul class="clearfix">
                                    @foreach ($items as $item)
                                        <li style="padding-bottom: 15px; border-bottom: 1px dotted #ededed;">
                                            {{ $item->quantity }} x {{ $item->name  }}<span>@ringgit($item->associatedModel->price)</span>
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
                                                <div class="col-2" style="text-align: right; color: forestgreen">@ringgit($item->associatedModel->price
                                                        * $item->quantity)</div>
                                            </div>
                                        </li>
                                    @endforeach
                                    @if (count($items) == 0)
                                        No items
                                    @endif
                                </ul>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <a class="btn_1 full-width mb_5" href="{{ route('orders.payment') }}">PLACE ORDER</a>
                                <h4 style="font-size: 1rem">Shipping & Billing</h4>
                                <div style="margin-bottom: 10px">
                                    <i class="icon_profile" style="color: forestgreen"></i> <span>{{ $user->name }}</span>
                                </div>
                                <div style="margin-bottom: 10px">
                                    <i class="icon_house" style="color: forestgreen"></i> <span>{{ $user->address }}</span>
                                </div>
                                <div style="margin-bottom: 10px">
                                    <i class="icon_phone" style="color: forestgreen"></i> <span>{{ $user->phone }}</span>
                                </div>
                                <div style="margin-bottom: 10px">
                                    <i class="icon_mail" style="color: forestgreen"></i> <span>{{ $user->email }}</span>
                                </div>
                                <h4 style="font-size: 1rem">Order Summary</h4>
                                <ul class="clearfix">
                                    <li>Estimated Subtotal ({{$items->count()}} Items)<span style="font-weight: bold">@ringgit($subtotal)</span></li>
                                    @foreach ($conditions as $condition)
                                        <li>{{ $condition->getName() }}<span style="font-weight: bold">@ringgit($condition->getValue())</span>
                                        </li>
                                    @endforeach
                                    <li class="total">Estimated Total<span>@ringgit($total)</span></li>
                                </ul>

                                <a class="btn_1 full-width mb_5" href="{{ route('orders.payment') }}">PLACE ORDER</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection