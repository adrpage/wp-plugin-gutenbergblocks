<?php
namespace Site\src\Sliderblock;

class Sliderblock{
    function __construct(){
        $this->plugin_path =  ABSPATH . 'wp-content/plugins/plug-in-play/';
        add_action( 'init', array(__CLASS__,'gutenberg_custom_slider_block'));
    }

    public function init_slider_block(){
        add_action( 'init', array(__CLASS__,'gutenberg_custom_slider_block'));
    }

    public function gutenberg_custom_slider_block() {
        if ( ! function_exists( 'register_block_type' ) ) {
            return;
        }
        wp_register_script(
            'custom-slider-block',
            plugins_url().'/plug-in-play/js/slider-block/block-slider.js',
            array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore' ),
            filemtime( ABSPATH . 'wp-content/plugins/plug-in-play/' . 'js/slider-block/block-slider.js' )
        );
        wp_register_style(
            'custom-slider-block',
            plugins_url().'/plug-in-play/css/style.css',
            array( ),
            filemtime( ABSPATH . 'wp-content/plugins/plug-in-play/' . 'css/style.css' )
        );
        register_block_type( 'gutenberg-examples/custom-slider-block', array(
            'style' => 'custom-slider-block',
            'editor_script' => 'custom-slider-block',
            'render_callback' => array(__CLASS__,'gutenberg_examples_dynamic_render_callback')
        ) );
      if ( function_exists( 'wp_set_script_translations' ) ) {
        wp_set_script_translations( 'custom-slider-block', 'gutenberg-examples' );
      }
    
    }

    function gutenberg_examples_dynamic_render_callback($block_attributes, $content){
        $html = '';
        $html .= "<div class='mjd-custom-block' style='display:none'>".$content."</div>";
        $html .= '<div class="swiper mjd-swiper">';
            $html .= '<div class="mjd-layer"><h1 id="mjd-swiper-term">Active Term : <span></span></h1></div>';
            $html .= '<div class="swiper-wrapper">';
    
            $html .= '</div>';
            $html .= '<div class="swiper-button-next"></div>';
            $html .= '<div class="swiper-button-prev"></div>';
            $html .= '<div class="swiper-pagination"></div>';
        $html .= '</div>';
        return $html;
    }
}
?>