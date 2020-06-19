<?php

/**
 * Header file for the BLM_Resource_Library WordPress theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage BLM_Resource_Library
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>
	<title>Resource Library - BLM</title>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php echo get_bloginfo('template_directory'); ?>/assets/favicon.ico">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body>
	<!-- Top nav here -->
		<h1 id="pageTitle"><a href="/" >RESOURCE LIBRARY - BLACK LIVES MATTER MOVEMENT</a></h1>
	<nav class="navbar navbar-expand-lg navbar-dark" id="topNav">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<?php
				$currentPage = get_the_ID();
				$allPages = get_pages(
					array(
						"sort_column" => "menu_order",
						"sort_order" => "ASC"
					)
				);
				foreach ($allPages as $page) {
					// If this isn't the home page, highlight the menu option of whatever page this is
				?>
					<li class="nav-item <?php echo $currentPage == $page->ID ? 'active' : ''; ?>" data-pid="<?php echo $page->ID; ?>">
						<a class="nav-link" href="<?php echo get_permalink($page->ID); ?>"><?php echo get_the_title($page->ID); ?></a>
					</li>
				<?php
				}
				?>
			</ul>
		</div>
	</nav>