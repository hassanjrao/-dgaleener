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
    Greetings. Kindly see your scan session details below.
    <br>
    <br>
    <table border="1">
        <tr>
            <td>
                Client Name:
            </td>
            <td>
                {{ $scanSession->client->name }}
            </td>
        </tr>
        <tr>
            <td>
                Scan Type:
            </td>
            <td>
                {{ ucwords(str_replace('_', ' ', $scanSession->scan_type)) }}
            </td>
        </tr>
        <tr>
            <td>
                Date Started:
            </td>
            <td>
                {{ $scanSession->date_started }}
            </td>
        </tr>
        <tr>
            <td>
                Session Type:
            </td>
            <td>
                {{ ucwords($scanSession->cost_type)}}
            </td>
        </tr>
        <tr>
            <td>
                Session Cost:
            </td>
            <td>
                ${{ number_format($scanSession->cost, 2) }}
            </td>
        </tr>
        @if (!empty($scanSession->date_ended))
        <tr>
            <td>
                Date Ended:
            </td>
            <td>
                {{ $scanSession->date_ended }}
            </td>
        </tr>
        @endif
    </table>
    <br>
    If you confirm the details above, you may now pay this scan session by clicking this <a href="{{ route('app.scanSessions.payment', ['id' => $scanSession->id]) }}">link</a>.
@endsection
