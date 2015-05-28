<?php 
/*
	template name: Register
	description: template for best theme 
*/

if( !empty($_POST['wp-submit']) ) {   
  $error = '';   
  $sanitized_user_login = sanitize_user( $_POST['user_login'] );   
  $user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );   
  
  // Check the username   
  if ( $sanitized_user_login == '' ) {   
    $error .= '<strong>Error</strong>：Please enter a user name.<br />';
  } elseif ( ! validate_username( $sanitized_user_login ) ) {   
    $error .= '<strong>Error</strong>：This user name contains invalid characters, please enter a valid user name<br />.'; 
    $sanitized_user_login = '';   
  } elseif ( username_exists( $sanitized_user_login ) ) {   
     $error .= '<strong>Error</strong>：The user name has been registered, please choose one.<br />'; 
  }   
  // Check the e-mail address   
  if ( $user_email == '' ) {   
    $error .= '<strong>Error</strong>：Please fill in email address.<br />';
  } elseif ( ! is_email( $user_email ) ) {   
    $error .= '<strong>Error</strong>：Email address is incorrect.!<br />';
    $user_email = '';   
  } elseif ( email_exists( $user_email ) ) {   
    $error .= '<strong>Error</strong>：The email address has been registered, please change one.<br />';  
  }   
      
  // Check the password   
  if(strlen($_POST['user_pass']) < 6)   
    $error .= '<strong>Error</strong>：Password length of at least 6!<br />';
  elseif($_POST['user_pass'] != $_POST['user_pass2'])   
    $error .= '<strong>Error</strong>：The password must be consistent with the two input!<br />';
        
    if($error == '') {   
    $user_id = wp_create_user( $sanitized_user_login, $_POST['user_pass'], $user_email ); 
	//update_usermeta( $user_id, 'telephone', $_POST['telephone'] );
      
   if ( ! $user_id ) {   
      $error .= sprintf( '<strong>Error</strong>：Could not complete your registration request... Please contact<a href=\"mailto:%s\">Admin</a>！<br />', get_option( 'admin_email' ) );  
    }   
    else if (!is_user_logged_in()) {   
      $user = get_userdatabylogin($sanitized_user_login);   
      $user_id = $user->ID;   
    
      // 自动登录   
      wp_set_current_user($user_id, $user_login);   
      wp_set_auth_cookie($user_id);   
      do_action('wp_login', $user_login);   
    }   
  }   
}
get_header();?>	
  <div id="wrapper">
    
    <?php get_sidebar();?>
    
    <div id="content-right">
    <div id="oshirase">
      <?php breadcrumbs();?>
      
     
	  <div id="product-detail">			
        <div class="products">
          <div class="page_content page_login">
            <div class="login_site_header"><a href="<?php bloginfo( 'home' ); ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a></div>	
            <div id="p-login-form-panel" class="forLogin_Only clearfix" >
                            
                            <?php if(!empty($error)) {
							 echo '<p class="ludou-error">'.$error.'</p>';
							}
							if (!is_user_logged_in()) { ?>
							<form name="registerform" id="registerform" action="<?php echo $_SERVER["REQUEST_URI"]; ?>"  class="ludou-reg form-signin form-signup" method="post">
        
        <div class="control">
        <label for="user_login">User name *<br />
          <input type="text" name="user_login" id="user_login" class="form-control" autocomplete="off" value="<?php if(!empty($sanitized_user_login)) echo $sanitized_user_login; ?>" size="20" tabindex="2" placeholder="username" required="required" />  
        </div>
        
        <div class="control">
        <label for="user_email">User Email *<br />
          <input type="text" name="user_email" id="user_email"  autocomplete="off" placeholder="email@mail.com" required="required" class="form-control" value="<?php if(!empty($user_email)) echo $user_email; ?>" size="25" tabindex="1" />   
        </div>
        
        <div class="control">
        <label for="user_pass">Password *<br />
          <input id="user_pass" placeholder="password" required="required" class="form-control" type="password" tabindex="3" size="25" value="" name="user_pass" />   
        </div>
        
        <div class="control">
        <label for="user_pass2">Re-Password *<br />
          <input id="user_pass2" placeholder="re-password" required="required" class="form-control" type="password" tabindex="4" size="25" value="" name="user_pass2" />   
        </div>
        
        <p>
        <input class="btn btn-lg btn-redirect btn-block" name="wp-submit" id="wp-submit" type="submit" value="Register" />
        </p>
    </form>
							<?php } else {
								// 注册成功后跳转到站内其他页面，URL自行修改
								wp_safe_redirect(get_bloginfo( 'url' ));
							} ?>
                            </div>
          </div>
        </div>
      </div>
	  <div class="clear"></div> 
    </div>
    </div>
    
    
  </div><!-- wrapper-->
<?php get_footer();?>