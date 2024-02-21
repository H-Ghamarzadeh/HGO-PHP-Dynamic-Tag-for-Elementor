<?php

/*
Plugin Name: HGO PHP Dynamic Tag for Elementor
Description: Execute PHP code in the Elementor (add custome dynamic tag to the Elementor for run PHP codes)
Version: 1.0
Author: Hadi Ghamarzadeh
Author URI: https://www.linkedin.com/in/hadi-ghamarzadeh-b2439256/
License: 
Text Domain: hgo-php-dynamic-tag-for-elementor
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function register_php_code_dynamic_tag( $dynamic_tags_manager ) {
	\Elementor\Plugin::$instance->dynamic_tags->register_group('hgo-dynamic-tag', [
		'title' => 'HGO Dynamic Tag'
	]);
	
	require_once( __DIR__ . '/dynamic-tags/php-code-dynamic-tag.php' );
	
    $dynamic_tags_manager->register( new \Elementor_Dynamic_Tag_PHP_Code );
}
add_action( 'elementor/dynamic_tags/register', 'register_php_code_dynamic_tag' );