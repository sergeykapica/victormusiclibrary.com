<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

<?if(isset($_GET['ELEMENT_CODE']) && isset($_GET['SECTION_CODE'])):?>
	
	<?$APPLICATION->IncludeComponent(
		'my_context:conclusion.element.detail',
		'victormusiclibrary',
		array(
			'GOODS_ITEM_SYMBOL_CODE' => htmlspecialcharsBX($_GET['ELEMENT_CODE']),
			'GOODS_SECTION_CODE' => htmlspecialcharsBX($_GET['SECTION_CODE']),
			'CONCLUSION_FIELDS' => array(
				0 => "ACTIVE",
				1 => "NAME",
				3 => "TAGS",
				4 => "PREVIEW_TEXT",
				5 => "PREVIEW_PICTURE",
				6 => "DETAIL_TEXT",
				7 => "DETAIL_PICTURE",
				8 => "PROPERTY_PREVIEW_SOUND",
				9 => "PROPERTY_FULL_SOUND"
			)
		)
	);?>

<?endif;?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>