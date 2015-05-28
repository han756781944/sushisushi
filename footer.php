<footer id="footer">
	<div id="footer_wrapper">
		<section id="footer_link">
			<?php if ( function_exists( 'wp_nav_menu' ) ) {?>
			<?php wp_nav_menu( array(
                  'theme_location' => 'foot-nav',
                  'container' => '', 
                  'menu_id'      => 'foot-nav',
                  'menu_class'      => 'foot-navigation'
                  )); ?>
            <?php }?>
			<p class="copyright">Shop 251, Stockland Townsville 310 Ross River Road Aitkenvale, QLD 4814<br />
			<span class="lspace">phone:07 4775 1586 &nbsp;fax:07 4728 1624 &nbsp;abn:68 390 848 421</span><br />
			Copyright (C) Sushi Sushi All Rights Reserved.</p>
		</section>
	</div>
</footer>

</div><!--bg_wrap-->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/jquery.lightbox-0.5.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/jquery.marquee.js'></script>
<?php /*?><script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/rollover.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/footerFixed.js'></script><?php */?>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/scrolltopcontrol.js'></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/fancybox/js/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/fancybox/js/jquery.mousewheel-3.0.4.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#various1").fancybox({
			'titlePosition':'inside',
			'transitionIn':'none',
			'transitionOut':'none'
		});
});
</script>

<script type="text/javascript">
    $(function(){
        /* 例1 */
        $("#marquee1").marquee({
            loop: -1
            // 初期時
            , init: function ($marquee, options){
                if( $marquee.is("#marquee2") ) options.yScroll = "bottom";
            }
            // メッセージ切替表示前
            , beforeshow: function ($marquee, $li){
                var $author = $li.find(".author");
                if( $author.length ){
                    $("#marquee-author").html("<span style='display:none;'>" + $author.html() + "</span>").find("> span").fadeIn(2000);
                }
            }
            // メッセージ表示切替時（上から下にスライド表示された時）
            , show: function (){
            }
            // メッセージスクロール完了後（スライド表示されたメッセージが左方向へすべてスクロールされた時）
            , aftershow: function ($marquee, $li){
                // find the author
                var $author = $li.find(".author");
                // hide the author
                if( $author.length ) $("#marquee-author").find("> span").fadeOut(750);
            }
        });
        /* 例2 */
        $("#marquee2").marquee({yScroll: "bottom"});
    });
    var iNewMessageCount = 0;
    function addMessage(selector){
        iNewMessageCount++;
        var $ul = $(selector).append("<li>New message #" + iNewMessageCount + "</li>");
        // update the marquee
        $ul.marquee("update");
    }
    function pause(selector){
        $(selector).marquee('pause');
    }
    function resume(selector){
        $(selector).marquee('resume');
    }
  $(function() {
  $('.gallery a').lightBox({fixedNavigation:true});
  });
  
////$(document).ready(function() {
//    $("#content div").hide(); // Initially hide all content
//    $("#tabs li:first").attr("id","current"); // Activate first tab
//    $("#content div:first").fadeIn(); // Show first tab content
//
//    $('#tabs a').click(function(e) {
//        e.preventDefault();
//        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
//         return
//        }
//        else{
//        $("#content div").hide(); //Hide all content
//        $("#tabs li").attr("id",""); //Reset id's
//        $(this).parent().attr("id","current"); // Activate this
//        $('#' + $(this).attr('name')).fadeIn(); // Show content for current tab
//        }
//    });
//});
</script>


<script type='text/javascript'>
/* <![CDATA[ */
var jQueryVegasVars = {"ResizeImages":"1"};
/* ]]> */
</script>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/jquery.vegas.js'></script>
<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery.vegas('slideshow', {
	backgrounds:[
	  //{ src:'images/bg/001.jpg', fade:2000, delay:5000 , loading: false },
	  { src:'<?php bloginfo('template_url'); ?>/images/bg/1.jpg', fade:2000, delay:5000 , loading: false },
	  { src:'<?php bloginfo('template_url'); ?>/images/bg/2.jpg', fade:2000, delay:5000 , loading: false },
	  { src:'<?php bloginfo('template_url'); ?>/images/bg/3.jpg', fade:2000, delay:5000 , loading: false },
	  { src:'<?php bloginfo('template_url'); ?>/images/bg/4.jpg', fade:2000, delay:5000 , loading: false },
	  { src:'<?php bloginfo('template_url'); ?>/images/bg/5.jpg', fade:2000, delay:5000 , loading: false }
	]
  })
  ('overlay', {
	src:'<?php bloginfo('template_url'); ?>/images/overlay-05.png'
  })
;
});
function preloadImg(imagesPath) {
  preloadImg = new Image();
  preloadImg.src = imagesPath;
}
</script>
<?php wp_footer();?>
</body>
</html>