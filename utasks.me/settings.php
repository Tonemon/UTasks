<?php 
session_start();
if (!isset($_SESSION['session_tasks_start']))
	header('location:login?notice=2');
?>

<?php
	include '_inc/dbconn.php';
	
	// CODE VOOR HET VERANDEREN VAN JE GEGEVENS MOET NOG KOMEN

	if (isset($_REQUEST['submit_customize'])){
		// First c in vars is 'change' and second c is 'card' and s is 'section'
		$change_id = $_POST['c_id'];
		$cc_active = $_POST['ccard_active'];
		$cc_week = $_POST['ccard_week'];
		$cc_passed = $_POST['ccard_passed'];
		$cc_archived = $_POST['ccard_archived'];
		$cc_total = $_POST['ccard_total'];

		$cs_bookmarked = $_POST['ssection_bookmarked'];
		$cs_active = $_POST['ssection_active'];
		$cs_archived = $_POST['ssection_archived'];

		$csql = "UPDATE UTasksMAIN.users SET card_active='$cc_active', card_week='$cc_week', card_passed='$cc_passed', card_archived='$cc_archived', card_total='$cc_total', section_bookmark='$cs_bookmarked', section_active='$cs_active', section_archived='$cs_archived' WHERE id='$change_id'";
		mysql_query($csql) or die(mysql_error());
		header('location:home?success=4');
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
	
	<title>Your Account Settings | UTasks User Panel </title>
  </head>
  <body id="page-top">
    <?php include 'aheader.php' ?>

      <div id="content-wrapper">
        <div class="container-fluid">
		  <div class="row">
		  <?php
				if ($_GET['success'] == "1") {
					echo '<div class="col-xl-12 mb-6"><div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fas fa-check"></i> Password successfully changed.</div></div>';
				} elseif ($_GET['success'] == "2") {
					echo '<div class="col-xl-12 mb-6"><div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fas fa-check"></i> Other information successfully changed. </div></div>';
				} elseif ($_GET['error'] == "1") {
					echo '<div class="col-xl-12 mb-6"><div class="alert alert-warning alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fas fa-exclamation-triangle"></i> Old username/password does not match the database. Please try again.</div></div>';
				} elseif ($_GET['error'] == "2") {
					echo '<div class="col-xl-12 mb-6"><div class="alert alert-warning alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fas fa-exclamation-triangle"></i> The two new passwords do not match. Please try again.</div></div>';
				}
			?>

			<!-- Customize dashboard section -->
			<?php include '_inc/dbconn.php';
				// The code below gets the custom user settings for the dashboard from their UTasksMAIN.users record. These values will be used to display checked options.
				$customcheck = "SELECT card_active,card_week,card_passed,card_archived,card_total,section_bookmark,section_active,section_archived FROM UTasksMAIN.users WHERE id=".$userdat_id;
				$customresult = mysql_query($customcheck) or die(mysql_error());
				$arr =  mysql_fetch_array($customresult);
			?>

			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-palette"></i>
				  Customize your dashboard</div>
				<div class="card-body">
					<small>Select the items below to enable them on your dashboard.</small>
					<form action="settings" method="POST">
						<table>
							<input type="hidden" name="c_id" value="<?php echo $userdat_id; ?>" />
							<tr><td><b>Show/Hide Cards &nbsp;</b></td>
								<td><input type="checkbox" value="1" name="ccard_active" <?php if ($arr[0] == "1"){ echo 'checked'; } ?>> Active cards</td>
							</tr>
							<tr><td></td>
								<td><input type="checkbox" value="1" name="ccard_week" <?php if ($arr[1] == "1"){ echo 'checked'; } ?>> Complete this week</td>
							</tr>
							<tr><td></td>
								<td><input type="checkbox" value="1" name="ccard_passed" <?php if ($arr[2] == "1"){ echo 'checked'; } ?>> Deadlines passed</td>
							</tr>
							<tr><td></td>
								<td><input type="checkbox" value="1" name="ccard_archived" <?php if ($arr[3] == "1"){ echo 'checked'; } ?>> Archived</td>
							</tr>
							<tr><td></td>
								<td><input type="checkbox" value="1" name="ccard_total" <?php if ($arr[4] == "1"){ echo 'checked'; } ?>> Total</td>
							</tr></table><br>
							<table>
							<tr><td><b>Open/Close Sections &nbsp;</b></td>
								<td><input type="checkbox" value="1" name="ssection_bookmarked" <?php if ($arr[5] == "1"){ echo 'checked'; } ?>> Bookmarked</td>
							</tr>
							<tr><td></td>
								<td><input type="checkbox" value="1" name="ssection_active" <?php if ($arr[6] == "1"){ echo 'checked'; } ?>> Active</td>
							</tr>
							<tr><td></td>
								<td><input type="checkbox" value="1" name="ssection_archived" <?php if ($arr[7] == "1"){ echo 'checked'; } ?>> Archived</td>
							</tr>
						</table><br>
						<button type="submit" class="btn btn-success" name="submit_customize"><i class="fas fa-palette"></i> Customize dashboard</button>
					</form>
				</div>
			  </div>
			</div>
			<div class="col-xl-5 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  User Account Actions</div>
				<div class="card-body">
					<select class="form-control" data-error="Select your category." onchange="javascript:location.href = this.value;">
						<option value="" disabled selected>Select an action to perform on your account..</option>
						<option value="?action=password">Change my password</option>
						<option value="?action=other">Change other information</option>
						<option value="?action=danger_area">(DANGER AREA) Delete my account</option>
					</select><br>

					<?php if ($_GET['action'] == "password") { ?>
					<form action="account" method="POST">
						<small class="form-text">Please enter your old password and two times your new password.</small>
						<table>
							<tr>
								<td>Old password:</td>
								<td><input type="hidden" name="pass_id" value="<?php echo $userdat_id;?>"/>
								<input type="password" class="form-control" name="old_password" required=""/></td>
							</tr>
							<tr>
								<td>New password:</td>
								<td><input type="password" class="form-control" name="new_password" required=""/></td>
							</tr>
							<tr>
								<td>New password again: &nbsp;</td>
								<td><input type="password" class="form-control" name="again_password" required=""/></td>
							</tr>
						</table><br>
						<button type="submit" class="btn btn-success" name="change_password"><i class="fas fa-check"></i> Change Password</button>
					</form>

					<?php } elseif ($_GET['action'] == "other") { ?>
					<form action="account" method="POST">
						<small class="form-text">Edit other personal information below. Your name, username and email <b>cannot</b> be changed manually at the moment. Please contact support (using the <i>'Change my personal information'</i> option on the left) to change this.</small><br>
						<table>
							<tr>
								<td>Dob:</td>
								<td><input type="date" class="form-control" value="<?php echo $userdat_dob ?>" name="ed_dob" required /></td>
							</tr>
							<tr>
								<td>Address: &nbsp;</td>
								<td><input type="text" class="form-control" value="<?php echo $userdat_address ?>" name="ed_address" required /></td>
							</tr>
							<tr>
								<td>Phone:</td>
								<td><input type="text" class="form-control" value="<?php echo $userdat_mobile ?>" name="ed_mobile" required /></td>
							</tr>
							<tr>
								<td>Gender:</td>
								<td><select class="form-control" name="ed_gender">
										<option value="M" <?php if ($userdat_gender == "M") { echo 'selected'; }?> >Male (M)</option>
										<option value="F" <?php if ($userdat_gender == "F") { echo 'selected'; }?> >Female (F)</option>
									</select>
								</td>
							</tr>
						</table><br>
						<small class="form-text">Confirm your current password below to change your personal information.</small>
						<table><tr>
								<td>Password: &nbsp;</td>
								<td><input type="hidden" name="pass_id" value="<?php echo $userdat_id;?>"/><input type="password" class="form-control" name="ed_pwd" required /></td>
						</tr></table><br>
						<button type="submit" class="btn btn-success" name="change_other"><i class="fas fa-check"></i> Change Information to above</button>
					</form>

					<?php } elseif ($_GET['action'] == "danger_area") { ?>
					<form action="account" method="POST">
						<?php if ($userdat_acctype != "admin" AND $userdat_id != "1"){ // normal or premium users ?>
						<p>Hi <?php if ($userdat_acctype == "premium"){ echo '<i class="fas fa-gem"></i> <b>Premium user</b>'; } else { echo 'user'; } ?>, we are sad to see you close your UTasks account! Please enter your reason below to inform us why you want to close your account.<br><br>
							<input type="hidden" name="del_id" value="<?php echo $userdat_id;?>"/>
							<textarea class="form-control" name="deleteReason" rows="1" placeholder="Reason why I am leaving..." required></textarea><br>
							<input type="checkbox" id="deleteCheck" required> I am sure I want to delete my UTasks account. <br><?php if ($waspremium == "1") { ?>
							<input type="checkbox" id="deleteCheck2" required> I know I will still be charged for this month (ONLY when <i class="fas fa-gem"></i> <b>Premium</b> and  a new month started).<br> <?php } ?><br>
						<a href="#" class="btn btn-danger" id="pagesDropdown" data-toggle="modal" data-target="#deleteMyAccountModal" aria-haspopup="true"><i class="fas fa-exclamation-triangle"></i> Delete my account</a>
						</p>
						<?php } elseif ($userdat_id == "1") { // if owner asks to delete his account ?>
						<p>Hi Owner, <b>you can't delete your account</b>, because this would have a <b>catastrophical</b> impact on the whole system! Disadvantages would be:<br>
							<ul>
								<li>Nobody would be able to create new accounts manually,</li>
								<li>No new admin accounts could be created,</li>
								<li>Admin information could never be changed.</li>
							</ul>
							And even more problems with maintaining this whole system.
						</p>
						<?php } else { // if admin asks to delete his account ?>
						<p>Hi <b>admin</b>, if you want to stop working at UTasks, please contact someone with a higher position and hand in your resignation.</p>
					<?php } } else { ?>
						<p>Select one of the actions from the list above to change.</p>
					<?php } ?>
				</div>
			  </div>
			</div>
		  </div> <!-- /.row -->

		  <!-- Sure 2 Delete Modal-->
		<div class="modal fade" id="deleteMyAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Are you sure?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
			  </div>
			 <div class="modal-body">We are sad to see you leave. Do you <b>really</b> want to close your account? You <b>will loose</b> all of your tasks and labels! Remember: This action is <b>irreversible!</b></div>
			  <div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger" name="user_delete">Yes, I am 100% sure. Bye.</button>
				</form>
			  </div>
			</div>
		  </div>
		</div>

      </div><!-- /.container-fluid -->

    <?php include 'afooter.php' ?>