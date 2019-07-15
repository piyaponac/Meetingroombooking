
   
   

    <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background: url({!! asset('assets/images/pro.PNG)') !!}no-repeat; ">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="{!! asset('assets/images/users/profile.png') !!}"  alt="user" /> </div>
                    <!-- User profile text-->
                  
                    <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                    @if(!Auth::guest()) {{ Auth::user()->name }} @endif</a>
                     
                        <div class="dropdown-menu animated flipInY">
                            <a href="{{ route('profile-edit') }}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            
                       
                            <div class="dropdown-divider"></div> <a href="login.html" class="dropdown-item" 
                                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                            ><i class="fa fa-power-off"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                            </div>
                    </div>
                </div>
                <!-- End User profile text &&Auth::user()->roles_id=='1'-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                    @if(!Auth::guest()&&Auth::user()->description=='superadmin')
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rename-box"></i><span class="hide-menu">จัดการห้องประชุม</span></a>
                            <ul aria-expanded="false" class="collapse">
                               
                                <li>
                                    <a    href="{{ route('room-meeting') }}" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu"> </span>รายการห้องประชุม </a>
                                    
                                </li>
                               
                                <li>
                                    <a   href="{{ route('building') }}" aria-expanded="false"><i class="mdi mdi-domain"></i><span class="hide-menu"> </span> รายการอาคาร</a>
                                    
                                </li>
                               
                       
                            </ul>
                        </li>
                    @endif
               
                     
                        <li>
                            <a class="waves-effect "   href="{{ route('room-detail-meeting') }}" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu"> รายละเอียดห้องประชุม </span></a>
                                    
                        </li>
                        <li>
                            <a class="waves-effect "   href="{{ route('booking-index') }}" aria-expanded="false"><i class="mdi mdi-calendar"></i><span class="hide-menu">ปฎิทินการจองห้องประชุม </span></a>
                            
                        </li>
                       
                       

                        @if(!Auth::guest())
                        <li>
                            <a  class="waves-effect "  href="{{ route('booking-create') }}" aria-expanded="false"><i class="mdi mdi-bookmark"></i><span class="hide-menu">จองห้องประชุม </span></a>
                            
                        </li>
                         @endif

                       

                         @if(!Auth::guest()&&Auth::user()->description=='superadmin')
                        <li>
                            <a class="waves-effect "    href="{{ route('booking-approve') }}" aria-expanded="false"><i class="mdi mdi-check"></i><span class="hide-menu">การอนุมัติการจอง </span></a>
                            
                        </li>
                        @endif
                        @if(!Auth::guest()&&Auth::user()->description=='admin')
                        <li>
                            <a class="waves-effect "    href="{{ route('booking-approve') }}" aria-expanded="false"><i class="mdi mdi-check"></i><span class="hide-menu">การอนุมัติการจอง </span></a>
                            
                        </li>
                        @endif
                        @if(!Auth::guest()&&Auth::user()->description=='superadmin')
                         <li>
                            <a class="waves-effect "   href="{!! route('report-pdf') !!}"s aria-expanded="false"><i class="mdi mdi-animation"></i><span class="hide-menu">รายงานการใช้ห้องประชุม </span></a>
                            
                        </li>
                        @endif
                        @if(!Auth::guest()&&Auth::user()->description=='admin')
                         <li>
                            <a class="waves-effect "   href="{!! route('report-pdf') !!}"s aria-expanded="false"><i class="mdi mdi-animation"></i><span class="hide-menu">รายงานการใช้ห้องประชุม </span></a>
                            
                        </li>
                        @endif
                        @if(!Auth::guest()&&Auth::user()->description=='superadmin')
                         <li>
                            <a class="waves-effect "  href="{{ route('user-index') }}" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">จัดการผู้ใช้งาน </span></a>
                            
                        </li>
                        @endif
                     
                      
                    </ul>
                        
                        
                     
                      
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->
        </aside>





   
   
    
