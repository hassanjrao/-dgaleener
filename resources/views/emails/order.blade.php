@extends('layouts.mailer')
@section('styles')
    @parent
    
    <style type="text/css">
        td {
            padding: 0 10px;
        }
    </style>
@stop
@section('content')
    Greetings {{ $order->user->name }}, 
    <br>
    <br>
    Here are the details for your order. You may pay your order by clicking <a href="{{ env('APP_URL').'/orders/'.$order->id.'/payment' }}">here</a>. Thank you choosing our products.
    <br>
    <br>
    <table border="1">
        <tr>
            <td>
                Product Name:
            </td>
            <td>
                {{ $order->description }}
            </td>
        </tr>
        <tr>
            <td>
                Price per unit:
            </td>
            <td>
                {{ '$'.number_format($order->product->unit_price, 2) }}
            </td>
        </tr>
        <tr>
            <td>
                Quantity:
            </td>
            <td>
                {{ $order->quantity }}
            </td>
        </tr>
        @if (!empty($order->shipping_service))
        <tr>
            <td>
                Shipping Service:
            </td>
            <td>
            {{ $order->shipping_service }}
            </td>
        </tr>
        @endif
        @if (!empty($order->shipping_day_set))
        <tr>
            <td>
                Shipping Duration:
            </td>
            <td>
            {{ $order->shipping_day_set }}
            </td>
        </tr>
        @endif
        @if (!empty($order->shipping_rate))
        <tr>
            <td>
                Shipping Fee:
            </td>
            <td>
            {{ '$'.number_format($order->shipping_rate, 2) }}
            </td>
        </tr>
        @endif
        <tr>
            <td>
                Total Cost:
            </td>
            <td>
                {{ '$'.number_format($order->cost(), 2) }}
            </td>
        </tr>
    </table>
    <br>
    Best Regards,
    <br>
    <br>
    Anew Team
@endsection
