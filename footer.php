    <footer>
      <div class="footer-navigation-area">
        <?php if (has_nav_menu('footer')) { ?>
          <nav class="footer-nav">
            <?php
              wp_nav_menu(array(
                'menu_class' => 'header-menu',
                'container' => '',
                'theme_location' => 'footer',
              ));
            ?>
            &nbsp;
          </nav>
        <?php } ?>
      </div>

      <div class="footer-branding">
        <?php if (has_custom_logo()) {
          the_custom_logo();
         } else {
          wp_title('');
        } ?>
      </div>


      <?php wp_footer(); ?>
    </footer>
  </body>
</html>
