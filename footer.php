    <div class="footer-wrapper">
      <?php if (get_theme_mod('show_flyout')) { get_template_part('flyout'); } ?>

      <footer>
        <?php if (!get_theme_mod('remove_footer_branding')) {
          ?><p class="made-by-branding">Theme made with <?php
          switch (get_theme_mod('theme_color_option')) {
            case 'magenta':
            ?>❤️<?php
            break;

            case 'blau':
            ?>💙<?php
            break;

            case 'türkis':
            ?>🤍<?php
            break;

            case 'blau-magenta':
            ?>❤️<?php
            break;

            case 'gelb*-pink':
            case 'gelb-pink-dark':
            case 'gelb-pink*':
            ?>💛<?php
            break;

            default:
            ?>💛<?php
            break;
          }
        ?> by LHG</p><?php } ?>

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
              <?php if (get_theme_mod('data_protection_page_in_menu', true) && get_theme_mod('data_protection_page') !== '0') { ?><a title="Datenschutzerklärung" class="footer-menu-button" type="button" href="<?php echo get_page_link(get_theme_mod('data_protection_page')); ?>"><?php echo get_the_title(get_theme_mod('data_protection_page')); ?></a><?php } ?>
              <?php if (get_theme_mod('show_sos_icon')) { ?><a title="SOS" class="footer-menu-button" id="sosButton" type="button" target="_blank" href="https://sos.bundes-lhg.de/">🆘</a><?php } ?>
            </nav>
          <?php } ?>

          <div class="footer-branding">
            <?php if (has_custom_logo()) {
              the_custom_logo();
            } else {
              ?><a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a><?php
            } ?>
          </div>
        </div>
      </footer>
    </div>
    <?php wp_footer(); ?>

  </body>
</html>
