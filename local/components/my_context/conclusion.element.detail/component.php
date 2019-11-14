<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('iblock'))
{
    $arResult = array();
    $arResult['GOODS_ITEM_FIELDS'] = array();
    
    $arFilter = array(
        'IBLOCK_ID' => 3,
        'SECTION_CODE' => $arParams['GOODS_SECTION_CODE'],
        'CODE' => $arParams['GOODS_ITEM_SYMBOL_CODE']
    );
    
    $arSelect = $arParams['CONCLUSION_FIELDS'];
    $arSelect = array_merge($arSelect, array(
        'ID',
        'IBLOCK_ID',
        'CATALOG_PRICE_1',
        'CATALOG_CURRENCY_1'
    ));
    
    $goodsItem = CIBlockElement::GetList(array('ID' => 'DESC'), $arFilter, false, false, $arSelect);
    
    if($goodsItem)
    {
        $arResult['GOODS_ITEM_FIELDS'] = $goodsItem->Fetch();
        
        if(empty($arResult['GOODS_ITEM_FIELDS']['DETAIL_PICTURE']))
        {
            $arResult['GOODS_ITEM_FIELDS']['DETAIL_PICTURE'] = CFile::GetPath(5);
        }
        
        $arResult['GOODS_ITEM_FIELDS']['PROPERTY_PREVIEW_SOUND_VALUE'] = CFile::GetPath($arResult['GOODS_ITEM_FIELDS']['PROPERTY_PREVIEW_SOUND_VALUE']);
        
        // get ID of good in basket
        
        if(CModule::IncludeModule('sale'))
        {
            $oBasket = new CSaleBasket;
            
            $basketFilter = array(
                'PRODUCT_ID' => $arResult['GOODS_ITEM_FIELDS']['ID']
            ); 
            
            $basketSelect = array(
                'ID'
            );
            
            $goodInBasket = $oBasket->GetList(array('ID' => 'ASC'), $basketFilter, false, false, $basketSelect);
            
            if($goodInBasket)
            {
                $goodInBasket = $goodInBasket->Fetch();
                $arResult['GOODS_ITEM_FIELDS']['ID_GOOD_FROM_BASKET'] = $goodInBasket['ID'];
            }
        }
    }
}

$this->includeComponentTemplate();
?>