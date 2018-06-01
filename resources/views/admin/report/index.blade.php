@extends('layouts.admin_layout') @section('title', 'Reports') @section('content') 
@if (session('delete'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>{{ session('delete') }}</strong> is deleted.
            </div>
        </div>
    </div>
@endif
<div class="row">
    <form action="" method="get">
        <div class="col-md-2">
            <div class="form-group">
                <label>Show</label>
                <select class="form-control" name="resolved" id="resolved" onchange="this.form.submit()">
                    <option @if($resolved == 'all') selected @endif value="all">All</option>
                    <option @if($resolved == 'no') selected @endif value="no">Not resolved</option>
                    <option @if($resolved == 'yes') selected @endif value="yes">Resolved</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Type</label>
                <select class="form-control" name="type" id="type" onchange="this.form.submit()">
                    <option @if($type == 'all') selected @endif value="all">All</option>
                    <option @if($type == 'trip') selected @endif value="trip">Trip</option>
                    <option @if($type == 'user') selected @endif value="user">User</option>
                    <option @if($type == 'media') selected @endif value="media">Media</option>
                    <option @if($type == 'comment') selected @endif value="comment">Comment</option>
                </select>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Type#ID</th>
                            <th>Complaint</th>
                            <th>Status</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($reports) > 0) 
                            @foreach ($reports as $report)
                                <tr class="gradeA">
                                <td><a href="{{ route('admin.report.show', ['id' => $report->id]) }}">{{ $report->complaintable_type }}#{{ $report->complaintable_id }}</a></td>
                                    <td>{{ $report->complaint->name }}</td>
                                    <td class="center">
                                        @if ($report->resolved)
                                            <span class="badge badge-success">Resolved</span>
                                        @else
                                            <span class="badge badge-danger">Not resolved</span>
                                        @endif
                                    </td>
                                    <td class="center">{{ $report->created_at }}</td>
                                </tr>
                            @endforeach 
                        @else
                        <tr class="gradeA">
                            <td colspan="4">No results</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $reports->links() }}
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection