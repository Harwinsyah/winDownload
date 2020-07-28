<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Maniak Download</title>        

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-4.0.0/css/bootstrap.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('plugins/ionicons-master/css/ionicons.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/css/dataTables.bootstrap4.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('plugins/popper/css/popper.css') }}">    
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui-1.12.1/jquery-ui.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2-bootstrap4.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">    

    @yield('css')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            @guest
                <a class="navbar-brand" href="{{ url('/') }}">
                    Maniak Download
                </a>                                        
                @else                
                <button type="button" id="sidebarCollapse" class="btn btn-link navbar-brand">
                    <span class="fas fa-align-justify"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    Maniak Download
                </a> 
            @endguest
        </nav>

        <main class="py-3">            
            <div class="overlay"></div>
            <div class="wrapper">
                <nav id="sidebar">
                    <div id="dismiss">
                        <i class="fas fa-arrow-left"></i>
                    </div>
        
                    <ul class="list-unstyled components">
                        <p>POS MENU</p>
                        <li>
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Charts <span class="fas fa-angle-down"></span></a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li>
                                    <a href="#">Chart 1</a>
                                </li>
                                <li>
                                    <a href="#">Chart 2</a>
                                </li>
                                <li>
                                    <a href="#">Chart 3</a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ Request::is('order')? 'active': '' }}">
                            <a href="/order">Order</a>
                        </li>
                        <li class="{{ Request::is('film')? 'active': '' }}">
                            <a href="/film">Film </a>                        
                        </li>
                        <li class="{{ Request::is('genre')? 'active': '' }}">
                            <a href="/genre">Genre </a>                        
                        </li>
                        <li class="{{ Request::is('penyimpanan')? 'active': '' }}">
                            <a href="/penyimpanan">Penyimpanan </a>
                        </li>
                        <li class="{{ Request::is('cancel')? 'active': '' }}">
                            <a href="/cancel">Cancel </a>                        
                        </li>
                        <li class="{{ Request::is('pelanggan')? 'active': '' }}">
                            <a href="/pelanggan">Pelanggan</a>
                        </li>
                        <li class="{{ Request::is('user')? 'active': '' }}">
                            <a href="/user">User</a>
                        </li>
                        <li class="{{ Request::is('accounting')? 'active': '' }}">
                            <a href="/accounting">Accounting</a>
                        </li>
                        <li class="{{ Request::is('situs')? 'active': '' }}">
                            <a href="/situs">Situs</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('plugins/jQuery/jquery-3.4.1.min.js') }}"></script>    
    <script src="{{ asset('plugins/fontawesome/js/solid.min.js') }}"></script>
    <script src="{{ asset('plugins/fontawesome/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('plugins/popper/js/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/malihu-custom-scrollbar-plugin-master/js/uncompressed/jquery.mCustomScrollbar.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/typeahead.js-master/dist/typeahead.jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/autocomplete/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/jQuery-Mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-4.0.0/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });
    
            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });
    
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>    
    @yield('js')
</body>
</html>
