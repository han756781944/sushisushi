<?php 
/*
	template name: Login
	description: template for sushi theme 
*/
?>
<?php
if($_POST){ //数据提交     
    $username = $wpdb->escape($_REQUEST['username']);   
    $password = $wpdb->escape($_REQUEST['password']);   
    $remember = $wpdb->escape($_REQUEST['rememberme']);   
       
    if($remember){   
        $remember = "true";   
    } else {   
        $remember = "false";   
    }   
    $login_data = array();   
    $login_data['user_login'] = $username;   
    $login_data['user_password'] = $password;   
    $login_data['remember'] = $remember;   
    $user_verify = wp_signon( $login_data, false );    
    //wp_signon 是wordpress自带的函数，通过用户信息来授权用户(登陆)，可记住用户名   
           
    if ( is_wp_error($user_verify) ) {    
        echo "<span class='error'>用户名或密码错误，请重试!</span>";//不管啥错误都输出这个信息   
        exit();   
    } else { //登陆成功则跳转到首页(ajax提交所以需要用js来跳转)   
        echo "<script type='text/javascript'>window.location='". get_bloginfo('url') ."'</script>";   
        exit();   
    }   
}
else
{
	if (is_user_logged_in())
	{
	 echo "<script type='text/javascript'>window.location='". get_bloginfo('url') ."'</script>";   
        exit();   
      }	
} 
?> 
<?php get_header();?>	
  
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
            <form class="form-signin" role="form" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post" >
  
            <div class="control">
            <label for="user_login">User name *<br />
                <input autocomplete="off" class="form-control" name="username" id="username" placeholder="username"  required="required" value="">
                
            </div>
            <div class="control">
            <label for="user_pwd">Password *<br />
                <input class="form-control" id="password" name="password" placeholder="password" required="required" type="password" value="">               
            </div>
            <div class="control">
            <label class="checkbox">
              <input type="checkbox" name="rememberme" value="remember-me"> rememberme
            </label>
            </div>
            <p>
            <button class="btn btn-lg btn-redirect btn-block" type="submit">Login</button>
            </p>
          </form>
          <p>Don't have a account ? <a href="<?php echo get_page_link(32);?>">register</a></p>
          </div>
          </div>
        </div>
      </div>
	  <div class="clear"></div> 
    </div>
    </div>
    
    
  </div><!-- wrapper-->
<?php get_footer();?>