<?php
/*
Plugin Name: Tapas de Diarios
Plugin URI:  https://github.com/jafr0691
Description: Slider de Tapas de Diarios para theme01-V3
Version:     4.0.1
Author:      Jesus Farias
Author URI:  https://github.com/jafr0691
Domain Path: /languages/
Text Domain: SliderPage
 */

defined('ABSPATH') or die('No script please!');

global $wpdb;
define('TPD_01_V3_Docslider', plugin_dir_path(__FILE__));
define('ARCslider', plugin_dir_url(__FILE__));
define('postTitle', 'TAPAS DE DIARIOS');
define('TPD_01_V3_AUTHOR', 'Streaming - Sericios Informáticos');

require_once  TPD_01_V3_Docslider.'plugin-update-checker/plugin-update-checker.php';

$myUpdateChecker = Puc_v4_Factory :: buildUpdateChecker (
	 'https://ingresarRepositorio/repository/plugins/tapas-diarios/details.json' ,
	__FILE__,'tapas-diarios' 
);

// definir la devolución de llamada get_header
function action_get_header () {
    function url_existe($url){
   $handle = @fopen($url, "r");
   if ($handle == false)
          return false;
   fclose($handle);
   return true;
}
function CargarTapasDeDiariosMTI(){
    global $wpdb;
    // $linkp = $wpdb->get_row("SELECT ID FROM " . $wpdb->posts . " where post_title='{postTitle}' AND post_type='page'");
    // $enlac = post_permalink($linkp->ID);
    // if(strpos($enlac, '?') !== false){
    //     $enlace = $enlac.'&t=';
    // }else{
    //     $enlace = $enlac.'?t=';
    // }
    $listslider = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "sliderTapa");
    $urls = [];
    foreach ($listslider as $sliderdb) {
        if (url_existe($sliderdb->enlaceimg)){
            $urls[] = array(
                'title' => $sliderdb->title,
                'url' => $sliderdb->enlaceimg,
                'href'=> 'tapas-de-diarios/?t='.$sliderdb->url
            );
         }
    }
    return $urls;
}


if (count(CargarTapasDeDiariosMTI()) > 0) {
    
    { ?>
<style type="text/css" media="screen">
@media (max-width: 600px) {#celular {margin: 83px auto 80px !important;-webkit-transform: scale(2.98) !important;padding: 1px 0px 1px 0px !important;left: 1px;}#celular-hidden {position: relative;z-index: 0;overflow: hidden;margin-bottom: -25px;}}
</style>

<?php }
    
    echo '<script>var node = document.createElement("div");
  node.insertAdjacentHTML("beforeend", `<div id="celular-hidden">
    <div id="celular">
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1170px;height:250px;overflow:hidden;visibility:hidden;border-radius: 5px;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1170px;height:250px;overflow:hidden;">';
            	$tilesite = get_bloginfo();
                $tapas = CargarTapasDeDiariosMTI();
                $FECHA      = date("Y/m/d-H:00");
                $Author = TPD_01_V3_AUTHOR;
                foreach ($tapas as $key => $tapa){
                    echo '<div><a href="'.$tapa["href"].'"><img data-u="image" width="160" height="197" alt="'.$Author.' | '.$tilesite.' - '.$tapa["title"].'" title="'.$tapa["title"].'" src="'.$tapa["url"].'?'.$FECHA.'"></a></div>';
                }

        echo '</div>
        <span data-u="arrowleft" class="jssora03l" style="top:0px;left:8px;width:55px;height:75px;" data-autocenter="2">&laquo;</span>
        <span data-u="arrowright" class="jssora03r" style="top:0px;right:-10px;width:55px;height:75px;" data-autocenter="2">&raquo;</span>
    </div>
 </div></div>`);
  document.getElementsByTagName("header")[0].appendChild(node);
</script>';
}
};

// agrega la acción
add_action ( 'wp_footer' , 'action_get_header');



function sliderpage_js()
{
    wp_enqueue_style('sliderpageCss', plugins_url('/css/sliderpage.css', __FILE__));
    wp_enqueue_script('jssor.slider-22.min_file', plugins_url('/js/jssor.slider-22.2.6.min.js', __FILE__));
    wp_register_script('script_sliderpage', plugin_dir_url(__FILE__) . 'js/sliderpageconf.js', array('jquery'), '2', true);
    wp_enqueue_script('script_sliderpage');
    wp_localize_script('script_sliderpage', 'sliderpage', ['sliderajaxurl' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'sliderpage_js');
add_action('wp_ajax_sliderpage', 'sliderpage');
add_action('wp_ajax_nopriv_sliderpage', 'sliderpage');


function sqlslider()
{
    require_once TPD_01_V3_Docslider . 'action/function.php';
    require_once TPD_01_V3_Docslider . 'action/sqlslider.php';
}
function control_jquery_slider_page()
{
    wp_enqueue_script('bootstrap.3.4.1.min_file', plugins_url('/js/bootstrap.3.4.1.min.js', __FILE__));
    wp_register_script('script_sql', plugin_dir_url(__FILE__) . 'js/sqlsliderp.js', array('jquery'), '2', true);
    wp_enqueue_script('script_sql');
    wp_localize_script('script_sql', 'sqlslider', ['sqlajaxpage' => admin_url('admin-ajax.php')]);
}
add_action('admin_enqueue_scripts', 'control_jquery_slider_page');
add_action('wp_ajax_sqlslider', 'sqlslider');
add_action('wp_ajax_nopriv_sqlslider', 'sqlslider');

    //Load template from specific page
add_filter( 'page_template', 'wpa3396_page_template' );
function wpa3396_page_template( $page_template ){

    if ( get_page_template_slug() == 'diarios.php' ) {
        $page_template = dirname( __FILE__ ) . '/diarios.php';
    }
    return $page_template;
}

add_filter( 'theme_page_templates', 'wpse_288589_add_template_to_select', 10, 4 );
function wpse_288589_add_template_to_select( $post_templates, $wp_theme, $post, $post_type ) {

    // Add custom template named template-custom.php to select dropdown
    $post_templates['diarios.php'] = __('tapas-de-diarios');

    return $post_templates;
}



    function db_slider_page(){

        global $wpdb;

        $query = $wpdb->prepare(
            'SELECT ID FROM ' . $wpdb->posts . '
                WHERE post_title = %s
                AND post_type = \'page\'',
            postTitle
        );
        $wpdb->query( $query );
        if ( $wpdb->num_rows ) {
            $wpdb->update($wpdb->posts,
            array('post_status'=> 'publish'),
            array('post_title' => postTitle,'post_type'=>'page'));
        } else {
        $new_page_id = wp_insert_post( array(
                'post_title'     => postTitle ,
                'post_type'      => 'page',
                'post_name'      => 'tapas de diarios',
                'post_status'    => 'publish',
                'post_author'    => 1,
                'menu_order'     => 6,
                'page_template'  => 'diarios.php'
            ) );
        $post_id = wp_insert_post($new_page_id);
    }
    require_once TPD_01_V3_Docslider . 'db_sliderPage.php';
}
register_activation_hook(__FILE__, 'db_slider_page');

function pluginprefix_deactivate() {
    // Unregister the post type, so the rules are no longer in memory.
    unregister_post_type( 'book' );
    // Clear the permalinks to remove our post type's rules from the database.
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivate' );

function panel_turnos()
{
    add_menu_page('Tapas de Diarios', 'Tapas de Diarios', 'manage_options', TPD_01_V3_Docslider . 'action/controlSliderPage.php');
}
add_action('admin_menu', 'panel_turnos');

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'tapas_action_links');
add_filter('network_admin_plugin_action_links_' . plugin_basename(__FILE__), 'tapas_action_links');

function tapas_action_links($links) {
    $links[] = '<a href="' . esc_url(get_admin_url(null, 'admin.php?page=tapas-diarios-theme01-V3/action/controlSliderPage.php')) . '">' . __('Settings') . '</a>';
    $links[] = '<a style="color:black">' . __('Support') . ':</a>';
    $links[] = '<br><center style="width:275px;color:white;background-color:#02a0d2;border-radius:0px 30px">info@evolucionstreaming.com</center>';
    return $links;
}

function slidel_page_deactivate() {
    global $wpdb;
    $wpdb->update($wpdb->posts,
        array('post_status'=> 'draft'),
        array('post_title' => postTitle,'post_type'=>'page'));
    // remove_filter ( 'wp_nav_menu_items' , 'slider_menu_item_tapa_diarios' , 10 , 2 );
}
// add_filter( 'wp_nav_menu_items', 'slider_menu_item_tapa_diarios', 10, 2 );
// function slider_menu_item_tapa_diarios( $items, $args ) {
//     $lin = $wpdb->get_row("SELECT ID FROM " . $wpdb->posts . " where post_title='{postTitle}' AND post_type='page'");
//     $items .= '<li><a href="' . get_permalink( $lin->ID ) . '">Tapa de Diarios</a></li>';
//     return $items;
// }
register_deactivation_hook( __FILE__, 'slidel_page_deactivate' );


function slider_page_uninstall(){
    require_once TPD_01_V3_Docslider . 'uninstall.php';
}
register_uninstall_hook( __FILE__, 'slider_page_uninstall' );