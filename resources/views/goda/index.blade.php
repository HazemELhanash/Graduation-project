<head>
    <link rel="stylesheet" href="../assets/css/crash.css">
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>



@extends('layout')

@section('content')
    @include('sweetalert::alert')

    <div class="contact__container grid" style="padding-top: 100px">


        <form action="{{ route('supervisors.index') }}" method="GET" class="contact__form ">
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



    </div>
    <div class="card" style="padding-top: 10px;">

        <div class="card-header">
            <h2 class="card-title" style="font-size:30px; font-weight:bold"> All Shipments </h2>
        </div>
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
                    <th>رقم الطلب</th>
                    <th> الوارد</th>
                    <th> الضريبة</th>
                    <th> التاريخ</th>
                    <th> A C T I O N S </th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp

                @foreach ($data as $d)
                    {{-- {{dd($d->driver->name)}} --}}
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
                        <td>{{ $d->order_id }}</td>
                        <td>{{ $d->incoming_value }}</td>
                        <td>{{ $d->taxes }}</td>
                        <td>{{ $d->created_at }}</td>
                        <td>

                            <a class="btn btn-primary btn-sm" href="{{ route('supervisors.show', $d->id) }}">
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
                                Create
                            </a>

                                <a class="btn btn-success btn-sm" href="{{ route('addMore', $d->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-plus" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                                      </svg>
                                    Add more
                                </a>
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
                    <th>رقم الطلب</th>
                    <th> الوارد</th>
                    <th> الضريبة</th>
                    <th> التاريخ</th>
                    <th> A C T I O N S </th>
                </tr>


            </tfoot>
            <div class="d-flex justify-content-left">
                {{ $data->links() }}
            </div>
        </table>
    </div>
@endsection
