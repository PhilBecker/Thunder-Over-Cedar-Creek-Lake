<?php require_once('Connections/AirShow.php'); ?>

<?php

// Load the common classes

require_once('includes/common/KT_common.php');



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



$currentPage = $_SERVER["PHP_SELF"];



$maxRows_rsNews = 10;

$pageNum_rsNews = 0;

if (isset($_GET['pageNum_rsNews'])) {

  $pageNum_rsNews = $_GET['pageNum_rsNews'];

}

$startRow_rsNews = $pageNum_rsNews * $maxRows_rsNews;



mysql_select_db($database_AirShow, $AirShow);

$query_rsNews = "SELECT * FROM tbl_news ORDER BY `Date` DESC";

$query_limit_rsNews = sprintf("%s LIMIT %d, %d", $query_rsNews, $startRow_rsNews, $maxRows_rsNews);

$rsNews = mysql_query($query_limit_rsNews, $AirShow) or die(mysql_error());

$row_rsNews = mysql_fetch_assoc($rsNews);



if (isset($_GET['totalRows_rsNews'])) {

  $totalRows_rsNews = $_GET['totalRows_rsNews'];

} else {

  $all_rsNews = mysql_query($query_rsNews);

  $totalRows_rsNews = mysql_num_rows($all_rsNews);

}

$totalPages_rsNews = ceil($totalRows_rsNews/$maxRows_rsNews)-1;



mysql_select_db($database_AirShow, $AirShow);

$query_rsCompany = "SELECT BusinessName FROM tbl_businessinfo";

$rsCompany = mysql_query($query_rsCompany, $AirShow) or die(mysql_error());

$row_rsCompany = mysql_fetch_assoc($rsCompany);

$totalRows_rsCompany = mysql_num_rows($rsCompany);



$queryString_rsNews = "";

if (!empty($_SERVER['QUERY_STRING'])) {

  $params = explode("&", $_SERVER['QUERY_STRING']);

  $newParams = array();

  foreach ($params as $param) {

    if (stristr($param, "pageNum_rsNews") == false && 

        stristr($param, "totalRows_rsNews") == false) {

      array_push($newParams, $param);

    }

  }

  if (count($newParams) != 0) {

    $queryString_rsNews = "&" . htmlentities(implode("&", $newParams));

  }

}

$queryString_rsNews = sprintf("&totalRows_rsNews=%d%s", $totalRows_rsNews, $queryString_rsNews);



// Show Dynamic Thumbnail

$objDynamicThumb1 = new tNG_DynamicThumbnail("", "KT_thumbnail1");

$objDynamicThumb1->setFolder("assets/newsphotos/");

$objDynamicThumb1->setRenameRule("{rsNews.Photo}");

$objDynamicThumb1->setResize(150, 150, true);

$objDynamicThumb1->setWatermark(false);

?>

<?php if ($totalRows_rsNews > 0) { // Show if recordset not empty ?>

  <?php do { ?>

   	 <?php 

// Show If File Exists (region1)

if (tNG_fileExists("assets/newsphotos/", "{rsNews.Photo}")) {

?><img src="<?php echo $objDynamicThumb1->Execute(); ?>" alt="<?php echo $row_rsNews['PhotoAlt']; ?>" name="thumb" hspace="10" border="0" align="right" class="contentimage">

   	     <?php } 

// EndIf File Exists (region1)

?>  <h2><?php echo KT_formatDate($row_rsNews['Date']); ?> - <?php echo $row_rsNews['Title']; ?></h2>

    <?php echo $row_rsNews['Short']; ?>

    <p>> <a href="PressDetail.php?NewsID=<?php echo $row_rsNews['NewsID']; ?>">read more</a></p>

    <div id="dottedline"></div>

    <?php } while ($row_rsNews = mysql_fetch_assoc($rsNews)); ?>

  <table border="0">

    <tr>

      <td><?php if ($pageNum_rsNews > 0) { // Show if not first page ?>

              <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, 0, $queryString_rsNews); ?>"><img src="assets/includes/First.gif" border="0" /></a>

      <?php } // Show if not first page ?>                  </td>

      <td><?php if ($pageNum_rsNews > 0) { // Show if not first page ?>

              <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, max(0, $pageNum_rsNews - 1), $queryString_rsNews); ?>"><img src="assets/includes/Previous.gif" border="0" /></a>

      <?php } // Show if not first page ?>                  </td>

      <td><?php if ($pageNum_rsNews < $totalPages_rsNews) { // Show if not last page ?>

              <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, min($totalPages_rsNews, $pageNum_rsNews + 1), $queryString_rsNews); ?>"><img src="assets/includes/Next.gif" border="0" /></a>

      <?php } // Show if not last page ?>                  </td>

      <td><?php if ($pageNum_rsNews < $totalPages_rsNews) { // Show if not last page ?>

              <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, $totalPages_rsNews, $queryString_rsNews); ?>"><img src="assets/includes/Last.gif" border="0" /></a>

      <?php } // Show if not last page ?>                  </td>

    </tr>

      </table>

  <?php } // Show if recordset not empty ?>

<?php if ($totalRows_rsNews == 0) { // Show if recordset empty ?>

    <p>There are no news posts at this time. Please check back later for updated information.</p>

    <?php } // Show if recordset empty ?>

<?php

mysql_free_result($rsNews);



mysql_free_result($rsCompany);

?>