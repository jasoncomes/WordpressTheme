<?php get_header(); ?>

<main role="main" class="site-content">

    <?php 
    include TMPL_DIR . '/partials/subnavigation.php';
    include TMPL_DIR . '/partials/breadcrumbs.php';
    ?>

    <section class="entry wrapper">

        <?php if (have_posts()) : ?>

            <header class="page-header">

                <h1 class="entry-title"><?php echo get_the_archive_title(); ?></h1>
                <div class="taxonomy-description"><?php echo get_the_archive_description(); ?></div>

            </header>

            <?php
            while (have_posts()) : the_post();

                include TMPL_DIR . '/partials/post-preview.php';

            endwhile;

        endif; ?>

    </section>

</main>

<?php get_footer();
