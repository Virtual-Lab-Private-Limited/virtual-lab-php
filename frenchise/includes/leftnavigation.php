      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo $baseurl;?>home.html">
              <?php 
              if ($session_outsource == "1") {?>
                <img alt="image" src="https://virtuallab.com.pk/<?php echo $session_logo;?>" class="header-logo" width="200" height="150"/>
              <?php } else { ?> 
                <img alt="image" src="<?php echo $baseurl;?>assets/img/logo.png" class="header-logo" width="200" height="150" />
              <?php } ?>

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
            <li class="dropdown ">
              <a href="<?php echo $baseurl;?>alltests.php" class="nav-link"><i class="fas fa-vials"></i><span>Tests List</span></a>
            </li>
              <?php if ($session_role == 'admin') { ?>
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fas fa-cogs"></i><span>Settings</span></a>
              <ul class="dropdown-menu">
             <li><a class="nav-link" href="<?php echo $baseurl;?>general.html">General Settings</a></li>              
             <!--<li><a class="nav-link" href="<?php echo $baseurl;?>frenchise_doctors.html">Frenchise Doctors</a></li>-->
<li><a class="nav-link" href="<?php echo $baseurl;?>test_settings.html">Test Settings</a></li>
<li>
              <a href="<?php echo $baseurl;?>discounts.php" class="nav-link"><span>Discount Categories</span></a>
            </li>  
              </ul>
            </li>
           
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
                <li><a class="nav-link" href="<?php echo $baseurl;?>add_patient.html">Add New Patient</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>patient_list.html">Patient List</a></li>
               
              </ul>
            </li>
            <li class="dropdown">
<a href="" class="nav-link has-dropdown"><i class="
fas fa-address-card"></i><span>Bookings</span></a>
              <ul class="dropdown-menu">
<li><a class="nav-link" href="<?php echo $baseurl;?>bystaff.html">By Staff Booking</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>onlinebookings.html">Online Booking</a></li>
   <li><a class="nav-link" href="<?php echo $baseurl;?>prescription.php">Prescriptions Upload</a></li>
            

              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fas fa-notes-medical"></i><span>Patient Test</span></a>
              <ul class="dropdown-menu">
<li><a class="nav-link" href="<?php echo $baseurl;?>pending.php">Pending Test</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>pathologist.html">Pathologist</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>complete.php">Complete Test</a></li>

              </ul>
            </li>
            <?php if ($session_role == 'admin') { ?>
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fas fa-user-md"></i><span>Stamp Doctors</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>doctors.php">All Doctors</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>add_doctor.html">Add Doctor</a></li>
              </ul>
            </li>
 
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fas fa-store-alt"></i><span>Collection Center</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>centers.php">Collection Centers</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>add_center.php">Add Collection Center</a></li>

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
              <a href="" class="nav-link has-dropdown"><i class="fas fa-coins"></i><span>Earnings</span></a>
              <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo $baseurl;?>payments.php">Ledger</a></li>
                  <li><a class="nav-link" href="<?php echo $baseurl;?>expenses.php">Expenses</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="<?php echo $baseurl;?>test_kits.html" class="nav-link"><i class="fas fa-flask"></i><span>Test Kits</span></a>
            </li>
            <?php } ?>
          </ul>
        </aside>
      </div>
