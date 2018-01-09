<?php $sub_navigation = !empty($post) ? unserialize($post->sub_navigation) : ''; ?>

<div class="nav-sticky">

    <div class="nav-sticky-fixed">

        <div class="wrapper">

            <div class="progress">
                <progress class="progress-bar" value="0"></progress>
            </div>

            <?php if (!empty($sub_navigation)) : ?>
            <nav class="nav-sub js-rollout-subnav" role="navigation">

                <div class="title-nav js-toggle" data-bodyclass="is-active-subnav">
                    <button class="btn-bars">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </button>
                    <span class="js-label">Quickly View Page Content</span>
                </div>
                <ol>
                    <?php 
                    foreach ($sub_navigation as $hash => $title) {
                        echo '<li><a href="#' . $hash . '">' . $title . '</a></li>';
                    }
                    ?>
                </ol>
            </nav>
            <?php endif; ?>

        </div>

    </div>

</div>