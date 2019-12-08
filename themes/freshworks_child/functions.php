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
 * Set up custom post type 'Cars'
 */
function fw_createReviewCustomPostType() {
   register_post_type('reviews',
      array(
         'labels'     => array(
            'name'          => __('Reviews'),
            'singular_name' => __('Review'),
            'edit_item'     => __('Edit Review'),
            'new_item'      => __('New Review'),
            'add_new_item'  => __('Add New Review'),
            'view_item'     => __('View Review'),
            'view_items'    => __('View Reviews'),
            'all_items'     => __('All Reviews'),
            'item_updated ' => __('Review Updated')
      ),
      'description' => 'Post type for cars for sale',
      'public'      => true,
      'has_archive' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_icon' => 'dashicons-star-empty',
      'supports' => array(
         'editor',
         'author',
         'comments'
      )
   ));
}
add_action('init', 'fw_createReviewCustomPostType');

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

/**
 * Change name of meta box on cars post type
 */
function fw_renameCommentsMetaBox() {
    global $wp_meta_boxes;
    $wp_meta_boxes['cars']['normal']['core']['commentsdiv']['title']= 'Reviews';
}
add_action('add_meta_boxes', 'fw_renameCommentsMetaBox', 999);

/**
 * Rename 'Comments' label in Admin Menu
 */
function fw_renameCommentsAdminMenuLabel() {
   global $menu, $submenu;
   $menu['25']['0'] = 'Reviews';
   $menu['25']['6'] = 'dashicons-star-empty';
   $submenu['edit-comments.php']['0']['0'] = 'All Reviews';
   // TODO: Update comments page in admin
}
// add_action('admin_menu', 'fw_renameCommentsAdminMenuLabel');

/**
 * Filter for putting class on select menu item
 */
function fw_filterMenu( $items ) {
   // var_dump($items);
}
add_filter('wp_nav_menu_items', 'fw_filterMenu', 10, 2);
