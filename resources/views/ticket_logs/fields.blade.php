<!-- Ticketid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('TicketId', 'Ticketid:') !!}
    {!! Form::text('TicketId', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Userid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('UserId', 'Userid:') !!}
    {!! Form::text('UserId', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Logdetails Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LogDetails', 'Logdetails:') !!}
    {!! Form::text('LogDetails', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Notes', 'Notes:') !!}
    {!! Form::text('Notes', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
</div>