<?php require_once('../../Connections/AirShow.php'); ?>
<?php require_once("../../WA_iRite/WARichEditorPHP.php"); ?>
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

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("Photo", true, "", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("Photo");
  $uploadObj->setDbFieldName("Photo");
  $uploadObj->setFolder("../../assets/gallery/{Category}/");
  $uploadObj->setResize("true", 700, 533);
  $uploadObj->setMaxSize(4000);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

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
$query_rsPhotoCat = "SELECT ID, CategoryName FROM tbl_gallerycategories ORDER BY CategoryName ASC";
$rsPhotoCat = mysql_query($query_rsPhotoCat, $AirShow) or die(mysql_error());
$row_rsPhotoCat = mysql_fetch_assoc($rsPhotoCat);
$totalRows_rsPhotoCat = mysql_num_rows($rsPhotoCat);

// Make an insert transaction instance
$ins_tbl_galleryphotos = new tNG_insert($conn_AirShow);
$tNGs->addTransaction($ins_tbl_galleryphotos);
// Register triggers
$ins_tbl_galleryphotos->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_tbl_galleryphotos->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_tbl_galleryphotos->registerTrigger("END", "Trigger_Default_Redirect", 99, "Detail.php?PhotoID={PhotoID}");
$ins_tbl_galleryphotos->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_tbl_galleryphotos->setTable("tbl_galleryphotos");
$ins_tbl_galleryphotos->addColumn("Category", "STRING_TYPE", "POST", "Category");
$ins_tbl_galleryphotos->addColumn("Description", "STRING_TYPE", "POST", "Description");
$ins_tbl_galleryphotos->addColumn("PhotoAlt", "STRING_TYPE", "POST", "PhotoAlt");
$ins_tbl_galleryphotos->addColumn("Photo", "FILE_TYPE", "FILES", "Photo");
$ins_tbl_galleryphotos->setPrimaryKey("PhotoID", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rstbl_galleryphotos = $tNGs->getRecordset("tbl_galleryphotos");
$row_rstbl_galleryphotos = mysql_fetch_assoc($rstbl_galleryphotos);
$totalRows_rstbl_galleryphotos = mysql_num_rows($rstbl_galleryphotos);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>AirShow Creek Ranch Website Administration</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEditableHeadTag -->

<script src="../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../includes/skins/style.js" type="text/javascript"></script>

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
    <td width="80%" valign="top" class="admincontent"><!-- InstanceBeginEditable name="Content" --><?php echo $tNGs->displayValidationRules();?>
	<h1>Insert Photo</h1>
    <a href="Results.php">Cancel</a>
    <div id="dottedline"></div>	
    <?php
	echo $tNGs->getErrorMsg();
?>
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
      <table cellpadding="2" cellspacing="0">
        <tr>
          <th width="102" valign="top" class="tablecell">Category:</th>
          <td width="523" align="left" valign="top" class="tablecell"><select name="Category" class="form" id="Category">
              <?php
do {  
?><option value="<?php echo $row_rsPhotoCat['ID']?>"<?php if (!(strcmp($row_rsPhotoCat['ID'], $row_rstbl_galleryphotos['Category']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsPhotoCat['CategoryName']?></option>
              <?php
} while ($row_rsPhotoCat = mysql_fetch_assoc($rsPhotoCat));
  $rows = mysql_num_rows($rsPhotoCat);
  if($rows > 0) {
      mysql_data_seek($rsPhotoCat, 0);
	  $row_rsPhotoCat = mysql_fetch_assoc($rsPhotoCat);
  }
?>
            </select>
              <?php echo $tNGs->displayFieldError("tbl_galleryphotos", "Category"); ?> </td>
        </tr>
        <tr>
          <th valign="top" class="tablecell">Description:</th>
          <td align="left" valign="top" class="tablecell"><?php
// WebAssist iRite: Rich Text Editor for Dreamweaver
$WARichTextEditor_1 = CreateRichTextEditor ("Description", "../../WA_iRite/", "100%", "200px", "Basic", "../custom/Insert_Description6.js", "".$row_rstbl_galleryphotos['Description']  ."");
?><?php echo $tNGs->displayFieldHint("Description");?> <?php echo $tNGs->displayFieldError("tbl_galleryphotos", "Description"); ?> </td>
        </tr>
        <tr>
          <th valign="top" class="tablecell">Photo Alt Text:</th>
          <td align="left" valign="top" class="tablecell"><input name="PhotoAlt" type="text" class="form" id="PhotoAlt" value="<?php echo KT_escapeAttribute($row_rstbl_galleryphotos['PhotoAlt']); ?>" size="50" />
              <?php echo $tNGs->displayFieldHint("PhotoAlt");?> <?php echo $tNGs->displayFieldError("tbl_galleryphotos", "PhotoAlt"); ?> </td>
        </tr>
        <tr>
          <th valign="top" class="tablecell">&nbsp;</th>
          <td align="left" valign="top" class="tablecell">* Photo file size is limited to 3 MB. For the fastest upload results, optimize photos before adding to the website.</td>
        </tr>
        <tr>
          <th valign="top" class="tablecell">Photo:</th>
          <td align="left" valign="top" class="tablecell"><input name="Photo" type="file" class="form" id="Photo" size="32" />
              <?php echo $tNGs->displayFieldError("tbl_galleryphotos", "Photo"); ?> </td>
        </tr>
        <tr>
          <td valign="top" class="tablecell">&nbsp;</td>
          <td align="left" valign="top" class="tablecell">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="tablecell">&nbsp;</td>
          <td align="left" valign="top" class="tablecell"><input name="KT_Insert1" type="submit" class="form" id="KT_Insert1" value="Insert" /></td>
        </tr>
      </table>
    </form>
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

mysql_free_result($rsPhotoCat);
?>
