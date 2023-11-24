@php
    use App\Models\Customers;
@endphp
@extends('layouts.app')

@section('content')
<div class="row">
    <div class='col-lg-12 col-md-12'>
        <br>
        <h4 class="text-center display-5">Search Customers</h4>
        {{-- <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm float-right">Add New</a> --}}
        <br>
        <!-- SEARCH BAR -->
        <form action="{{ route('customers.index') }}" method="GET" class="row">
            <div class="col-md-5 offset-md-2">
                <input type="search" id='searchparam' name="param" class="form-control" placeholder="Type Name, Account Number, or Mac Address" autofocus value="{{ isset($_GET['param']) ? $_GET['param'] : '' }}">                    
            </div>
            <div class="col-md-1">
                <select name="Town" id="Town" class="form-control">
                    <option value="All">All</option>
                    @foreach ($towns as $item)
                        <option value="{{ $item->id }}" {{ isset($_GET['Town']) && $_GET['Town']==$item->id ? 'selected' : '' }}>{{ $item->Town }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary" id="searchBtn">
                    <i class="fa fa-search"> </i> Search
                </button>
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
                            <a href="{{ route('customerTechnicals.change-modem', [$item->id]) }}" class="btn btn-link btn-sm text-warning float-right" title="Change Modem or Upgrade/Downgrade Subscribed Speed"><i class="fas fa-level-up-alt"></i></a>
                            <a href="{{ route('customers.edit', [$item->id]) }}" title="Edit customer information" class="btn btn-sm text-primary btn-link float-right"><i class="fas fa-pen"></i></a>
                            <a href="{{ route('customers.show', [$item->id]) }}" title="View Customer Profile" class="btn btn-sm text-primary btn-link float-right"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

