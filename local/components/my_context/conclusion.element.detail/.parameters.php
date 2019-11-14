<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$conclusionFields = array(
    'ACTIVE',
    'NAME',
    'TAGS',
    'PREVIEW_TEXT',
    'PREVIEW_PICTURE',
    'DETAIL_TEXT',
    'DETAIL_PICTURE',
    'CHECK_PERMISSIONS',
    'CATALOG_TYPE',
    'SORT',
    'DATE_CREATE',
    'SECTION_ID',
    'SECTION_CODE',
    'CATALOG_AVAILABLE',
    'CATALOG_CATALOG_GROUP_ID_N',
    'CATALOG_SHOP_QUANTITY_N',
    'CATALOG_QUANTITY',
    'CATALOG_WEIGHT',
    'CATALOG_STORE_AMOUNT_',
    'CATALOG_PRICE_SCALE_',
    'CATALOG_BUNDLE',
    'SHOW_COUNTER',
    'SHOW_COUNTER_START'.
    'PROPERTY_PREVIEW_SOUND',
    'PROPERTY_FULL_SOUND'
);

$arComponentParameters = array(
	"PARAMETERS" => array(
		'GOODS_ITEM_SYMBOL_CODE' => array(
            'NAME' => GetMessage('GOODS_ITEM_SYMBOL_CODE_TITLE'),
            'PARENT' => 'BASE',
            'TYPE' => 'STRING'
        ),
        
        'GOODS_SECTION_CODE' => array(
            'NAME' => GetMessage('GOODS_SECTION_CODE_TITLE'),
            'PARENT' => 'BASE',
            'TYPE' => 'STRING'
        ),
        
        'CONCLUSION_FIELDS' => array(
            'NAME' => GetMessage('CONCLUSION_FIELDS_TITLE'),
            'PARENT' => 'BASE',
            'TYLE' => 'LIST',
            'MULTIPLY' => 'Y',
            'VALUES' => $conclusionFields
        )
	)
);
?>