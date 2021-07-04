<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for DataTables -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/datatables/buttons.dataTables.min.css')}}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('mhreja/assets/css/toastr.css')}}">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{asset('mhreja/assets/images/favicon.png')}}">

    <!-- App CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles

    <!-- Extra CSS-->
    @yield('head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-question"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }} </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @auth
            @if (Auth::user()->is_admin ==1)
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{Route::current()->getName() == 'dashboard' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item {{Route::current()->getName() == 'users.index' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('users.index')}}">
                    <i class="fa fa-users"></i>
                    <span>Users</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item @if(in_array(Route::current()->getName(), ['subjects.index',
                'subjects.edit', 'topics.index',
                'topics.edit'])) active @endif">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-book"></i>
                    <span>Subjects & Topics</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Subjects BREAD :</h6>
                        <a class="collapse-item @if(in_array(Route::current()->getName(), ['subjects'])) active @endif"
                            href="{{route('subjects')}}">Subjects</a>
                        <a class="collapse-item @if(in_array(Route::current()->getName(), ['topics'])) active @endif"
                            href="{{route('topics')}}">Topics</a>
                    </div>
                </div>
            </li>

            <li class="nav-item @if(in_array(Route::current()->getName(), ['questions.index',
                'questions.show', 'questions.edit'])) active @endif">
                <a class="nav-link" href="{{route('questions.index')}}">
                    <i class="fas fa-question"></i>
                    <span>Questions</span></a>
            </li>

            <li class="nav-item @if(in_array(Route::current()->getName(), ['answers.index',
                'answers.show', 'answers.edit'])) active @endif">
                <a class="nav-link" href="{{route('answers.index')}}">
                    <i class="fas fa-pen"></i>
                    <span>Answers</span></a>
            </li>
            @endif

            @if(Auth::user()->is_admin ==0)
            <li class="nav-item @if(in_array(Route::current()->getName(), ['profile.show'])) active @endif">
                <a class="nav-link" href="{{route('profile.show')}}">
                    <i class="fas fa-user"></i>
                    <span>My Profile</span></a>
            </li>

            <li class="nav-item @if(in_array(Route::current()->getName(), ['my-questions'])) active @endif">
                <a class="nav-link" href="{{route('my-questions')}}">
                    <i class="fas fa-question"></i>
                    <span>My Questions</span></a>
            </li>
            @endif
            @endauth

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle" onclick="sidebartoggle();"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <div class="d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100">
                        <span class="greetings text-success font-weight-bold"></span>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow mr-4 d-sm-none">
                            <!-- Show Greetings on Mobile -->
                            <span class="greetings text-success font-weight-bold"
                                style="height: 4.375rem;display: flex;align-items: center;padding: 0 .75rem;"></span>
                        </li>



                        <li class="nav-item dropdown no-arrow d-none d-sm-block">
                            <span class="time text-danger"
                                style="height: 4.375rem;display: flex;align-items: center;padding: 0 .75rem;"><i
                                    class="fa fa-clock"></i></span>
                        </li>

                        <div class="topbar-divider"></div> <!-- d-none d-sm-block -->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
                                <img class="img-profile rounded-circle" src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->name }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('profile.show')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                                    <i class="fas fa-tags fa-sm fa-fw mr-2 text-gray-400"></i>
                                    API Tokens
                                </a>
                                @endif

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>
                            Copyright &copy; {{ config('app.name', 'Laravel') }} {{date('Y')}}
                            |
                            Powered By <strong>Md Hossain Reja</strong>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Jquery Validation  -->
    <script src="{{asset('mhreja/assets/js/jquery.validate.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Charts -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Charts -->
    {{-- <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-bar-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script> --}}

    <!-- DataTables -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/buttons.flash.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/buttons.print.min.js')}}"></script>


    <!-- Alerts -->
    <script src="{{asset('mhreja/assets/js/sweetalert.js')}}"></script>
    <script src="{{asset('mhreja/assets/js/toastr.js')}}"></script>

    @include('frontend.layouts.alerts')

    <!-- DataTables -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    <!-- App JS -->
    <script src="{{asset('js/app.js')}}"></script>
    @livewireScripts


    <script>
        $(document).ready(function() {
          function dateTime() {
          var format="";
            var ndate = new Date();
            var hr = ndate.getHours();
            var h = hr % 12;
            
             if (hr < 12)
             {
                greet = 'Good Morning';
                format='AM';
                }
            else if (hr >= 12 && hr <= 17)
            {
                greet = 'Good Afternoon';
                format='PM';
                }
            else if (hr >= 17 && hr <= 24)
                greet = 'Good Evening';
            
            var m = ndate.getMinutes().toString();
            var s = ndate.getSeconds().toString();
            if (h < 12) {
              h = "0" + h;
              $(".greetings").html(greet);
            } else if (h < 18) {
              $(".greetings").html(greet);
            } else {
              $(".greetings").html(greet);
            }
            if (s < 10) {
              s = "0" + s;
            }
            if (m < 10) {
              m = "0" + m;
            }
            $('.time').html('<i class="fa fa-clock"></i>&nbsp'+h + ":" + m + ":" + s + format);
          }
          setInterval(dateTime, 1000);
        });
    </script>

    <!--Sidebar toggle remember -->
    <script>
        $(document).ready(function() {
            //If previously minimized then open menu in minimized mode
            if(localStorage.getItem("mini-navbar")){
                $("body").addClass("sidebar-toggled");
                $("#accordionSidebar").addClass("toggled");
            }
        });


        function sidebartoggle(){
            if(localStorage.getItem("mini-navbar")){
                localStorage.removeItem("mini-navbar");
            }else{
                localStorage.setItem("mini-navbar", Date.now());
            }
        }
    </script>

    <!-- Extra JS-->
    @yield('scripts')

</body>

</html>