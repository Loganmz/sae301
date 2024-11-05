<footer>
       <?php bloginfo('name'); ?> est propulsé par <a href="https://wordpress.org">WordPress</a>.
       <nav><?php
         wp_nav_menu ( array (
           'theme_location' => 'footer-menu'
         ) ); ?></nav>
     </footer>
   </div>
   <?php wp_footer(); ?>
 </body>
</html>

