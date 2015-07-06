<?php
/**
 * Plugin Name: Activity Slider
 * Description: A Simple Bootstrap Slider to Display Posts
 * Version: 1.0.2
 * Author: Hornig Software
 * Author URI: http://hornig-software.com
 * License: The MIT License (MIT)
 */
 
/** Copyright (c)2015 Hornig Software <info@h-software.de>

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/
function HS_as_enqueue(){
	wp_enqueue_script( 'HS_as_carousel_script', plugins_url( '/inc/js/carousel.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'HS_as_fullscreen', plugins_url( '/fullscreen.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_style( 'HS_as_carousel_style', plugins_url( '/inc/css/carousel.css', __FILE__ ) );
	wp_enqueue_style( 'HS_as_style', plugins_url( '/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'HS_as_enqueue' );

require_once( 'carousel.php' );
function HS_as_editor(){
	if( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) && get_user_option( 'rich_editing' ) == 'true' ){
		add_filter( 'mce_external_plugins', 'HS_as_editor_plugin' );
		add_filter( 'mce_buttons', 'HS_as_editor_button' );
	}
}
add_action( 'init', 'HS_as_editor' );

function HS_as_editor_plugin( $plugins ){
	$plugins[ 'HS_as_button' ] = plugins_url( '/editor_button.js', __FILE__	);
	return $plugins;
}

function HS_as_editor_button( $buttons ){
	$buttons[] = 'HS_as_button';
	return $buttons;
}