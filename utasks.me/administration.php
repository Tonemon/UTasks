<?php 
session_start();
if (!isset($_SESSION['session_tasks_start']))
	header('location:login?notice=2');
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
    <script src="https://kit.fontawesome.com/65d0b9813c.js" crossorigin="anonymous"></script>
    <link href="vendor/css/sb-admin.css" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="vendor/js/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	
	<title>Admin Dashboard | UTasks Admin Panel </title>
  </head>
  <body id="page-top">
    <?php include 'aheader.php' ?>

	<div id="content-wrapper">
      <div class="container-fluid">

	<?php if ($userdat_acctype == "admin"){ // show this when user is admin ?>
		<?php
			// count total user accounts
			$totalsql = "SELECT count(*) FROM UTasksMAIN.users"; 
			$countTotal = mysql_query($totalsql) or die(mysql_error());
			$resTotal = mysql_fetch_array($countTotal);
			$total = $resTotal[0];
						
			// count all online users
			$onlinesql = "SELECT count(*) FROM UTasksMAIN.users WHERE status='online'";
			$countOnline = mysql_query($onlinesql) or die(mysql_error());
			$resOnline = mysql_fetch_array($countOnline);
			$online = $resOnline[0];

			// count new support panel entries
			$reviewsql = "SELECT count(*) FROM UTasksMAIN.questions WHERE status='TO REVIEW'";
			$countReview = mysql_query($reviewsql) or die(mysql_error());
			$resReview = mysql_fetch_array($countReview);
			$review = $resReview[0];

			// count all new account requests
			$newrequestsql = "SELECT count(*) FROM UTasksMAIN.usersnew";
			$countNewrequest = mysql_query($newrequestsql) or die(mysql_error());
			$resNewrequest = mysql_fetch_array($countNewrequest);
			$newrequest = $resNewrequest[0];

			// count all removed accounts
			$removedsql = "SELECT count(*) FROM UTasksMAIN.usersclosed";
			$countRemoved = mysql_query($removedsql) or die(mysql_error());
			$resRemoved = mysql_fetch_array($countRemoved);
			$removed = $resRemoved[0];
		?>

        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-globe"></i>
                </div>
                <div class="mr-5"><b><?php echo $online."</b>/<b>".$total; ?></b> user accounts online.<br></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="admin?all">
                <span class="float-left">View All <small>(accounts)</small></span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-mail-bulk"></i>
                </div>
                <div class="mr-5"><b><?php echo $review; ?></b> entries to review.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="support?new">
                <span class="float-left">View Support Panel</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <div class="mr-5"><b><?php echo $newrequest; ?></b> new account requests.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="admin?new">
                <span class="float-left">View New requests</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-user-times"></i>
                </div>
                <div class="mr-5"><b><?php echo $removed; ?></b> accounts removed.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="admin?removed">
                <span class="float-left">View accounts <small>(removed)</small></span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <!-- All users row -->
		  <div class="row">
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-users"></i>
				  All Active UNotes Users </div>
				<div class="card-body">
					<?php 
						// count admins
						$sql_admins = "SELECT count(*) FROM UTasksMAIN.users WHERE account='admin'"; 
						$countAdmins = mysql_query($sql_admins) or die(mysql_error());
						$resAdmins = mysql_fetch_array($countAdmins);
						$admins = $resAdmins[0];
									
						// count premium users
						$sql_premiums = "SELECT count(*) FROM UTasksMAIN.users WHERE account='premium'";
						$countPremiums = mysql_query($sql_premiums) or die(mysql_error());
						$resPremiums = mysql_fetch_array($countPremiums);
						$premiums = $resPremiums[0];

						// count normal users
						$sql_normals = "SELECT count(*) FROM UTasksMAIN.users WHERE account='normal'";
						$countNormals = mysql_query($sql_normals) or die(mysql_error());
						$resNormals = mysql_fetch_array($countNormals);
						$normals = $resNormals[0];
					?>
					<p><i class="fas fa-info-circle"></i> From the <b><?php echo $total; ?> total users</b>, there are <b><?php echo $admins; ?> admins</b>, <b><?php echo $premiums; ?> premium users</b> and <b><?php echo $normals; ?> normal users</b>.</p>
					<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<?php
							include '_inc/dbconn.php';
							if ($userdat_acctype == "admin"){ // check if admin (shows all users)
								$query2 = "SELECT * FROM UTasksMAIN.users";
								$res2 = mysql_query($query2) or die(mysql_error());
							} else { // showing only all normal/premium users
								$query2 = "SELECT * FROM UTasksMAIN.users WHERE account='normal' OR account='premium'";
								$res2 = mysql_query($query2) or die(mysql_error());
							}
						?>
						<thead>
						<tr>
							<th>Username</th>
							<th>Full Name</th>
							<th>Status</th>
						</tr>
						</thead>
						<tbody>
						<?php
                        while($rws = mysql_fetch_array($res2)){
							if ($rws[4] == "admin"){ // setting colors for account type badges
								$badgecolor = "danger";
							} elseif ($rws[4] == "premium"){
								$badgecolor = "info";
							} else {
								$badgecolor = "secondary";
							}

							if ($rws[12] == "online"){ // setting colors for account status badges
								$badge2color = "success";
							} else {
								$badge2color = "secondary";
							}

                            echo "<td>";
                            echo $rws[11]." <span class='badge badge-".$badgecolor."'>";
                            if ($rws[4] == "premium"){ echo "<i class='fas fa-gem'></i> "; }
                            if ($rws[4] == "admin"){ echo "<i class='fas fa-wrench'></i> "; }
                            echo $rws[4]."</span>";
                            echo "</td>";
							echo "<td>".$rws[1]."</td>";
							echo "<td><span class='badge badge-".$badge2color."'>".$rws[12]."</span></td>";
                            echo "</tr>";
                        }
                        ?>
					  </tbody>
					</table>
					</div>
				</div>
			  </div>
			</div>
		  </div> <!-- /.row -->
    <?php 
		} else { // non-admins can't access this page
			header('location:home?error=2');
		} 

	?>

    <?php include 'afooter.php' ?>