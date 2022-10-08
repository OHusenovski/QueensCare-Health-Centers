<?php 

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

dev_comment('tpl: template-parts/sidebar-archives');

?>

<div id="sidebar-archives">

	<?php 

		$terms_year = array(
		    'post_type' => 'news',
		    'posts_per_page' => -1,
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
		endif;
		
		wp_reset_postdata();
	?>
		
	<h2>ARCHIVES</h2>
	<div class="archive-years">
		<?php foreach ($years as $year) : ?>
			<a href="<?php echo get_site_url().'/news-press-releases/?y='.$year; ?>">
				<?php echo $year ?>
			</a>				
		<?php endforeach; ?>
	</div>
</div>