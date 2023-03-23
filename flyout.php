<div class="flyout">
  <div class="flyout-background"></div>

  <button class="flyout-tooltip" id="flyoutButton">
    Bring dich ein!
  </button>

  <div class="flyout-button-area">
    <?php if (get_theme_mod('flyout_donations_page') !== '0') { ?>
      <a class="flyout-button" type="button" title="Spenden" href="<?php
      if (get_theme_mod('flyout_donations_page') === '1') {
        echo get_theme_mod('flyout_donations_external_page');
      } else {
        echo get_page_link(get_theme_mod('flyout_donations_page'));
      }
      ?>">Spenden</a>
    <?php } ?>

    <?php if (get_theme_mod('flyout_newsletter_page') !== '0') { ?>
      <a class="flyout-button" type="button" title="Newsletter abonnieren" href="<?php
      if (get_theme_mod('flyout_newsletter_page') === '1') {
        echo get_theme_mod('flyout_newsletter_external_page');
      } else {
        echo get_page_link(get_theme_mod('flyout_newsletter_page'));
      }
      ?>">Newsletter abonnieren</a>
    <?php } ?>

    <?php if (get_theme_mod('flyout_membership_page') !== '0') { ?>
      <a class="flyout-button" type="button" title="Mitglied werden" href="<?php echo get_page_link(get_theme_mod('flyout_membership_page')); ?>">Mitglied werden</a>
    <?php } ?>

    <?php if (get_theme_mod('flyout_contact_page') !== '0') { ?>
      <a class="flyout-button" type="button" title="Kontaktiere uns" href="<?php echo get_page_link(get_theme_mod('flyout_contact_page')); ?>">Kontaktiere uns</a>
    <?php } ?>
  </div>

  <?php $query['autofocus[section]'] = 'flyout_options'; echo is_user_logged_in() ? '<a class="edit-post-link" title="Flyout bearbeiten" href="' . esc_url(add_query_arg($query, admin_url('customize.php'))) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
</div>
