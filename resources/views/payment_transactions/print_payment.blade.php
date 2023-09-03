@php
    use App\Models\Customers;

@endphp
<style>
    @font-face {
        font-family: 'sax-mono';
        src: url('/fonts/saxmono.ttf');
    }
    html, body {
        /* font-family: sax-mono, Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif; */
        font-family: sans-serif;
        /* font-stretch: condensed; */
        margin: 0;
        font-size: .85em;
    }

    table tbody th,td,
    table thead th {
        font-family: sans-serif;
        /* font-family: sax-mono, Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif; */
        /* font-stretch: condensed; */
        /* , Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif; */
        font-size: .8em;
        padding-bottom: 8px;
    }

    @media print {
        @page {
            orientation: portrait;
            margin: 0;
        }

        header {
            display: none;
        }

        .divider {
            width: 100%;
            margin: 10px auto;
            height: 1px;
            background-color: #dedede;
        }

        .left-indent {
            margin-left: 30px;
        }

        p {
            padding: 0px !important;
            margin: 0px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

    }  
    .divider {
        width: 100%;
        margin: 10px auto;
        height: 3px;
        background-color: #dedede;
      -webkit-print-color-adjust: exact;
    } 

    p {
        padding: 0px !important;
        margin: 0px;
        font-size: 1.2em;
    }

    .text-center {
        text-align: center;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .half {
        display: inline-table; 
        width: 49%;
    }

    .thirty {
        display: inline-table; 
        width: 30%;
    }

    .seventy {
        display: inline-table; 
        width: 69%;
    }

    .watermark {
        position: fixed;
        left: 15%;
        top: 60px;
        width: 65%;
        opacity: 0.16;
        z-index: -99;
        color: white;
        user-select: none;
    }

    .border {
        position: fixed;
        width: 100%;
        z-index: 1;
        color: white;
        left: 0;
        top: 0;
    }

    .pms {
      color: black;
      background: rgb(243, 231, 57);
      padding: 30px;
      font-size: 2em;
      -webkit-print-color-adjust: exact;
    }

    .bg-bill {
      background-color: #607D8B;
      -webkit-print-color-adjust: exact;
    }

    .bg-or {
      background-color: #009688;
      -webkit-print-color-adjust: exact;
    }

    .text-white {
      color: white;
      -webkit-print-color-adjust: exact;
    }

    .text-muted {
      color: #898989;
      -webkit-print-color-adjust: exact;
    }

    .no-pad {
      margin: 0px; 
      padding: 0px;
    }

</style>

<div id="print-area" class="content">
  <div class="bg-or" style="padding: 25px 30px 5px 30px;">
      <div class="half">
         <img src="{{ URL::asset('imgs/logo.jpg') }}" width="80px;" style="margin-bottom: 10px;"> 
         <h1 class="text-white no-pad">PAYMENT RECEIPT</h1>
         <h3 class="text-white no-pad">{{ $payment->PaymentFor }}</h3>
      </div>
      
      <div class="half">
         <p class="text-right text-white" style="padding-bottom: 2px; font-size: 1.52em;"><strong>{{ env('APP_COMPANY') }}</strong></p>
         <p class="text-right text-white" style="padding-bottom: 2px;">{{ env('APP_ADDRESS') }}</p>
         <p class="text-right text-white" style="padding-bottom: 2px;">{{ env('APP_POSTAL') }}</p>
      </div>
  </div>

  <div style="padding: 10px 30px 5px 30px;">
      <div class="half">
         <span class="text-muted">Paid By:</span><br><br>
         <h1 class="no-pad">{{ $customer->FullName }}</h1>
         <p class="no-pad">{{ Customers::getAddress($customer) }}</p>
         <p class="no-pad">Account No: {{ $customer->id }}</p>
         <p class="no-pad text-muted">Subscription: {{ $customerTechnical->SpeedSubscribed }} mbps</p>
      </div>

      <div class="half">
         <br>
         <p class="text-muted text-right no-pad">OR/Invoice No:</p>
         <h2 class="no-pad text-right">{{ $payment->ORNumber }}</h2>
         <br>
         <p class="text-muted text-right no-pad">OR/Invoice Date:</p>
         <p class="no-pad text-right">{{ $payment->PaymentDate != null ? date('F d, Y', strtotime($payment->PaymentDate)) : '' }}</p>
      </div>
  </div>

  <div class="divider"></div>

  <div style="padding: 10px 30px 0px 30px;">
      <table style="width: 100%">
         <thead>
            <th class="text-left">Billing Month</th>
            <th class="text-right">Bill Amount</th>
            <th class="text-right">Balance</th>
            <th class="text-right">Amount Paid</th>
         </thead>
         <tbody>
            @php
                $totalPaid = 0;
            @endphp
            @foreach ($payments as $item)
                <tr>
                  <td>{{ $item->BillingMonth != null ? date('F Y', strtotime($item->BillingMonth)) : '' }}</td>
                  <td class="text-right">₱ {{ is_numeric($item->TotalAmountDue) ? number_format($item->TotalAmountDue, 2) : $item->TotalAmountDue }}</td>
                  <td class="text-right">₱ {{ is_numeric($item->Balance) ? number_format($item->Balance, 2) : $item->Balance }}</td>
                  <td class="text-right"><strong>₱ {{ is_numeric($item->AmountPaid) ? number_format($item->AmountPaid, 2) : $item->AmountPaid }}</strong></td>
                </tr>
                @php
                  $totalPaid += is_numeric($item->AmountPaid) ? floatval($item->AmountPaid) : 0;
               @endphp
            @endforeach
         </tbody>
      </table>
  </div>

  <div class="divider"></div>

  <div style="padding: 10px 30px 0px 30px;">
      <p class="no-pad text-right">Total Paid</p>
      <h1 class="text-right">₱ {{ is_numeric($totalPaid) ? number_format($totalPaid, 2) : $totalPaid }}</h1>
  </div>
</div>

<script type="text/javascript">
    window.print();
    
    window.setTimeout(function(){
        window.location.href = "{{ route('paymentTransactions.payments') }}"
    }, 800);
</script>