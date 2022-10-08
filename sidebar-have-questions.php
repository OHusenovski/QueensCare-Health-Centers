<?php 

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

dev_comment('tpl: template-parts/have_questions');

?>

<div id="have-questions">
	<h2><?php _e('Have Questions?','sidebar-have-questions') ?></h2>
	<div class="phone-num">
		<?php //echo get_opt('appointment_phone'); ?>
		<?php $override247 = get_field('override_247'); ?>
		<?php $appointnmb = get_opt('appointment_phone');  ?>
			<?php if ( $override247 ) : ?>
		<?php echo $override247; ?> 
		<?php else : 
		 	echo $appointnmb; ?>
		<?php endif; ?>		
	</div>
</div>