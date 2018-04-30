@extends('layouts.admin_layout') @section('title', 'Users') @section('content')
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
    <div class="col-md-2">
        <form action="" method="get">
            <div class="form-group">
                <label>Show</label>
                <select class="form-control" name="show" id="show" onchange="this.form.submit()">
                    <option @if($show == 'all') selected @endif value="all">All</option>
                    <option @if($show == 'active') selected @endif value="active">Only Active</option>
                    <option @if($show == 'deleted') selected @endif value="deleted">Only Deleted</option>
                </select>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>username</th>
                            <th>e-mail</th>
                            <th>birthdate</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0) 
                            @foreach ($users as $user)
                                <tr @if ($user->deleted_at !== NULL) class="warning" @endif>
                                    <td><a href="{{ route('admin.user.show', ['username' => $user->username]) }}">{{ $user->username }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->birthdate }}</td>
                                    <td class="center">{{ $user->created_at }}</td>
                                    <td class="center">{{ $user->updated_at }}</td>
                                </tr>
                            @endforeach 
                        @else
                        <tr class="gradeA">
                            <td colspan="5">No results</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection