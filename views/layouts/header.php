<?php 

	# ----- Uncomment this if you run into any problems -----
	# require_once($_SERVER['DOCUMENT_ROOT'] . '/reou/controllers/courses_controller.php');


	# course helpers
	# course class
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<nav class="main_nav">


	<div class="main_nav--nav">

		<!-- Course Search -->


		<div class='flex-container'>


			<div class="main_nav--logo">

				<a href="<?php echo course_route('home') ?>">
					<img src="<?php echo asset_route('img') . 'academy_logo_blue.png' ?>" height="50px" width="50px" alt="logo" />
				</a>
				
			</div>


		<!-- Nav Search Menu -->
			<div class="nav-course-search">
				<form id="course-search-form" class="main_nav--item" method="GET" action="<?php echo course_route( 'course_search' ) ?>">
					<input type="text" class="course_search" name="q" placeholder="Search classes">
					<button class="course_search_button"><i class="fa fa-search fa-lg"></i></button>


				</form>
			</div>


			<!-- Sign in/ Sign up buttons -->

			<?php if(!userSignedIn()) { ?>
		
				<div class="nav-menu-items"> 
					<a class="main_nav--item" href="<?php echo user_route('sign-in') ?>"> Sign-In </a> 
				</div>

				<div class="nav-menu-items"> 
					<a class="main_nav--item" href="<?php echo user_route('sign-up') ?>"> Sign-Up </a>
				</div>

			<?php } ?>


			<div class="nav-menu-items">


				<div class="nav-menu-item-container">
				

				<?php if( userSignedIn() ) { ?>

					<div class="main_nav--item__menu-button">
						<div class="main_nav--menu-button">
							<div class="menu-button--bar"> </div>
							<div class="menu-button--bar"> </div>
							<div class="menu-button--bar"> </div>
						</div>

						<nav class="main_subnav"> 

								<a class="main_subnav--item" href="<?php echo user_route('my-courses') ?>"> My Courses </a>
								<a class="main_subnav--item" href="<?php echo user_route('sign-out') ?>"> Sign Out</a>
								<a class="main_subnav--item" href="http://www.calendarwiz.com/reo"> Calendar </a>
								<a class="main_subnav--item" href="<?php echo user_route('edit') ?>"> My Profile </a>


						<?php #If user is admin ?>
						<?php if(userIsAdmin()) { ?>
	
								<a class="main_subnav--item" href="<?php echo "/reou/views/admin/admin.php"?>"> Admin Center </a>
								<a class="main_subnav--item" href="<?php echo user_route('show-users') ?>"> Edit Users </a>
								<a class="main_subnav--item" href="<?php echo "/reou/views/admin" ?>"> Admin Center ( test ) </a>
								<a class="main_subnav--item" href="<?php echo course_route('create_course')?>"> Create Course </a>
								<a class="main_subnav--item" href="<?php echo "/reou/views/courses/course_create_schedule.php"?>"> Create Schedule </a>
						<?php } ?>
								
							<?php } ?>
						</nav>
					</div>
				</div>

			</div>

		</div>

	</div>

</nav>