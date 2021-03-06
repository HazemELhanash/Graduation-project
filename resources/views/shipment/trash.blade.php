<head>
    <link rel="stylesheet" href="{{ asset('assets/css/crash.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>



@extends('layout')

@section('content')
    @include('sweetalert::alert')

    <div class="contact__container grid" style="padding-top: 100px">


        <form action="{{ route('shipments.index') }}" method="GET" class="contact__form ">
            @csrf


            <div class="form group row m">
                <div class="col-md-5">
                <label style="font-size: 18px" for="date" class="col-form-label col-sm-5 mb-2 ">From Date :</label>
                <input type="date" class="form-control" value="{{ old('fromDate', $from) }}"
                id="fromDate" name="fromDate" required></div>
                <div class="col-md-5" >
                <label style="font-size: 18px"for="date" class="col-form-label col-sm-5 mb-2">To Date :</label>
                <input  type="date" class="form-control " id="toDate" value="{{ old('toDate', $to) }}"
                    name="toDate" required>
                </div>
                <div class=" col-md-2  mt-5 mb-4">
                <button type="submit" class=" btn btn-danger " name="search" title="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                    Search</button>
                    <br>
            </div>
            </div>

        </form>

        <form  class="contact__form o ">
            <div class="form group row mt-2  ">
           <a class=" btn btn-danger y   mb-1 pb-6 " href="{{ route('shipments.index') }}" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
        </svg>
                Previous Page </a></div>



        </form>
    </div>
    <div class="card" style="padding-top: 10px;">

        <div class="card-header">
            <h2 class="card-title" style="font-size:30px; font-weight:bold"> All Trashed Shipments </h2>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 1%;">ID</th>
                        <th>???????? ??????????????</th>
                        <th>???????? ??????????????</th>
                        <th>????????????</th>
                        <th> ????????????</th>
                        <th>????????????</th>
                        <th>?????? ??????????????</th>
                        <th>?????? ????????????????</th>
                        <th> ?????? ????????????</th>
                        <th> ?????? ????????????</th>
                        <th> ???????? ??????????????</th>
                        <th> ???????? ??????????????</th>
                        <th> ????????????????/????????????</th>
                        <th> ???????????? </th>
                        <th> ?????? ????????????????</th>
                        <th>?????? ??????????</th>
                        <th> ????????????</th>
                        <th> ??????????????</th>
                        <th> ??????????????</th>
                        {{-- <th> ??????????????</th> --}}
                        <th> A C T I O N S </th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp

                    @foreach ($data as $d)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $d->load_place }}</td>
                            <td>{{ $d->offload_place }}</td>
                            <td>{{ $d->elkaam }}</td>
                            <td>{{ $d->empty }}</td>
                            <td>{{ $d->rest }}</td>
                            @if ($d->driver == null)
                        <td>No drivers yet</td>
                        @else
                        <td>{{ $d->driver->name }}</td>
                        @endif

                        @if ($d->customer== null)
                        <td>No customers yet</td>
                        @else
                        <td>{{ $d->customer->name }}</td>
                        @endif

                        @if ($d->car== null)
                        <td>No cars yet</td>
                        @else
                        <td>{{ $d->car->car_code }}</td>
                        @endif

                        @if ($d->trunk== null)
                        <td>No truncks yet</td>
                        @else
                        <td>{{ $d->trunk->trunk_code }}</td>

                        @endif
                            <td>{{ $d->counter_begin }}</td>
                            <td>{{ $d->counter_end }}</td>
                            <td>{{ $d->kilometers_per_trip }}</td>
                            <td>{{ $d->distnation }}</td>
                            <td>{{ $d->policy_number }}</td>
                            <td>{{ $d->order_id }}</td>
                            <td>{{ $d->incoming_value }}</td>
                            <td>{{ $d->taxes }}</td>
                            <td>{{ $d->created_at }}</td>
                            {{-- <td>
                                <a href="{{ route('orders.show', $d->order->id) }}">
                                    {{ $d->order->nawloon }}
                                </a>
                            </td> --}}
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('shipment.back.from.trash', $d->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                                        <path
                                            d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                                    </svg>
                                    Restore
                                </a>
                                <a class="btn btn-info btn-sm" style="background-color: black"
                                    href="{{ route('shipment.delete.from.database', $d->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                    Delete
                                </a>
                                {{-- <form action="{{ route('shipments.destroy', $d->id) }}" method="POST">
                                    @csrf
                                    <!--  tO protect from attackers-->
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-info btn-sm"
                                        style="background-color:red; padding-top:5px;"> Delete </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th style="width: 1%;">ID</th>
                        <th>???????? ??????????????</th>
                        <th>???????? ??????????????</th>
                        <th>????????????</th>
                        <th> ????????????</th>
                        <th>????????????</th>
                        <th>?????? ??????????????</th>
                        <th>?????? ????????????????</th>
                        <th> ?????? ????????????</th>
                        <th> ?????? ????????????</th>
                        <th> ???????? ??????????????</th>
                        <th> ???????? ??????????????</th>
                        <th> ????????????????/????????????</th>
                        <th> ???????????? </th>
                        <th> ?????? ????????????????</th>
                        <th>?????? ??????????</th>
                        <th> ????????????</th>
                        <th> ??????????????</th>
                        <th> ??????????????</th>
                        {{-- <th> ??????????????</th> --}}
                        <th> A C T I O N S </th>
                    </tr>


                </tfoot>
                <div class="d-flex justify-content-left">
                    {{ $data->links() }}
                </div>
            </table>
        </div>
    </div>
@endsection
