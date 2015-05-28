<section id="sidebar">
      <h1><a href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?>"><img class="hover1" src="<?php bloginfo('template_url'); ?>/images/logo.png" width="200" height="200" alt="<?php bloginfo('name'); ?>"/></a></h1>
      
  
      <aside id="menubox">
      <?php
     $terms = get_terms("product_cat");
	 if ( !empty( $terms ) && !is_wp_error( $terms ) ){?>
		 <ul class="product_cat">
         <?php 
		 foreach ( $terms as $term ) {?>
		   <li><a href="<?php echo get_term_link( intval($term->term_id), 'product_cat'); ?>"><?php echo $term->name;?></a></li>
		 <?php }?>
         </ul>
	 <?php }?>
      </aside>
      
    </section>
    <!-- #sidebar-->