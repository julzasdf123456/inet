<table class="table table-sm table-hover table-bordered">
   <thead>
      <th>#</th>
      <th>Town</th>
      <th class="text-right">Amount</th>
   </thead>
   <tbody>
      @php
         $i=1;
         $total = 0;
      @endphp
      @foreach ($perTown as $item)
         <tr>
            <td>{{ $i }}</td>
            <td>{{ $item->Town }}</td>
            <td class="text-right text-success">₱ {{ number_format($item->TotalAmountPaid, 2) }}</td>
         </tr>
         @php
            $i++;
            $total += floatval($item->TotalAmountPaid);
         @endphp
      @endforeach
      <tr>
         <td colspan="2"><strong>TOTAL COLLECTION</strong></td>
         <td class="text-right text-success"><strong>₱ {{ number_format($total, 2) }}</strong></td>
     </tr>
   </tbody>
</table>