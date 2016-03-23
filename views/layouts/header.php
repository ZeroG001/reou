<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');
	# course helpers
	# course class
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">


<nav class="main_nav">

	<div class="main_nav--logo"> 
		<img src="http://placehold.it/100x50" alt="logo" />
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
					<a class="main_subnav--item" href="#"> My Profile </a>

				<?php } ?>

			</nav>
		</div>
	</div>

</nav>