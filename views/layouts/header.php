<?php 

	# ----- Uncomment this if you run into any problems -----
	# require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');


	# course helpers
	# course class
?>


<nav class="main_nav">

	<div class="main_nav--logo">

		<a href="<?php echo course_route('home') ?>">
			<img src="http://placehold.it/100x50" alt="logo" />
		</a>
		
	</div>

	<div class="main_nav--nav"> 
	
		<?php if(!userSignedIn()) { ?>

			<a class="main_nav--item" href="<?php echo user_route('sign-in') ?>"> Sign-In </a>
			<a class="main_nav--item" href="<?php echo user_route('sign-up') ?>"> Sign-Up </a>

		<?php } ?>


		<div class="main_nav--item__menu-button">
			<div class="main_nav--menu-button">
				<div class="menu-button--bar"> </div>
				<div class="menu-button--bar"> </div>
				<div class="menu-button--bar"> </div>
			</div>

			<nav class="main_subnav"> 

				<?php if(userSignedIn()) { ?>
					<a class="main_subnav--item" href="<?php echo user_route('my-courses') ?>"> My Courses </a>
					<a class="main_subnav--item" href="<?php echo user_route('sign-out') ?>"> Sign Out</a>
					<a class="main_subnav--item" href="http://www.calendarwiz.com/reo"> Calendar </a>
					<a class="main_subnav--item" href="<?php echo user_route('edit') ?>"> My Profile </a>
				<?php } ?>


				<?php  if( userIsAdmin()) { ?>
					<a class="main_subnav--item" href="<?php echo user_route('show-users') ?>"> Edit Users </a>
					<a class="main_subnav--item" href="<?php echo "/reou/views/admin" ?>"> Admin Center ( test ) </a>
					<a class="main_subnav--item" href="<?php echo course_route('create_course')?>"> Create Course </a>
					<a class="main_subnav--item" href="<?php echo "/reou/views/courses/course_create_schedule.php"?>"> Create Schedule </a>
				<?php } ?>

			</nav>
		</div>
	</div>

</nav>