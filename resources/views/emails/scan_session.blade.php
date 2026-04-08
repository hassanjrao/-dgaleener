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
                Client Name:
            </td>
            <td>
                {{ $scan_session->client->name }}
            </td>
        </tr>
        <tr>
            <td>
                Scan Type:
            </td>
            <td>
                {{ ucwords(str_replace('_', ' ', $scan_session->scan_type)) }}
            </td>
        </tr>
        <tr>
            <td>
                Date Started:
            </td>
            <td>
                {{ $scan_session->date_started }}
            </td>
        </tr>
        <tr>
            <td>
                Date Ended:
            </td>
            <td>
                {{ $scan_session->date_ended ?? '-' }}
            </td>
        </tr>
    </table>
@endsection
