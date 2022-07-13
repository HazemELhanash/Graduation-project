<head>
    <link rel="stylesheet" href="{{asset('assets/css/crash.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
</head>






@extends('layout')

@section('content')
    @include('sweetalert::alert')

    <div class="card " style="padding-top: 10px;background_color:#BF000D;">

        <div class="steps__card " style="padding-top: 90px;">
            <h2 class="card-title" style="font-size:30px; font-weight:bold "> Driver Name :  {{$driver->name}} </h2>
            <br>
            <br>
            <h5  style="font-size:17px; font-weight:bold ;"> Number of rests => {{$driver->rests->count()}} Rest(s) </h5>


        </div>
        {{-- sha8li eli fo2 --}}
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 1%;">#</th>
                        <th style="width: 1%;">ID</th>
                        <th>Start Rest</th>
                        <th>End Rest</th>
                        <th>Trip Number</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp

                    @foreach ($driver->rests as $rest)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $rest->id }}</td>
                            <td>{{ $rest->start_at }}</td>
                            <td>{{ $rest->end_at }}</td>
                            <td>{{ $rest->shipment_number }}</td>
                        </tr>
                    @endforeach
                </tbody>


                <tfoot>

                    <tr>
                        <th style="width: 1%;">#</th>
                        <th style="width: 1%;">ID</th>
                        <th>Start Rest</th>
                        <th>End Rest</th>
                        <th>Trip Number</th>
                    </tr>

                </tfoot>
            </table>
        </div>



        <div class="card" style="padding-top: 10px;">

            <div class="card-header" style="padding-top: 90px;">
                <h2 class="card-title" style="font-size:30px; font-weight:bold"> Driver {{$driver->name}} /shipments </h2>
                <br>
                <br>
                <h5  style="font-size:17px; font-weight:bold"> Number of shipments => {{$driver->ships->count()}} shipment(s) </h5>
            </div>
            {{-- sha8li eli fo2 --}}
            <div class="card-body">
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 1%;">#</th>

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

                                <td>{{ $ship->start_at }}</td>
                                <td>{{ $ship->end_at }}</td>

                            </tr>
                        @endforeach
                    </tbody>


                    <tfoot>

                        <tr>
                            <th style="width: 1%;">#</th>

                            <th>Start Shipment</th>
                            <th>End Shipment</th>

                        </tr>

                    </tfoot>
                </table>
            </div>



            <div class="card" style="padding-top: 10px;">

                <div class="card-header" style="padding-top: 90px;">
                    <h2 class="card-title" style="font-size:30px; font-weight:bold"> Driver {{$driver->name}} /supplys </h2>
                    <br>
                    <br>
                    <h5  style="font-size:17px; font-weight:bold"> Number of supplys => {{$driver->supplys->count()}} supply(s) </h5>
                </div>
                {{-- sha8li eli fo2 --}}
                <div class="card-body">
                    <table id="example4" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%;">#</th>
                                <th style="width: 1%;">ID</th>
                                <th>Start Supply</th>
                                <th>End Supply</th>
                                <th>Trip Number</th>
                                <th>Supply's Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp

                            @foreach ($driver->supplys as $supply)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $supply->id }}</td>
                                    <td>{{ $supply->start_at }}</td>
                                    <td>{{ $supply->end_at }}</td>
                                    <td>{{ $supply->shipment_number }}</td>
                                    <td>
                                      <img src="{{asset('uploads/images/' . $supply->image_path)}}" alt="image" width="70px" height="70px">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                        <tfoot>

                            <tr>
                                <th style="width: 1%;">#</th>
                                <th style="width: 1%;">ID</th>
                                <th>Start Supply</th>
                                <th>End Supply</th>
                                <th>Trip Number</th>
                                <th>Supply's Cost</th>
                            </tr>

                        </tfoot>
                    </table>
                </div>


    @endsection

