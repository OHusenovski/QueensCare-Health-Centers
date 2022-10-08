<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
	</main><!-- #main -->

	<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-primary.php template. ?>

	<footer <?php hybrid_attr( 'footer' ); ?>>

		<div class="apointment">
			<div class="container text-center">
				<a href="<?php echo 'tel:' . get_opt('appointment_phone') ?>"><i class="fa fa-phone" aria-hidden="true"></i><?php echo get_opt('appointment_text') ?></a>
				<span class="divider">|</span>
				<a href="<?php echo get_opt('location_url') ?>"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo get_opt('location_text') ?></a>
			</div>
		</div>
		
		<div class="footer-cols">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-1">
						<img src="<?php  echo get_opt('footer_column_1_logo')['url']; ?>">
						<p>
							<?php echo get_opt('footer_column_1_text'); ?>
						</p>
					</div>
					<div class="col-lg-5 col-md-4 clearfix">
						<?php wp_nav_menu(array('depth' => 1)); ?>
					</div>
					<div class="col-lg-3 col-md-4 col-3">
						<?php include_locate( 'template-parts/social-icons.php' ); ?>
					</div>
				</div>
						<div class="container">
							<hr />
							<div class="row">QueensCare Health Centers is a federally qualified health center, partially funded by grants from the U.S. Department of Health & Human Services, Health Resources & Services Administration (HRSA) and has Federal Public Health Service (PHS) deemed status under the Federal Tort Claims Act with respect to certain health or health-related claims, including medical malpractice claims, for itself and its covered individuals. The health services provided by QueensCare Health Centers are also partially funded by the County of Los Angeles. QueensCare Health Centers treats all patients, regardless of ability to pay.</div>
				</div>
			</div>
		</div>

		<div class="container">
			<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>
			<div class="footer-content">
				<p class="credit"><?php printf( __( 'COPYRIGHT &#169; %1$s %2$s. All Rights Reserved', hybrid_get_parent_textdomain() ), date_i18n( 'Y' ), hybrid_get_site_link() ); ?></p><!-- .credit -->
				<p>
					<?php echo get_opt('footer_bottom_text'); ?>
				</p>
			</div><!-- .footer-content -->
		</div><!-- .container -->

	</footer><!-- #footer -->

	<?php wp_footer(); // wp_footer ?>

</body>
</html>