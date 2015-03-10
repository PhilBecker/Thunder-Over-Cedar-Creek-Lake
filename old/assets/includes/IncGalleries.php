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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsGalleries = 12;
$pageNum_rsGalleries = 0;
if (isset($_GET['pageNum_rsGalleries'])) {
  $pageNum_rsGalleries = $_GET['pageNum_rsGalleries'];
}
$startRow_rsGalleries = $pageNum_rsGalleries * $maxRows_rsGalleries;

mysql_select_db($database_AirShow, $AirShow);
$query_rsGalleries = "SELECT * FROM tbl_gallerycategories ORDER BY CategoryName ASC";
$query_limit_rsGalleries = sprintf("%s LIMIT %d, %d", $query_rsGalleries, $startRow_rsGalleries, $maxRows_rsGalleries);
$rsGalleries = mysql_query($query_limit_rsGalleries, $AirShow) or die(mysql_error());
$row_rsGalleries = mysql_fetch_assoc($rsGalleries);

if (isset($_GET['totalRows_rsGalleries'])) {
  $totalRows_rsGalleries = $_GET['totalRows_rsGalleries'];
} else {
  $all_rsGalleries = mysql_query($query_rsGalleries);
  $totalRows_rsGalleries = mysql_num_rows($all_rsGalleries);
}
$totalPages_rsGalleries = ceil($totalRows_rsGalleries/$maxRows_rsGalleries)-1;

$queryString_rsGalleries = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsGalleries") == false && 
        stristr($param, "totalRows_rsGalleries") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsGalleries = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsGalleries = sprintf("&totalRows_rsGalleries=%d%s", $totalRows_rsGalleries, $queryString_rsGalleries);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("assets/gallery/{rsGalleries.ID}/");
$objDynamicThumb1->setRenameRule("{rsGalleries.Photo}");
$objDynamicThumb1->setResize(150, 150, true);
$objDynamicThumb1->setWatermark(false);
?>
<?php if ($totalRows_rsGalleries > 0) { // Show if recordset not empty ?>
    <table align="left" cellpadding="3" >
      <tr>
        <?php
$rsGalleries_endRow = 0;
$rsGalleries_columns = 3; // number of columns
$rsGalleries_hloopRow1 = 0; // first row flag
do {
    if($rsGalleries_endRow == 0  && $rsGalleries_hloopRow1++ != 0) echo "<tr>";
   ?>
        <td><a href="GalleryDetail.php?Category=<?php echo $row_rsGalleries['ID']; ?>"><img src="<?php echo $objDynamicThumb1->Execute(); ?>" alt="<?php echo $row_rsGalleries['PhotoAlt']; ?>" name="thumb" border="0" class="contentimage" id="thumb" /></a><br />          <div id="galleryname"><?php echo $row_rsGalleries['CategoryName']; ?></div></td>
        <?php  $rsGalleries_endRow++;
if($rsGalleries_endRow >= $rsGalleries_columns) {
  ?>
      </tr>
      <?php
 $rsGalleries_endRow = 0;
  }
} while ($row_rsGalleries = mysql_fetch_assoc($rsGalleries));
if($rsGalleries_endRow != 0) {
while ($rsGalleries_endRow < $rsGalleries_columns) {
    echo("<td>&nbsp;</td>");
    $rsGalleries_endRow++;
}
echo("</tr>");
}?>
    </table>	
<table border="0" align="center">
      <tr>
        <td><?php if ($pageNum_rsGalleries > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_rsGalleries=%d%s", $currentPage, 0, $queryString_rsGalleries); ?>"><img src="assets/includes/First.gif" border="0" /></a>
              <?php } // Show if not first page ?>
        </td>
        <td><?php if ($pageNum_rsGalleries > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_rsGalleries=%d%s", $currentPage, max(0, $pageNum_rsGalleries - 1), $queryString_rsGalleries); ?>"><img src="assets/includes/Previous.gif" border="0" /></a>
              <?php } // Show if not first page ?>
        </td>
        <td><?php if ($pageNum_rsGalleries < $totalPages_rsGalleries) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_rsGalleries=%d%s", $currentPage, min($totalPages_rsGalleries, $pageNum_rsGalleries + 1), $queryString_rsGalleries); ?>"><img src="assets/includes/Next.gif" border="0" /></a>
              <?php } // Show if not last page ?>
        </td>
        <td><?php if ($pageNum_rsGalleries < $totalPages_rsGalleries) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_rsGalleries=%d%s", $currentPage, $totalPages_rsGalleries, $queryString_rsGalleries); ?>"><img src="assets/includes/Last.gif" border="0" /></a>
              <?php } // Show if not last page ?>
        </td>
      </tr>
  </table>
    <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_rsGalleries == 0) { // Show if recordset empty ?>
  <p>There are no photo galleries a this time. Please check back later as we continuously update our website.</p>
  <?php } // Show if recordset empty ?>
<?php
mysql_free_result($rsGalleries);
?>