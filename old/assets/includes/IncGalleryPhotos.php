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



$maxRows_rsGalleryPhotos = 20;

$pageNum_rsGalleryPhotos = 0;

if (isset($_GET['pageNum_rsGalleryPhotos'])) {

  $pageNum_rsGalleryPhotos = $_GET['pageNum_rsGalleryPhotos'];

}

$startRow_rsGalleryPhotos = $pageNum_rsGalleryPhotos * $maxRows_rsGalleryPhotos;



$colname_rsGalleryPhotos = "-1";

if (isset($_GET['Category'])) {

  $colname_rsGalleryPhotos = (get_magic_quotes_gpc()) ? $_GET['Category'] : addslashes($_GET['Category']);

}

mysql_select_db($database_AirShow, $AirShow);

$query_rsGalleryPhotos = sprintf("SELECT * FROM tbl_galleryphotos WHERE Category = %s ORDER BY PhotoID DESC", GetSQLValueString($colname_rsGalleryPhotos, "int"));

$query_limit_rsGalleryPhotos = sprintf("%s LIMIT %d, %d", $query_rsGalleryPhotos, $startRow_rsGalleryPhotos, $maxRows_rsGalleryPhotos);

$rsGalleryPhotos = mysql_query($query_limit_rsGalleryPhotos, $AirShow) or die(mysql_error());

$row_rsGalleryPhotos = mysql_fetch_assoc($rsGalleryPhotos);



if (isset($_GET['totalRows_rsGalleryPhotos'])) {

  $totalRows_rsGalleryPhotos = $_GET['totalRows_rsGalleryPhotos'];

} else {

  $all_rsGalleryPhotos = mysql_query($query_rsGalleryPhotos);

  $totalRows_rsGalleryPhotos = mysql_num_rows($all_rsGalleryPhotos);

}

$totalPages_rsGalleryPhotos = ceil($totalRows_rsGalleryPhotos/$maxRows_rsGalleryPhotos)-1;



$colname_rsCategoryName = "-1";

if (isset($_GET['Category'])) {

  $colname_rsCategoryName = (get_magic_quotes_gpc()) ? $_GET['Category'] : addslashes($_GET['Category']);

}

mysql_select_db($database_AirShow, $AirShow);

$query_rsCategoryName = sprintf("SELECT * FROM tbl_gallerycategories WHERE ID = %s", GetSQLValueString($colname_rsCategoryName, "int"));

$rsCategoryName = mysql_query($query_rsCategoryName, $AirShow) or die(mysql_error());

$row_rsCategoryName = mysql_fetch_assoc($rsCategoryName);

$totalRows_rsCategoryName = mysql_num_rows($rsCategoryName);



$queryString_rsGalleryPhotos = "";

if (!empty($_SERVER['QUERY_STRING'])) {

  $params = explode("&", $_SERVER['QUERY_STRING']);

  $newParams = array();

  foreach ($params as $param) {

    if (stristr($param, "pageNum_rsGalleryPhotos") == false && 

        stristr($param, "totalRows_rsGalleryPhotos") == false) {

      array_push($newParams, $param);

    }

  }

  if (count($newParams) != 0) {

    $queryString_rsGalleryPhotos = "&" . htmlentities(implode("&", $newParams));

  }

}

$queryString_rsGalleryPhotos = sprintf("&totalRows_rsGalleryPhotos=%d%s", $totalRows_rsGalleryPhotos, $queryString_rsGalleryPhotos);



// Show Dynamic Thumbnail

$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");

$objDynamicThumb1->setFolder("assets/gallery/{rsGalleryPhotos.Category}/");

$objDynamicThumb1->setRenameRule("{rsGalleryPhotos.Photo}");

$objDynamicThumb1->setResize(100, 100, true);

$objDynamicThumb1->setWatermark(false);

?>

<p><a href="Gallery.php">Back to Gallery</a> > <?php echo $row_rsCategoryName['CategoryName']; ?></p>

<?php if ($totalRows_rsGalleryPhotos > 0) { // Show if recordset not empty ?>

  <table border="0" cellpadding="5" cellspacing="0" >

    <tr>

      <?php

$rsGalleryPhotos_endRow = 0;

$rsGalleryPhotos_columns = 5; // number of columns

$rsGalleryPhotos_hloopRow1 = 0; // first row flag

do {

    if($rsGalleryPhotos_endRow == 0  && $rsGalleryPhotos_hloopRow1++ != 0) echo "<tr>";

   ?>

      <td align="center"><a href="assets/gallery/<?php echo $row_rsGalleryPhotos['Category']; ?>/<?php echo $row_rsGalleryPhotos['Photo']; ?>" rel="lightbox[gallery]" title="<?php echo $row_rsGalleryPhotos['Description']; ?>"><img src="<?php echo $objDynamicThumb1->Execute(); ?>" alt="<?php echo $row_rsGalleryPhotos['PhotoAlt']; ?>" name="thumb" vspace="5" border="0" class="contentimage"></a></td>

      <?php  $rsGalleryPhotos_endRow++;

if($rsGalleryPhotos_endRow >= $rsGalleryPhotos_columns) {

  ?>

    </tr>

    <?php

 $rsGalleryPhotos_endRow = 0;

  }

} while ($row_rsGalleryPhotos = mysql_fetch_assoc($rsGalleryPhotos));

if($rsGalleryPhotos_endRow != 0) {

while ($rsGalleryPhotos_endRow < $rsGalleryPhotos_columns) {

    echo("<td>&nbsp;</td>");

    $rsGalleryPhotos_endRow++;

}

echo("</tr>");

}?>

  </table>

  <table border="0" align="center">

    <tr>

      <td><?php if ($pageNum_rsGalleryPhotos > 0) { // Show if not first page ?>

            <a href="<?php printf("%s?pageNum_rsGalleryPhotos=%d%s", $currentPage, 0, $queryString_rsGalleryPhotos); ?>"><img src="assets/includes/First.gif" border="0" /></a>

      <?php } // Show if not first page ?>      </td>

      <td><?php if ($pageNum_rsGalleryPhotos > 0) { // Show if not first page ?>

            <a href="<?php printf("%s?pageNum_rsGalleryPhotos=%d%s", $currentPage, max(0, $pageNum_rsGalleryPhotos - 1), $queryString_rsGalleryPhotos); ?>"><img src="assets/includes/Previous.gif" border="0" /></a>

      <?php } // Show if not first page ?>      </td>

      <td><?php if ($pageNum_rsGalleryPhotos < $totalPages_rsGalleryPhotos) { // Show if not last page ?>

            <a href="<?php printf("%s?pageNum_rsGalleryPhotos=%d%s", $currentPage, min($totalPages_rsGalleryPhotos, $pageNum_rsGalleryPhotos + 1), $queryString_rsGalleryPhotos); ?>"><img src="assets/includes/Next.gif" border="0" /></a>

      <?php } // Show if not last page ?>      </td>

      <td><?php if ($pageNum_rsGalleryPhotos < $totalPages_rsGalleryPhotos) { // Show if not last page ?>

            <a href="<?php printf("%s?pageNum_rsGalleryPhotos=%d%s", $currentPage, $totalPages_rsGalleryPhotos, $queryString_rsGalleryPhotos); ?>"><img src="assets/includes/Last.gif" border="0" /></a>

      <?php } // Show if not last page ?>      </td>

    </tr>

  </table>

  <?php } // Show if recordset not empty ?>	

  <?php if ($totalRows_rsGalleryPhotos == 0) { // Show if recordset empty ?>

    <p>&nbsp;</p>

    <p>There are no photos that match your search at this time. Please check back later for updates.</p>

    <?php } // Show if recordset empty ?>

<?php

mysql_free_result($rsGalleryPhotos);



mysql_free_result($rsCategoryName);

?>