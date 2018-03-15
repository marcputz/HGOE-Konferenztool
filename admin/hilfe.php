<?php
	session_start();
	
	if(!isset($_SESSION['user'])) {
		header('location: ./login.php');
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HGÖ - Hilfe</title>
  </head>
  <body>
	<h1>Neue Veranstaltung erstellen</h1>
	<p>Um eine Veranstaltung anzulegen, klicken Sie zuerst auf den so bezeichneten Button rechts oben.</p>
	<p>In dem nun sichtbaren Formular tragen Sie nun alle gew&uumlnschten Informationen ein.</p>
	<p>Dabei ist anzumerken, dass alle Felder au&szliger:</p>
	<ul>
		<li>max. Anmeldungen (Damit kann man festlegen, wie viele Personen maximal an der Veranstaltung teilnehmen k&oumlnnen)</li>
	</ul>
	<p>Pflichtfelder sind.</p>
	
	<p>Beispiel f&uumlr eine funktionierende Veranstaltung:</p>
	
	<img src="assets/img/veranstaltung_erstellen.png" alt="HTML5 Icon" style="width:1000px"/>
	
	<h1>Veranstaltungsdetails/Veranstaltung bearbeiten/Veranstaltung absagen</h1>
	<p>Wenn man mehr Informationen zu einer Veranstaltung sehen oder diese ver&aumlndern m&oumlchte klickt man in der Liste auf der Startseite auf sie.</p>
	<p>Nun wird man zu einer Detailansicht weitergeleitet, bei der man im rechten Bereich ganz einfach die Veranstaltung bearbeiten kann.</p>
	<p>Dabei ist anzumerken, dass  bei den Pflichtfeldern die gleichen Regeln wie bei der Erstellung einer Veranstaltung vorherrschen.</p>
	
	<br>
	
	<p>Auf der linken Seite befinden sich 4 Buttons mit folgender Funktionalit&aumlt (Anmerkung: Bei einem kleineren Bildschirm sind diese Punkte &uumlber das Dropdown-Men&uuml in der rechten, oberen Ecke erreichbar):</p>
	<h2>Teilnehmer</h2>
	<p>In diesem Fenster kann man Informationen zu den Teilnehmern der Veranstaltung sehen.</p>
	<p>Wenn man auf einen Teilnehmer klickt, kann man seine Daten &aumlndern oder ihn von der Veranstaltung abmelden.</p>
	<p>Au&szligerdem kann man hier die Anwesenheit und den Bezahlstatus kontrollieren und &aumlndern.</p>
	
	<h2>Auswertung</h2>
	<p>Damit wird man in Zukunft Statistiken zur Veranstaltung sehen k&oumlnnen. (Noch in Entwicklung)</p>
	<h2>Etiketten</h2>
	<p>Mit diesem Button kann man in Zukunft Namensschilder und Teilnahmebest&aumltigungen drucken k&oumlnnen. (Noch in Entwicklung)</p>
	<h2>Absagen</h2>
	<p>Mit diesem Button kann man eine Veranstaltung absagen. Sie wird dann auf der Startseite bei der Liste mit den &aumllteren Veranstaltungen angezeigt und es kann sich niemand mehr zu dieser Veranstaltung anmelden.</p>
	<h1>Veranstaltung l&oumlschen</h1>
	<p>Dazu klickt man bei der Startseite auf eine &aumlltere Veranstaltung und w&aumlhlt dort den Button "L&oumlschen" aus.</p>
  </body>
</html>