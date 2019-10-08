<?php 
session_start();
if (!isset($_SESSION['session_tasks_start'])) 
    header('location:login');   
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

    <!-- Page level plugin CSS-->
    <link href="vendor/js/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	
	<title>All Users | UTasks </title>
  </head>
  <body id="page-top">
    <?php include 'aheader.php' ?>

      <div id="content-wrapper">
        <div class="container-fluid">	
		  
		  <!-- All users row -->
		  <div class="row">
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-users"></i>
				  All Active UNotes Users </div>
				<div class="card-body">
					<?php
						if ($userdat_acctype != "admin"){
							$total = "SELECT count(*) FROM UTasksMAIN.users WHERE account = 'premium' OR account = 'normal'";
						} else {
							$total = "SELECT count(*) FROM UTasksMAIN.users"; // count total users
						}

						$countTotal=  mysql_query($total) or die(mysql_error());
						$resTotal = mysql_fetch_array($countTotal);

						if ($userdat_acctype != "admin"){
							$online = "SELECT count(*) FROM UTasksMAIN.users WHERE status='online' AND account = 'premium' OR status='online' AND account = 'normal'"; // count users online
						} else {
							$online="SELECT count(*) FROM UTasksMAIN.users WHERE status='online'"; // count users online
						}

						$countOnline=  mysql_query($online) or die(mysql_error());
						$resOnline= mysql_fetch_array($countOnline);
					?>
					<p><i class="fas fa-info-circle"></i> There are <b><?php echo $resOnline[0];?></b>/<b><?php echo $resTotal[0]; ?></b> users <b>online</b>. Online users have an <span class='badge badge-success'>online</span> badge, while offline users have an <span class='badge badge-secondary'>offline</span> badge as their status.</p>
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
      </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>