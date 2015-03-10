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

mysql_select_db($database_AirShow, $AirShow);
$query_rsGalleryCategory = "SELECT * FROM tbl_gallerycategories ORDER BY CategoryName ASC";
$rsGalleryCategory = mysql_query($query_rsGalleryCategory, $AirShow) or die(mysql_error());
$row_rsGalleryCategory = mysql_fetch_assoc($rsGalleryCategory);
$totalRows_rsGalleryCategory = mysql_num_rows($rsGalleryCategory);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../../assets/gallery/{rsGalleryCategory.ID}/");
$objDynamicThumb1->setRenameRule("{rsGalleryCategory.Photo}");
$objDynamicThumb1->setResize(100, 100, true);
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
        <td class="adminnav"><a href="Results.php">Galleries</a></td>
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
	<h1>Galleries Page</h1>
    <a href="Insert.php">Insert</a>
    <div id="dottedline"></div>
    <?php if ($totalRows_rsGalleryCategory > 0) { // Show if recordset not empty ?>
      <p>Click on Photo or Category Name to update.
      <table width="70%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="28%">&nbsp;</td>
          </tr>
        <?php do { ?>
          <tr>
            <td align="left" valign="top" class="tablecell"><a href="Update.php?ID=<?php echo $row_rsGalleryCategory['ID']; ?>"><img border="0" src="<?php echo $objDynamicThumb1->Execute(); ?>" alt="<?php echo $row_rsGalleryCategory['PhotoAlt']; ?>" name="photo" id="photo" /></a></td>
            <td width="36%" align="left" class="tablecell"><a href="Update.php?ID=<?php echo $row_rsGalleryCategory['ID']; ?>"><?php echo $row_rsGalleryCategory['CategoryName']; ?></a></td>
            <td width="36%" align="left" class="tablecell">| <a href="Delete.php?ID=<?php echo $row_rsGalleryCategory['ID']; ?>">Delete</a></td>
          </tr>
          <?php } while ($row_rsGalleryCategory = mysql_fetch_assoc($rsGalleryCategory)); ?>
      </table>
      <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_rsGalleryCategory == 0) { // Show if recordset empty ?>
        <p>There are no photo galleries at this time. Click on the "Insert" link above to create a photo gallery.</p>
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

mysql_free_result($rsGalleryCategory);
?>
