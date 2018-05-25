<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Geziyorum Admin @if ($__env->yieldContent('title'))- @yield('title') @endif</title>

    <link href="/admin_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin_assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="/admin_assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="/admin_assets/vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="/admin_assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/admin_assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('admin.index')}}">Geziyorum Admin</a>
            </div>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Category<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('admin.category.index') }}">List</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.category.create') }}">Create</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('admin.user.index') }}">List</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.user.create') }}">Create</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-flag fa-fw"></i> Complaint<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('admin.complaint.index') }}">List</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.complaint.create') }}">Create</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('admin.report.index') }}"><i class="fa fa-exclamation fa-fw"></i> Reports</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('title')</h1>
                </div>
            </div>

            @yield('content')
        </div>

    </div>

    <script src="/admin_assets/vendor/jquery/jquery.min.js"></script>
    <script src="/admin_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admin_assets/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="/admin_assets/vendor/raphael/raphael.min.js"></script>
    <script src="/admin_assets/vendor/morrisjs/morris.min.js"></script>
    <script src="/admin_assets/data/morris-data.js"></script>
    <script src="/admin_assets/js/sb-admin-2.js"></script>
    <script src="/admin_assets/js/bootstrap-datetimepicker.min.js"></script>
    @yield('script')

</body>

</html>