<?php
  $MailAttachments = "";
  $MailBCC         = "";
  $MailCC          = "";
  $MailTo          = "";
  $MailBodyFormat  = "";
  $MailBody        = "";
  $MailImportance  = "";
  $MailFrom        = "".((isset($_POST["email"]))?$_POST["email"]:"")  ."";
  $MailSubject     = "CCVF Air Show - Website Contact";
  $_SERVER["QUERY_STRING"] = "";

  //Global Variables

  $WA_MailObject = WAUE_Definition("relay-hosting.secureserver.net","25","","","","");

  if ($RecipientEmail)     {
    $WA_MailObject = WAUE_AddRecipient($WA_MailObject,$RecipientEmail);
  }
  else      {
    //To Entries
  }

  //Attachment Entries

  //BCC Entries

  //CC Entries

  //Body Format
  $WA_MailObject = WAUE_BodyFormat($WA_MailObject,0);

  //Set Importance
  $WA_MailObject = WAUE_SetImportance($WA_MailObject,"1");

  //Start Mail Body
$MailBody = $MailBody . "Name: ";
$MailBody = $MailBody .  ((isset($_POST["name"]))?$_POST["name"]:"");
$MailBody = $MailBody . "<br>\r\n";
$MailBody = $MailBody . "Phone: ";
$MailBody = $MailBody .  ((isset($_POST["phone"]))?$_POST["phone"]:"");
$MailBody = $MailBody . "<br>\r\n";
$MailBody = $MailBody . "Email: ";
$MailBody = $MailBody .  ((isset($_POST["email"]))?$_POST["email"]:"");
$MailBody = $MailBody . "<br>\r\n";
$MailBody = $MailBody . "Comments: ";
$MailBody = $MailBody .  ((isset($_POST["comments"]))?$_POST["comments"]:"");
$MailBody = $MailBody . "";
  //End Mail Body

  $WA_MailObject = WAUE_SendMail($WA_MailObject,$MailAttachments,$MailBCC,$MailCC,$MailTo,$MailImportance,$MailFrom,$MailSubject,$MailBody);

  $WA_MailObject = null;
?>