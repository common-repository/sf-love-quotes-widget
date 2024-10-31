<?php
/*
Plugin Name: SF Love Quotes Widget
Plugin URI: http://www.topgamos.gr/
Description: Adds a Love Quotes widget that display famous Quotes about love and wedding with thumbnails.
Version: 1.4
Author: Bestseogr
Author URI: http://www.topgamos.gr/
License: GPL2
*/
	
	
class wp_lovequotes_plugin extends WP_Widget {

	// constructor
    function wp_lovequotes_plugin() {
        parent::__construct(false, $name = __('SF Love Quotes', 'wp_lq_plugin') );
                                  }		   
	// widget form creation
function form($instance) {
    // Check values
if( $instance) {
     
     $title = esc_attr($instance['title']);
	 $text42 = esc_attr($instance['text42']);
	 $checkbox22 = esc_attr($instance['checkbox22']);
	 $checkbox23 = esc_attr($instance['checkbox23']);
	 $dotext = esc_attr($instance['dotext']);
	  
} else {
     $title = '';
	 $text42 = '250';
	 $checkbox22 = '1';
	 $checkbox23 = '0';
	 $dotext = 0;
	
} ?>
<p><img src="<?php echo plugins_url( '/assets/sharethelove.png', __FILE__ ); ?>" align="center" width="100%" /></p>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_lq_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p><b>TEXT LOVE QUOTES:</b></p>
<p>Show Random Text Love Quotes on your Sidebar</p>
<p><i style="font-size: 10px;">* Check this option to use Text Love Quotes</i> <b><span style="font-size: 12px; color: red;">[BETTER for SEO]</span></b></p>
<p>
<input id="<?php echo $this->get_field_id('dotext'); ?>" name="<?php echo $this->get_field_name('dotext'); ?>" type="checkbox" value="1" <?php checked( '1', $dotext ); ?> />
<label  for="<?php echo $this->get_field_id('dotext'); ?>"><?php _e('Enable', 'wp_lq_plugin'); ?></label>
<p><i style="font-size: 10px;">* Will Override any Images Option</i></p>
</p>
<hr>
<p><b>IMAGES OPTIONS:</b></p>
<p>Several Images Options in case you are using the Images Presentation</p>
<p><i style="font-size: 10px;">* This is the max image width without .px</i></p>
<p>
<label for="<?php echo $this->get_field_id('text42'); ?>"><?php _e('Width:&nbsp;', 'wp_lq_plugin'); ?></label>
<input class="widefat" style="width:50px;" id="<?php echo $this->get_field_id('text42'); ?>" name="<?php echo $this->get_field_name('text42'); ?>" type="text" value="<?php echo $text42; ?>" />
</p>
<p>
<input id="<?php echo $this->get_field_id('checkbox23'); ?>" name="<?php echo $this->get_field_name('checkbox23'); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox23 ); ?> />
<label for="<?php echo $this->get_field_id('checkbox23'); ?>"><?php _e('Link to Full image?', 'wp_lq_plugin'); ?></label>
<p><i style="font-size: 10px;">* Use this if your Template supports LightBox</i></p>
</p>
<hr>
<p>
<input id="<?php echo $this->get_field_id('checkbox22'); ?>" name="<?php echo $this->get_field_name('checkbox22'); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox22 ); ?> />
<label for="<?php echo $this->get_field_id('checkbox22'); ?>"><?php _e('Show credit? ( Say YES! )', 'wp_lq_plugin'); ?></label>
</p>

<?php }
	// update widget
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
	  $instance['text42'] = strip_tags($new_instance['text42']);
	  $instance['dotext'] = strip_tags($new_instance['dotext']);
	  $instance['checkbox22'] = strip_tags($new_instance['checkbox22']);
	  $instance['checkbox23'] = strip_tags($new_instance['checkbox23']);
     return $instance;
}
	// display widget
function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $text42 = $instance['text42'];
   $checkbox22 = $instance['checkbox22'];
   $checkbox23 = $instance['checkbox23'];
   $dotext = $instance['dotext'];
  // wp_register_style('lovequotes', plugins_url('Sf-lovequotes/CSS/main.css'), false, '1.0', 'all');
  // wp_print_styles(array('lovequotes', 'lovequotes'));
   echo $before_widget;
   // Display the widget
?>
  <div>
<?php // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }
   
   if ( $dotext == 0 ) {   /// DO IMAGES WIDGET

    $f_contents = file("http://www.topgamos.gr/assets/lovequotes.txt"); 
    $line = $f_contents[rand(0, count($f_contents) - 1)];

if( $checkbox23 AND $checkbox23 == '1')
      { ?>
	<a href="<?php echo $line; ?>"><img rel="lightbox" style="width: 100%; height: auto; max-width: <?php echo $text42 ?>px; margin-left: auto; margin-right: auto;" src="<?php echo $line; ?>"></a>
<?php  } else { ?>
   <img rel="lightbox[TopGamos]" style="width: 100%; height: auto; max-width: <?php echo $text42 ?>px; margin-left: auto; margin-right: auto;" src="<?php echo $line; ?>">
<?php }

	}
		/// DO TEXT WIDGET
	else {
	
    $f_contents = file("http://www.topgamos.gr/assets/quotes.txt"); 
    $line = $f_contents[rand(0, count($f_contents) - 1)];
    ?>
    <ol style="padding: 5px; font-style: italic; font-size: 15px;">
	<img style="align: left; padding-right: 5px;" src="<?php echo plugins_url( '/assets/quotes.png', __FILE__ ); ?>"><?php echo $line; ?><img style="align: right; padding-left: 5px;" src="<?php echo plugins_url( '/assets/quotes-small.png', __FILE__ ); ?>">
	</ol>
	<?php
	
	}
 
   if( $checkbox22 AND $checkbox22 == '1')
      {
        echo '<p align="right" style="padding: 0px 5px 0 0; ">Powered by <a target="_blank" rel="nofollow" href="http://www.topgamos.gr">Top Gamos</a></p>';
      }
  echo '</div>';
   echo $after_widget; 
   }
}   
// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_lovequotes_plugin");'));

?>