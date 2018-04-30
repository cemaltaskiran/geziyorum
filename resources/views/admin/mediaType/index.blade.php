@extends('layouts.admin_layout') @section('title', 'Media Types') @section('content') 
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
                            <th>#</th>
                            <th>Name</th>
                            <th>Path</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($mediaTypes) > 0) 
                            @foreach ($mediaTypes as $mediaType)
                                <tr class="gradeA">
                                    <td>{{ $mediaType->id }}</td>
                                    <td><a href="{{ route('admin.mediaType.show', ['name' => $mediaType->name]) }}">{{ $mediaType->name }}</a></td>
                                    <td>{{ $mediaType->path }}</td>
                                    <td class="center">{{ $mediaType->created_at }}</td>
                                    <td class="center">{{ $mediaType->updated_at }}</td>
                                </tr>
                            @endforeach 
                        @else
                        <tr class="gradeA">
                            <td colspan="5">No results</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $mediaTypes->links() }}
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection