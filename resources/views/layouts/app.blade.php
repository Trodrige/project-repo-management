<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--><html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ProjectManaga</title>
    <meta name="description" content="ProjectManaga Admin Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts
    <script src="{{ asset('js/app.js') }}" defer></script>  -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.less') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/scss/style.css') }}">
    <link href="{{ asset('assets/css/lib/vector-map/jqvmap.min.css') }}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>

     <style>
         .go-top {
     	position: fixed;
     	bottom: 2em;
     	right: 2em;
     	text-decoration: none;
     	color: white;
     	background-color: rgba(0, 0, 0, 0.3);
     	font-size: 12px;
     	padding: 1em;
     	display: none;
         }

         .go-top:hover {
     	    background-color: rgba(0, 0, 0, 0.6);
         }
     </style>

        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <!--    <a class="navbar-brand" href="./"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                        <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo2.png') }}" alt="Logo"></a>
                -->
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{ route('home') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>


                    <li>
                         <a href="/home#upload"><i class="menu-icon fa fa-upload"></i> Upload Project</a>
                     </li>
                     <li>
                         <a href="/myprojects"><i class="menu-icon fa fa-download"></i> Download project</a>
                     </li>
                     <li>
                         <a href="/myprojects"><i class="menu-icon fa fa-folder-open"></i> My projects</a>
                     </li>
                     <li>
                         <a href="{{ route('projects') }}"><i class="menu-icon fa fa-archive"></i> All projects</a>


                    <h3 class="menu-title">Users</h3><!-- /.menu-title -->
                    <li>
                        <a href="{{ route('users') }}"> <i class="menu-icon fa fa-users"></i>All users</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-adn"></i>Admins</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-suitcase"></i><a href="{{ route('admins') }}">All admins</a></li>
                            <li><i class="fa fa-check-square-o"></i><a href="{{ route('validadmins') }}">Valid admins</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="{{ route('pendingadmins') }}">Pending validation</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('students') }}"> <i class="menu-icon fa fa-male"></i>Students</a></li>
                    <!-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Students</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ route('students') }}">All students</a></li>
                            <li><i class="fa fa-table"></i><a href="{{ route('finalyearstudents') }}">Final year students</a></li>
                            <li><i class="fa fa-table"></i><a href="{{ route('internshipstudents') }}">Internship students</a></li>
                        </ul>
                    </li> -->

                    <h3 class="menu-title">Projects</h3><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Projects</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-book"></i><a href="{{ route('projects') }}">All projects</a></li>
                            <li><i class="menu-icon fa fa-check-square-o"></i><a href="{{ route('validatedprojects') }}">Validated projects</a></li>
                            <li><i class="menu-icon fa fa-tasks"></i><a href="{{ route('wipprojects') }}">Work In Progress</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Final year Projects</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ route('finalyearprojects') }}">All Final year Projects</a></li>
                            <li><i class="menu-icon fa fa-check-square-o"></i><a href="{{ route('validatedfypprojects') }}">Validated FYPs</a></li>
                            <li><i class="menu-icon fa fa-tasks"></i><a href="{{ route('wipfypprojects') }}">Work In Progress</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Internship Projects</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-area-chart"></i><a href="{{ route('internshipprojects') }}">All Internship projects</a></li>
                            <li><i class="menu-icon fa fa-check-square-o"></i><a href="{{ route('validatedinternshipprojects') }}">Validated Internships</a></li>
                            <li><i class="menu-icon fa fa-tasks"></i><a href="{{ route('wipinternshipprojects') }}">Work In Progress</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-puzzle-piece"></i>Course Projects</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-area-chart"></i><a href="{{ route('courseprojects') }}">All course projects</a></li>
                            <li><i class="menu-icon fa fa-check-square-o"></i><a href="{{ route('validatedcourseprojects') }}">Validated Course project</a></li>
                            <li><i class="menu-icon fa fa-tasks"></i><a href="{{ route('wipcourseprojects') }}">Work In Progress</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Extras</h3><!-- /.menu-title -->
                    <li>
                        <a href="{{ route('adminprofile') }}"> <i class="menu-icon fa fa-user"></i>Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('settings') }}"> <i class="menu-icon fa fa-gears"></i>Settings</a>
                    </li>
                    <li>
                        <a class="nav-link dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"> <i class="menu-icon fa fa-lock"></i>
                            {{ __('Logout') }}
                        </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger">5</span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="notification">
                            <p class="red">You have 3 Notification</p>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                            <a class="dropdown-item media bg-flat-color-4" href="#">
                                <i class="fa fa-info"></i>
                                <p>Server #2 overloaded.</p>
                            </a>
                            <a class="dropdown-item media bg-flat-color-5" href="#">
                                <i class="fa fa-warning"></i>
                                <p>Server #3 overloaded.</p>
                            </a>
                          </div>
                        </div>

                        <div class="dropdown for-message">
                          <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-email"></i>
                            <span class="count bg-primary">9</span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="message">
                            <p class="red">You have 4 Mails</p>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <span class="photo media-left"><img alt="avatar" src="{{ asset('images/avatar/1.jpg') }}"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jonathan Smith</span>
                                    <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                            <a class="dropdown-item media bg-flat-color-4" href="#">
                                <span class="photo media-left"><img alt="avatar" src="{{ asset('images/avatar/2.jpg') }}"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jack Sanders</span>
                                    <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                            <a class="dropdown-item media bg-flat-color-5" href="#">
                                <span class="photo media-left"><img alt="avatar" src="{{ asset('images/avatar/3.jpg') }}"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Cheryl Wheeler</span>
                                    <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                            <a class="dropdown-item media bg-flat-color-3" href="#">
                                <span class="photo media-left"><img alt="avatar" src="{{ asset('images/avatar/4.jpg') }}"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Rachel Santos</span>
                                    <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <!-- Authentication Links -->
                    @guest
                        <div class="user-area top-right links float-right">
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>&nbsp;&nbsp;
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </div>
                    @else
                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>{{ Auth::user()->firstname }}</span>&nbsp;
                                <img class="user-avatar rounded-circle" src="{{ asset('images/admin.jpg') }}" alt="User Avatar">
                            </a>

                            <div class="user-menu dropdown-menu">
                                <a class="nav-link dropdown-item" href="{{ route('myprojects') }}">{{ __('My projects') }}</a>

                                <a class="nav-link dropdown-item" href="">{{ __('Profile') }}</a>

                                <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                                <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                                <a class="nav-link dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language" >
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">

            <div class="col-sm-12" id="session_message">
                @yield('message')
            </div>

            <div class="content mt-3">
                <main class="py-4">
                    @yield('content')
                </main>
            </div> <!-- .content -->




        </div> <!-- .content -->

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{ asset('assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="{{ asset('assets/js/lib/chart-js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.js') }}"></script>
    <script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.world.js') }}"></script>
    <script>
        jQuery(function($) {
            // This function is to hide the "Note" and session alerts after 15seconds
            setTimeout(function(){
                $("#session_message").hide();
            }, 15000);

            // Show or hide the sticky footer button
 			$(window).scroll(function() {
 				if ($(this).scrollTop() > 200) {
 					$('.go-top').fadeIn(200);
 				} else {
 					$('.go-top').fadeOut(200);
 				}
 			});

 			// Animate the scroll to top
 			$('.go-top').click(function(event) {
 				event.preventDefault();

 				$('html, body').animate({scrollTop: 0}, 300);
 			});

            $('#edit-admin').on('show.bs.modal', function(e){
            $('#edit-admin #firstname').val($(e.relatedTarget).data('firstname'));
            $('#edit-admin #lastname').val($(e.relatedTarget).data('lastname'));
            $('#edit-admin #email').val($(e.relatedTarget).data('email'));
            $('#edit-admin #role').val($(e.relatedTarget).data('role'));
            $('#edit-admin #is_admin').val($(e.relatedTarget).data('is_admin'));
            $('#edit-admin-form').submit(function(){
                var id = $('#edit-admin #id').val($(e.relatedTarget).data('id'));
                var newFirstname = $('#edit-admin #firstname').val();
                var newLastname = $('#edit-admin #lastname').val();
                var newEmail = $('#edit-admin #email').val();
                var newRole = $('#edit-admin #role').val();
                var newIsadmin = $('#edit-admin #is_admin').val();
                $("#edit-admin-form").attr("action", "/admin/" + id );
            });
        });

        /*** Delete user ***/
        $('#delete-admin').on('show.bs.modal', function(e){
            $('#delete-admin #firstname').text($(e.relatedTarget).data('firstname'));
            $('#delete-admin-form').submit(function(){
                var id = $('#delete-admin #id').val($(e.relatedTarget).data('id'));
                $("#delete-admin-form").attr("action", "admin/" + id);
            });
        });

        /*** Delete project ***/
        $('#delete-project').on('show.bs.modal', function(e){
            $('#delete-project #title').text($(e.relatedTarget).data('title'));
            $('#delete-project-form').submit(function(){
                var id = $('#delete-project #id').val($(e.relatedTarget).data('id'));
                $("#delete-project-form").attr("action", "myprojects/delete-project" + id);
            });
        });


        });

        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>

     <footer>
         <a href="#" class="go-top">Top</a>
     </footer>

    @yield('javascript')

</body>
</html>
