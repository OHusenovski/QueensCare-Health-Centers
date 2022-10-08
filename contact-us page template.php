<?php
/*
 *	Template Name: 13-Contact-Template
 */ 
?>

<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
} ?>

<?php acf_form_head();  ?>

<?php

get_header(); // Loads the header.php template. 

dev_comment('tpl: 13-contact-template');

?>

<?php 

$args = array(
	'banner_classes' => '',
	'title' => ''
	);

wdb_get_banner( $args ); // Located in _wdbar/functions.php

?>

<div id="contact-content">

	<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : ?>

	<?php the_post();  ?>

	<div class="callcenter">		
		<?php $rows = get_field('contact_items'); ?>
		<?php if ($rows) : ?>
				<?php foreach ($rows as $row) : ?>
				<?php $rows1 = $row['call_center_options']; ?>
				<?php if ($rows1) : ?>
					<div class="cont-callcenter clearfix">
						<div class="container">
							<?php foreach ($rows1 as $row1) : ?>
								<?php if ($row1['heading1']) : ?>
									<h4 class="col-md-4"><?php echo $row1['heading1']; ?></h4> 
								<?php endif; ?>
								<div class="col-md-8">
									<?php if ($row1['working_hours']) : ?>
										<p><?php echo $row1['working_hours']; ?></p> 
									<?php endif; ?>
									<?php if ($row1['telephone']) : ?>
										<p class="col-md-5"><i class="fa fa-phone-square"></i> <?php echo $row1['telephone']; ?></p> 
									<?php endif; ?>
									<?php if ($row1['telephone_extra']) : ?>
										<p class="col-md-5"><i class="fa fa-phone-square"></i> <?php echo $row1['telephone_extra']; ?></p> 
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php endforeach; ?>					
		<?php endif; ?>
	</div>

	<div class="container">
	<div class="row">

		<div class="col-md-6 col-md-push-6 ">
			<h3><?php the_title(); ?></h3>
			<p><?php the_content(); ?></p>

			
			
			
			<?php include_locate( 'template-parts/social-icons.php' ); ?>
		</div>

		<div class="col-md-6 col-md-pull-6 contaddress">
			<?php $rows = get_field('contact_items'); ?>
			<?php if ($rows) : ?>
					<?php foreach ($rows as $row) : ?>

					<?php if ($row['addr_heading']) : ?>
						<h4 class="addressheading"><?php echo $row['addr_heading']; ?></h4> 
					<?php endif; ?>

					<?php $rows2 = $row['locations_items']; ?>
					<?php if ($rows2) : ?>
						<div class="cont-addresses">
							<?php foreach ($rows2 as $row2) : ?>
								<div class="addressblock">
									<?php if ($row2['heading2']) : ?>
										<h4><?php echo $row2['heading2']; ?></h4> 
									<?php endif; ?>
									<?php if ($row2['location']) : ?>
										<i class="fa fa-map-marker"></i> 
										<p><?php echo $row2['location']; ?></p> 
									<?php endif; ?>
									<?php if ($row2['working_hours2']) : ?>
										<i class="fa fa-clock-o"></i> 
										<p><?php echo $row2['working_hours2']; ?></p> 
									<?php endif; ?>

									<?php 
										$link = $row2['custom_link'];
										if( $link ): ?>
											<i class="fa fa-briefcase"></i> 
										<a class="button" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
											<p><?php echo $link['title']; ?></p>
										</a>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
	
					<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<?php endwhile; ?>
	<?php endif; ?>
	</div>
	</div> <!-- row -->
	</div> <!-- container -->

	<div class="infosection">
		<?php $rows = get_field('contact_items'); ?>
		<?php if ($rows) : ?>
			<div>
				<?php foreach ($rows as $row) : ?>

				<?php $rows3 = $row['info_options']; ?>
				<?php if ($rows3) : ?>
					<div class="cont-infosec clearfix">
						<div class="container">
						<?php foreach ($rows3 as $row3) : ?>

							<?php if ($row3['heading3']) : ?>
								<h4 class="col-md-4"><?php echo $row3['heading3']; ?></h4> 
							<?php endif; ?>

							<?php $rows4 = $row3['info_items']; ?>
							<?php if ($rows4) : ?>
								<div class="cont-infoitem">										
									<?php foreach ($rows4 as $row4) : ?>
										<div class="col-md-4">
										<?php if ($row4['title']) : ?>
											<h5 class="normalweightitle"><?php echo $row4['title']; ?></h5> 
										<?php endif; ?>
										<?php if ($row4['subtitle']) : ?>
											<h5 class="thinweightitle"><?php echo $row4['subtitle']; ?></h5>
										<?php endif; ?>
										<?php if ($row4['location2']) : ?>
											<i class="fa fa-map-marker"></i>
											<p><?php echo $row4['location2']; ?></p> 
										<?php endif; ?>
										<?php if ($row4['telephone2']) : ?>
											<i class="fa fa-phone-square"></i>
											<p><?php echo $row4['telephone2']; ?></p> 
										<?php endif; ?>
										<?php if ($row4['faxnumb']) : ?>
											<i class="fa fa-fax"></i>
											<p><?php echo $row4['faxnumb']; ?></p> 
										<?php endif; ?>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
				
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>

</div><!-- #contact-content -->


<?php get_footer(); ?>