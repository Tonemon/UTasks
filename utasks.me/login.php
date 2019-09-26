<?php 
if(isset($_REQUEST['loginbutton'])){
    include '_inc/dbconn.php';
    $login_user = $_REQUEST['login_username'];
    
    // password salting (for security reasons)
    $salt = "@3e6jQsK&na*&#3j";
    $login_password = sha1($_REQUEST['login_password'].$salt);

    if (preg_match("/@/", $login_user)) { // check for @, if present:
        // getting usefull information for session creation (with email)
        $sqlquery = "SELECT username,email,password,accstatus,status,id,account FROM UTasksMAIN.users WHERE email='$login_user' AND password='$login_password'";
        $result = mysql_query($sqlquery) or die(mysql_error());
        $arr =  mysql_fetch_array($result);

    } else { // no @ present, so user is trying to login with username:
        // getting usefull information for session creation (with username)
        $sqlquery = "SELECT username,email,password,accstatus,status,id,account FROM UTasksMAIN.users WHERE username='$login_user' AND password='$login_password'";
        $result = mysql_query($sqlquery) or die(mysql_error());
        $arr =  mysql_fetch_array($result);
    }
    
    $db_username = $arr[0];
	  $db_email = $arr[1];
    $db_pass = $arr[2];
	  $db_accstatus = $arr[3];
	  $status = $arr[4];
    $db_id = $arr[5];
    $db_acctype = $arr[6];

    if ($db_username == "") { // means that user cannot be found in users table/might be deleted
      // This query checks if user is permanently deleted (from 'usersclosed' table)
      $del_sql = "SELECT username FROM UTasksMAIN.usersclosed WHERE username='$login_user'";
      $del_result = mysql_query($del_sql) or die(mysql_error());
      $del_rws = mysql_fetch_array($del_result);

      if (isset($del_rws[0])){
        header('location:login?notice=1');
      }

    } elseif (($login_user == $db_username || $login_user == $db_email) && $login_password == $db_pass){ // check if submitted information is correct
      if ($db_accstatus == "ACTIVE"){ // check if account status is active or not
        session_start();
        $_SESSION['session_tasks_start'] = 1;
        $_SESSION['session_tasks_username'] = $db_user;
        $_SESSION['session_tasks_email'] = $db_email;
        $_SESSION['session_tasks_id'] = $db_id;
        $_SESSION['session_tasks_name'] = $db_name;
        
        // setting user status to online
        $setonline = "UPDATE UTasksMAIN.users SET status='online' WHERE email='$db_email'";
        mysql_query($setonline) or die(mysql_error());

        if ($arr[6] == "admin"){ // redirect different user accounts to different dashboards
          header('location:admin?dashboard');
        } else {
          header('location:home');
        } 

      } else { // account status is set to disabled
        header('location:login?error=3');
      }
    } else { // user login information is incorrect
      header('location:login?error=1'); 
    }
} ?>

<?php 
session_start(); // check if session active to redirect user from login page
  if (isset($_SESSION['session_tasks_start'])) 
    header('location:home');     
?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/png" href="vendor/img/favicon.png"/>
	<meta name="description" content="UTasks - Focus more using UTasks">
	<meta name="author" content="UTasks Group">

	<!-- Bootstrap core CSS-->
	<link href="vendor/css/bootstrap.min.css" rel="stylesheet">
		
	<!-- Custom fonts/styles for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="vendor/css/sb-admin.css" rel="stylesheet">
		
	<title>Login to your Account | UTasks User Panel</title>
		
	<script type="text/javascript">
		function Forgot() {
			alert("Please contact us on the contact page to request a new password. \nYou will need to be able to identify yourself to get your password changed.");
		}
	</script>
  </head>
  <body class="login-bg">
    <div class="container">
      <div class="card card-login">
        <div class="card-header text-center"><i class="fas fa-home"></i> UTasks User Panel</div>
        <div class="card-body text-center">
          <form action="login" method="POST" name="login_form">

    			<?php
    				if ($_GET['success'] == "1") { // logged out
    					echo "<div class='alert alert-success'>
    						<i class='fas fa-check'></i> Successfully logged out.</div>";
    				} elseif ($_GET['success'] == "2") { // password changed
              echo "<div class='alert alert-success'>
                <i class='fas fa-check'></i> Password changed. Login to continue.</div>";
            } elseif ($_GET['success'] == "3") { // username changed
              echo "<div class='alert alert-success'>
                <i class='fas fa-check'></i> Username changed. Login to continue.</div>";
            } elseif ($_GET['error'] == "1") { // wrong credentials
    					echo "<div class='alert alert-danger'>
    						<i class='fas fa-exclamation-triangle'></i> Wrong credentials. Please try again.</div>";
    				} elseif ($_GET['error'] == "2") { // session expired
              echo "<div class='alert alert-warning'>
                <i class='fas fa-exclamation-triangle'></i>
                Your session is expired. <br>Please login again to continue.</div>";
            } elseif ($_GET['error'] == "3") { // account disabled
    					echo "<div class='alert alert-danger'>
    						<i class='fas fa-exclamation-triangle'></i>
    						Account temporarily disabled. <br>Please <a href='http://utasks.me/contact'>contact us</a> for more information.</div>";
    				} elseif ($_GET['notice'] == "1") { // account might be deleted or weird error
    					echo "<div class='alert alert-warning'>
    						<i class='fas fa-exclamation-triangle'></i>
    						Your account might be permanently removed. <a href='#' id='pagesDropdown' role='button' data-toggle='modal' data-target='#infoModal' aria-haspopup='true' aria-expanded='false'>Read more</a>.</div>";
    				} elseif ($_GET['notice'] == "2") { // account might be deleted or weird error
              echo "<div class='alert alert-warning'>
                <i class='fas fa-exclamation-triangle'></i> Please login first to continue.</div>";
            } else { // normal login text (when no error shown)
    					echo "<p>Please login below using your UTasks account.</p>";
    				}
    			?>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="username" class="form-control" name="login_username" required="required">
                <label for="username">Username or Email</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <div class="form-label-group">
                  <input type="password" id="password" class="form-control" name="login_password" required="required">
                  <label for="password">Password</label>
					        <input type="hidden" name="p" id="p" value="">
                </div>
              </div>
            </div>
			      <div class="form-group">
              <div class="checkbox">
                <label><input type="checkbox" value="remember"> Remember Me</label>
              </div>
            </div>
			      <button class="btn btn-primary btn-block" type="submit" name="loginbutton">Login <i class="fas fa-sign-in-alt"></i></button>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="http://utasks.me/#register" target="_blank">Register an Account</a>
            <a class="d-block small" href="http://utasks.me/#contact" target="_blank">Forgot Password?</a> 
          </div>
        </div>
      </div>
    </div>

    <!-- Permanent deleted account Modal-->
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-trash-alt"></i> Permanently removed account</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">If you see this page, your account <b>might</b> be permantly removed.<br><br> If you don't recognize this activity or don't know how this happended, <b>please try logging in again</b>. If that doesn't work, <b>contact us</b> using the contact information on <a href='http://utasks.me/contact'>this page</a>.<br><br> Some reasons why your account <b>could</b> be deleted:
          <ol>
          	<li>Inactive for a long period (+2 years).</li>
          	<li>Unusual or fraudulent activity.</li>
          	<li>User was exploiting (premium) features.</li>
          </ol>
          Or other (unlisted) reasons.
          </div>
        </div>
      </div>
    </div>

    <!-- Credits footer on every page -->
    <div style="position: fixed;bottom: 0;right: 15px;background-color: #fff;box-shadow: 0 4px 8px rgba(0,0,0,.05);border-radius: 3px 3px 0 0;font-size: 12px;padding: 5px 10px;">Created by Tony.</div>

    <!-- Core plugin JavaScript-->
	<script src="vendor/js/jquery.easing.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>