<?php
add_action( 'admin_menu', 'xs_create_meta_box' );
add_action( 'save_post', 'xs_save_meta_data' );
function xs_create_meta_box() {
	add_meta_box( 'xs-post-meta-box1', '寿司成份', 'xs_post_meta_box1', 'product', 'normal', 'high' );
}

function xs_post_box1() {
	$meta_boxes = array(
	array(
    "name"             => "xs_post_fat",
    "title"            => "fat",
    "desc"             => "fat",
    "type"             => "text",
    "capability"       => "manage_options"
    ),
	
	array(
    "name"             => "xs_post_saturates",
    "title"            => "saturates",
    "desc"             => "saturates",
    "type"             => "text",
    "capability"       => "manage_options"
    ),
	
	array(
    "name"             => "xs_post_sugars",
    "title"            => "sugars",
    "desc"             => "sugars",
    "type"             => "text",
    "capability"       => "manage_options"
    ),
	
	array(
    "name"             => "xs_post_sodium",
    "title"            => "sodium",
    "desc"             => "sodium",
    "type"             => "text",
    "capability"       => "manage_options"
    ),
	
	array(
    "name"             => "xs_post_energy",
    "title"            => "energy",
    "desc"             => "energy",
    "type"             => "text",
    "capability"       => "manage_options"
    ),

	);
	return apply_filters( 'xs_post_boxes', $meta_boxes );
}

function xs_page_boxes() {
	$meta_boxes = array(
	);
	return apply_filters( 'xs_page_boxes', $meta_boxes );
}

function xs_post_meta_box1() {
	global $post;
	$meta_boxes = xs_post_box1(); 
?>
	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :
		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );
		if ( $meta['type'] == 'text' )
			xs_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			xs_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			xs_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'checkbox' )
			xs_meta_checkbox( $meta, $value );
		endforeach; ?>
	</table>
<?php
}
function xs_page_meta_boxes() {
	global $post;
	$meta_boxes = xs_page_boxes(); 
?>
	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :
		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );
		if ( $meta['type'] == 'text' )
			xs_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			xs_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			xs_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'checkbox' )
			xs_meta_checkbox( $meta, $value );	
		endforeach; ?>
	</table>
<?php
}


function xs_meta_text_input( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo wp_specialchars( $value, 1 ); ?>" size="30" tabindex="30" style="width: 97%;" />
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<br />
			<p class="description"><?php echo $desc; ?></p>
		</td>
	</tr>
	<?php
}

function xs_meta_select( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
			<?php foreach ( $options as $option ) : ?>
				<option <?php if ( htmlentities( $value, ENT_QUOTES ) == $option ) echo ' selected="selected"'; ?>>
					<?php echo $option; ?>
				</option>
			<?php endforeach; ?>
			</select>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}
function xs_meta_textarea( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo wp_specialchars( $value, 1 ); ?></textarea>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
    <br />
			<p class="description"><?php echo $desc; ?></p>		</td>
	</tr>
	<?php
}
function xs_meta_checkbox( $args = array(), $value = false ) {
	extract( $args ); ?>
<tr>
		<th style="width:10%;">
	<label for="<?php echo $name; ?>"><?php echo $title; ?></label>		</th>
		<td>
    <input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="yes"
    <?php if ( htmlentities( $value, 1 ) == 'yes' ) echo ' checked="checked"'; ?>
    style="width: auto;" />
    <input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
    <span class="description"><?php echo $desc; ?></span>
    </td>
	</tr>
	<?php }
	
	
function xs_save_meta_data( $post_id ) {
	if ( 'page' == $_POST['post_type'] )
		$meta_boxes = array_merge( xs_page_boxes() );
	else
		$meta_boxes = array_merge( xs_post_box1());
		foreach ( $meta_boxes as $meta_box ) :
		if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
			return $post_id;
		if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		elseif ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		$data = stripslashes( $_POST[$meta_box['name']] );
		if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
			add_post_meta( $post_id, $meta_box['name'], $data, true );
		elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
			update_post_meta( $post_id, $meta_box['name'], $data );
		elseif ( $data == '' )
			delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );
	endforeach;
}

?>