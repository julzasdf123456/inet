<!-- Ticketname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('TicketName', 'Ticketname:') !!}
    {!! Form::text('TicketName', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Notes', 'Notes:') !!}
    {!! Form::text('Notes', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>