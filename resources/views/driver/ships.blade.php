<head>
    <link rel="stylesheet" href="{{asset('assets/css/crash.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
</head>



@extends('layout')

@section('content')
    @include('sweetalert::alert')

    <div class="card" style="padding-top: 10px;">

        <div class="card-header" style="padding-top: 90px;">
            <h2 class="card-title" style="font-size:30px; font-weight:bold"> Driver {{$driver->name}} /shipments </h2>
            <br>
            <br>
            <h5  style="font-size:17px; font-weight:bold"> Number of shipments {{$driver->ships->count()}} shipment(s) </h5>
        </div>
        {{-- sha8li eli fo2 --}}
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 1%;">#</th>
                        <th style="width: 1%;">ID</th>
                        <th>Start Shipment</th>
                        <th>End Shipment</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp

                    @foreach ($driver->ships as $ship)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $ship->id }}</td>
                            <td>{{ $ship->start_at }}</td>
                            <td>{{ $ship->end_at }}</td>
                        </tr>
                    @endforeach
                </tbody>


                <tfoot>

                    <tr>
                        <th style="width: 1%;">#</th>
                        <th style="width: 1%;">ID</th>
                        <th>Start Shipment</th>
                        <th>End Shipment</th>
                    </tr>

                </tfoot>
            </table>
        </div>
    @endsection

