<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

get_header(); // Loads the header.php template. 

dev_comment('tpl: 11-news-details');

?>

<?php 

$args = array(
	'banner_classes' => '',
	'title' => ''
	);

wdb_get_banner( $args ); // Located in _wdbar/functions.php

?>

<div id="news-details">

	
	<div class="container">
			
		<?php 
			$args = array(
				'post_type' => 'news'
			);
			$posts = get_posts($args);
		?>
		
		<?php if( $posts ): ?>

		<div class="newss col-md-8 col-md-push-4 bigsquare" id="newsright">
 			<div class="newsframe">
				<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<?php if ($url) : ?>
			  		<div class="newsimg" style="background: url('<?php echo $url; ?>') no-repeat center;"></div>
			  	<?php else : ?>
					<div class="newsimg news-color">
						<i class="fa fa-newspaper-o" aria-hidden="true"></i>
					</div>
			  	<?php endif; ?>
					  	
				<div id="newstitl">
					<h4><?php the_title(); ?></h4>					
					<article class="soc">
						<h5 id="datum"><?php echo get_the_date(); ?></h5>
						<div class="miniborders">
							<a href="mailto:?Subject=<?php the_title(); ?>&amp;Body=Link:%20 <?php the_permalink(); ?>"  target="_blank">
								<i class="fa fa-share-square" aria-hidden="true"></i>
							</a>
							<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a>
							<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>&amp;hashtags=queenscare" target="_blank">
								<i class="fa fa-twitter" aria-hidden="true"></i>
							</a>
							<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>" target="_blank">
								<i class="fa fa-linkedin" aria-hidden="true"></i>
							</a>
						</div>
					</article>	
					<div class="news-content">
						<?php $content = wpautop( $post->post_content ); ?>
						<?php echo $content ?>
					</div>
				</div>
			</div>
		</div>
				
			<?php endif; ?>

			<div class="col-md-4 col-md-pull-8">
				<?php include_locate( 'template-parts/sidebar-related_posts.php' ); ?>
				<?php include_locate( 'template-parts/sidebar-archives.php' ); ?>				
			</div>
		
	</div>	

</div><!-- #main-details -->



<?php get_footer(); ?>