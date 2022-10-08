<?php
/*
 *	Template Name: 10-News-Listing-Template
 */ ?>

<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

get_header(); // Loads the header.php template. 

dev_comment('tpl: 10-news-listing-template');

?>

<?php 

$args = array(
	'banner_classes' => '',
	'title' => ''
	);

wdb_get_banner( $args ); // Located in _wdbar/functions.php

?>

<div id="news-content">

	
	<div class="container">
		
		<?php 

			$terms_year = array(
			    'post_type' => 'news',
			    'posts_per_page' => -1,
			    'suppress_filters' => false,
			    'post_status' => 'publish'
			);

			$years = array();
			$query_year = new WP_Query( $terms_year );

			if ( $query_year->have_posts() ) :
			    while ( $query_year->have_posts() ) : $query_year->the_post();
			        $year = get_the_date('Y');
			        if(!in_array($year, $years)){
			            $years[] = $year;
			        }
			    endwhile;
			    wp_reset_postdata();
			endif;

		?>

		<?php $selected_year = $_GET['y']; ?>
		
		<div class="news-archives">
			<h3><?php _e('ARCHIVES','news-listing-template'); ?></h3>
			<div class="years">
				<?php foreach ($years as $year) : ?>
					<a class="<?php echo ($selected_year == $year) ? 'bold' : '' ?>" 
					   href="<?php echo get_site_url().'/news-press-releases/?y='.$year; ?>">
							<?php echo $year ?>
					</a>				
				<?php endforeach; ?>
			</div>
		</div>

		<div class="row">
			<?php 
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$posts_per_page = ($paged == 1) ? 10 : 8;

				if ($selected_year) {
					$args = array(
						'post_type' => 'news',
						'posts_per_page' => $posts_per_page,
						'post_status'    => 'publish',
						'suppress_filters' => false,
						'orderby' => 'date',
						'order' => 'DESC',
						'date_query' => array(
					        array('year' => $selected_year)
					    ),
						'paged' => $paged		
					);
				} else {
				$args = array(
						'post_type' => 'news',
						'posts_per_page' => $posts_per_page,
						'post_status'    => 'publish',
						'suppress_filters' => false,
						'orderby' => 'date',
						'order' => 'DESC',
						'paged' => $paged		
					);
				}

				$wp_query = new WP_Query($args);
			?>
			
			<?php $counter = 0; ?>
			<?php if (have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
				<?php $counter = $counter + 1; ?>
				<div class="newss col-sm-6 <?php echo ($counter <=2 && $paged==1) ? 'bigsquare col-lg-6 col-xs-12' : 'col-md-3 col-xs-12' ?>">
					<div class="newsframe">
					<a href="<?php the_permalink();?>">
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
							
							<?php if ($counter <=2 && $paged==1) : ?>
								<div class="news-content">
									<?php echo wpautop(excerpt(42)); ?>
								</div>
							<?php endif; ?></a>
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
								<a href="<?php the_permalink(); ?>"><h5 class="readplus"><i class="fa fa-plus-circle"></i> <?php _e('READ MORE','news-listing-template'); ?></h5></a>
							</article>
						</div>
				  	</div>
				</div>

			<?php endwhile; endif; ?>

		</div><!--.row-->

		<div class="site-navigation">
			<?php
	    		if (function_exists(custom_pagination)) {
	    			custom_pagination($wp_query->max_num_pages,"",$paged);
	    	 	} ?>
			<?php wp_reset_postdata(); ?>	
		</div>

	</div>	

</div><!-- #news-content -->



<?php get_footer(); ?>