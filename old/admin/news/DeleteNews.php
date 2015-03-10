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

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../../assets/newsphotos/");
  $deleteObj->setDbFieldName("Photo");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

// Make an instance of the transaction object
$del_tbl_news = new tNG_delete($conn_AirShow);
$tNGs->addTransaction($del_tbl_news);
// Register triggers
$del_tbl_news->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "GET", "NewsID");
$del_tbl_news->registerTrigger("END", "Trigger_Default_Redirect", 99, "Results.php");
$del_tbl_news->registerTrigger("AFTER", "Trigger_FileDelete", 70);
// Add columns
$del_tbl_news->setTable("tbl_news");
$del_tbl_news->setPrimaryKey("NewsID", "NUMERIC_TYPE", "GET", "NewsID");

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
