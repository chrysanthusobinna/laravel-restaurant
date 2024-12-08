        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
              <li class="nav-item">
                <div class="d-flex sidebar-profile">
                  <div class="sidebar-profile-image">
                    <img src="/admin_resources/images/faces/face29.png" alt="image">
                    <span class="sidebar-status-indicator"></span>
                  </div>
                  <div class="sidebar-profile-name">
                    <p class="sidebar-name">
                      Kenneth Osborne
                    </p>
                    <p class="sidebar-designation">
                      Welcome
                    </p>
                  </div>
                </div>
              </li>


              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">
                  <i class="typcn typcn-device-desktop menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
 
 
      
              <li class="nav-item">
                <a class="nav-link" href="pages/documentation/documentation.html">
                  <i class="typcn  typcn-document-add menu-icon"></i>
                  <span class="menu-title">New Order</span>
                </a>
              </li>
   
      
              <li class="nav-item">
                <a class="nav-link" href="pages/documentation/documentation.html">
                  <i class="typcn typcn-document-text menu-icon"></i>
                  <span class="menu-title">View Orders</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.blog.index') }}">
                  <i class="typcn typcn-tabs-outline menu-icon"></i>
                  <span class="menu-title">Manage Blog</span>
                </a>
              </li>

 

              <li class="nav-item ">
                <a class="nav-link collapsed" data-toggle="collapse" href="#site-settings" aria-expanded="false" aria-controls="site-settings">
                    <i class="typcn typcn-cog menu-icon"></i>
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
                          <a class="nav-link " href="{{ route('admin.users.index') }}">Manage Users</a>
                       </li>                          
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('admin.general-settings') }}">General Settings</a>
                        </li>

                                           
                    </ul>
                </div>
            </li>
            


              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.view.myprofile') }}">
                  <i class="typcn typcn-user-outline menu-icon"></i>
                  <span class="menu-title">My Profile</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('change-password.form') }}">
                  <i class="typcn typcn-lock-closed-outline menu-icon"></i>
                  <span class="menu-title">Change Password</span>
                </a>
              </li>     


              <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                  <i class="typcn icon typcn-world-outline menu-icon"></i>
                  <span class="menu-title">Main Website</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}">
                  <i class="typcn typcn-power-outline menu-icon"></i>
                  <span class="menu-title">Logout</span>
                </a>
              </li>

              
            </ul>
  
          </nav>
