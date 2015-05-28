<?php

//register nav menus
register_nav_menus( 
  array(
		'primary'=>'主菜单',
		'foot-nav' =>'底部导航',
));

show_admin_bar(false);
//register post thumbnails
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

include("meta-box.php");
//////////////////////分页函数///////////////////////////////////
if ( !function_exists('pagenavi') ) {
	function pagenavi( $p = 10 ) { // 取当前页前后各 2 页，根据需要改
		if ( is_singular() ) return; // 文章与插页不用
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return; // 只有一页不用
		if ( empty( $paged ) ) $paged = 1;
		echo '<span class="pages">页数:' . $paged . '/' . $max_page . '</span>'; // 显示页数
		if ( $paged > $p + 1 ) p_link( 1, '最前页' );
		if ( $paged > $p + 2 ) echo '... ';
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // 中间页
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo '<span class="dot">...</span>';
		if ( $paged < $max_page - $p ) p_link( $max_page, '最后页' );
	}
	function p_link( $i, $title = '' ) {
		if ( $title == '' ) $title = "第 {$i} 页";
		echo "<a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";
	}
}

//////////////////////////////位置//////////////////////////////
function breadcrumbs() {

  $currentBefore = '<li class="selected">';
  $currentAfter = '</li>';
  wp_reset_query();

  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '<ol class="breadcrumbs">';

    global $post;
    $home = home_url();
    echo '<li class="home"><a href="' . $home . '">' . __('Home','pearlie') . '</a></li>';

    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) {
	  echo $currentBefore;
	  echo get_category_parents($parentCat, TRUE, '');
	  echo   $currentAfter;
	  }
      echo $currentBefore;
      single_cat_title();
      echo   $currentAfter;

    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
      echo $currentBefore . get_the_time('d') . $currentAfter;

    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo $currentBefore . get_the_time('F') . $currentAfter;

    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;

    } elseif ( is_single() && !is_attachment() ) {
      $cat = get_the_category(); $cat = $cat[0];
	  echo $currentBefore;
      echo get_category_parents($cat, TRUE, '');
	  echo $currentAfter;
	  
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, '');
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb ;
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_search() ) {
      echo $currentBefore . __('关于 &#39;','pearlie') . get_search_query() . '&#39;的搜索结果：' . $currentAfter;

    } elseif ( is_tag() ) {
      echo $currentBefore;
      single_tag_title();
      echo $currentAfter;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . __('Articles posted by ','pearlie') . $userdata->display_name . $currentAfter;

    } elseif ( is_404() ) {
      echo $currentBefore . __('Error 404','pearlie') . $currentAfter;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</ol>';

  }
}
function auto_login_new_user( $user_id ) {

	// 用户注册后自动登录

	wp_set_current_user($user_id);

	wp_set_auth_cookie($user_id);

	// 这里跳转到 http://域名/about 页面，请根据自己的需要修改

	wp_redirect( home_url()); 

	exit;

}

add_action( 'user_register', 'auto_login_new_user');
?>