<head>
    <link rel="stylesheet" href="../assets/css/crash.css">
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
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

        <form action="{{ route('shipments.create') }}" class="contact__form o">

            <div class="form group row mt-2  ">

                <div>
                <a class=" btn btn-danger y  mr-3 pb-2" href="{{ route('shipments.trash') }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive"
                        viewBox="0 0 16 16">
                        <path
                            d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                    </svg>
                    Archives </a></div></div>



        </form>
    </div>

    <div class="card" style="padding-top: 10px;">

        <div class="card-header">
            <h2 class="card-title" style="font-size:30px; font-weight:bold"> All Shipments </h2>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 1%;">ID</th>
                        <th>مكان التحميل</th>
                        <th>مكان التعتيق</th>
                        <th>القائم</th>
                        <th> الفارغ</th>
                        <th>الصافي</th>
                        <th>كود السيارة</th>
                        <th>كود المقطورة</th>
                        <th> اسم العميل</th>
                        <th> اسم السائق</th>
                        <th> عداد البداية</th>
                        <th> عداد النهاية</th>
                        <th> كيلوميتر/الرحلة</th>
                        <th> الوجهة </th>
                        <th> رقم البوليصة</th>
                        <th> الوارد</th>
                        <th> الضريبة</th>
                        <th> التاريخ</th>
                        <th> الطلبية</th>
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

                            @if ($d->customer== null)
                            <td>No customers yet</td>
                            @else
                            <td>{{ $d->customer->name }}</td>
                            @endif

                        @if ($d->driver == null)
                        <td>No drivers yet</td>
                        @else
                        <td>{{ $d->driver->name }}</td>
                        @endif







                            <td>{{ $d->counter_begin }}</td>
                            <td>{{ $d->counter_end }}</td>
                            <td>{{ $d->kilometers_per_trip }}</td>
                            <td>{{ $d->distnation }}</td>
                            <td>{{ $d->policy_number }}</td>
                            <td>{{ $d->incoming_value }}</td>
                            <td>{{ $d->taxes }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>
                                <a href="{{ route('orders.show', $d->order_id) }}">
                                    {{$d->order_id}}
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('shipments.show', $d->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                      </svg>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{ route('shipments.edit', $d->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                      </svg>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="{{ route('soft.delete4', $d->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                      </svg>
                                    Delete
                                </a>

                                {{-- <a class="btn btn-success btn-sm" href="{{ route('soft.delete4', $d->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                                        <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                                        <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                                      </svg>
                                    Add more
                                </a> --}}
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
                        <th>مكان التحميل</th>
                        <th>مكان التعتيق</th>
                        <th>القائم</th>
                        <th> الفارغ</th>
                        <th>الصافي</th>
                        <th>كود السيارة</th>
                        <th>كود المقطورة</th>
                        <th> اسم العميل</th>
                        <th> اسم السائق</th>
                        <th> عداد البداية</th>
                        <th> عداد النهاية</th>
                        <th> كيلوميتر/الرحلة</th>
                        <th> الوجهة </th>
                        <th> رقم البوليصة</th>
                        <th> الوارد</th>
                        <th> الضريبة</th>
                        <th> التاريخ</th>
                        <th> الطلبية</th>
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
