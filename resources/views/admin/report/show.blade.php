@extends('layouts.admin_layout') 
@section('title', 'Report: '.$report->complaintable_type.'#'.$report->complaintable_id)
 @section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.report.index') }}">< Back</a>
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
    <div class="row report-item">
        <div class="col-md-3 report-th">
            Complaint Name
        </div>
        <div class="col-md-9">
            {{ $report->complaint->name }}
        </div>
    </div>
    <div class="row report-item">
        <div class="col-md-3 report-th">
            Complaint Description
        </div>
        <div class="col-md-9">
            {{ $report->complaint->description }}
        </div>
    </div>
    <div class="row report-item">
        <div class="col-md-3 report-th">
            Is resolved?
        </div>
        <div class="col-md-9">
            @if ($report->resolved)
                true
            @else 
                false
            @endif
        </div>
    </div>
    <div class="row report-item">
        <div class="col-md-3 report-th">
            Actions
        </div>
        <div class="col-md-9">
            @if ($report->complaintable_type == 'trip')
                <a href="{{ route('trip.show', ['url' => $reported->url]) }}" class="badge" target="_blank">See reported content</a>
                @if (!$reported->freeze)
                    <a href="#freeze" onclick="$('#freezeModal').modal('show')" class="badge badge-primary">Freeze</a>
                @else
                    <a href="#unfreeze" class="badge badge-primary" onclick="$('#unfreezeModal').modal('show')">Unfreeze</a>
                @endif
                @if (!$reported->trashed())
                    <a href="#hide" onclick="$('#hideModal').modal('show')" class="badge badge-info">Hide</a>
                @else
                    <a href="#unhide" class="badge badge-info" onclick="$('#unhideModal').modal('show')">Restore</a>
                @endif
                <a href="#punish" class="badge badge-danger" onclick="$('#punishModal').modal('show')">Punish owner of content</a>
                @if (!$report->resolved)
                    <a href="#resolve" class="badge badge-success" onclick="$('#resolveModal').modal('show')">Set as resolved</a>
                @else
                    <a href="#unresolve" class="badge badge-dark" onclick="$('#unresolveModal').modal('show')">Set as unresolved</a>
                @endif

                <!-- Freeze Modal -->
                <div class="modal fade" id="freezeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Freeze Trip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            Are you sure to freze this trip?
                        </div>
                        <div class="modal-footer">
                        <form method="POST" action="{{ route('admin.trip.freeze', ['id' => $reported->id]) }}">
                            @csrf
                            <input type="hidden" name="report_id" value="{{ $report->id }}">
                            <button type="submit" class="btn btn-primary">Freeze</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Unfreeze Modal -->
                <div class="modal fade" id="unfreezeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Unfreeze Trip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            Are you sure to unfreze this trip?
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="{{ route('admin.trip.unfreeze', ['id' => $reported->id]) }}">
                                @csrf
                                <input type="hidden" name="report_id" value="{{ $report->id }}">
                                <button type="submit" class="btn btn-primary">Unfreeze</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Hide Modal -->
                <div class="modal fade" id="hideModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hide Trip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            Are you sure to hide this trip?
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="{{ route('admin.trip.hide', ['id' => $reported->id]) }}">
                                @csrf
                                <input type="hidden" name="report_id" value="{{ $report->id }}">
                                <button type="submit" class="btn btn-primary">Hide</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Unhide Modal -->
                <div class="modal fade" id="unhideModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Unhide Trip</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Are you sure to unhide this trip?
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="{{ route('admin.trip.unhide', ['id' => $reported->id]) }}">
                                    @csrf
                                    <input type="hidden" name="report_id" value="{{ $report->id }}">
                                    <button type="submit" class="btn btn-primary">Unhide</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resolve Modal -->
                <div class="modal fade" id="resolveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Resolve this report</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Are you sure to set as resolved this report?
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="{{ route('admin.report.resolve', ['id' => $report->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Set as resolved</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Unresolve Modal -->
                <div class="modal fade" id="unresolveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Unresolve this report</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Are you sure to set as unresolved this report?
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="{{ route('admin.report.unresolve', ['id' => $report->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Set as unresolved</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Punish Modal -->
                <div class="modal fade" id="punishModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Punish the user</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form method="POST" action="{{ route('admin.report.unresolve', ['id' => $report->id]) }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group row ">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">name</label>
                                        <div class="col-md-8">
                                            <input id="name" type="text" class="form-control" name="name" value="" required=""> 
                                        </div>
                                    </div>
                        
                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right">description</label>
                                        <div class="col-md-8">
                                            <input id="description" type="text" class="form-control" name="description" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Punish</button>                                
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row report-item">
        <div class="col-md-3 report-th">
            Action History
        </div>
        <div class="col-md-9">
            @if (count($report->history) > 0)
                @php $key=1 @endphp
                @foreach ($report->history as $item)
                    <div>{{$key++}}. {{$item->action}} on {{$item->created_at}}</div>
                @endforeach
            @else
                <div>No action taken so far.</div>
            @endif
        </div>
    </div>
    
@endsection