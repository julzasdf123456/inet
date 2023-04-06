@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">


    </div>
</div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {
            // AUTOGENERATE BILLS
            autoGenerateBills()
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
    </script>
@endpush