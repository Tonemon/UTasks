<?php 
session_start();
if (!isset($_SESSION['session_tasks_start'])) 
    header('location:login');   
?>

<?php
	include '_inc/dbconn.php';
	$account_id = $_SESSION['user_id'];
	$account_name = $_SESSION['name'];

	// Use selected label to perform actions on
	$labelid = $_POST['label_id'];

	if (isset($_REQUEST['label_create'])){ // Create label request
		include 'aheader.php';
		$title =  $_POST['label_title'];
		$color =  $_POST['label_color'];

		// count current amount of labels
		$count_label = "SELECT count(*) FROM UTasksDAT.label".$userdat_id."";
		$result_count=  mysql_query($count_label) or die(mysql_error());
		$label_count = mysql_fetch_array($result_count);

		if ($userdat_acctype == "normal" AND $label_count[0] >= "5"){ // normal users can only have 5 labels
			header('location:labels?error=2');
		} else {
			// Insert new label to table 'label' with user
			$sql = "INSERT INTO UTasksDAT.label".$userdat_id." values('','$title','$color')";
			mysql_query($sql) or die(header('location:labels?error=1'));
			header('location:labels?success=1');
		}		
	} elseif (isset($_REQUEST['label_delete'])){ // Delete label request
		if ($labelid == ""){
			header('location:labels?error=3');
		} else {
			include 'aheader.php';
			$sql_delete2 = "DELETE FROM UTasksDAT.label".$userdat_id." WHERE `label_id` = '$labelid'";
			mysql_query($sql_delete2) or die(header("location:labels?error=1"));
			header('location:labels?success=2');
		}
	} elseif (isset($_REQUEST['label_alter'])){ // Alter label request
		include 'aheader.php';
		$alterlabelid =  $_POST['label_alter_id'];
		$edit_title =  $_POST['label_alter_title'];
		$edit_color =  $_POST['label_alter_color'];
		
		$sql2 = "UPDATE UTasksDAT.label".$userdat_id." SET name='$edit_title', color='$edit_color' WHERE label_id='$alterlabelid'";
		$result2 = mysql_query($sql2) or die(mysql_error());
		header('location:labels?success=3');
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/css/sb-admin.css" rel="stylesheet">


    <!-- Page level plugin CSS-->
    <link href="vendor/js/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	
	<title>Your Labels | UTasks </title>
  </head>
  <body id="page-top">
    <?php include 'aheader.php' ?>

      <div id="content-wrapper">
        <div class="container-fluid">
		  <?php
				if ($_GET['success'] == "1") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> New label created. </div>";
				} elseif ($_GET['success'] == "2") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Label successfully deleted.</div>";
				} elseif ($_GET['success'] == "3") {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Label successfully altered.</div>";
				} elseif ($_GET['error'] == "1") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> Oh. Something went wrong. Please try again.</div>";
				} elseif ($_GET['error'] == "2") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i> You have reached your limit of 5 labels. Join <a href='#'' id='pagesDropdown' role='button' data-toggle='modal' data-target='#premiumModal' aria-haspopup='true' aria-expanded='false'><i class='far fa-gem'></i> <span>UTasks Premium</span></a> for unlimited labels!
						</div>";
				} elseif ($_GET['error'] == "3") {
					echo "<div class='alert alert-warning alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-times'></i> No label selected to perform action. Please select one first.</div>";
				}
		  ?>
		  <div class="row">
		    <div class="col-xl-7 mb-6">
			  <div class="card o-hidden mb-3">
				  <div class="panel-group" id="accordion">
					  <div class="panel panel-default">
						<div class="panel-heading">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="color: inherit; text-decoration: none">
							  <div class="card-header">
							  <i class="far fa-folder-open"></i>
							  Your Labels</div>
							</a>
						</div>
						<div id="collapse2" class="panel-collapse in">
						  <div class="panel-body">
							  <div class="card-body">
								<?php include '_inc/dbconn.php';
										$sql = "SELECT * FROM UTasksDAT.label".$userdat_id;
										$result = mysql_query($sql) or die(mysql_error());
										$num_rows = mysql_num_rows($result);										
									?>	
									<small id="emailHelp" class="form-text">You have <b><?php echo $num_rows; if ($num_rows == "1") { echo " label</b>."; } else { echo " labels</b>."; } ?>
									Use the <b><i class="fas fa-search"></i> search bar</b> on the right to <b><i class="fas fa-filter"></i> filter</b> your labels. Select a <b><i class="fas fa-folder-open"></i> label</b> below to perform actions on. <b><i class="fas fa-info-circle"></i> Watch out</b> when deleting labels! All tasks with that label will be set to '<i>No Label</i>'.</small><br>	
									 <form action="labels" method="POST">
									  <div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										  <thead>
											<tr>
											  <th>Label</th>
											  <th>Action</th>
											</tr>
										  </thead>
										  <tbody>
											<?php
												while ($rws = mysql_fetch_array($result)){
													// color matching for the badges
													if ($rws[2] == "LIGHTBLUE") {
														$badgecolor = "info";
													} elseif ($rws[2] == "BLUE") {
														$badgecolor = "primary";
													} elseif ($rws[2] == "GRAY") {
														$badgecolor = "secondary";
													} elseif ($rws[2] == "GREEN") {
														$badgecolor = "success";
													} elseif ($rws[2] == "RED") {
														$badgecolor = "danger";
													} elseif ($rws[2] == "YELLOW") {
														$badgecolor = "warning";
													} elseif ($rws[2] == "BLACK") {
														$badgecolor = "dark";
													}
													
													// Displaying table items
													echo "<tr>";
													echo "<td><i class='far fa-folder-open'></i> <span class='badge badge-".$badgecolor."'>".$rws[1]."</span></td>";
													echo "<td><input type='radio' name='label_id' value=".$rws[0]." /></td>";
													echo "</tr>";
												} ?>
										  </tbody>
										</table><br>
										<div class="text-right">
											<button type="submit" class="btn btn-danger" name="label_delete"><i class="fas fa-trash-alt"></i> Delete Label</button>
											<button type="submit" class="btn btn-warning" name="label_edit"><i class="fas fa-pencil-alt"></i> Edit Label</button>
										</div>
									  </div>
								</form>
							  </div>
						  </div>
						</div>
					  </div>
				  </div> 
			  </div>
			</div>
			<div class="col-xl-5 mb-6">
			 <?php if (isset($_REQUEST['label_edit'])){ // Edit label request
			    $labelid = $_POST['label_id'];
				$sql2 = "SELECT * FROM UTasksDAT.label".$userdat_id." WHERE label_id='$labelid'";
				$result2 = mysql_query($sql2) or die(mysql_error());
				$rws2 = mysql_fetch_array($result2);
			  ?>
			  <div class="card o-hidden mb-3">
				  <div class="panel-group" id="accordion">
					  <div class="panel panel-default">
						<div class="panel-heading">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="color: inherit; text-decoration: none">
							  <div class="card-header">
							  <i class="fas fa-pencil-alt"></i>
							  Edit Label</div>
							</a>
						</div>
						<div id="collapse4" class="panel-collapse in">
						  <div class="panel-body">
							  <div class="card-body">
								<form action="labels" method="POST">
									<div class="row">
									  <div class="col-xl-7 form-group">
									    <input type="hidden" name="label_alter_id" value="<?php echo $labelid;?>"/>
										<small class="form-text">New Label Title</small>
										<input type="text" class="form-control" name="label_alter_title" value="<?php echo $rws2[1]; ?>">
									  </div>
									  <div class="col-xl-5 form-group">
									    <small class="form-text">Label Color</small>
										<select class="form-control" name="label_alter_color">
										  <option value="<?php echo $rws2[2]; ?>" selected>current: <?php echo ucwords(strtolower($rws2[2])); ?></option>
										  <option value="" disabled></option>
										  <option value="BLUE">Blue</option>
										  <option value="GRAY">Gray</option>
										  <option value="GREEN">Green</option>
										  <option value="RED">Red</option>
										  <option value="YELLOW">Yellow</option>
										  <option value="LIGHTBLUE">Lightblue</option>
										  <option value="BLACK">Black</option>
										</select>
										<a href="#" id="pagesDropdown" role="button" data-toggle="modal" data-target="#colorsModal" aria-haspopup="true" aria-expanded="false">What are these colors?</a>
									  </div>
									  <div class="col-xl-1 form-group">
									    <button type="submit" name="label_alter" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Rename Label</button>
									  </div>
									</div>
								</form>
							  </div>
						  </div>
						</div>
					  </div>
				  </div> 
			  </div>
			  <?php } else { ?>
			  <div class="card o-hidden mb-3" id="general">
				  <div class="panel-group" id="accordion">
					  <div class="panel panel-default">
						<div class="panel-heading">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="color: inherit; text-decoration: none">
							  <div class="card-header">
							  <i class="fas fa-folder-plus"></i>
							  New Label</div>
							</a>
						</div>
						<div id="collapse1" class="panel-collapse in">
						  <div class="panel-body">
							  <div class="card-body">
								<form action="labels" method="POST">
									<div class="row">
									  <div class="col-xl-7 form-group">
									    <small class="form-text">Label Title</small>
										<input type="text" class="form-control" name="label_title" placeholder="Example: Archive">
									  </div>
									  <div class="col-xl-5 form-group">
									    <small class="form-text">Label Color</small>
										<select class="form-control" name="label_color">
										  <option value="BLUE">Blue</option>
										  <option value="GRAY">Gray</option>
										  <option value="GREEN">Green</option>
										  <option value="RED">Red</option>
										  <option value="YELLOW">Yellow</option>
										  <option value="LIGHTBLUE">Lightblue</option>
										  <option value="BLACK">Black</option>
										</select>
										<a href="#" id="pagesDropdown" role="button" data-toggle="modal" data-target="#colorsModal" aria-haspopup="true" aria-expanded="false">What are these colors?</a>
									  </div>
									  <div class="col-xl-1 form-group">
										<button type="submit" name="label_create" class="btn btn-success"><i class="fas fa-plus"></i> Create new Label</button>
									  </div>
									</div>
								</form>
							  </div>
						  </div>
						</div>
					  </div>
				  </div> 
			  </div>
			  <?php } ?>
			</div>
		  </div> <!-- /.row -->
      </div><!-- /.container-fluid -->
	  
	<!-- Label colors info Modal-->
    <div class="modal fade" id="colorsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-palette"></i> Label coloring system</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
			<p>People tend to recognise things faster by color. To keep your work more productive we implemented the use of colored labels on the labels.<br><br>
			The following colors are supported:<br>
				<span class="badge badge-primary">Blue</span>
				<span class="badge badge-secondary">Gray</span>
				<span class="badge badge-success">Green</span>
				<span class="badge badge-danger">Red</span>
				<span class="badge badge-warning">Yellow</span>
				<span class="badge badge-info">Lightblue</span>
				<span class="badge badge-dark">Black</span><br><br>
				This is how it will look on your tasks:<br>
				<i>Dinner Yesterday <span class="badge badge-success">Archived</span></i><br>
				<i>Grocery List 2 <span class="badge badge-danger">Todo</span></i>
			</p>
		  </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Dismiss</button>
          </div>
        </div>
      </div>
    </div>

    <?php include 'afooter.php' ?>