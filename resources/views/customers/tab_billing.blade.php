<div class="px-2">
   @php
      $bal = $balance != null ? $balance->BalanceTotal : 0;
   @endphp
   <p class="text-muted" style="margin: 0px; padding: 0px;">Unpaid Balance</p>
   <h2 class="{{ $bal<=0 ? 'text-success' : 'text-danger' }}">₱ {{ number_format($bal, 2) }}</h2>
   <br>
</div>

<table class="table table-sm table-hover table-bordered">
   <thead>
      <th>Bill No.</th>
      <th>Billing Month</th>
      <th class="text-right">Net Amount</th>
      <th>Due Date</th>
      <th class="text-right">Amount Paid</th>
      <th class="text-right">Balance</th>
      <th></th>
   </thead>
   <tbody>
      @foreach ($billings as $item)
          <tr>
            <td>
               @if ($item->Balance == 0)
                  <i class="fas fa-check-circle ico-tab-mini text-success"></i>
               @else
                  <i class="fas fa-info-circle ico-tab-mini text-danger"></i>
               @endif
               <a href="{{ route('billings.show', [$item->id]) }}">{{ $item->BillNumber }}</a>
            </td>
            <td>{{ date('F Y', strtotime($item->BillingMonth)) }}</td>
            <td class="text-right text-info">{{ number_format($item->TotalAmountDue, 2) }}</td>
            <td>{{ date('M d, Y', strtotime($item->DueDate)) }}</td>
            <td class="text-right text-success">{{ number_format($item->PaidAmount, 2) }}</td>
            <td class="text-right text-danger">{{ number_format($item->Balance, 2) }}</td>
            <td>
               @if ($item->Balance > 0)
                  <button class="btn btn-xs text-danger float-right" title="Delete This Bill" onclick="cancelBill('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                  <a class="btn btn-xs text-primary float-right" href="{{ route('billings.edit', [$item->id]) }}" title="Edit this bill"><i class="fas fa-pen"></i></a>
                  <button class="btn btn-xs text-success float-right" title="Pay this bill" onclick="payBill('{{ $item->id }}')"><i class="fas fa-clipboard-check"></i></button>
               @endif               
            </td>
          </tr>
      @endforeach
   </tbody>
</table>

{{-- PAY BILL --}}
<div class="modal fade" id="modal-pay-bill" aria-hidden="true" style="display: none;">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h4 class="modal-title">Pay This Bill</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
               </button>
           </div>
           <div class="modal-body">
               <div class="row">
                  <div class="form-group col-lg-12">
                       <label for="Amount">Amount Paid</label>
                       <input type="number" id="Amount" autofocus=true class="form-control">
                  </div>
                  <div class="form-group col-lg-12">
                       <label for="ORNumber">OR/Invoice Number</label>
                       <input type="text" id="ORNumber" class="form-control">
                  </div>
                  <div class="form-group col-lg-12">
                     <label for="PaymentDate">Payment Date</label>
                     <input type="text" id="PaymentDate" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                  @push('page_scripts')
                     <script type="text/javascript">
                        $('#PaymentDate').datetimepicker({
                           format: 'YYYY-MM-DD',
                           useCurrent: true,
                           sideBySide: true
                        })
                     </script>
                  @endpush
               </div>
           </div>
           <div class="modal-footer">
               <button class="btn btn-primary" id="pay-btn"><i class="fas fa-shopping-cart ico-tab-mini"></i>Proceed Payment</button>
           </div>
       </div>
   </div>
</div>

@push('page_scripts')
   <script>
      var paymentBillId = ''

      $(document).ready(function() {
         // PAY TRANSACT BTN
         $('#pay-btn').on('click', function(e) {
            e.preventDefault()
            var amount = $('#Amount').val()
            if (jQuery.isEmptyObject(amount)) {
               Toast.fire({
                  icon : 'warning',
                  text : 'Please provide an amount'
               })
            } else {
               transactBillPayment(paymentBillId, amount, $('#ORNumber').val(), $('#PaymentDate').val())
            }
         })

         // MODAL HIDE FN
         $('#modal-pay-bill').on('hidden.bs.modal', function () {
            $('#ORNumber').val('')
            $('#PaymentDate').val('')
            $('#Amount').val('')
         });
      })

      function cancelBill(id) {
         Swal.fire({
            title: 'Delete This Bill?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                  url : "{{ url('/billings/') }}/" + id,
                  type : 'DELETE',
                  data : {
                     _token : '{{ csrf_token() }}',
                     id : id,
                  },
                  success : function(res) {
                     Toast.fire({
                        icon : 'success',
                        text : 'Bill removed!'
                     })
                     location.reload()
                  },
                  error : function(err) {
                     Toast.fire({
                        icon : 'error',
                        text : 'Error removing bill!'
                     })
                  }
               })
            }
         })
      }

      function payBill(id) {
         paymentBillId = id
         $('#modal-pay-bill').modal('show')
      }

      function transactBillPayment(id, amount, or, date) {
         $.ajax({
            url : "{{ route('paymentTransactions.transact-bills-payment') }}",
            type : 'POST',
            data : {
               _token : "{{ csrf_token() }}",
               BillId : id,
               AmountPaid : amount,
               ORNumber : or,
               PaymentDate : date,
            },
            success : function(res) {
               $('#modal-pay-bill').modal('hide')
               Toast.fire({
                  icon : 'success',
                  text : 'Payment successfully received!'
               })
               location.reload()
            },
            error : function(err) {
               $('#modal-pay-bill').modal('hide')
               Toast.fire({
                  icon : 'error',
                  text : 'Error receiving payment!'
               })
            }
         })
      }
   </script>
@endpush