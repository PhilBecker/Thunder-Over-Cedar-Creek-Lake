<?php require_once("fckeditor.php"); ?>
<?php
function CreateRichTextEditor ($editorName, $basePath, $width, $height, $toolbarSet, $customConfig, $initialValue){
	$oFCKeditor = new FCKeditor($editorName);
	
	$oFCKeditor->BasePath	= $basePath;
	if($customConfig != ""){
		$oFCKeditor->Config['CustomConfigurationsPath'] = $customConfig;
	}
	$oFCKeditor->ToolbarSet = $toolbarSet;
	$oFCKeditor->Width = $width;
	$oFCKeditor->Height = $height;
	$oFCKeditor->Value	= $initialValue;
	$oFCKeditor->Create();
	return $oFCKeditor;
}
?>