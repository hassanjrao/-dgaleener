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
    {!! $content !!}
    <br>
    <br>
    <table>
        <tr>
            <td>
                Full Name:
            </td>
            <td>
                {{ $name }}
            </td>
        </tr>
        <tr>
            <td>
                Email Address:
            </td>
            <td>
                {{ $email }}
            </td>
        </tr>
        <tr>
            <td>
                Phone Number:
            </td>
            <td>
                {{ $phone_no ?? '(Not indicated)' }}
            </td>
        </tr>
    </table>
@endsection
