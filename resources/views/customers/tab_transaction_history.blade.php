<table class="table table-hover table-bordered table-sm">
   <thead>
      <th>Transaction Date</th>
      <th>OR Number</th>
      <th>Transaction Description</th>
      <th>Billing Month</th>
      <th>Amount</th>
      <th>Received By</th>
   </thead>
   <tbody>
      @foreach ($transactionHistory as $item)
         <tr>
            <td>{{ $item->PaymentDate != null ? date('M d, Y', strtotime($item->PaymentDate)) : '' }}</td>
            <td>{{ $item->ORNumber }}</td>
            <td>{{ $item->PaymentFor }}</td>
            <td>{{ $item->BillingMonth != null ? date('M Y', strtotime($item->BillingMonth)) : '' }}</td>
            <td>{{ number_format($item->AmountPaid, 2) }}</td>
            <td>{{ $item->name }}</td>
         </tr>
      @endforeach
   </tbody>
</table>