<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

get_header(); // Loads the header.php template. 

dev_comment('tpl: 07-director-details');

?>

<?php 

$args = array(
	'banner_classes' => '',
	'title' => ''
	);

wdb_get_banner( $args ); // Located in _wdbar/functions.php

?>

<div id="directors-details">

	
	<div class="container">
			
			<?php 
				$args = array(
					'post_type' => 'directors'
				);
				$posts = get_posts($args);
			?>
			
			<?php if( $posts ): ?>

				<div class="col-md-8 col-md-push-4">
			 			<h1 class="dettitle"><?php echo get_post($p->ID)->post_title; ?></h1>

			 			<?php $position = get_field('position',$p->ID); ?>
						<h2 class="detposition"><?php echo $position; ?></h2>

				   		<?php $image = get_field('image', $p->ID); ?>
				   		<img id="dirimg" src="<?php echo $image['url'] ?>">
				   		<?php $content = wpautop( $post->post_content ); ?>
						<div id="dirtext"><?php echo $content ?></div>
				</div>
				
			<?php endif; ?>

			<div class="col-md-4 col-md-pull-8">
				<?php include_locate( 'template-parts/sidebar-submenu.php' ); ?>
				<?php include_locate( 'template-parts/have_questions.php' ); ?>
			</div>
		
	</div>	

</div><!-- #main-details -->



<?php get_footer(); ?>