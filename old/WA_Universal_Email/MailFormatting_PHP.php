<?php
function WA_getEmailArray($emailStr)     {
  $retArray = array();
  $emailArr = explode(";",$emailStr);
  foreach ($emailArr AS $emailString)     {
    if (strpos($emailString,"@") > 0)     {
      $emailArr2 = explode("|WA|", $emailString);
      if (sizeof($emailArr2) == 1)     {
        $tempArray    = array(2);
        $tempArray[0] = "";
        $tempArray[1] = WA_StripSpaces($emailString);
        $retArray[]   = $tempArray;
      }
      else     {
        $tempArr = array("", "");
		$eArr0 = $emailArr2[0];
		$eArr1 = $emailArr2[1];
        if ((strpos($eArr1, "@") > 0 || strpos($eArr1, "@") === 0) && (strpos($eArr1, " ") === false))      {
          $tempArr[0] = WA_StripSpaces($emailArr2[0]);
          $tempArr[1] = WA_StripSpaces($emailArr2[1]);
        }
        else     {
          $tempArr[0] = WA_StripSpaces($emailArr2[1]);
          $tempArr[1] = WA_StripSpaces($emailArr2[0]);
        }
        $retArray[] = $tempArr;
      }
    }
  }
  return $retArray;
}

function WA_FormatColumn($align,$numspaces,$content)     {
  $WA_FormatColumn_return = "";
  $numspaces = intval($numspaces);
  if (strlen($content) > $numspaces)     {
    $WA_FormatColumn_return = substr($content,0,$numspaces);
  }
  else     {
    switch (strtolower($align)) {
      case "right":
        $WA_FormatColumn_return = WA_RightAlign($numspaces,$content);
        break;
      case "left":
        $WA_FormatColumn_return = WA_LeftAlign($numspaces,$content);
        break;
    }
    if (strtolower($align) == "center")     {
      $WA_FormatColumn_return = WA_CenterAlign($numspaces,$content);
    }
  }

  return $WA_FormatColumn_return;
}

function WA_RightAlign($numspaces, $content)     {
  $WA_RightAlign_return = $content;
  while (strlen($WA_RightAlign_return) < $numspaces)     {
    $WA_RightAlign_return = " ".$WA_RightAlign_return;
  }
  return $WA_RightAlign_return;
}

function WA_LeftAlign($numspaces, $content)     {
  $WA_LeftAlign_return = $content;
  while (strlen($WA_LeftAlign_return) < $numspaces)     {
    $WA_LeftAlign_return = $WA_LeftAlign_return." ";
  }
  return $WA_LeftAlign_return;
}

function WA_CenterAlign($numspaces, $content)     {
  $WA_CenterAlign_return = $content;
  for ($n=strlen($content); $n<$numspaces; $n++)     {
    if (($n%2) == 1)     {
      $WA_CenterAlign_return = $WA_CenterAlign_return." ";
    }
    else     {
      $WA_CenterAlign_return = " ".$WA_CenterAlign_return;
    }
  }
  return $WA_CenterAlign_return;
}


function WA_StripSpaces($inStr)     {
  $outStr = $inStr;
  $firstchar = substr($outStr, 0, 1);
  while ($firstchar == " ")     {
    $outStr = substr($outStr,1);
    $firstchar = substr($outStr, 0, 1);
  }
  $firstchar = substr($outStr, strlen($outStr)-1, 1);
  while ($firstchar == " ")     {
    $outStr = substr($outStr, 0, strlen($outStr)-1);
    $firstchar = substr($outStr, strlen($outStr)-1, 1);
  }
  return $outStr;
}

function WA_TrimLeadingSpaces($inStr)     {
  $outStr = $inStr;
  $firstchar = substr($outStr, 0, 1);
  while ($firstchar == " ")     {
    $outStr = substr($outStr,1);
    $firstchar = substr($outStr, 0, 1);
  }
  $firstchar = substr($outStr, strlen($outStr)-1, 1);
  while ($firstchar == " ")     {
    $outStr = substr($outStr, 0, strlen($outStr)-1);
    $firstchar = substr($outStr, strlen($outStr)-1, 1);
  }
  return $outStr;
}
?>