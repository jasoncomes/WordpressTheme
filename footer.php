    <?php use HigherEducation\Pub\PublicHelpers; ?>

    <footer class="site-footer">

        <div class="wrapper">

            <a href="<?php echo WP_HOME; ?>" class="logo-footer"><?php echo PublicHelpers::get_svg('logo-footer'); ?> &copy; <?php echo date("Y"); ?> BusinessAnalytics.com</a>
            <nav class="nav-footer">
                <?php wp_nav_menu(['menu' => 'Main-Nav', 'theme_location' => 'footer', 'container' => false]); ?>
            </nav>
            
        </div>

    </footer>

    <div class="bg-overlay"></div>

</div>

<?php wp_footer(); ?>

<script type="text/javascript" src="http://tags.crwdcntrl.net/c/10154/cc_ajax.js?ns=_cc10154" id="LOTCC_10154"></script>
<script type="text/javascript">_cc10154.bcp();</script>

</body>
</html>