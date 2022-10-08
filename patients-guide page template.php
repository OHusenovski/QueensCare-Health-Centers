<?php
/*
 *	Template Name: 03-Patient-Guide-Template
 */ ?>

<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

get_header(); // Loads the header.php template. 

dev_comment('tpl: 03-patient-guide-template');

?>

<?php 

$args = array(
	'banner_classes' => '',
	'title' => ''
	);

wdb_get_banner( $args ); // Located in _wdbar/functions.php

?>

<div id="patient-content">

	
	<div class="container">
		<div class="row">

			<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : ?>

			<?php the_post();  ?>

			<div class="col-md-8 col-md-push-4 patient-content">

				<h3><?php the_title(); ?></h3>


			<?php $rows = get_field('patient_options'); ?>
				
					<?php if ($rows) : ?>
						<div>
							<?php foreach ($rows as $row) : ?>
								<div class="patientitems">

									<?php if ($row['heading']) : ?>
										<h4><?php echo $row['heading']; ?></h4> 
									<?php endif; ?>

									<?php if ($row['paragraph']) : ?>
										<p><?php echo wpautop($row['paragraph']); ?></p> 
									<?php endif; ?>

									<?php $table = $row['table'];
									if ( $table ) {

									    echo '<table border="0">';

									        if ( $table['header'] ) {

									            echo '<thead>';

									                echo '<tr>';

									                    foreach ( $table['header'] as $th ) {

									                        echo '<th>';
									                            echo $th['c'];
									                        echo '</th>';
									                    }

									                echo '</tr>';

									            echo '</thead>';
									        }

									        echo '<tbody>';

									            foreach ( $table['body'] as $tr ) {

									                echo '<tr>';

									                    foreach ( $tr as $td ) {

									                        echo '<td>';
									                            echo $td['c'];
									                        echo '</td>';
									                    }

									                echo '</tr>';
									            }

									        echo '</tbody>';

									    echo '</table>';
									}
									?>

									<?php $rows1 = $row['attach_option']; ?>									
									<?php if ($rows1) : ?>
										<div class="attoption">
										<?php foreach ($rows1 as $row1) : ?>
											<div class="patatt">
												
												<?php 

													$file = $row1['attach_item'];

													if( $file ): ?>
														
														<a href="<?php echo $file['url']; ?>">
															<?php if ($row1['att_name']) : ?>
																<h4><i class="fa fa-file-pdf-o"></i> <?php echo $row1['att_name']; ?></h4> 
															<?php endif; ?>
														</a>

													<?php endif; ?>
											</div>

										<?php endforeach; ?>
										</div>
									<?php endif; ?>

									<?php 

									$link = $row['add_button'];

									if( $link ): ?>
										
										<a class="btn white-blue" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>

									<?php endif; ?>


								</div> <!-- patientitems -->
							<?php endforeach; ?>
						</div>
						<?php endif; ?>

			<?php endwhile; ?>
			<?php endif; ?>	

		</div> <!-- col-md-8 col-md-push-4 -->

		<div class="col-md-4 col-md-pull-8">	
			<?php include_locate( 'template-parts/sidebar-submenu.php' ); ?>
			<?php include_locate( 'template-parts/have_questions.php' ); ?>
			<?php include_locate( 'template-parts/sidebar-related_posts.php' ); ?>
		</div>

		</div> <!-- row -->
	</div>	<!-- container -->

</div><!-- #patient-content -->



<?php get_footer(); ?>