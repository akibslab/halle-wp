<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package halle
 */

get_header();
?>

<section class="ss-error__area">
  <div class="container">
    <div class="row">
      <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
        <?php
        $halle_404_bg = get_theme_mod('halle_404_bg', get_template_directory_uri() . '/assets/img/error/error.png');
        $halle_error_title = get_theme_mod('halle_error_title', __('Page not found', 'halle'));
        $halle_error_link_text = get_theme_mod('halle_error_link_text', __('Back To Home', 'halle'));
        $halle_error_desc = get_theme_mod('halle_error_desc', __('Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'halle'));
        ?>
        <div class="ss-error__wrap text-center">
          <div class="ss-error__thumb">
            <img src="<?php echo esc_url($halle_404_bg); ?>" alt="<?php print esc_attr__('Error 404', 'halle'); ?>">
          </div>
          <div class="ss-error__content">
            <h3 class="ss-error__title"><?php print esc_html($halle_error_title); ?></h3>
            <p><?php print esc_html($halle_error_desc); ?></p>
            <a href="<?php print esc_url(home_url('/')); ?>" class="ss-btn"><?php print esc_html($halle_error_link_text); ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
get_footer();
