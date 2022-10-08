<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js lt-ie9 lt-ie8 ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js lt-ie9 ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayerZypmedia','GTM-5BPVCD9');</script>
<!-- End Google Tag Manager -->
	<?php wp_head(); // wp_head ?>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141036036-2"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-141036036-2');
	</script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-44565316-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-44565316-1');
	</script>


	
	
</head>

<body <?php hybrid_attr( 'body' ); ?>>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5BPVCD9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<header class="menu-container navbar navbar-default" <?php hybrid_attr( 'header' ); ?>>

		<div id="header-top-container">

			<div class="container">

				<div class="navbar-header">

					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="sr-only"><?php _e('Toggle navigation','header-template'); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<div id="branding" class="navbar-brand">
						<?php $logo = get_opt('site_logo'); ?>
						<a href="<?php echo site_url(); ?>">
							<img src="<?php echo $logo['url']; ?>" alt="">
						</a>
					</div><!-- #branding -->

					<div id="header-top-nav">
						<?php  
							// WP Search
							//echo do_shortcode( '[searchwp_search_form]' );
						?>
						<form method="get" class="search-form search-form-top navbar-form navbar-right" role="search" action="<?php echo get_permalink(985); ?>">
							<div class="search-toggle pull-left">
								<button class="glyphicon glyphicon-search" type="button"><span class="sr-only"><?php _e('Search','header-template'); ?></span></button>
							</div>
							<div class="form-group">
								<input class="search-text form-control search-query" type="search" name="swpquery" value="<?php if ( is_search() ) echo esc_attr( get_search_query() ); else _e('Search this site...','header-template'); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
								<button class="search-submit btn btn-default" type="submit"><?php esc_attr_e( 'Search', hybrid_get_parent_textdomain() ); ?></button>
							</div>
						</form><!-- .search-form -->
						<a class="purple" href="tel:
						<?php $override247 = get_field('override_247'); ?>
						<?php $number247 = get_opt('number_247');  ?>
						<?php if ( $override247 ) : ?>
							<?php echo $override247; ?> 
						<?php else : 
						echo $number247; ?>
					<?php endif; ?>">

					<span class="phone"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
					<span class="number">
						<?php $override247 = get_field('override_247'); ?>
						<?php $number247 = get_opt('number_247');  ?>
						<?php if ( $override247 ) : ?>
							<?php echo $override247; ?> 
						<?php else : 
						echo $number247; ?>
					</span>
				<?php endif; ?>
			</a>
			<a target="_blank" rel="noopener noreferrer" class="btn green green-border" href="<?php echo get_opt('my_chart_button_url'); ?>"><?php _e('MyChart','header-template'); ?></a>
			<a class="btn orange orange-border" href="<?php echo get_opt('donate_link'); ?>"><?php _e('Donate','header-template'); ?></a>
			&nbsp;&nbsp;&nbsp;<?php echo do_shortcode('[gtranslate]'); ?>
		</div>

	</div><!-- .navbar-header -->

</div><!-- .container -->

</div><!--#header-top-container-->

<div id="primary-menu-container">
	<div class="alert-bar"><?php echo get_opt('alert_bar'); ?></div>
	<div class="container">
		<?php get_template_part( 'menu', 'primary' ); /* Loads the menu-primary.php template */ ?>
	</div>
</div>

</header><!-- #header -->

<?php if ( is_front_page() ) get_template_part( 'banner', 'primary' ); /* Loads the banner-primary.php template */ ?>

<main <?php hybrid_attr( 'content' ); ?>>
