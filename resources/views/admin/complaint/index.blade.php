@extends('layouts.admin_layout') @section('title', 'Complaints') @section('content') 
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($complaints) > 0) 
                            @foreach ($complaints as $complaint)
                                <tr class="gradeA">
                                    <td><a href="{{ route('admin.complaint.show', ['id' => $complaint->id]) }}">{{ $complaint->name }}</a></td>
                                    <td>{{ $complaint->description }}</td>
                                    <td>{{ $complaint->type }}</td>
                                    <td class="center">{{ $complaint->created_at }}</td>
                                    <td class="center">{{ $complaint->updated_at }}</td>
                                </tr>
                            @endforeach 
                        @else
                        <tr class="gradeA">
                            <td colspan="5">No results</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $complaints->links() }}
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection