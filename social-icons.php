<?php 

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

dev_comment('tpl: template-parts/social-locations');

?>

<div class="socials">
	<h2><?php echo get_opt('footer_column_3_title'); ?></h2>
	<?php $socials = get_opt('social_icons'); ?>
	<div class="social-icons">
		<?php foreach ($socials as $media) : ?>
			<a href="<?php echo $media['social_media_link']; ?>"><i class="fa fa-<?php echo $media['social_media_type']; ?>" aria-hidden="true"></i></a>
		<?php endforeach; ?>
	</div>
</div>