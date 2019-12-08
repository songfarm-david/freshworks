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
      ),
      'description' => 'Post type for cars for sale',
      'public'      => true,
      'has_archive' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'supports' => array(
         'title',
			'editor',
         'comments',
         'custom-fields',
         'thumbnail'
      )
   ));
}
add_action('init', 'fw_createCarCustomPostType');
