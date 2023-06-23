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
        font-size: .72em;
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
  <div class="bg-bill" style="padding: 25px 30px 15px 30px;">
      <div class="half">
         <img src="{{ URL::asset('imgs/logo.jpg') }}" width="80px;" style="margin-bottom: 10px;"> 
         <h1 class="text-white no-pad">BILLING STATEMENT</h1>
         <h3 class="text-white no-pad">{{ $bill->BillingMonth != null ? strtoupper(date('F Y', strtotime($bill->BillingMonth))) : '-' }}</h3>
      </div>
      
      <div class="half">
         <p class="text-right text-white" style="padding-bottom: 2px; font-size: 1.52em;"><strong>{{ env('APP_COMPANY') }}</strong></p>
         <p class="text-right text-white" style="padding-bottom: 2px;">{{ env('APP_ADDRESS') }}</p>
         <p class="text-right text-white" style="padding-bottom: 2px;">{{ env('APP_POSTAL') }}</p>
      </div>
  </div>

  <div style="padding: 10px 30px 15px 30px;">
      <div class="half">
         <span class="text-muted">Bill To:</span><br><br>
         <h1 class="no-pad">{{ $customer->FullName }}</h1>
         <p class="no-pad">{{ Customers::getAddress($customer) }}</p>
         <p class="no-pad">Account No: {{ $customer->id }}</p>
         <p class="no-pad text-muted">Date Connected: {{ $customer->DateConnected != null ? date('F d, Y', strtotime($customer->DateConnected)) : '' }}</p>
         <p class="no-pad text-muted">Subscription: {{ $customerTechnical->SpeedSubscribed }} mbps</p>
      </div>

      <div class="half">
         <p class="text-muted text-right no-pad">Bill No:</p>
         <p class="no-pad text-right">{{ $bill->BillNumber }}</p>
         <p class="text-muted text-right no-pad">Billing Date:</p>
         <p class="no-pad text-right">{{ $bill->BillingDate != null ? date('F d, Y', strtotime($bill->BillingDate)) : '' }}</p>
         <p class="text-muted text-right no-pad">Due Date:</p>
         <p class="no-pad text-right">{{ $bill->DueDate != null ? date('F d, Y', strtotime($bill->DueDate)) : '' }}</p>
      </div>
  </div>

  <div class="divider"></div>

  <div style="padding: 10px 30px 15px 30px;">
      <p class="no-pad text-right">Total Amount Due</p>
      <h1 class="text-right">₱ {{ is_numeric($bill->TotalAmountDue) ? number_format($bill->TotalAmountDue, 2) : $bill->TotalAmountDue }}</h1>
  </div>
</div>

<script type="text/javascript">
    window.print();
    
    window.setTimeout(function(){
        window.history.go(-1)
    }, 800);
</script>