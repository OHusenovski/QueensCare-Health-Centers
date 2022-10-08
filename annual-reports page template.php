<?php
/*
 *	Template Name: 09-Annual-Reports
 */ 
?>

<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

get_header(); // Loads the header.php template. 

dev_comment('tpl: 09-annual-reports');

$args = array(
	'banner_classes' => '',
	'title' => ''
	);

wdb_get_banner( $args ); // Located in _wdbar/functions.php

if ($_GET["y"]) {
	$args = array(
		'post_type' => 'annual_reports',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'meta_key' => 'year',
		'meta_query' => array(
	        array(
	            'key' => 'year',
	            'value' => $_GET["y"],
	            'compare' => '<='
	        )
       	),
		'orderby' => 'meta_value_num',
		'suppress_filters' => false,
 		'order' => 'DESC'
	);		
} else {
	$args = array(
		'post_type' => 'annual_reports',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'meta_key' => 'year',
		'orderby' => 'meta_value',
		'suppress_filters' => false,
 		'order' => 'DESC'
	);
}

$reports = get_posts($args); 

?>

	<div class="container">
		<div class="row">
			<div id="annual-reports" class="col-md-8 col-md-push-4">
				
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post();  ?>
						<h2><?php the_title(); ?></h2>
					<?php endwhile; ?>
				<?php endif; ?>

				<div class="row">
					<?php foreach ($reports as $key => $report) : ?>
						<?php if ($key == 0) : ?>
							<div class="col-md-6">
								<img class="img-report" src="<?php echo get_field('image',$report->ID)['url']; ?>">
							</div>
							<div class="col-md-6">
								<div class="first-report">
									<div class="year">
										<?php echo $report->post_title; ?>
									</div>
									<p class="rep-text"><?php _e('ANNUAL REPORT','annual-reports-template'); ?></p>
								</div>
								<?php $file = get_field('report',$report->ID); ?>
								<?php if( $file ): ?>
									<a class="download-file" href="<?php echo $file['url']; ?>" target="_blank">
										<i class="fa fa-file-pdf-o"></i><?php _e('DOWNLOAD','annual-reports-template'); ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>

				<div class="old-reports">				
					<h3><?php _e('PAST ANNUAL REPORTS','annual-reports-template'); ?></h3>
					<form action="" method="GET">
						<?php foreach ($reports as $key => $report) : ?>
							<?php if ($key > 0) : ?>
								<button name="y" value="<?php echo get_field('year',$report->ID); ?>">
									<i class="fa fa-file-pdf-o"></i><?php echo $report->post_title; ?>
								</button>
							<?php endif; ?>
						<?php endforeach; ?>
					</form>
				</div>

			</div>
			<div class="col-md-4 col-md-pull-8">	
				<?php include_locate( 'template-parts/sidebar-submenu.php' ); ?>
				<?php include_locate( 'template-parts/have_questions.php' ); ?>
				<?php include_locate( 'template-parts/sidebar-related_posts.php' ); ?>
			</div>
		</div> <!-- row -->
	</div>	<!-- container -->

<?php get_footer(); ?>