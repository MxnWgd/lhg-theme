    <footer>
      <?php if (!get_theme_mod('remove_footer_branding')) { ?><p class="made-by-branding">Theme made with 💛 by LHG</p><?php } ?>
      <div class="footer-sm-icons">
        <?php if (get_theme_mod('sm_facebook_url') != null) { ?>
          <a title="Facebook-Profil" class="sm-icon" target="_blank" href="<?php echo get_theme_mod('sm_facebook_url'); ?>" rel="noreferrer"><i class="fab fa-facebook"></i></a>
        <?php } ?>
        <?php if (get_theme_mod('sm_insta_url') != null) { ?>
          <a title="Instagram-Profil" class="sm-icon" target="_blank" href="<?php echo get_theme_mod('sm_insta_url'); ?>" rel="noreferrer"><i class="fab fa-instagram"></i></a>
        <?php } ?>
        <?php if (get_theme_mod('sm_twitter_url') != null) { ?>
          <a title="Twitter-Profil" class="sm-icon" target="_blank" href="<?php echo get_theme_mod('sm_twitter_url'); ?>" rel="noreferrer"><i class="fab fa-twitter"></i></a>
        <?php } ?>
        <?php if (get_theme_mod('sm_youtube_url') != null) { ?>
          <a title="Youtube-Profil" class="sm-icon" target="_blank" href="<?php echo get_theme_mod('sm_youtube_url'); ?>" rel="noreferrer"><i class="fab fa-youtube"></i></a>
        <?php } ?>
      </div>

      <div class="footer-flex-area">
        <?php if (has_nav_menu('secondary')) { ?>
          <nav class="footer-nav">
            <?php
              wp_nav_menu(array(
                'menu_class' => 'header-menu',
                'container' => '',
                'theme_location' => 'secondary',
              ));
            ?>
            <?php if (get_theme_mod('show_sos_icon')) { ?><a title="SOS" class="sos-button" type="button" target="_blank" href="https://sos.bundes-lhg.de/">🆘</a><?php } ?>
          </nav>
        <?php } ?>

        <div class="footer-branding">
          <?php if (has_custom_logo()) {
            the_custom_logo();
           } else {
            wp_title('');
          } ?>
        </div>
      </div>
      <?php wp_footer(); ?>
    </footer>
  </body>
</html>
