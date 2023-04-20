<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

// Drop a custom db table
global $wpdb;
$sliderTapa   = $wpdb->prefix . 'sliderTapa';
$wpdb->query( "DROP TABLE IF EXISTS {$sliderTapa}" );

$wpdb->delete($wpdb->posts, array('post_title' => 'tapa de diarios','post_type'=>'page'));


