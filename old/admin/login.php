<?php require_once('../Connections/AirShow.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_AirShow = new KT_connection($AirShow, $database_AirShow);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("kt_login_user", true, "text", "", "", "", "");
$formValidation->addField("kt_login_password", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

// Make a login transaction instance
$loginTransaction = new tNG_login($conn_AirShow);
$tNGs->addTransaction($loginTransaction);
// Register triggers
$loginTransaction->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "kt_login1");
$loginTransaction->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$loginTransaction->registerTrigger("END", "Trigger_Default_Redirect", 99, "{kt_login_redirect}");
// Add columns
$loginTransaction->addColumn("kt_login_user", "STRING_TYPE", "POST", "kt_login_user");
$loginTransaction->addColumn("kt_login_password", "STRING_TYPE", "POST", "kt_login_password");
$loginTransaction->addColumn("kt_login_rememberme", "CHECKBOX_1_0_TYPE", "POST", "kt_login_rememberme", "0");
// End of login transaction instance

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustom = $tNGs->getRecordset("custom");
$row_rscustom = mysql_fetch_assoc($rscustom);
$totalRows_rscustom = mysql_num_rows($rscustom);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Website Administration</title>


<!-- InstanceEditableHeadTag -->
<link href="../assets/css/admin.css" rel="stylesheet" type="text/css" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<table width="600" align="center" cellpadding="10" bgcolor="#FFFFFF" class="admintable">
  <tr>
    <td><h3>Administrative Login</h3>
    
    
      <?php
	echo $tNGs->getLoginMsg();
?>
      <?php
	echo $tNGs->getErrorMsg();
?>
      <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
        <table align="center" cellpadding="2" cellspacing="0">
          <tr>
            <th valign="top" class="tablecell">Username:</th>
            <td align="right" valign="top" class="tablecell"><input name="kt_login_user" type="text" class="form" id="kt_login_user" value="<?php echo KT_escapeAttribute($row_rscustom['kt_login_user']); ?>" size="32" />
            <?php echo $tNGs->displayFieldHint("kt_login_user");?> <?php echo $tNGs->displayFieldError("custom", "kt_login_user"); ?> </td>
          </tr>
          <tr>
            <th valign="top" class="tablecell">Password:</th>
            <td align="right" valign="top" class="tablecell"><input name="kt_login_password" type="password" class="form" id="kt_login_password" value="" size="32" />
            <?php echo $tNGs->displayFieldHint("kt_login_password");?> <?php echo $tNGs->displayFieldError("custom", "kt_login_password"); ?> </td>
          </tr>
          <tr>
            <th valign="top" class="tablecell">Remember me:</th>
      <td valign="top" class="tablecell"><input name="kt_login_rememberme" type="checkbox" class="form" id="kt_login_rememberme" value="1"  <?php if (!(strcmp(KT_escapeAttribute($row_rscustom['kt_login_rememberme']),"1"))) {echo "checked";} ?> />
                <?php echo $tNGs->displayFieldError("custom", "kt_login_rememberme"); ?> </td>
          </tr>
          <tr align="right" class="KT_buttons">
            <td colspan="2"><input name="kt_login1" type="submit" class="form" id="kt_login1" value="Login" />            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
</body>
</html>
