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
            <h2 class="card-title" style="font-size:30px; font-weight:bold"> Driver {{$driver->name}} /rests </h2>
            <br>
            <br>
            <h5  style="font-size:17px; font-weight:bold"> Number of rests {{$driver->rests->count()}} rest(s) </h5>
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
                        </tr>
                    @endforeach
                </tbody>


                <tfoot>

                    <tr>
                        <th style="width: 1%;">#</th>
                        <th style="width: 1%;">ID</th>
                        <th>Start Rest</th>
                        <th>End Rest</th>
                    </tr>

                </tfoot>
            </table>
        </div>
    @endsection

