<?php
/**
* @version $id: english.php,v 2.3
* @package performs
* @copyright (c) 2007 perForms
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author David Walters
* @author (original) Ilhami KILIC http://www.tuwitek.at
* Joomla is Free Software
* 
* Hvis you are translating, be sure to download the very latest
* english.php, available from http://www.performs.org.au/performs/nightly/english.php.txt
* Dansk overs�ttelse - Britt Frederiksen kontakt@bagge-web.dk
*/
defined( '_VALID_MOS' ) or die( 'Direkte adgang til dette sted er ikke tilladt');
if (defined("WELCOME_TO_PERFORMS")) return;

define("FORM", "Formular");
define("SUBMIT_LABEL","Send");
define("PUBLISH","Publicer");
define("UNPUBLISH","Publicer ikke");
define("NAME","Navn");
define("LINK","Link");
define("ITEMS","Element");
define("DB_TABLE_NAME","DB Tabelnavn");
define("DB_RECORDS","DB data");
define("PUBLISHED","Publiceret");
define("UNPUBLISHED","Ikke publiceret");
define("SECURITYIMAGESHELP","Hj�lpetekst sikkerhedsbillede");
define("SECURITYIMAGESERROR","Fejlbesked sikkerhedsbillede");

define("FORM_PREVIEW","Formular forh�ndsvisning");
define("DATE_TIME","Dato");
define("NO_RECORDS_FOUND","Ingen data blev fundet!");
define("FIELD_NAMES","Feltnave");
define("SELECT_FIELDS","V�lg de felter, som du �nsker din rapport skal indeholde..");
define("ALL","Alle");
define("INCLUDED_FIELDS","Inkluderede felter");
define("UP","Op");
define("DOWN","Ned");
define("_PRINT","Print");

define("USE_SECURITYIMAGES","Anvend sikkerhedsbillede");
define('NO_SI_INSTALLED', 'com_securityimages not installed', "sikkerhedsbillede er ikke installeret");
define('NO_SI_INSTALLED_INFO', '<ul><li>Hent komponenterne fra<a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/">Joomla! Extensions</a></li><li>PerForms kan ogs� fungere fint uden komponenterne.</li></ul>');
define("EDIT_FORM","Rediger formular");
define("ADD_EDIT_REMOVE","Tilf�j, Rediger eller Fjern Elementer i Formularen");
define("CAPTION","OverskrHvist");
define('USE_CAPTION',"Anvend overskrHvist");
define('FIELD_SEPARATOR', "Feltadskillese");
define('FIELD_SEPARATOR_INFO', "N�r denne formular overf�res til e-mail eller til tekst, vil dette tegn blive anvendt til at v�lge mellem v�rdierne.");
define('USE_CAPTION_INFO', "N�r denne formular overf�res til e-mail, vil PerForms printe feltnavne ved siden af v�rdierne");
define('FORMAT_TAB',"Format");
define('FORMAT_INFO', "Rapport- og e-mailsformatering");
define("TYPE","Elementtype");
define("ORDER","Sorter");
define("REORDER","Omsorter");
define('INSERT', "Inds�t");
define('REMOVE', "Fjern");
define('SET_AS_SELECTED', "Marker som valgt");
define("VALUE","V�rdi");
define("EDIT_ITEM","Rediger Element");
define("EDIT","Rediger");
define("_NEW","Ny");
define("FORM_DETAILS","Formulardetaljer");
define("TITLE","Titel:");
define("INTRO_TEXT","Introtekst:");
define("AFTER_SUBMIT","Efter send:");
define("REDIRECT_TO_URL","Omadresser til URL");
define("SHOW_TNX_TEXT","Vis takketekst");
define("REDIRECT_URL","Omadresser URL:");
define("TNX_TEXT","Takketekst:");
define("PUBLISHING_TAB","Publiceret");
define("PUBLISHING_INFO","Publiceringsinformation");
define("ACCESS","Adgang");
define("START_PUBLISHING","Begynd Publicering");
define("FINISH_PUBLISHING","Afslut Publicering");
define("IMAGES_TAB","Billeder");
define("IMAGE_INFO","Billedeinformation");
define('IMAGE_INFO_INFO',"For at anvende et standard billede her, upload dit billede her".$mosConfig_live_site."/images/stories");
define("IMAGE","Billede");
define("THEMES_TAB","Temaer");
define("THEME_INFO","Temainformation");
define("THEME","Tema");
define("BUTTONS_TAB","Knapper");
define("FORM_BUTTONS","Formularknapper");
define("SUBMIT_LABEL_TITLE","Titel til send-ikon");
define("INCLUDE_RESET","Inkluder nulstillingsknap");
define("INCLUDE_PF","Inkluder printervenlig knap");
define("INCLUDE_PDF","Inkluder PDF - knap");
define('INCLUDE_PF_INFO',"PerForms vil indeholde en printervenlig knap med formularens header og tillade, at den bliver set alene i et popup-vindue.");
define('INCLUDE_PDF_INFO',"PerForms vil indeholde en PDF-knap med formularens header, n�r den bliver vist.");
define('NO_PDF_INSTALLED', 'Html2PDF er ikke installeret. PerForms vil ikke have en PDF-knap til r�dighed.');
define('NO_PDF_INSTALLED_INFO', '<ul><li>Get it from <a href="http://sourceforge.net/projects/html2fpdf">SourceForge</a></li><li>Performs vil fungere fint uden denne knap.</li></ul>');
define("RESET_LABEL","Nulstillingsknap");
define("EMAILS_TAB","E-Mails");
define("EMAIL_FORM_TITLE","Titel p� e-mail");
define("EMAIL_FORM","E-mailformular:");
define('EMAIL_FORM_INFO', "Hvis ja, s� vil PerForms sende en e-mail, n�r denne formular er sendt.");
define('EMAIL_ADMIN', "Send kopi til administrator.");
define('EMAIL_ADMIN_INFO', "Hvis ja, s� vil Performs sende en kopi af e-mailen til adressen \&apos;to\&apos; felt- hvis feltet er blankt og \&apos;Email Form\&apos; is \&apos;yes\&apos;, en e-mail bliver sendt til administratorens websted.");
define('EMAIL_USER', "Send kopi til bruger");
define('EMAIL_USER_INFO', "Hvis ja, Performs vil sende en e-mail til brugeren, som har udfyldt formularen. Bem�rk, at dette vil virke automatisk med brugere, som har logget sig ind. Hvis du har elementer, som hedder <b>\&apos;replyto\&apos;</b> and <b>\&apos;replytoName\&apos;</b> s� vil disse elementers v�rdier blive anvendt. De vil v�re skjult for brugere, som er logget ind under standard. Bes�gende til denne side m� oplyse deres e-mailadresse p� formularen <b>\&apos;replyto\&apos;</b> and <b>\&apos;replytoName\&apos;</b> som vil v�re synlige for enhver bruger, som ikke er logget ind, hvis de er elementer p� formularen.");
define('ENABLE_MAILFROM', "Tillad mail-spoofing");
define('ENABLE_MAILFROM_INFO', "Hvis ja, PerForms vil fors�ge at sende en besked til administratoren ved at bruge en v�rdi fra feltet kaldet <b>\&apos;mailfrom\&apos;</b> i Fra-feltet: del af e-mail, hvis <b>\&apos;mailfrom\&apos;</b> er et element p� formularen. Ikke alle e-mail-servere er glade for det, s� standard er \&apos;no\&apos;");

define("EMAIL_ALWAYS", "Send selvom der er fejl");
define('EMAIL_ALWAYS_INFO', "Hvis ja, s� vil PerForms ignorere fejlen og sende e-mailen alligevel");
define("FROM","From: <small>(blank to use site default)</small>", "Fra: <small>(blank to use site default)</small>");
define('FROM_INFO', "Hvis du �nsker at sende <b>svaret-til</b>) til e-mailadressen  til brugeren af fomularen, s� lad det �verste parameter v�re blankt. Tilf�j i stedet for en e-mail i capture-tekstfelt til din formular (element-ikon) og sikr at <b>Navn<b>er sat til <b> at svare </b>");
define("TO","Til: <small>(comma separated list)</small>");
define('TO_INFO', 
'Hvis du �nsker, at <b>mail-to</b> e-mailadressen skal blive valgt af brugeren, som udfylder formularen (hvilket er praktisk hvis du har til hensigt \&apos;re at lave en dropdown-liste for hver modtager af e-mail) s� skal du tilf�je <b>mail-to</b> til e-mailadressen i parameteren ovenover som normal (for at blive brugt som standard send adresse) Derefter tilf�j en valgliste til din formular (element-ikon) med valgbare e-mailadresser for hver modtager og sikr, at <b>navnet</b> er sat til <b>mailto</b>');
define("EMAIL_SUBJECT","E-mail_emne:");
define('EMAIL_SUBJECT_INFO', 
'Hvis du �nsker at <b>Emne</b> p� e-mailen skal v�re unikt (eller skal laves af brugeren, som udfylder formularen) s� efterlad <b>Emne</b> parameter ovenover blankt. Tilf�j i stedet for et emne til capture-feltet til din formular (element-ikon) og sikr, at <b>Navn</b> er sat til <b>emne</b>. Du kan som alternativ tilf�je et emne ovenover og stadig have et emne i capture-feltet i din formular, s� det ovenst�ende emne vil blive vedh�ftet det emne, som er tilf�jet af brugeren.');
define("INTRO_INCLUDE","Inkluder introtekst:");
define('INTRO_INCLUDE_INFO', "Hvis ja, s� vil formularen  blive inkluderet i e-mailen");
define('APPEND_TIMESTAMP', "Angiv tidsangivelse");
define('APPEND_TIMESTAMP_INFO', "Hvis ja, s� vil e-mail-emnet blive p�f�rt dato og klokkes�t p� formularen, n�r den bliver sendt.");

define("TABLE_ALREADY_CREATED","Tabel er allerede oprettet..");
define("CREATE_DATABASE_TABLE","Opret databasetabel..");
define("NOT_BOUND_TO_TABLE", "Denne formular er i �jeblikket ikke tilf�jet til en databasetabel");
define("BOUND_TO_TABLE", "Denne formular er i �jeblikket tilf�jet til en databasetabel. Tabelnavn: ");
define("BOUND_INFO1", "N�r du tilf�jer en tabel til en formular, s� kan du <strong>ikke</strong>tilf�je, redigere eller slette elementer i formularen." );
define("BOUND_INFO2", "Tabelnavn<strong>m� ikke</strong> indeholde mellemrum, punktummer eller specielle tegn.");
define("TABLE_NAME","Tabelnavn:");

define("DELETE_FORM_INFO1","Denne formular er allerede tilf�jet til '%s'");
define("DELETE_FORM_INFO2", "Hvis du sletter tabellen, vil alle data g� tabt, og tabellen vil alts� v�re slettet.");
define("DELETE_FORM_INFO3","DER ER INGEN MULIGHEDER FOR AT GENSKABE DEN INFORMATION SOM ER BLEVET SLETTET!");
define("DELETE_TABLE", "Slet tabel?");
define("FORM_ITEMS_DETAILS","Formular Elementdetaljer");
define("NO_SPECIAL_CHARS", "Ingen mellemrum, punktummer eller specielle tegn!");
define("CHECK","Check");
define("HELP_TEXT","Hj�lpetekst");
define("ERROR_MSG","Fejlbesked");
define("DISPLAY_TAB","Vis");
define("DISPLAY_PROP","Visningsegenskaber");
define("SIZE1","St�rrelse 1");
define("SIZE2","St�rrelse 2");
define('SIZE1_INFO', "Bredde, kolonner");
define('SIZE2_INFO',"Height, Rows, <br/>Max Upload Size (bytes)");
define("REQUIRED","P�kr�vet");
define('REQUIRED_INFO',"PerForms vil ikke tillade, at formularen vil blive sendt, medmindre at feltet er udfyldt.");
define("DISABLED","Ude af funktion");
define("READONLY","L�s kun");
define("MULTIPLE","Mangfoldigg�r");
define('MULTIPLE_INFO', "Kan anvendes med \&apos;Select\&apos; elementer");
define("VALUES_TAB","V�rdier");
define('VALUES_INFO',"V�rdiinformation");
define("MISSING_FIELD_TEXT","Mangler tekst i felt:");

// Errors
define("ITEMS_CANT_EDITED", "Elementer i denne formular kan ikke redigeres!");
define("FORM_CURRENTLY_EDITED", "Denne formular %s bliver i �jeblikket redigeret af en anden administrator." ) ;
define("NO_FORM_FOUND","Ingen formular blev fundet.");
define("SELECT_A_RECORD_TO", "V�lg et dokument til %s");
define("ALREADY_TABLE_EXISTS","Tabellen \'s%\' eksisterer allerede, v�lg venlingst et andet navn.");
define("ERROR_OCCURRED","Der er opst�et en fejl!");
define("DB_ERROR_OCCURRED","Der er opst�et en skrivefejl til databasen!");
define("TITLE_EMPTY","Titlen mangler!");
define("TABLE_NAME_EMPTY", "Du skal angive et tabelnavn.");
define("DELETE_DATA_CONFIRM", "Vil du allerede slette ALLE DATA?");
define("CAPTION_EMPTY","Overskrift mangler!");
define("NAME_EMPTY","Navn mangler!");
define("LIST_VALUES","Liste over v�rdier");
define("SELECTED_VALUE","Valgt v�rdi");
define('SELECTED_VALUE_INFO', "Den f�rstvalgte v�rdi af elementet");

define("PF_ERROR_18", "M�det er ikke vedvarende.");
define("PF_ERROR_18_COMMENT", 
       
      "<br /><ul><li>Kan l�ses ved at trykke p� browserens tilbage-knap og "
       ."pr�ve igen. <cite>Forl�bet skal m�ske genstartes.</cite><br /></li>"
       .'<ul><li>Opst�r ogs� n�r joomla global konfigurationsindstillingernes "Live Site" '
       .'protokol ikke matcher den nuv�rende protokol (http / https)<br />'
       .'Se <a href="http://forge.joomla.org/sf/go/post17630">'
       .'http://forge.joomla.org/sf/go/post17630</a></li><br />'
       .'<br /><li>Ogs� en midlertidig fejl n�r en bruger logger ud af et joomla- '
       .'m�de, og pr�ver p� at vise en printervenlig formular ved at klikke p� '
	     .'linket i toppen af formularen (i "joomla mode") - nogle gange '
       .'begynder m�der ikke med det samme... fordi the workaround er for t�t p�'
       .' det printervenlige vindue, og klik p� menu-elemenet igen ( for at f�  '
       .'formularen frem), s� klik p� den  '
       ."printervenlige knap, og popup'en burde virke.</li></ul>"
        );       
define("PF_ERROR_22", "Dette formularnummer er ikke et tal");
define("PF_ERROR_22_COMMENT",
	   'Normalt for�rsaget af link til url, der ikke virker'  
       .'See <a href="http://forge.joomla.org/sf/go/post17395">'
       .'http://forge.joomla.org/sf/go/post17395</a>'
	   );

define("PF_ERROR_23",  "Ingen formular fundet");
define("PF_ERROR_23_COMMENTA", "En formular med id'et");
define("PF_ERROR_23_COMMENTB",
       @"cannot be found.<ul>
<li>Du har m�ske ikke tilladelse til at se denne ressource, eller
<li>denne formular er m�ske udl�bet, ikke publiceret eller fjernet. 
</ul>");
define("FOR_MORE_HELP", 'For mere hj�lp til bruge PerForms, se '
       .'the PerForms hjemmeside, p� <a href="http://www.performs.org.au/"> '
       .'performs.org.au</a>');

define("PF_ERROR_127",  "Ugyldig parameterliste");
define("PF_ERROR_127_COMMENT",
       'Normalt for�rsaget af manglende parameter til et "komponent" menuelement. '
       .'<ul><li>Husk at tilf�je<strong>formid=1</strong>til listen over '
       ."parametre (eller id'et svarende til den formular du �nsker vist)"
       .'</li></ul>');

define("PF_ERROR_71",  "Ude af stand til at skabe vejledning til oploadinger!");
define("PF_ERROR_71_INFO",  "Den best�ende vejledning til den formular er ugyldig eller er ude af stand til at blive skabt. Check venligst opload-stien i 'v�rdier'ikonet hos performs administrator.");

// MENU

define("DATABASE","Database");
define("BOUNDDATA","Data");
define("EXPORTTOEXCEL","Udf�r");
define("PREVIEW","Forh�ndsvisning");
define("CLOSE","Luk");
define("CANCEL","Annuller");
define("DELETE","Slet");
define("COPY_RECORD","Kopier");
define("NEW_ITEM","Nyt element");
define("DELETE_ITEM_CONFIRM","Slet Element?");
define("SAVE","Gem");

define("PRINTER_FRIENDLY", "Printervenlig");
define("DOWNLOAD_PDF", "Download PDF");
define("ACCESSKEY", "Adgangsn�gle" );

define('PLEASE_FILL_OUT', 'V�r venlig at udfylde!');
define('BINDING', 'Forbinder');
define('EDIT_ITEMS', 'Rediger elementer');
define('UPGRADE_NEWS', 'Upgrader Nyheder');
define('IS_AVAILABLE', 'Er tilg�ngelig');
define('DOWNLOAD_FROM', 'Download fra');

define('SEP_COMMA', 'komma');
define('SEP_COMMASPACE', 'komma+mellemrum');
define('SEP_HYPHEN', 'bindestreg');
define('SEP_NEWLINE', 'ny linie');
define('SEP_SPACE', 'mellemrum');

define('TY_EMAIL', 'e-mail');
define('TY_FLOAT', 'flytbar komma');
define('TY_INTEGER', 'det hele');
define('TY_NAME', 'navn');
define('TY_STRING', 'tegnr�kke');
define('TY_URL', 'url');

define('ITEMTYPE_BUTTON', 'knap');
define('ITEMTYPE_CHECKBOX', 'checkboks');
define('ITEMTYPE_DATE', 'dato');
define('ITEMTYPE_FILE', 'fil');
define('ITEMTYPE_HIDDEN', 'skjult');
define('ITEMTYPE_IMAGE', 'billede');
define('ITEMTYPE_PASSWORD', 'kodeord');
define('ITEMTYPE_PAGEBREAK', 'sideskift');
define('ITEMTYPE_RADIO', 'radio');
define('ITEMTYPE_SELECT', 'v�lg');
define('ITEMTYPE_TEXT', 'tekst');
define('ITEMTYPE_TEXTAREA', 'tekstomr�de');
define('ITEMTYPE_TEXTUAL', 'tekstuelt');

define('VALUE_UP', "0p");
define('VALUE_UP_INFO', "Flyt det valgte element op p� listen.");
define('VALUE_DOWN', "Ned");
define('VALUE_DOWN_INFO', "Flyt det valgte element ned p� listen.");
define('SET_AS_SELECTED_INFO', "Performs vil tr�kke html-element fra formularen med det element, som oprindeligt er valgt.");
define('REMOVE_INFO',  "Fjern den valgte mulighed fra listen over v�rdier.");

define('DISABLED_INFO',  "Hvis ja, vil perForms ikke tr�kke dette element.");
define('READONLY_INFO', "Hvis ja,  vil perForms tr�kke dette element som et l�s-kun-element, som ikke kan udfyldes.");
define('VALUE_INFO',"Inds�t en v�rdi i dette felt og tryk p� INDS�T-knappen for at tilf�je den til listen.<br /><br /> For <strong>".ITEMTYPE_FILE."</strong> elementer, inds�t standard oploadningsstien her med en stiseparator <br />(eg <code>/path/to/uploads/</code> or <code>c:\\\uploading\\\</code>).");

define('SUBMIT_LABEL_INFO', "Denne tekst vises p� formularen \&apos;<b>send</b>\&apos; knap.");
define('INCLUDE_RESET_INFO', "Hvis ja, vil perForms inkludere en \&apos;<b>nulstillings</b>\&apos; -knap p� formularen.");
define('RESET_LABEL_INFO', "Teksten vises p� \&apos<b>nulstillings</b>\&apos; knap.");
define('PUBLISHED_INFO', "Hvis ja, s� vil formularen v�re til r�dighed for brugerne af siden.");
define('ACCESS_INFO', "Definer adgangsniveauet for denne formular.");
define('START_PUBLISHING_INFO', "Datoen p� denne formular vil begynde at v�re til r�dighed for brugerne af siden.");
define('FINISH_PUBLISHING_INFO', "Datoen p� denne formular vil stoppe med at v�re til r�dighed for brugerne af siden. Hvis datoen er 0000-00-00 00:00:00  er formularen altid til r�dighed.");

define('CAPTION_INFO', "Teksten vil blive printet som caption til elementet.");
define('ACCESSKEY_INFO', "Adgangsn�glen vil blive forbundet elementet, som er kortlagt til en n�glekombination af en browser. S� en adgangsn�gle til \&apos;<b>k</b>\&apos; vil kortl�gges til crtl-shift-k i firefox, alt-shift-k i internet explorer.");
define('NAME_INFO', "Det interne navn p� dette element m� ikke indeholde nogen ikke-alfa-karakterer. Hvis dette element kaldes  <b>bcc, cc, mailfrom, mailto, replyto </b>or<b> replytoName</b> vil v�rdien automatisk blive brugt til at sende en e-mail, i s� fald formularen er sat til at sende e-mails.");
define('TYPE_INFO', "V�lg en type af elementer, fra listen. Forskellige elementtyper underst�tter forskellige egenskaber.<br /><ul><li>The <b>".ucfirst(ITEMTYPE_TEXTAREA)."</b> bruger St�rrelse1 og St�rrelse2 for at definere dets bredde og h�jde.<br /></li><li>The <b>".ITEMTYPE_SELECT.", ".ITEMTYPE_RADIO." </b>and<b> ".ITEMTYPE_CHECKBOX."</b> typer skal have mindst en v�rdi elementet ".VALUES_TAB." list.<br /></li><li>The <strong>".ucfirst(ITEMTYPE_FILE)."</strong> element anvender <strong>St�rrelse1</strong> til bredden p� filnavnboksen, <strong>St�rrelse2</strong> til at definere den maksimale upload-st�rrelse og <strong>V�rdi</strong> for upload-stien (hvor de uploadede filer bliver opbevaret).</li></ul>");
define('CHECK_INFO', "V�lg en v�rdi for dette element. V�lges den blanke v�rdi, vil alle typer af data v�re tilladt.");
define('HELP_TEXT_INFO', "Hj�lpetekst vil vises med elementet.");
define('ERROR_MSG_INFO', "Fejlbesked vises, hvis der er et problem med elementet.");

define('REVERSE_ORDER', "Omvendt r�kkef�lge");
define('SAVE_ORDER', "Gem r�kkef�lge");
define('SWAP_SIZE_VARS', "Byt st�rrelse 1 og st�rrelse 2 for alle tekstomr�der-elementer");
define('NEW_SIZEVARS_SAVED', 'Ny st�rrelse gemt');
define('NEW_ORDERING_SAVED', 'Ny r�kkef�lge gemt');

define('PF_LICENCE_INFO', 'perForms er gratis software med licens fra the <a href="http://www.gnu.org/copyleft/gpl.html">GNU General Public License</a>.');
define('INSTALLATION_MESSAGES',  'Installationsbeskeder');
define('THANKS_FOR_CHOOSING', 'Tak, fordi du valgte PerForm.');
define('WE_NEED_TRANSLATORS', @"
<p>
PerForms er nu fuldst�ndig lokaliseret, og vi har brug for overs�ttere!  
<a href=\"http://forge.joomla.org/sf/go/projects.performs/discussion.language_file_translations\">Hj�lp med at g�re PerForms global!</a>
</p>");
define('FOR_SUPPORT', @"
<p><b>For support bes�g venligst den officielle supportside p� <a href=\"http://www.performs.org.au/\">http://www.performs.org.au/</a>.</b></p>
");
define('PERFORMS_FEATURES', @"
<p>Egenskaber som er inkluderede:</p>
<ul>
<li>Ubegr�nsede input-felter</li>
<li>V�lg mellem 9 felttyper</li>
<li>File Upload Egenskaber!</li>
<li>Formular til mail funktion</li>
<li>Bruger-sendt mail-from, reply-to og emne felter</li>
<li>V�lg at skabe en separat databasetabel for hver formular</li>
<li>Feltv�rdier</li>
<li>Tilg�ngelige formularer</li>
<li>Almindelige fejlbeskeder</li>
<li>Almindelige hj�lpetekster for hvert felt</li>
<li>Rapportside til at se data i tabellen</li>
<li>Basis templatesystem</li>
<li>Se / Export Captured Data i administrator</li>
<li>Se skrivbar version fra front end</li>
<li>Download PDF</li>
<li>Joomla 1.5 Ready</li>
</ul>
");
define('WELCOME_TO_PERFORMS', @"
<p>
PerForms g�r det let at lave almindelige formularer, som kan sendes med e-mail eller gemmes i en database. Resultater kan ses i admin eller downloades som csv.
</p>
".FOR_SUPPORT.PERFORMS_FEATURES.WE_NEED_TRANSLATORS);
define('NEW_FEATURES', @"
<strong>Nye Egenskaber: </strong>
<ul>
<li>Adgang</li>
<li>Admin info ikoner</li>
<li>Bunden Data Sider</li>
<li>Konfigurer</li>
<li>File Upload Felt</li>
<li>Venlige Fejl</li>
<li>Version Check</li>
</ul>
");
define('UPGRADE_MESSAGE', @"
<p>PerForms er blevet �ndret! 
<ol><li><p><img src=\"images/reload_f2.png\" height=\"16\" width=\"16\" border=\"0\" /> The <strong>".REVERSE_ORDER.@"</strong> knap.</p>Du kan se dine elementer i omvendt r�kkef�lge, for at ordne r�kkef�lgen, tryk blot  p� '<strong>"
       .REVERSE_ORDER."</strong>' knap i topppen af".ORDER.@" kolonen i elementoversigten.</li>
<li style=\"margin-top: 4pt;\"><p>
<img src=\"images/restore_f2.png\" border=\"0\" width=\"16\" height=\"16\" />
 The <strong>".SWAP_SIZE_VARS.@"</strong> button.</p>
Vi har �ndret m�den tekstomr�dernes elementer bruger St�rrelse1 and St�rrelse2, for at rette dine tekstomr�der,
klik p� '<strong>".SWAP_SIZE_VARS."</strong>' knappen i toppen af  ".SIZE1." og ".SIZE2.@" koloner.</li></ol></p>
".WE_NEED_TRANSLATORS.NEW_FEATURES.FOR_SUPPORT);


define('SUCCESSFUL_UPGRADE', "Vellykket upgradering til PerForms ");
define('INS_WELCOME', "Velkommen!");
define('INS_SQL_STATEMENTS', "SQL-kommandoer");
define('INS_SQL_ERRORS', "SQL-fejl");

define('UPLOAD_ERROR_1', "Den uploadede fil overskrider den maksimale uploadede_filst�rrelse for direktiv i php.ini.");
define('UPLOAD_ERROR_1_INFO', "Filen var st�rre end dens installation af php vil tillade.<ul><li> Sp�rg din php/joomla administrator om at �ge v�rdien  af upload_max_filesize.</li></ul>");
define('UPLOAD_ERROR_2', "Den uploadede fil overskrider den MAX_FILE_SIZE direktiv som blev angivet i HTML-formularen.");
define('UPLOAD_ERROR_2_INFO', "Administratoren har sat den maksimale uploadingsfilst�rrelse mindre end den st�rrelse, som din fil har.");
define('UPLOAD_ERROR_3', "Den uploadede fil blev kun delvis oploadet.");
define('UPLOAD_ERROR_3_INFO', "En fejl i forbindelsen for�rsaget, fordi filen er ufuldst�ndig p� serverens adresse. Pr�v venligst igen!");
define('UPLOAD_ERROR_4', "Ingen fil blev oploadet.");
define('UPLOAD_ERROR_4_INFO', "En ukendt tilstand har for�rsaget, at filen ikke blev oploadet.");
define('UPLOAD_ERROR_5', "Ukendt fejlbesked!.");
define('UPLOAD_ERROR_5_INFO', "Php-installation har svaret med et ikke-standard fejlkode!");
define('UPLOAD_ERROR_6', "Mangler en midlertidig mappe. Introduceret i PHP 4.3.10 og PHP 5.0.3.");
define('UPLOAD_ERROR_6_INFO', "Denne php-installation har ingen midlertidig mappe sat i php.ini.");
define('UPLOAD_ERROR_7', "Fejl ved skrivning af  fil til disk. Introduceret i PHP 5.1.0.");
define('UPLOAD_ERROR_7_INFO', "Serveren  er m�ske l�bet t�r for plads eller den midlertidige henvisning er l�s-kun.");

define('SUCCESS', "Succes!");
define('UPLOAD_SUCCESSFUL', "Filen er gyldig og vellykket uploadet.\n");
define('UPLOAD_SUCCESSFUL_INFO', "Filen er blevet uploadet og placeret i mappehenvisning, ventende p� administratoren.");
define('ERROR_71', "Muligt angreb af filupload!\n");
define('ERROR_71_INFO', "Navnet p� filen eller stien er ikke gyldig!");

define('UNKNOWN_SENDER', "Ukendt afsender");

define('IMAGEFLOAT', "Billede Float Stil");
define('IMAGEFLOAT_INFO', "S�t float stil p� billedet (css float: [left, right, none, inherit];)");
define('FLOAT_LEFT', 'Venstre');
define('FLOAT_RIGHT', 'H�jre');
define('FLOAT_NONE', 'Ingen');
define('FLOAT_INHERIT', 'Arvet');

define('NOT_BOUND', "Ikke forbundet!");
define('CLICK_BINDING_BUTTON', "Klik p� <b>Binding</b>knappen for at tilf�je en ny databasetabel.");

define('SHOW_UPLOADED_IMAGE', "Vis oploaded billede");
define('SHOW_UPLOADED_IMAGE_INFO', "N�r brugerens input vises via e-mail, kan filelementer blive vist som et link eller som et billede.");

define('SUBMIT', "Send");
define('REPLACE_SUBMIT_BUTTON', "Erstat sendeknap");
define('REPLACE_SUBMIT_BUTTON_INFO', "Erstat formularens standard sendeknap med et billede.");
define('SUBMIT_IMAGE_URL', "Send Billede Url");
define('SUBMIT_IMAGE_URL_INFO', "En url-henvisning til billedet, som vil blive brugt til at erstatte standard sendeknappen");
define('SUBMIT_IMAGE_WIDTH', "Send Billede Bredde");
define('SUBMIT_IMAGE_WIDTH_INFO', "Bredden p� billedet vil blive brugt til at erstatte standard sendeknappen.");
define('SUBMIT_IMAGE_HEIGHT', "Send Billede H�jde ");
define('SUBMIT_IMAGE_HEIGHT_INFO', "H�jden p� billedet vil blive brugt til at erstatte standard sendeknappen.");

define('RESET', "Nulstil");
define('REPLACE_RESET_BUTTON', "Erstat nulstillingsknap");
define('REPLACE_RESET_BUTTON_INFO', "Erstat  formularens standard nulstillingsknap med et billede." );
define('RESET_IMAGE_URL', "Nulstil billede url");
define('RESET_IMAGE_URL_INFO', "En url, der linker til billedet, vil erstatte standard nulstillingsknappen");
define('RESET_IMAGE_WIDTH', "Nulstil billede bredde");
define('RESET_IMAGE_WIDTH_INFO', "Bredden p� billedet som er brugt til at erstatte nulstillingsknappen.");
define('RESET_IMAGE_HEIGHT', "Nulstil Billede H�jde");
define('RESET_IMAGE_HEIGHT_INFO', "H�jden p� billedet bliver brugt til at erstatte nulstillingsknap.");

define('NOT_AUTHORIZED', "Du har ikke tilladelse til at se denne ressource.");
define("NO_AUTH_MESSAGE", "Ulovlig besked");
define("NO_AUTH_MESSAGE_INFO", "Beskeden vil blive vist af formularen, n�r en ulovlig bruger pr�ver p� at se den.");

define('USE_CONTAINER', "Anvend beholder");
define('USE_CONTAINER_INFO', "N�r en PerForms formular vises, vil standard beholderen blive anvendt, hvis der svares ja. Hvis svaret er nej, kan PerForms formular blive brugt til individuelt at erstatte ord i en s�tning, for eksempel.");
define('SHOW_FORM_TITLE', "Vis titel p� formular");
define('SHOW_FORM_TITLE_INFO', "When showing perForms as a component, sets the title display on/off.", "N�r PerForms vises som en komponent, s�ttes titlen p� visningen som markeret/umarkeret.");
define('FORM_WIDTH', "Bredde p� formular");
define('FORM_WIDTH_INFO', 'Bredden p� formularen n�r den bliver vist. Kan v�re &quot;100px&quot; eller &quot;35%&quot; etc.');
define('FORM_DISPLAY', "Visning af formular");
define('PRESENTATION_INFO', "Pr�sentation");
define('INCLUDE_SUBMIT', "Inkluder sendeknap");
define('INCLUDE_SUBMIT_INFO', "Vis sendeknappen p� formularen.");
define('MAIL_AS_TEXT', "E-mail som tekst");
define('MAIL_AS_TEXT_INFO', "Hvis ja, vil PerForms sende formularens data som r� tekst, men husk, at hvis du skal inkludere en introtekst i din formularmail, s� vil den ikke blive...som html." );

define('EXTRA_RECIPIENTS', "Ekstra modtagere");
define('MAIL_OPTIONS', "E-mail-valgmuligheder");

define("CAPTIONCSSCLASS","Caption CSS class(es)");
define('CAPTIONCSSCLASS_INFO',"If set, the caption will be surrounded by a div tag, which has its CSS class attribute to this value.");
define("VALUECSSCLASS","Value CSS class(es)");
define('VALUECSSCLASS_INFO',"If set, the value will be surrounded by a div tag, which has its CSS class attribute to this value. If the form item has more than one value (such as a radio button), the entire set of values will be surrounded by the div.");
define("INFOCSSCLASS","Help CSS class(es)");
define('INFOCSSCLASS_INFO',"If set, the help text will be surrounded by a div tag, which has its CSS class attribute to this value.");
define("ERRORCSSCLASS","Error CSS class(es)");
define('ERRORCSSCLASS_INFO',"If set, an error message related to this form item will be surrounded by a div tag, which has its CSS class attribute to this value.");


//define("Delete","Slet");
/*
PFAUTO_ fields can be embedded into any text part of a form or form item
Where there can be text, an expression enclosed in braces, ilke {username}
will return the "Auto" field for PFAUTO_USERNAME
*/
define('PFAUTO_USERNAME', "brugernavn");
define('PFAUTO_NAME', "navn");
define('PFAUTO_USERTYPE', "brugertype");
define('PFAUTO_REGISTERDATE', "registreringsdato");
define('PFAUTO_LASTVISITDATE', "sidste bes�gsdato");
define('PFAUTO_USEREMAIL', "brugerens e-mail");
/*
The $_PFAUTO array is an associative list (map) of replacements.
Where there can be text, an expression enclosed in braces, starting with an 
equals sign, will be evaluated from the map.
Eg. "{=PF_FIELD_NAME}" will become "Name"
*/
global $_PFAUTO;
$_PFAUTO = array ( 
	"usertype" => "USER TYPE",
	"name" => "Name",/*your variable names need not be so formal*/
	"address" => "Address" );



?>