<?php

/*
* Plugin Name: WP Posts Ticker
* Plugin Uri: http://plugins.technoxol.com
* Description: News Ticker Plugin - Display Latest Posts 
* Version: 1.1
* Author: Hamza
* Author Uri: http://technoxol.com
* License:      GPL2
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html 
*/


if ( ! defined( 'ABSPATH' ) ) exit;

require plugin_dir_path( __FILE__ ).'public/frontend_enqueue.php';

function hr_news_ticker_install()
{
//file_put_contents( __DIR__ . '/my_loggg.txt', ob_get_contents() );
}



// Admin Menu Page
function hr_news_ticker_options_page()
{
    add_menu_page(
        'NewsTicker',
        'News Ticker',
        'manage_options',
        'hr_newsticker',
        'hr_news_ticker_options_page_html',
        'dashicons-megaphone',
        20
    );
add_action( 'admin_init', 'hr_news_ticker_setting' );
}
add_action('admin_menu', 'hr_news_ticker_options_page');



// Admin Option Page Render
function hr_news_ticker_options_page_html()
{
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1> News Ticker Settings</h1>

<?php settings_errors();?>
<form method="post" action="options.php">

        <?php settings_fields('hr_news_ticker_options_group');?>

        <?php do_settings_sections('hr_newsticker');?>

        <?php submit_button();?>
</form>
     
    </div>
    <?php   
}



// Registering Admin Option & Fields

function hr_news_ticker_setting() {
    register_setting( 'hr_news_ticker_options_group', 'show_status'); 
    register_setting( 'hr_news_ticker_options_group', 'cat_list'); 
    register_setting( 'hr_news_ticker_options_group', 'ticker_bg'); 
    register_setting( 'hr_news_ticker_options_group', 'ticker_font_cl'); 
    add_settings_section( 'hr_news_ticker_general_section', 'General Settings', 'hr_news_ticker_general_options', 'hr_newsticker' ); 
    add_settings_field('hr_news_status','Disable News Ticker?','hr_news_ticker_status','hr_newsticker','hr_news_ticker_general_section');
    add_settings_field('hr_news_categories','Select Categories','hr_news_ticker_categories','hr_newsticker','hr_news_ticker_general_section');
    add_settings_field('hr_news_ticker_bg','Background Color','hr_news_ticker_bg_color','hr_newsticker','hr_news_ticker_general_section');
    add_settings_field('hr_news_ticker_font','Font / Text Color','hr_news_ticker_font_color','hr_newsticker','hr_news_ticker_general_section');
} 



// Callback Function - Status Field
function hr_news_ticker_status(){
    $show_status =esc_attr( get_option('show_status'));
    echo '<input type="hidden" name="show_status" value=""/>';
    ?>
    <input type="checkbox" name="show_status" value="1" <?php if($show_status){echo 'checked';}?> />
    <?php 

}



// Callback Function - Categories
function hr_news_ticker_categories(){

$category_list = get_option('cat_list');

    $categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
 
foreach( $categories as $category ) {


   
   $category_id = get_cat_ID($category->name);
   if (in_array($category_id, $category_list)) {
    $Cat_exist = true;
}
else{
    $Cat_exist = false;
}
    ?>
    <input type="checkbox" id="<?php echo $category->name;?>" name="cat_list[]" value="<?php echo $category_id;?>" <?php if($Cat_exist == true){

        echo 'checked';
    } ?>/>
    <?php
     echo  '<label for="'.$category->name.'" >' .$category->name. '</label></br>';
    
}

}

// Callback function -- BG News Ticker
function hr_news_ticker_bg_color(){
    $bgColor = esc_attr( get_option('ticker_bg'));
?>
<input type="text" value="<?php echo $bgColor; ?>" name="ticker_bg" class="news_color_field" data-default-color="#00a351" />
<?php
}


// Callback function -- FONT color 
function hr_news_ticker_font_color(){
 $fontColor = esc_attr( get_option('ticker_font_cl'));
?>
<input type="text" value="<?php echo $fontColor; ?>" name="ticker_font_cl" class="news_color_field" data-default-color="#fff" />
<?php

}

// Callback function -- Fields  Section
function hr_news_ticker_general_options(){


}

// Just Test Function
function check(){
if((esc_attr(get_option('show_status'))) != 1){
    
    require plugin_dir_path( __FILE__ ).'public/frontend_news_ticker.php';
 }
}

add_action('wp_footer','check');



register_activation_hook( __FILE__, 'hr_news_ticker_install' );