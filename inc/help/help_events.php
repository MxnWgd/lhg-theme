<h1>Veranstaltungen</h1>
<img src="<?php echo get_template_directory_uri(); ?>/inc/help/img/events1.png" alt="Musterevent" style="width: 100%; max-width: 600px;">

<p>Über den Menüpunkt <strong>Veranstaltungen</strong> können anstehende Veranstaltungen und Termine angelegt werden. Diese können Benutzern sowohl auf der Startseite als auch in einer Veranstaltungsübersicht inkl. einer Kalenderansicht dargestellt werden.</p>

<h3>Erstellen von Veranstaltungen</h3>
<p>Über das Menüelement Veranstaltung links können vorhandene Veranstaltungen bearbeitet und neue Veranstaltungen erstellt werden.</p>
<p>Eine Veranstaltung sollte mindestens über einen Titel und ein Startdatum verfügen.</p>
<p>Zusätzlich kann der Veranstaltung eine Uhrzeit, ein Endzeitpunkt sowie ein Veranstaltungsort und -link zugewiesen werden. Auch eine Beschreibung kann angebeben werden, diese wird in einem ausklappbaren Element angezeigt.</p>
<p>Ist der Haken bei <em>Google-Maps-Link anzeigen</em> gesetzt, wird automatisch ein Link zu einer via Google Maps gefundenen Location zum eingegebenen Veranstaltungsort erstellt. In diesem Fall kann kein eigener Veranstaltungslink angegeben werden.</p>
<p>Ist der Haken bei <em>Veranstaltungsseite erstellen</em> gesetzt, wird - insofern eine Beschreibung angegeben wurde - diese nur bis zum Weiterlesen-Tag (einfügbar über das <img src="<?php echo get_template_directory_uri(); ?>/inc/help/img/readmore.png" alt="Weiterlesen-Tag" style="width: 1em; max-width: 1em">-Symbol) in der Veranstaltungskachel angezeigt. Über einen <em>Mehr Infos</em>-Button kann dann die vollständige Beschreibung auf einer eigenen Veranstaltungsseite angezeigt werden. Dies ist besonders nützlich bei langen Veranstaltungsbeschreibungen.</p>

<h3>Erstellen und Verwalten von Kalendern</h3>
<div class="notice-info notice">
    <p>Beim Anlegen neuer Veranstaltungen können neue Kalender direkt erstellt werden - sie müssen <em>nicht</em> zuerst über die Attributverwaltung angelegt werden.</p>
</div>
<p>Ähnlich wie bei Post-Kategorien können Veranstaltungen in Kalendern gruppiert werden. Diese können beim Bearbeiten oder Erstellen von Veranstaltungen festgelegt werden.</p>
<p>Neue Kalender können über den Menüpunkt <strong>Kalender</strong> links bei geöffnetem Veranstaltungsmenü erstellt und verwaltet werden.</p>
<p>Zudem kann hier jedem Kalender eine Farbe zugewiesen werden, in welcher diese in der Kalenderansicht hervorgehoben werden.</p>

<h3>Veranstaltungsübersicht anzeigen</h3>
<img src="<?php echo get_template_directory_uri(); ?>/inc/help/img/events2.png" alt="Menüansicht zum Hinzufügen der Veranstaltungsübersicht" style="width: 300px; float: right;">
<p>Für die Veranstaltungsübersicht wird die Inhaltstyp-Archiv-Funktion der Beschlüsse verwendet. Dieses muss also an entsprechenden Stellen verlinkt werden.</p>

<h4>Einfügen in ein Menü</h4>
<div class="notice-info notice">
	<p>Ist der Abschnitt <em>Veranstaltungen</em> in der Menüverwaltung nicht sichtbar, sollte über <em>Ansicht anpassen</em> oben rechts sichergestellt werden, dass der Haken bei <em>Veranstaltungen</em> gesetzt ist.</p>
</div>
<p>Um die Veranstaltungsübersicht von einem Menü aus zu erreichen, muss der Menüeintrag <em>Alle Veranstaltungen</em> hinzugefügt werden.</p>
<p>Hierzu unter <em>Menüeinträge hinzufügen</em> den Abschnitt <em>Veranstaltungen</em> aufklappen, dort den Reiter <em>Alle</em> auswählen und den Eintrag <em>Alle Veranstaltungen</em> auswählen. Anschließend den Eintrag dem Menü an der gewünschten Stelle hinzufügen.</p>

<h4>Anzeigen auf der Startseite</h4>
<p>Bis zu drei anstehende Veranstaltungen können auch auf der Startseite angezeigt werden. Weitere Informationen hierzu findest du in der <a href="<?php menu_page_url('help_settings'); ?>" title="Hilfeseite zu den Themeeinstellungen">Hilfe zu den Themeeinstellungen</a>.</p>
