<?php
  $query_email = $_SESSION['session_tasks_email'];

  include '_inc/dbconn.php';
  $sql = "SELECT * FROM UTasksMAIN.users WHERE email='$query_email'";
  $result = mysql_query($sql) or die(mysql_error());
  $rws = mysql_fetch_array($result);
                
  // logged in account id & users name and surname
  $userdat_id = $rws[0];
  $userdat_name = $rws[1];
  $userdat_username = $rws[11];
  $userdat_lastlogin = $rws[9];
  $userdat_accstatus = $rws[10];
  $status = $rws[12];
                
  $userdat_address = $rws[5];
  $userdat_acctype = $rws[4];
  $userdat_gender = $rws[2];
  $userdat_mobile = $rws[6];
  $userdat_email = $_SESSION['session_tasks_email'];
  $userdat_dob = $rws[3];
        
  // checking for corrupted sessions
  if ($userdat_email = ""){ // often happends when user is deleted and still logged in or corrupted session
    session_destroy();
    header('location:login?notice=1');

  } elseif ($rws[10] == "DISABLED"){ // logs users out when they are disabled and still logged in
    $date = date('Y-m-d h:i:s');
    $exitsql = "UPDATE UTasksMAIN.users SET lastlogin='$date' WHERE id='$userdat_id'"; // last login
    mysql_query($exitsql) or die("Could not set your lastlogin time.");
    $exitsql2 = "UPDATE UTasksMAIN.users SET status='offline' WHERE id='$userdat_id'"; // set user status to offline
    mysql_query($exitsql2) or die("Could not set your status to offline.");

    session_destroy();
    header('location:login?error=3');
  } elseif ($status == "offline"){ // cookies cleared, but no official logout
    session_destroy();
    header('location:login?error=2');
  }
?>

<div id="wrapper">
      <!-- Sidebar -->
    <ul class="sidebar navbar-nav toggled">
        <li class="nav-item">
            <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="modal" data-target="#newtaskModal" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-plus-circle fa-lg"></i>
              <span>New task</span>
            </a>
        </li>
        <?php if ($userdat_acctype == "normal" OR $userdat_acctype == "premium") { ?>
        <li class="nav-item">
          <a class="nav-link" href="home">
            <i class="fas fa-tachometer-alt fa-lg"></i><span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tasks?show=all">
            <i class="fas fa-sticky-note fa-lg"></i><span>All Tasks</span>
          </a>
        </li>
        <li class="nav-item <?php if ($userdat_acctype == 'premium'){ echo 'mb-5';} ?>">
          <a class="nav-link" href="labels">
            <i class="fas fa-folder-open fa-lg"></i><span>Labels</span>
          </a>
        </li>
        <?php } elseif ($userdat_acctype == "admin"){ ?>
          <li class="nav-item">
            <a class="nav-link" href="home">
              <i class="fas fa-tachometer-alt fa-lg"></i></i><span>Dashboard</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-sticky-note fa-lg"></i> <span>Task Actions</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <h6 class="dropdown-header">More Task Actions</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="tasks?show=all"><i class="fas fa-fw fa-sticky-note"></i> All Tasks</a>
              <a class="dropdown-item" href="labels"><i class="fas fa-fw fa-folder-open"></i> Labels
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="support?new">
             <i class="fas fa-fw fa-life-ring fa-lg"></i><span>Support Panel</span>
            </a>
          </li>
          <li class="nav-item mb-5">
            <a class="nav-link" href="admin?new">
             <i class="fas fa-fw fa-wrench fa-lg"></i><span>Admin</span>
            </a>
          </li>
        <?php } else { ?>
          <li class="nav-item mb-5">
            <a class="nav-link" href="labels">
              <i class="fas fa-folder-open fa-lg"></i><span>Labels</span>
            </a>
          </li>
        <?php } if ($userdat_acctype == "normal"){ ?>           
        <li class="nav-item mb-5">
          <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="modal" data-target="#premiumModal" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-gem"></i><span>Premium!</span>
          </a>
        </li>
      <?php } ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php if ($userdat_acctype == "normal"){ ?>
            <i class="fas fa-user-circle fa-lg"></i>
            <?php } else { ?>
            <i class="fas fa-crown"></i>
          <?php } ?>
            <span><?php echo $userdat_username; ?></span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Welcome <b><?php echo $userdat_name; ?></b>!</h6>
            <!-- devider could go here <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="users"><i class="fas fa-fw fa-users"></i> All Users</a>
              <a class="dropdown-item" href="account"><i class="fas fa-fw fa-user-circle"></i> My Account</a>
              <a class="dropdown-item" href="settings"><i class="fas fa-fw fa-cogs"></i> Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
               <i class="fas fa-fw fa-sign-out-alt"></i> Logout
              </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="modal" data-target="#logoutModal" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-sign-out-alt fa-lg"></i>
            <span>Logout</span>
          </a>
        </li>
    </ul>