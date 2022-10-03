      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"><i
                  class="fas fa-bars"></i></a></li>
                   <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                  <i class="fas fa-expand"></i>
                </a>
            </li>
        
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
            <li><a href="notifications.php" class="nav-link nav-link-lg ">
                  <i class="fas fa-bell"></i> <span class="notifications"><span class="badge badge-danger" style="margin-bottom:25px" id="badge">0</span> </span>
                </a>
            </li>
          <li class="dropdown"><a href="" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?php echo $baseurl;?>assets/img/user.png" class="user-img-radious-style">
              <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Hello <?php echo $session_username;?></div>
              
<a href="<?php echo $baseurl;?>changepassword.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo $baseurl;?>logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
   <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
 
