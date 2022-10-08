<?php
/*
 *	Template Name: 05-History-Template
 */ 
?>

<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
} ?>

<?php

get_header(); // Loads the header.php template. 

dev_comment('tpl: 05-history-template');

$args = array(
	'banner_classes' => '',
	'title' => ''
	);

wdb_get_banner( $args ); // Located in _wdbar/functions.php
wdb_use_vertical_timeline(); // Located in _wdbar/functions.php voa e kodut so go vklucuve vertical timelineut !!!! 

?>

<div id="history-content">
	
	<div class="container">

		<div class="row">

		<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : ?>

		<?php the_post();  ?>

			<div class="col-md-8 col-md-push-4 historytimeline">
				<?php $rows = get_field('history_items'); ?>
					<?php if ($rows) : ?>
					<section class="cd-timeline js-cd-timeline">
						<div class="cd-timeline__container">
							<?php foreach ($rows as $row) : ?>
								<div class="cd-timeline__block js-cd-block">

									<div class="cd-timeline__img cd-timeline__img--picture js-cd-img">
										<i class="fa fa-<?php echo $row['add_icon']; ?>" aria-hidden="true"></i>
									</div> <!-- cd-timeline__img -->

									<div class="cd-timeline__content js-cd-content">
										<?php if ($row['heading_section']) : ?>
											<h2><?php echo $row['heading_section']; ?></h2> 
										<?php endif; ?>

										<?php if ($row['add_picture']) : ?>
											<div class="historyimg" style="background: url('<?php echo $row['add_picture']['url']; ?>') no-repeat center"></div>
										<?php endif; ?>

										<?php if ($row['text_section']) : ?>
											<p><?php echo wpautop($row['text_section']); ?></p> 
										<?php endif; ?>
										<!-- <a href="#0" class="cd-timeline__read-more">Read more</a> -->
										<?php if ($row['add_year']) : ?>
											<span class="cd-timeline__date"><?php echo $row['add_year']; ?></span>
										<?php endif; ?>
									</div> <!-- cd-timeline__content -->
									
								</div> <!-- cd-timeline__block -->

						<?php endforeach; ?>
					</section> <!-- cd-timeline -->

				<?php endif; ?>

			<?php endwhile; ?>

			<?php endif; ?>	

			</div>

			<div class="col-md-4 col-md-pull-8">	
				<?php include_locate( 'template-parts/sidebar-submenu.php' ); ?>
				<?php include_locate( 'template-parts/have_questions.php' ); ?>
				<?php include_locate( 'template-parts/sidebar-related_posts.php' ); ?>
			</div>

		</div>

	</div>

</div><!-- #contact-content -->


<?php get_footer(); ?>
