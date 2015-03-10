<?php require_once('../../Connections/AirShow.php'); ?>
<?php
// Load the common classes
require_once('../../includes/common/KT_common.php');

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

$colname_rsPhoto = "-1";
if (isset($_GET['PhotoID'])) {
  $colname_rsPhoto = (get_magic_quotes_gpc()) ? $_GET['PhotoID'] : addslashes($_GET['PhotoID']);
}
mysql_select_db($database_AirShow, $AirShow);
$query_rsPhoto = sprintf("SELECT tbl_galleryphotos.PhotoID, tbl_galleryphotos.`Date`, tbl_galleryphotos.Category, tbl_galleryphotos.`Description`, tbl_galleryphotos.Photo, tbl_galleryphotos.PhotoAlt, tbl_gallerycategories.ID, tbl_gallerycategories.CategoryName FROM tbl_galleryphotos, tbl_gallerycategories WHERE tbl_galleryphotos.PhotoID = %s AND tbl_galleryphotos.Category = tbl_gallerycategories.ID ORDER BY tbl_galleryphotos.`Date`", GetSQLValueString($colname_rsPhoto, "int"));
$rsPhoto = mysql_query($query_rsPhoto, $AirShow) or die(mysql_error());
$row_rsPhoto = mysql_fetch_assoc($rsPhoto);
$totalRows_rsPhoto = mysql_num_rows($rsPhoto);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../../assets/gallery/{rsPhoto.Category}/");
$objDynamicThumb1->setRenameRule("{rsPhoto.Photo}");
$objDynamicThumb1->setResize(400, 400, true);
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
	<h1>Photo Details</h1>
    <a href="Results.php">Results</a> | <a href="Insert.php">Insert Photo</a> | <a href="Update.php?PhotoID=<?php echo $row_rsPhoto['PhotoID']; ?>">Update</a> | <a href="Delete.php?PhotoID=<?php echo $row_rsPhoto['PhotoID']; ?>">Delete </a>
    <div id="dottedline"></div>
    <div align="center"></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top"><img border="0" src="<?php echo $objDynamicThumb1->Execute(); ?>" alt="<?php echo $row_rsPhoto['PhotoAlt']; ?>" name="photo" id="photo" /></td>
    </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td class="tablecell">&nbsp;</td>
  </tr>
  <tr>
    <th width="16%" valign="top" class="tablecell">Date:</th>
    <td width="84%" align="left" valign="top" class="tablecell"><?php echo KT_formatDate($row_rsPhoto['Date']); ?></td>
    </tr>
  <tr>
    <th valign="top" class="tablecell">Category:</th>
    <td align="left" valign="top" class="tablecell"><?php echo $row_rsPhoto['CategoryName']; ?></td>
    </tr>
  <tr>
    <th valign="top" class="tablecell">Photo Alt Text:</th>
    <td align="left" valign="top" class="tablecell"><?php echo $row_rsPhoto['PhotoAlt']; ?></td>
    </tr>
  <tr>
    <th valign="top" class="tablecell">Description:</th>
    <td align="left" valign="top" class="tablecell"><?php echo $row_rsPhoto['Description']; ?></td>
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

mysql_free_result($rsPhoto);
?>
