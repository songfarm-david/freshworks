<?php

/* import parent styles into child*/
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);

function enqueue_child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

// $comment_args = array(
//
// )
// apply_filters( 'comments_template_query_args', array $comment_args );
//
// $comment_fields = array(
//
// )
// apply_filters( 'comment_form_fields', array $comment_fields );

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
