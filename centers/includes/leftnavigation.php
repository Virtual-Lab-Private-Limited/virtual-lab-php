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
              <a href="<?php echo $baseurl;?>alltests.php" class="nav-link"><i class="fas fa-vials"></i><span>Tests List</span></a>
          
            </li>
             <?php if ($session_role == 'admin') { ?>
              <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Staff Members</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>staff_list.html">Staff List</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>add_staff.html">Add New Member</a></li>
              </ul>
            </li>
            <?php } ?>
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="
fas fa-user-circle"></i><span>Patient</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>patient_list.html">Patient List</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>add_patient.html">Add New Patient</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fas fa-notes-medical"></i><span>Tests</span></a>
              <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo $baseurl;?>pending.php">Pending Tests</a></li>
                  <li><a class="nav-link" href="<?php echo $baseurl;?>complete.php">Complete Tests</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fas fa-laptop-medical"></i><span>Sample Requests</span></a>
              <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo $baseurl;?>in_city.php">In City</a></li>
                  <li><a class="nav-link" href="<?php echo $baseurl;?>out_city.php">Out City</a></li>
              </ul>
            </li>
                <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fas fa-user-md"></i><span>Doctors</span></a>
              <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo $baseurl;?>add_doctor.php">Add New</a></li>
                  <li><a class="nav-link" href="<?php echo $baseurl;?>doctors.php">All Doctors</a></li>
              </ul>
            </li>
            <?php if ($session_role == 'admin') { ?>
           <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fas fa-coins"></i><span>Earnings</span></a>
              <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo $baseurl;?>overview.php">Overview</a></li>
                  
              </ul>
            </li>
            <?php } ?>

          </ul>
        </aside>
      </div>
