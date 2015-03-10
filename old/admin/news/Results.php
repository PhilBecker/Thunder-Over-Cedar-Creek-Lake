<?php require_once('../../Connections/AirShow.php'); ?>
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

$maxRows_rsNews = 20;
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>AirShow Creek Ranch Website Administration</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
        <td class="adminnav"><a href="Results.php">Press Releases</a></td>
      </tr>
      <tr>
        <td class="adminnav"><a href="../gallerycat/Results.php">Galleries</a></td>
      </tr>
      <tr>
        <td class="adminnav"><a href="../gallery/Results.php">Gallery Photos</a></td>
      </tr>
      <tr>
        <td class="adminnav">&nbsp;</td>
      </tr>
      <tr>
        <td class="adminnav">&nbsp;</td>
      </tr>
    </table></td>
    <td width="80%" valign="top" class="admincontent"><!-- InstanceBeginEditable name="Content" -->
	<h1>News Page</h1>
    <a href="Insert.php">Insert</a>
    <div id="dottedline"></div>    
    <?php if ($totalRows_rsNews > 0) { // Show if recordset not empty ?>
      <div id="records">News <?php echo ($startRow_rsNews + 1) ?> to <?php echo min($startRow_rsNews + $maxRows_rsNews, $totalRows_rsNews) ?> of <?php echo $totalRows_rsNews ?></div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="4"><table border="0" align="right">
            <tr>
              <td><?php if ($pageNum_rsNews > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, 0, $queryString_rsNews); ?>"><img src="First.gif" border="0" /></a>
                    <?php } // Show if not first page ?>              </td>
              <td><?php if ($pageNum_rsNews > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, max(0, $pageNum_rsNews - 1), $queryString_rsNews); ?>"><img src="Previous.gif" border="0" /></a>
                    <?php } // Show if not first page ?>              </td>
              <td><?php if ($pageNum_rsNews < $totalPages_rsNews) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, min($totalPages_rsNews, $pageNum_rsNews + 1), $queryString_rsNews); ?>"><img src="Next.gif" border="0" /></a>
                    <?php } // Show if not last page ?>              </td>
              <td><?php if ($pageNum_rsNews < $totalPages_rsNews) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, $totalPages_rsNews, $queryString_rsNews); ?>"><img src="Last.gif" border="0" /></a>
                    <?php } // Show if not last page ?>              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><h3>Date</h3></td>
          <td><h3>Title</h3></td>
          <td><h3>Author</h3></td>
          <td>&nbsp;</td>
      </tr>
        <?php do { ?>
          <tr class="<?php echo ($ac_sw1++%2==0)?"tablerow1":"tablerow2"; ?>" onmouseover="this.oldClassName = this.className; this.className='tablehighlight';" onmouseout="this.className = this.oldClassName;">
            <td valign="top" class="tablecell"><?php echo $row_rsNews['Date']; ?></td>
            <td valign="top" class="tablecell"><?php echo $row_rsNews['Title']; ?></td>
            <td valign="top" class="tablecell"><?php echo $row_rsNews['Author']; ?></td>
            <td valign="top"><a href="Detail.php?NewsID=<?php echo $row_rsNews['NewsID']; ?>">View</a> | <a href="Update.php?NewsID=<?php echo $row_rsNews['NewsID']; ?>">Update</a> | <a href="Delete.php?NewsID=<?php echo $row_rsNews['NewsID']; ?>">Delete</a></td>
          </tr>
          <?php } while ($row_rsNews = mysql_fetch_assoc($rsNews)); ?>
      </table>
      <div id="records">News <?php echo ($startRow_rsNews + 1) ?> to <?php echo min($startRow_rsNews + $maxRows_rsNews, $totalRows_rsNews) ?> of <?php echo $totalRows_rsNews ?></div>
      <table border="0" align="right">
        <tr>
          <td><?php if ($pageNum_rsNews > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, 0, $queryString_rsNews); ?>"><img src="First.gif" border="0" /></a>
                <?php } // Show if not first page ?>          </td>
          <td><?php if ($pageNum_rsNews > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, max(0, $pageNum_rsNews - 1), $queryString_rsNews); ?>"><img src="Previous.gif" border="0" /></a>
                <?php } // Show if not first page ?>          </td>
          <td><?php if ($pageNum_rsNews < $totalPages_rsNews) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, min($totalPages_rsNews, $pageNum_rsNews + 1), $queryString_rsNews); ?>"><img src="Next.gif" border="0" /></a>
                <?php } // Show if not last page ?>          </td>
          <td><?php if ($pageNum_rsNews < $totalPages_rsNews) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_rsNews=%d%s", $currentPage, $totalPages_rsNews, $queryString_rsNews); ?>"><img src="Last.gif" border="0" /></a>
                <?php } // Show if not last page ?>          </td>
        </tr>
      </table>
      <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_rsNews == 0) { // Show if recordset empty ?>
        <p>Click on the "Insert" link above to add a news item to the News page.</p>
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

mysql_free_result($rsNews);
?>
