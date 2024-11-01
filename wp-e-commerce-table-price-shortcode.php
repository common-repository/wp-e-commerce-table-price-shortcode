<?php

/**
  * Plugin Name: WP e-Commerce Table Price Shortcode
  * Plugin URI: http://mywebsiteadvisor.com/tools/wordpress-plugins/wp-e-commerce-table-price-shortcode/
  * Description: Displays Table Prices for a WP E-Commerce Store Item using Table Rate Pricing
  * Version:  1.0.2
  * Author: MyWebsiteAdvisor
  * Author URI: http://MyWebsiteAdvisor.com/
  **/
  
  
 // [wpsc_table_price id="123"]
  
class WP_E_Commerce_Table_Price_Shortcode{  

	private $plugin_name = "";
  
  
	public function __construct(){
	
		$this->plugin_name = basename(dirname( __FILE__ ));
		
		// add links for plugin help, donations,...
		add_filter('plugin_row_meta', array(&$this, 'add_plugin_links'), 10, 2);
		
		//create shortocde
		  // [wpsc_table_price id="123"]
		add_shortcode( 'wpsc_table_price', array($this, 'wp_ec_table_price_shortcode') );
	
	}
  
  
	/**
	 * Add links on installed plugin list
	 */
	public function add_plugin_links($links, $file) {
		if($file == plugin_basename( __FILE__ )) {
			$upgrade_url = 'http://mywebsiteadvisor.com/tools/wordpress-plugins/' . $this->plugin_name . '/';
			$links[] = '<a href="'.$upgrade_url.'" target="_blank" title="Click Here to Upgrade this Plugin!">Upgrade Plugin</a>';
			
			$install_url = admin_url()."plugins.php?page=MyWebsiteAdvisor";
			$links[] = '<a href="'.$install_url.'" target="_blank" title="Click Here to Install More Free Plugins!">More Plugins</a>';
			
			$rate_url = 'http://wordpress.org/support/view/plugin-reviews/' . $this->plugin_name . '?rate=5#postform';
			$links[] = '<a href="'.$rate_url.'" target="_blank" title="Click Here to Rate and Review this Plugin on WordPress.org">Rate This Plugin</a>';
		}
		
		return $links;
	}
	
	
  
	   // [wpsc_table_price id="123"]
	function wp_ec_table_price_shortcode( $atts ) {
		 
		extract( shortcode_atts( array(
			'id' =>  $current_id,	
		), $atts ) );
	
	
		$product_meta = get_post_meta($id, '_wpsc_product_metadata', true);
		$table_rate_price = $product_meta['table_rate_price'];
	
		$html = "<ul>";
		foreach($table_rate_price['quantity'] as $key => $qty){
			$html .= "<li>". $qty."+ Items : " . $table_rate_price['table_price'][$key]. " each</li>";	
		}
		$html .= "</ul>";
		
		return $html;
		
	}


}

$wp_e_commerce_table_price_shortcode = new WP_E_Commerce_Table_Price_Shortcode;


  
  
  
  
  
  
  
  ?>