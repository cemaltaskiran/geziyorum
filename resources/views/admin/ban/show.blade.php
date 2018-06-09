@extends('layouts.admin_layout') @section('title', 'Ban:'.$ban->name) @section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('admin.user.show', ['username' => $reported->user->username]) }}">< Back</a>
    </div>
</div>
<hr> 
@if (session('update'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>{{ session('update') }}</strong> is updated.
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.ban.update', ['id' => $ban->id]) }}" id="punishForm">
            @csrf
            <div class="form-group row ">
                <label class="col-md-3 col-form-label text-md-right">Username</label>
                <div class="col-md-9">
                    {{$reported->user->username}}
                </div>
            </div>

            <div class="form-group row ">
                <label class="col-md-3 col-form-label text-md-right">Reason</label>
                <div class="col-md-9">
                    {{$ban->report->complaint->name}}
                </div>
            </div>

            <div class="form-group row">
                <label for="message" class="col-md-3 col-form-label text-md-right">Message</label>
                <div class="col-md-9">
                    <textarea id="message" name="message" class="form-control" rows="2" required>{{$ban->message}}</textarea>
                    @if ($errors->has('message'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row" id="tout">
                <label for="timeout" class="col-md-3 col-form-label text-md-right">Timeout</label>
                <div class="col-md-9">
                    <div class="input-group date form_datetime col-md-12" data-date="" data-link-field="timeout">
                        <input class="form-control" size="16" type="text" value="{{$ban->timeout}}" id="toutText">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    @if ($errors->has('timeout'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('timeout') }}</strong>
                        </span>
                    @endif
                    <input type="hidden" id="timeout" name="timeout" value="{{$ban->timeout}}"/>
                </div>
            </div>

            <div class="form-group row">
                <label for="perma" class="col-md-3 col-form-label text-md-right">Permanent ban</label>
                <div class="col-md-9">
                    <input type="checkbox" name="perma" id="perma">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">
                        update
                    </button>
                </form>
                </div>
                <div class="col-md-1">
                    <form action="{{ route('admin.ban.destroy', ['id' => $ban->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this punishment?');">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function isEmpty( el ){
            return !$.trim(el.html())
        }
        $('.form_datetime').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            format: 'yyyy-mm-dd hh:ii:ss'
        });
        var oldTime;
        $("#perma").change(function(){
            if($(this).is(':checked')) {
                oldTime = $("#timeout").val();
                $("#timeout").val("2099-12-31 00:00:00");
                $("#tout").fadeOut();

            } else {
                $("#timeout").val(oldTime);
                $("#tout").fadeIn();
            }
        });
        $("#punishForm").submit(function() {
            if (!$('#timeout').val()) {
                alert("Please set a timeout date!");
                $('#toutText').focus();
                return false;
            }
        });
    </script>
@endsection