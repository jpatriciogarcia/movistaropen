<?php
/**
* @version $id: hungarian.php,v 2.3
* @package performs
* @copyright (c) 2007 perForms
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author David Walters
* @author (original) Ilhami KILIC http://www.tuwitek.at
* Joomla is Free Software
* 
* Hungarian (formal) translation
* Translated by Jozsef Tamas Herczeg, www.joomlandia.eu
*
*/
defined( '_VALID_MOS' ) or die( 'A k�zvetlen hozz�f�r�s ehhez a helyhez nem ened�lyezett.' );
if (defined("WELCOME_TO_PERFORMS")) return;

define("FORM", "�rlap");
define("SUBMIT_LABEL","K�ld�s");
define("PUBLISH","k�zz�t�tel");
define("UNPUBLISH","visszavon�s");
define("NAME","N�v");
define("LINK","Hivatkoz�s");
define("ITEMS","Elemek");
define("DB_TABLE_NAME","DB t�blan�v");
define("DB_RECORDS","DB rekordok");
define("PUBLISHED","K�zz�t�ve");
define("UNPUBLISHED","Visszavonva");
define("SECURITYIMAGESHELP","Biztons�gi k�d s�g��zenete");
define("SECURITYIMAGESERROR","Biztons�gi k�d hiba�zenete");

define("FORM_PREVIEW","�rlap el�n�zete");
define("DATE_TIME","D�tum");
define("NO_RECORDS_FOUND","Nem tal�lhat�k rekordok!");
define("FIELD_NAMES","Mez�nevek");
define("SELECT_FIELDS","Jel�ld ki azokat a mez�neveket, melyeket bele k�v�nsz venni a jelent�sbe.");
define("ALL","Mind");
define("INCLUDED_FIELDS","Belevett mez�nevek");
define("UP","Fel");
define("DOWN","Le");
define("_PRINT","Nyomtat�s");

define("USE_SECURITYIMAGES","Biztons�gi k�d haszn�lata");
define('NO_SI_INSTALLED', 'M�g nem telep�tetted a com_securityimages komponenst');
define('NO_SI_INSTALLED_INFO', '<ul><li>Szerezd be a <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/">Joomla! Extensions</a> weblapon</li><li>A perFormst n�lk�le is haszn�lhatod.</li></ul>');
define("EDIT_FORM","�rlap szerkeszt�se");
define("ADD_EDIT_REMOVE","�rlapelemek hozz�ad�sa, szerkeszt�se vagy elt�vol�t�sa");
define("CAPTION","C�m");
define('USE_CAPTION',"Felirat haszn�lata");
define('FIELD_SEPARATOR', "Mez�elv�laszt�");
define('FIELD_SEPARATOR_INFO', "Az �rlap adatainak emailbe vagy sz�vegbe t�rt�n� kivitelekor ezt a karaktert haszn�lja a v�laszthat� �rt�kek k�z�tt.");
define('USE_CAPTION_INFO',"Az �rlap adatainak emailbe t�rt�n� kivitelekor a perForms kinyomtatja az �rt�k melletti sz�vegneveket.");
define('FORMAT_TAB',"Form�tum");
define('FORMAT_INFO', "Jelent�s �s email form�tuma");
define("TYPE","T�pus");
define("ORDER","Sorrend");
define("REORDER","�trendez�s");
define('INSERT', "Besz�r�s");
define('REMOVE', "T�voli");
define('SET_AS_SELECTED', "Be�ll�t�s kijel�ltk�nt");
define("VALUE","�rt�k");
define("EDIT_ITEM","Szerkeszt�s");
define("EDIT","Szerkeszt�s");
define("_NEW","�j");
define("FORM_DETAILS","�rlap r�szletei");
define("TITLE","C�m:");
define("INTRO_TEXT","Bevezet� sz�veg:");
define("AFTER_SUBMIT","Tov�bb�t�s ut�ni m�velet:");
define("REDIRECT_TO_URL","�tir�ny�t�s URL-re");
define("SHOW_TNX_TEXT","K�sz�netnyilv�n�t�s megjelen�t�se");
define("REDIRECT_URL","�tir�ny�t� URL:");
define("TNX_TEXT","K�sz�n� sz�veg:");
define("PUBLISHING_TAB","K�zz�t�tel");
define("PUBLISHING_INFO","K�zz�t�tel r�szletei");
define("ACCESS","Hozz�f�r�s");
define("START_PUBLISHING","K�zz�t�tel kezdete");
define("FINISH_PUBLISHING","K�zz�t�tel befejez�se");
define("IMAGES_TAB","K�pek");
define("IMAGE_INFO","K�p r�szletei");
define('IMAGE_INFO_INFO',"Ha egyedi k�pet k�v�nsz haszn�lni, akkor t�ltsd azt fel a ".$mosConfig_live_site."/images/stories k�nyvt�rba");
define("IMAGE","K�p");
define("THEMES_TAB","T�m�k");
define("THEME_INFO","T�ma r�szletei");
define("THEME","T�ma");
define("BUTTONS_TAB","Gombok");
define("FORM_BUTTONS","�rlapgombok");
define("SUBMIT_LABEL_TITLE","A K�ld�s gomb felirata");
define("INCLUDE_RESET","Az Alaphelyzet gomb hozz�ad�sa");
define("INCLUDE_PF","A Nyomtat�bar�t gomb megjelen�t�se");
define("INCLUDE_PDF","A PDF gomb megjelen�t�se");
define('INCLUDE_PF_INFO',"A perForms elhelyezi a Nyomtat�bar�t gombot az �rlap fejl�c�vel, ez�ltal maga az �rlap megtekinthet� egy el�ugr� ablakban.");
define('INCLUDE_PDF_INFO',"A perForms elhelyezi a PDF gombot az �rlap fejl�c�vel, amikor megtekintik.");
define('NO_PDF_INSTALLED', 'M�g nincs telep�tve a FPDF. A perForms nem tudja megjelen�teni a PDF gombot.');
define('NO_PDF_INSTALLED_INFO', '<ul><li>Szerezd be a <a href="http://www.fpdf.org">www.fpfd.org</a> webhelyen</li><li>A perForms n�lk�le is kiv�l�an m�k�dik.</li></ul>');
define("RESET_LABEL","Az Alaphelyzet gomb felirata");
define("EMAILS_TAB","Email");
define("EMAIL_FORM_TITLE","�rlap k�ld�se emailben");
define("EMAIL_FORM","�rlap k�ld�se emailben:");
define('EMAIL_FORM_INFO', "Ha igen, akkor a perForms emailt fog k�ldeni az �rlap bek�ld�sekor.");

define('EMAIL_ADMIN',"M�solat k�ld�se az adminisztr�tornak:");
define('EMAIL_ADMIN_INFO', "Ha igen, akkor a perForms elk�ldi az email m�solat�t a \&apos;c�mzett\&apos; mez�ben megadott c�m(ek)re - ha a mez� �res, �s az \&apos;�rlap k�ld�se emailben\&apos; \&apos;igen\&apos;, akkor a webhely adminisztr�tora kap emailt.");
define('EMAIL_USER',"M�solat k�ld�se a felhaszn�l�nak:");
define('EMAIL_USER_INFO', "Ha igen, akkor a perForms k�ld emailt az �rlapot kit�lt� felhaszn�l�nak. Bejelentkezett felhaszn�l�k eset�ben ez automatikusan m�k�dik. Ha vannak <b>\&apos;replyto\&apos;</b> �s <b>\&apos;replytoName\&apos;</b> nev� elemek, akkor azoknak az elemeknek az �rt�kei ker�lnek felhaszn�l�sra. A bejelentkezett felhaszn�l�k sz�m�ra ezek alap�rtelmez�sk�nt rejtettek maradnak. A webhely l�togat�inak meg kell adniuk az email c�m�ket az �rlapon <b>\&apos;replyto\&apos;</b> �s <b>\&apos;replytoName\&apos;</b> l�that� lesz a nem bejelentkezett felhaszn�l�k sz�m�ra is, ha azok elemek az �rlapon.");
define('ENABLE_MAILFROM',"A lev�lcsapda enged�lyez�se:");
define('ENABLE_MAILFROM_INFO', "Ha igen, akkor a perForms megk�s�rli elk�ldeni az adminisztr�tornak az �zenetet a <b>\&apos;mailfrom\&apos;</b> nev� mez�ben l�v� �rt�k felhaszn�l�s�val az email FELAD�: r�sz�ben, ha a <b>\&apos;mailfrom\&apos;</b> egy elem az �rlapon. Nem minden levelez�si kiszolg�l� �r�l ennek, ez�rt a \&apos;no\&apos; az alap�rtelmez�s.");

define("EMAIL_ALWAYS","K�ld�s hiba eset�n is:");
define('EMAIL_ALWAYS_INFO', "Ha igen, akkor a perForms figyelmen k�v�l hagyja a hib�kat, �s mindenk�pp elk�ldi az emailt,");
define("FROM","Felad�: (hagyd �resen a webhely alap�rtelmez�s�nek haszn�lat�hoz)");
define('FROM_INFO', "Ha azt szeretn�d, hogy a felhaszn�l� t�ltse ki a <b>v�lasz</b> email c�mez az �rlapon, akkor hagyd �resen a fenti param�tert. Tegy�l ink�bb email c�m r�gz�t�mez�t az �rlapra (Elemek f�l), �s gy�z�dj meg r�la, hogy a <b>N�v</b> <b>mailfrom</b> lehet�s�gre van �ll�tva.");
define("TO","C�mzett: (vessz�vel elv�lasztott lista)");
define('TO_INFO', 'Ha azt szeretn�d, hogy a felhaszn�l� �gy v�laszthassa ki a <b>c�mzett</b> email c�met az �rlapon (�gyes dolog, ha a c�mzettek leg�rd�l� list�j�t tartalmaz� kapcsolatfelv�teli �rlapot k�sz�tesz), akkor a fenti param�terben add hozz� norm�lk�nt az (alap�rtelmezett k�ld�si c�mk�nt haszn�land�) <b>mail-to</b> email c�met. Ezut�n tegy�l v�laszt�list�t az �rlapra (Elemek f�l) mindegyik c�mzett sz�m�ra kiv�laszthat� email c�mmel, �s gy�z�dj meg r�la, hogy a <b>N�v</b> <b>mailto</b> lehet�s�gre van �ll�tva.');
define("EMAIL_SUBJECT","Az email t�rgya:");
define('EMAIL_SUBJECT_INFO', 'Ha azt szeretn�d, hogy az email <b>T�rgy</b> mez�je egyedi legyen (vagy a felhaszn�l� t�lthesse ki), akkor hagyd �resen a fenti <b>T�rgy</b> param�tert. Tegy�l ink�bb t�rgy r�gz�t�mez�t az �rlapra (Elemek f�l), �s gy�z�dj meg r�la, hogy a <b>N�v</b> v�laszthat�an <b>t�rgy</b>ra van �ll�tva, ha hozz�adsz egy fenti t�rgyat, �s ha t�rgy r�gz�t�mez�t is akarsz tenni az �rlapra, akkor a fenti t�rgy hozz�f�z�sre ker�l a felhaszn�l� �ltal be�rt t�rgyhoz.');
define("INTRO_INCLUDE","A bevezet� sz�veg besz�r�sa:");
define('INTRO_INCLUDE_INFO', "Ha igen, akkor az email tartalmazni fogja �rlap bevezet�j�t.");
define('APPEND_TIMESTAMP', "Id�b�lyegz�s hozz�f�z�se");
define('APPEND_TIMESTAMP_INFO', "Ha igen, akkor az email t�rgy�hoz hozz�f�z�sre ker�l az �rlap bek�ld�s�nek d�tum�t �s id�pontj�t.");

define("TABLE_ALREADY_CREATED","A t�bla l�trehoz�sa m�r megt�rt�nt...");
define("CREATE_DATABASE_TABLE","Adatb�zist�bla l�trehoz�sa...");
define("NOT_BOUND_TO_TABLE","Ez az �rlap jelenleg NEM kapcsol�dik egyik adatb�zist�bl�hoz sem.");
define("BOUND_TO_TABLE","Ez az �rlap jelenleg adatb�zist�bl�hoz kapcsol�dik. A t�bla neve: ");
define("BOUND_INFO1","Amikor hozz�kapcsolsz egy t�bl�t egy �rlaphoz, akkor <strong>nem</strong> adhatsz hozz�, m�dos�thatsz vagy t�r�lhetsz �rlapelemeket.");
define("BOUND_INFO2","A t�blan�v <strong>ne</strong> tartalmazzon sz�k�zt, pontot, sem m�s speci�lis karaktert.");
define("TABLE_NAME","T�bla neve:");

define("DELETE_FORM_INFO1","Ez az �rlap m�r a(z) '%s' t�bl�hoz kapcsol�dik" );
define("DELETE_FORM_INFO2","Ha t�rl�d ezt a t�bl�t, akkor valamennyi adat el fog veszni, �s a t�bla is t�rl�sre fog ker�lni.");
define("DELETE_FORM_INFO3","T�RL�S UT�N NINCS M�D EZEN INFOR�CI� VISSZA�LL�T�S�RA");
define("DELETE_TABLE","T�rl�d a t�bl�t?");
define("FORM_ITEMS_DETAILS","�rlapelemek r�szletei");
define("NO_SPECIAL_CHARS","Sz�k�z, pont vagy speci�lis karakter n�lk�l!");
define("CHECK","Ellen�rz�s");
define("HELP_TEXT","S�g�sz�veg");
define("ERROR_MSG","Hiba�zenet");
define("DISPLAY_TAB","Megjelen�t�s");
define("DISPLAY_PROP","Megjelen�t�s tulajdons�gai");
define("SIZE1","1. m�ret");
define("SIZE2","2. m�ret");
define('SIZE1_INFO',"Sz�less�g, Oszlopok");
define('SIZE2_INFO',"Magass�g, Sorok");
define("REQUIRED","K�telez�");
define('REQUIRED_INFO',"A perForms nem engedi az �rlap tov�bb�t�s�t, ha nem t�ltik ki ezt a mez�t.");
define("DISABLED","Letiltott");
define("READONLY","�r�sv�dett");
define("MULTIPLE","T�bb p�ld�ny");
define('MULTIPLE_INFO',"A \&apos;Select\&apos; elemekkel t�rt�n� haszn�lathoz.");
define("VALUES_TAB","�rt�kek");
define('VALUES_INFO','�rt�kek tulajdons�gai');
define("MISSING_FIELD_TEXT","Hi�nyz� mez� sz�vege:");

// Errors
define("ITEMS_CANT_EDITED","Nem m�dos�thatod ennek az �rlapnak az elemeit!");
define("FORM_CURRENTLY_EDITED","A(z) %s �rlapot �pp egy m�sik adminisztr�tor szerkeszti.");
define("NO_FORM_FOUND","Nem tal�lhat� �rlap!");
define("SELECT_A_RECORD_TO","V�laszd ki a rekordot a k�vetkez� m�velethez: %s");
define("ALREADY_TABLE_EXISTS","A t�bla \'%s\' m�r l�tezik. K�rj�k, hogy m�sik nevet adj neki.");
define("ERROR_OCCURRED","Hiba t�rt�nt!");
define("DB_ERROR_OCCURRED","Hiba t�rt�nt az adatb�zisba �r�skor!");
define("TITLE_EMPTY","�res a c�m!");
define("TABLE_NAME_EMPTY","Meg kell adnod a t�bla nev�t.");
define("DELETE_DATA_CONFIRM","Val�ban t�r�lni akarod AZ �SSZES ADATOT?");
define("CAPTION_EMPTY","A c�m �res.");
define("NAME_EMPTY","A n�v �res");
define("LIST_VALUES","Lista�rt�kek");
define("SELECTED_VALUE","Kijel�lt �rt�k");
define('SELECTED_VALUE_INFO',"Az elem kezdetben kiv�lasztott �rt�ke.");

define("PF_ERROR_18", "A munkamenet nem folyamatos.");
define("PF_ERROR_18_COMMENT", 
       "<br /><ul><li>A b�ng�sz� Vissza gombj�nak megnyom�s�val �s �jabb pr�b�val "
       ."megoldhat�. <cite>Lehet, hogy �jra kell ind�tani a munkamenetet.</cite><br /></li>"
       .'<ul><li>Akkor is elfordul, ha a Joomla glob�lis be�ll�t�sa, a "Live Site" '
       .'protokoll nem egyezik a jelenlegi protokollal (http / https)<br />'
       .'Keresd fel a <a href="http://forge.joomla.org/sf/go/post17630">'
       .'http://forge.joomla.org/sf/go/post17630</a> c�met</li><br />'
       .'<br /><li>Rendszertelen hiba az is, amikor egy felhaszn�l� kijelentkezik egy Joomla '
       .'munkamenetb�l, �s megpr�b�lja megjelen�teni a nyomtat�bar�t �rlapot az '
       .'�rlap fejl�c�ben l�that� hivatkoz�sra kattintva ("joomla m�dban") - a munkamenetek '
       .'nincsenek mindig azonnal inicializ�lva... a megold�s a nyomtat�bar�t ablak '
       .'bez�r�sa, majd kattints ism�t a men�pontra (hogy el�hozd '
       .'az �rlapot), ezut�n kattints a '
       .'nyomtat�bar�t gombj�ra, �s az el�ugr� ablaknak m�k�dnie kell.</li></ul>'
       );       
define("PF_ERROR_22", "Nem numerikus �rlap azonos�t�sz�m.");
define("PF_ERROR_22_COMMENT",
       '�ltal�ban hib�s URL okozza. '
       .'Keresd fel a <a href="http://forge.joomla.org/sf/go/post17395">'
       .'http://forge.joomla.org/sf/go/post17395</a> c�met');

define("PF_ERROR_23", "Nem tal�lhat� �rlap.");
define("PF_ERROR_23_COMMENTA", "Nem tal�lhat�");
define("PF_ERROR_23_COMMENTB",
       @"nem tal�lhat�.<ul>
<li>Nem enged�lyezhett�k a sz�modra ezen er�forr�s megtekint�s�t, vagy
<li>Ez az �rlap lej�rhatott, visszavonhatt�k vagy elt�vol�thatt�k.</ul>");
define("FOR_MORE_HELP", 'Ha tov�bbi seg�ts�gre van sz�ks�ged a perForms haszn�lat�hoz, '
       .'akkor keresd fel a perForms honlapj�t a <a href="http://www.performs.org.au/"> '
       .'performs.org.au</a> c�men');

define("PF_ERROR_127", "�rv�nytelen param�terlista.");
define("PF_ERROR_127_COMMENT",
       '�ltal�ban egy "Component" men�pont hi�nyz� param�tere okozza. '
       .'<ul><li>Ne feledd el felvenni a <strong>formid=1</strong> param�tert '
       .'a param�terlist�ra (vagy a megjelen�tend� �rlap megfelel� azonos�t�j�t).'
       .'</li></ul>');

define("PF_ERROR_71", "Nem hozhat� l�tre a felt�lt�sek k�nyvt�ra!");
define("PF_ERROR_71_INFO", "Eme �rlap t�rol�k�nyvt�ra �rv�nytelen, vagy nem hozhat� l�tre. Ellen�rizd a perForms adminisztr�tor '�rt�kek' f�l�n a felt�lt�si �tvonalat.");

// MENU

define("DATABASE","Adatb�zis");
define("BOUNDDATA","Adatok");
define("EXPORTTOEXCEL","Export�l�s");
define("PREVIEW","El�n�zet");
define("CLOSE","Bez�r�s");
define("CANCEL","M�gse");
define("DELETE","T�rl�s");
define("COPY_RECORD","M�sol�s");
define("NEW_ITEM","�j elem");
define("DELETE_ITEM_CONFIRM","T�rli az elemet?");
define("SAVE","Ment�s");

define("PRINTER_FRIENDLY", "Nyomtat�bar�t");
define("DOWNLOAD_PDF", "PDF f�jl let�lt�se");
define("ACCESSKEY", "H�v�bet�" );

define('PLEASE_FILL_OUT', 'K�rj�k, hogy t�ltsd ki!');
define('BINDING', 'K�t�s');
define('EDIT_ITEMS', 'Elemek szerkeszt�se');
define('UPGRADE_NEWS', 'Friss�t�si h�rek');
define('IS_AVAILABLE', 'megjelent');
define('DOWNLOAD_FROM', 'T�ltsd le itt:');

define('SEP_COMMA', 'vessz�');
define('SEP_COMMASPACE', 'vessz�+sz�k�z');
define('SEP_HYPHEN', 'k�t�jel');
define('SEP_NEWLINE', '�j sor');
define('SEP_SPACE', 'sz�k�z');

define('TY_EMAIL', 'email');
define('TY_FLOAT', 'lebeg�');
define('TY_INTEGER', 'eg�sz sz�m');
define('TY_NAME', 'n�v');
define('TY_STRING', 'karakterl�nc');
define('TY_URL', 'url');

define('ITEMTYPE_BUTTON', 'gomb');
define('ITEMTYPE_CHECKBOX', 'jel�l�n�gyzet');
define('ITEMTYPE_DATE', 'd�tum');
define('ITEMTYPE_FILE', 'f�jl');
define('ITEMTYPE_HIDDEN', 'rejtett');
define('ITEMTYPE_IMAGE', 'k�p');
define('ITEMTYPE_PASSWORD', 'jelsz�');
define('ITEMTYPE_PAGEBREAK', 'oldalt�r�s');
define('ITEMTYPE_RADIO', 'v�laszt�');
define('ITEMTYPE_SELECT', 'kijel�l�');
define('ITEMTYPE_TEXT', 'sz�veg');
define('ITEMTYPE_TEXTAREA', 'sz�vegter�let');
define('ITEMTYPE_TEXTUAL', 'sz�veges');

define('VALUE_UP', "Fel");
define('VALUE_UP_INFO', "A kijel�lt elemet a list�ban felfel� l�pteti.");
define('VALUE_DOWN', "Le");
define('VALUE_DOWN_INFO', "A kijel�lt elemet a list�ban lefel� l�pteti.");
define('SET_AS_SELECTED_INFO', "A perForms ezzel a kezdetben kijel�lt elemmel rajzolja meg a HTML-�rlapelemet.");
define('REMOVE_INFO', "Elt�vol�tja a kiv�lasztott lehet�s�get az �rt�klist�r�l.");

define('DISABLED_INFO', "Ha igen, akkor a perForms nem rajzolja meg ezt az elemet.");
define('READONLY_INFO', "Ha igen, akkor a perForms csak �r�sv�dettk�nt rajzolja meg ezt az elemet. Nem lehet kit�lteni.");
define('VALUE_INFO',"�rj be egy �rt�ket ebbe a mez�be, majd kattints a ".INSERT." gombra a list�ra v�telhez.<br /><br /> Az <strong>".ITEMTYPE_FILE."</strong> elemek eset�n ide �rd be az alap�rtelmezett felt�lt�si �tvonalat, sorv�gi elv�laszt�val <br />(pl. <code>/path/to/uploads/</code> vagy <code>c:\\\uploads\\\</code>).");

define('SUBMIT_LABEL_INFO', "Az �rlap \&apos;<b>k�ld�s</b>\&apos; gombj�nak felirata.");
define('INCLUDE_RESET_INFO', "Ha igen, akkor a perForms \&apos;<b>alaphelyzet</b>\&apos; gombot helyez el az �rlapon.");
define('RESET_LABEL_INFO', "Az \&apos<b>alaphelyzet</b>\&apos; gomb felirata.");
define('PUBLISHED_INFO', "Ha igen, akkor az �rlap el�rhet� lesz a webhely l�togat�i sz�m�ra.");
define('ACCESS_INFO', "Hat�rozd meg az �rlap hozz�f�r�si szintj�t.");
define('START_PUBLISHING_INFO', "Az a d�tum, mikort�l az �rlap a webhely l�togat�i sz�m�ra hozz�f�rhet� lesz.");
define('FINISH_PUBLISHING_INFO', "Az a d�tum, mikort�l az �rlap a webhely l�togat�i sz�m�ra nem lesz hozz�f�rhet�. Ha a d�tum 0000-00-00 00:00:00, akkor az �rlap m�r el�rhet�.");

define('CAPTION_INFO', "Az elem sz�vegc�mk�jek�nt nyomtat�sra ker�l� sz�veg.");
define('ACCESSKEY_INFO', "Az elemhez t�rs�tott olyan h�v�bet�, amit a b�ng�sz� rendel hozz� egy billenty�kombin�ci�hoz. P�ld�ul a \&apos;<b>k</b>\&apos; h�v�bet�je a crtl-shift-k gyorsbilenty�nek fele meg a Firefox b�ng�sz�ben, az Internet Explorerben pedig alt-shift-k.");
define('NAME_INFO', "Az elem bels� neve. Ne tartalmazzon semmilyen nem bet� karaktert. Ha ennek az elemnek <b>bcc, cc, mailfrom, mailto, replyto </b>vagy<b> replytoName</b> a neve, akkor az �rt�k automatikusan ker�l felhaszn�l�sra az emailk�ld�shez, ha az �rlapot emailek k�ld�s�re �ll�totta be.");
define('TYPE_INFO', "V�lassza ki az elemt�pust a list�b�l. A k�l�nf�le elemt�pusok k�l�nb�z� tulajdons�gokat t�mogatnak.<br /><ul><li>A <b>".ucfirst(ITEMTYPE_TEXTAREA)."</b> a ".SIZE1." �s a ".SIZE2.@" param�tert haszn�lja a sz�less�g �s a magass�g meghat�roz�s�hoz.<br /></li><li>A <b>".ITEMTYPE_SELECT.", ".ITEMTYPE_RADIO." </b>�s a<b> ".ITEMTYPE_CHECKBOX."</b> t�pusnak legal�bb egy �rt�knek kell lennie az elem ".VALUES_TAB." list�ban.<br /></li><li>A <strong>".ucfirst(ITEMTYPE_FILE)."</strong> elem a <strong>".SIZE1."</strong> param�tert haszn�lja a f�jln�vmez� sz�less�g�hez, a <strong>".SIZE2."</strong> param�ter hat�rozza meg a legnagyobb felt�lthet� f�jlm�retet, a <strong>".VALUE."</strong> pedig a felt�lt�si �tvonalat (ahol a felt�lt�tt f�jlok t�rol�sa t�rt�nik).</li></ul>");
define('CHECK_INFO', "V�laszd ki ennek az elemnek az �rv�nyes�t�j�t. Az �res �rv�nyes�t� v�laszt�sa eset�n mindenf�le t�pus� adat enged�lyez�sre ker�l.");
define('HELP_TEXT_INFO', "Az elemhez tartoz� helyi s�g�.");
define('ERROR_MSG_INFO', "A megjelen�tend� hiba�zenet, ha probl�ma van az elemmel.");

define('REVERSE_ORDER', "Ford�tott sorrend");
define('SAVE_ORDER', "Sorrend ment�se");
define('SWAP_SIZE_VARS', "Minden sz�vegter�let elem M�ret1 �s M�ret2 �rt�k�nek felcser�l�se");
define('NEW_SIZEVARS_SAVED', 'Az �j m�retv�ltoz�k ment�se k�sz.');
define('NEW_ORDERING_SAVED', 'Az �j sorrend ment�se k�sz.');

define('PF_LICENCE_INFO', 'A perForms a <a href="http://www.gnu.org/copyleft/gpl.html">GNU �ltal�nos Nyilv�nos Licenc</a> alatt kiadott szabad szoftver.');
define('INSTALLATION_MESSAGES', 'Telep�t�si �zenetek');
define('THANKS_FOR_CHOOSING', 'K�sz�nj�k, hogy a perFormst v�lasztottad.');
define('WE_NEED_TRANSLATORS', @"
<p>
A perForms most m�r teljesen lokaliz�lt, �s ford�t�kat keres�nk! 
<a href=\"http://forge.joomla.org/sf/go/projects.performs/discussion.language_file_translations\">Seg�tsen, hogy a PerForms glob�lis legyen!</a>
</p>");
define('FOR_SUPPORT', @"
<p><b>Tan�csad�s�rt k�rj�k, keresd fel hivatalos t�mogat� webhely�nket a <a href=\"http://www.performs.org.au/\">http://www.performs.org.au/</a> c�men.</b></p>
");
define('PERFORMS_FEATURES', @"
<p>Fontosabb funkci�i:</p>
<ul>
<li>Korl�tlan sz�m� beviteli mez�</li>
<li>9 f�le mez�t�pus k�z�l v�laszthat</li>
<li>F�jlfelt�lt�s!</li>
<li>Az �rlap post�z�sa</li>
<li>A felhaszn�l�k �ltal bek�ld�tt lev�l-felad�, v�laszc�m �s t�rgy mez�</li>
<li>Tetsz�s szerint hozhat� l�tre k�l�n adatb�zist�bla mindegyik �rlaphoz</li>
<li>A mez�k ellen�rz�se</li>
<li>Kiseg�t� lehet�s�gekkel ell�tott �rlapok</li>
<li>Egyedi hiba�zenetek</li>
<li>Egyedi helyi s�g� minden egyes mez�h�z</li>
<li>Jelent�slap a t�bl�ban l�v� rekordok megtekint�s�hez</li>
<li>Alap szint� sablonk�sz�t� rendszer</li>
<li>A r�gz�tett adatok megtekint�se / export�l�sa az Adminisztr�torban</li>
<li>A nyomtat�bar�t v�ltozat megtekint�se a l�togat�i oldalon</li>
<li>PDF let�lt�se</li>
<li>Joomla 1.5-kompatibilis</li>
</ul>
");
define('WELCOME_TO_PERFORMS', @"
<p>
A perForms seg�ts�g�vel egyszer�en k�sz�thetsz emailben elk�ldhet� vagy az adatb�zisba menthet� egyedi �rlapokat. Az eredm�nyeket megtekintheted az adminisztr�ci�ban, vagy let�ltheted CSV form�tumban.
</p>
".FOR_SUPPORT.PERFORMS_FEATURES.WE_NEED_TRANSLATORS);
define('NEW_FEATURES', @"
<strong>�j funkci�k: </strong>
<ul>
<li>Kiseg�t� lehet�s�gek</li>
<li>Admin inf� ikonok</li>
<li>Adatk�t�s lapoz�s</li>
<li>Konfigur�l�s</li>
<li>F�jlfelt�lt�si mez�</li>
<li>Bar�ts�gos hib�k</li>
<li>Verzi�ellen�rz�s</li>
</ul>
");
define('UPGRADE_MESSAGE', @"
<p>A perForms v�ltozott! 
<ol><li><p><img src=\"images/reload_f2.png\" height=\"16\" width=\"16\" border=\"0\" /> <strong>".REVERSE_ORDER.@"</strong> gomb.</p>Az elemeket ford�tott sorrendben tekintheted meg, csak kattints elem n�zetben a '<strong>"
       .REVERSE_ORDER."</strong>' gombra az �trendez�shez a ".ORDER.@" oszlop tetej�n.</li>
<li style=\"margin-top: 4pt;\"><p>
<img src=\"images/restore_f2.png\" border=\"0\" width=\"16\" height=\"16\" />
 <strong>".SWAP_SIZE_VARS.@"</strong> gomb.</p>
V�ltoztattunk a sz�vegter�let elemek M�ret1 �s M�ret2 param�ter�nek felhaszn�l�si m�dj�n, a sz�vegter�letek jav�t�s�hoz
kattints a '<strong>".SWAP_SIZE_VARS."</strong>' gombra a ".SIZE1." �s a ".SIZE2.@" oszlop tetej�n.</li></ol></p>
".WE_NEED_TRANSLATORS.NEW_FEATURES.FOR_SUPPORT);


define('SUCCESSFUL_UPGRADE', "A friss�t�s siker�lt a PerForms ");
define('INS_WELCOME', "�dv�z�l a perForms!");
define('INS_SQL_STATEMENTS', "SQL utas�t�sok");
define('INS_SQL_ERRORS', "SQL hib�k");

define('UPLOAD_ERROR_1', "A felt�lt�tt f�jl m�rete t�ll�pi a php.ini f�jlban az upload_max_filesize utas�t�sban megadott m�retet.");
define('UPLOAD_ERROR_1_INFO', "A f�jl a php eme telep�t�s�ben enged�lyezettn�l nagyobb volt.<ul><li> K�rd meg a php/joomla adminisztr�tort, hogy n�velje meg az upload_max_filesize m�ret�t.</li></ul>");
define('UPLOAD_ERROR_2', "A felt�lt�tt f�jl t�ll�pi a HTML-�rlapban megadott MAX_FILE_SIZE utas�t�sban megadott m�retet.");
define('UPLOAD_ERROR_2_INFO', "Az adminisztr�tor a legnagyobb felt�lthet� f�jlm�retet a f�jlod m�ret�n�l kisebbre �ll�totta.");
define('UPLOAD_ERROR_3', "A felt�lt�tt f�jl csak r�szben ker�lt felt�lt�sre.");
define('UPLOAD_ERROR_3_INFO', "Csatlakoz�si hiba miatt a f�jl megs�r�lt a kiszolg�l�i oldalon. K�rj�k, hogy pr�b�ld �jra.");
define('UPLOAD_ERROR_4', "Nem ker�lt f�jl felt�lt�sre.");
define('UPLOAD_ERROR_4_INFO', "Ismeretlen felt�tel miatt a f�jlfelt�lt�s nem siker�lt.");
define('UPLOAD_ERROR_5', "Ismeretlen hibav�lasz!!.");
define('UPLOAD_ERROR_5_INFO', "A php telep�t�s nem szabv�nyos hibak�dot adott vissza!");
define('UPLOAD_ERROR_6', "Hi�nyzik egy ideiglenes k�nyvt�r. A PHP 4.3.10 �s a PHP 5.0.3 verzi�ban ker�lt bevezet�sre.");
define('UPLOAD_ERROR_6_INFO', "Ennek a php telep�t�snek nincs megadva az ideiglenes k�nyvt�ra a php.ini f�jlban.");
define('UPLOAD_ERROR_7', "Nem siker�lt a f�jl �r�sa a lemezre. A PHP 5.1.0 verzi�ba ker�lt bevezet�sre.");
define('UPLOAD_ERROR_7_INFO', "Elfogyhatott a szabad ter�let a kiszolg�l�n, vagy az ideiglenes k�nyvt�r �r�sv�dett lehet.");

define('SUCCESS', "Siker�lt!");
define('UPLOAD_SUCCESSFUL', "A f�jl �rv�nyes, a felt�lt�se siker�lt.\n");
define('UPLOAD_SUCCESSFUL_INFO', "A f�jl felt�lt�se megt�rt�nt, t�rol�k�nyvt�rban ker�lt elhelyez�sre, az adminisztr�torra v�r.");
define('ERROR_71', "Lehets�ges f�jlfelt�lt�si t�mad�s!\n");
define('ERROR_71_INFO', "�rv�nytelen a f�jl neve vagy �tvonala!");

define('UNKNOWN_SENDER', "Ismeretlen felad�");

define('IMAGEFLOAT', "K�p k�rbefuttat�s�nak st�lusa");
define('IMAGEFLOAT_INFO', "Be�ll�tja a k�p k�rbefuttat�si st�lus�t (css float: [balra, jobbra, nincs, �r�kl�s];)");
define('FLOAT_LEFT', 'Balra');
define('FLOAT_RIGHT', 'Jobbra');
define('FLOAT_NONE', 'Nincs');
define('FLOAT_INHERIT', '�r�kl�s');

define('NOT_BOUND', "Nincs �sszek�tve!");
define('CLICK_BINDING_BUTTON', "Kattints a <b>K�t�s</b> gombra �j adatb�zist�bla hozz�rendel�s�hez.");

define('SHOW_UPLOADED_IMAGE', "Felt�lt�tt k�p megjelen�t�se");
define('SHOW_UPLOADED_IMAGE_INFO', "A felhaszn�l�i bevitel emailben t�rt�n� megtekint�sekor a f�jlelemek hivatkoz�ssal vagy k�pk�nt jelen�thet�k meg.");

define('SUBMIT', "K�ld�s");
define('REPLACE_SUBMIT_BUTTON', "A K�ld�s gomb lecser�l�se");
define('REPLACE_SUBMIT_BUTTON_INFO', "Az alap�rtelmezett �rlaptov�bb�t� gomb k�pre cser�l�se.");
define('SUBMIT_IMAGE_URL', "A K�ld�s k�pgomb URL-je");
define('SUBMIT_IMAGE_URL_INFO', "Az alap�rtelmezett K�ld�s gombot lecser�l� k�p URL-je.");
define('SUBMIT_IMAGE_WIDTH', "A K�ld�s k�pgomb sz�less�ge");
define('SUBMIT_IMAGE_WIDTH_INFO', "Az alap�rtelmezett K�ld�s gombot lecser�l� k�p sz�less�ge.");
define('SUBMIT_IMAGE_HEIGHT', "A K�ld�s k�pgomb magass�ga");
define('SUBMIT_IMAGE_HEIGHT_INFO', "Az alap�rtelmezett K�ld�s gombot lecser�l� k�p magass�ga.");

define('RESET', "M�gse");
define('REPLACE_RESET_BUTTON', "A M�gse gomb lecser�l�se");
define('REPLACE_RESET_BUTTON_INFO', "Az alap�rtelmezett �rlapt�rl� gomb k�pre cser�l�se.");
define('RESET_IMAGE_URL', "A M�gse k�pgomb URL-je");
define('RESET_IMAGE_URL_INFO', "Az alap�rtelmezett �rlapt�rl� gombot lecser�l� k�p URL-je.");
define('RESET_IMAGE_WIDTH', "A M�gse k�pgomb sz�less�ge");
define('RESET_IMAGE_WIDTH_INFO', "A M�gse gombot lecser�l� k�p sz�less�ge.");
define('RESET_IMAGE_HEIGHT', "A M�gse k�pgomb magass�ga");
define('RESET_IMAGE_HEIGHT_INFO', "A M�gse gombot lecser�l� k�p magass�ga.");

define('NOT_AUTHORIZED', "You are not authorized to see this resource.");
define("NO_AUTH_MESSAGE", "Unauthorized Message");
define("NO_AUTH_MESSAGE_INFO", "The message presented by the form when an unauthorized user attempts to view it.");

define('USE_CONTAINER', "Use Container");
define('USE_CONTAINER_INFO', "When displaying a perForms form, the standard container will be used if yes. If no, perForms forms can be used to replace individual words in a sentance, for example.");
define('SHOW_FORM_TITLE', "Show Form Title");
define('SHOW_FORM_TITLE_INFO', "When showing perForms as a component, sets the title display on/off.");
define('FORM_WIDTH', "Form Width");
define('FORM_WIDTH_INFO', 'The width of the form when displayed. Can be &quot;100px&quot; or &quot;35%&quot; etc.');
define('FORM_DISPLAY', "Form Display");
define('PRESENTATION_INFO', "Presentation");
define('INCLUDE_SUBMIT', "Include Submit Button");
define('INCLUDE_SUBMIT_INFO', "Show the Submit button on the form.");
define('MAIL_AS_TEXT', "Mail as Text");
define('MAIL_AS_TEXT_INFO', "If yes, perForms will send the form data as raw text, but remember, if you are going to include the intro in your form email, that it will not be rendered as Html.");

define('EXTRA_RECIPIENTS', "Extra Recipients");
define('MAIL_OPTIONS', "Mail Options");

define("USE_SECURITYIMAGES_INFO", "If yes, com_securityimages will be used to enable CAPTCHA for this form.");
define("SECURITYIMAGESHELP_INFO", "This message will be displayed along with the CAPTCHA image text box.");
define("SECURITYIMAGESERROR_INFO", "This message will be displayed if CAPTCHA fails for the form.");

define("CAPTIONCSSCLASS","Caption CSS class(es)");
define('CAPTIONCSSCLASS_INFO',"If set, the caption will be surrounded by a div tag, which has its CSS class attribute to this value.");
define("VALUECSSCLASS","Value CSS class(es)");
define('VALUECSSCLASS_INFO',"If set, the value will be surrounded by a div tag, which has its CSS class attribute to this value. If the form item has more than one value (such as a radio button), the entire set of values will be surrounded by the div.");
define("INFOCSSCLASS","Help CSS class(es)");
define('INFOCSSCLASS_INFO',"If set, the help text will be surrounded by a div tag, which has its CSS class attribute to this value.");
define("ERRORCSSCLASS","Error CSS class(es)");
define('ERRORCSSCLASS_INFO',"If set, an error message related to this form item will be surrounded by a div tag, which has its CSS class attribute to this value.");



//define("Delete","Delete");
/*
PFAUTO_ fields can be embedded into any text part of a form or form item
Where there can be text, an expression enclosed in braces, ilke {username}
will return the "Auto" field for PFAUTO_USERNAME
*/
define('PFAUTO_USERNAME', "felhaszn�l�n�v");
define('PFAUTO_NAME', "name");
define('PFAUTO_USERTYPE', "usertype");
define('PFAUTO_REGISTERDATE', "registerDate");
define('PFAUTO_LASTVISITDATE', "lastvisitDate");
define('PFAUTO_USEREMAIL', "useremail");
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