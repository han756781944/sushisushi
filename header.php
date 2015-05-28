<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/fancybox/css/jquery.fancybox-1.3.4.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery.lightbox-0.5.css"/>

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<style type="text/css">
body > div { position: relative; } .vegas-loading { width: 100px; height: 100px; background: url(<?php bloginfo('template_url'); ?>/images/loader.gif) left bottom no-repeat; position: absolute; top: 20px; left: 20px; z-index: 131313}
</style>
<?php wp_head();?>
</head>

<body>
<div id="bg_wrap">
  <header>
    <div id="header_wrapper">
      <!--p style="float:right;">123456</p-->
      
      <nav id="top_nav">
        <div class="top_logo"><img src="<?php bloginfo('template_url'); ?>/images/top_logo.png" width="50" height="46" /></div>
        <?php if ( function_exists( 'wp_nav_menu' ) ) {?>
        <?php wp_nav_menu( array(
              'theme_location' => 'primary',
              'container' => '', 
              'menu_id'      => 'maiannav',
              'menu_class'      => 'navigation'
              )); ?>
        <?php }?>
        <div class="log">
        <?php if(is_user_logged_in()){?>
        <a href="<?php echo get_page_link(7);?>">Account</a> | <a href="<?php echo get_page_link(5);?>">Cart</a> | <a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
        <?php }else{?>
		<a href="<?php echo get_page_link(29);?>">LOGIN</a>	
		<?php }?>
        </div>
        <div class="clear"></div>
      </nav>
      <section id="top_new">
        <h2 class="left" style="padding:3px;"><a href="#">What's New</a></h2>
                <ul id="marquee1" class="marquee">
                  <?php 
				  $args = array(
					  'numberposts'     => 5,
					  'post_type'       => 'post');
				  $posts_array = get_posts( $args );
				  foreach($posts_array as $n => $post):setup_postdata($post); 
				  ?>
                  <li><a href="<?php the_permalink();?>" title="<?php the_title();?>" target="_blank"> <?php echo $n+1;?>. <?php the_title();?></a></li>
                  <?php endforeach;?>
                </ul>
                      </section><!-- top_new-->
    </div><!-- #header_wrapper-->
  </header>