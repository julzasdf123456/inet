@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-lg-12" style="margin-top: 10px;">
        @include('payment_transactions.dashboard_sales_over_expenses')
    </div>

    <div class="col-lg-12">
        @include('customers.dashboard_statistics')
    </div>

</div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            // AUTOGENERATE BILLS
            autoGenerateBills()

            // AUTO GENRATE DUE NOTIFS
            generateDueNotifs()
        })

        function autoGenerateBills() {
            $.ajax({
                url : "{{ route('billings.auto-generate-bills-bulk') }}",
                type : 'GET',
                success : function(res) {
                    console.log('Bills Generated')
                },
                error : function(err) {
                    Toast.fire({
                        icon : 'error',
                        text : 'Bill generation error'
                    })
                }
            })
        }

        function generateDueNotifs() {
            $.ajax({
                url : "{{ route('billings.generate-bill-due-notifs') }}",
                type : 'GET',
                success : function(res) {
                    console.log('Due Notifications Generated')
                },
                error : function(err) {
                    Toast.fire({
                        icon : 'error',
                        text : 'Due generation error'
                    })
                }
            })
        }
    </script>
@endpush