<?php 
session_start();
if (!isset($_SESSION['session_tasks_start'])) 
    header('location:login?notice=2');   
?>

<?php
	include '_inc/dbconn.php';
	$account_id = $_SESSION['session_tasks_id'];
	$account_name = $_SESSION['session_tasks_name'];

	if (isset($_REQUEST['task_create'])){ // Create task request from the modal
		// variables from create task boxes
		$ins_title =  $_POST['task_title'];
		$ins_label =  $_POST['task_label'];
		$duedate = $_POST['task_duedate'];
		$duetime = $_POST['task_duetime'];
		$ins_duedate = date('Y-m-d H:i:s', strtotime("$duedate $duetime"));
		$ins_priority = $_POST['task_priority'];
		$ins_content =  $_POST['task_description'];
		$ins_date = date("Y-m-d H:i:s");

		// setting bookmark variable
		if ($_POST['task_bookmark'] == "1"){
			$ins_bookmark = "1";
		} else {
			$ins_bookmark = "0";
		}

		// Insert new task to table 'tasks' with userid
		$inssql = "INSERT INTO UTasksDAT.tasks".$account_id." values('','$account_name','$ins_title','$ins_content','$ins_date','$ins_duedate','$ins_label','','','','$ins_bookmark','$ins_priority','ACTIVE')";
		mysql_query($inssql) or die(mysql_error());
		header('location:home?success=1');
		
	} elseif (isset($_REQUEST['task_delete'])){ // Delete task request
		
		$deltaskid = $_POST['task_id'];
		if ($deltaskid == ""){
			header('location:home?error=3');
		} else {
			$sql_delete = "DELETE FROM UTasksDAT.tasks".$account_id." WHERE id = '$deltaskid'";
			mysql_query($sql_delete) or die(mysql_error());
			header('location:home?success=2');
		}
	} elseif (isset($_REQUEST['task'])){ // View task request
		$itemid = $_GET['task'];
			$sql2 = "SELECT * FROM UTasksDAT.tasks".$account_id." LEFT JOIN UTasksDAT.label".$account_id." on UTasksDAT.tasks".$account_id.".label = label".$account_id.".label_id WHERE id='$itemid'";
			$result2 = mysql_query($sql2) or die(mysql_error());
			$rws2 = mysql_fetch_array($result2);
		?>
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
	
	<title>Editing: <?php echo $rws2[2]; ?> | UTasks </title>
  </head>
  <body id="page-top">
    <?php include 'aheader.php' ?>

      <div id="content-wrapper">
        <div class="container-fluid">		  
		  <div class="row">
			<div class="col-xl-12 mb-6">
			  <div class="card o-hidden mb-3" id="general">
				  <div class="panel-group" id="accordion">
					  <div class="panel panel-default">
						<div class="panel-heading">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="color: inherit; text-decoration: none">
							  <div class="card-header">
							  <i class="fas fa-pencil-alt"></i>
							  Viewing task: <i><?php echo $rws2[2]; ?></i></div>
							</a>
						</div>
						<div id="collapse2" class="panel-collapse in">
						  <div class="panel-body">
							  <div class="card-body">
								<form action="edit" method="POST">	
									  <div class="row">
										<div class="col-xl-4 form-group">
											<input type="hidden" name="task_id" value="<?php echo $itemid; ?>"/>
											<small id="taskHelp" class="form-text">Task Title</small>
											<input type="text" class="form-control" name="task_alter_title" value="<?php echo $rws2[2]; ?>">
										</div>
										<div class="col-xl-4 form-group">
											<small id="taskHelp" class="form-text">Label</small>
											<select class="form-control" name="task_alter_label">
												<?php // option depends on selection of label or not
												if ($rws2[12] == ""){ // show when no label added ?>
													<option value="" disabled selected>No label added.</option>
													<option value="" disabled>Select one of your labels below to add or select none to remove.</option>
													<option value="" disabled></option>
												<?php } else {  // show when a label is added ?>
													<option value="<?php echo $rws2[6]; ?>" selected>current label: <?php echo $rws2[14].' ('.strtolower($rws2[15]).')'; ?></option>
													<option value="" disabled>Select one of your labels below to change it to or select none.</option>
													<option value="" disabled></option>
												<?php } ?>
													<?php include '_inc/dbconn.php';
														$sql3 = "SELECT * FROM UTasksDAT.label".$account_id;
														$result3 = mysql_query($sql3) or die(mysql_error());
														
														while($rws3 = mysql_fetch_array($result3)){
															// displaying labels
															echo "<option value='".$rws3[0]."'>".$rws3[1]." (".strtolower($rws3[2]).")</option>";
														} 
													?>
													<option value="">None</option>
											</select>
										</div>
										<div class="col-xl-4 form-group">
											<small id="taskHelp" class="form-text">Priority</small>
											<select class="form-control" name="task_alter_priority">
												<option value="0" <?php if ($rws2[11] == "0"){ echo 'selected'; } ?>>None</option>
												<option value="1" <?php if ($rws2[11] == "1"){ echo 'selected'; } ?>>Low</option>
												<option value="2" <?php if ($rws2[11] == "2"){ echo 'selected'; } ?>>Medium</option>
												<option value="3" <?php if ($rws2[11] == "3"){ echo 'selected'; } ?>>High</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-xl-4 form-group">
											<small id="taskHelp" class="form-text">Location</small>
											<input type="text" class="form-control" name="task_alter_location" value="<?php echo $rws2[7]; ?>">
										</div>
										<div class="col-xl-4 form-group">
											<small id="taskHelp" class="form-text">People/Guests (seperated with a comma)</small>
											<input type="text" class="form-control" name="task_alter_people" value="<?php echo $rws2[8]; ?>">
										</div>
										<div class="col-xl-4 form-group">
											<small id="taskHelp" class="form-text">Due Date</small>
											<input type="text" class="form-control" name="task_alter_duedate" value="<?php echo $rws2[5]; ?>">
										</div>
									</div>
									<small class="form-text">Task Description</small>
									<textarea class="form-control" name="task_alter_content" rows="5"><?php echo $rws2[3]; ?></textarea>
									<small class="form-text"><input type="checkbox" value="1" name="task_alter_bookmark" <?php if ($rws2[10] == "1"){ echo "checked";} ?>> Bookmark Task (This will pin your task at the top of the tasks page.)</small>
									<small class="form-text"><input type="checkbox" value="1" name="task_alter_archive" <?php if ($rws2[12] == "ARCHIVED"){ echo "checked";} ?>> Archive Task (This will move your task to the archived section.)
									<div class="text-right">
										Last Modified: <?php echo $rws2[4]; ?>&nbsp;
										<a href="home" class="btn btn-secondary">Discard</a>
										<a href="#" class="btn btn-danger" role="button" data-toggle="modal" data-target="#deletetaskModal" aria-haspopup="true" aria-expanded="false"><i class="fas fa-trash-alt"></i> Delete task</a>
										<button type="submit" class="btn btn-success" name="task_alter"><i class="fas fa-save"></i> Save edited task</button>
									</div>
							  </div>
						  </div>
						</div>
					  </div>
				  </div> 
			  </div>
			</div>
		  </div> <!-- /.row -->
      </div><!-- /.container-fluid -->
	  
	  <!-- Delete task Modal-->
		<div class="modal fade" id="deletetaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Are you sure you want to delete this task?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
			  </div>
			  <div class="modal-body">This task will be deleted permanently and you can't recover it in the future.
			  Please check if it's the right one, because it may lead to <b>huge problems</b> if you delete the wrong task!</div>
			  <div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<input class="btn btn-danger" type="submit" name="task_delete" value="I am sure, delete it!" />
				</form>
			  </div>
			</div>
		  </div>
		</div>

    <?php include 'afooter.php' ?>
	
<?php	
	} elseif (isset($_REQUEST['task_alter'])){ // Update task request
		
		$altertaskid = $_POST['task_id'];
		$alt_title = mysql_real_escape_string($_REQUEST['task_alter_title']);
		$alt_label = mysql_real_escape_string($_REQUEST['task_alter_label']);
		$alt_priority = mysql_real_escape_string($_REQUEST['task_alter_priority']);
		$alt_location = mysql_real_escape_string($_REQUEST['task_alter_location']);
		$alt_people = mysql_real_escape_string($_REQUEST['task_alter_people']);
		$alt_duedate = mysql_real_escape_string($_REQUEST['task_alter_duedate']);
		$alt_content = mysql_real_escape_string($_REQUEST['task_alter_content']);
		$alt_bookmark = mysql_real_escape_string($_REQUEST['task_alter_bookmark']);
		$currentdate = date("Y-m-d H:i:s");

		// setting archive variable
		if ($_REQUEST['task_alter_archive'] == "1"){
			$alt_archive = "ARCHIVED";
		} else {
			$alt_archive = "ACTIVE";
		}
		
		$alter_sql = "UPDATE UTasksDAT.tasks".$account_id." SET title='$alt_title', description='$alt_content', dateon='$currentdate', lastdate='$alt_duedate', label='$alt_label', location='$alt_location', people='$alt_people', favorite='$alt_bookmark', priority='$alt_priority', status='$alt_archive' WHERE id='$altertaskid'";
		mysql_query($alter_sql) or die(mysql_error());
		header('location:home?success=3');
		
	} else {
		header("location:home?error=1");
	}
?>