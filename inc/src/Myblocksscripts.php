<?php
namespace Site\src;
class Myblocksscripts{
    public function __construct(){
        add_action("wp_footer",array(__CLASS__,"my_scripts"));
    }
    public function init_script_actions(){
        add_action("wp_footer",array(__CLASS__,"my_scripts"));
    }

    public function my_scripts(){
        ?>
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
            <script>
                ajaxURL = "<?=admin_url("admin-ajax.php")?>";
                jQuery(document).ready(function(){
                    if(jQuery(".mjd-loaded-posts").length > 0){
                        jQuery(document).on("click",".load-more-posts-mjd",function(){
                            var numOfPosts = jQuery(".mjd-load-posts-number").text();
                            $this = jQuery(this);
                            var last_post = $this.attr("data-last-post");
                            jQuery.ajax({
                                 url : ajaxURL,
                                 type: "post",
                                 data : {"action":"load_my_posts_mjd","load_posts":numOfPosts,"last_post":last_post},
                                 success:function(res){
                                     res= JSON.parse(res);
                                     if(res.last_post_id > 0){
                                        $this.attr("data-last-post",res.last_post_id);
                                        jQuery(".mjd-loaded-posts").append(res.html);
                                     }else{
                                         jQuery(".load-more-button").html("<p class='no-more-posts'>No more posts to load</p>")
                                     }
                                    
                                 }
                            })
                        })
                    }

                    if(jQuery(".mjd-custom-block").length > 0){
                        var genre = jQuery(".mjd-custom-block").find(".terms").text();
                        var imgs = jQuery(".mjd-custom-block").find(".images").text();
                        var html = '';
                        imgs = parseInt(imgs);
                        let x;
                        var resultt=[];
                        var url = 'https://api.unsplash.com/search/photos?client_id=xzsZVR_-5xuWV-sClx1d0-GjjxfWRxyxwW7Knj5GJa0&query='+genre+'&count'+imgs+'1&orientation=landscape'; 
                        fetch(url).then(response=>{
                            response.json().then((data) => {
                                resultt=data;
                                for(x=0;x<imgs;x++){
                                    var rnd =  Math.floor(Math.random() * 10);
                                    var img_url = resultt.results[rnd].urls.regular;
                                    if(jQuery(".swiper-wrapper .swiper-slide").length != imgs){
                                        jQuery(".swiper-wrapper").append('<div class="swiper-slide"><img src="'+img_url+'"> </div>');
                                    }
                                }
                                jQuery("#mjd-swiper-term span").text(genre);
                                jQuery(".swiper-wrapper").append(html);
                            });
                        });
                    }
                    setTimeout(function(){
                        init_swiper();
                    },2000);
                });
                function randomInteger(min,max) {
                    return Math.floor(Math.random() * (max - min + 1)) + min;
                }
                function init_swiper(){
                    var swiper = new Swiper(".mjd-swiper", {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        loop: true,
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                        },
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                    });
                }
            </script>
        <?php
    }
}
?>