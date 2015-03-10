<?php require_once('Connections/AirShow.php'); ?>

<?php

// Load the tNG classes

require_once('includes/tng/tNG.inc.php');



if (!function_exists("GetSQLValueString")) {

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 

{

  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;



  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);



  switch ($theType) {

    case "text":

      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

      break;    

    case "long":

    case "int":

      $theValue = ($theValue != "") ? intval($theValue) : "NULL";

      break;

    case "double":

      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";

      break;

    case "date":

      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

      break;

    case "defined":

      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;

      break;

  }

  return $theValue;

}

}



$colname_rsNews = "-1";

if (isset($_GET['NewsID'])) {

  $colname_rsNews = (get_magic_quotes_gpc()) ? $_GET['NewsID'] : addslashes($_GET['NewsID']);

}

mysql_select_db($database_AirShow, $AirShow);

$query_rsNews = sprintf("SELECT * FROM tbl_news WHERE NewsID = %s ORDER BY `Date` DESC", GetSQLValueString($colname_rsNews, "int"));

$rsNews = mysql_query($query_rsNews, $AirShow) or die(mysql_error());

$row_rsNews = mysql_fetch_assoc($rsNews);

$totalRows_rsNews = mysql_num_rows($rsNews);



mysql_select_db($database_AirShow, $AirShow);

$query_rsCompany = "SELECT BusinessName FROM tbl_businessinfo";

$rsCompany = mysql_query($query_rsCompany, $AirShow) or die(mysql_error());

$row_rsCompany = mysql_fetch_assoc($rsCompany);

$totalRows_rsCompany = mysql_num_rows($rsCompany);



// Show Dynamic Thumbnail

$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");

$objDynamicThumb1->setFolder("assets/newsphotos/");

$objDynamicThumb1->setRenameRule("{rsNews.Photo}");

$objDynamicThumb1->setResize(150, 150, true);

$objDynamicThumb1->setWatermark(false);

?>

<p><a href="Press.php">Back to Press Releases</a></p>

<h2><?php echo $row_rsNews['Title']; ?></h2>

<p>By <?php echo $row_rsNews['Author']; ?> - <?php echo $row_rsNews['Date']; ?></p>

<?php 

// Show If File Exists (region1)

if (tNG_fileExists("assets/newsphotos/", "{rsNews.Photo}")) {

?>

<img src="<?php echo $objDynamicThumb1->Execute(); ?>" alt="<?php echo $row_rsNews['PhotoAlt']; ?>" name="thumb" hspace="10" border="0" align="right" class="contentimage">

<?php } 

// EndIf File Exists (region1)

?>

<?php echo $row_rsNews['Copy']; ?>



<?php

mysql_free_result($rsNews);



mysql_free_result($rsCompany);

?>