<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (Auth::check()) 
    <meta name="user_id" content="{{ Auth::user()->teacher_id }}" />
    @endif 
    <title>{{ config('app.name', 'EmeraldField Schools') }} |
        @yield('title')
    </title>

    <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    {{-- <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body id="page-top">
    <div id="app">
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        
              <!-- Sidebar - Brand -->
              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EmeraldField <sup>Portal</sup></div>
              </a>
        
              <!-- Divider -->
              <hr class="sidebar-divider my-0">
        
              <!-- Nav Item - Dashboard -->
              <li class="nav-item active">
                <a class="nav-link" href="index.html">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Teacher's Dashboard</span></a>
              </li>
        
              <!-- Divider -->
              <hr class="sidebar-divider">
        
              <!-- Heading -->
              <div class="sidebar-heading">
                Interface
              </div>
        
              
        
              <!-- Divider -->
              <hr class="sidebar-divider">
           
              <!-- Nav Item - Charts -->
              <li class="nav-item">
              <a class="nav-link" href="{{route('teacher.dashboard')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Biodata</span></a>
                </li>
              
              {{-- <li class="nav-item">
              <a class="nav-link" href="">
                  <i class="fas fa-fw fa-chart-area"></i>
                  <span>Current Class</span></a>
              </li> --}}
              <!-- Nav Item - Tables -->
              {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('teachers.index')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Previous Class</span></a>
                </li>
               --}}
                
              
        
              <!-- Divider -->
              <hr class="sidebar-divider d-none d-md-block">
        
              <!-- Sidebar Toggler (Sidebar) -->
              <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
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
                        
                        <button onclick="goBack()" class=" btn btn-warning text-white rounded-circle mr-3">Go Back</button>


                
                        
                
                        <!-- Topbar Navbar -->
                        <h5> Welcome!</h5>
                        <ul class="navbar-nav ml-auto">
                
                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            
                          
                
                            
                               
                
                            <div class="topbar-divider d-none d-sm-block"></div>
                
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                
                                
                                <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                                </a>
                            </div>
                            </li>
                
                        </ul>
                
                    </nav>
                    <main>
                        @yield('tboard')
                    </main>
                </div>
                <!-- End of Main Content -->
            
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <span>Copyright &copy; EmeraldField Schools {{date('Y')}}</span>
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a class="btn btn-primary" href="/logout">Logout</a>
              </div>
            </div>
          </div>
        </div>
    </div> 
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script>
      function goBack() {
        window.history.back();
      }
      </script>

      
      
        
  <!-- Page Wrapper -->
 
        <!-- End of Topbar -->
    </body>
      
    </html>