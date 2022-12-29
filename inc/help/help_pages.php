<h1>Beiträge und Seiten</h1>

<p>Über die Menüelemente links können Beiträge und Seiten erstellt werden.</p>
<p>Während Beiträge sich bspw. für Pressemitteilungen oder aktuelle Neuigkeiten eignen und in einer Liste auf der Startseite angezeigt werden können (siehe <a href="<?php menu_page_url('help_settings'); ?>" title="Hilfeseite zu den Themeeinstellungen">Hilfe zu den Themeeinstellungen</a>), sind Seiten für eigenständige Inhalte, bspw. Vorstellungen der Verbandsarbeit oder des Vorstandes oder Kontaktinformationen geeignet.</p>

<h3>Themebezogene Besonderheiten</h3>
<h4>Position des Beitragsbildes</h4>
<p>Es kann für jede Seite/jeden Beitrag einzeln konfiguriert werden, wie das Beitragsbild im Header positioniert werden soll. Dies kann über das Auswahlmenü rechts in der Eigenschaftenleiste für die Seiteneinstellungen im Bearbeitungsmodus eingestellt werden.</p>

<h3>Einbettungen</h3>
<p>Da Einbettungen zu externen Seiten oft Cookies im Browser des Nutzers anlegen und Daten zu den externen Diensten übertragen, dürfen diese i.d.R. erst nach Zustimmung des Nutzers geladen werden. Ist die DSGVO-konforme Einbettung in den Einstellungen aktiviert, geschieht dies bei den meisten iFrames automatisch. Da jedoch je nach Implementierung externe Einbetttungen möglicherweise nicht immer erkannt werden, gibt es den Shortcode <code>[dsgvo]</code>, um Inhalte manuell als externe Inhalte zu kennzeichnen und automatisch eine Nutzerabfrage einzufügen.</p>

<h4>Verwendung</h4>
<div class="notice-warning notice">
  <p>Aufgrund der Komplexität kann eine Funktionalität bei der manuellen Kennzeichnung nicht immer garantiert werden! Betreiber der Website sind selbst dafür verantwortlich, dass ihre externen Inhalte im Einlang mit der DSGVO geladen werden.</p>
</div>
<div class="notice-info notice">
  <p>Die manuelle Kennzeichnung funktioniert nur bei Shortcodes, nicht bei HTML-Einfügungen. Als HTML eingefügte iFrames werden meist automatisch erkannt und behandelt.</p>
</div>

<p>Zur Verwendung muss zunächst - wie bei der regulären Einfügung eines Shortcodes - ein Shortcode-Block auf der Seite eingefügt werden. Der dort einzufügende Code wird dann vom <code>[dsgvo destination="<em>Ziel</em>"][/dsgvo]</code> umgeben. Als <code>destination</code> wird die Quelle der externen Einbettung (bspw. Google Maps, YouTube etc.) zur Information der Nutzer angegeben.</p>
<p>Beispiel:<br>
  <code>[dsgvo destination="https://maps.google.com"]<strong>[map-multi-marker id="1"]</strong>[/dsgvo]</code>
</p>
