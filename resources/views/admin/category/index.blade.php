@extends('layouts.admin_layout') @section('title', 'Categories') @section('content') 
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
                            <th>Description</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($categories) > 0) 
                            @foreach ($categories as $category)
                                <tr class="gradeA">
                                    <td>{{ $category->id }}</td>
                                    <td><a href="{{ route('admin.category.show', ['name' => $category->name]) }}">{{ $category->name }}</a></td>
                                    <td>{{ $category->description }}</td>
                                    <td class="center">{{ $category->created_at }}</td>
                                    <td class="center">{{ $category->updated_at }}</td>
                                </tr>
                            @endforeach 
                        @else
                        <tr class="gradeA">
                            <td colspan="5">No results</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $categories->links() }}
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection