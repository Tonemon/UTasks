<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="description" content="UTasks - Focus more using UTasks">
		<meta name="author" content="UTasks Group">
		<title>UTasks Premium &bull; Focus even better using UTasks Premium!</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/png" href="vendor/img/favicon.png"/>
		
	    <!-- Bootstrap core CSS -->
	    <link href="vendor/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom fonts/css for this template-->
		<script src="https://kit.fontawesome.com/65d0b9813c.js" crossorigin="anonymous"></script>
	    <link href="vendor/css/custom.css" rel="stylesheet">

	</head>
	<body>
	   <div class="container-fluid">
	      <!-- Navigation -->
	    <nav class="navbar navbar-expand-sm navbar-dark bg-green fixed-top">
	      <div class="container">
	        <a class="navbar-brand" href="http://uTasks.me"><img src="vendor/img/favicon.png" height="25px" width="25px" /> UTasks <small><small>Focus more using UTasks</small></small></a>
	          <ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="http://utasks.me/">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="http://utasks.me/#about">Pricing</a>
					</li>
					<li class="nav-item">
						<b><a class="nav-link js-scroll-trigger" href="http://utasks.me/#cpanel">Apply for Premium</a></b>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="http://utasks.me/#contact">Contact</a>
					</li>
					<li class="nav-item">
					  <b><a class="nav-link js-scroll-trigger" href="http://utasks.me/#register">Register</a></b>
					</li>
					<li class="nav-item">
					  <b><a class="nav-link" href="login">Login</a></b>
					</li>
	          </ul>
	      </div>
	    </nav>

	    <!-- Show when user is logged in and on premium page -->
	    <?php 
	    	session_start();
	    	if (isset($_SESSION['session_tasks_start'])){ ?>
	    <nav class="navbar navbar-expand-sm navbar-dark bg-green fixed-top fixed-top-2">
	      <div class="container">
	        <a class="navbar-brand text-white"><small><small><i class="fas fa-info-circle"></i> You are already logged in.</small></small></a>
	          <ul class="navbar-nav ml-auto">
					<li class="nav-item">
					  <b><a class="nav-link" href="login">Click here to go to your tasks &raquo;</a></b>
					</li>
	          </ul>
	      </div>
	    </nav>
		<?php } ?>
	
	<div class="container homeheader" id="homeheader">
	<?php
		if (isset($_GET['premium']) && $_GET['success'] == "1") {
			echo "<div class='alert alert-success alert-dismissible'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<i class='fas fa-check'></i> Premium application submitted. </div>";
		} elseif (isset($_GET['premium']) && $_GET['error'] == "1") {
			echo "<div class='alert alert-warning alert-dismissible'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<i class='fas fa-exclamation-triangle'></i> Oh. Something went wrong. Please try again.</div>";
		}
	?>

	  <h1 class="mt-5">Focus even better using UTasks Premium</h1>
	  <div class="row mt-4">
          <div class="col-sm-5">
			  <p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi quis metus ultricies, volutpat neque vel, consequat nisi. Pellentesque ornare dignissim mauris quis gravida. Nam non leo euismod, congue metus ac, tempor leo. Nullam dictum urna at sagittis malesuada. Etiam felis diam, accumsan vitae aliquet sit amet, dapibus non tellus. Sed pharetra pellentesque mauris, vitae elementum felis accumsan a. Duis mauris sapien, rhoncus non suscipit eget, porta tincidunt elit. Donec quis lacinia orci. <br><br>
				Duis sed congue tellus, vel bibendum massa. Mauris tincidunt, dui ac dignissim elementum, erat sapien lacinia odio, at porta quam urna at enim. <br><br>
				<a class="btn btn-success js-scroll-trigger" href="#features">Premium Features &raquo;</a>
				<a class="btn btn-success js-scroll-trigger" href="#apply">Apply for Premium &raquo;</a><br>
			  </p>
          </div>
          <div class="col-sm-1"></div>
		  <div class="col-sm-6">
			<img src="vendor/img/screenshot1.png" width="100%" alt="" />
          </div>
        </div>
    </div>
	
	<div class="row about text-white" id="features">
        <!-- <div class="col-lg-1"></div> -->
        <div class="col-sm-1"></div>
          <div class="col-sm-4">
            <h2><i class="fas fa-share-square"></i> Task sharing</h2>
			<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
            <p>This feature lets you share your tasks with other users to maximize work efficiency. Both users can view the same task and edit it. This option is great for businesses and for users who want to improve their workflow and collaborate with people.</p>
            <a class="btn btn-light js-scroll-trigger" href="#pricing">UTasks Premium Pricing &raquo;</a>
		  </div>
          <div class="col-sm-3">
            <h2><i class="fas fa-folder-open"></i> Unlimited Labels</h2>
			<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
            <p>This option will also maximize your work efficiency by allowing you to sort all of your tasks by their category to keep them seperated. Create as much labels as you want without a limit!</p>
            <a class="btn btn-light js-scroll-trigger" href="#apply">Apply for Premium &raquo;</a>
          </div>
          <div class="col-sm-3">
            <h2><i class="fas fa-crown"></i> Premium Crown</h2>
			<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
            <p>Show everyone who is boss with this fashionable crown! Every premium user has a crown on the users page. This is a way to show that you support the development of UTasks and are enjoying premium features.</p>
            <?php if (isset($_SESSION['session_tasks_start'])){ ?>
            	<a class="btn btn-light js-scroll-trigger" href="users">Show the users page! &raquo;</a>
        	<?php } else { ?>
        		<a class="btn btn-dark js-scroll-trigger"><i>Login to view the page</i></a>
        	<?php } ?>
          </div>
		  <div class="col-sm-1"></div>
    </div><!-- /.row -->
	
	<div class="container cpanel" id="pricing">
	  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="mt-5">UTasks Premium Pricing</h1>
  <p>Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
</div>

  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">UTasks Free</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ month</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Unlimited tasks</li>
          <li>3 labels total</li>
          <li>Advanced Search feature</li>
          <li>No Task Sharing</li>
          <li>No Premium Crown</li>
        </ul>
        <a href="http://utasks.me/#register" class="btn btn-lg btn-block btn-success text-white js-scroll-trigger">Register for free</a>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">UTasks Premium</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ month</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Unlimited tasks</li>
          <li>Unlimited labels</li>
          <li>Advanced Search feature</li>
          <li>Task Sharing Feature</li>
          <li>Special Premium Crown</li>
        </ul>
        <a href="#apply" class="btn btn-lg btn-block btn-primary text-white js-scroll-trigger">Apply for Premium</a>
      </div>
    </div>
  </div>
    </div>

    <!-- contact form -->
	  <div class="row contact text-white" id="apply">
	  	<div class="col-lg-12">
		</div>
	    <div class="col-lg-1"></div>
		<div class="col-lg-4">
		  <h1>Apply for Premium</h1>
		  <hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 40%;">
		  <p>Please enter your full name, your username, the email address connected to your account, the payment method and bank number. Leaving a message is entirely optional. <br><br> All your information regarding your account must be right. Requests with wrong information will be rejected and further requests from that account will be denied. <br><br>
		  <b>The first 5 fields in this form are required.</b></p>
		</div>
		<div class="col-lg-1"></div>
		<div class="col-lg-5"><br><br>
		  <form method="POST" action="index-process">
			<div class="messages"></div>
			<div class="controls">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_name">Full name</label>
								<input id="form_name" type="text" name="p_fullname" class="form-control" placeholder="Enter your full name" required="required" data-error="Your Full name is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_name">Username</label>
								<input id="form_name" type="text" name="p_username" class="form-control" placeholder="Enter your username" required="required" data-error="Your Username is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="form_email">Email Address</label>
								<input id="form_email" type="email" name="p_email" class="form-control" placeholder="Enter your email address" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label for="form_need">Payment method</label>
								<select id="form_need" name="p_method" class="form-control" required="required" data-error="Select your payment method.">
									<option value="" disabled selected>...</option>
									<option value="Creditcard">Creditcard</option>
									<option value="Mastercard">Mastercard</option>
									<option value="Visacard">Visacard</option>
									<option value="iDeal">iDeal</option>
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="form-group">
								<label for="form_name">Bank Number</label>
								<input id="form_name" type="number" name="p_banknumber" class="form-control" placeholder="Enter your bank number" required="required" data-error="Your bank number is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="form_message">Your Message (optional)</label>
								<textarea id="form_message" name="p_message" class="form-control" placeholder="Leave a message for the processing team. This is entirely optional." rows="1"></textarea>
							</div>
						</div>
						<div class="col-sm-12">
							<input type="submit" class="btn btn-light btn-send" name="submit_premium" value="Apply for Premium &raquo;">
						</div>
					</div>
			 </div>
		   </form>
		 </div> <!-- // class="col-lg-6" -->
		<div class="col-lg-1"></div>
	  </div> <!-- // contact form -->

	<!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#homeheader">
      <i class="fas fa-angle-up"></i>
    </a>
	
	<!-- Footer -->
	<footer>
		<div class="row homefooter text-white">
			<div class="col-lg-1"></div>
			<div class="col-lg-5">
				<p>&copy; Copyright <?php echo date("Y") ?> UTasks. All rights reserved.</p>
			</div>
		</div>
	</footer>

	<!-- Credits footer on every page -->
    <div style="position: fixed;bottom: 0;right: 15px;background-color: #fff;box-shadow: 0 4px 8px rgba(0,0,0,.05);border-radius: 3px 3px 0 0;font-size: 12px;padding: 5px 10px;">Created by Tony.</div>
	
	<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/js/bootstrap.bundle.min.js"></script>
		
	<!-- Custom JS (scroll trigger) -->
	<script src="vendor/js/jquery.easing.min.js"></script>
	<script src="vendor/js/scroll.min.js"></script>
  <div> <!-- // Container fluid -->
</body>
</html>