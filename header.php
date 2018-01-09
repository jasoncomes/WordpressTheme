<!doctype html>
<html <?php language_attributes(); ?>>
<head>

    <script async src="https://platform.highereducation.com/widgets.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">
    <title><?php wp_title(''); ?></title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">

    <?php 
    wp_head();
    use HigherEducation\Pub\PublicHelpers;
    ?>

</head>

    <body <?php include TMPL_DIR . '/inc/functions-classes.php'; body_class($classes); ?>>

        <header class="site-header wrapper" role="banner">

            <a href="<?php echo WP_HOME; ?>" class="header-logo"><?php echo PublicHelpers::get_svg('logo'); ?></a>
            
            <nav class="nav-primary" role="navigation">
                <?php wp_nav_menu(['menu_class'=> 'menu', 'menu' => 'header', 'theme_location' => 'primary', 'container' => false]); ?>
                <button class="btn-bars js-toggle" data-bodyclass="is-active-mobile">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </nav>

        </header>
