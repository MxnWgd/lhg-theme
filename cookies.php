<div class="cookie-banner-blur"></div>
<div class="cookie-banner">
  <svg viewBox="0 0 100 100" class="cookie-banner-icon">

    <path class="cookie-banner-icon-cookie" d="M 50 0 Q 98 2 100 50 Q 98 98 50 100 Q 32 99 27 93 Q 35 78 18 69 Q 18 51 0 50 Q 2 2 50 0"></path>

    <path class="cookie-banner-icon-crumble" d="M 25 25 L 34 28 L 30 34 L 24 34 L 22 28 Z"></path>
    <path class="cookie-banner-icon-crumble" d="M 68 15 L 75 20 L 78 26 L 72 29 L 65 22 Z"></path>
    <path class="cookie-banner-icon-crumble" d="M 55 45 L 62 48 L 64 52 L 60 58 L 54 52 Z"></path>
    <path class="cookie-banner-icon-crumble" d="M 35 55 L 40 61 L 38 65 L 33 64 L 31 58 Z"></path>
    <path class="cookie-banner-icon-crumble" d="M 54 81 L 48 86 L 52 91 L 61 88 L 58 80 Z"></path>
    <path class="cookie-banner-icon-crumble" d="M 84 53 L 91 58 L 89 64 L 82 68 L 79 61 Z"></path>
    <path class="cookie-banner-icon-crumble" d="M 48 9 L 51 14 L 46 19 L 44 17 L 43 11 Z"></path>
  </svg>

  <h1 class="cookie-banner-title">Cookies are delicous...</h1>
  <p>...und deswegen geben wir auch gerne etwas davon ab :)</p>
  <p>Spaß beiseite: Diese Website benötigt aus technischen Gründen Cookies, um korrekt zu funktionieren. Wenn du diesen Hinweis schließt und unsere Website verwendest, erklärst du dich damit einverstanden, dass wir Cookies setzen. Die Daten werden gemäß unserer Datenschutzerklärung verarbeitet, jedoch keinesfalls für personalisierte Werbung unsererseits verwendet.</p>
  <button id="cookieBannerCloseButton" type="button" name="Verstanden!" class="cookie-banner-close-button">Ok, einverstanden!</button>

  <div class="cookie-banner-footer">
    <p>Weitere Informationen zur Datenverarbeitung und wofür diese Seite Cookies verwendet, findest du in unserer <?php if (get_theme_mod('data_protection_page') !== '0') { ?><a href="<?php echo get_page_link(get_theme_mod('data_protection_page')) ?>" title="Datenschutzerklärung">Datenschutzerklärung.</a><?php } else { ?>Datenschutzerklärung <?php } ?></p>

    <details>
      <summary>Warum kann ich keine Cookies ablehnen?</summary>
      <p>
        Unsere Website basiert auf dem Content Management System WordPress. Dieses kann durch Plugins erweitert werden, die möglicherweise Cookies für ihre Funktionsweise setzen. Diese Cookiesetzung können wir leider nicht immer unterbinden. Daher kannst du unsere Website leider nicht nutzen, wenn du keine Cookies akzeptieren möchtest.
        Aber keine Sorge: diese Cookies werden nicht dazu verwendet, ein Profil von dir anzulegen, personalisierte Werbung anzuzeigen oder anderen wirtschaftlichen Tätigkeiten nachzugehen.
      </p>
    </details>
  </div>
</div>

<script type="text/javascript">
  jQuery('html').addClass('scroll-blocked');

  jQuery(document).ready(function() {
    jQuery('#cookieBannerCloseButton').focus();
  });
</script>
