<?php get_header(); ?>

<main role="main" class="site-content">
  
    <?php 
    include TMPL_DIR . '/partials/subnavigation.php';
    include TMPL_DIR . '/partials/breadcrumbs.php';
    ?>

    <article class="entry wrapper">
        
        <h1 class="entry-title">404</h1>
        <div class="entry-content">
            <p>Oh no!</p>
            <p>The page you're looking for does not exist.</p>
            <a href="/" class="btn-primary">Go Home</a>
        </div>
        
    </article>

</main>

<?php get_footer();
