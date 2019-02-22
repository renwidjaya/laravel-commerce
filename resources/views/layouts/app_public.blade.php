<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <meta name="description" content="{{ $head_description }}"/>
        <meta property="og:title" content="{{ $head_title }}" />
        <meta property="og:description" content="{{ $head_description }}" />
        <meta property="og:url" content="{{urldecode(url()->current())}}" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="{{isset($product->image) ? asset('storage/'.$product->image) : asset('storage/ExtractiLogo.png')}}" />
        <title>{{ $head_title }}</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"/>
        <link href="{{ asset('css/public.css') }}" rel="stylesheet"/>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row top-part">
                    <div class="col-sm-3 col-md-3">
                        <a href="{{ url('/') }}" class="logo-container">
                            <img src="{{asset('storage/ExtractiLogo.png')}}" class="img-responsive logo" alt="{{ $head_title }}">
                        </a>
                    </div>
                    <div class="col-sm-3 col-md-4">
                        <form class="search" id="products-search" action="{{url('products')}}" method="GET">
                            <input type="text" name="find" class="search-field" value="{{ Request::get('find') }}" placeholder="{{__('public_pages.search')}}">
                            <a href="javascript:void(0);" class="submit-search" onclick=" document.getElementById('products-search').submit();">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                        </form>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <div class="user">
                            <a href="javascript:void(0);" class="cart-button">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
                                <span class="badge">{{!empty($cartProducts) ? count($cartProducts): 0}}</span>
                            </a>
                        </div>
                        <div class="cart-fast-view-container">
                            @php
                            $sum = 0;
                            if(!empty($cartProducts)) {
                            $sum = 0;
                            @endphp
                            <div class="cart-products-fast-view">
                                <div class="content">
                                    <a href="javascript:void(0);" class="close-me" onclick="closeFastCartView()">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                    <ul>
                                        @foreach($cartProducts as $cartProduct)
                                        @php
                                        $sum += $cartProduct->num_added * (int)$cartProduct->price;
                                        @endphp
                                        <li>
                                            <a href="{{url($cartProduct->url)}}" class="link">                                        
                                                <img src="{{asset('storage/'.$cartProduct->image)}}" alt="">
                                                <span class="name">{{$cartProduct->name}}</span>
                                                <span class="price">
                                                    {{$cartProduct->num_added}} x {{$cartProduct->price}}
                                                </span>
                                            </a>
                                            <a href="javascript:void(0);" class="removeQantity" onclick="removeQuantity({{$cartProduct->id}})">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>
                                            <div class="clearfix"></div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="pay-sum">
                                        <span class="text">{{__('public_pages.subtotal')}}</span>
                                        <span class="sum">{{$sum}}</span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <a href="{{url('checkout')}}" class="green-btn">{{__('public_pages.payment')}}</a>
                                </div>
                            </div>
                            @php
                            }
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-custom">
                <div class="container">
                    <button type="button" class="navbar-toggle collapsed show-right-menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    <a class="navbar-brand visible-xs" href="#">{{__('public_pages.menu')}}</a>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-center">
                            <li><a href="{{ url('products') }}">{{__('public_pages.products')}}</a></li>
                            <li><a href="{{ url('checkout') }}">{{__('public_pages.checkout')}}</a></li>
                            
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer>
            <div class="copy-rights">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            Copyright 2019 temanrendy.com
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <a class="fast-order-btn visible-xs">
            {{__('public_pages.fast_order')}}
        </a>
        <div class="backdrop"></div>
        <div class="right-menu">
            <ul>
                <li><a href="{{ url('products') }}">{{__('public_pages.products')}}</a></li>
                <li><a href="{{ url('checkout') }}">{{__('public_pages.checkout')}}</a></li>
                
            </ul>
            <a href="javascript:void(0);" class="close-xs-menu">{{__('public_pages.close_xs_menu')}}</a>
        </div> 
        <!-- Modal After buy now button -->
        <div class="modal fade" id="modalBuyBtn" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <h4>{{__('public_pages.success_add_to_cart')}}</h4>
                        <a href="{{url('checkout')}}" class="go-buy">{{__('public_pages.go_buy')}}</a>
                        <hr>
                        <div class="continue-shopping">
                            <a href="javascript:void(0);" data-dismiss="modal">
                                {{__('public_pages.continue_shopping')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('msg'))
        <div class="alert {{ session('result') === true ? "alert-success" : "alert-danger" }} alert-top">  
            @if (is_array(session('msg')))
            {!! implode('<br>',session('msg')) !!}
            @else
            {{session('msg')}}
            @endif
        </div>
        @endif
        <script>
            var urls = {
            addProduct: "{{ url('addProduct') }}",
                    removeProductQuantity: "{{ url('removeProductQuantity') }}",
                    getProducts: "{{ url('getGartProducts') }}",
                    getProductsForCheckoutPage: "{{ url('getProductsForCheckoutPage') }}",
                    removeProduct: "{{url('removeProduct')}}"
            };
            var variables = {
            addressReq: "{{__('public_pages.address_field_req')}}",
                    phoneReq: "{{__('public_pages.phone_field_req')}}",
                    productsReq: "{{__('public_pages.productsReq')}}"
            };
        </script>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/placeholders.min.js') }}"></script>
        <script src="{{ asset('js/public.js') }}"></script>
    </body>
</html>
