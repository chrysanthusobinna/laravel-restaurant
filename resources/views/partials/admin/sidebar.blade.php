        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
              <li class="nav-item">
                <div class="d-flex sidebar-profile">
                  <div class="sidebar-profile-image">
                    <img src=" {{ $loggedInUser && $loggedInUser->profile_picture ? asset('storage/profile-picture/' . $loggedInUser->profile_picture) : asset('assets/images/user-icon.png') }}" alt="image">
                    <span class="sidebar-status-indicator"></span>
                  </div>
                  <div class="sidebar-profile-name">
                    <p class="sidebar-name">
                      {{ $loggedInUser->first_name }}
                    </p>
                    <p class="sidebar-designation">
                      Welcome
                    </p>
                  </div>
                </div>
              </li>


              <li class="nav-item {{ request()->route()->named('admin.index') ? 'active-nav' : '' }} ">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fa fa-desktop menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            
 
 
            <li class="nav-item {{ request()->route()->named('admin.pos.index') ? 'active-nav' : '' }}">
              <a class="nav-link" href="{{ route('admin.pos.index') }}">
                <i class="fa fa-shopping-cart menu-icon" ></i>
                  <span class="menu-title">Pont of Sale</span>
              </a>
          </li>
          
          
      
          <li class="nav-item {{ Request::is('admin/order*') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                <i class="fa fa-file menu-icon"></i>
                <span class="menu-title">Manage Orders</span>
            </a>
        </li>
        <li class="nav-item {{ request()->route()->named('admin.table-bookings') ? 'active-nav' : '' }}">
          <a class="nav-link" href="{{ route('admin.table-bookings') }}">
              <i class="fa fa-folder-open menu-icon"></i>
              <span class="menu-title">Manage Bookings</span>
          </a>
        </li>        
        <li class="nav-item {{ Request::is('admin/blog*') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.blog.index') }}">
                <i class="far fa-newspaper menu-icon"></i>
                <span class="menu-title">Manage Blog</span>
            </a>
        </li>
        
        <li class="nav-item {{ request()->route()->named('admin.users.index') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fa fa-users menu-icon"></i>
                <span class="menu-title">Manage Admins</span>
            </a>
        </li>
        


              <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" href="#site-settings" aria-expanded="false" aria-controls="site-settings">
                  <i class="fa fa-cog menu-icon"></i>
                    <span class="menu-title">Site Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="site-settings" style="">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">  <a class="nav-link " href="{{ route('admin.menus.index') }}">Menu</a>  </li>
                        <li class="nav-item"> <a class="nav-link " href="{{ route('admin.categories.index') }}">Category</a>  </li> 
                        <li class="nav-item"> <a class="nav-link " href="{{ route('admin.testimonies.index') }}">Testimony</a> </li>
                        <li class="nav-item"> <a class="nav-link " href="{{ route('admin.terms.edit') }}">Terms & Condition</a> </li>                                                   
                        <li class="nav-item"> <a class="nav-link " href="{{ route('admin.privacy-policy.edit') }}">Privacy Policy</a> </li>                                                                                                
                        <li class="nav-item"> <a class="nav-link " href="{{ route('admin.general-settings') }}">General Settings</a>  </li>                                         
                    </ul>
                </div>
            </li>
            


              <li class="nav-item {{ request()->route()->named('admin.view.myprofile') ? 'active-nav' : '' }}">
                <a class="nav-link" href="{{ route('admin.view.myprofile') }}">
                  <i class="fa fa-user menu-icon"></i>
                  <span class="menu-title">My Profile</span>
                </a>
              </li>

              <li class="nav-item {{ request()->route()->named('change.password.form') ? 'active-nav' : '' }}">
                <a class="nav-link" href="{{ route('change.password.form') }}">
                  <i class="fa fa-lock menu-icon"></i>
                  <span class="menu-title">Change Password</span>
                </a>
              </li>     


              <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                  <i class="fa fa-globe menu-icon"></i>
                  <span class="menu-title">Main Website</span>
                </a>
              </li>

              <li class="nav-item">
                <a onclick="if (confirm('Are you Sure you want to Log out Now?')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="nav-link" href="{{ route('admin.logout') }}">
                  <i class="fa fa-power-off menu-icon"></i>
                  <span class="menu-title">Logout</span>
                </a>
              </li>

              
            </ul>
  
          </nav>
