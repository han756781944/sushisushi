<?php get_header();?>	
  
  <div id="wrapper">
    
    <?php get_sidebar();?>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );?>
    <div id="content-right">
    <div id="oshirase">
      <ol class="breadcrumbs"><li class="home"><a href="<?php bloginfo('home'); ?>">Home</a></li><li class="selected"><a href="<?php echo get_page_link(4);?>">Menu</a></li><li class="selected"><?php the_title();?></li></ol>   
      
      
      <?php 
	  $xs_post_fat = get_post_meta($post->ID, 'xs_post_fat', true);
	  $xs_post_saturates = get_post_meta($post->ID, 'xs_post_saturates', true);
	  $xs_post_sugars = get_post_meta($post->ID, 'xs_post_sugars', true);
	  $xs_post_sodium = get_post_meta($post->ID, 'xs_post_sodium', true);
	  $xs_post_energy = get_post_meta($post->ID, 'xs_post_energy', true);
	  ?>
	  <div id="product-detail">			
        <div class="products">
          
          
          <div id="product-main-image">
          <img src="<?php echo $image[0];?>" alt="<?php the_title();?>"  />
          </div>
          
          <div class="product-detail-block-right">
           <h1><?php the_title();?></h1>
           <div class="product-content"><?php the_content();?></div>
           
           <p class="nutritional-paragraph"><a href="#product-specs-fancybox" id="various1" class="fancybox-trigger">View Nutritional Information</a></p>
           <div class="product-specifications">
           <div id="product-specs-fancybox">
           <h1>Seafood Salad Pack</h1>
           <p class="specs_info">Actual serving sizes and nutrient values may differ due to factors<br />
  such as seasonal variation of ingredients and raw materials.</p>
           <ul class="nutritional-information">
              <li class="orange">
                <h4>fat</h4>
                <h5><?php echo $xs_post_fat;?>g</h5>
              </li>
              <li class="orange">
                <h4>saturates</h4>
                <h5><?php echo $xs_post_saturates;?>g</h5>
              </li>
              <li class="red">
                <h4>sugars</h4>
                <h5><?php echo $xs_post_sugars;?>g</h5>
              </li>
              <li class="green">
                <h4>sodium</h4>
                <h5><?php echo $xs_post_sodium;?>mg</h5>
              </li>
              <li class="grey">
                <h4>energy</h4>
                <h5><?php echo $xs_post_energy;?>KJ</h5>
              </li>
            </ul>
           <p>&nbsp;</p></div></div><em>* Check your local store for availability</em>
           
           <div>
           <?php echo do_shortcode('[add_to_cart id='.$post->ID.']');?>
           </div>
           </div>
           
        </div>
      </div>
      
	  <div class="clear"></div> 
    </div>
    </div>
    <?php endwhile; ?>
    <?php endif;wp_reset_query();?>
    
  </div><!-- wrapper-->
<?php get_footer();?>