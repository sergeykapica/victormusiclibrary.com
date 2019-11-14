<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "Авторские песни");
$APPLICATION->SetPageProperty("title", "Магазин");
$APPLICATION->SetPageProperty("keywords", "Авторские песни");
$APPLICATION->SetPageProperty("description", "Категории магазина");
$APPLICATION->SetTitle("Магазин");
?>

<?$APPLICATION->IncludeComponent(
	"my_context:catalog.section.list",
	"victormusiclibrary",
	Array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"FILTER_NAME" => "sectionsFilter",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "goods",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array("ID", "CODE", "NAME", "DETAIL_PICTURE", "IBLOCK_ID", ""),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("", ""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE"
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>