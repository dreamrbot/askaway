<div class='form-group'>
 {!! Form::label('name', 'Name:') !!}
 {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class='form-group'>
 {!! Form::label('address', 'address:') !!}
 {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class='form-group'>
 {!! Form::label('country', 'country:') !!}
 {!! Form::string('country', null, ['class' => 'form-control']) !!}
</div>

<div class='form-group'>
 {!! Form::label('tax_number', 'tax_number:') !!}
 {!! Form::string('tax_number', null, ['class' => 'form-control']) !!}
</div>

<div class='form-group'>
 {!! Form::label('phone_number', 'phone_number:') !!}
 {!! Form::string('phone_number', null, ['class' => 'form-control']) !!}
</div>

<div class='form-group'>
 {!! Form::submit($submitButtonText, ['class' => 'btn btn-lg btn-success form-control']) !!}
</div>
