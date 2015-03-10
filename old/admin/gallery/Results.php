<?php require_once('../../Connections/AirShow.php'); ?>
<?php
//WA Database Search Include
require_once("../../WADbSearch/HelperPHP.php");
?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: rsPhotos;
//Searchpage: Results.php;
//Form: search;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if ((isset($_POST["WADbSearch1"])) && ($_POST["WADbSearch1"] != "")) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromList("Category","photocat","AND","=",1);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_Results"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_Results"]) && $_SESSION["WADbSearch1_Results"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_Results"];
    }
    else     {
      $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
    }
  }
  else     {
    $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
  }
}
$WADbSearch1->whereClause = str_replace("\\''", "''", $WADbSearch1->whereClause);
$WADbSearch1whereClause = '';
?>
<?php
// Load the tNG classes
require_once('../../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_AirShow = new KT_connection($AirShow, $database_AirShow);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_AirShow, "../../");
//Grand Levels: Any
$restrict->Execute();
//End Restrict Access To Page

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

mysql_select_db($database_AirShow, $AirShow);
$query_rsBusinessInfo = "SELECT * FROM tbl_businessinfo";
$rsBusinessInfo = mysql_query($query_rsBusinessInfo, $AirShow) or die(mysql_error());
$row_rsBusinessInfo = mysql_fetch_assoc($rsBusinessInfo);
$totalRows_rsBusinessInfo = mysql_num_rows($rsBusinessInfo);

$maxRows_rsPhotos = 20;
$pageNum_rsPhotos = 0;
if (isset($_GET['pageNum_rsPhotos'])) {
  $pageNum_rsPhotos = $_GET['pageNum_rsPhotos'];
}
$startRow_rsPhotos = $pageNum_rsPhotos * $maxRows_rsPhotos;

mysql_select_db($database_AirShow, $AirShow);
$query_rsPhotos = "SELECT tbl_galleryphotos.PhotoID, tbl_galleryphotos.`Date`, tbl_galleryphotos.Category, tbl_galleryphotos.`Description`, tbl_galleryphotos.Photo, tbl_galleryphotos.PhotoAlt, tbl_gallerycategories.ID, tbl_gallerycategories.CategoryName FROM tbl_galleryphotos, tbl_gallerycategories WHERE tbl_galleryphotos.Category = tbl_gallerycategories.ID ORDER BY tbl_galleryphotos.`Date`";
setQueryBuilderSource($query_rsPhotos,$WADbSearch1,false);
$query_limit_rsPhotos = sprintf("%s LIMIT %d, %d", $query_rsPhotos, $startRow_rsPhotos, $maxRows_rsPhotos);
$rsPhotos = mysql_query($query_limit_rsPhotos, $AirShow) or die(mysql_error());
$row_rsPhotos = mysql_fetch_assoc($rsPhotos);

if (isset($_GET['totalRows_rsPhotos'])) {
  $totalRows_rsPhotos = $_GET['totalRows_rsPhotos'];
} else {
  $all_rsPhotos = mysql_query($query_rsPhotos);
  $totalRows_rsPhotos = mysql_num_rows($all_rsPhotos);
}
$totalPages_rsPhotos = ceil($totalRows_rsPhotos/$maxRows_rsPhotos)-1;

mysql_select_db($database_AirShow, $AirShow);
$query_rsPhotoCat = "SELECT ID, CategoryName FROM tbl_gallerycategories ORDER BY CategoryName ASC";
$rsPhotoCat = mysql_query($query_rsPhotoCat, $AirShow) or die(mysql_error());
$row_rsPhotoCat = mysql_fetch_assoc($rsPhotoCat);
$totalRows_rsPhotoCat = mysql_num_rows($rsPhotoCat);

$queryString_rsPhotos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsPhotos") == false && 
        stristr($param, "totalRows_rsPhotos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsPhotos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsPhotos = sprintf("&totalRows_rsPhotos=%d%s", $totalRows_rsPhotos, $queryString_rsPhotos);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../../assets/gallery/{rsPhotos.Category}/");
$objDynamicThumb1->setRenameRule("{rsPhotos.Photo}");
$objDynamicThumb1->setResize(150, 150, true);
$objDynamicThumb1->setWatermark(false);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>AirShow Creek Ranch Website Administration</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEditableHeadTag -->

<!-- InstanceEndEditable -->
<link href="../../assets/css/admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="820" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="admintable">
  <tr>
    <td colspan="2" class="admintabletop">Website Administration</td>
  </tr>
  <tr>
    <td colspan="2" class="admintablehead">Thunder Over Cedar Creek Lake</td>
  </tr>
  <tr>
    <td width="20%" valign="top" class="adminnavcell"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="adminnavheader">Edit Content</td>
      </tr>
      <tr>
        <td class="adminnav"><a href="../index.php">Admin Home</a></td>
      </tr>
      <tr>
        <td class="adminnav"><a href="../news/Results.php">Press Releases</a></td>
      </tr>
      <tr>
        <td class="adminnav"><a href="../gallerycat/Results.php">Galleries</a></td>
      </tr>
      <tr>
        <td class="adminnav"><a href="Results.php">Gallery Photos</a></td>
      </tr>
      <tr>
        <td class="adminnav">&nbsp;</td>
      </tr>
      <tr>
        <td class="adminnav">&nbsp;</td>
      </tr>
    </table></td>
    <td width="80%" valign="top" class="admincontent"><!-- InstanceBeginEditable name="Content" -->
    <h1>Gallery Photos</h1>
    <form name="search" action="Results.php" method="post">
      <table cellpadding="2" cellspacing="0" border="0">
        <tr>
          <th align="right" class="tablecell">Category:</th>
            <td><select name="photocat" class="form">
              <option value="">All</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsPhotoCat['ID']?>"><?php echo $row_rsPhotoCat['CategoryName']?></option>
              <?php
} while ($row_rsPhotoCat = mysql_fetch_assoc($rsPhotoCat));
  $rows = mysql_num_rows($rsPhotoCat);
  if($rows > 0) {
      mysql_data_seek($rsPhotoCat, 0);
	  $row_rsPhotoCat = mysql_fetch_assoc($rsPhotoCat);
  }
?>
            </select></td>
            <td><input name="WADbSearch1" type="submit" class="form" value="Search" /></td>
          </tr>
        </table>
    </form>
    <a href="Insert.php">Insert </a>
    <div id="dottedline"></div>   
    <?php if ($totalRows_rsPhotos > 0) { // Show if recordset not empty ?>
      <div id="records">Photos <?php echo ($startRow_rsPhotos + 1) ?> to <?php echo min($startRow_rsPhotos + $maxRows_rsPhotos, $totalRows_rsPhotos) ?> of <?php echo $totalRows_rsPhotos ?></div>
      <table width="100%">
        <tr>
          <td><table border="0" align="right">
              <tr>
                <td><?php if ($pageNum_rsPhotos > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_rsPhotos=%d%s", $currentPage, 0, $queryString_rsPhotos); ?>"><img src="First.gif" border="0" /></a>
                      <?php } // Show if not first page ?>
                </td>
                <td><?php if ($pageNum_rsPhotos > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_rsPhotos=%d%s", $currentPage, max(0, $pageNum_rsPhotos - 1), $queryString_rsPhotos); ?>"><img src="Previous.gif" border="0" /></a>
                      <?php } // Show if not first page ?>
                </td>
                <td><?php if ($pageNum_rsPhotos < $totalPages_rsPhotos) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_rsPhotos=%d%s", $currentPage, min($totalPages_rsPhotos, $pageNum_rsPhotos + 1), $queryString_rsPhotos); ?>"><img src="Next.gif" border="0" /></a>
                      <?php } // Show if not last page ?>
                </td>
                <td><?php if ($pageNum_rsPhotos < $totalPages_rsPhotos) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_rsPhotos=%d%s", $currentPage, $totalPages_rsPhotos, $queryString_rsPhotos); ?>"><img src="Last.gif" border="0" /></a>
                      <?php } // Show if not last page ?>
                </td>
              </tr>
          </table></td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <?php
$rsPhotos_endRow = 0;
$rsPhotos_columns = 4; // number of columns
$rsPhotos_hloopRow1 = 0; // first row flag
do {
    if($rsPhotos_endRow == 0  && $rsPhotos_hloopRow1++ != 0) echo "<tr>";
   ?>
          <td align="center"><div id="galleryimages"><a href="Detail.php?PhotoID=<?php echo $row_rsPhotos['PhotoID']; ?>"><img src="<?php echo $objDynamicThumb1->Execute(); ?>" alt="<?php echo $row_rsPhotos['PhotoAlt']; ?>" name="thumb" border="0" id="thumb" /></a><br />
            Date: <?php echo $row_rsPhotos['Date']; ?><br />
            Category: <?php echo $row_rsPhotos['CategoryName']; ?></div></td>
          <?php  $rsPhotos_endRow++;
if($rsPhotos_endRow >= $rsPhotos_columns) {
  ?>
        </tr>
        <?php
 $rsPhotos_endRow = 0;
  }
} while ($row_rsPhotos = mysql_fetch_assoc($rsPhotos));
if($rsPhotos_endRow != 0) {
while ($rsPhotos_endRow < $rsPhotos_columns) {
    echo("<td>&nbsp;</td>");
    $rsPhotos_endRow++;
}
echo("</tr>");
}?>
      </table>
      <div id="records">Photos <?php echo ($startRow_rsPhotos + 1) ?> to <?php echo min($startRow_rsPhotos + $maxRows_rsPhotos, $totalRows_rsPhotos) ?> of <?php echo $totalRows_rsPhotos ?></div>
      <table border="0" align="right">
        <tr>
          <td><?php if ($pageNum_rsPhotos > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_rsPhotos=%d%s", $currentPage, 0, $queryString_rsPhotos); ?>"><img src="First.gif" border="0" /></a>
                <?php } // Show if not first page ?>
          </td>
          <td><?php if ($pageNum_rsPhotos > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_rsPhotos=%d%s", $currentPage, max(0, $pageNum_rsPhotos - 1), $queryString_rsPhotos); ?>"><img src="Previous.gif" border="0" /></a>
                <?php } // Show if not first page ?>
          </td>
          <td><?php if ($pageNum_rsPhotos < $totalPages_rsPhotos) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_rsPhotos=%d%s", $currentPage, min($totalPages_rsPhotos, $pageNum_rsPhotos + 1), $queryString_rsPhotos); ?>"><img src="Next.gif" border="0" /></a>
                <?php } // Show if not last page ?>
          </td>
          <td><?php if ($pageNum_rsPhotos < $totalPages_rsPhotos) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_rsPhotos=%d%s", $currentPage, $totalPages_rsPhotos, $queryString_rsPhotos); ?>"><img src="Last.gif" border="0" /></a>
                <?php } // Show if not last page ?></td>
        </tr>
      </table>
      <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_rsPhotos == 0) { // Show if recordset empty ?>
      <p>There are no photos that match your search at this time.</p>
      <?php } // Show if recordset empty ?>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="admintablebottom">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="admintabletop">Copyright &copy; 2009 Cross Timbers Marketing</td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsBusinessInfo);

mysql_free_result($rsPhotos);

mysql_free_result($rsPhotoCat);
?>
