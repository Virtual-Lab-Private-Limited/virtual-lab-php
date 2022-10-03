      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"><i
                  class="fas fa-bars"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                  <i class="fas fa-expand"></i>
                </a>
            </li>
            <li>
              <div class="search-group">
                <span class="nav-link nav-link-lg" id="search">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </span>
                <input type="text" class="search-control" placeholder="search" aria-label="search" aria-describedby="search">
              </div>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          
          <li class="dropdown"><a href="#" data-toggle="dropdown"
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
