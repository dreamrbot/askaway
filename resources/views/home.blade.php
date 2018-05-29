@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>
                  <a href="{{url('/home/dashboard')}}" class="btn btn-default">Dashboard</a>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{url('/upload')}}">Upload</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">

            <div class="panel-heading">Videos</div>

              <div class="panel-body">

              </div>

    </div>
  </div>
</div>
@endsection
