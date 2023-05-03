<?php

/**
 * Template part for displaying header layout two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package halle
 */


// logo
$mobile_logo = get_template_directory_uri() . '/assets/img/logo/mobile-logo.png';
$mobile_main_logo = get_theme_mod('navigation_logo', $mobile_logo);

// logo
$mobile_bottom_logo = get_template_directory_uri() . '/assets/img/logo/fayat.png';
$mobile_bottomLogo = get_theme_mod('mobile_bottom_logo', $mobile_bottom_logo);

// header settings 
$header_tagline = get_theme_mod('header_tagline', __('Tout un programme !', 'halle'));
$header_description = get_theme_mod('header_description', __('Lieu de culture et d’échanges à Floirac', 'halle'));
$header_right_contact_text = get_theme_mod('header_right_contact_text', __('Contact', 'halle'));
$header_right_contact_link = get_theme_mod('header_right_contact_link', __('#', 'halle'));
$header_mobile_bottom_text = get_theme_mod('header_mobile_bottom_text', __(' Adresse / <a href="#">Mentions légales</a> / Conception et réalisation : <a class="illusio" href="https://www.illusio.fr/" target="_blank">illusio.fr</a>', 'halle'));
?>


<!-- Header Area Starts -->
<div class="site_navigation d-none d-lg-block">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="site_navigation_wrap">
          <div class="site_branding">

            <?php halle_navigation_logo(); ?>
            <?php if (!empty($header_tagline)) : ?>
              <span class="site_tagline"><?php echo esc_html($header_tagline); ?></span>
            <?php endif; ?>
          </div>
          <div class="site_nav">
            <div class="main_menu">

              <?php halle_header_menu(); ?>

            </div>

            <?php if (!empty($header_right_contact_text)) : ?>
              <div class="navigation_right_btn">
                <a href="<?php echo esc_url($header_right_contact_link); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/contact/contact-icon.png" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier"><?php echo esc_html($header_right_contact_text); ?></a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<header class="site-header">
  <div class="site_header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="logo-box">
            <a href="javascript:void(0)" class="mobile_bar d-lg-none"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/icons/menu-bar.png'); ?>" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier"></a>

            <?php halle_header_logo(); ?>

          </div>

          <?php if (!empty($header_tagline)) : ?>
            <h1><?php echo esc_html($header_tagline); ?></h1>
          <?php endif;
          if (!empty($header_tagline)) : ?>
            <p><?php echo esc_html($header_description); ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="mobile_menu d-lg-none">
  <div class="mobile_menu_top">
    <a href="javascript:void(0)" class="mobile_cross"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/cross.png" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier"></a>
    <div class="logo_and_contact">
      <a class="mobile_logo" href="<?php print esc_url(home_url('/')); ?>"><img src="<?php echo esc_url($mobile_main_logo); ?>" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier"></a>
      <?php if (!empty($header_right_contact_text)) : ?>
        <a class="mobile_contact" href="<?php echo esc_url($header_right_contact_link); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/mobile-contact.png" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier"><?php echo esc_html($header_right_contact_text); ?></a>
      <?php endif; ?>
    </div>
  </div>
  <div class="mobile_main_menu">

    <?php halle_header_menu(); ?>

  </div>
  <div class="mobile_menu_bottom">
    <div class="mobile_menu_bottom_logo">
      <a href="javascript:void(0)"><img src="<?php echo esc_url($mobile_bottomLogo); ?>" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier"></a>
    </div>
    <?php if (!empty($header_mobile_bottom_text)) : ?>
      <p class="mobile_menu_bottom_text">
        <?php echo halle_kses($header_mobile_bottom_text); ?>
      </p>
    <?php endif; ?>
  </div>
</div>
<!-- Header Area Ends -->