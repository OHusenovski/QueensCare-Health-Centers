<?php
/*
 *	Template Name: 08-Performance-Scores-Template
 */ 
?>

<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

get_header(); // Loads the header.php template. 

dev_comment('tpl: 08-performance-scores-template');

?>

<?php 

$args = array(
	'banner_classes' => '',
	'title' => ''
	);

wdb_get_banner( $args ); // Located in _wdbar/functions.php

?>

<div id="performance-content">

	
	<div class="container">
		<div class="row">

			<div class="col-md-8 col-md-push-4 perf">

				<?php $rows = get_field('perf_goals'); ?>

				<?php if ($rows) : ?>
					<div class="perfgoals">
						<?php $blocks_count = 0; ?>
					<?php foreach ($rows as $row) : ?>
						<div>
							<?php if ($row['title1']) : ?>
								<h3><?php echo $row['title1']; ?></h3> 
							<?php endif; ?>

							<?php $rows1 = $row['block_opt']; ?>									
							<?php if ($rows1) : ?>
								<div>
								<?php foreach ($rows1 as $row1) : ?>
									<?php $blocks_count++; ?>
									<div class="col-md-4 col-sm-4 blck">
										<div class="ttable">
										<div class="tcell">
											<?php if ($row1['percentage']) : ?>
												<h4 class="perc"><?php echo $row1['percentage']; ?></h4> 
											<?php endif; ?>

											<?php if ($row1['goalname']) : ?>
												<h4 class="goalname"><?php echo $row1['goalname']; ?></h4> 
											<?php endif; ?>
										</div>
										</div>
									</div>
									
									<?php if ( $blocks_count % 3 == 0  && !(count($rows1) == $blocks_count && count($rows1) % 3 == 0) ) : ?>
										</div>
										<br style="clear: both;">
										<hr class="grline">
										<div class="row mrg0">
									 <?php endif; ?>

								<?php endforeach; ?>
								</div>
							<?php endif; ?>

						</div>					
					<?php endforeach; ?>
					</div>
				<?php endif; ?>


				
				<?php $raws = get_field('perf_scores'); ?>

				<?php if ($raws) : ?>
					<div class="col-md-12 minpad">
					<?php foreach ($raws as $raw) : ?>
						<div class="perfscores">

							<?php if ($raw['title2']) : ?>
								<h3><?php echo $raw['title2']; ?></h3> 
							<?php endif; ?>


							<?php $raws1 = $raw['file_options']; ?>									
							<?php if ($raws1) : ?>
								<div  class="atchfile">
								<?php foreach ($raws1 as $raw1) : ?>

									<div>

										<?php 
										$file = $raw1['attach_file'];

										if( $file ): ?>
											
											<a href="<?php echo $file['url']; ?>">
												<?php if ($raw1['attached_file_name']) : ?>
													<h4 class="bluei"><i class="fa fa-file-pdf-o"></i> <?php echo $raw1['attached_file_name']; ?></h4> 
												<?php endif; ?>
											</a>

										<?php endif; ?>
																			
									</div>

								<?php endforeach; ?>
								</div>
							<?php endif; ?>

						</div>					
					<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>	<!-- perf -->

			<div class="col-md-4 col-md-pull-8">	
				<?php include_locate( 'template-parts/sidebar-submenu.php' ); ?>
				<?php include_locate( 'template-parts/have_questions.php' ); ?>
				<?php include_locate( 'template-parts/sidebar-related_posts.php' ); ?>
			</div>

		</div> <!-- row -->
	</div>	<!-- container -->

</div><!-- #performance-content -->



<?php get_footer(); ?>