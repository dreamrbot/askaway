@extends('layouts.app')

@section('content')
<div class="container">
<div class='col-md-6 col-md-offset-3'>
<h1>Showing {{ $accounts->name }}</h1>
<a href="{{ URL::to('accounts') }}" class="btn btn-default">Back</a>
   <div class="jumbotron text-center">
       <h2>{{ $accounts->name }}</h2>
       <p>
           <strong>Credit:</strong> {{ $accounts->credit }}<br>
           <strong>User:</strong> {{ $accounts->user_id }}
       </p>
   </div>
 </div>
</div>
@stop
