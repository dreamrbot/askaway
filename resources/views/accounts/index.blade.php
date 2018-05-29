@extends('layouts.app')

@section('content')
<div class="container">

 <h1>Business Accounts</h1>
 <a href="{{url('home/dashboard')}}" class="btn btn-default">Back</a>
 <a href="{{ URL::to('accounts') }}" class="btn btn-default">View All accounts</a>
 <a href="{{ URL::to('accounts/create') }}" class="btn btn-default">Create an account</a>
</div>

<div class="container">
  <h1>All the Accounts</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Address</td>
            <td>Country</td>
            <td>Tax number</td>
            <td>Phone Number</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
    @foreach($accounts as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->address }}</td>
            <td>{{ $value->country }}</td>
            <td>{{ $value->tax_number }}</td>
            <td>{{ $value->phone_number }}</td>


            <td>



                {{ Form::open(array('url' => 'accounts/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Account', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

                <a class="btn btn-small btn-success" href="{{ URL::to('accounts/' . $value->id) }}">View this Account</a>

                
                <a class="btn btn-small btn-info" href="{{ URL::to('accounts/' . $value->id . '/edit') }}">Edit this Account</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</div>
@endsection
