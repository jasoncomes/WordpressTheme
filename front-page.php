<?php get_header(); ?>

<main role="main" class="site-content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article class="entry wrapper">
            
            <div class="entry-content"><?php the_content(); ?></div>

        </article>

    <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
