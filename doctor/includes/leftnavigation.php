      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo $baseurl;?>home.html">
              <img alt="image" src="<?php echo $baseurl;?>assets/img/logo.png" class="header-logo" />

            </a>
          </div>
          <ul class="sidebar-menu">
          	<li class="dropdown active" style="display: block;">
          		 <div class="sidebar-profile">
	                 <div class="siderbar-profile-pic">
	                     <img src="<?php echo $baseurl;?>assets/img/user.png" class="profile-img-circle box-center" alt="User Image">
	                 </div>
	                 <div class="siderbar-profile-details">
	                     <div class="siderbar-profile-name"> <?php echo $session_username;?> </div>
	                 </div>
                 </div>
             </li>
            <li class="menu-header">Main</li>
            <li class="dropdown active">
              <a href="<?php echo $baseurl;?>home.html" class="nav-link"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="<?php echo $baseurl;?>complete_test.html" class="nav-link"><i class="fas fa-notes-medical"></i><span>Complete Test</span></a>
         
            </li>
	          </ul>
        </aside>
      </div>
