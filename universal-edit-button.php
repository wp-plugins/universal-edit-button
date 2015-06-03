<?php
/*
Plugin Name: Universal Edit Button
Plugin URI: http://universaleditbutton.org/Wordpress_plugin
Description: Adds a link in the head of the page that will activate the <a href="http://universaleditbutton.org/">Universal Edit Button</a> if the user has it installed. The button is an icon in the URL bar that indicates a web page is editable, and takes the user directly to the edit view.
Author: UniversalEditButton.org
Author URI: http://universaleditbutton.org/
Version: 1.0.1
*/

// Plugin inspired by a discussion on the WP-Hackers list: http://lists.automattic.com/pipermail/wp-hackers/2008-June/020722.html

function ueb_add_head_link() {
	if( is_single() || is_page() ) {
		global $post;
		switch ( $post->post_type ) {
			case 'attachment':
				return;
			case 'page':
				if( ! current_user_can( 'edit_page', $post->ID ) ) return;
				break;
			case 'post':
			default:
				if ( ! current_user_can( 'edit_post', $post->ID ) ) return;
				break;
		}

		echo '<link rel="alternate" type="application/x-wiki" title="Edit this page" href="' . get_edit_post_link($post->ID) . "\" />\n";
	}
}

add_action( 'wp_head', 'ueb_add_head_link' );
?>