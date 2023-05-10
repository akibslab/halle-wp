<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package halle
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>


    <!-- SOCIAL MEDIA META DATA -->
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Événements Culturels à Floirac - Bordeaux | HALLE 47" />
    <meta property="og:url" content="www.halle47.fr>" />
    <meta property="og:title" content="Événements Culturels à Floirac - Bordeaux | HALLE 47" />
    <meta property="og:description" content="Événements Culturels à Floirac - Bordeaux | HALLE 47" />
    <meta property="og:image" content="<?php echo home_url('/'); ?>images/img-post-facebook.jpg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <meta property="article:tag" content="immobilier" />
    <meta property="article:tag" content="appartement" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Événements Culturels à Floirac - Bordeaux | HALLE 47" />
    <meta name="twitter:title" content="Événements Culturels à Floirac - Bordeaux | HALLE 47" />
    <meta name="twitter:site" content="@www.halle47.fr" />
    <meta name="twitter:image" content="<?php echo home_url('/'); ?>images/img-post-twitter.jpg" />

    <!-- POUR BING -->
    <meta name="msnbot" content="Le nouveau lieu culturel qui va dynamiser le sud-est de Bordeaux. Manifestations et événement culturels, concerts, performances, échanges, conférences… Soyez prêt.e.s">
    <meta name="bingbot" content="Le nouveau lieu culturel qui va dynamiser le sud-est de Bordeaux. Manifestations et événement culturels, concerts, performances, échanges, conférences… Soyez prêt.e.s">

    <!-- Schema.org markup for Google -->
    <meta itemprop="name" content="Événements Culturels à Floirac - Bordeaux | HALLE 47">
    <meta itemprop="description" content="Le nouveau lieu culturel qui va dynamiser le sud-est de Bordeaux. Manifestations et événement culturels, concerts, performances, échanges, conférences… Soyez prêt.e.s">
    <meta itemprop="image" content="<?php echo home_url('/'); ?>images/icone-apple-touch.jpg">

    <!-- MICRO DATA -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "HALLE 47",
            "url": "www.halle47.fr",
            "logo": "<?php echo home_url('/'); ?>images/img-post-twitter.jpg"
        } {
            "@context": "http://schema.org",
            "@type": "Product",
            "name": "Événements Culturels à Floirac - Bordeaux | HALLE 47",
            "image": "<?php echo home_url('/'); ?>images/img-post-facebook.jpg",
            "description": "Le nouveau lieu culturel qui va dynamiser le sud-est de Bordeaux. Manifestations et événement culturels, concerts, performances, échanges, conférences… Soyez prêt.e.s"
        }
    </script>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>


    <?php
    $halle_backtotop_switcher = get_theme_mod('halle_backtotop', false);

    $halle_preloader_switcher = get_theme_mod('halle_preloader', false);
    $halle_preloader_logo = get_template_directory_uri() . '/assets/img/preloader.svg';

    $preloader_logo = get_theme_mod('preloader_logo', $halle_preloader_logo);

    ?>

    <?php if (!empty($halle_preloader_switcher)) : ?>
        <!-- Preloader -->
        <div class="preloader" style="background-image: url(<?php echo esc_url($preloader_logo); ?>);"></div>
        <!-- pre loader area end -->
    <?php endif; ?>


    <!-- back to top start -->
    <div class="progress-wrap <?php echo !$halle_backtotop_switcher ? 'd-none' : '' ?>">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->


    <!-- header start -->
    <?php
    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('header')) {
        get_template_part('./template-parts/header');
    }
    ?>
    <!-- header end -->

    <!-- wrapper-box start -->
    <?php do_action('halle_before_main_content'); ?>

    <main class="clearfix" id="main">