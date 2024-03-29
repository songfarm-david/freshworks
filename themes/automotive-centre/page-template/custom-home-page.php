<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'automotive_centre_before_slider' ); ?>

  <?php if( get_theme_mod( 'automotive_centre_slider_hide_show',true) != '') { ?>

  <section id="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <?php $slider_page = array();
        for ( $count = 1; $count <= 4; $count++ ) {
          $mod = intval( get_theme_mod( 'automotive_centre_slider_page' . $count ));
          if ( 'page-none-selected' != $mod ) {
            $slider_page[] = $mod;
          }
        }
        if( !empty($slider_page) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $slider_page,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
      ?>     
      <div class="carousel-inner" role="listbox">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <?php the_post_thumbnail(); ?>
            <div class="carousel-caption">
              <div class="inner_carousel">
                <h2><?php the_title(); ?></h2>
                <p><?php $excerpt = get_the_excerpt(); echo esc_html( automotive_centre_string_limit_words( $excerpt, esc_attr(get_theme_mod('automotive_centre_slider_excerpt_number','30')))); ?></p>
                <div class="slider-btn">
                  <a href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'LEARN MORE', 'automotive-centre' ); ?><span class="screen-reader-text"><?php esc_html_e( 'LEARN MORE','automotive-centre' );?></span></a>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; endwhile; 
        wp_reset_postdata();?>
      </div>
      <?php else : ?>
          <div class="no-postfound"></div>
      <?php endif;
      endif;?>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
        <span class="screen-reader-text"><?php esc_attr_e( 'Previous','automotive-centre' );?></span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
        <span class="screen-reader-text"><?php esc_attr_e( 'Next','automotive-centre' );?></span>
      </a>
    </div>
    <div class="clearfix"></div>
  </section>

  <?php } ?>

  <?php do_action( 'automotive_centre_after_slider' ); ?>

  <section id="about-section">
    <div class="container">
      <?php if( get_theme_mod( 'automotive_centre_section_title') != '') { ?>
        <h6><?php echo esc_html(get_theme_mod('automotive_centre_section_title',''));?></h6>
      <?php } ?>
      <div class="row">
        <?php $about_page = array();
          for ( $count = 0; $count <= 0; $count++ ) {
            $mod = absint( get_theme_mod( 'automotive_centre_about_page' ));
            if ( 'page-none-selected' != $mod ) {
              $about_page[] = $mod;
            }
          }
          if( !empty($about_page) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $about_page,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $count = 0;
              while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="col-lg-7 col-md-7">
                  <h3><?php the_title(); ?></h3>
                  <hr>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( automotive_centre_string_limit_words( $excerpt, esc_attr(get_theme_mod('automotive_centre_about_excerpt_number','30')))); ?></p>
                  <div class="more-btn">
                    <a href="<?php the_permalink(); ?>"><?php esc_html_e('LEARN MORE','automotive-centre'); ?><span class="screen-reader-text"><?php esc_html_e( 'LEARN MORE','automotive-centre' );?></span></a>
                  </div>
                </div>
                <div class="col-lg-5 col-md-5">
                  <?php the_post_thumbnail(); ?>
                </div>
              <?php $count++; endwhile; ?>
            <?php else : ?>
                <div class="no-postfound"></div>
            <?php endif;
          endif;
          wp_reset_postdata();
        ?>
      </div>
    </div>
  </section>
  
  <?php do_action( 'automotive_centre_after_second_section' ); ?>

  <div class="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>
