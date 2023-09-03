@php
    use App\Models\Customers;
@endphp

@extends('layouts.app')

@section('content')
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <p style="margin: 0; padding: 0;">{{ $customer->id }}</p>
               <h4>{{ $customer->FullName }}</h4>
               <p style="margin: 0; padding: 0;" class="text-muted">{{ Customers::getAddress($customer) }}</p>
            </div>
         </div>
      </div>
   </section>

   <div class="row">
      {{-- UNPAID BILLS --}}
      <div class="col-lg-7">
         <div class="card shadow-none">
            <div class="card-header">
               <span class="card-title"><i class="fas fa-info-circle ico-tab-mini"></i>All Unpaid Bills</span>
            </div>
            <div class="card-body table-responsive p-0">
               <table class="table table-hover table-sm table-bordered">
                  <thead>
                     <th>Billing Month</th>
                     <th class="text-right">Amount Due</th>
                     <th class="text-right">Paid Amount</th>
                     <th class="text-right">Balance</th>
                  </thead>
                  <tbody>
                     @php
                         $total = 0;
                     @endphp
                     @foreach ($unpaidBills as $item)
                        <tr>
                           <td>{{ date('F Y', strtotime($item->BillingMonth)) }}</td>
                           <td class="text-right">{{ number_format($item->TotalAmountDue, 2) }}</td>
                           <td class="text-right">{{ number_format($item->PaidAmount, 2) }}</td>
                           <td class="text-danger text-right"><strong>{{ number_format($item->Balance, 2) }}</strong></td>
                        </tr>
                        @php
                            $total += $item->Balance;
                        @endphp
                     @endforeach
                  </tbody>
                  <tfoot>
                     <th colspan="3">Total Amount Due</th>
                     <th class="text-danger text-right"><h3>{{ number_format($total, 2) }}</h3></th>
                  </tfoot>
               </table>
            </div>
         </div>
      </div>

      {{-- PAYMENT --}}
      <div class="col-lg-5">
         <div class="card shadow-none">
            <div class="card-header bg-primary">
               <span class="card-title"><i class="fas fa-dollar-sign ico-tab-mini"></i> Payment</span>
            </div>
            <div class="card-body">
               <div class="form-group">
                  <label for="AmountPaid">Amount Paid:</label>
                  <input type="number" autofocus class="form-control" placeholder="Input amount paid" id="AmountPaid">
               </div>
               <div class="form-group">
                  <label for="ORNumber">OR/Invoice Number:</label>
                  <input type="text" autofocus class="form-control" placeholder="Input ORNumber" id="ORNumber">
               </div>
               <div class="form-group">
                  <label for="AmountDue">Amount Due:</label>
                  <input type="number" readonly class="form-control" id="AmountDue" value="{{ $total }}">
               </div>
               <div class="form-group">
                  <label for="Change">Change:</label>
                  <h2 id="Change" class="text-info">0</h2>
               </div>

               <div class="divider"></div>
               <div id="loader" class="spinner-border text-success gone" role="status">
                  <span class="sr-only">Loading...</span>
               </div>
               <button class="btn btn-lg btn-success float-right" onclick="submitPayment()"><i class="fas fa-check-circle ico-tab"></i>Submit Payment</button>
            </div>
         </div>
      </div>
   </div>
@endsection

@push('page_scripts')
   <script>
      $(document).ready(function() {
         $('#AmountPaid').on('keyup', function() {
            getChange()
         })

         $('#AmountPaid').on('change', function() {
            getChange()
         })
      })

      function getChange() {
         var due = parseFloat($('#AmountDue').val())
         var paid = parseFloat($('#AmountPaid').val())
         var change = 0

         if (due > paid) {
            change = 0
         } else {
            change = paid - due
         }
         
         $('#Change').text(Number(parseFloat(change).toFixed(2)).toLocaleString())
      }

      function submitPayment() {
         var paid = $('#AmountPaid').val()
         var orNo = $('#ORNumber').val()

         if (jQuery.isEmptyObject(paid) | jQuery.isEmptyObject(orNo)) {
            Toast.fire({
               icon : 'warning',
               text : 'Please add amount and OR number!'
            })
         } else {
            var due = parseFloat($('#AmountDue').val())
            var paid = parseFloat($('#AmountPaid').val())
            var amnt = 0

            if (due >= paid) {
               amnt = paid
            } else {
               amnt = due
            }

            // alert(amnt)

            $('#loader').removeClass('gone')
            
            $.ajax({
               url : "{{ route('paymentTransactions.transact-bill-bulk') }}",
               type : 'GET',
               data : {
                  id : "{{ $customer->id }}",
                  AmountPaid : amnt,
                  ORNumber : orNo,
               },
               success : function(res) {
                  Toast.fire({
                     icon : 'success',
                     text : 'Payment successful!'
                  })
                  $('#loader').addClass('gone')
                  window.location.href = "{{ url('payment_transactions/print-payment') }}/" + orNo + "/" + "{{ $customer->id }}"
               },
               error : function(err) {
                  Toast.fire({
                     icon : 'error',
                     text : 'Error transacting payment!'
                  })
                  $('#loader').addClass('gone')
               }
            })
         }
      }
   </script>
@endpush