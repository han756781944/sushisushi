<?php get_header();?>	
  
  <div id="wrapper">
    
    <?php get_sidebar();?>

    <div id="content-right">
    <div id="oshirase">
      <ol class="breadcrumbs"><li class="home"><a href="<?php bloginfo('home'); ?>">Home</a></li><li class="selected"><a href="<?php echo get_page_link(4);?>">Menu</a></li><li class="selected">All</li></ol>  
					
      <div class="products">
        <h1><?php echo single_cat_title('', false );?> </h1>
        <em class="check-availability">* Check your local store for availability</em>
        
        <ul class="prodList">
          <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
          <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );?>
          <li><a href="<?php the_permalink();?>"><span class="product-shadow"><img src="<?php echo $image[0];?>" alt="<?php the_title();?>" width="160" height="112" />
          </span><div class="prod-short-description"><p><?php the_title();?></p></div></a>
          </li>
          <?php endwhile; ?>
          <?php endif;wp_reset_query();?>
        </ul>
      </div>
    </div>
    </div>
    
    
  </div><!-- wrapper-->
<?php get_footer();?>
</html>