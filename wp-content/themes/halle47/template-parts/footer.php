<?php

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package halle
 */
// logo
$footerLogo = get_template_directory_uri() . '/assets/img/logo/fayat.png';
$footer_logo = get_theme_mod('footer_logo', $footerLogo);

$footer_text = get_theme_mod('footer_text', __('<a href="#">Adresse</a> / <a href="#">Mentions légales</a> / Conception et réalisation : <a href="https://www.illusio.fr/" target="_blank">illusio.fr</a>', 'halle'));



// footer_columns
$footer_column = 0;
$footer_column = get_theme_mod('footer_widget_column', 4);

$footer_socials_switcher = get_theme_mod('footer_socials_switcher', true);

?>
<!-- Footer Area Start -->
<footer>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-3 offset-lg-1 col-xl-2 offset-xl-3">
        <?php if (!empty($footer_socials_switcher)) : ?>
          <div class="footer_socials">
            <?php halle_footer_socials(); ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-lg-2 col-xl-2 text-center">
        <img src="<?php echo esc_url($footer_logo); ?>" alt="Halle 47 lieu culturel et d’échange Floirac Bordeaux Fayat Immobilier">
      </div>
      <div class="col-lg-6 col-xl-5">
        <?php if (!empty($footer_text)) : ?>
          <p><?php echo halle_kses($footer_text); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</footer>
<!-- Footer Area End -->