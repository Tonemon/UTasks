<?php 
session_start();
if (!isset($_SESSION['session_tasks_start']))
	header('location:login?notice=2');
?>

<?php
	include '_inc/dbconn.php';
	if (isset($_REQUEST['submit_question'])){

		// getting variables to store in table
		$qname = mysql_real_escape_string($_REQUEST['q_name']);
		$qemail = mysql_real_escape_string($_REQUEST['q_email']);
		$qtype = mysql_real_escape_string($_REQUEST['q_category']);
		$qmessage = mysql_real_escape_string($_REQUEST['q_content']);

		// variables to set on the go
		$qstatus = "TO REVIEW";
		$qfrom = "User";
		$qdate = date('Y-m-d h:i:s');

		// insert question to table 'questions'
		$qsql = "INSERT INTO UTasksMAIN.questions values('','$qname','$qemail','$qtype','$qmessage','$qstatus','','$qfrom','$qdate')";
		mysql_query($qsql) or die(header('location:account?error=1'));
		header('location:account?success=1');
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
	
	<title>Your Account information | UTasks User Panel </title>
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
					<i class="fas fa-check"></i> Question successfully sent. Your question will be reviewed as soon as possible.</div></div>';
			} elseif ($_GET['error'] == "1") {
				echo '<div class="col-xl-12 mb-6"><div class="alert alert-warning alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<i class="fas fa-exclamation-triangle"></i> Your question could not be submitted. Please try again later.</div></div>';
			}
		  ?>
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="fas fa-info-circle"></i>
				  General Information</div>
				<div class="card-body">
					<p>
						<h2> <i class="fas fa-user-circle fa-lg"></i> <b><?php echo $userdat_username; ?></b> <span class='badge badge-success'>Online</span></h2><br>
						<span>Your Last login was on <b><?php echo $userdat_lastlogin;?></b>.</span><br>
						<span class="heading">
							Your full name is <b><?php echo $userdat_name;?></b> and your email address is <b><?php echo $query_email; ?></b>.
							<!-- REALLY WEIRD: $userdat_email doesn't work but $query_email does work. -->
							Your account type is <b><?php echo $userdat_acctype;?></b>. 
						</span><br><br>
						<span class="heading">
							Your address is <b><?php echo $userdat_address;?></b> and your phone number is <b><?php echo $userdat_mobile;?></b>. 
							Your date of birth is <b><?php echo $userdat_dob;?></b> and your gender is <b><?php if ($userdat_gender == "M"){ echo "male"; } else { echo "female"; } ?></b>. <i>Want to change this information? Go to the <a href="settings?action=other">settings page</a>.</i></span>
						
						<?php if ($userdat_acctype == "premium"){ ?>
								<br><br><i class="fas fa-check-circle"></i> <i>Thank you for being a <i class="far fa-gem"></i> <b>premium member</b>!</i>
						<?php } elseif ($userdat_acctype == "admin"){ ?>
								<br><br><i class="fas fa-check-circle"></i> <i>All admins can make use of <i class="far fa-gem"></i> <b>UTasks Premium</b> for free!</i>
						<?php } else { ?>
								<br><br><i class="fas fa-info-circle"></i> <a href="#" role="button" data-toggle="modal" data-target="#premiumModal" aria-haspopup="true" aria-expanded="false"><i>Want to enjoy <i class="far fa-gem"></i> <b>UTasks Premium</b></i></a>?
						<?php }	?>
					</p>
				</div>
			  </div>
			</div>
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3">
				<div class="card-header">
				  <i class="far fa-life-ring"></i>
				  Support Panel</div>
				<div class="card-body">
					<p>If you got any questions please submit the form below and we will answer it as soon as possible.</p>
					<form action="account.php" method="POST">
						<table>
							<tr>
								<td>First name:</td>
								<td><input type="hidden" name="q_name" value="<?php echo $userdat_name; ?>" />
								<input type="text" class="form-control" value="<?php echo $userdat_name; ?>" disabled="disabled" /></td>
							</tr>
							<tr>
								<td>Email address:</td>
								<td><input type="hidden" name="q_email" value="<?php echo $query_email; ?>" />
								<input type="email" class="form-control" value="<?php echo $query_email; ?>" disabled="disabled" /></td>
							</tr>
							<tr>
								<td>Category:</td>
								<td>
									<select name="q_category" class="form-control" required="required" data-error="Select your category.">
										<option value="" disabled selected>Select a category</option>
										<option value="About">About UTasks / UTasks Group</option>
										<option value="Bug">Exploit/Bug Found</option>
										<option value="Other">Other</option>
									</select>
								</td>
							</tr>	
						</table><br>
						<small class="form-text">Enter more information about your question below.</small>
						<textarea class="form-control" name="q_content" rows="1" placeholder="Please enter your question here" required></textarea><br>
						<button type="submit" class="btn btn-success" name="submit_question"><i class="fas fa-check"></i> Submit my Question</button>
					</form>
				</div>
			  </div>
			</div>
		  </div> <!-- /.row -->
      </div><!-- /.container-fluid -->

<?php include 'afooter.php'; ?>