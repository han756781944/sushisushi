<?php get_header();?>	
  
  <div id="wrapper">
    
    <?php get_sidebar();?>
    
    <div id="content-right">
    <div id="oshirase">
      <?php breadcrumbs();?>
      
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>

	  <div id="product-detail">			
        <div class="products">
           <h1><?php the_title();?></h1>
           <div class="product-content"><?php the_content();?></div>
        </div>
      </div>
      <?php endwhile; ?>
      <?php endif;wp_reset_query();?>
	  <div class="clear"></div> 
    </div>
    </div>
    
    
  </div><!-- wrapper-->
<?php get_footer();?>