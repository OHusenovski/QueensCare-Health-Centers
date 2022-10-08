<?php
/*
 *	Template Name: 15-Calendar-Template
 */ 
?>

<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
} 

get_header(); // Loads the header.php template. 

dev_comment('tpl: 15-calendar-template');

?>

<?php 

wp_enqueue_style( 'wdb-loader-cube', get_stylesheet_directory_uri() . '/assets/loader-cube.css' );

get_template_part( 'template-parts/_loader-cube' );

$args = array(
	'banner_classes' => '',
	'title' => ''
	);

wdb_get_banner( $args ); // Located in _wdbar/functions.php

?>

<div id="calendar-content">
	<div class="container">

		<?php
		if (isset($_GET["date"])) {
			$date = $_GET["date"] . '01';
		} else {
			$date = date('Ym') . '01';
		}
		$prev = date('Ymd', strtotime($date));
		$next = date('Ymd', strtotime($date. ' + 1 months'));
		?>

		<form action="" method="get">
			<label><?php echo date('F Y', strtotime($date)); ?></label>
			<input class="rightarrow" type="submit" name="date" value="<?php echo date('Ym', strtotime($next)); ?>" />
			<input class="leftarrow" type="submit" name="date" value="<?php echo date('Ym', strtotime($prev)); ?>" />
		</form>

		<div class="row flex-row eventswhole">

			<?php 

			$meta_query = array(
				'relation' => 'AND',
				array(
					'key' => 'start_date',
					'value' => $date,
					'type' => 'DATE',
					'compare' => '>='
					),
				array(
					'key' => 'end_date',
					'value' => $next,
					'type' => 'DATE',
					'compare' => '<'
					)
				);

			$args = array(
				'post_type' => 'events',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'suppress_filters' => false,
				'order' => 'ASC',
				'orderby' => 'meta_value',
				'meta_key' => 'start_date',
				'meta_query' => $meta_query
				);

			$events = get_posts($args); 
			?>
			<?php if( $events ): ?>
				<?php foreach ($events as $event) : ?>
					<?php $date1 = new DateTime(get_field('start_date',$event->ID)); 
					$today = new DateTime();
					$diff = $today->diff( $date1 );
					$diffDays = (integer)$diff->format( "%R%a" ); 
					?>
					<?php if($diffDays >= -1): ?>
						<div class="col-md-3 col-sm-4 eventblock">
							<div class="innerpad">
								<div class="datetitle">
									<h3><?php 
										echo $date1->format('j'); ?>
									</h3>
									<h3><?php 
										$date2 = new DateTime(get_field('start_date',$event->ID));
										echo $date2->format('M'); ?>
									</h3>
									<h5><?php 
										$date3 = new DateTime(get_field('end_date',$event->ID));
										if ($date3->format('j') == $date2->format('j')) { echo "";} else {
											echo " - ".$date3->format('j');} 
											?>
										</h5>
									</div>
									<div class="eventitle">
										<?php echo get_post($event->ID)->post_title; ?>
									</div>
									<div class="eventime">
										<i class="fa fa-clock-o"></i>
										<span class="newprg"><?php 
											$date1 = new DateTime(get_field('start_date',$event->ID));
											echo $date1->format('g:i a'); ?>
										</span>
										<span> - <?php 
											$date2 = new DateTime(get_field('end_date',$event->ID));
											echo $date2->format('g:i a'); ?>
										</span>
									</div>
									<div class="eventlocation">
										<i class="fa fa-map-marker"></i>
										<p>
											<?php $place = get_field('place', $event->ID); ?>
											<?php echo $place; ?> 
											<?php $location = get_field('location',$event->ID); ?>
											<?php $address = $location['address']; ?>
											<?php echo $address; ?>
										</p>
									</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div> <!-- row -->
		</div>	<!-- container -->

	</div><!-- #calendar-content -->


	<?php get_footer(); ?>

	<script type="text/javascript">
		jQuery('.form-search').on('submit',function(){return false;});

		jQuery(function(){
			jQuery('form').submit(function() {
				var $this = jQuery(this);
				if (!$this.hasClass('form-search')) {
					jQuery("#loader-wrap").removeAttr('style');
				}	    
			});
		});

		function onSelectChange(){
			jQuery("#loader-wrap").removeAttr('style');
			document.getElementById('frm-specialty').submit();
		}
	</script>