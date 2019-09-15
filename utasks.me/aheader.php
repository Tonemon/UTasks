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
  $userdat_accstatus=$rws[10];
  $status=$rws[12];
  $waspremium=$rws[13];
                
  $address=$rws[5];
  $acc_type=$rws[4];
  $gender=$rws[2];
  $mobile=$rws[6];
  $email=$rws[7];
  $dob=$rws[3];
        
  // checking for corrupted sessions
  if ($email == ""){ // often happends when user is deleted and still logged in or corrupted session
    session_destroy();
    header('location:login?notice=1');
  } elseif ($rws[10] == "DISABLED"){ // logs users out when they are disabled and still logged in
    $date = date('Y-m-d h:i:s');
    $exitsql="UPDATE UTasksMAIN.users SET lastlogin='$date' WHERE id='$userdat_id'"; // last login
    mysql_query($exitsql) or die("Could not set your lastlogin time.");
    $exitsql2="UPDATE UTasksMAIN.users SET status='offline' WHERE id='$userdat_id'"; // set user status to offline
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
        <li class="nav-item">
          <a class="nav-link" href="home">
            <i class="fas fa-sticky-note fa-lg"></i><span>Tasks</span>
          </a>
        </li>
        <?php if ($acc_type == "normal") { ?>
        <li class="nav-item">
          <a class="nav-link" href="labels">
            <i class="fas fa-folder-open fa-lg"></i><span>Labels</span>
          </a>
        </li>
        <?php } elseif ($acc_type == "admin"){ ?>
          <li class="nav-item">
          <a class="nav-link" href="labels">
            <i class="fas fa-folder-open fa-lg"></i><span>Labels</span>
          </a>
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
        <?php } if ($acc_type == "normal"){ ?>           
        <li class="nav-item mb-5">
          <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="modal" data-target="#premiumModal" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-gem"></i><span>Premium!</span>
          </a>
        </li>
      <?php } ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-lg"></i> <span><?php echo $userdat_username; ?></span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Welcome user <b><?php echo $userdat_name; ?></b>!</h6>
            <!-- devider could go here <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="users"><i class="fas fa-fw fa-users"></i> All Users</a>
            <?php if ($acc_type == "admin"){ ?>
              <a class="dropdown-item" href="support?new"><i class="fas fa-fw fa-life-ring"></i> Support Panel</a>
              <a class="dropdown-item" href="admin?new"><i class="fas fa-fw fa-wrench"></i> Admin Panel</a>
            <?php } elseif ($acc_type == "normal"){ ?>
              <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#premiumModal" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-gem"></i> UTasks Premium</a>
            <?php } ?>
              <a class="dropdown-item" href="account"><i class="fas fa-fw fa-cogs"></i> Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
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