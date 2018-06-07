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
    <form action="" method="get">
        <div class="col-md-2">    
            <div class="form-group">
                <label>Show</label>
                <select class="form-control" name="show" id="show" onchange="this.form.submit()">
                    <option @if($show == 'all') selected @endif value="all">All</option>
                    <option @if($show == 'active') selected @endif value="active">Only Active</option>
                    <option @if($show == 'deleted') selected @endif value="deleted">Only Deleted</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Username</label>
                <div class="input-group">
                    <input type="search" class="form-control" name="keyword" id="keyword" value="{{$keyword}}">
                    <span class="input-group-btn">
                        <button class="btn" type="button" onclick="$('#keyword').val('');">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                        <button class="btn btn-info" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
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
                            <th>username</th>
                            <th>e-mail</th>
                            <th>birthdate</th>
                            <th>Created at</th>
                            <th>Roles</th>
                            <th>Punish</th>
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
                                    <td class="center">
                                        @php
                                            $roles = array();
                                        @endphp
                                        @foreach ($user->roles as $role)
                                            @php
                                                $roles[] = $role->name;
                                            @endphp
                                        @endforeach
                                        {{implode(", ", $roles)}}
                                    </td>
                                    <td class="center">
                                        @if ($user->hasBan())
                                            <span class="badge badge-danger">Punished</span>
                                        @else
                                            <span class="badge badge-success">OK</span>
                                        @endif
                                    </td>
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