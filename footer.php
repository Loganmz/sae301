<footer class="site-footer">
    <div class="footer-content">
        <nav class="footer-nav">
        <div class="logo">
          <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/src/img/logo-sae301.svg" alt="Logo">
          </a>
        </div>
            <?php wp_nav_menu(array(
                'theme_location' => 'footer-menu', // Utilise le menu configuré dans WordPress
                'container' => false, // Pas de conteneur autour du menu
                'items_wrap' => '<ul>%3$s</ul>', // Utilise une liste non ordonnée
            )); ?>
        </nav>
        <div class="footer-info">
            <p>&copy; <?php echo date("Y"); ?> Vanguard Clash. Tous droits réservés.</p>
            <p>Contact : <a href="mailto:email@example.com">email@example.com</a></p>
        </div>
        <div class="social-icons">
        <img src="<?php echo get_template_directory_uri(); ?>/src/img/Social_Icons-1.svg" alt="Logo insta">
        <img src="<?php echo get_template_directory_uri(); ?>/src/img/Social_Icons-2.svg" alt="Logo tiktok">
        <img src="<?php echo get_template_directory_uri(); ?>/src/img/Social_Icons-3.svg" alt="Logo youtube">
        <img src="<?php echo get_template_directory_uri(); ?>/src/img/Social_Icons-4.svg" alt="Logo discord">
            
            
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
