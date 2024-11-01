<?php 


//////////////////////////////////////////////////////////////////////////////
///////////////////////// FRONT END OF PLUGIN ////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

/* Author : Hamza */

if ( ! defined( 'ABSPATH' ) ) exit;

$newticker_bg = esc_attr( get_option('ticker_bg'));
$newticker_font_cl = esc_attr( get_option('ticker_font_cl'));
?>


<div class="news_ticker_wrap" style="background:<?php echo $newticker_bg;?>; color:<?php echo $newticker_font_cl;?>">

	<div class="container_hr_news">
		
		<div class="ticker_timer">
			<span class="newsh1">LATEST NEWS </span>
		</div>

		<div class="ticker_news">
		<?php //var_dump(hr_news_fetchposts());
		//var_dump(hr_news_fetch_categories());
			 $posts = hr_news_fetchposts();
			 	?>
			 	<marquee  onmouseover="this.stop();" onmouseout="this.start();">
			 	<?php
				foreach($posts as $post){

					?>
					
					<a href="<?php echo $post->guid;?>"><span class="news_post_title"><?php echo $post->post_title;?></span></a>
					<?php
				}
			?>
			</marquee>
		</div>
	</div>

</div>

<?php

function hr_news_fetchposts(){
	$list = hr_news_fetch_categories();

$args = array(
	'posts_per_page'   => 10,
	'offset'           => 0,
	'category'         => $list,
	'category_name'    => '',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   => '',
	'author_name'	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true 
);
 
  return $latest_posts = get_posts( $args );

}

function hr_news_fetch_categories(){

	 $category_list = get_option('cat_list');
	 foreach($category_list as $category){
	 	 $list .= $category.',';
	 }
	 return $list;
}

