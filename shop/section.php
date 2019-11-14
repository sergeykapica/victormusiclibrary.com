<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

<?$APPLICATION->IncludeComponent(
	"my_context:conclusion.section.elements", 
	"victormusiclibrary", 
	array(
		"COMPONENT_TEMPLATE" => "victormusiclibrary",
		"IBLOCK_ID" => "3",
		"IBLOCK_SECTION_ID" => "1",
		"IBLOCK_FIELDS" => array(
			0 => "ACTIVE",
			1 => "NAME",
			3 => "TAGS",
			4 => "PREVIEW_TEXT",
			5 => "PREVIEW_PICTURE",
			6 => "DETAIL_TEXT",
			7 => "DETAIL_PICTURE",
		)
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>