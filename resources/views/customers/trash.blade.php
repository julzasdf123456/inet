@php
    use App\Models\Customers;
@endphp

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4>Trash | Deleted Customers</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
         @include('flash::message')

        @include('adminlte-templates::common.errors')

        <div class="card shadow-none">
            <div class="card-body table-responsive p-0">
               <table class="table table-sm table-hover">
                  <thead>
                     <th>Account No.</th>
                     <th>Customer Name</th>
                     <th>Address</th>
                     <th>Deleted At</th>
                     <th>Deleted By</th>
                     <th></th>
                  </thead>
                  <tbody>
                     @foreach ($data as $item)
                        <tr>
                           <td>{{ $item->id }}</td>
                           <td>{{ $item->FullName }}</td>
                           <td>{{ Customers::getAddress($item) }}</td>
                           <td>{{ date('M d, Y', strtotime($item->updated_at)) }}</td>
                           <td>{{ $item->name }}</td>
                           <td>
                              <a href="{{ route('customers.restore', [$item->id]) }}" class="btn btn-primary btn-sm float-right">Restore</a>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
        </div>
    </div>
@endsection
