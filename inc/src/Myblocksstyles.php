<?php
namespace Site\src;
class Myblocksstyles{
    function __construct(){
        add_action("wp_head",array(__CLASS__,"my_styles"));
    }

    function init_style_actions(){
        add_action("wp_head",array(__CLASS__,"my_styles"));
    }

    public function my_styles(){
        ?>
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <style>
            .swiper-slide img {
                height: 600px;
                width: 100%;
            }
            .mjd-swiper{
                position: relative;
            }
            .mjd-layer{
                position: absolute;
                width: 100%;
                height: 100%;
                background: #00000073;
                z-index: 9999999;
            }
            .swiper-button-next, .swiper-rtl .swiper-button-prev,.swiper-button-prev, .swiper-rtl .swiper-button-next{
                z-index:99999999;
                color:#FFF;
            }
            .swiper-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet, .swiper-pagination-horizontal.swiper-pagination-bullets .swiper-pagination-bullet{
                background-color:#FFF;
            }
            .swiper-horizontal>.swiper-pagination-bullets, .swiper-pagination-bullets.swiper-pagination-horizontal, .swiper-pagination-custom, .swiper-pagination-fraction{
                z-index:99999999;
            }
            #mjd-swiper-term{
                color: #FFF;
                margin: 6%;
                display: inline-block;
                font-family: system-ui;
            }
            .post-separator{
                height:3px;
                width:100%;
                background-color:#000;
            }
            .post-title{
                font-size:30px;
                margin: 0;
                text-align: center;
                padding: 30px 0px 0px;
            }
            .post-content{
                font-size:14px;
            }
            .load-more-button{
                text-align:center;
            }
            button.load-more-posts-mjd {
                padding: 15px 30px;
                margin: 10px 0;
                background-color: #1a672e;
                color: #FFF;
                border: 0;
                font-size: 16px;
                font-weight: 400;
            }
            p.no-more-posts{
                font-size: 18px;
                font-weight: 600;
            }
        </style>
        <?php
    }
}
?>