@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4>Add New Stocks</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card shadow-none">

            {!! Form::open(['route' => 'stockHistories.store']) !!}

            <div class="card-body">

                <div class="row">
                    <!-- Stockname Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('StockId', 'Select Stock/Item:') !!}
                        <select name="StockId" id="StockId" class="form-control">
                           <option></option>
                           @foreach ($stocks as $item)
                               <option value="{{ $item->id }}">{{ $item->StockName }}</option>
                           @endforeach
                           <option value="new">-- Create New Stock --</option>
                        </select>
                    </div>
                    
                     <!-- Quantity Field -->
                     <div class="form-group col-sm-6">
                        {!! Form::label('Quantity', 'Quantity:') !!}
                        {!! Form::number('Quantity', null, ['class' => 'form-control', 'required' => 'true']) !!}
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
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('stocks.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

{{-- NEW STOCKS --}}
<div class="modal fade" id="modal-new-stock" aria-hidden="true" style="display: none;">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h4 class="modal-title">Add New Stock Data</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
               </button>
           </div>
           <div class="modal-body">
               <div class="row">
                  <div class="form-group col-lg-12">
                       <label for="StockName">Stock Name <span class="text-danger">*</span></label>
                       <input type="text" id="StockName" autofocus=true class="form-control">
                  </div>
                  <div class="form-group col-lg-12">
                       <label for="Description">Description</label>
                       <input type="text" id="Description" class="form-control">
                  </div>
                  <div class="form-group col-lg-12">
                     <label for="Type">Type</label>
                     <select name="Type" id="Type" class="form-control">
                        <option value="Equipment">Equipment</option>
                        <option value="Tools">Tools</option>
                        <option value="Inventoriable">Inventoriable</option>
                        <option value="Supply">Supply</option>
                     </select>
                  </div>
                  <div class="form-group col-lg-12">
                     <label for="Units">Units</label>
                     <select name="Units" id="Units" class="form-control">
                        <option value="pcs">Pieces</option>
                        <option value="mtrs">Meters</option>
                        <option value="ft">Foot</option>
                     </select>
                  </div>
                  <div class="form-group col-lg-12">
                     <label for="RetailPrice">Retail Price</label>
                     <input type="number" id="RetailPrice" class="form-control">
                  </div>
                  <div class="form-group">
                     <label>Can Be Sold To Customer</label>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="CanBeChargedToCustomer" id='CanBeChargedToCustomerYes' value="Yes">
                         <label class="form-check-label" for="CanBeChargedToCustomerYes">Yes</label>
                     </div>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="CanBeChargedToCustomer" id='CanBeChargedToCustomerNo' value="No" checked>
                         <label class="form-check-label" for="CanBeChargedToCustomerNo">No</label>
                     </div>
                 </div>
               </div>
           </div>
           <div class="modal-footer">
               <button class="btn btn-primary" id="add-btn"><i class="fas fa-forward ico-tab-mini"></i>Submit</button>
           </div>
       </div>
   </div>
</div>

@push('page_scripts')
    <script>
      $(document).ready(function() {
         $('#StockId').change(function(){ 
            var value = $(this).val();
            if (value == 'new') {
               $('#modal-new-stock').modal('show')
            }
         });

         $('#add-btn').on('click', function() {
            if (jQuery.isEmptyObject($('#StockName').val())) {
               Toast.fire({
                  icon : 'warning',
                  text : 'Please provide stock name!'
               })
            } else {
               addNewStock()
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
