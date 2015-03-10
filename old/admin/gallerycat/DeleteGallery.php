<?php require_once('../../Connections/AirShow.php'); ?>
<?php
// Load the common classes
require_once('../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../../");

// Make unified connection variable
$conn_AirShow = new KT_connection($AirShow, $database_AirShow);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_AirShow, "../../");
//Grand Levels: Any
$restrict->Execute();
//End Restrict Access To Page

//start Trigger_DeleteFolder trigger
//remove this line if you want to edit the code by hand 
function Trigger_DeleteFolder(&$tNG) {
  $deleteObj = new tNG_DeleteFolder($tNG);
  $deleteObj->setBaseFolder("../../assets/gallery/");
  $deleteObj->setFolder("{ID}");
  return $deleteObj->Execute();
}
//end Trigger_DeleteFolder trigger

// Make an instance of the transaction object
$del_tbl_gallerycategories = new tNG_delete($conn_AirShow);
$tNGs->addTransaction($del_tbl_gallerycategories);
// Register triggers
$del_tbl_gallerycategories->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "GET", "ID");
$del_tbl_gallerycategories->registerTrigger("END", "Trigger_Default_Redirect", 99, "Results.php");
$del_tbl_gallerycategories->registerTrigger("AFTER", "Trigger_DeleteFolder", 99);
// Add columns
$del_tbl_gallerycategories->setTable("tbl_gallerycategories");
$del_tbl_gallerycategories->setPrimaryKey("ID", "NUMERIC_TYPE", "GET", "ID");

// Execute all the registered transactions
$tNGs->executeTransactions();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../includes/skins/style.js" type="text/javascript"></script>
</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?>
</body>
</html>
