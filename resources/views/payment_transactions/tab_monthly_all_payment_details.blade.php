@php
    use App\Models\Customers;
@endphp
<table class="table table-hover table-sm" id="results-table">
   <thead>
       <th style="width: 30px;">#</th>
       <th>Account No</th>
       <th>Name</th>
       <th>Address</th>
       <th>Billing Month</th>
       <th>Payment Details</th>
       <th>Received By</th>
       <th>OR Number</th>
       <th>Payment Date</th>
       <th class="text-right">Amount Paid</th>
   </thead>
   <tbody>
       @php
           $i=1;
           $total = 0;
       @endphp
       @foreach ($data as $item)
           <tr>
               <td>{{ $i }}</td>
               <td><a href="{{ route('customers.show', [$item->AccountNumber]) }}">{{ $item->AccountNumber }}</a></td>
               <td>{{ $item->FullName }}</td>
               <td>{{ Customers::getAddress($item) }}</td>
               <td>{{ $item->BillingMonth != null ? date('M Y', strtotime($item->BillingMonth)) : '' }}</td>
               <td class="text-info">{{ $item->PaymentFor }}</td>
               <td>{{ $item->name }}</td>
               <td>{{ $item->ORNumber }}</td>
               <td>{{ date('M d, Y', strtotime($item->PaymentDate)) }}</td>
               <td class="text-right text-success">₱ {{ number_format($item->AmountPaid, 2) }}</td>
           </tr>
           @php
               $i++;
               $total += floatval($item->AmountPaid);
           @endphp
       @endforeach
       <tr>
          <td colspan="9"><strong>TOTAL COLLECTION</strong></td>
          <td class="text-right text-success"><strong>₱ {{ number_format($total, 2) }}</strong></td>
      </tr>
   </tbody>
</table>