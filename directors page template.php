<?php
/*
 *	Template Name: 06-Directors-Template
 */ ?>

<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

get_header(); // Loads the header.php template. 

dev_comment('tpl: 06-directors-template');

?>

<?php 

$args = array(
	'banner_classes' => '',
	'title' => ''
	);

wdb_get_banner( $args ); // Located in _wdbar/functions.php

?>
<div id="directors-content">

	
	<div class="container">
		<div class="row">
				
		<?php 
			$args = array(
				'post_type' 	 => 'directors',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'suppress_filters' => false
			);
			$posts = get_posts($args);
		?>
		<?php if( $posts ): ?>
			<?php foreach( $posts as $p) : ?>				
				<div class="col-md-4 col-sm-6 col-xs-12 director">
				
					<?php $image = get_field('image',$p->ID); ?>
					<?php $position = get_field('position',$p->ID); ?>
					<?php $size_url = $image['sizes']['large']; ?>
					<div class="portrait" style="background: url('<?php echo $size_url; ?>') no-repeat center"> 
					   		
						<div class="greylabel">
							<h4><?php echo get_post($p->ID)->post_title; ?></h4>
							<h4 id="dirtitle"><?php echo $position; ?></h4>
						</div>

				   		<div class="transp"> 			   		
							<h3><?php echo get_post($p->ID)->post_title; ?></h3>
							<h4 id="dirtitle"><?php echo $position; ?></h4>
							<hr>
							<?php
								$post_object = get_post($p->ID);									
								$post_content = $post_object->post_content;									
							?>
							<?php echo wpautop(excerpt(35,$post_object,$post_content)); ?>
							<p>
								<a href="<?php echo get_permalink($p->ID); ?>">
									<h4 id="plus">
										<i class="fa fa-plus-circle"></i> <?php _e('MORE','directors-template'); ?>
									</h4>
								</a>
							</p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>

		</div>

		<?php if ($team_img = get_field('team_image')) : ?>
			<div class="team-image">
				<?php echo wdb_responsive_img($team_img); ?>
				<div class="greylabel">
					<h4 id="dirtitle">QueensCare Health Centers Board of Directors</h4>
				</div>			
			</div>
			<p class="team-image-text">
				<?php echo get_field('team_image_description'); ?>
			</p>
		<?php endif; ?>
		
	</div>	

</div><!-- #directors-content -->



<?php get_footer(); ?>