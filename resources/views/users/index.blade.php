@extends('layouts.app')

@section('title') Users @stop

@section('content')

<div class='col-md-6 col-md-offset-3'>
  <a href="{{ URL::to('home/dashboard') }}" class="btn btn-default">Back</a>
    <h1><i class="fa fa-users"></i> User Administration </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                </tr>
              @endforeach
          </tbody>
      </table>
  </div>

  <!-- <a href="/user/create" class="btn btn-success">Add User</a> -->

</div>

@stop
