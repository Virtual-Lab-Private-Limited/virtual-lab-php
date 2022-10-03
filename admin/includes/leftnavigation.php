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
              <a href="" class="nav-link has-dropdown"><i class="fas fa-cogs"></i><span>Settings</span></a>
              <ul class="dropdown-menu">
             <li><a class="nav-link" href="<?php echo $baseurl;?>general.html">General Settings</a></li>
             <li><a class="nav-link" href="<?php echo $baseurl;?>frenchise_doctors.html">Frenchise Doctors</a></li>
             <li><a class="nav-link" href="<?php echo $baseurl;?>city.php">Manage Cities</a></li>
             <li><a class="nav-link" href="<?php echo $baseurl;?>jobs.php">Careers</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Staff Members</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>staff_list.html">Staff List</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>add_staff.html">Add New Member</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>pending_staff.html">Pending Members Request</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>exam_qualified.html">Qualify for Exam</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>complete_exam.html">Exam Results</a></li>

              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="
fas fa-code-branch"></i><span>Patients</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>patient_list.html">Patient List</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>add_patient.html">Add New Patient</a></li>

              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="
fas fa-code-branch"></i><span>Frenchise / Branches</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>frenchiselist.html">Frenchise / Branches List</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>addfrenchise.html">Add New Frenchise / Branch</a></li>
                                <li><a class="nav-link" href="<?php echo $baseurl;?>doctors.html">Doctors</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>add_doctor.html">Add Doctor</a></li>
              
              </ul>
            </li>
                        <li class="dropdown">
<a href="" class="nav-link has-dropdown"><i class="fas fa-notes-medical"></i><span>Test System</span></a>
              <ul class="dropdown-menu">
<li>
              <a href="<?php echo $baseurl;?>discounts.html" class="nav-link"><span>Discount Categories</span></a>
            </li>              
<li>
              <a href="<?php echo $baseurl;?>test_categories.html" class="nav-link"><span>Test Categories</span></a>
            </li>              
<li>
<a href="<?php echo $baseurl;?>bulk_import.php" class="nav-link"><span>Bulk import </span></a></li>
<li>
<a href="<?php echo $baseurl;?>addtest.html" class="nav-link"><span>Add Test</span></a></li>
<li>
              <a href="<?php echo $baseurl;?>alltests.html"><span>All Tests</span></a>
            </li>

<li>
                <a class="nav-link" href="<?php echo $baseurl;?>medicines.html">Medicines</a></li>
<li>
                <a class="nav-link" href="<?php echo $baseurl;?>cultures.html">Cultures</a></li>
<li>
                <a class="nav-link" href="<?php echo $baseurl;?>radiology.html">Radiology Test</a></li>
<li>
                <a class="nav-link" href="<?php echo $baseurl;?>histopathology.html">Histopathology</a></li>

<li class="dropdown">
              <a href="" class="nav-link has-dropdown"><span>Packages</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>packages.html">Packages</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>create_package.html">Create Package</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><span>Vouchers</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>vouchers.php">Vouchers</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>create_voucher.php">Create Voucher</a></li>
              </ul>
            </li>

              </ul>
            </li>
            <li class="dropdown">
<a href="" class="nav-link has-dropdown"><i class="fab fa-atlassian"></i><span>Bookings</span></a>
              <ul class="dropdown-menu">
    
             
<li><a class="nav-link" href="<?php echo $baseurl;?>bystaff.html">By Staff Booking</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>onlinebookings.html">Online Booking</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>prescription.php">Prescription Upload</a></li>

              </ul>
            </li>
             <li class="dropdown">
            <a href="" class="nav-link has-dropdown"><i class="fab fa-atlassian"></i><span>Reports</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>pendding_test.html">Pending Reports</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>complete.php">Reports History</a></li>
             
              </ul>
            </li>
            <li class="dropdown">
              <a href="<?php echo $baseurl;?>test_kits.html" class="nav-link"><i class="fas fa-flask"></i><span>Test Kits</span></a>
            </li>

            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fab fa-atlassian"></i><span>Investors</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>investors.html">Investors List</a></li>
                <li><a class="nav-link" href="<?php echo $baseurl;?>add_investor.html">Add New Investor</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="" class="nav-link has-dropdown"><i class="fab fa-atlassian"></i><span>Profit Sharing</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo $baseurl;?>byrider.html">By Rider </a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>bylab.html">By Associated Lab</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>distributed.html">Distributed Profit</a></li>

              </ul>
            </li>
            <li class="dropdown">
<a href="" class="nav-link has-dropdown"><i class="fab fa-atlassian"></i><span>Withdrawals</span></a>
              <ul class="dropdown-menu">
<li><a class="nav-link" href="<?php echo $baseurl;?>withdrawal_requests.html">Pending Request</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>complete_request.html">Complete Request</a></li>
              </ul>
            </li>
            <li class="dropdown">
<a href="" class="nav-link has-dropdown"><i class="fab fa-atlassian"></i><span>Shop</span></a>
              <ul class="dropdown-menu">
<li><a class="nav-link" href="<?php echo $baseurl;?>products.html">Products</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>addproduct.html">Add Product</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>orders.html">Pending Orders</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>complete-orders.html">Complete Orders</a></li>
              </ul>
            </li>

            <li class="dropdown">
<a href="" class="nav-link has-dropdown"><i class="fab fa-atlassian"></i><span>Exams</span></a>
              <ul class="dropdown-menu">
<li><a class="nav-link" href="<?php echo $baseurl;?>questions.html">Questions</a></li>
<li><a class="nav-link" href="<?php echo $baseurl;?>addquestion.html">Add Question</a></li>
              </ul>
            </li>

          </ul>
        </aside>
      </div>
