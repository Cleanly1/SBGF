<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/yourTabIcon" type="image/x-icon">
	<title>Stenkumla Bygdegård</title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header>

		<?php
		wp_nav_menu(
			[
				'theme_location' => 'menu-1',
				'menu_id' => 'primary-menu',
				'container' => 'nav',
				'container_class' => 'menu',
			]
		);
		?>

	</header>