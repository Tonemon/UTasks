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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/css/sb-admin.css" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="vendor/js/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	
	<title>All your Tasks Online | UTasks User Panel </title>
  </head>
  <body id="page-top">
    <?php include 'aheader.php' ?>

	<div id="content-wrapper">
      <div class="container-fluid">
        <?php
			if ($_GET['success'] == "1") { // successfully created
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i> New task created. </div>";
			} elseif ($_GET['success'] == "2") { // successfully deleted
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i> Task successfully deleted.</div>";
			} elseif ($_GET['success'] == "3") { // successfully edited
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i> Task successfully edited.</div>";
			} elseif ($_GET['success'] == "4") { // successfully customized dashboard
				echo "<div class='alert alert-success alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-check'></i> Dashboard updated. Click on the icon on the right to edit your dashboard.</div>";
			} elseif ($_GET['error'] == "1") { // error: something wrong
				echo "<div class='alert alert-warning alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-exclamation-triangle'></i> Oh. Something went wrong. Please try again.</div>";
			} elseif ($_GET['error'] == "2") { // error: no access
				echo "<div class='alert alert-danger alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-exclamation-triangle'></i> You dont have access to this page.</div>";
			} elseif ($_GET['error'] == "3") { // error: no task selected
				echo "<div class='alert alert-warning alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-exclamation-triangle'></i> No task selected to perform this action. Please try again.</div>";
			}
		?>
		
		<!-- Customizable Icon Cards-->
		<?php include '_inc/dbconn.php';
			// The code below gets the custom user settings for the cards from their UTasksMAIN.users record. These values can be changed in the users settings panel.
			$cardcheck = "SELECT card_active,card_week,card_passed,card_archived,card_total FROM UTasksMAIN.users WHERE id=".$userdat_id;
			$cardresult = mysql_query($cardcheck) or die(mysql_error());
			$arr =  mysql_fetch_array($cardresult);
		?>

        <div class="row">
          <?php if ($arr[0] == "1"){ ?>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-clipboard-list"></i>
                </div>
                <?php include '_inc/dbconn.php';
					$activesql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id WHERE status='ACTIVE'";
					$activeresult = mysql_query($activesql) or die(mysql_error());
					$item_count = mysql_num_rows($activeresult);
				?>	
                <div class="mr-5"><b><?php echo $item_count; ?></b> active Tasks.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="tasks?advanced_search&status=active">
                <span class="float-left">View Tasks <small>(active)</small></span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
      	  <?php } if ($arr[1] == "1") { ?>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-calendar-alt"></i>
                </div>
                <?php include '_inc/dbconn.php';
					$weeksql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id WHERE `lastdate` BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)";

					$weekresult = mysql_query($weeksql) or die(mysql_error());
					$week_count = mysql_num_rows($weekresult);
				?>
                <div class="mr-5"><b><?php echo $week_count; ?></b> to complete this week.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="tasks?advanced_search&show=week">
                <span class="float-left">View Tasks <small>(this week)</small></span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>

      	  <?php } if ($arr[2] == "1") { ?>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-calendar-times"></i>
                </div>
                <?php include '_inc/dbconn.php';
					$passedsql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id WHERE `lastdate` < sysdate()";

					$passedresult = mysql_query($passedsql) or die(mysql_error());
					$passed_count = mysql_num_rows($passedresult);
				?>
                <div class="mr-5"><b><?php echo $passed_count; ?></b> deadlines passed.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="tasks?advanced_search&show=passed">
                <span class="float-left">View Tasks <small>(with deadline passed)</small></span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>

      	  <?php } if ($arr[3] == "1") { ?>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-archive"></i>
                </div>
                <?php include '_inc/dbconn.php';
					$archivedsql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id WHERE status='ARCHIVED'";

					$archivedresult = mysql_query($archivedsql) or die(mysql_error());
					$archived_count = mysql_num_rows($archivedresult);
				?>	
                <div class="mr-5"><b><?php echo $archived_count; ?></b> Tasks archived.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="tasks?advanced_search&status=archived">
                <span class="float-left">View Tasks <small>(archived)</small></span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>

      	  <?php } if ($arr[4] == "1") { ?>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-sticky-note"></i>
                </div>
                <?php include '_inc/dbconn.php';
					$totalsql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id";

					$totalresult = mysql_query($totalsql) or die(mysql_error());
					$total_count = mysql_num_rows($totalresult);
				?>	
                <div class="mr-5"><b><?php echo $total_count; ?></b> Tasks total.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="tasks?show=all">
                <span class="float-left">View All</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
      	  <?php } ?>
        </div>

        <!-- Tasks section -->
        <?php include '_inc/dbconn.php';
			// The code below gets the custom user settings for the sections (open/closed) from their UTasksMAIN.users record. These values can be changed in the users settings panel.
			$sectioncheck = "SELECT section_bookmark,section_active,section_archived FROM UTasksMAIN.users WHERE id=".$userdat_id;
			$sectionresult = mysql_query($sectioncheck) or die(mysql_error());
			$arr2 =  mysql_fetch_array($sectionresult);
		?>

		<!-- Bookmarked tasks section -->
		  <div class="row">
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
			  	<?php include '_inc/dbconn.php';
					$sql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id WHERE favorite=1";
					$result = mysql_query($sql) or die(mysql_error());
					$num_rows = mysql_num_rows($result);
				?>
				  <div class="panel-group" id="accordion">
					  <div class="panel panel-default">
						<div class="panel-heading">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseBookmarked" style="color: inherit; text-decoration: none">
							  <div class="card-header">
							  <i class="fas fa-star"></i>
							  Bookmarked Tasks (<b><?php echo $num_rows; ?></b>)</div>
							</a>
						</div>
						<div id="collapseBookmarked" class="panel-collapse <?php if ($arr2[0] == "1"){ echo 'in'; } else { echo 'collapse'; }?>">
						  <div class="panel-body">
							  <div class="card-body">
								<form action="task-edit" method="POST">	
									<small id="infoHelp" class="form-text">
									<?php
									if ($num_rows == "0"){
										echo 'You have <b>0 bookmarked tasks</b>. Bookmark some <b><i class="fas fa-sticky-note"></i> tasks</b> on the <b><i class="fas fa-pencil-alt"></i>edit</b> page to make them appear here.';
									} elseif ($num_rows == "1"){
										echo 'You have <b>1 bookmarked task</b>. Select a <b><i class="fas fa-sticky-note"></i> task</b> below to view/edit.';
									} else {
										echo 'You have <b>'.$num_rows.' bookmarked tasks</b>. Select a <b><i class="fas fa-sticky-note"></i> task</b> below to view/edit.';
									}
									?></small><br>
									<?php
									  	echo '<div class="list-group">';
										while ($rws = mysql_fetch_array($result)){
											// color matching the badges
											if ($rws[15] == "LIGHTBLUE") {
												$badgecolor = "info";
											} elseif ($rws[15] == "BLUE") {
												$badgecolor = "primary";
											} elseif ($rws[15] == "GRAY") {
												$badgecolor = "secondary";
											} elseif ($rws[15] == "GREEN") {
												$badgecolor = "success";
											} elseif ($rws[15] == "RED") {
												$badgecolor = "danger";
											} elseif ($rws[15] == "YELLOW") {
												$badgecolor = "warning";
											} elseif ($rws[15] == "BLACK") {
												$badgecolor = "dark";
											}

											if ($rws[11] == "0"){
												$priority = "None";
												$priority_color = "secondary";
											} elseif ($rws[11] == "1"){
												$priority = "Low";
												$priority_color = "info";
											} elseif ($rws[11] == "2"){
												$priority = "Medium";
												$priority_color = "warning";
											} elseif ($rws[11] == "3"){
												$priority = "High";
												$priority_color = "danger";
											}

											// making date readable
											$createdate = date_create($rws[5]);
											$Date = date_format($createdate,"l, d F Y, H:i");
											// Item output
  											echo '<a href="edit?task='.$rws[0].'" class="list-group-item list-group-item-action flex-column align-items-start">';
											echo '<div class="d-flex w-100 justify-content-between">';
											echo '<h5 class="mb-1"><i class="fas fa-sticky-note"></i> '.$rws[2].'</h5>';
											echo '<small><i>Todo before:</i> <b>'.$Date.'</b></small>';
											echo '</div>';
											echo '<p class="mb-1"><i>'.substr($rws[3], 0, 100).'...</i></p>';
											
											if ($rws[9] != ""){
												echo "<small><i>Saved with Label:</i> <span class='badge badge-".$badgecolor."'>".$rws[14]."</span>. Priority: <span class='badge badge-".$priority_color."'>".$priority."</span></small>";
											} else {
												echo "<small><i>Not saved with a label.</i></small>";
											}	
											echo '</a>';
										} 
										echo '</div>'; ?>
								</form>
							  </div>
						  </div>
						</div>
					  </div>
				  </div> 
			  </div>
			</div>
		  </div> <!-- /.row -->

		<!-- Other tasks section -->
		  <div class="row">
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
			  	<?php include '_inc/dbconn.php';
					$sql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id WHERE favorite=0 AND status='ACTIVE'";
					$result = mysql_query($sql) or die(mysql_error());
					$num_rows = mysql_num_rows($result);
				?>	
				  <div class="panel-group" id="accordion">
					  <div class="panel panel-default">
						<div class="panel-heading">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTasks" style="color: inherit; text-decoration: none">
							  <div class="card-header">
							  <i class="far fa-sticky-note"></i>
							  Your active Tasks (<b><?php echo $num_rows; ?></b>)</div>
							</a>
						</div>
						<div id="collapseTasks" class="panel-collapse <?php if ($arr2[1] == "1"){ echo'in'; } else { echo 'collapse'; }?>">
						  <div class="panel-body">
							  <div class="card-body">
								<form action="task-edit" method="POST">
									<small id="emailHelp" class="form-text">You have <b><?php echo $num_rows; if ($num_rows == "1") { echo " active task</b>."; } else { echo " active tasks</b> in total."; } ?> Select a <b><i class="fas fa-sticky-note"></i> task</b> below to view/edit. Can't find a <b><i class="fas fa-sticky-note"></i> task</b>? Go to the <b><a href="tasks"><i class="fas fa-search"></i> search page</a></b>.</small><br>

									  <?php
									  	echo '<div class="list-group">';
										while ($rws = mysql_fetch_array($result)){
											// color matching the badges
											if ($rws[15] == "LIGHTBLUE") {
												$badgecolor = "info";
											} elseif ($rws[15] == "BLUE") {
												$badgecolor = "primary";
											} elseif ($rws[15] == "GRAY") {
												$badgecolor = "secondary";
											} elseif ($rws[15] == "GREEN") {
												$badgecolor = "success";
											} elseif ($rws[15] == "RED") {
												$badgecolor = "danger";
											} elseif ($rws[15] == "YELLOW") {
												$badgecolor = "warning";
											} elseif ($rws[15] == "BLACK") {
												$badgecolor = "dark";
											}

											if ($rws[11] == "0"){
												$priority = "None";
												$priority_color = "secondary";
											} elseif ($rws[11] == "1"){
												$priority = "Low";
												$priority_color = "info";
											} elseif ($rws[11] == "2"){
												$priority = "Medium";
												$priority_color = "warning";
											} elseif ($rws[11] == "3"){
												$priority = "High";
												$priority_color = "danger";
											}

											// making date readable
											$createdate = date_create($rws[5]);
											$Date = date_format($createdate,"l, d F Y, H:i");
											// Item output
  											echo '<a href="edit?task='.$rws[0].'" class="list-group-item list-group-item-action flex-column align-items-start">';
											echo '<div class="d-flex w-100 justify-content-between">';
											echo '<h5 class="mb-1"><i class="fas fa-sticky-note"></i> '.$rws[2].'</h5>';
											echo '<small><i>Todo before:</i> <b>'.$Date.'</b></small>';
											echo '</div>';
											echo '<p class="mb-1"><i>'.substr($rws[3], 0, 100).'...</i></p>';
											
											if ($rws[9] != ""){
												echo "<small><i>Saved with Label:</i> <span class='badge badge-".$badgecolor."'>".$rws[14]."</span>. Priority: <span class='badge badge-".$priority_color."'>".$priority."</span></small>";
											} else {
												echo "<small><i>Not saved with a label.</i></small>";
											}	
											echo '</a>';
										} 
										echo '</div>'; ?>
								</form>
							  </div>
						  </div>
						</div>
					  </div>
				  </div> 
			  </div>
			</div>
		  </div> <!-- /.row -->

		<!-- Archived tasks section -->
		  <div class="row">
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
			  	<?php include '_inc/dbconn.php';
					$sql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id WHERE status='ARCHIVED'";
					$result=  mysql_query($sql) or die(mysql_error());
					$num_rows3 = mysql_num_rows($result);
				?>	
				  <div class="panel-group" id="accordion">
					  <div class="panel panel-default">
						<div class="panel-heading">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseArchived" style="color: inherit; text-decoration: none">
							  <div class="card-header">
							  <i class="fas fa-box"></i>
							  Archived Tasks (<b><?php echo $num_rows3; ?></b>)</div>
							</a>
						</div>
						<div id="collapseArchived" class="panel-collapse <?php if ($arr2[2] == "1"){ echo'in'; } else { echo 'collapse'; }?>">
						  <div class="panel-body">
							  <div class="card-body">
								<form action="task-edit" method="POST">
									<small id="infoHelp" class="form-text">
									<?php
										if ($num_rows3 == "0"){
											echo 'You have <b>0 archived tasks</b>. Change the <b><i class="fas fa-sticky-note"></i> task</b> status from "active" to "archived" on the <b><i class="fas fa-pencil-alt"></i>edit</b> page to make them appear here.';
										} elseif ($num_rows3 == "1"){
											echo 'You have <b>1 archived task</b>. Select a <b><i class="fas fa-sticky-note"></i> task</b> below to view/edit.';
										} else {
											echo 'You have <b>'.$num_rows3.' archived tasks</b>. Select a <b><i class="fas fa-sticky-note"></i> task</b> below to view/edit.';
										}
									?></small><br>
									  <?php
									  	echo '<div class="list-group">';
										while ($rws = mysql_fetch_array($result)){
											// color matching the badges
											if ($rws[15] == "LIGHTBLUE") {
												$badgecolor = "info";
											} elseif ($rws[15] == "BLUE") {
												$badgecolor = "primary";
											} elseif ($rws[15] == "GRAY") {
												$badgecolor = "secondary";
											} elseif ($rws[15] == "GREEN") {
												$badgecolor = "success";
											} elseif ($rws[15] == "RED") {
												$badgecolor = "danger";
											} elseif ($rws[15] == "YELLOW") {
												$badgecolor = "warning";
											} elseif ($rws[15] == "BLACK") {
												$badgecolor = "dark";
											}

											if ($rws[11] == "0"){
												$priority = "None";
												$priority_color = "secondary";
											} elseif ($rws[11] == "1"){
												$priority = "Low";
												$priority_color = "info";
											} elseif ($rws[11] == "2"){
												$priority = "Medium";
												$priority_color = "warning";
											} elseif ($rws[11] == "3"){
												$priority = "High";
												$priority_color = "danger";
											}

											// making date readable
											$createdate = date_create($rws[5]);
											$Date = date_format($createdate,"l, d F Y, H:i");
											// Item output
  											echo '<a href="edit?task='.$rws[0].'" class="list-group-item list-group-item-action flex-column align-items-start">';
											echo '<div class="d-flex w-100 justify-content-between">';
											echo '<h5 class="mb-1"><i class="fas fa-sticky-note"></i> '.$rws[2].'</h5>';
											echo '<small><i>Todo before:</i> <b>'.$Date.'</b></small>';
											echo '</div>';
											echo '<p class="mb-1"><i>'.substr($rws[3], 0, 100).'...</i></p>';

											if ($rws[9] != ""){
												echo "<small><i>Saved with Label:</i> <span class='badge badge-".$badgecolor."'>".$rws[14]."</span>. Priority: <span class='badge badge-".$priority_color."'>".$priority."</span></small>";
											} else {
												echo "<small><i>Not saved with a label.</i></small>";
											}	
											echo '</a>';
										} 
										echo '</div>'; ?>
								</form>
							  </div>
						  </div>
						</div>
					  </div>
				  </div> 
			  </div>
			</div>
		  </div> <!-- /.row -->

	<!-- Quick Dashboard customization-->
    <a href="settings" title="Customize dashboard">
    	<div style="position: fixed;top: 0;right: 20px;background-color: #28a745;box-shadow: 0 4px 8px rgba(0,0,0,.05);border-radius: 0 0 20px 20px;font-size: 12px;padding: 10px 10px;">
    		<i class="fas fa-fw fa-2x fa-palette text-white"></i>
    	</div>
    </a>

    <?php include 'afooter.php' ?>