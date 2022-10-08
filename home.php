<?php
// File Security Check
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
	die('You do not have sufficient permissions to access this page!');
}

get_header(); // Loads the header.php template. 

wdb_use_eventify();
?>

<div class="container">

	<?php
	$args = array(
		'post_type' => 'services',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'suppress_filters' => false,
		'post_parent__not_in' => array(0) //exclude parent post
	);
	$services = get_posts($args);
	?>
	<?php if ($services) : ?>
		<div id="home-services">
			<div class="row">
				<?php foreach ($services as $s => $service) : ?>
					<?php if (get_post($service->post_parent)->post_parent == 0) : ?>
						<div class="col-md-3 col-sm-6 service-item">
							<div class="item-container">
								<div class="service-image" style="background-image: url(<?php echo get_field('service_image', $service->ID)['url']; ?>);"></div>
								<div class="ttable position-absolute">
									<a href="<?php echo get_the_permalink($service->ID); ?>" style="background-color:<?php echo the_field('service_home_color', $service->ID); ?>f2" class="tcell" onmouseover="this.style.backgroundColor='<?php echo the_field('service_home_color', $service->ID); ?>cc'" onmouseout="this.style.backgroundColor='<?php echo the_field('service_home_color', $service->ID); ?>f2'">
										<img src="<?php echo get_field('service_transparent_icon', $service->ID)['url']; ?>">
										<h3><?php echo get_the_title($service->ID); ?></h3>
									</a>

								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>

</div><!-- .container -->

<div class="container">
	<div class="row">
		<div class="col-md-6 charts">
			<div id="my-chart" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/img/my-chart-1.png' ?>);">
				<h2><?php echo get_opt('my_chart_title'); ?></h2>
				<?php $chart_items = get_opt('my_chart_items'); ?>
				<ul>
					<?php foreach ($chart_items as $item) : ?>
						<li><?php echo $item['item']; ?></li>
					<?php endforeach; ?>
				</ul>
				<?php $button = get_opt('my_chart_button'); ?>
				<?php if ($button) : ?>
					<div class="section-btn text-center">
						<?php echo get_link_btn($button, 'btn white'); ?>
					</div>
				<?php endif; ?>
			</div>
			<div id="find-doc" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/img/find-doctor.png' ?>);">
				<h2><?php echo get_opt('find_a_doc_section_title'); ?></h2>
				<p><?php echo get_opt('find_a_doc_section_text'); ?></p>
				<?php $button = get_opt('find_a_doc_section_button'); ?>
				<?php if ($button) : ?>
					<div class="section-btn text-center">
						<?php echo get_link_btn($button, 'btn white'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-md-6 calendar">
			<div id="home-calendar" class="noselect calendar-container" style="display: none;">
				<?php
				$args = array(
					'post_type' => 'events',
					'posts_per_page' => -1,
					'suppress_filters' => false,
					'post_status' => 'publish'
				);
				$events = get_posts($args);
				?>
				<h2 class="section-title"><?php _e('CALENDAR', 'home-template'); ?></h2>
				<div id="ei-events">
					<?php foreach ($events as $event) : ?>
						<?php $location = get_field('location', $event->ID); ?>
						<?php $address = $location['address']; ?>
						<div class="ei-event" data-start="<?php echo get_field('start_date', $event->ID); ?>" data-end="<?php echo get_field('end_date', $event->ID); ?>" data-loc="<?php echo (get_field('place', $event->ID) . '<br/>' . $address); ?>" data-link="<?php echo get_permalink($event->ID); ?>">
							<div class="ei-name"><?php echo get_the_title($event->ID); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
				<a href="<?php bloginfo('url'); ?>/?p=1464" class="all-events text-center">
					<?php _e('View All Events', 'home-template'); ?>
				</a>
			</div>
		</div>
	</div>
</div>

<!-- start locations section -->
<?php include_locate('template-parts/section-locations.php'); ?>
<!-- end locations section -->


<div id="home-posts">
	<?php
	$posts_number = get_opt('number_of_posts');
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => $posts_number,
		'post_status' => 'publish',
		'orderby' => 'date',
		'suppress_filters' => false,
		'order' => 'DESC',
	);
	$posts = get_posts($args);
	?>
	<div class="container container-left">
		<div class="row">
			<div class="col-md-5 home-latest-posts">
				<?php foreach ($posts as $p) : ?>
					<div class="post">
						<?php $url = wp_get_attachment_url(get_post_thumbnail_id($p->ID)); ?>
						<img src="<?php echo $url; ?>">
						<div class="post-content">
							<div>
								<i class="fa fa-newspaper-o" aria-hidden="true"></i>
							</div>
							<h4><?php echo get_the_title($p->ID); ?></h4>
							<?php
							$post_object = get_post($p->ID);
							$post_content = $post_object->post_content;
							?>
							<?php echo wpautop(excerpt(10, $post_object, $post_content)); ?>
							<a href="<?php echo get_the_permalink($p->ID); ?>">
								<?php _e('MORE', 'home-template'); ?> <i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="col-md-7 home-featured-post">
				<?php $featured_post = get_opt('featured_post'); ?>
				<?php $url = wp_get_attachment_url(get_post_thumbnail_id($featured_post->ID)); ?>
				<div class="post-container" style="background-image: url(<?php echo $url; ?>); ">
					<div class="post-info">
						<div>
							<i class="fa fa-newspaper-o" aria-hidden="true"></i>
						</div>
						<h3><?php echo get_the_title($featured_post->ID); ?></h3>
						<?php
						$post_object = get_post($featured_post->ID);
						$post_content = $post_object->post_content;
						?>
						<?php echo wpautop(excerpt(10, $post_object, $post_content)); ?>
						<a href="<?php echo get_the_permalink($featured_post->ID); ?>">
							<?php _e('MORE', 'home-template'); ?> <i class="fa fa-chevron-right" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 slider-posts">
				<div id="posts-slider">
					<div class="home-latest-posts">
						<div id="slider-posts">
							<?php wdb_use_slick(); ?>
							<?php foreach ($posts as $p) : ?>
								<div class="slick-slide">
									<div class="post">
										<?php $url = wp_get_attachment_url(get_post_thumbnail_id($p->ID)); ?>
										<img src="<?php echo $url; ?>">
										<div class="post-content">
											<div>
												<i class="fa fa-newspaper-o" aria-hidden="true"></i>
											</div>
											<h4><?php echo get_the_title($p->ID); ?></h4>
											<?php
											$post_object = get_post($p->ID);
											$post_content = $post_object->post_content;
											?>
											<?php echo wpautop(excerpt(10, $post_object, $post_content)); ?>
											<a href="<?php echo get_the_permalink($p->ID); ?>">
												<?php _e('MORE', 'home-template'); ?> <i class="fa fa-chevron-right" aria-hidden="true"></i>
											</a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="work-with-us" style="background-image: url(<?php echo get_opt('work_with_us_background_image')['url']; ?>);">
	<div class="opacity-layer" style="background-color: <?php echo hex2rgba(get_opt('work_with_us_opacity_layer_color'), 0.8); ?>">
		<div class="container">
			<h2><?php echo get_opt('work_with_us_title'); ?></h2>
			<p><?php echo get_opt('work_with_us_text'); ?></p>
			<?php $button = get_opt('work_with_us_button'); ?>
			<?php if ($button) : ?>
				<div class="section-btn">
					<?php echo get_link_btn($button, 'btn white'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	function adjustHomePosts() {
		var w = window,
			d = document,
			e = d.documentElement,
			g = d.getElementsByTagName('body')[0],
			x = w.innerWidth || e.clientWidth || g.clientWidth,
			y = w.innerHeight || e.clientHeight || g.clientHeight;
		var el = document.getElementsByClassName('container-left')[0];
		var el2 = document.getElementsByClassName('home-featured-post')[0];
		if (x > 991) {
			var height = document.getElementsByClassName('home-latest-posts')[0].clientHeight;
			var width = document.getElementsByClassName('container')[0].offsetWidth + 15;
			var margin = (x - width) / 2;
			el.style.marginLeft = margin + 'px';
			el.style.marginRight = '0px';
			el.style.width = 'auto';
			el2.style.height = height + 'px';
		} else {
			el.style.margin = 'auto';
			el.style.width = 'auto';
			el2.style.height = '500px';
		}
	}

	jQuery(window).resize(function() {
		adjustHomePosts();
	});

	jQuery(document).ready(function() {
		jQuery("#home-posts").css({
			'display': "block"
		});
		adjustHomePosts();
		jQuery("#ei-events").eventify({
			theme: "",
			locale: "en"
		});
		jQuery("#home-calendar").css({
			'display': "block"
		});
	});


	jQuery(document).ready(function() {
		jQuery('#slider-posts').slick({
			dots: true,
			arrows: false,
			infinite: true,
			autoplay: true,
			autoplaySpeed: 4000,
			pauseOnHover: false,
			slidesToShow: 1,
			slidesToScroll: 1
		});
	});
</script>

<?php get_footer(); // Loads the footer.php template. 
?>