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

mysql_select_db($database_AirShow, $AirShow);
$query_rsBusinessInfo = "SELECT * FROM tbl_businessinfo";
$rsBusinessInfo = mysql_query($query_rsBusinessInfo, $AirShow) or die(mysql_error());
$row_rsBusinessInfo = mysql_fetch_assoc($rsBusinessInfo);
$totalRows_rsBusinessInfo = mysql_num_rows($rsBusinessInfo);

$colname_rsNews = "-1";
if (isset($_GET['NewsID'])) {
  $colname_rsNews = (get_magic_quotes_gpc()) ? $_GET['NewsID'] : addslashes($_GET['NewsID']);
}
mysql_select_db($database_AirShow, $AirShow);
$query_rsNews = sprintf("SELECT * FROM tbl_news WHERE NewsID = %s", GetSQLValueString($colname_rsNews, "int"));
$rsNews = mysql_query($query_rsNews, $AirShow) or die(mysql_error());
$row_rsNews = mysql_fetch_assoc($rsNews);
$totalRows_rsNews = mysql_num_rows($rsNews);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../../assets/newsphotos/");
$objDynamicThumb1->setRenameRule("{rsNews.Photo}");
$objDynamicThumb1->setResize(250, 250, true);
$objDynamicThumb1->setWatermark(false);
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
	<h1>Delete News</h1>
    <p>Are your sure you want to delete news story?</p>
    <a href="DeleteNews.php?NewsID=<?php echo $row_rsNews['NewsID']; ?>">Delete</a> | <a href="Results.php">Cancel</a>
    <div id="dottedline"></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th valign="top">&nbsp;</th>
        <td valign="top" class="tablecell">&nbsp;</td>
      </tr>
      <tr>
        <th width="17%" valign="top" class="tablecell">Date:</th>
        <td width="83%" valign="top" class="tablecell"><?php echo $row_rsNews['Date']; ?></td>
      </tr>
      <tr>
        <th valign="top" class="tablecell">Author:</th>
        <td valign="top" class="tablecell"><?php echo $row_rsNews['Author']; ?></td>
      </tr>
      <tr>
        <th valign="top" class="tablecell">Title:</th>
        <td valign="top" class="tablecell"><?php echo $row_rsNews['Title']; ?></td>
      </tr>
      <tr>
        <th valign="top" class="tablecell">Short:</th>
        <td valign="top" class="tablecell"><?php echo $row_rsNews['Short']; ?></td>
      </tr>
      <tr>
        <th valign="top" class="tablecell">Copy:</th>
        <td valign="top" class="tablecell"><?php echo $row_rsNews['Copy']; ?></td>
      </tr>
      <tr>
        <th valign="top" class="tablecell">Photo:</th>
        <td valign="top" class="tablecell"><img border="0" src="<?php echo $objDynamicThumb1->Execute(); ?>" alt="" name="photo" id="photo" /></td>
      </tr>
      <tr>
        <th valign="top" class="tablecell">Photo Alt:</th>
        <td valign="top" class="tablecell"><?php echo $row_rsNews['PhotoAlt']; ?></td>
      </tr>
    </table>
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
