<table class="table table-hover table-sm table-borderless">
   <thead>
      <th>Item</th>
      <th class="text-right">Debit</th>
      <th class="text-right">Credit</th>
   </thead>
   <tbody>
      {{-- SALES --}}
      @php
         $totalSalesConsolidated = 0;
         $totalExpensesConsolidated = 0;
         $totalRevenueConsolidated = 0;
      @endphp
      @foreach ($salesConsolidated as $item)
         <tr>
            <td>{{ $item->PaymentFor }}</td>
            <td class="text-right text-success">{{ number_format($item->TotalConsolidatedSales, 2) }}</td>
            <td></td>
         </tr>
         @php
            $totalSalesConsolidated += floatval($item->TotalConsolidatedSales);
         @endphp
      @endforeach
      {{-- EXPENSES --}}
      @foreach ($expensesConsolidated as $item)
         <tr>
            <td style="text-indent: 45px;">{{ $item->ExpenseFor }}</td>
            <td></td>
            <td class="text-right text-danger">{{ number_format($item->TotalConsolidatedExpenses, 2) }}</td>
         </tr>
         @php
            $totalExpensesConsolidated += floatval($item->TotalConsolidatedExpenses);
         @endphp
      @endforeach
      @php
          $totalRevenueConsolidated = $totalSalesConsolidated - $totalExpensesConsolidated;
      @endphp
      <tr>
         <td><strong>Total Sales</strong></td>
         <td class="text-right text-success"><strong>{{ number_format($totalSalesConsolidated, 2) }}</strong></td>
         <td></td>
      </tr>
      <tr>
         <td><strong>Total Expenses</strong></td>
         <td></td>
         <td class="text-right text-danger"><strong>{{ number_format($totalExpensesConsolidated, 2) }}</strong></td>
      </tr>
      <tr>
         <td class="text-info"><strong>Total Revenue</strong></td>
         @if ($totalRevenueConsolidated > 0)
            <td class="text-right text-success"><h3>₱ {{ number_format($totalRevenueConsolidated, 2) }}</h3></td>
            <td></td>
         @else
            <td></td>
            <td class="text-right text-danger"><h3>₱ {{ number_format($totalRevenueConsolidated, 2) }}</h3></td>
         @endif         
      </tr>
   </tbody>
</table>