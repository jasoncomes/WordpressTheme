<?php
if (!function_exists('yoast_breadcrumb')) {
    return;
}

?>

<nav class="nav-breadcrumbs" role="navigation">

    <?php 
    // Ties CPT with Page Landing Pages.
    $post_types = [
        'rankings'  => false,
        'degrees'   => false,
        'resources' => 9,
        'careers'   => 92
    ];

    if (!empty($post) && array_key_exists($post->post_type, $post_types)) : 
    ?>
        <div class="wrapper" id="breadcrumbs">
            <span xmlns:v="http://rdf.data-vocabulary.org/#">
                <span typeof="v:Breadcrumb">
                    <a href="<?php echo home_url(); ?>/" rel="v:url" property="v:title">Home</a> > 
                    <?php 
                    if (!empty($post_types[$post->post_type])) :
                        $id = $post_types[$post->post_type];
                    ?>
                        <a href="<?php echo get_permalink($id); ?>" rel="v:url" property="v:title"><?php echo get_the_title($id); ?></a> >
                    <?php else : ?>
                        <span property="v:title"><?php echo ucfirst($post->post_type); ?></span> >
                    <?php endif; ?>
                    <span class="breadcrumb_last" property="v:title"><?php the_title(); ?></span>
                </span>
            </span>
        </div>
    <?php 
    else :
        yoast_breadcrumb('<div class="wrapper" id="breadcrumbs">','</div>');
    endif;
    ?>

</nav>
