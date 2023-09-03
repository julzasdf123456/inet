@php
    use App\Models\Customers;
@endphp

@extends('layouts.app')

@section('content')
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h4>All Unpaid Customer Balances</h4>
            </div>
         </div>
      </div>
   </section>

   <div class="card shadow-none">
      <div class="card-body table-responsive p-0">
         <table class="table table-hover table-sm table-bordered">
            <thead>
               <th>Account No.</th>
               <th>Customer Name</th>
               <th>Address</th>
               <th>Bill Number</th>
               <th>Billing Month</th>
               <th class="text-right">Balance</th>
            </thead>
            <tbody>
               @php
                  $total = 0;
               @endphp
               @foreach ($data as $item)
                  <tr>
                     <td><a href="{{ route('customers.show', [$item->AccountNumber]) }}">{{ $item->AccountNumber }}</a></td>
                     <td>{{ $item->FullName }}</td>
                     <td>{{ Customers::getAddress($item) }}</td>
                     <td><a href="{{ route('billings.show', [$item->id]) }}">{{ $item->BillNumber }}</a></td>
                     <td>{{ date('F Y', strtotime($item->BillingMonth)) }}</td>
                     <td class="text-right text-danger">₱ {{ number_format($item->Balance, 2) }}</td>
                  </tr>
                  @php
                     $total += $item->Balance;
                  @endphp
               @endforeach
               <tr>
                  <td colspan="5"><strong>Total Receivable</strong></td>
                  <td class="text-right text-danger"><strong>₱ {{ number_format($total, 2) }}</strong></td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
@endsection