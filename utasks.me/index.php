<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="description" content="UTasks - Focus more using UTasks">
		<meta name="author" content="UTasks Group">
		<title>UTasks Homepage &bull; Focus more using UTasks.</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/png" href="vendor/img/favicon.png"/>
		
	    <!-- Bootstrap core CSS -->
	    <link href="vendor/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom fonts/css for this template-->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
						<a class="nav-link js-scroll-trigger" href="#homeheader">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#about">About Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#cpanel">User Panel</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
					</li>
					<li class="nav-item">
					  <b><a class="nav-link js-scroll-trigger" href="#register">Register</a></b>
					</li>
					<li class="nav-item">
					  <b><a class="nav-link" href="login">Login</a></b>
					</li>
	          </ul>
	      </div>
	    </nav>

	    <!-- Show when user is logged in and on homepage-->
	    <?php 
	    	session_start();
	    	if (isset($_SESSION['session_tasks_start'])){ ?>
	    <nav class="navbar navbar-expand-sm navbar-dark bg-green fixed-top fixed-top-2">
	      <div class="container">
	        <a class="navbar-brand text-white"><small><small><i class="fas fa-info-circle"></i> You are already logged in. Use the button on the left instead of the login button to continue.</small></small></a>
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
		if (isset($_GET['contact']) && $_GET['success'] == "1") {
			echo "<div class='alert alert-success alert-dismissible'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<i class='fas fa-check'></i> Contact message submitted. </div>";
		} elseif (isset($_GET['contact']) && $_GET['error'] == "1") {
			echo "<div class='alert alert-warning alert-dismissible'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<i class='fas fa-exclamation-triangle'></i> Oh. Something went wrong. Please try again.</div>";
		} elseif (isset($_GET['register']) && $_GET['success'] == "1") {
			echo "<div class='alert alert-success alert-dismissible'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<i class='fas fa-check'></i> New account request submitted. Please check your mail for further instructions.</div>";
		} elseif (isset($_GET['register']) && $_GET['error'] == "1") {
			echo "<div class='alert alert-warning alert-dismissible'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<i class='fas fa-exclamation-triangle'></i> Oh. Something went wrong. Please try again.</div>";
		} elseif (isset($_GET['register']) && $_GET['error'] == "2") {
			echo '<div class="col-xl-12 mb-6"><div class="alert alert-warning alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<i class="fas fa-exclamation-triangle"></i> New passwords do not match. No information was changed.</div></div>';
		}
	?>

	  <h1 class="mt-5">Focus more using UTasks</h1>
	  <div class="row mt-4">
          <div class="col-sm-5">
			  <p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi quis metus ultricies, volutpat neque vel, consequat nisi. Pellentesque ornare dignissim mauris quis gravida. Nam non leo euismod, congue metus ac, tempor leo. Nullam dictum urna at sagittis malesuada. Etiam felis diam, accumsan vitae aliquet sit amet, dapibus non tellus. Sed pharetra pellentesque mauris, vitae elementum felis accumsan a. Duis mauris sapien, rhoncus non suscipit eget, porta tincidunt elit. Donec quis lacinia orci. <br><br>
				Duis sed congue tellus, vel bibendum massa. Mauris tincidunt, dui ac dignissim elementum, erat sapien lacinia odio, at porta quam urna at enim. <br><br>
				<a class="btn btn-success js-scroll-trigger" href="#about">More About us &raquo;</a>
				<a class="btn btn-success js-scroll-trigger" href="#register">Register &raquo;</a><br>
			  </p>
          </div>
          <div class="col-sm-1"></div>
		  <div class="col-sm-6">
			<img src="vendor/img/screenshot1.png" width="100%" alt="" />
          </div>
        </div>
    </div>
	
	<div class="row about text-white" id="about">
        <!-- <div class="col-lg-1"></div> -->
        <div class="col-sm-1"></div>
          <div class="col-sm-4">
            <h2><i class="fas fa-feather"></i> Super light & Super fast</h2>
			<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent congue id tellus quis tristique. Nunc ante tortor, faucibus ut vehicula id, blandit in elit. Vestibulum non enim purus. Maecenas risus augue, condimentum ac velit non, condimentum porta ante.</p>
            <a class="btn btn-light js-scroll-trigger" href="#cpanel">Control Panel &raquo;</a>
		  </div>
          <div class="col-sm-3">
            <h2><i class="fas fa-lock"></i> Seriously Secure</h2>
			<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent congue id tellus quis tristique. Nunc ante tortor, faucibus ut vehicula id, blandit in elit. Vestibulum non enim purus.</p>
            <a class="btn btn-light js-scroll-trigger" href="#reviews">Contact Us &raquo;</a>
          </div>
          <div class="col-sm-3">
            <h2><i class="fas fa-server"></i> 100% Uptime</h2>
			<hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 50%;">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent congue id tellus quis tristique. Nunc ante tortor, faucibus ut vehicula id, blandit in elit. Vestibulum non enim purus.</p>
            <a class="btn btn-light js-scroll-trigger" href="#reviews">Our Reviews &raquo;</a>
          </div>
		  <div class="col-sm-1"></div>
    </div><!-- /.row -->
	
	<div class="container cpanel" id="cpanel">
	  <h1 class="mt-5"><i class="fas fa-server"></i> Our brand new User Control Panel</h1>
	  <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 55%;">
	  <div class="row">
          <div class="col-sm-6">
			  <p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent congue id tellus quis tristique. Nunc ante tortor, faucibus ut vehicula id, blandit in elit. Vestibulum non enim purus. Maecenas risus augue, condimentum ac velit non, condimentum porta ante. Etiam imperdiet euismod nibh a gravida. Nunc efficitur tellus in mi efficitur, nec consectetur erat finibus. Nulla lacinia orci nec laoreet sodales. Vestibulum at luctus lectus. Duis a nibh non libero condimentum lacinia. Mauris varius leo ac tempus dapibus. Sed pellentesque turpis scelerisque sapien euismod, non luctus tortor aliquet. Nulla a felis commodo, facilisis ipsum ut, laoreet arcu. Nam tincidunt ultricies ante, sit amet finibus dolor consequat in. <br><br>
				<a class="btn btn-success js-scroll-trigger" href="#register" role="button">Register now &raquo;</a>
				<a class="btn btn-success js-scroll-trigger" href="#contact" role="button">Contact us &raquo;</a><br>
			  </p>
          </div>
		  <div class="col-sm-6">
			<img src="vendor/img/screenshot2.png" width="100%" alt="" />
          </div>
        </div>
    </div>

    <!-- contact form -->
	  <div class="row contact text-white" id="contact">
	  	<div class="col-lg-12">
		</div>
	    <div class="col-lg-1"></div>
		<div class="col-lg-4">
		  <h1>Contact Form</h1>
		  <hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 40%;">
		  <p>Please enter your full name, your type of question, a valid email address and your message. If you forgot your password select the 'Forgot Password' option and keep your information ready to identify yourself. <br><br> Please describe your question as accurate as you can so our staff can answer it precisely. <br><br>
		  <b>All fields in this form are required.</b></p>
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
								<input id="form_name" type="text" name="q_fullname" class="form-control" placeholder="Enter your full name" required="required" data-error="Your Full name is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_need">Select your type of question</label>
								<select id="form_need" name="q_type" class="form-control" required="required" data-error="Select your category.">
									<option value="">...</option>
									<option value="Services">Forgot Password</option>
									<option value="UTasks">About UTasks/UTasks Group</option>
									<option value="Job">Job Application</option>
									<option value="Bug">Exploit/Bug Found</option>
									<option value="Other">Other</option>
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="form_email">Email Address</label>
								<input id="form_email" type="email" name="q_email" class="form-control" placeholder="Enter your email address" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="form_message">Your Message</label>
								<textarea id="form_message" name="q_message" class="form-control" placeholder="Message" rows="4" required="required" data-error="Please, leave us a detailed description."></textarea>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-12">
							<input type="submit" class="btn btn-light btn-send" name="submit_contact" value="Send message &raquo;">
						</div>
					</div>
			 </div>
		   </form>
		 </div> <!-- // class="col-lg-6" -->
		<div class="col-lg-1"></div>
	  </div> <!-- // contact form -->

    <!-- create account form -->
	  <div class="row register text-white" id="register">
	    <div class="col-sm-1"></div>
		<div class="col-sm-4">
		  <h1>Create Account</h1>
		  <hr class=" accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 40%;">
		  <p>When creating a new account, please keep in mind:<br>
		  	<ul>
		  		<li>After submitting the form on the right your <b>request will be send to validation</b> and will be <b>approved</b> or <b>denied</b>.</li>
		  		<li>Don't make <b>multiple accounts requests</b> as they will be denied.</li>
		  	</ul><br>
		  <b>All fields in this form are required.</b> Fields like your date of birth and gender will not be used in any surveys and all of your data <b>will not</b> be used without your permission.</p><br><br>
		</div>

		<div class="col-sm-6"><br><br>
		  <form method="POST" action="index-process">
			<div class="messages"></div>
			<div class="controls">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_name">Full name</label>
								<input id="form_name" type="text" name="n_fullname" class="form-control" placeholder="Enter your full name" required="required" data-error="Your First name is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_name">Username</label>
								<input id="form_name" type="text" name="n_username" class="form-control" placeholder="Enter your username" required="required" data-error="Your username is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_email">Email Address</label>
								<input id="form_email" type="email" name="n_email" class="form-control" placeholder="Enter your email address" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_need">Select your account type</label>
								<select id="form_need" name="n_type" class="form-control" required="required" data-error="Select your category.">
									<option value="">...</option>
									<option value="normal">Normal account</option>
									<option value="premium">Premium account</option>
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_address">Address</label>
								<input id="form_address" type="text" name="n_address" class="form-control" placeholder="Enter your Home address" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_phone">Your Mobile Number</label>
								<input id="form_phone" type="text" name="n_phone" class="form-control" placeholder="Enter your phone number" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_newpass">Enter new password</label>
								<input id="form_newpass" type="password" name="n_newpass" class="form-control" placeholder="Enter your new password" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="form_gender">Gender</label>
								<select id="form_gender" name="n_gender" class="form-control" required="required" data-error="Select your category.">
									<option value="">...</option>
									<option value="M">M (Male)</option>
									<option value="F">F (Female)</option>
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="form_birthdate">Date of Birth</label>
								<input id="form_birthdate" type="date" name="n_dob" class="form-control" placeholder="Enter your birth date" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="form_repeatpass">Repeat new password</label>
								<input id="form_repeatpass" type="password" name="n_repeatpass" class="form-control" placeholder="Repeat your new password" required="required" data-error="A valid email address is required.">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-12">
							<input type="submit" class="btn btn-success btn-send" name="register_account" value="Create account &raquo;">
						</div>
					</div>
			 </div>
		   </form>
		 </div> <!-- // class="col-lg-6" -->
		<div class="col-lg-1"></div>
	  </div> <!-- // contact form -->
	
	<div class="container reviews" id="reviews">
	  <h1 class="mt-5"><i class="fas fa-comments"></i> Testimonials</h1>
	  <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 25%;">
	  <div class="row">
          <div class="col-sm-4">
			  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> 4.5/5 Stars<br><br>
			  <h4><i class="fas fa-quote-left"></i> Great for school.</h4>
			  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent congue id tellus quis tristique. Nunc ante tortor, faucibus ut vehicula id, blandit in elit. Vestibulum non enim purus. Maecenas risus augue, condimentum ac velit non, condimentum porta ante. <i class="fas fa-quote-right"></i></p>
			  <p class="font-weight-bold">Mern Klein-Horstmann <small>CEO at Googol</small></p>
          </div>
		  <div class="col-sm-4">
			  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 5/5 Stars<br><br>
			  <h4><i class="fas fa-quote-left"></i> Premium rocks.</h4>
			  <p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent congue id tellus quis tristique. Nunc ante tortor, faucibus ut vehicula id, blandit in elit. Vestibulum non enim purus. Maecenas risus augue, condimentum ac velit non, condimentum porta ante. <i class="fas fa-quote-right"></i>
			  </p>
			  <p class="font-weight-bold">Kevin Dirkson <small>CEO at Tasla</small></p>
          </div>
          <div class="col-sm-4">
			  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> 4.5/5 Stars<br><br>
			  <h4><i class="fas fa-quote-left"></i> Instant Support.</h4>
			  <p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent congue id tellus quis tristique. Nunc ante tortor, faucibus ut vehicula id, blandit in elit. Vestibulum non enim purus. Maecenas risus augue, condimentum ac velit non, condimentum porta ante. <i class="fas fa-quote-right"></i>
			  </p>
			  <p class="font-weight-bold">Tigo Tigo <small>Executive Administrator Vandijk</small></p>
          </div>
        </div>
    </div>

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