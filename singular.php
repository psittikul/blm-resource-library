<?php

/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage BLM Resource Library
 */

get_header();
?>

<div class="container-fluid" id="mainContainer">
	<?php
	$page = get_page(get_the_ID());
	echo $page->post_content;
	// echo do_shortcode('[wpforms id="49" title="false" description="false"]');
	?>
</div>
<?php
get_footer(); ?>