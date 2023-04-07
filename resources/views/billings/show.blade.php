@php
    use App\Models\Customers;
@endphp

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <p style="margin: 0px; padding: 0px;" title="Account Number">{{ $customer->id }}</p>
                    <h4 title="Customer Name">{{ $customer->FullName }}</h4>
                    <p class="text-muted" style="margin: 0px; padding: 0px;" title="Customer Address">{{ Customers::getAddress($customer) }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="row">
            {{-- BILL DETAILS --}}
            <div class="col-lg-5">
                <div class="card shadow-none">
                    <div class="card-header border-0">
                        <span class="card-title text-muted"><i class="fas fa-info-circle ico-tab-mini"></i>Bill Details</span>

                        <div class="card-tools">
                            @if ($bill->Balance > 0)
                                <a href="{{ route('billings.edit', [$bill->id]) }}" title="Edit this bill"><i class="fas fa-pen"></i></a>
                            @endif
                            
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-borderless table-hover table-sm">
                            <tr>
                                <td class="text-muted">Bill Number</td>
                                <td class="text-right">{{ $bill->BillNumber }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Billing Month</td>
                                <td class="text-right text-info"><strong>{{ date('F Y', strtotime($bill->BillingMonth)) }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Due Date</td>
                                <td class="text-right">{{ date('F d, Y', strtotime($bill->DueDate)) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Amount Due</td>
                                <td class="text-right">₱ {{ number_format($bill->BillAmountDue, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Additional Payments</td>
                                <td class="text-right">+ ₱ {{ number_format($bill->AdditionalPayments, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Deductions & Discounts</td>
                                <td class="text-right">- ₱ {{ number_format($bill->Deductions, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Total Amount Due</td>
                                <td class="text-right text-primary"><strong>₱ {{ number_format($bill->TotalAmountDue, 2) }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            {{-- PAYMENT DETAILS --}}
            <div class="col-lg-7">
                <div class="card shadow-none">
                    <div class="card-header border-0">
                        <span class="card-title text-muted"><i class="fas fa-info-circle ico-tab-mini"></i>Payment Details</span>
                    </div>
                    <div class="card-body">
                        <p class="text-muted" style="margin: 0px; padding: 0px;">Unpaid Balance This Month</p>
                        <h2 class="{{ $bill->Balance <= 0 ? 'text-success' : 'text-danger' }}">₱ {{ number_format($bill->Balance, 2) }}</h2>

                        <div class="divider"></div>

                        @if (count($paymentTransactions) > 0)
                            <span class="text-muted">Payment Transactions</span>

                            <table class="table table-hover table-bordered table-sm">
                                <thead>
                                    <th>OR No.</th>
                                    <th class="text-right">Amount Paid</th>
                                    <th>Payment Date</th>
                                    <th>User Received</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($paymentTransactions as $item)
                                        <tr>
                                            <td>{{ $item->ORNumber }}</td>
                                            <td class="text-right text-success">₱ {{ number_format($item->AmountPaid, 2) }}</td>
                                            <td>{{ $item->PaymentDate != null ? date('F d, Y', strtotime($item->PaymentDate)) : '' }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-right">
                                                <button onclick="cancelPayment('{{ $item->id }}')" class="btn btn-sm text-danger" title="Cancel this payment"><i class="fas fa-times-circle"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <i class="text-center">No Payment Transactions Recorded</i>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        function cancelPayment(id) {
            Swal.fire({
            title: 'Cancel Payment?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!'
         }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                  url : "{{ url('/paymentTransactions/') }}/" + id,
                  type : 'DELETE',
                  data : {
                     _token : '{{ csrf_token() }}',
                     id : id,
                  },
                  success : function(res) {
                     Toast.fire({
                        icon : 'success',
                        text : 'Payment cancelled!'
                     })
                     location.reload()
                  },
                  error : function(err) {
                     Toast.fire({
                        icon : 'error',
                        text : 'Error cancelling payment!'
                     })
                  }
               })
            }
         })
        }
    </script>
@endpush
