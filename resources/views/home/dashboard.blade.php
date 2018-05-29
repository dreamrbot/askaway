@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <a href="{{url('/home')}}" class="btn btn-default">Home</a>
                <a href="{{url('accounts')}}" class="btn btn-default">Business Accounts</a>
                <a href="{{url('user')}}" class="btn btn-default">Users</a>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif



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
            <a href="{{url('/upload')}}" class="btn btn-default">Upload</a>
              <div class="panel-body">
                @if ($message = Session::get('success'))
                <img src="videos/{{ Session::get('video') }}">
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(array('route' => 'video.upload.post','files'=>true)) !!}
                    <div class="row">
                        <div class="col-md-8">
                            {!! Form::file('video', array('class' => 'form-control')) !!}
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info">Upload</button>
                        </div>
                    </div>
                {!! Form::close() !!}
              </div>
    </div>
  </div>
</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">

            <div class="panel-heading">Campaigns</div>
              <div class="panel-body">

//create campaign, select video, input response limit, input demographic, on questions controller-> getQuestions
//check demographic, view all campaigns-> running campaigns finished campaigns, stopped Campaigns
//video thumbnails

                    {!! Form::open(array('route' => 'video.upload.post','files'=>true)) !!}
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::checkbox('name', 'value'); !!}<label>test</label>
                                {!!Form::radio('name', 'value', true); !!}
                            </div>
                            <div class="col-md-6">

                                <button type="submit" class="btn btn-info">Create Campaign</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
              </div>
    </div>
  </div>
</div>
</div>
@endsection
<script type="text/javascript" src="{{ URL::asset('js/hide.js') }}"></script>
<style>
#form1 {
    display : none;
}
</style>
