@extends('layouts.app_public')

@section('content')
<div class="home-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 section-title"><br>
                <h2>News Product</h2>
            </div>
            @foreach ($newsProducts as $newsProduct)
            <div class="col-xs-6 col-sm-4 col-md-3 product-container">
                 <div class="product">
                    <div class="img-container">
                        <a href="{{ url($newsProduct->url) }}">
                            <img src="{{asset('storage/'.$newsProduct->image)}}" alt="{{$newsProduct->name}}">
                        </a>
                    </div>
                    <a href="{{ url($newsProduct->url) }}">
                        <h1>{{$newsProduct->name}}</h1>
                    </a>
                    <span class="price">{{$newsProduct->price}}</span>
                    @php
                    if($newsProduct->link_to != null) {
                    @endphp
                    <a href="{{url($newsProduct->url)}}" class="buy-now" title="{{$newsProduct->name}}">{{__('public_pages.buy')}}</a>
                    @php
                    } else {
                    @endphp
                    <a href="javascript:void(0);" data-product-id="{{$newsProduct->id}}" class="buy-now to-cart">{{__('public_pages.buy')}}</a>
                    @php
                    }
                    @endphp
                </div>
            </div>
            @endforeach
        </div> 
    </div>
</div>
@endsection
