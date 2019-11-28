# UTask Informatica Eindproject
Dit is mijn repository voor het eindproject Informatica dit schooljaar. Ik heb ervoor gekozen om mijn project op github te plaatsen, omdat ik hier makkelijker aan mijn portfolio kan werken en alle aanpassingen worden automatisch opgeslagen in [commits](https://github.com/Tonemon/UTasks/commits/master). Hier kan je ook het aantal aanpassingen zien en wanneer ze gedaan zijn. Omdat dit project eigenlijk vooral bestaat uit het programmeren met PHP en MySQL, heb ik gebruik gemaakt van [Bootstrap](https://getbootstrap.com/) voor alle css (en een beetje javascript) en [Font Awesome](https://fontawesome.com/) voor de icoontjes. De meeste van de bestanden in deze repository zijn .svg bestanden, die bestaan uit icoontjes, die ik in dit project gebruikt heb (In de toekomst gaan deze vervangen worden door remote icoontjes).

Omdat mijn vorige project (de bank applicatie) al bijna af was heb ik ervoor gekozen om een project helemaal vanaf van het begin te maken. Alle aanpassingen en code, die zich in deze repository bevindt is dus dit schooljaar gemaakt. Na dit schooljaar ga ik dit project waarschijnlijk online op mijn portfolio zetten, zodat iedereen er gebruik van kan maken. Daarnaast vind ik het fijn om in het Engels te werken en staan mijn comments meestal naast mijn code in het Engels.

## Over dit project
Dit project bestaat uit een eigen gemaakte kalender/planner software, die je lokaal kan installeren op je pc. Deze 'applicatie' heeft vele verschillende functies, zoals het aanmaken/inloggen in je eigen account, aanmaken/aanpassen/verwijderen van kalender items, het toevoegen van deze items in zelfgemaakte mappen en nog veel meer. Dit systeem is ontwikkeld met PHP en MySQL, en ik heb Bootstrap en FontAwesome voor style elementen gebruikt. Meer informatie en verschillende ideeen/functies/bugs staan onder [deze projectborden](https://github.com/Tonemon/UTasks/projects).

## Installatie instructies
LET OP: Tot nu toe is mijn software nog in ontwikkeling en kan het voorkomen dat er tijdens de installatie (of erna) dingen vastlopen of niet werken. Nadat de applicatie stabiel is, wordt deze informatie van deze pagina gehaald en geupdated.

Om dit project toch live op je systeem uit te proberen moet je de volgende stappen volgen:
1. Download de laatste versie van dit project, door op de 'Clone or Download' knop te drukken om het project (als zip bestand) te downloaden.
2. Zorg ervoor dat je op je systeem **Apache** en **MySQL** geinstalleerd hebt (Ik maak zelf gebruik van AMPPS, dat gemakkelijk en handig in gebruik is. Daarnaast heeft het allebei in 1 plek, waardoor het makkelijker aan en uit te zetten is). 
      * Als je gebruikt maakt van AMPPS, moet je ervoor zorgen dat je onder het kopje 'configure > Add domain', het domein `utasks.me` met de locatie van de bestand toevoegd. Hierdoor zorg je ervoor dat alle links goed doorverbinden (zonder kan het voorkomen dat je naar `utasks.me` wordt gestuurd, maar er een error voorkomt, omdat het niet geregistreerd is in AMPPS).
3. Pak de hoofdfolder uit in je localhost (de plek waar je de websites in stopt).
4. Voor gemakkelijkere gebruik kan je ook nog in het 'hosts' bestand op je pc de het domein toevoegen, waardoor je in je browser automatisch het webadres kan invoegen zonder eerst localhost ervoor te zetten.
Het volgende moet dan in je 'hosts' bestand staan (dit zorgt er uiteindelijk ook voor dat alle paginas goed doorsturen naar de lokale locatie van je bestanden): <pre>127.0.0.1 utasks.me</pre>
5. Ga naar je phpmyadmin configuratie (bijvoorbeeld: localhost/phpmyadmin) en maak de volgende twee databases aan: UTasksDAT en UTasksMAIN. Maak daarna een nieuwe database gebruiker aan (naam: UTasks, wachtwoord: UTasks) en zorg ervoor dat hij alle rechten heeft op **beide databases** door zijn rechten aan te passen (Edit Privileges > Database > Add privileges on following databases > Grant all & Go in phpmyadmin).
6. Importeer beide bestanden in de juiste databases (UTasksDAT.sql in UTasksDAT en UTasksMAIN.sql in UTasksMAIN database).
7. Ga naar de <a href="http://utasks.me" target="_blank">homepagina</a> of <a href="http://utasks.me/login" target="_blank">login pagina</a> en log in met de volgende informatie:
<pre>Gebruikersnaam: admin / Email: admin@utasks.me, wachtwoord: adminpassword
Gebruikersnaam: normal / Email: normal@utasks.me, wachtwoord: normalpassword</pre>

## Database layout
<details>
  <summary>Bij dit project heb ik de volgende database layout gebruikt</summary>
  <pre>UTasksDAT: label*userid* & tasks*userid* (per gebruiker 2 eigen tabellen)
UTasksMAIN: premiumreq, questions, users, usersclosed & usersnew</pre>
</details>
