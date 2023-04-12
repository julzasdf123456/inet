@php
    use App\Models\Customers;
@endphp
@extends('layouts.app')

@section('content')
<div class="row">
    <div class='col-lg-12 col-md-12'>
        <br>
        <h4 class="text-center display-5">Search Customer to Pay</h4>
        {{-- <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm float-right">Add New</a> --}}
        <br>
        <!-- SEARCH BAR -->
        <form action="{{ route('paymentTransactions.payments') }}" method="GET" class="row">
            <div class="col-md-8 offset-md-2">
                <div class="input-group">
                    
                    <input type="search" id='searchparam' name="param" class="form-control" placeholder="Type Name, Account Number, or Mac Address" autofocus value="{{ isset($_GET['param']) ? $_GET['param'] : '' }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default" id="searchBtn">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>    
    
    <div class="col-lg-12" style="margin-top: 15px;">
        <table class="table table-hover">
            <thead>
                <th>Account Number</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact No.</th>
                <th>Mac Address</th>
                <th>Subscribed Speed</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td><strong><a href="{{ route('customers.show', [$item->id]) }}">{{ $item->id }}</a></strong></td>
                        <td><strong>{{ $item->FullName }}</strong></td>
                        <td>{{ Customers::getAddress($item) }}</td>
                        <td>{{ $item->ContactNumber }}</td>
                        <td>{{ $item->MacAddress }}</td>
                        <td>{{ $item->SpeedSubscribed }} mbps</td>
                        <td>
                           <a href="{{ route('paymentTransactions.payment-module', [$item->id]) }}" class="btn btn-sm btn-success float-right">Proceed Payment <i class="fas fa-arrow-right"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

