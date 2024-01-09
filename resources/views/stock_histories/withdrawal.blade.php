@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4>Withdraw and Release Stocks</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card shadow-none">

            {!! Form::open(['route' => 'stockHistories.withdraw']) !!}

            <div class="card-body">

                <div class="row">
                    <!-- Stockname Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('StockId', 'Select Stock/Item:') !!}
                        <select name="StockId" id="StockId" class="form-control">
                           @foreach ($stocks as $item)
                               <option value="{{ $item->id }}" quantity="{{ $item->StockQuantity }}"><b>{{ $item->StockName }}</b> ({{ $item->StockQuantity . ' ' . $item->Unit }} in stock)</option>
                           @endforeach
                        </select>
                    </div>
                    
                     <!-- Quantity Field -->
                     <div class="form-group col-sm-6">
                        {!! Form::label('Quantity', 'Quantity to be Released:') !!}
                        {!! Form::number('Quantity', null, ['class' => 'form-control', 'required' => 'true', 'id' => 'Quantity']) !!}
                     </div>

                     <!-- Datestocked Field -->
                     <div class="form-group col-sm-6">
                        {!! Form::label('DateStocked', 'Inventory Date:') !!}
                        {!! Form::text('DateStocked', date('Y-m-d'), ['class' => 'form-control','id'=>'DateStocked']) !!}
                     </div>

                     @push('page_scripts')
                        <script type="text/javascript">
                           $('#DateStocked').datetimepicker({
                              format: 'YYYY-MM-DD',
                              useCurrent: true,
                              sideBySide: true
                           })
                        </script>
                     @endpush

                     <!-- Notes Field -->
                     <div class="form-group col-sm-6">
                        {!! Form::label('Notes', 'Notes/Comments/Remarks:') !!}
                        {!! Form::text('Notes', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
                     </div>
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Release Stock', ['class' => 'btn btn-primary gone', 'id' => 'release']) !!}
                <a href="{{ route('stocks.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection


@push('page_scripts')
    <script>
      $(document).ready(function() {
         $('#Quantity').keyup(function() {
            var value = this.value

            if (!jQuery.isEmptyObject(value)) {
                var qty = $('#StockId').find(':selected').attr('quantity')
                qty = jQuery.isEmptyObject(qty) ? 0 : parseInt(qty)

                if (qty >= parseInt(value)) {
                    $('#release').removeClass('gone')
                } else {
                    $('#release').addClass('gone')
                    Toast.fire({
                        icon : 'warning',
                        text : 'Quantity to be withdrawn should be less than the stock available'
                    })
                }
            } else {
                $('#release').addClass('gone')
            }
         })
      })

      function addNewStock() {
         $.ajax({
            url : "{{ route('stocks.store-ajax') }}",
            type : 'POST',
            data : {
               _token : "{{ csrf_token() }}",
               StockName : $('#StockName').val(),
               Description : $('#Description').val(),
               Type : $('#Type').val(),
               CanBeChargedToCustomer : $('input[name="CanBeChargedToCustomer"]:checked').val(),
               Unit : $('#Units').val(),
               RetailPrice : $('#RetailPrice').val()
            },
            success : function(res) {
               $('#StockId').append('<option value="' + res['id'] + '" selected>' + res['StockName'] + '</option>')

               $('#modal-new-stock').modal('hide')

               Toast.fire({
                  icon : 'success',
                  text : 'New stock added!'
               })

               $('#StockName').val('')
               $('#Description').val('')
               $('#RetailPrice').val('')
            },
            error : function(err) {
               Toast.fire({
                  icon : 'error',
                  text : 'Error adding stock!'
               })
            }
         })
      }
    </script>
@endpush
