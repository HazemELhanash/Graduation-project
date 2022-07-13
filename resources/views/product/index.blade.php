@extends("layout")

@section("content")

@include('sweetalert::alert')
<div class="contact__container grid" style="padding-top: 100px">
    <form action="{{route('products.create')}}" class="contact__form" style="padding-left: 10px;">

        <button class="button button--flex">
            Create new product
            <i class="ri-arrow-right-up-line button__icon"></i>
        </button>
    </form>

    <form action="{{ route('products.index') }}" method="GET" class="contact__form" style="padding-left: 10px;">
        @csrf
        <br>
        <div class="container">
            <div class="row">
                <div class="container-fluid">
                    <div class="form group row">
                        <label for="date" class="col-form-label co-sm-2">from:</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm" value="{{ old('fromDate', $from) }}"
                                id="fromDate" name="fromDate" required>
                        </div>
                    </div>
                    <div class="form group row">
                        <label for="date" class="col-form-label co-sm-2">to:</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm" id="toDate"
                                value="{{ old('toDate', $to) }}" name="toDate" required>
                        </div>
                    </div>
                    <div class="button button--flex">
                        <button type="submit" class="btn" name="search" title="Search">Search</button>
                    </div>
                </div>
            </div>

        </div>
</div>
<br>
</form>
</div>




<div class="card" style="padding-top: 10px;">
<div class="card-header">
<h3 class="card-title">Cars</h3>
</div>

<div class="card-body">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th style="width: 1%;">ID</th>
<th>Type</th>
<th>Option</th>
<th>Order ID</th>
<th>Created at</th>
<th>Updated at at</th>
<th> A C T I O N S </th>

</tr>
</thead>
<tbody>
    @php
        $i=0
    @endphp

 @foreach ($data as $d )
<tr>
<td>{{++$i}}</td>
<td>{{$d->type}}</td>
<td>{{$d->option}}</td>
<td>{{$d->order_id}}</td>
<td>{{$d->created_at}}</td>
<td>{{$d->updated_at}}</td>
<td>
    <a class="btn btn-primary btn-sm" href="{{route('products.show', $d->id)}}">
    <i class="fas fa-folder">
    </i>
    View
    </a>
    <a class="btn btn-info btn-sm" href="{{route('products.edit' , $d->id)}}">
    <i class="fas fa-pencil-alt">
    </i>
    Edit
    </a>
     <form action="{{route('products.destroy', $d->id)}}" method="POST">
                        @csrf <!--  tO protect from attackers-->
                        @method("DELETE")
                        <button type="submit" class="btn btn-info btn-sm" style="background-color:red; padding-top:5px;" > Delete </button>
                    </form>
</td>
</tr>

@endforeach
</tbody>

<tfoot>
<tr>
    <th style="width: 1%;">ID</th>
    <th>Type</th>
    <th>Option</th>
    <th>Order ID</th>
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

@endsection
