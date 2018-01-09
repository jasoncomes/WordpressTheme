<?php get_header(); ?>

<main role="main" class="site-content">

    <?php if (have_posts()) while (have_posts()) : the_post(); ?>

        <?php 
        include TMPL_DIR . '/partials/subnavigation.php'; 
        include TMPL_DIR . '/partials/breadcrumbs.php';
        ?>

        <article class="entry wrapper">

            <h1 class="entry-title" data-waypoint="<?php echo sanitize_title(get_the_title()); ?>"><?php the_title(); ?></h1>
            <div class="entry-content"><?php the_content(); ?></div>

        </article>

    <?php endwhile; ?>

</main>

<?php get_footer();
