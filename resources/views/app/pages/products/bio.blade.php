@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Magnets'}}
@stop
@section('styles')
    @parent

    <link href="{{ asset('css/app/products.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => ''])
    <div class="row products-body">
        <div class="col-md-12 col-lg-4 product-text" style="padding: 0;">
            <div class="text-center " style="vertical-align: center; height: auto; margin: 20px; position: relative; padding: 20px;">
                <div>
                    <span>Anew Avenue Biomagnestim Magnets</span><br />
                    <span>Made with pure italian leather</span><br />
                    <span>Neodymium magnets</span><br />
                    <span>Multi layered colored</span><br />
                </div>
            </div>
            <div class="text-center " style="height: auto; padding: 20px;">
                <div class="" style="height: 100%;">
                    <span style="font-size: 28px;">Magnets and Price</span><br />
                    <div class="product-detail">
                        <form name="checkout" action="{{ route('app.products.checkoutWithShipping') }}" method="POST">
                            @csrf
                            @foreach(\App\Models\Product::orderBy('unit_price', 'desc')->where('category', '=', 'bio')->get() as $index=>$product)
                                <table>
                                    <tr>
                                        <td>
                                            @if ($index == 0)
                                                <input style="width: 40px;" type="radio" name="product_id" value="{{$product->id}}" checked="true" ng-disabled="{{ empty(Auth::user()) ? 'true' : 'false' }}">
                                            @else
                                                <input style="width: 40px;" type="radio" name="product_id" value="{{$product->id}}" ng-disabled="{{ empty(Auth::user()) ? 'true' : 'false' }}">
                                            @endif
                                        </td>
                                        <td>
                                            <span>{{$product->size}} - {{$product->name}} - ${{$product->unit_price}}</span>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                            <br />
                            <span>Quantity</span>
                            <input type="number" name="quantity" min="1" max="" value="1" ng-disabled="{{ empty(Auth::user()) ? 'true' : 'false' }}" style="width: 50px; margin: 0 8px;">
                            <p style="margin: 20px;">
                                Note: "This price excludes shipping. For shipping charges, we will send you an email."
                            </p>
                            @if (empty(Auth::user()))
                                <h4>You need to login first, <br> click <a href="/login">here</a> to login</h4>
                            @else
                                <button type="submit"></button>
                            @endif
                        </form>
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 products-bg" >
            <img src="{{ asset('images/products/magnets.png') }}" alt="{{ env('APP_TITLE') }}" style="width: 100%; transform: translateY(25%);">
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
