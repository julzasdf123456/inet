<table class="table table-hover table-sm table-borderless">
   <thead>
      <th>Item</th>
      <th>Date</th>
      <th class="text-right">Debit</th>
      <th class="text-right">Credit</th>
   </thead>
   <tbody>
      {{-- SALES --}}
      @php
         $totalSalesDetailed = 0;
         $totalExpensesDetailed = 0;
         $totalRevenueDetailed = 0;
      @endphp
      @foreach ($salesDetailed as $item)
         <tr>
            <td>{{ $item->FullName }} - {{ $item->PaymentFor }} {{ $item->BillingMonth != null ? '(' . date('M Y', strtotime($item->BillingMonth)) . ')' : '' }}</td>
            <td>{{ date('F d, Y', strtotime($item->PaymentDate)) }}</td>
            <td class="text-right text-success">{{ number_format($item->AmountPaid, 2) }}</td>
            <td></td>
         </tr>
         @php
            $totalSalesDetailed += floatval($item->AmountPaid);
         @endphp
      @endforeach
      {{-- EXPENSES --}}
      @foreach ($expensesDetailed as $item)
         <tr>
            <td style="text-indent: 45px;">{{ $item->ExpenseFor }} {{ $item->name != null ? ' - ' . $item->name : '' }}</td>
            <td style="text-indent: 45px;">{{ date('F d, Y', strtotime($item->ExpenseDate)) }}</td>
            <td></td>
            <td class="text-right text-danger">{{ number_format($item->Amount, 2) }}</td>
         </tr>
         @php
            $totalExpensesDetailed += floatval($item->Amount);
         @endphp
      @endforeach
      @php
          $totalRevenueDetailed = $totalSalesDetailed - $totalExpensesDetailed;
      @endphp
      <tr>
         <td><strong>Total Sales</strong></td>
         <td></td>
         <td class="text-right text-success"><strong>{{ number_format($totalSalesDetailed, 2) }}</strong></td>
         <td></td>
      </tr>
      <tr>
         <td><strong>Total Expenses</strong></td>
         <td></td>
         <td></td>
         <td class="text-right text-danger"><strong>{{ number_format($totalExpensesDetailed, 2) }}</strong></td>
      </tr>
      <tr>
         <td class="text-info"><strong>Total Revenue</strong></td>
         <td></td>
         @if ($totalRevenueDetailed > 0)
            <td class="text-right text-success"><h3>₱ {{ number_format($totalRevenueDetailed, 2) }}</h3></td>
            <td></td>
         @else
            <td></td>
            <td class="text-right text-danger"><h3>₱ {{ number_format($totalRevenueDetailed, 2) }}</h3></td>
         @endif         
      </tr>
   </tbody>
</table>