<table class="table table-hover table-sm table-bordered">
   <thead>
      <th>Modem No.</th>
      <th>Modem Brand</th>
      <th>MAC Address</th>
      <th>Subscribed Speed</th>
      <th class="text-right">Monthly Payment</th>
      <th>Encoded By</th>
      <th>Date Encoded</th>
   </thead>
   <tbody>
      @foreach ($modemHistory as $item)
         <tr>
            <td>{{ $item->ModemNumber }}</td>
            <td>{{ $item->ModemBrand }}</td>
            <td>{{ $item->MacAddress }}</td>            
            <td>{{ $item->SpeedSubscribed }} mbps</td>
            <td class="text-right">{{ number_format($item->MonthlyPayment, 2) }}</td>
            <td>{{ $item->name }}</td>     
            <td>{{ date('M d, Y h:i A', strtotime($item->created_at)) }}</td>     
         </tr>
      @endforeach
   </tbody>
</table>