<h1>LHG-Theme Hilfe</h1>
<p>Hier findest du viele Hilfeartikel mit Antworten auf häufig gestellte Fragen zum LHG-Theme. Klicke dich einfach links durch die passenden Hilfeartikel. Falls du keine Lösung für dein Problem findest, zögere nicht, uns über "Support" zu kontaktieren.</p>

<hr>

<h2>Über das Theme</h2>
<img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-gelb.png" alt="LHG-Logo">
<h4>Das offizielle Theme für die Liberalen Hochschulgruppen.</h4>

<p>Version: <?php echo wp_get_theme()->version ?> <a id="checkForUpdate" href="javascript:;" title="Auf Updates prüfen">Auf Updates prüfen</a></p>
<p>
  Erstellt 2022 von Katharina Lauterbach und Maximilian Wiegand.<br>
  Für Bugs oder Verbesserungen:</em> <a href="https://github.com/MxnWgd/lhg-theme/issues" title="Github">Github</a>.
  <details>
    <summary style="cursor: pointer">Release Notes</summary>
    <div>
      <code>
        <ul>
          <li>
            <strong>Ver 2.5.2</strong><br>
            - fixed buggy front page news query (#238)
          </li>
          <li>
            <strong>Ver 2.5.1</strong><br>
            - fixed search not working (#235)<br>
            - fixed end of loading resolutions does not release filters (#236)
          </li>
          <li>
            <strong>Ver 2.5</strong><br>
            - improved indent on sublists (#227)<br>
            - generalized default link for newsletter btn in flyout (#232)<br>
            - made event page be turned on by default (#231)<br>
            - blocked filter change on load of posts (#226)<br>
            - fixed link to news category on front page not working (#229)<br>
            - fixed layout on no news (#222)<br>
            - fixed editor List bug (#225)<br>
            - code improvements
          </li>
          <li>
            <strong>Ver 2.4.1</strong><br>
            - fixing bug with resolution archive loading
          </li>
          <li>
            <strong>Ver 2.4</strong><br>
            - added second content area to front page<br>
            - added additional areas for pages (#87)<br>
            - added infinite scrolling for resolutions page (#117)<br>
            - added automatic hiding of expired resolutions on public page (not for auto-sunset) (#204)<br>
            - added easier editing for many components with edit buttons (#213)<br>
            - added separate tile image for posts (#214)<br>
            - added links to persons pages on person tiles<br>
            - improved page title (#210)<br>
            - fixed reset update mechanism on theme install (#179)<br>
            - fixed submenus not centered properly (#211)<br>
            - fixed low resolution for enlarged images (#212)<br>
            - fixed header image showing background (#215)<br>
            - fixed front page displaying wrong posts and not showing sticky posts if not of same category (#217)<br>
            - fixed bug with font loading in editor<br>
            - lots of minor style improvements
          </li>
            <strong>Ver 2.3</strong><br>
            - added shortcode for calendar to insert in pages (#148)<br>
            - added sunset for resolutions (#207)<br>
            - added automatic expiration display when sunset has expired<br>
            - added LinkedIn as social media option (#206)<br>
            - added option to remove all persons from front page<br>
            - improved persons edit page<br>
            - fixed pinned posts do not work on front page (#192)<br>
            - fixed links in pullquotes (#193)<br>
            - fixed titles in tiles in dark mode not visible (#194)<br>
            - fixed displaying "related posts" even if none existing (#196)<br>
            - fixed cookie hint when data protection page settings are not defined (#197)<br>
            - fixed text in header blocking slideshow controls (#198)<br>
            - fixed current page is displayed in footer menu (#200)<br>
            - fixed paragraphs not working on board pages (#203)<br>
            - fixed assembly pages only showing some resolutions without pagination (#205)<br>
            - fixed styled bullet points and list numbers not visible in editor
          </li>
          <li>
            <strong>Ver 2.2.2</strong><br>
            - Restyled bullet points and numbers (#169)<br>
            - added shortcode for external embedding (#173)<br>
            - updated cookie hint to explain not existing option to decline cookies (#182)<br>
            - fixed bug where person tiles slide out arrow was visible (#37)<br>
            - (hopefully) fixed issue with permanent cookie hint (#180)<br>
            - fixed 404 page not working (#181)<br>
            - fixed resolution archive loading all elements on first load (#183)<br>
            - fixed buttons in editor styles wrong (#184)<br>
            - fixed some images not enlargable (#188)<br>
            - fixed multi-level-lists (#190)
          </li>
          <li>
            <strong>Ver 2.2.1</strong><br>
            - "real support for PHP 8.0... (#176)<br>
            - fixed events expanded in calendar cut off (#177)
          </li>
          <li>
            <strong>Ver 2.2</strong><br>
            - added support for PHP 8.0 (#156)<br>
            - added autofocus on search input when switching (#168)<br>
            - added GDPR-embedd-option for iframes, will be suppressed until data transmission is accepted, permanent acception possible (#170)<br>
            - added login form logo (#171)<br>
            - fixed resolutionfilter-cookie not working (#160)<br>
            - fixed select arrows invisible (#163)<br>
            - fixed some events invisible in calendar (#164)<br>
            - fixed a lot of calendar bugs<br>
            - fixed bug with iframe embed<br>
            - fixed calendar display bugs<br>
            - embedded fontawesome locally (#172)<br>
            - extendend help (#174) <br>
            - links smaller (#166)
          </li>
          <li>
            <strong>Ver 2.1</strong><br>
            - added "sorrow"-mode (B/W-mode) (#108)<br>
            - added attachment pages (#124)<br>
            - added expired resolutions (#125)<br>
            - added feature to remove resolution filter attributes if none set (#143)<br>
            - added customize options for event overview page (#144)<br>
            - added auto-update detection based on bundes-lhg.de and manual check in help page (#154)<br>
            - created help page for theme-specific page settings (#157)<br>
            - improved sort of assemblies in resolution filter by hierarchy (#134)<br>
            - improved help section and messages with direct links to customizer sections (#149)<br>
            - improved more resolutions tiles (#152)<br>
            - improved cookie hint with auto focus on cookie accept button (#153)<br>
            - fixed order of menu items wrong in backend on some pages (#123)<br>
            - fixed default value for "Datenschutzerklärung im Zusatzmenü im Footer anzeigen" (#141)<br>
            - fixed width of compact wrapper link (#142)<br>
            - fixed image caption bug (#145)<br>
            - fixed select boxes in safari on mac (#150)<br>
            - fixed lists (#151)<br>
            - fixed events not closing when others are opened in calendar (#155)<br>
            - fixed bug with url meta tag<br>
            - fixed wp pullquotes<br>
            - many minor improvements<br>
            - cleaned up code (#146)
          </li>
          <li>
            <strong>Ver 2.0.3</strong><br>
            - added fallback to use first found category for front page news list if none set (#130)<br>
            - added dismiss-option to missing-logo-warning and data-protection-page-warning (#131)<br>
            - improved display of small menu in header (#132)<br>
            - improved title behavior for no subtitle (#133)<br>
            - improved default menu titles for events & resolutions (#138)<br>
            - removed taxonomies from menu options (#137)<br>
            - fixed links event tiles front page (#139)
          </li>
          <li>
            <strong>Ver 2.0.2</strong><br>
            - added auto-focus to search input (#126)<br>
            - improved creation of one-day-events (#127)<br>
            - fixed the event descriptions in calendar (finally...) (#119)<br>
            - fixed event description pages not formatting paragraphs correctly (#121)<br>
            - fixed front page event tiles link not showing hover (#122)
          </li>
          <li>
            <strong>Ver 2.0.1</strong><br>
            - fixed bug regarding event descriptions (#119)
          </li>
          <li>
            <strong>Ver 2.0</strong><br>
            - added events (#86), resolutions and more features<br>
            - added 404 page<br>
            - added easier person selection for front page (#27)<br>
            - added person pages (#48) and HTML/rich-text-support (#49)<br>
            - added maintenance mode (#60)<br>
            - added option to change featured image alignment to top or bottom (#62)<br>
            - added link to customizer theme settings (#74)<br>
            - added option for phone numbers to person tiles (#91)<br>
            - updated resolution filter and events message when none found<br>
            - improved mail spam prevention by hiding mail addresses (#13)<br>
            - fixed bug where header slider would be visible behind fade-in content (#23)<br>
            - fixed fonts in editor not working correctly (#92)<br>
            - fixed bug where news area would be shown even if no category is set (#93)<br>
            - fixed bug with cookie expiration time (#95)<br>
            - fixed parts of the resoution filter form not visible on mobile pages (#102)<br>
            - fixed bug where search form is not working (#105)<br>
            - fixed bug where flyout is above menu (#106)<br>
            - disabled mails on auto updates (#98)<br>
            - a ton of fine tuning (#43, #63, #74, #89, #94, #90, #99, #104, #113 and more)<br>
            - cleaned up code<br>
          </li>
          <li>
            <strong>Ver 1.1.8</strong><br>
            - added events post type including post meta and validation for editing
          </li>
          <li>
            <strong>Ver 1.1.7</strong><br>
            - added basic resolutions functionality
          </li>
          <li>
            <strong>Ver 1.1.6</strong><br>
            - fixed header title too close to edges<br>
            - fixed links and other items style on front page additional area<br>
            - fixed favicon not working sometimes<br>
            - fixed file upload button opacity<br>
            - fixed meta image on front page<br>
            - added persons help shortcut when editing<br>
            - added ability to pin posts on front page<br>
            - added image view close with escape button<br>
            - added option to remove search button<br>
            - restructured code
          </li>
          <li>
            <strong>Ver 1.1.5</strong><br>
            - fixed bug that made footer invisible<br>
            - fixed bug with transparent background on some pages<br>
            - fixed bug where separator between title and category invisible<br>
            - fixed hover animation not working on footer logo<br>
            - fixed bug where items might not become visible even if they are in window frame on page reload<br>
            - fixed white space below footer on small pages<br>
            - improved front page when settings not all set<br>
            - improved multi line image subtitle visibility on full screen image view<br>
            - updated layout on tag page
          </li>
          <li>
            <strong>Ver 1.1.4</strong><br>
            - Bug fixing
          </li>
          <li>
            <strong>Ver 1.1.3</strong><br>
            - fixed footer animation bug<br>
            - fixed footer badge bug<br>
            - fixed front page additional area image size<br>
            - fixed bug with default settings for flyout<br>
            - fixed bug with blockquote font size<br>
            - fixed issues with bold font<br>
            - fixed font size bug on blockquotes<br>
            - fixed display on posts without category (e.g. plugin introduced pages)<br>
            - fixed front page margins if additional area is turned off<br>
            - improved header image
          </li>
          <li>
            <strong>Ver 1.1.2</strong><br>
            - animation fine tuning<br>
            - style fine tuning<br>
            - restyled post blocks
          </li>
          <li>
            <strong>Ver 1.1.1</strong><br>
            - Bug fixing
          </li>
          <li>
            <strong>Ver 1.1</strong><br>
            - added persons feature<br>
            - added help pages<br>
            - improved customizer settings<br>
            - updated theme description<br>
            - updated cookie hint and added data protection page link<br>
            - bug fixing
          </li>
          <li>
            <strong>Ver 1.0</strong><br>
            - minor fixes and tweaks<br>
            - release candidate
          </li>
        </ul>
      </code>
    </div>
  </details>
</p>
<p>Lizenz: <em> Das Theme darf frei auf den Webseiten aller Mitgliedsgruppen im Bundesverband Liberaler Hochschulgruppen verwendet werden. Jede Verwendung außerhalb der vorgesehenen Webseiten bedarf der vorherigen Einwilligung durch den Bundesverband Liberaler Hochschulgruppen sowie den Autoren. Änderungen am Theme sind nur mit Zustimmung des Bundesverbands Liberaler Hochschulgruppen sowie den Autoren zulässig.</em></p>

<p><em>&copy; 2023 Bundesverband Liberaler Hochschulgruppen</em></p>

<script type="text/javascript">
  jQuery('#checkForUpdate').click(function() {
    jQuery('#checkForUpdate').html('Wird geprüft...');

    var data = {
      'action': 'check_for_update',
      'post_type': 'POST',
    }
    jQuery.post('<?php echo site_url() ?>/wp-admin/admin-ajax.php', data).done(
      function(response) {
        if (response == '1') {
          jQuery('#checkForUpdate').html('Du bist auf dem aktuellsten Stand!');
          jQuery('#checkForUpdate').css({
            'pointer-events': 'none',
            'color': 'inherit',
            'text-decoration': 'none',
            'font-weight': 'bold',
          });;
        } else {
          jQuery('#checkForUpdate').html('Ein Update ist möglicherweise verfügbar. Bitte schau in die LHG-Cloud oder wende dich an den IT-Support.');
          jQuery('#checkForUpdate').css({
            'pointer-events': 'none',
            'color': 'inherit',
            'text-decoration': 'none',
            'font-weight': 'bold',
          });;
        }
      }
    ).fail(
      function(response) {
        jQuery('#checkForUpdate').html('Fehler beim Prüfen. Bitte wende dich an den IT-Support');
      }
    );
  });
</script>
