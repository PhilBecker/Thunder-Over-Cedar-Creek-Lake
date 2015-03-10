<?php require_once('../Connections/CCVF.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("");

// Make unified connection variable
$conn_CCVF = new KT_connection($CCVF, $database_CCVF);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("CreditCardNo", true, "text", "", "", "", "");
$formValidation->addField("ExpMth", true, "text", "", "", "", "");
$formValidation->addField("ExpYr", true, "numeric", "int", "", "", "");
$formValidation->addField("CVVcode", true, "numeric", "int", "", "", "");
$formValidation->addField("FName", true, "text", "", "", "", "");
$formValidation->addField("LName", true, "text", "", "", "", "");
$formValidation->addField("Email", true, "text", "email", "", "", "");
$formValidation->addField("Phone", true, "text", "phone", "", "", "");
$formValidation->addField("Address1", true, "text", "", "", "", "");
$formValidation->addField("City", true, "text", "", "", "", "");
$formValidation->addField("State", true, "text", "", "", "", "");
$formValidation->addField("Zip", true, "numeric", "zip_generic", "", "", "");
$formValidation->addField("Country", true, "text", "", "", "", "");
$formValidation->addField("DonationAmt", true, "double", "", "", "", "");
$formValidation->addField("TicketTotal", true, "double", "", "", "", "");
$formValidation->addField("ChargeCC", true, "double", "", "", "", "");
$formValidation->addField("FNameD", true, "text", "", "", "", "");
$formValidation->addField("LNameD", true, "text", "", "", "", "");
$formValidation->addField("EmailD", true, "text", "", "", "", "");
$formValidation->addField("PhoneD", true, "text", "", "", "", "");
$formValidation->addField("Address1D", true, "text", "", "", "", "");
$formValidation->addField("CityD", true, "text", "", "", "", "");
$formValidation->addField("StateD", true, "text", "", "", "", "");
$formValidation->addField("ZipD", true, "numeric", "", "", "", "");
$formValidation->addField("CountryD", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

// Make an insert transaction instance
$ins_tbl_tickets = new tNG_insert($conn_CCVF);
$tNGs->addTransaction($ins_tbl_tickets);
// Register triggers
$ins_tbl_tickets->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_tbl_tickets->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_tbl_tickets->registerTrigger("END", "Trigger_Default_Redirect", 99, "TicketsPurchased.php?ID={ID}");
// Add columns
$ins_tbl_tickets->setTable("tbl_tickets");
$ins_tbl_tickets->addColumn("CreditCard", "STRING_TYPE", "POST", "CreditCard");
$ins_tbl_tickets->addColumn("CreditCardNo", "STRING_TYPE", "POST", "CreditCardNo");
$ins_tbl_tickets->addColumn("ExpMth", "STRING_TYPE", "POST", "ExpMth");
$ins_tbl_tickets->addColumn("ExpYr", "NUMERIC_TYPE", "POST", "ExpYr");
$ins_tbl_tickets->addColumn("CVVcode", "NUMERIC_TYPE", "POST", "CVVcode");
$ins_tbl_tickets->addColumn("FName", "STRING_TYPE", "POST", "FName");
$ins_tbl_tickets->addColumn("LName", "STRING_TYPE", "POST", "LName");
$ins_tbl_tickets->addColumn("Email", "STRING_TYPE", "POST", "Email");
$ins_tbl_tickets->addColumn("Phone", "STRING_TYPE", "POST", "Phone");
$ins_tbl_tickets->addColumn("Address1", "STRING_TYPE", "POST", "Address1");
$ins_tbl_tickets->addColumn("Address2", "STRING_TYPE", "POST", "Address2");
$ins_tbl_tickets->addColumn("City", "STRING_TYPE", "POST", "City");
$ins_tbl_tickets->addColumn("State", "STRING_TYPE", "POST", "State");
$ins_tbl_tickets->addColumn("Zip", "NUMERIC_TYPE", "POST", "Zip");
$ins_tbl_tickets->addColumn("Country", "STRING_TYPE", "POST", "Country");
$ins_tbl_tickets->addColumn("DonationAmt", "DOUBLE_TYPE", "POST", "DonationAmt");
$ins_tbl_tickets->addColumn("VIP", "NUMERIC_TYPE", "POST", "VIP");
$ins_tbl_tickets->addColumn("Adult", "NUMERIC_TYPE", "POST", "Adult");
$ins_tbl_tickets->addColumn("Child", "NUMERIC_TYPE", "POST", "Child");
$ins_tbl_tickets->addColumn("TicketTotal", "DOUBLE_TYPE", "POST", "TicketTotal");
$ins_tbl_tickets->addColumn("ChargeCC", "DOUBLE_TYPE", "POST", "ChargeCC");
$ins_tbl_tickets->addColumn("FNameD", "STRING_TYPE", "POST", "FNameD");
$ins_tbl_tickets->addColumn("LNameD", "STRING_TYPE", "POST", "LNameD");
$ins_tbl_tickets->addColumn("EmailD", "STRING_TYPE", "POST", "EmailD");
$ins_tbl_tickets->addColumn("PhoneD", "STRING_TYPE", "POST", "PhoneD");
$ins_tbl_tickets->addColumn("Address1D", "STRING_TYPE", "POST", "Address1D");
$ins_tbl_tickets->addColumn("Address2D", "STRING_TYPE", "POST", "Address2D");
$ins_tbl_tickets->addColumn("CityD", "STRING_TYPE", "POST", "CityD");
$ins_tbl_tickets->addColumn("StateD", "STRING_TYPE", "POST", "StateD");
$ins_tbl_tickets->addColumn("ZipD", "NUMERIC_TYPE", "POST", "ZipD");
$ins_tbl_tickets->addColumn("CountryD", "STRING_TYPE", "POST", "CountryD");
$ins_tbl_tickets->setPrimaryKey("ID", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rstbl_tickets = $tNGs->getRecordset("tbl_tickets");
$row_rstbl_tickets = mysql_fetch_assoc($rstbl_tickets);
$totalRows_rstbl_tickets = mysql_num_rows($rstbl_tickets);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cedar Creek Veterans Foundation</title>
<link href="../assets/css/main.css" rel="stylesheet" type="text/css" />

<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<table width="810" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="topcap">&nbsp;</td>
  </tr>
  <tr>
    <td class="navbar">
    <div id="webaddress">CCVeteransFoundation.org</div>
    <div id="topnav"><a href="../index.php">home</a> | <a href="../Contact.php">contact</a></div>    </td>
  </tr>
  <tr>
    <td class="header"><img src="../assets/layout/support_header_03.jpg" width="810" height="400" /></td>
  </tr>
  <tr>
    <td class="contentbackground">
    <div id="navcontainer">
    <div class="pagefocus">Support</div>
    <div class="navlink"><a href="../Donors.php">Donors</a></div>
    <div class="navlink"><a href="../AboutUs.php">About Us</a></div>
    <div class="navlink"><a href="../Events.php">Events</a></div>
    <div class="navlink"><a href="../Gallery.php">Photo Gallery</a></div>
    <div class="navlink"><a href="../Press.php">Press Releases</a></div>
    <div class="navlink"><a href="../Contact.php">Contact Us</a></div>
    </div>
    <div id="contentcontainer">
    <h1>Purchase Air Show Tickets</h1>
    <p><< <a href="../Support.php">Back to the Support Page</a></p>
    <p>Use our secure online donation form to donate and purchase air show tickets using your Visa, MasterCard, Discover, or American Express.</p>    
    <p>* Indicates a required field. <strong>PLEASE COMPLETE THE ENTIRE FORM!</strong></p>    
    <?php
	echo $tNGs->getErrorMsg();
?>
    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
      <table width="95%" cellpadding="5" cellspacing="0" class="formtable">
        <tr>
          <td colspan="2" class="formheader">TIcket Information</td>
        </tr>
        <tr>
          <td class="formtext">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="formtext"><label for="label20"># of Air Show VIPs</label></td>
          <td><input type="text" name="VIP" id="VIP" value="<?php echo KT_escapeAttribute($row_rstbl_donations['VIP']); ?>" size="32" /> 
            @ $50 each
              <?php echo $tNGs->displayFieldHint("VIP");?> <?php echo $tNGs->displayFieldError("tbl_donations", "VIP"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label19"># of Pilot Party<br />
            
            Adult Tickets</label></td>
          <td><input type="text" name="Adult" id="Adult" value="<?php echo KT_escapeAttribute($row_rstbl_donations['Adult']); ?>" size="32" />
              @ $20 <?php echo $tNGs->displayFieldHint("Adult");?> <?php echo $tNGs->displayFieldError("tbl_donations", "Adult"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label18"># of Pilot Party<br />
          Children Tickets</label></td>
          <td><input type="text" name="Child" id="Child" value="<?php echo KT_escapeAttribute($row_rstbl_donations['Child']); ?>" size="32" />
              @ $12 <?php echo $tNGs->displayFieldHint("Child");?> <?php echo $tNGs->displayFieldError("tbl_donations", "Child"); ?> </td>
        </tr>
        <tr>
          <td class="formtext">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="formtext"><label for="label17">* Total  Ticket Purchase </label></td>
          <td>$
            <input type="text" name="TicketTotal" id="TicketTotal" value="<?php echo KT_escapeAttribute($row_rstbl_donations['TicketTotal']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("TicketTotal");?> <?php echo $tNGs->displayFieldError("tbl_donations", "TicketTotal"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label16"></label></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="formtext"><label for="label15">Additional Donation to CCVF</label></td>
          <td>$ 
            <input type="text" name="DonationAmt" id="DonationAmt" value="<?php echo KT_escapeAttribute($row_rstbl_donations['DonationAmt']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("DonationAmt");?> <?php echo $tNGs->displayFieldError("tbl_donations", "DonationAmt"); ?> </td>
        </tr>
        <tr>
          <td class="formtext">&nbsp;</td>
          <td><p>(Cedar  Creek Veterans Foundation is a 501(c)(3) organization - donations are  tax deductible to the extent allowed by law.)</p></td>
        </tr>
        <tr>
          <td class="formtext"><label for="label14">Total Charge to<br />
            Credit Card</label></td>
          <td>$
            <input type="text" name="ChargeCC" id="ChargeCC" value="<?php echo KT_escapeAttribute($row_rstbl_donations['CChargeCC']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("ChargeCC");?> <?php echo $tNGs->displayFieldError("tbl_donations", "ChargeCC"); ?> </td>
        </tr>
        <tr>
          <td colspan="2" class="formrowspacer">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="formheader">TIcket Delivery  Information</td>
        </tr>
        <tr>
          <td class="formtext">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="formtext"><label for="label10">* First Name</label></td>
          <td><input type="text" name="FNameD" id="FNameD" value="<?php echo KT_escapeAttribute($row_rstbl_donations['FNameD']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("FNameD");?> <?php echo $tNGs->displayFieldError("tbl_donations", "FNameD"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label9">* Last Name</label></td>
          <td><input type="text" name="LNameD" id="LNameD" value="<?php echo KT_escapeAttribute($row_rstbl_donations['LNameD']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("LNameD");?> <?php echo $tNGs->displayFieldError("tbl_donations", "LNameD"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label8">* Email</label></td>
          <td><input type="text" name="EmailD" id="EmailD" value="<?php echo KT_escapeAttribute($row_rstbl_donations['EmailD']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("EmailD");?> <?php echo $tNGs->displayFieldError("tbl_donations", "EmailD"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label7">* Phone</label></td>
          <td><input type="text" name="PhoneD" id="PhoneD" value="<?php echo KT_escapeAttribute($row_rstbl_donations['PhoneD']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("PhoneD");?> <?php echo $tNGs->displayFieldError("tbl_donations", "PhoneD"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label6">* Address 1</label></td>
          <td><input type="text" name="Address1D" id="Address1D" value="<?php echo KT_escapeAttribute($row_rstbl_donations['Address1D']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("Address1D");?> <?php echo $tNGs->displayFieldError("tbl_donations", "Address1D"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label5">Address 2</label></td>
          <td><input type="text" name="Address2D" id="Address2D" value="<?php echo KT_escapeAttribute($row_rstbl_donations['Address2D']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("Address2D");?> <?php echo $tNGs->displayFieldError("tbl_donations", "Address2D"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label4">* City</label></td>
          <td><input type="text" name="CityD" id="CityD" value="<?php echo KT_escapeAttribute($row_rstbl_donations['CityD']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("CityD");?> <?php echo $tNGs->displayFieldError("tbl_donations", "CityD"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label3">* State</label></td>
          <td><input type="text" name="StateD" id="StateD" value="<?php echo KT_escapeAttribute($row_rstbl_donations['StateD']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("StateD");?> <?php echo $tNGs->displayFieldError("tbl_donations", "StateD"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label2">* Zip</label></td>
          <td><input type="text" name="ZipD" id="ZipD" value="<?php echo KT_escapeAttribute($row_rstbl_donations['ZipD']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("ZipD");?> <?php echo $tNGs->displayFieldError("tbl_donations", "ZipD"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="label">* Country</label></td>
          <td><input type="text" name="CountryD" id="CountryD" value="<?php echo KT_escapeAttribute($row_rstbl_donations['CountryD']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("CountryD");?> <?php echo $tNGs->displayFieldError("tbl_donations", "CountryD"); ?> </td>
        </tr>
        <tr>
          <td colspan="2" class="formrowspacer">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="formheader">Pay by Credit Card</td>
          </tr>
        <tr>
          <td width="25%" class="formtext">&nbsp;</td>
          <td width="75%">&nbsp;</td>
        </tr>
        <tr>
          <td class="formtext"><label for="CreditCard">* Credit Card Type</label></td>
          <td><select name="CreditCard" id="CreditCard">
              <option value="Visa" <?php if (!(strcmp("Visa", KT_escapeAttribute($row_rstbl_donations['CreditCard'])))) {echo "SELECTED";} ?>>Visa</option>
              <option value="Mastercard" <?php if (!(strcmp("Mastercard", KT_escapeAttribute($row_rstbl_donations['CreditCard'])))) {echo "SELECTED";} ?>>Mastercard</option>
              <option value="Discover" <?php if (!(strcmp("Discover", KT_escapeAttribute($row_rstbl_donations['CreditCard'])))) {echo "SELECTED";} ?>>Discover</option>
              <option value="AMEX" <?php if (!(strcmp("AMEX", KT_escapeAttribute($row_rstbl_donations['CreditCard'])))) {echo "SELECTED";} ?>>American Express</option>
            </select>
              <?php echo $tNGs->displayFieldError("tbl_donations", "CreditCard"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="CreditCardNo">* Credit Card Number</label></td>
          <td><input type="text" name="CreditCardNo" id="CreditCardNo" value="<?php echo KT_escapeAttribute($row_rstbl_donations['CreditCardNo']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("CreditCardNo");?> <?php echo $tNGs->displayFieldError("tbl_donations", "CreditCardNo"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="ExpMth">* Expiration Month</label></td>
          <td><select name="ExpMth" id="ExpMth">
              <option value="Jan" <?php if (!(strcmp("Jan", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>January</option>
              <option value="Feb" <?php if (!(strcmp("Feb", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>February</option>
              <option value="Mar" <?php if (!(strcmp("Mar", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>March</option>
              <option value="Apr" <?php if (!(strcmp("Apr", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>April</option>
              <option value="May" <?php if (!(strcmp("May", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>May</option>
              <option value="Jun" <?php if (!(strcmp("Jun", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>June</option>
              <option value="Jul" <?php if (!(strcmp("Jul", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>July</option>
              <option value="Aug" <?php if (!(strcmp("Aug", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>August</option>
              <option value="Sep" <?php if (!(strcmp("Sep", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>September</option>
              <option value="Oct" <?php if (!(strcmp("Oct", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>October</option>
              <option value="Nov" <?php if (!(strcmp("Nov", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>November</option>
              <option value="Dec" <?php if (!(strcmp("Dec", KT_escapeAttribute($row_rstbl_donations['ExpMth'])))) {echo "SELECTED";} ?>>December</option>
            </select>
              <?php echo $tNGs->displayFieldError("tbl_donations", "ExpMth"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="ExpYr">* Expiration Year</label></td>
          <td><input type="text" name="ExpYr" id="ExpYr" value="<?php echo KT_escapeAttribute($row_rstbl_donations['ExpYr']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("ExpYr");?> <?php echo $tNGs->displayFieldError("tbl_donations", "ExpYr"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="CVVcode">* CVV Code</label></td>
          <td><input type="text" name="CVVcode" id="CVVcode" value="<?php echo KT_escapeAttribute($row_rstbl_donations['CVVcode']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("CVVcode");?> <?php echo $tNGs->displayFieldError("tbl_donations", "CVVcode"); ?> </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>CVV Code - A 3 or 4 digit number printed on many credit  cards.  It is usually located on the  signature panel for Visa, MasterCard and Discover and on the front of the card  for American Express.</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="formheader">Billing Information</td>
          </tr>
        <tr>
          <td class="formtext">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="formtext"><label for="FName">* First Name</label></td>
          <td><input type="text" name="FName" id="FName" value="<?php echo KT_escapeAttribute($row_rstbl_donations['FName']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("FName");?> <?php echo $tNGs->displayFieldError("tbl_donations", "FName"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="LName">* Last Name</label></td>
          <td><input type="text" name="LName" id="LName" value="<?php echo KT_escapeAttribute($row_rstbl_donations['LName']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("LName");?> <?php echo $tNGs->displayFieldError("tbl_donations", "LName"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="Email">* Email</label></td>
          <td><input type="text" name="Email" id="Email" value="<?php echo KT_escapeAttribute($row_rstbl_donations['Email']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("Email");?> <?php echo $tNGs->displayFieldError("tbl_donations", "Email"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="Phone">* Phone</label></td>
          <td><input type="text" name="Phone" id="Phone" value="<?php echo KT_escapeAttribute($row_rstbl_donations['Phone']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("Phone");?> <?php echo $tNGs->displayFieldError("tbl_donations", "Phone"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="Address1">* Address 1</label></td>
          <td><input type="text" name="Address1" id="Address1" value="<?php echo KT_escapeAttribute($row_rstbl_donations['Address1']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("Address1");?> <?php echo $tNGs->displayFieldError("tbl_donations", "Address1"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="Address2">Address 2</label></td>
          <td><input type="text" name="Address2" id="Address2" value="<?php echo KT_escapeAttribute($row_rstbl_donations['Address2']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("Address2");?> <?php echo $tNGs->displayFieldError("tbl_donations", "Address2"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="City">* City</label></td>
          <td><input type="text" name="City" id="City" value="<?php echo KT_escapeAttribute($row_rstbl_donations['City']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("City");?> <?php echo $tNGs->displayFieldError("tbl_donations", "City"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="State">* State</label></td>
          <td><input type="text" name="State" id="State" value="<?php echo KT_escapeAttribute($row_rstbl_donations['State']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("State");?> <?php echo $tNGs->displayFieldError("tbl_donations", "State"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="Zip">* Zip</label></td>
          <td><input type="text" name="Zip" id="Zip" value="<?php echo KT_escapeAttribute($row_rstbl_donations['Zip']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("Zip");?> <?php echo $tNGs->displayFieldError("tbl_donations", "Zip"); ?> </td>
        </tr>
        <tr>
          <td class="formtext"><label for="Country">* Country</label></td>
          <td><input type="text" name="Country" id="Country" value="<?php echo KT_escapeAttribute($row_rstbl_donations['Country']); ?>" size="32" />
              <?php echo $tNGs->displayFieldHint("Country");?> <?php echo $tNGs->displayFieldError("tbl_donations", "Country"); ?> </td>
        </tr>
        <tr>
          <td colspan="2" class="formrowspacer">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="right"><input name="KT_Insert1" type="submit" class="formbutton" id="KT_Insert1" value="Donate" /></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><span id="siteseal"><script type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=KsZPbU6QCDEvkhNMH7uQuAz8V0w0hX5xAtXdLI7V9l80Qxm8C6g"></script>
</span></td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
    </div></td>
  </tr>
  <tr>
    <td class="botcap">&nbsp;</td>
  </tr>
  <tr>
    <td>
    <div id="footer">
        <div id="footerlink"><a href="../index.php">home</a> | <a href="../Support.php">support</a> | <a href="../Donors.php">donors</a> | <a href="../AboutUs.php">about us</a> | <a href="../Events.php">events</a> | <a href="../Gallery.php">photo gallery</a> | <a href="../Press.php">press</a> | <a href="../Contact.php">contact us</a><br />
Copyright &copy; 2009 Cedar Creek Veterans Foundation. All Rights Reserved.</div>
	  <div id="botlogo"><img src="assets/layout/CCVF_bot_logo.jpg" alt="Cedar Creek Veterans Foundation" /></div>
      </div></td>
  </tr>
</table>
<?php include("../assets/includes/IncGoogle.php"); ?>
</body>
</html>
