@extends('layouts.app')

@section('content')
<div class="container">
  <div class='col-md-6 col-md-offset-3'>
  <h1>Edit {{ $account->name }}</h1>
  <a href="{{ URL::to('accounts') }}" class="btn btn-default">Back</a>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::model($account, array('route' => array('accounts.update', $account->id), 'method' => 'PUT')) }}

  <div class="form-group">
      {{ Form::label('name', 'Name') }}
      {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
      {{ Form::label('address', 'Address') }}
      {{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
      {{ Form::label('country', 'Country') }}
      {{ Form::text('country', Input::old('address'), array('class' => 'form-control')) }}
  </div>
  <div class="form-group">
      {{ Form::label('tax_number', 'Tax Number') }}
      {{ Form::text('tax_number', Input::old('address'), array('class' => 'form-control')) }}
  </div>
  <div class="form-group">
      {{ Form::label('phone_number', 'Phone Number') }}
      {{ Form::text('phone_number', Input::old('address'), array('class' => 'form-control')) }}
  </div>

      {{ Form::submit('Edit Account', array('class' => 'btn btn-primary')) }}

  {{ Form::close() }}

</div>
</div>
@stop
