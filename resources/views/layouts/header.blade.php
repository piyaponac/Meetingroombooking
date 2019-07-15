
        <header class="topbar" style="background: #375f1f;">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- Light Logo icon -->
                            <img src="{!! asset('assets/images/mju_logo.gif') !!}" width="40" height="40" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- dark Logo text -->
                         <img src="{!! asset('assets/images/logo-text.png') !!}" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="{!! asset('assets/images/logo-light-text1.png') !!}" width="149" height="70" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-sm-down search-box">
                            <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
                      
                        
                        
                    </ul>
                  
                    <ul class="navbar-nav my-lg">
                        @if(!Auth::guest()) 
                        <li class="nav-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                         </li> 
                       
                        @else
                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown"  aria-expanded="false"> <i class="fa fa-user"> Login</i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                            
                            <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="username" class="col-md-12 control-label">Username</label>

                                    <div class="col-md-12">
                                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-12 control-label">Password</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 control-label">
                                        <div class="checkbox">
                                        <label class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remember"  class="custom-control-input" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                <span class="custom-control-indicator"></span>
                                            

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 ">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </form>
                            </div>
                            
                            </div>
                        </li>
                        @endif
                    </ul>
                    
                    
                   
                </div>
            </nav>
        </header>
     

   
