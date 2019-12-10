<?php 
session_start();
if (!isset($_SESSION['session_tasks_start']))
	header('location:login?notice=2');
?>

<?php
$account_id = $userdat_id = $_SESSION['session_tasks_id'];

if (isset($_REQUEST['normal_search'])){ // user presses the normal search button
	$startsql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id";

	$searchbar_input = $_GET['search'];
	$continuesql = " WHERE title LIKE '%".$searchbar_input."%' OR description LIKE '%".$searchbar_input."%' OR location LIKE '%".$searchbar_input."%' OR people LIKE '%".$searchbar_input."%' OR name LIKE '%".$searchbar_input."%'";

	$final_sql = $startsql.$continuesql;


} elseif (isset ($_REQUEST['advanced_search'])){ // user presses the advanced search button
	// add check if normal or premium user

	$startsql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id";
	
	$func_show = $_GET['show'];
	if ($func_show == "all"){
		$addon_sql = "";

	} elseif ($func_show == "week"){
		$addon_sql = " WHERE `lastdate` BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)";

	} elseif ($func_show == "passed"){
		$addon_sql = " WHERE lastdate < CURRENT_DATE()";
		$final_sql = $startsql.$addon_sql;

	} else { // (... selected) means 'show' dropdown is not being used, continueing with priority and labels.
		$func_priority = $_GET['priority'];
		if ($func_priority == "high"){
			$addon_sql1 = " WHERE priority=3";
		} elseif ($func_priority == "medium"){
			$addon_sql1 = " WHERE priority=2";
		} elseif ($func_priority == "low") { 
			$addon_sql1 = " WHERE priority=1";
		} elseif ($func_priority == "none"){
			$addon_sql1 = " WHERE priority=0";
		} else { // priority dropdown is not used (...)
			$addon_sql1 = "";
		}
		
		$func_label = $_GET['label'];
		if ($func_priority != "" AND $func_label != ""){ // 'priority' dropdown is being used
			$addon_sql2 = " AND name='".$func_label."'";
		} elseif ($func_priority == "" AND $func_label != ""){ // 'priority' dropdown is not being used
			$addon_sql2 = " WHERE name='".$func_label."'";
		} else { 
			$addon_sql2 = "";
		}

		$func_status = $_GET['status'];
		if ($func_status == "active"){ // priority and label is used, active
			if ($func_label == "" AND $func_priority == ""){
				$addon_sql3 = " WHERE status='ACTIVE'";
			} else {
				$addon_sql3 = " AND status='ACTIVE'";
			}
		} elseif ($func_status == "archived") { // $func_status == "ARCHIVED"
			if ($func_label == "" AND $func_priority == ""){ 
				$addon_sql3 = " WHERE status='ARCHIVED'";
			} else {
				$addon_sql3 = " AND status='ARCHIVED'";
			}
		} else {
			$addon_sql3 = "";
		}
	}

	if ($func_show == "" AND $func_priority == "" AND $func_label == "" AND $func_status == ""){ // no advanced options selected, but advanced search pressed
		$final_sql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id WHERE id='0'";
	} elseif ($func_show == ""){ // 'show' dropdown empty and 
		$final_sql = $startsql.$addon_sql1.$addon_sql2.$addon_sql3;
	} elseif ($func_show != ""){
		$final_sql = $startsql.$addon_sql;
	}

} else { // no search yet, display all tasks (url: tasks?show=all)
	$final_sql = "SELECT * FROM UTasksDAT.tasks".$userdat_id." LEFT JOIN UTasksDAT.label".$userdat_id." on UTasksDAT.tasks".$userdat_id.".label = label".$userdat_id.".label_id";
}
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
	
	<title>Search for Tasks | UTasks User Panel </title>
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
			} elseif ($_GET['error'] == "1") { // error: something wrong
				echo "<div class='alert alert-warning alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-exclamation-triangle'></i> Oh. Something went wrong. Please try again.</div>";
			} elseif ($_GET['error'] == "2") { // error: no access
				echo "<div class='alert alert-danger alert-dismissible'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<i class='fas fa-exclamation-triangle'></i> You dont have access to this feature.</div>";
			}
		?>

		<!-- Search bar -->
		<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form action="tasks">
            <div class="input-group" id="adv-search">
                <input type="text" class="form-control" placeholder="Search for tasks" name="search" />
                <button type="submit" class="btn btn-primary" name="normal_search"><i class="fas fa-search"></i> Search</button></form>
                <div class="input-group-btn">	
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Advanced <span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" style="width: 450px">
                            <form class="form-horizontal" role="form">
                            	<h6 class="dropdown-header">Advanced Search Features</h6>
              					<div class="dropdown-divider"></div>
              					<div class="dropdown-header form-horizontal">
                                  <div class="form-group">
                                  	<div class="row">
                                  		<div class="col-sm-12">
		                                    <label for="filter">Show preselected option:</label>
		                                    <select class="form-control" name="show">
		                                        <option value="" selected>...</option>
		                                        <option value="all">All Tasks</option>
		                                        <option value="week">This week</option>
		                                        <option value="passed">Passed Deadlines</option>
		                                    </select>
		                                </div>
		                            </div>
                                  </div>
                                  <label>Or use more specific search options (leave above empty!):</label><br><br>
                                  <div class="form-group">
                                  	<div class="row">
                                  		<div class="col-sm-4">
		                                	<label for="filter">Priority</label>
		                                    <select class="form-control" name="priority">
		                                        <option value="" selected>...</option>
		                                        <option value="high">High Priority</option>
		                                        <option value="medium">Medium Priority</option>
		                                        <option value="low">Low Priority</option>
		                                        <option value="none">None</option>
		                                    </select>
		                                </div>
                                  		<div class="col-sm-4">
		                                    <label for="filter">Label</label>
											<select class="form-control" name="label">
												<option value="" selected>...</option>
												<?php include '_inc/dbconn.php';
													$sql3 = "SELECT * FROM UTasksDAT.label".$account_id;
													$result3 = mysql_query($sql3) or die(mysql_error());
														
													while($rws3 = mysql_fetch_array($result3)){
														// displaying labels
														echo "<option value='".$rws3[1]."'>".$rws3[1]." (".strtolower($rws3[2]).")</option>";
													} 
												?>
											</select>
										</div>
		                                    
		                                <div class="col-sm-4">
		                                	<label for="filter">Status</label>
		                                    <select class="form-control" name="status">
		                                        <option value="" selected>...</option>
		                                        <option value="active">Active</option>
		                                        <option value="archived">Archived</option>
		                                    </select>
		                                </div>
		                            </div>
                                  </div>
                                  <button type="submit" class="btn btn-primary" name="advanced_search"><i class="fas fa-search"></i> Advanced Search</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
		<div class="col-md-2"></div>
        </div><br>

		<!-- Task Search Section -->
		  <div class="row">
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3">
			  	<?php include '_inc/dbconn.php';
					$result = mysql_query($final_sql) or die(mysql_error());
					$num_rows = mysql_num_rows($result);
				?>	
				  <div class="panel-group" id="accordion">
					  <div class="panel panel-default">
						<div id="collapseTasks" class="panel-collapse in">
						  <div class="panel-body">
							  <div class="card-body">
								<form action="task-edit" method="POST">
									<small id="emailHelp" class="form-text">
										You have <b><?php echo $num_rows; ?> results</b>. <?php if ($num_rows != ""){?>Select a <b><i class="fas fa-sticky-note"></i> task</b> below to view/edit. <?php }?> Can't find a <b><i class="fas fa-sticky-note"></i> task</b>? Use the <b>advanced search features</b> on this page.
									</small><br>

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

    <?php include 'afooter.php' ?>