<?php
/**
* @version $Id: spanish.php Espa�ol Formal Tu 1.0.12 20.11.2006 www.todosjuntos.org Equipo de Traducci�n de la Comunidad Joomla! Hispana
* @translator: Josep M. Farrarons <www.xarxainter.net> correcci�n y actualizaci�n por TodosJuntos.org mail: traduccion@todosjuntos.org
* reportar bugs en www.todosjuntos.org/foros 
* @package: Joomla!
* @copyright Copyright (C) 2005 - 2006 TodosJuntos.org All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Acceso restringido.' );


/** agregados 1.0.12 */

define( '_SYSERR1', 'El adaptador de la base de datos no est� disponible' );
define( '_SYSERR2', 'No es posible conectar con el servidor de la base de datos' );
define( '_SYSERR3', 'No es posible conectar con la base de datos' );

DEFINE('_SUBMIT_BUTTON','Enviar');

DEFINE('_ALREADY_VOTE','�Ya has votado en esta encuesta hoy!');  //corrected from "item" to "poll" corregido.

DEFINE('_REG_ACTIVATE_FAILURE', '<div class="componentheading">�Fall� la activaci�n!</div><br />El sistema no pudo activar tu cuenta, contacta al administrador del sitio.');


// Site page note found
define( '_404', 'Lo sentimos, la p�gina que buscas no est� disponible.' );
define( '_404_RTS', 'Volver al sitio' );


// common
DEFINE('_LANGUAGE','es');
DEFINE('_NOT_AUTH','No tienes permisos para acceder a este apartado.');
DEFINE('_DO_LOGIN','Necesitas acceder primero.');
DEFINE('_VALID_AZ09',"Debes escribir un %s v�lido, sin espacios en blanco y con m�s de %d car�cteres y que contenga 0-9,a-z,A-Z");
DEFINE('_VALID_AZ09_USER',"Debes escribir un %s v�lido.  Con m�s de %d caracteres y que contengan n�meros de 0-9, y letras a-z,A-Z");
DEFINE('_CMN_YES','S�');
DEFINE('_CMN_NO','No');
DEFINE('_CMN_SHOW','Mostrar');
DEFINE('_CMN_HIDE','Ocultar');

DEFINE('_CMN_NAME','Nombre');
DEFINE('_CMN_DESCRIPTION','Descripci�n');
DEFINE('_CMN_SAVE','Guardar');
DEFINE('_CMN_APPLY','Aplicar');
DEFINE('_CMN_CANCEL','Cancelar');
DEFINE('_CMN_PRINT','Imprimir');
DEFINE('_CMN_PDF','PDF');
DEFINE('_CMN_EMAIL','E-Mail');
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','Padre');
DEFINE('_CMN_ORDERING','Orden');
DEFINE('_CMN_ACCESS','Nivel de acceso');
DEFINE('_CMN_SELECT','Selecciona');

DEFINE('_CMN_NEXT','Siguiente');
DEFINE('_CMN_NEXT_ARROW'," &gt;&gt;");
DEFINE('_CMN_PREV','Anterior');
DEFINE('_CMN_PREV_ARROW',"&lt;&lt; ");

DEFINE('_CMN_SORT_NONE','Sin ordenar');
DEFINE('_CMN_SORT_ASC','A-Z 0-9');
DEFINE('_CMN_SORT_DESC','Z-A 9-0');

DEFINE('_CMN_NEW','Nuevo');
DEFINE('_CMN_NONE','Nada');
DEFINE('_CMN_LEFT','Izquierda');
DEFINE('_CMN_RIGHT','Derecha');
DEFINE('_CMN_CENTER','Centrado');
DEFINE('_CMN_ARCHIVE','Archivar');
DEFINE('_CMN_UNARCHIVE','Desarchivar');
DEFINE('_CMN_TOP','Superior');
DEFINE('_CMN_BOTTOM','Inferior');

DEFINE('_CMN_PUBLISHED','Publicado');
DEFINE('_CMN_UNPUBLISHED','Sin publicar');

DEFINE('_CMN_EDIT_HTML','Editar HTML');
DEFINE('_CMN_EDIT_CSS','Editar CSS');

DEFINE('_CMN_DELETE','Borrar');

DEFINE('_CMN_FOLDER','Carpeta');
DEFINE('_CMN_SUBFOLDER','Sub-carpeta');
DEFINE('_CMN_OPTIONAL','Opcional');
DEFINE('_CMN_REQUIRED','Obligatorio');

DEFINE('_CMN_CONTINUE','Continuar');

DEFINE('_STATIC_CONTENT','P�ginas Est�tica');

DEFINE('_CMN_NEW_ITEM_LAST','Por defecto los art�culos nuevos aparecer�n en �ltima posici�n');
DEFINE('_CMN_NEW_ITEM_FIRST','Por defecto los art�culos nuevos aparecer�n en �ltima posici�n');
DEFINE('_LOGIN_INCOMPLETE','Debes rellenar los campos  Nombre de usuario y Contrase�a.');
DEFINE('_LOGIN_BLOCKED','Tu cuenta de acceso ha sido bloqueada. Por favor, contacta con el administrador del Web.');
DEFINE('_LOGIN_INCORRECT','Nombre de usuario y/o contrase�a incorrecta. Int�ntalo nuevamente.');
DEFINE('_LOGIN_NOADMINS','No has accedido o no hay ning�n administrador configurado.');
DEFINE('_CMN_JAVASCRIPT','�Atenci�n! Tienes que habilitar Javascript para realizar esta operaci�n.');

DEFINE('_NEW_MESSAGE','Tienes un nuevo mensaje privado');
DEFINE('_MESSAGE_FAILED','El usuario ha bloqueado la bandeja de entrada. El mensaje no ha podido ser enviado.');

DEFINE('_CMN_IFRAMES', 'Esta opci�n no trabajar� correctamente. Tu navegador no soporta IFRAMES.');

DEFINE('_INSTALL_WARN','Por motivos de seguridad debes borrar completamente el directorio \'installation\' junto con todos los archivos y subdirectorios que contenga - Despues refresca esta p�gina');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>�No encontr� la plantilla!</b></font><br />Seguramente no has seleccionado la plantilla o<br />bien no tienes ninguna plantilla en el directorio \'templates\'<br />Si tienes plantillas en el directorio, entonces, accede<br /> a la administraci�n de Joomla! y selecciona una.');
DEFINE('_NO_PARAMS','No hay par�metros para este art�culo');
DEFINE('_HANDLER','Sin definir');

/** mambots */
DEFINE('_TOC_JUMPTO','�nicio');

/**  content */
DEFINE('_READ_MORE','Leer m�s...');
DEFINE('_READ_MORE_REGISTER','Reg�strate para leerlo...');
DEFINE('_MORE','M�s...');
DEFINE('_ON_NEW_CONTENT', "[ %s ] ha enviado un art�culo nuevo con el t�tulo [ %s ] para la secci�n [ %s ] y la categor�a [ %s ]" );
DEFINE('_SEL_CATEGORY','- Selecciona la categor�a -');
DEFINE('_SEL_SECTION','- Selecciona la secci�n -');
DEFINE('_SEL_AUTHOR','- Selecciona un autor -');
DEFINE('_SEL_POSITION','- Selecciona una posici�n -');
DEFINE('_SEL_TYPE','- Selecciona un tipo -');
DEFINE('_EMPTY_CATEGORY','La categor�a actualmente est� vac�a');
DEFINE('_EMPTY_BLOG','No hay art�culos para mostrar');
DEFINE('_NOT_EXIST','La p�gina a la que intentas acceder ya no existe.<br />Este es un sitio vivo y din�mico con actualizaciones constantes, por este motivo algunas p�ginas de contenidos desaparecen de nuestra Web. Escoje una opci�n de los men�s para continuar tu visita al sitio Web.');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','Votar');
DEFINE('_BUTTON_RESULTS','Resultados');
DEFINE('_USERNAME','Usuario');
DEFINE('_LOST_PASSWORD','�Recuperar contrase�a?');
DEFINE('_PASSWORD','Contrase�a');
DEFINE('_BUTTON_LOGIN','Entrar');
DEFINE('_BUTTON_LOGOUT','Salir');
DEFINE('_NO_ACCOUNT','�Quieres registrarte?');
DEFINE('_CREATE_ACCOUNT','Hazlo aqu�');
DEFINE('_VOTE_POOR','Malo');
DEFINE('_VOTE_BEST','Bueno');
DEFINE('_USER_RATING','Calificaci�n del usuario');
DEFINE('_RATE_BUTTON','Calificar');
DEFINE('_REMEMBER_ME','Recordarme');

/** contact.php */
DEFINE('_ENQUIRY','Solicitud');
DEFINE('_ENQUIRY_TEXT','Este correo ha sido enviado mediante %s desde');
DEFINE('_COPY_TEXT','Esto es una copia del mensaje enviado a %s mediante %s');
DEFINE('_COPY_SUBJECT','Copia de: ');
DEFINE('_THANK_MESSAGE','Gracias por tu mensaje');
DEFINE('_CLOAKING','Esta direcci�n de correo electr�nico est� protegida contra los robots de spam, necesitas tener Javascript activado para poder verla');
DEFINE('_CONTACT_HEADER_NAME','Nombre');
DEFINE('_CONTACT_HEADER_POS','Cargo');
DEFINE('_CONTACT_HEADER_EMAIL','E-Mail');
DEFINE('_CONTACT_HEADER_PHONE','Tel�fono');
DEFINE('_CONTACT_HEADER_FAX','Fax');
DEFINE('_CONTACTS_DESC','Lista de contacto de la web.');
DEFINE('_CONTACT_MORE_THAN','No puedes ingresar m�s de una direcci�n de e-mail.');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','Contactar');
DEFINE('_EMAIL_DESCRIPTION','Enviar correo al contacto:');
DEFINE('_NAME_PROMPT',' Escribe tu nombre:');
DEFINE('_EMAIL_PROMPT',' Escribe tu direcci�n E-Mail:');
DEFINE('_MESSAGE_PROMPT',' Escribe el mensaje:');
DEFINE('_SEND_BUTTON','Enviar');
DEFINE('_CONTACT_FORM_NC','Por favor, revisa que el formulario est� rellenado completamente y con datos v�lidos.');
DEFINE('_CONTACT_TELEPHONE','Tel�fono: ');
DEFINE('_CONTACT_MOBILE','M�vil: ');
DEFINE('_CONTACT_FAX','Fax: ');
DEFINE('_CONTACT_EMAIL','E-Mail: ');
DEFINE('_CONTACT_NAME','Nombre: ');
DEFINE('_CONTACT_POSITION','Cargo: ');
DEFINE('_CONTACT_ADDRESS','Direcci�n: ');
DEFINE('_CONTACT_MISC','Informaci�n: ');
DEFINE('_CONTACT_SEL','Escoje un contacto:');
DEFINE('_CONTACT_NONE','No hay detalles de contacto.');
DEFINE('_CONTACT_ONE_EMAIL','No puedes ingresar m�s de una direcci�n de e-mail.');
DEFINE('_EMAIL_A_COPY','Marca la casilla si quieres una c�pia del mensaje.');
DEFINE('_CONTACT_DOWNLOAD_AS','Descargar esta informaci�n como');
DEFINE('_VCARD','VCard');

/** pageNavigation */
DEFINE('_PN_LT','&lt;');
DEFINE('_PN_RT','&gt;');
DEFINE('_PN_PAGE','P�gina');
DEFINE('_PN_OF','de');
DEFINE('_PN_START','Inicio');
DEFINE('_PN_PREVIOUS','Anterior');
DEFINE('_PN_NEXT','Siguiente');
DEFINE('_PN_END','Final');
DEFINE('_PN_DISPLAY_NR','Mostrando ');
DEFINE('_PN_RESULTS','Resultados');

/** emailfriend */
DEFINE('_EMAIL_TITLE','Enviar a un amigo');
DEFINE('_EMAIL_FRIEND','Enviar por correo a un amigo.');
DEFINE('_EMAIL_FRIEND_ADDR','E-Mail de tu amigo:');
DEFINE('_EMAIL_YOUR_NAME','Tu nombre:');
DEFINE('_EMAIL_YOUR_MAIL','Tu E-Mail:');
DEFINE('_SUBJECT_PROMPT',' T�tulo del mensaje:');
DEFINE('_BUTTON_SUBMIT_MAIL','Enviar E-Mail');
DEFINE('_BUTTON_CANCEL','Cancelar');
DEFINE('_EMAIL_ERR_NOINFO','Tienes que escribir tu E-Mail y el de destino.');
DEFINE('_EMAIL_MSG',' La siguiente p�gina del sitio web "%s" le ha sido enviada por %s ( %s ) porque le pareci� que podr�a ser de su inter�s.

Puede acceder mediante la siguiente direcci�n:
%s');
DEFINE('_EMAIL_INFO','Enviado por');
DEFINE('_EMAIL_SENT','Enviado a');
DEFINE('_PROMPT_CLOSE','Cerrar ventana');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' autor');
DEFINE('_WRITTEN_BY', ' escrito por');
DEFINE('_LAST_UPDATED', 'Modificado el');
DEFINE('_BACK','[Volver]');
DEFINE('_LEGEND','Leyenda');
DEFINE('_DATE','Fecha');
DEFINE('_ORDER_DROPDOWN','Orden');
DEFINE('_HEADER_TITLE','T�tulo');
DEFINE('_HEADER_AUTHOR','Autor');
DEFINE('_HEADER_SUBMITTED','Enviado el');
DEFINE('_HEADER_HITS','Accesos');
DEFINE('_E_EDIT','Editar');
DEFINE('_E_ADD','A�adir');
DEFINE('_E_WARNUSER','Cancela o guarda los cambios efectuados antes de salir.');
DEFINE('_E_WARNTITLE','El art�culo debe tener t�tulo');
DEFINE('_E_WARNTEXT','El art�culo debe tener un texto de introducci�n');
DEFINE('_E_WARNCAT','Selecciona una categor�a');
DEFINE('_E_CONTENT','Contenido');
DEFINE('_E_TITLE','T�tulo:');
DEFINE('_E_CATEGORY','Categor�a:');
DEFINE('_E_INTRO','Texto de introducci�n');
DEFINE('_E_MAIN','Texto principal');
DEFINE('_E_MOSIMAGE','INSERTAR {mosimage}');
DEFINE('_E_IMAGES','Im�genes');
DEFINE('_E_GALLERY_IMAGES','Galer�a de im�genes');
DEFINE('_E_CONTENT_IMAGES','Im�genes');
DEFINE('_E_EDIT_IMAGE','Editar imagen');
DEFINE('_E_NO_IMAGE','Sin imagen');
DEFINE('_E_INSERT','Insertar');
DEFINE('_E_UP','Subir');
DEFINE('_E_DOWN','Bajar');
DEFINE('_E_REMOVE','Borrar');
DEFINE('_E_SOURCE','C�digo:');
DEFINE('_E_ALIGN','Alineado:');
DEFINE('_E_ALT','Texto etiqueta:');
DEFINE('_E_BORDER','Borde:');
DEFINE('_E_CAPTION','Subt�tulo');
DEFINE('_E_CAPTION_POSITION','Posici�n del subt�tulo');
DEFINE('_E_CAPTION_ALIGN','Alineaci�n del subt�tulo');
DEFINE('_E_CAPTION_WIDTH','Ancho del subt�tulo');
DEFINE('_E_APPLY','Aplicar');
DEFINE('_E_PUBLISHING','Publicar');
DEFINE('_E_STATE','Estado:');
DEFINE('_E_AUTHOR_ALIAS','Alias del autor:');
DEFINE('_E_ACCESS_LEVEL','Nivel de acceso:');
DEFINE('_E_ORDERING','Ordenado:');
DEFINE('_E_START_PUB','Inicio de la publicaci�n:');
DEFINE('_E_FINISH_PUB','Fin de la publicaci�n:');
DEFINE('_E_SHOW_FP','Mostrar en la p�gina de inicio:');
DEFINE('_E_HIDE_TITLE','�Ocultar el t�tulo?:');
DEFINE('_E_METADATA','Metadata');
DEFINE('_E_M_DESC','Descripci�n:');
DEFINE('_E_M_KEY','Palabras:');
DEFINE('_E_SUBJECT','T�tulo:');
DEFINE('_E_EXPIRES','Fecha de caducidad:');
DEFINE('_E_VERSION','Versi�n:');
DEFINE('_E_ABOUT','Sobre');
DEFINE('_E_CREATED','Creado:');
DEFINE('_E_LAST_MOD','Modificado el:');
DEFINE('_E_HITS','Accesos:');
DEFINE('_E_SAVE','Guardar');
DEFINE('_E_CANCEL','Cancelar');
DEFINE('_E_REGISTERED','S�lo usuarios registrados');
DEFINE('_E_ITEM_INFO','Informaci�n del art�culo');
DEFINE('_E_ITEM_SAVED','Art�culo guardado.');
DEFINE('_ITEM_PREVIOUS','&lt; Anterior');
DEFINE('_ITEM_NEXT','Siguiente &gt;');
DEFINE('_KEY_NOT_FOUND','Clave no encontrada');


/** content.php */
DEFINE('_SECTION_ARCHIVE_EMPTY','No hay art�culos archivados en la secci�n actualmente.');	
DEFINE('_CATEGORY_ARCHIVE_EMPTY','No hay art�culos archivados en la categor�a actualmente.');	
DEFINE('_HEADER_SECTION_ARCHIVE','Archivo de secciones');
DEFINE('_HEADER_CATEGORY_ARCHIVE','Archivo de categor�as');
DEFINE('_ARCHIVE_SEARCH_FAILURE','No hay art�culos archivados para %s %s');	// values are month then year
DEFINE('_ARCHIVE_SEARCH_SUCCESS','Hay art�culos archivados para %s %s');	// values are month then year
DEFINE('_FILTER','Filtro');
DEFINE('_ORDER_DROPDOWN_DA','Fecha A-Z');
DEFINE('_ORDER_DROPDOWN_DD','Fecha Z-A');
DEFINE('_ORDER_DROPDOWN_TA','T�tulo A-Z');
DEFINE('_ORDER_DROPDOWN_TD','T�tulo Z-A');
DEFINE('_ORDER_DROPDOWN_HA','Accesos A-Z');
DEFINE('_ORDER_DROPDOWN_HD','Accesos Z-A');
DEFINE('_ORDER_DROPDOWN_AUA','Autor A-Z');
DEFINE('_ORDER_DROPDOWN_AUD','Autor Z-A');
DEFINE('_ORDER_DROPDOWN_O','Ordenar');

/** poll.php */
DEFINE('_ALERT_ENABLED','�Debes habilitar las cookies en tu navegador!');
DEFINE('_NO_SELECTION','No has seleccionado nada. Selecciona algo');
DEFINE('_THANKS','�Gracias por tu voto!');
DEFINE('_SELECT_POLL','De la lista siguiente selecciona una encuesta');

/** classes/html/poll.php */
DEFINE('_JAN','Enero');
DEFINE('_FEB','Febrero');
DEFINE('_MAR','Marzo');
DEFINE('_APR','Abril');
DEFINE('_MAY','Mayo');
DEFINE('_JUN','Junio');
DEFINE('_JUL','Julio');
DEFINE('_AUG','Agosto');
DEFINE('_SEP','Septiembre');
DEFINE('_OCT','Octubre');
DEFINE('_NOV','Noviembre');
DEFINE('_DEC','Diciembre');
DEFINE('_POLL_TITLE','Encuesta - Resultados');
DEFINE('_SURVEY_TITLE','T�tulo de la encuesta:');
DEFINE('_NUM_VOTERS','N�mero de votos:');
DEFINE('_FIRST_VOTE','Primer voto:');
DEFINE('_LAST_VOTE','�ltimo voto:');
DEFINE('_SEL_POLL','Selecciona encuesta:');
DEFINE('_NO_RESULTS','La encuesta no tiene resultados por el momento.');

/** registration.php */
DEFINE('_ERROR_PASS','Lo siento, pero no he podido encontrar la informaci�n de registro del usuario');
DEFINE('_NEWPASS_MSG','La cuenta de $checkusername tiene esta direcci�n E-Mail asociada.\n'
.'Un usuario de $mosConfig_live_site ha pedido el envio de una nueva contrase�a.\n\n'
.' Tu nueva contrase�a es: $newpass\n\nSi tu no has solicitado el envio de la contrase�a, no te preocupes.'
.' S�lo tu puedes ver este mensaje, n�die m�s. Si esto se ha producido por un error, accede a la Web con esta'
.' nueva contrase�a y c�mbiala por otra de tu elecci�n en el men� del usuario.');
DEFINE('_NEWPASS_SUB','$_sitename :: Nueva contrase�a para :: $checkusername');
DEFINE('_NEWPASS_SENT','<span class="componentheading">�Se ha creado y enviado la nueva contrase�a!</span>');
DEFINE('_REGWARN_NAME','Escribe tu nombre.');
DEFINE('_REGWARN_UNAME','Escribe tu nombre de usuario.');
DEFINE('_REGWARN_MAIL','Escribe tu direcci�n E-Mail.');
DEFINE('_REGWARN_PASS','Debes escribir una contrase�a v�lida, sin espacios en blanco con m�s de 6 car�cteres y que contenga 0-9,a-z,A-Z');
DEFINE('_REGWARN_VPASS1','Verifica la contrase�a.');
DEFINE('_REGWARN_VPASS2','La contrase�a y la verificaci�n, no son iguales. Int�ntalo de nuevamente.');
DEFINE('_REGWARN_INUSE','Este nombre de usuario/contrase�a ya est� siendo usado. Int�ntalo con otro.');
DEFINE('_REGWARN_EMAIL_INUSE', 'Esta direcci�n E-Mail ya est� registrada. Si no recuerdas tu contrase�a haz clic en "�Recuperar contrase�a?" y se te enviar� una nueva por correo electr�nico.');
DEFINE('_SEND_SUB','Detalles del usuario %s en %s');
DEFINE('_USEND_MSG_ACTIVATE', 'Hola %s,

Gracias por registrate en %s. Tu nueva cuenta ha sido creada con �xito, no obstante, antes de poder usarla tienes que activarla.
Para activar la cuenta haz clic en el enlace siguiente o en su lugar, c�pia y pega el enlace en tu navegador:
%s

Hecho esto ya podr�s acceder a %s usando la informaci�n de acceso siguiente:

Usuario    - %s
Contrase�a - %s');
DEFINE('_USEND_MSG', "Hola %s,

Gracias por registrarte en %s.

Ahora ya puedes acceder a %s usando el nombre de usuario y contrase�a con la que te has registrado.");
DEFINE('_USEND_MSG_NOPASS','Hola $name,\n\nHas sido a�adido por un administrador como usuario registrado en $mosConfig_live_site.\n'
.'Puedes acceder a $mosConfig_live_site con el nombre de usuario y contrase�a del registro.\n\n'
.'Por favor, no respondas a este mensaje ya que ha sido generado autom�ticamente y solo es para tu informaci�n\n');
DEFINE('_ASEND_MSG','Hola %s,

Un nuevo usuario se ha registrado en %s.
A continuaci�n te mostramos los detalles:

Nombre  - %s
E-Mail  - %s
Usuario - %s

Por favor, no respondas a este mensaje ya que ha sido generado autom�ticamente y es solo para tu informaci�n');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">�Registro completo!</div><br />&nbsp;&nbsp;'
.'Ya puedes acceder con tu informaci�n de usuario.<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">�Registro completo!</div><br />Ya puedes acceder con tu informaci�n de contacto.');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">�Registro completo!</div><br />Tu cuenta se ha creado con �xito, no obstante, debes realizar un sencillo paso m�s, te ha sido enviado un mensaje a la direcci�n E-Mail de registro, en �l encontrar�s un enlace de activaci�n de tu nueva cuenta.');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">�Activaci�n correcta!</div><br />Tu cuenta ha sido activada correctamente. �Gracias!. Ya puedes acceder al sitio con el nombre de usuario y contrase�a del registro.');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">�Activaci�n incorrecta!</div><br />Lo siento, esta activaci�n ya no existe en nuestra base de datos, seguramente ya ha sido activada.');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','�Recuperar contrase�a?');
DEFINE('_NEW_PASS_DESC','Escribe el nombre de usuario y la direcci�n E-Mail con la que te registraste y haz clic en el bot�n Recibir contrase�a.<br>'
.'Enseguida te ser� enviada una nueva contrase�a. Us�la para acceder al sitio Web, luego podr�s cambiarla por una de tu elecci�n.');
DEFINE('_PROMPT_UNAME','Usuario:');
DEFINE('_PROMPT_EMAIL','E-Mail:');
DEFINE('_BUTTON_SEND_PASS','Recibir contrase�a');
DEFINE('_REGISTER_TITLE','Registrarte como usuario');
DEFINE('_REGISTER_NAME','Nombre:');
DEFINE('_REGISTER_UNAME','Usuario:');
DEFINE('_REGISTER_EMAIL','E-Mail:');
DEFINE('_REGISTER_PASS','Contrase�a:');
DEFINE('_REGISTER_VPASS','Verificar contrase�a:');
DEFINE('_REGISTER_REQUIRED','Los campos marcados con un asterisco (*) son obligatorios.');
DEFINE('_BUTTON_SEND_REG','Enviar registro');
DEFINE('_SENDING_PASSWORD','La contrase�a te ser� enviada a la direcci�n E-mail del registro.<br>Una vez en tu poder'
.' podr�s acceder y cambiarla por una de tu elecci�n.');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','Buscar');
DEFINE('_PROMPT_KEYWORD','Texto buscado:');
DEFINE('_SEARCH_MATCHES','%d resultados');
DEFINE('_CONCLUSION','La b�squeda ha devuelto $totalRows resultados. �Quieres buscar <b>$searchword</b> en');
DEFINE('_NOKEYWORD','La b�squeda no ha producido resultados');
DEFINE('_IGNOREKEYWORD','Una o m�s palabras, demasiado comunes, han sido ignoradas en la b�squeda');
DEFINE('_SEARCH_ANYWORDS','Cualquier palabra');
DEFINE('_SEARCH_ALLWORDS','Todas las palabras');
DEFINE('_SEARCH_PHRASE','Frase exacta');
DEFINE('_SEARCH_NEWEST','Lo nuevo primero');
DEFINE('_SEARCH_OLDEST','Lo antiguo primero');
DEFINE('_SEARCH_POPULAR','Lo m�s le�do primero');
DEFINE('_SEARCH_ALPHABETICAL','Alfab�ticamente');
DEFINE('_SEARCH_CATEGORY','Secci�n/Categor�a');
DEFINE('_SEARCH_MESSAGE','Los t�rminos a buscar deben tener un m�nimo de 3 caracteres y un m�ximo de 20.');
DEFINE('_SEARCH_ARCHIVED','Archivado');
DEFINE('_SEARCH_CATBLOG','Blog de Categor�a');
DEFINE('_SEARCH_CATLIST','Lista de Categor�a');
DEFINE('_SEARCH_NEWSFEEDS','Alimentaci�n de Noticias');
DEFINE('_SEARCH_SECLIST','Lista de Secci�n');
DEFINE('_SEARCH_SECBLOG','Blog de Secci�n');


/** templates/*.php */
DEFINE('_ISO','charset=iso-8859-1');
DEFINE('_DATE_FORMAT','l, d F de Y');  //Uses PHP's DATE Command Format - Depreciated
/**
* Modify this line to reflect how you want the date to appear in your site
*
*e.g. DEFINE("_DATE_FORMAT_LC","%A, %d %B %Y %H:%M"); //Uses PHP's strftime Command Format
*/
DEFINE('_DATE_FORMAT_LC',"%A, %d de %B de %Y"); //Uses PHP's strftime Command Format
DEFINE('_DATE_FORMAT_LC2',"%A, %d de %B de %Y a las %H:%M");
DEFINE('_SEARCH_BOX','buscar...');
DEFINE('_NEWSFLASH_BOX','�Destacamos!');
DEFINE('_MAINMENU_BOX','Men� principal');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','Men� del usuario');
DEFINE('_HI','Hola, ');

/** user.php */
DEFINE('_SAVE_ERR','Rellena todos los campos.');
DEFINE('_THANK_SUB','Gracias por tu aportaci�n, los administradores deben revisarla antes de que se haga p�blica.');
DEFINE('_THANK_SUB_PUB','Gracias por tu envio.');
DEFINE('_UP_SIZE','No puedes subir archivos superiores a 15kb.');
DEFINE('_UP_EXISTS','Ya hay una imagen con el nombre $userfile_name. Renombra el archivo e int�ntala subir de nuevo.');
DEFINE('_UP_COPY_FAIL','Error al copiar');
DEFINE('_UP_TYPE_WARN','Solo esta permitido subir im�genes gif o jpg.');
DEFINE('_MAIL_SUB','Nuevo envio de un usuario');
DEFINE('_MAIL_MSG','Hola $adminName,\n\nUn nuevo $type con el t�tulo $title, ha sido enviado por $author'
.' al sitio Web $mosConfig_live_site.\n'
.'Accede a $mosConfig_live_site/administrator para revisar y aprobar o no este $type.\n\n'
.'Por favor, no respondas a este mensaje ya que ha sido generado autom�ticamente y es s�lo para tu informaci�n.\n');
DEFINE('_PASS_VERR1','Si cambias la contrase�a, debes escribirla nuevamente para verificarla.');
DEFINE('_PASS_VERR2','Si cambias la contrase�a, aseg�rate que la nueva y la verificaci�n coinciden.');
DEFINE('_UNAME_INUSE','Este nombre de usuario ya est� siendo usado.');
DEFINE('_UPDATE','Actualizar');
DEFINE('_USER_DETAILS_SAVE','Los cambios han sido guardados.');
DEFINE('_USER_LOGIN','Acceso de usuarios');

/** components/com_user */
DEFINE('_EDIT_TITLE','Editar detalles');
DEFINE('_YOUR_NAME','Nombre:');
DEFINE('_EMAIL','E-Mail:');
DEFINE('_UNAME','Nombre de usuario:');
DEFINE('_PASS','Contrase�a:');
DEFINE('_VPASS','Verificar contrase�a:');
DEFINE('_SUBMIT_SUCCESS','�Enviado!');
DEFINE('_SUBMIT_SUCCESS_DESC','El art�culo ha sido enviado a los administradores. Una vez que sea revisado se publicar� o no a la sola consideraci�n de los administradores.');
DEFINE('_WELCOME','�Bienvenid@!');
DEFINE('_WELCOME_DESC','Bienvenid@ a la secci�n de usuarios registrados de este sitio Web');
DEFINE('_CONF_CHECKED_IN','Comprobando los art�culos');
DEFINE('_CHECK_TABLE','Comprobando la tabla');
DEFINE('_CHECKED_IN','Comprobando ');
DEFINE('_CHECKED_IN_ITEMS',' art�culos');
DEFINE('_PASS_MATCH','Las contrase�as no coinciden');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','Tienes que seleccionar el nombre del cliente.');
DEFINE('_BNR_CONTACT','Tienes que seleccionar el contacto para el cliente.');
DEFINE('_BNR_VALID_EMAIL','Tienes que escribir un direcci�n v�lida de correo electr�nico del cliente.');
DEFINE('_BNR_CLIENT','Tienes que seleccionar un cliente,');
DEFINE('_BNR_NAME','Tienes que escribir un nombre para el banner.');
DEFINE('_BNR_IMAGE','tienes que seleccionar una imagen para el banner.');
DEFINE('_BNR_URL','Tienes que escribir una URL/c�digo personalizado para el banner.');

/** components/com_login */
DEFINE('_ALREADY_LOGIN','�Has entrado!');
DEFINE('_LOGOUT','Clic aqu� para salir');
DEFINE('_LOGIN_TEXT','Usa tu informaci�n de entrada para obtener el acceso completo'); 
DEFINE('_LOGIN_SUCCESS','Has entrado correctamente');
DEFINE('_LOGOUT_SUCCESS','Has salido del sistema');
DEFINE('_LOGIN_DESCRIPTION','Para entrar en las �reas privadas debes validarte primero.');
DEFINE('_LOGOUT_DESCRIPTION','Actualmente est�s en el �rea privada de este sitio Web');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','Enlaces Web');
DEFINE('_WEBLINKS_DESC','Generalmente estamos navegando. Cuando encontramos algun sitio interesante'
          .' lo listamos aqu� para recordarlo, aunque vayas a visitarlos, esperamos que vuelvas a nuestra Web.'
          .' De la lista siguiente, selecciona el tema que m�s te interese y escoje el sitio Web que quieres visitar (<I>Se abren en una nueva ventana</i>).');
DEFINE('_HEADER_TITLE_WEBLINKS','Enlaces Web');
DEFINE('_SECTION','Secci�n:');
DEFINE('_SUBMIT_LINK','Enviar enlace');
DEFINE('_URL','URL:');
DEFINE('_URL_DESC','Descripci�n:');
DEFINE('_NAME','Nombre:');
DEFINE('_WEBLINK_EXIST','Ya existe un enlace con este nombre, int�ntalo nuevamente con otro nombre o enlace.');
DEFINE('_WEBLINK_TITLE','El enlace debe tener un t�tulo.');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','Nombre');
DEFINE('_FEED_ARTICLES','N�mero de art�culos');
DEFINE('_FEED_LINK','Enlace');

/** whos_online.php */
DEFINE('_WE_HAVE', 'Hay ');
DEFINE('_AND', ' y ');
DEFINE('_GUEST_COUNT','%s invitado');
DEFINE('_GUESTS_COUNT','%s invitados');
DEFINE('_MEMBER_COUNT','%s usuario');
DEFINE('_MEMBERS_COUNT','%s usuarios');
DEFINE('_ONLINE',' en l�nea');
DEFINE('_NONE','No hay usuarios conectados');

/** modules/mod_random_image */
DEFINE('_NO_IMAGES','No hay im�genes');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','Hora');
DEFINE('_MEMBERS_STAT','Usuarios');
DEFINE('_HITS_STAT','Accesos');
DEFINE('_NEWS_STAT','Noticias');
DEFINE('_LINKS_STAT','Enlaces Web');
DEFINE('_VISITORS','Visitantes');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','* El 1er. art�culo en este men� [mainmenu] es la p�gina de inicio del Web *');
DEFINE('_MAINMENU_DEL','* No puedes borrar este men� mientras sea requerido por Joomla! *');
DEFINE('_MENU_GROUP','* Un cierto Tipo de men� aparece en m�s de un grupo *');


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', 'Detalles del nuevo usuario' );
DEFINE('_NEW_USER_MESSAGE', 'Hola %s,


Un administrador te ha a�adido como usuario registrado de %s.

Este mensaje contiene el nombre de usuario y contrase�a para acceder a %s:

Nombre usuario - %s
Contrase�a     - %s

Por favor, no respondas a este mensaje ya que ha sido generado autom�ticamente y s�lo es para tu informaci�n');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "Mensaje desde '%s'

Mensaje:
" );


/** includes/pdf.php */
DEFINE('_PDF_GENERATED','Generado:');
DEFINE('_PDF_POWERED','Motorizado por Joomla!');
?>
