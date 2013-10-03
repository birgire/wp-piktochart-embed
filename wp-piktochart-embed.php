<?php
/**
 * Plugin Name: WP Piktochart Embed
 * Author: birgire
 * Author URI: https://github.com/birgire/
 * Version: 1.0
 * Text Domain: wp-piktochart-embed
 * Description: This plugin adds the [piktochart] shortcode for Multi-Site WordPress that displays a PiktoChart iframe embedding code.
 * License: GPL2
 */

/**
 * No direct access
 */
defined( 'ABSPATH' ) or die( 'Nothing here!' );

/**
 * Init the Piktochart class
 */
if( ! class_exists( 'WP_Piktochart_Embed' ) ):

	add_action( 'plugins_loaded', array( 'WP_Piktochart_Embed', 'get_object' ) );

 
	/**
	* Piktochart Class
	* 
	* @author birgire
	*
	*/
	class WP_Piktochart_Embed {
		
		private $plugin_domain 		= 'wp_piktochart_embed';
		static private $obj 		= NULL;
	
		/**
		 * The constructor
		 * 
		 * @access  public
		 * @since   1.0
		 * @uses    add_filter, add_action
		 * @return  void		
 		 */

		public function __construct() {
		
			// register the shortcode
			add_shortcode( 'piktochart', array( $this, 'piktochart_callback' ) );
											
		}	
	
		
		/**
		 * Instantiate the class.
		 * 
		 * @access  public
		 * @since   1.0
		 * @return  object $obj
		 */

		 public function get_object () {
			
			if ( NULL === self :: $obj ) {
				self :: $obj = new self;
			}
			
			return self :: $obj;
		}

		
		/**
		 * Piktochart shortcode callback 
		 *
		 * @access  public
		 * @since   1.0
		 * @param array $atts
		 * @param string $content
		 * @return string $html
		 */

		 public function piktochart_callback( $atts, $content ) {
	
			$atts = shortcode_atts( array(
						'uid' 		=> '',
						'width' 	=> '600',
						'height' 	=> '400',
						'style'		=> 'overflow-y:hidden;',
					), $atts, $this->plugin_domain );
		
			// Generate the output
			$iframe = '<iframe class="piktochart" width="%s" height="%s" frameborder="0" style="%s" src="https://magic.piktochart.com/embed/%s"></iframe>';

			$html = '';
			$html = sprintf( $iframe,
						esc_attr( $atts['width'] 	),
						esc_attr( $atts['height'] 	),
						esc_attr( $atts['style'] 	),
						esc_attr( $atts['uid'] 		) 
					);
			return $html;		
		}
		
	} // end class
	
endif; // end if class exists
