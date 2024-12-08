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


              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fa fa-desktop menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            
 
 
            <li class="nav-item">
              <a class="nav-link" href="pages/documentation/documentation.html">
                <i class="fa fa-plus-square menu-icon" ></i>
                  <span class="menu-title">New Order</span>
              </a>
          </li>
          
   
      
          <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
                <i class="fa fa-file menu-icon"></i>
                <span class="menu-title">View Orders</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.blog.index') }}">
                <i class="far fa-newspaper menu-icon"></i>
                <span class="menu-title">Manage Blog</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fa fa-users menu-icon"></i>
                <span class="menu-title">Manage Users</span>
            </a>
        </li>
        


              <li class="nav-item ">
                <a class="nav-link collapsed" data-toggle="collapse" href="#site-settings" aria-expanded="false" aria-controls="site-settings">
                  <i class="fa fa-cog menu-icon"></i>
                    <span class="menu-title">Site Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="site-settings" style="">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('admin.menus.index') }}">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('admin.categories.index') }}">Category</a>
                        </li>                         
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('admin.general-settings') }}">General Settings</a>
                        </li>

                                           
                    </ul>
                </div>
            </li>
            


              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.view.myprofile') }}">
                  <i class="fa fa-user menu-icon"></i>
                  <span class="menu-title">My Profile</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('change-password.form') }}">
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
