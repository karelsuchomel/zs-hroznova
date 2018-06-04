<?php
//
function tfs_render_gallery_shortcode_PSW( $output, $attr) 
{
	global $post, $wp_locale, $wpdb;

	static $instance = 0;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
			$orderby = 'none';

	if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
					$attachments[$val->ID] = $_attachments[$key];
			}
	} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
			return '';

	if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
					$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$output = apply_filters('gallery_style', "
			<style type='text/css'>
					#{$selector} .gallery-item {
							float: {$float};
					}
			</style>
			<!-- see gallery_shortcode() in wp-includes/media.php -->
			<div id='$selector' class='gallery galleryid-{$id}'>");

	$i = 0;
	foreach ( $attachments as $id => $attachment ) 
	{
		$_post = get_post( $id );

		if ( empty( $_post ) || ( 'attachment' !== $_post->post_type ) || ! $url = wp_get_attachment_url( $id ) ) {
			return __( 'Missing Attachment' );
		}

		$url = wp_get_attachment_url( $id );
		$thumbnail = wp_get_attachment_image($id, $size);

		// Get dimensions of images
		$results = wp_get_attachment_image_src($id, 'large');
		$imageDimensions = $results[1] . "x" . $results[2];

		$output .= "<a href='" . esc_url( $results[0] ) . "' class='gallery-item pswp-gallery' data-size='{$imageDimensions}'>" . $thumbnail;
		if ( $captiontag && trim($attachment->post_excerpt) ) {
				$output .= "
						<{$captiontag} class='gallery-caption'>
						" . wptexturize($attachment->post_excerpt) . "
						</{$captiontag}>";
		}
		$output .= "</a>";
	}

	$output .= "</div>";

	return $output;
}
