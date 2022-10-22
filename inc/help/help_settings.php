<h1>Themeeinstellungen</h1>

<div class="notice-info notice">
		<p>Die Themeeinstellungen findest du im <a href="<?php echo wp_customize_url(); ?>" title="Link zum Customizer">Customizer</a>.</p>
</div>

<p>Das Theme bietet eine Vielzahl von Konfigurationsmöglichkeiten, von Farbschemata über die Startseitenkonfiguration bis hin zu Flyouts.</p>


<hr>
<h2>Wartungsmodus</h2>
<p>Der Wartungsmodus der Website kann hier aktiviert und deaktiviert werden. Ist der Wartungsmodus aktiv, werden alle Seiten vor Besuchern versteckt und sind lediglich für angemeldete Benutzer sichtbar.</p>


<hr>
<h2>Website-Informationen</h2>
<div class="notice-info notice">
		<p>Der hier festgelegte Untertitel erscheint als großer Text im Header auf der Startseite.</p>
</div>
<p>Hier können allgemeine Einstellungen zur Website vorgenommen, z.B. den Titel, den Untertitel sowie das Website-Logo und -Icon (das kleine Symbol in der Kopfzeile des Browsers) festgelegt werden.</p>


<hr>
<h2>Header-Einstellungen</h2>
<div class="notice-info notice">
		<p>Die Header auf den Unterseiten werden je nach Inhalt automatisch konfiguriert. Hat beispielsweise eine Seite oder ein Beitrag ein Beitragsbild, wird natürlich dieses angezeigt. Andernfalls wird ein statisches Bild - abhängig von der jeweiligen Einstellung unten - angezeigt.</p>
</div>
<p>Der Header auf der Startseite kann auf drei Arten konfiguriert werden.</p>

<ul style="padding-left: 20px;">
  <li>
    <h3>(statisches) Bild</h3>
    <p>In diesem Modus zeigt der Header ein ausgewähltes statisches Bild. Vorzugsweise sollte dies ein Bild im Landscape-Format und ausreichend hochauflösend sein. Am Besten verwendest du hierfür ein Bild aus deiner Ortsgruppe. Alternativ stehen Bilder in der <a href="https://bundeslhg.sharepoint.com/:f:/s/LHG-Cloud/El8w8EVDNRVGnXinyaoHeXABCcRLo85d9WrdHgtlnWeYag?e=JVWK8Z" title="Link zur LHG-Cloud" target="_blank">LHG-Cloud</a> zur Verfügung.</p>
  </li>
  <li>
    <h3>Video</h3>
    <p>In diesem Modus wird ein Video in Dauerschleife im Header angezeigt. Dieses sollte im Landscape-Format vorliegen und ausreichend hochauflösend sein. Beachte, dass das Video stark komprimiert sein sollte, um eine lange Ladezeit zu vermeiden.</p>
    <p>Zusätzlich sollte ein Bild ausgewählt werden, welches auf Unterseiten ohne Beitragsbild angezeigt wird.</p>
  </li>
  <li>
    <h3>Slideshow</h3>
    <p>In diese Modus werden mehrere Bilder als Slideshow angezeigt. Es gelten die gleichen Anforderungen wie für statische Bilder.</p>
    <p>Auf Unterseiten wird das erste Bild der Slideshow angezeigt.</p>
  </li>
</ul>


<hr>
<h2>Farbschemata</h2>
<p>Das LHG-Theme bietet euch mehrere Farbschemata - abgestimmt auf die CI-Farben der LHG - zur Auswahl. Diese können im Customizer unter Farbschemata ausgewählt werden.</p>

<div style="display: inline-block; width: 200px; height: 50px; margin: 10px; color: #FFFFFF; text-align: center; line-height: 50px; background: linear-gradient(90deg, #52002E 0%, #A4005A 100%);">
  <strong>Magenta</strong>
</div>
<div style="display: inline-block; width: 200px; height: 50px; margin: 10px; color: #FFFFFF; text-align: center; line-height: 50px; background: linear-gradient(90deg, #003852 0%, #0071A4 100%);">
  <strong>Blau</strong>
</div>
<div style="display: inline-block; width: 200px; height: 50px; margin: 10px; color: #FFFFFF; text-align: center; line-height: 50px; background: linear-gradient(90deg, #003852 0%, #00ABAE 100%);">
  <strong>Türkis</strong>
</div>
<div style="display: inline-block; width: 200px; height: 50px; margin: 10px; color: #FFFFFF; text-align: center; line-height: 50px; background: linear-gradient(90deg, #003852 0%, #E5007D 100%);">
  <strong>Blau-Magenta</strong>
</div>
<div style="display: inline-block; width: 200px; height: 50px; margin: 10px; color: #FFFFFF; text-align: center; line-height: 50px; background: linear-gradient(90deg, #E5007D 0%, #FFED00 100%);">
  <strong>Gelb-Pink*</strong>
</div>
<p>* <em>Dieses Farbschema steht auch mit einem Darkmode zur Auswahl.</em></p>


<hr>
<h2>Startseiteneinstellungen</h2>
<div class="notice-warning notice">
		<p>Die Startseiteneinstellungen werden nur angewendet, wenn unter "Homepage-Einstellungen" die Option "Deine letzten Beiträge" ausgewählt ist!</p>
</div>
<p>Die Startseite der Website kann umfangreich individualisiert werden.</p>

<ul style="padding-left: 20px;">
  <li>
    <h3>Neuigkeiten</h3>
    <p>In diesem Abschnitt können Neuigkeiten (technisch gesehen: Posts einer bestimmten Kategorie) als horizonale Liste angezeigt werden. Es wird empfohlen, diesen Abschnitt auf jeden Fall zu konfigurieren, da hier Besucher:innen der Website direkt einen Überblick über lesenswerte Informationen und die Aktivitäten der LHG bekommen.</p>
		<p>Hierzu muss zuerst festgelegt werden, welche Kategorie von Posts für die Liste verwendet werden soll. Am Besten legt ihr hierfür eine Post-Kategorie an (links unter Beiträge > Kategorien). Zusätzlich sollte ein Titel für den Abschnitt (z.B. "Neuigkeiten") definiert werden.</p>
		<p>Maximal werden die acht aktuellsten Posts der Kategorie angezeigt.</p>
  </li>
  <li>
    <h3>Seite für zusätzlichen Contentbereich</h3>
		<p>Hier kann ein zusätzlicher Textblock auf einem Hintergrundbild angezeigt werden. Diese Seite könnte beispielsweise einen kurzen Vorstellungstext der LHG beinhalten, sollte aber nicht zu umfangreich sein. Als Hintergrundbild wird das Beitragsbild der Seite verwendet.</p>
		<p>Lege dazu zuerst eine Seite fest, die hierfür verwendet werden soll. Du kannst zudem festlegen, ob die Textbox links- oder rechtsorientiert angezeigt werden soll. Alternativ kann der Abschnitt auch ausgeblendet werden.</p>
  </li>
	<li>
		<h3>Terminansicht</h3>
		<div class="notice-info notice">
				<p>Mehr Informationen zu den Veranstaltungen findest du auf der <a href="<?php menu_page_url('help_events'); ?>" title="Hilfeseite über Veranstaltungen">Hilfeseite über Veranstaltungen</a>.</p>
		</div>
		<p>Hier können bis zu drei anstehende Veranstaltungen angezeigt werden.</p>
		<p>Lege dazu einen Titel für den Abschnitt fest. Bleibt der Titel leer, wird der Abschnitt ausgeblendet.</p>
	</li>
  <li>
    <h3>Personenansicht</h3>
		<div class="notice-info notice">
				<p>Mehr Informationen zu den Personen findest du auf der <a href="<?php menu_page_url('help_persons'); ?>" title="Hilfeseite über Personen">Hilfeseite über Personen</a>.</p>
		</div>
		<p>Hier kann eine Auswahl von Personen (bspw. Vorstandsmitglieder oder Mandatsträger) angezeigt werden. </p>
		<p>Zudem kann festgelegt werden, wie der Abschnitt betitelt werden soll sowie auf welche Seite der Link unterhalb des Abschnitts verlinken soll (bspw. eine Seite mit allen Vorstandsmitgliedern). Dieser Link kann zudem individuell benannt werden.</p>
  </li>
</ul>


<hr>
<h2>Menüs</h2>
<p>Hier können die Menüs konfiguriert werden.</p>
<p>Das Theme unterstützt zwei verschiedene Menüs:</p>
<ul style="padding-left: 20px;">
  <li>
    <h3>Hauptmenü</h3>
    <p>Dies ist das große Hauptmenü im Header und sollte auf jeden Fall konfiguriert werden. Unterseiten werden angezeigt, sobald mit der Maus auf das übergeordnete Menüelement gezeigt wird. Auf mobilen Geräten lässt sich das Menü über einen Button rechts oben ein- und ausblenden.</p>
  </li>
  <li>
    <h3>Kleines Zusatzmenü im Header und Footer</h3>
		<p>Zusätzlich kann ein kleines Zusatzmenü im Header und Footer angezeigt werden. Dieses Menü ist optional und wird im Header nicht immer angezeigt. Es eignet sich also nicht für Hauptseiten, sondern vorzugsweise für gelegentlich benötigte Unterseiten (z.B. das Impressum).</p>
		<p>Unter "Weitere Themeeinstellungen" wird beschrieben, wie das Footer-Menü noch weiter angepasst werden kann.</p>
	</li>
</ul>


<hr>
<h2>Social-Media-Icons</h2>
<p>Hier können Links zu den Social-Media-Seiten (Facebook, Twitter, Instagram und YouTube) eingetragen werden. Diese werden dann als Symbole im Footer angezeigt.</p>
<p>Wird ein Link nicht angegeben, wird das jeweilige Symbol ausgeblendet.</p>


<hr>
<h2>Flyout</h2>
<p>Das Flyout ist ein kleines, seitliches Widget, das beim Daraufzeigen/Antippen geöffnet wird. Es beinhaltet Links zu häufig genutzten Möglichkeiten, sich über die LHG zu informieren und aktiv mitzuwirken.</p>
<p>Auf mobilen Geräten wird das Flyout nicht seitlich, sondern oberhalb des Footers angezeigt.</p>
<p>Folgende Buttons können (allesamt optional) im Flyout konfiguriert werden:</p>
<ul style="padding-left: 20px;">
  <li>
    <h3>Spenden</h3>
    <p>Mit diesem Button kann auf eine Spendenseite verlinkt werden. Auch die Verlinkung auch eine externe Seite, bspw. die Spendenseite des Bundesverbands, ist möglich.</p>
  </li>
  <li>
    <h3>Newsletter</h3>
		<p>Hier kann zu einer Anmeldung zu einem Newsletter verlinkt werden. Auch die Verlinkung einer externen Seite, bspw. der Anmeldeseite zum Bundesnewsletter, ist möglich.</p>
	</li>
	<li>
		<h3>Mitglied-werden</h3>
		<p>Dieser Button kann bspw. auf eine Seite mit einem digitalen Mitgliedsantrag (technisch: einem Kontaktformular) verlinken.</p>
	</li>
	<li>
		<h3>Kontakt</h3>
		<p>Am Besten wird hier auf eine Seite mit einem Kontaktformular oder weiteren Kontaktmöglichkeiten verlinkt.</p>
	</li>
</ul>


<hr>
<h2>Weitere Themeeinstellungen</h2>
<p>Hier können weitere Details des Themes konfiguriert werden.</p>
<ul style="padding-left: 20px;">
	<li>
		<h3>Seite für Datenschutzerklärung</h3>
		<div class="notice-warning notice">
			<p>Die Konfiguration dieser Option wird unbedingt empfohlen.</p>
		</div>
		<p>Hier kann festgelegt werden, auf welcher Seite die Datenschutzerklärung liegt. Dies wird bspw. für den Link zur Erklärung im Cookie-Hinweis verwendet.</p>
		<p>Zudem kann die Datenschutzerklärung auf Wunsch im Footer-Menü automatisch angezeigt werden.</p>
	</li>
	<li>
		<h3>Verschiedenes</h3>
		<p>Der Suchbutton im Header kann ausgeblendet werden.</p>
		<p>Wahlweise kann zudem ein Link zum <a href="https://sos.bundes-lhg.de/" title="SOS-Tool">SOS-Tool</a> im Footer angezeigt werden.</p>
	</li>
</ul>
