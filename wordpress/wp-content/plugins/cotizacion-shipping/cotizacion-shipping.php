<?php
 
if ( ! defined( 'WPINC' ) ) {
 
    die;
 
}
 
/*
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
    function my_shipping_method() {
        if ( ! class_exists( 'My_Shipping_Method' ) ) {
            class My_Shipping_Method extends WC_Shipping_Method {
               
                public function __construct() {
                    $this->id                 = “my”; 
                    $this->method_title       = __( 'My Shipping', 'my' );  
                    $this->method_description = __( 'Custom Shipping Method for My Shipping', 'my' ); 
 
                    $this->init();
 
                    $this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
                    $this->title = isset( $this->settings['title'] ) ? $this->settings['title'] : __( 'My Shipping', 'my' );
                }
 
  
              function init() {
                    // Load the settings API
                    $this->init_form_fields(); 
                    $this->init_settings(); 
 
                    // Save settings in admin if you have any defined
                    add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
                }
 
           
                function init_form_fields() { 
 
                    // We will add our settings here
 
                }
 
                /**
                 * This function is used to calculate the shipping cost. Within this function we can check for weights, dimensions and other parameters.   */
              
             
                public function calculate_shipping( $package ) {
                    
                    // We will add the cost, rate and logics in here
                    
                }
            }
        }
    }
 
    add_action( 'woocommerce_shipping_init', 'my_shipping_method' );
 
    function add_my_shipping_method( $methods ) {
        $methods[] = 'My_Shipping_Method';
        return $methods;
    }
 
    add_filter( 'woocommerce_shipping_methods', 'add_my_shipping_method' );
}
