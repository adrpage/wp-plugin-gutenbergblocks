<?php
namespace Site\src\Loadmoreblock;

class Loadmoreblock{
    public $plugin_path;
    function __construct(){
        $this->plugin_path =  ABSPATH . 'wp-content/plugins/plug-in-play/';
        add_action( 'init', array(__CLASS__,'gutenberg_custom_post_load_block'));
        add_action("wp_ajax_load_my_posts_mjd",array(__CLASS__,"load_my_posts_mjd"));
        add_action("wp_ajax_nopriv_load_my_posts_mjd",array(__CLASS__,"load_my_posts_mjd"));
    }

    public function init_load_more_block(){
        add_action( 'init', array(__CLASS__,'gutenberg_custom_post_load_block'));
        add_action("wp_ajax_load_my_posts_mjd",array(__CLASS__,"load_my_posts_mjd"));
        add_action("wp_ajax_nopriv_load_my_posts_mjd",array(__CLASS__,"load_my_posts_mjd"));
    }

    public function gutenberg_custom_post_load_block() {
        if ( ! function_exists( 'register_block_type' ) ) {
            return;
        }
        wp_register_script(
            'custom-load-more-block',
            plugins_url().'/plug-in-play/js/loadMore-block/block-load_more.js',
            array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore' ),
            filemtime(ABSPATH . 'wp-content/plugins/plug-in-play/js/loadMore-block/block-load_more.js' )
        );
        wp_register_style(
            'custom-load-more-block',
            plugins_url().'/plug-in-play/css/style.css',
            array( ),
            filemtime( ABSPATH . 'wp-content/plugins/plug-in-play/css/style.css' )
        );
        register_block_type( 'gutenberg-examples/custom-load-more-block', array(
            'style' => 'custom-load-more-block',
            'editor_script' => 'custom-load-more-block',
            'render_callback' => array(__CLASS__,'gutenberg_load_more_callback')
        ) );
      if ( function_exists( 'wp_set_script_translations' ) ) {
        wp_set_script_translations( 'custom-load-more-block', 'gutenberg-examples' );
      }
    }

    public function gutenberg_load_more_callback($block_attributes, $content){
        $html ="<div class='load-posts-mjd' style='display:none;'>".$content."</div>
        <div class='mjd-loaded-posts'></div><div class='load-more-button'><button class='load-more-posts-mjd' data-last-post='0' type='button' data-load=''>Load more</button></div>";
        return $html;
    }
    public function load_my_posts_mjd(){
        global  $wpdb;
        $number_of_posts = $_POST["load_posts"];
        $last_post_id = $_POST["last_post"];
        $data = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}posts WHERE post_status = 'publish' AND post_type = 'post' AND ID > %s LIMIT ".$number_of_posts,$last_post_id));
    
        $html = "";
        $last_id = 0;
        foreach($data as $k=>$v){
            $html .= "<div class='post-separator'></div>";
            $html .= "<h3 class='post-title'>".$v->post_title."</h3>";
            $html .= "<p class='post-content'>".$v->post_content."</p>";
            $last_id = $v->ID;
        }
        $arr = array("last_post_id"=>$last_id,"html"=>$html);
        echo json_encode($arr);
        //echo "<pre>";print_r($data);
        exit;
    }
}
?>