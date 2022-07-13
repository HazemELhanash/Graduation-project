<head>
    <link rel="stylesheet" href="../assets/css/crash.css">
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>



@extends('layout')

@section('content')
    @include('sweetalert::alert')

    <div class="contact__container grid" style="padding-top: 100px">


        <form action="{{ route('orders.index') }}" method="GET" class="contact__form ">
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

        <form action="{{ route('orders.create') }}" class="contact__form o">
            <div class="form group row mt-2  ">
                <div >
                <button class="btn btn-danger mr-3 mb-1 ">
                    Create new order
                    <i class="ri-arrow-right-up-line button__icon"></i>
                </button></div>
                <div>
                <a class=" btn btn-danger y  mr-3 pb-2" href="{{ route('orders.trash') }}" role="button">
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
            <h2 class="card-title" style="font-size:30px; font-weight:bold"> All Orders </h2>
        </div>


        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 1%;">ID</th>
                        <th>Nawloon</th>
                        <th>Nawloon value</th>
                        <th>Quantity</th>
                        <th>Driver money</th>
                        <th>Creator name</th>
                        <th>Created at</th>
                        <th>Updated at at</th>
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
                            <td>{{ $d->nawloon }}</td>
                            <td>{{ $d->nawloon_value }}</td>
                            <td>{{ $d->quantity }}</td>
                            <td>{{ $d->driver_money }}</td>
                            <td>{{ $d->user->name }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>{{ $d->updated_at }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('orders.show', $d->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                      </svg>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{ route('orders.edit', $d->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                      </svg>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="{{ route('soft.delete5', $d->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                      </svg>

                                    Delete
                                </a>
                                {{-- <form action="{{ route('orders.destroy', $d->id) }}" method="POST">
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
                        <th>Nawloon</th>
                        <th>Nawloon value</th>
                        <th>Quantity</th>
                        <th>Driver money</th>
                        <th>Creator name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
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








