<?php


if ( ! defined( 'ABSPATH' ) ) exit;
/*
=========================
	Front End Enqueuing styles
=========================
*/

function hr_news_ticker_enqueue_scripts(){

wp_enqueue_style('news_hr_style',plugin_dir_url( __FILE__ ).'css/style.css');

}

add_action('wp_enqueue_scripts', 'hr_news_ticker_enqueue_scripts' );




/*
=========================
	Back End Enqueuing styles
=========================
*/
function hr_news_ticker_admin_enqueue_scripts(){

wp_enqueue_style( 'wp-color-picker' );
wp_enqueue_script( 'news_hr_color_handle', plugin_dir_url(__FILE__ ).'js/app.js' ,array( 'wp-color-picker' ), false, true  );

}
add_action('admin_enqueue_scripts', 'hr_news_ticker_admin_enqueue_scripts' );

?>