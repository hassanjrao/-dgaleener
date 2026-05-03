@extends('layouts.application')
@section('page-title')
    {{ 'Anew Avenue Biomagnetism | Dr. Goiz Pairs' }}
@stop
@section('content')
    @include('partials.header', [
        'title' => 'Dr. Goiz Pairs',
        'image_url' => '/images/iconimages/humanicon48.png',
    ])

    <div class="container-fluid" style="padding: 0 20px 40px;">

        <div class="row justify-content-center" style="margin-bottom: 8px;">
            <div class="col-12 text-center"
                style="background: #f5c518; color: #333; font-weight: bold; padding: 8px 0; font-size: 14px; letter-spacing: 0.5px;">
                FREE Tier &nbsp;|&nbsp; Nivel Gratis
            </div>
        </div>

        <div class="row justify-content-center" style="margin-bottom: 16px;">
            <div class="col-12 text-center"
                style="background: #1a5276; color: #fff; font-weight: bold; padding: 8px 0; font-size: 14px; letter-spacing: 0.5px;">
                250 Classic Dr. Goiz Pairs &nbsp;|&nbsp; 250 Pares Clásicos del Dr. Goiz
            </div>
        </div>

        <div class="table-responsive">
            <table id="drGoizPairsTable" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Place / Lugar</th>
                        <th>Resonance / Resonancia</th>
                        <th>Name / Nombre</th>
                        <th>Characteristic / Característica</th>
                        <th>Description / Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pairs as $pair)
                        <tr>
                            <td>
                                {{ $pair->place }}
                                @if ($pair->place_es)
                                    <br><span class="text-muted"
                                        style="font-style: italic; font-size: 0.9em;">{{ $pair->place_es }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $pair->resonance }}
                                @if ($pair->resonance_es)
                                    <br><span class="text-muted"
                                        style="font-style: italic; font-size: 0.9em;">{{ $pair->resonance_es }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $pair->name }}
                                @if ($pair->name_es)
                                    <br><span class="text-muted"
                                        style="font-style: italic; font-size: 0.9em;">{{ $pair->name_es }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $pair->characteristic }}
                                @if ($pair->characteristic_es)
                                    <br><span class="text-muted"
                                        style="font-style: italic; font-size: 0.9em;">{{ $pair->characteristic_es }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $pair->description }}
                                @if ($pair->description_es)
                                    <br><span class="text-muted"
                                        style="font-style: italic; font-size: 0.9em;">{{ $pair->description_es }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            $('#drGoizPairsTable').DataTable({
                pageLength: 25,
                order: [
                    [2, 'asc']
                ],
                responsive: true
            });
        });
    </script>
@stop
