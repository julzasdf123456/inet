<div class="card shadow-none">
   <div class="card-body">
      <div class="row">
         <div class="col-lg-3">
            <p style="margin: 0; padding: 0;" class="text-muted text-center">Active Customers</p>
            <h1 id="total-active" class="text-center text-primary">0</h1>
         </div>

         <div class="col-lg-3">
            <p style="margin: 0; padding: 0;" class="text-muted text-center">Disconnected Customers</p>
            <h1 id="total-disco" class="text-center text-danger">0</h1>
         </div>

         <div class="col-lg-3">
            <p style="margin: 0; padding: 0;" class="text-muted text-center">New Customers</p>
            <h1 id="new-customers" class="text-center text-success">0</h1>
         </div>

         <div class="col-lg-3">
            <p style="margin: 0; padding: 0;" class="text-muted text-center">Bills Paid</p>
            <h1 id="bills-paid" class="text-center text-success">0</h1>
         </div>
      </div>
   </div>
</div>

@push('page_scripts')
   <script>
      $(document).ready(function() {
         getStatistics()
      })

      function getStatistics() {
         $.ajax({
            url : "{{ route('customers.get-dashboard-statistics') }}",
            type : 'GET',
            success : function(res) {
               $('#total-active').text(res['TotalActiveCustomers'])
               $('#total-disco').text(res['TotalDisconnectedCustomers'])
               $('#new-customers').text(res['NewCustomers'])
               $('#bills-paid').text(res['PaymentsThisMonth'])
            },
            error : function(err) {
               console.log(err)
            }
         })
      }
   </script>
@endpush