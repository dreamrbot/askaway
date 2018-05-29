@extends('layouts.app')

@section('content')
<head>
  <script src="{{url('js/dropzone.js')}}"></script>
  <link rel="stylesheet" href="{{url('css/dropzone.css')}}">
  <script src="{{url('js/clipboard.min.js')}}"></script>
</head>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload</div>



                <div class="panel-body">
                    <form action="{{ url('/upload')}}" method="post" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="image">Upload Videos</label>
                        <input type="file"  name="image" id="image">
                        <button class="btn btn-default" type="submit">upload</button>
                      </div>
                    </form>
                    <!-- <form action="{{ url('/upload') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                      <label for="image">Upload Videos</label>
                        {{ csrf_field() }}
                  </form> -->

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script>
    Dropzone.options.myDropzone = {
        paramName: 'file',
        maxFilesize: 5, // MB
        maxFiles: 20,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        init: function() {
            this.on("success", function(file, response) {
                var a = document.createElement('span');
                a.className = "thumb-url btn btn-primary";
                a.setAttribute('data-clipboard-text','{{url('/uploads')}}'+'/'+response);
                a.innerHTML = "copy url";
                file.previewTemplate.appendChild(a);
            });
        }
    };
</script>
<script>
    $('.thumb-url').tooltip({
        trigger: 'click',
        placement: 'bottom'
    });

    function setTooltip(btn, message) {
        $(btn).tooltip('hide')
            .attr('data-original-title', message)
            .tooltip('show');
    }

    function hideTooltip(btn) {
        setTimeout(function() {
            $(btn).tooltip('hide');
        }, 500);
    }

    var clipboard = new Clipboard('.thumb-url');

    clipboard.on('success', function(e) {
        e.clearSelection();
        setTooltip(e.trigger, 'Copied!');
        hideTooltip(e.trigger);
    });

    clipboard.on('error', function(e) {
        e.clearSelection();
        setTooltip(e.trigger, 'Failed');
        hideTooltip(e.trigger);
    });
</script>
