<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult = array();
$arResult['GOODS_LIST'] = array();

// Get goods list

$arFilter = array(
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'SECTION_ID' => $arParams['IBLOCK_SECTION_ID']
);

$arSelect = $arParams['IBLOCK_FIELDS'];
$arSelect = array_merge($arSelect, array(
    'ID',
    'IBLOCK_ID',
    'CATALOG_PRICE_1',
    'CATALOG_CURRENCY_1',
    'CODE',
    'SECTION_CODE'
));

$goodsList = CIBlockElement::GetList(array('ID' => 'DESC'), $arFilter, false, false, $arSelect);

if($goodsList)
{
    $goodsSection = CIBlockSection::GetByID($arParams['IBLOCK_SECTION_ID']);
    
    if($goodsSection)
    {
        $goodsSection = $goodsSection->Fetch();
        
        while($goodsItem = $goodsList->GetNext())
        {
            if(empty($goodsItem['DETAIL_PICTURE']))
            {
                $goodsItem['DETAIL_PICTURE'] = CFile::GetPath(5);
            }
            
            $goodsItem['GOODS_ITEM_PART_URL'] = '/shop/' . $goodsSection['CODE'] . '/' . $goodsItem['CODE'];
            $arResult['GOODS_LIST'][] = $goodsItem;
        }
    }
}

$this->includeComponentTemplate();
?>