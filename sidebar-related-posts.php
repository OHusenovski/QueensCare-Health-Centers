<?php 

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

dev_comment('tpl: template-parts/sidebar-archives');

?>

<?php if ($posts = get_field('select_related_posts')) : ?>

	<div id="sidebar-related-posts">		
		<h2>Related Posts</h2>
		<div class="related-posts">
			<?php foreach ($posts as $p_id) : ?>
				<i class="fa fa-newspaper-o" aria-hidden="true"></i>
				<h4><?php echo get_the_title($p_id['post']); ?></h4>				
				
				<?php
					$post_object = get_post($p_id['post']);
					$post_content = $post_object->post_content;
				?>
				<?php echo wpautop(excerpt(10,$post_object,$post_content)); ?>
				
				<a href="<?php echo get_the_permalink($p_id['post']); ?>">
					MORE <i class="fa fa-chevron-right" aria-hidden="true"></i>
				</a>				
			<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>