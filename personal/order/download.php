<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if(isset($_GET['FILE_ID']))
{
	$fileID = htmlspecialcharsBX($_GET['FILE_ID']);
	$filePath = $_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($fileID);
	
	if(ini_get('zlib.output_compression'))
	{
		ini_set('zlib.output_compression', 'Off');
	}
	
	if(file_exists($filePath))
	{
		echo $filePath;
		$fileType = basename($filePath);
		
		header("Pragma: public"); 
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false);
		header("Content-Type: " . $fileType);
		header("Content-Disposition: attachment; filename=\"" . basename($filePath) . "\";");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . filesize($filePath));
		readfile($filePath);
		exit();
	}
}
?>