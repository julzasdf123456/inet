@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Stocks Details</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        {{-- STOCK DETAILS --}}
        <div class="col-lg-6">
            <div class="card shadow-none">
                <div class="card-header">
                    <span class="card-title">Details</span>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tr>
                            <td>Stock Name</td>
                            <td><strong>{{ $stocks->StockName }}</strong></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><strong>{{ $stocks->Description }}</strong></td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td><strong>{{ $stocks->Type }}</strong></td>
                        </tr>
                        <tr>
                            <td>Quantity in Stock</td>
                            <td class="text-success"><strong>{{ $stocks->StockQuantity }}</strong> {{ $stocks->Unit }}</td>
                        </tr>
                        <tr>
                            <td>Can be Sold</td>
                            <td><strong>{{ $stocks->CanBeChargedToCustomer }}</strong></td>
                        </tr>
                        <tr>
                            <td>Retail Price</td>
                            <td><strong>{{ number_format($stocks->RetailPrice, 2) }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- STOCK HISTORY --}}
        <div class="col-lg-6">
            <div class="card shadow-none">
                <div class="card-header">
                    <span class="card-title">Inventory History</span>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-sm">
                        <thead>
                            <th>Inventory Date</th>
                            <th>Quantity</th>
                            <th>User Added</th>
                        </thead>
                        <tbody>
                            @foreach ($history as $item)
                                <tr>
                                    <td>{{ $item->DateStocked != null ? date('F d, Y', strtotime($item->DateStocked)) : date('F d, Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->Quantity }}</td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
