<? 
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION; 

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"DEPTH_LEVEL" => "2",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "goods",
		"ID" => $_REQUEST["ID"],
		"IS_SEF" => "N",
		"SECTION_URL" => "#SERVER_NAME#/shop/#SECTION_CODE#/"
	)
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>