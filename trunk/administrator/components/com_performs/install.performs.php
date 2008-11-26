<?php 
/**
* Install routines for performs
 * @version $Id$
 * @package perForms
 * @copyright (C) 2005 - 2007 perForms
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author David Walters
 * perForms is Free Software
 */
// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
global $mosConfig_absolute_path;
include( $mosConfig_absolute_path . '/administrator/components/com_performs/class.performs.php' );
require_once( $mosConfig_absolute_path . '/administrator/components/com_performs/includes/installer.php' );
require_once( $mosConfig_absolute_path . '/administrator/components/com_performs/lib/myLib.php' );

class PerFormsDBInstaller extends DBInstaller {
  function PerFormsDBInstaller() {
    global $mosConfig_absolute_path, $mosConfig_debug, $perfConfig, $mosConfig_db, $mosConfig_dbprefix;
    if ($mosConfig_debug)  echo  "PHP Version: " . phpversion() . "\n";
    if( !isset( $perfConfig )){
      require_once( $mosConfig_absolute_path . '/administrator/components/com_performs/includes/config.class.php' );
      $perfConfig = new perfConfig();
      // report all errors and notices if in debug mode
      if( $perfConfig->get('debug') || $mosConfig_debug ) error_reporting(E_ALL);
    }
    $sql_file_location = $mosConfig_absolute_path . "/administrator/components/com_performs/sql/performs.sql";
    $oldTableNames = array("performs1", "performs1_items", "performs2", "performs2_items");
    $newTableNames = array("performs", "performs_items", "performs", "performs_items");
    $migrateInfo = array( 
			new MigrateInfo("performs", "theme", "default", "performs.jpg"), 
			new MigrateInfo("performs", "replaceSubmitButton", "", "0"), 
			new MigrateInfo("performs", "replaceResetButton", "", "0"), 
			new MigrateInfo("performs", "useContainer", "", "1"),
			new MigrateInfo("performs", "formWidth", "", "100%"),
			new MigrateInfo("performs_items", "captionCssClass", "", "pfCaption"),
			new MigrateInfo("performs_items", "valueCssClass", "", "pfValue"),
			new MigrateInfo("performs_items", "infoCssClass", "", "pfInfo"),
			new MigrateInfo("performs_items", "errorCssClass", "", "pfError"),
			new MigrateInfo("performs", "replaceSubmitButton", "NULL", "0"), 
			new MigrateInfo("performs", "replaceResetButton", "NULL", "0"), 
			new MigrateInfo("performs", "useContainer", "NULL", "1"),
			new MigrateInfo("performs", "formWidth", "NULL", "100%"),
			new MigrateInfo("performs_items", "captionCssClass", "NULL", "pfCaption"),
			new MigrateInfo("performs_items", "valueCssClass", "NULL", "pfValue"),
			new MigrateInfo("performs_items", "infoCssClass", "NULL", "pfInfo"),
			new MigrateInfo("performs_items", "errorCssClass", "NULL", "pfError")
		);
		
		$extensionInfo = array (
			new ExtensionInfo ( (isJ10()?"mambot":"plugin"), "mosperforms", "element", true ),
			new ExtensionInfo ( "module", "mod_performs", "module", true )
		);

//***********should refactor this out of here**********************************/
		$showtablesquery = "SHOW TABLES LIKE '".$mosConfig_dbprefix."performs%'";
		global $database;
		$database->setQuery($showtablesquery);
		if (!$database->query()) {
			//possible error, just do nothing then
			//(in production)
			echo "<small>PerForms could not read the database!</small>";
			return;
		}
		$returns = $database->loadResultArray();
		$this->cleaninstall = (count($returns)==0);
//*****************************************************************************/
    $this->tableRenamer = 
      new TableRenamer($oldTableNames, $newTableNames);		
		$this->schemaUpdater = new SchemaUpdater( $sql_file_location );
		$this->extensionInstaller = new PerFormsExtensionInstaller($this->cleaninstall, $extensionInfo);
		$this->dataMigrator = new DataMigrator($this->cleaninstall, $migrateInfo);
		$this->userSchemaUpdater = new UserSchemaUpdater($this->cleaninstall);
  }
}
function com_install() {  
  $perFormsInstaller = new PerFormsDBInstaller();
  $perFormsInstaller->Install();
}

?>
