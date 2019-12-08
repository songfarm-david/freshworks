<?php

/* import parent styles into child*/
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);

function enqueue_child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

/**
 * Filter comment form args to read 'review'
 */
function fw_changeCommentFormTitle() {
   return $commentArgs = array(
     'title_reply' => 'Leave a Review',
     'cancel_reply_link'    => __( 'Cancel review' ),
     'label_submit'         => __( 'Post Review' ),
     'comment_field'        => sprintf(
        '<p class="comment-form-comment">%s %s</p>',
        sprintf(
           '<label for="comment">%s</label>',
           _x( 'Review', 'noun' )
        ),
        '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>'
     ),
  );
}
add_filter( 'comment_form_defaults', 'fw_changeCommentFormTitle' );

/**
 * Set up custom post type 'Cars'
 */
function fw_createCarCustomPostType() {
   register_post_type('cars',
      array(
         'labels'     => array(
            'name'          => __('Cars'),
            'singular_name' => __('Car'),
            'edit_item'     => __('Edit Car'),
            'new_item'      => __('New Car'),
            'add_new_item'  => __('Add New Car'),
            'view_item'     => __('View Car'),
            'view_items'    => __('View Cars'),
            'all_items'     => __('All Cars'),
            'item_updated ' => __('Car Updated')
      ),
      'description' => 'Post type for cars for sale',
      'public'      => true,
      'has_archive' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'supports' => array(
         'title',
         'comments',
         'custom-fields',
         'thumbnail'
      )
   ));
}
add_action('init', 'fw_createCarCustomPostType');

/**
 * Get 'Cars' custom post type for
 * main query on index page
 */
function fw_getCars( $query ) {
   if(!$query->is_main_query() || !is_home())
      return;
   $query->set( 'post_type', array('cars') );

}
add_action('pre_get_posts', 'fw_getCars');
