<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('sale') && CModule::IncludeModule('iblock'))
{
    $arResult = array();
    
    $selectFields = array(
        'ID',
        'PRODUCT_ID',
        'PRICE',
        'CURRENCY',
        'CAN_BUY',
        'NAME',
        'CALLBACK_FUNC',
        'MODULE',
        'NOTES',
        'ORDER_CALLBACK_FUNC',
        'ORDER_PAYED',
        'ORDER_PRICE',
        'ORDER_CANCELED',
        'DETAIL_PAGE_URL',
        'FUSER_ID',
        'USER_ID',
        'ORDER_ID',
        'DATE_INSERT',
        'DATE_UPDATE',
        'CANCEL_CALLBACK_FUNC',
        'PAY_CALLBACK_FUNC',
        'DISCOUNT_PRICE'
    );
    
    $basket = CSaleBasket::GetList(array('DATE_INSERT' => 'DESC'), array(), false, false, $selectFields);
    
    if($basket)
    {
        $productIDs = array();
        
        while($basketItem = $basket->GetNext())
        {
            $productIDs[] = $basketItem['PRODUCT_ID'];
            $basketItem['PRICE'] = round($basketItem['PRICE']);
            
            $arResult['BASKET_ITEMS'][] = $basketItem;
        }
        
        if(!empty($productIDs))
        {
            $productItemsFilter = array(
                '=ID' => $productIDs
            );
            
            $productItemsSelectFields = array(
                'ID',
                'IBLOCK_ID',
                'NAME',
                'PREVIEW_PICTURE'
            );
            
            $productItems = CIBlockElement::GetList(array(), $productItemsFilter, false, false, $productItemsSelectFields);
            
            if($productItems)
            {
                while($productItem = $productItems->GetNext())
                {
                    if(empty($productItem['PREVIEW_PICTURE']))
                    {
                        $productItem['PREVIEW_PICTURE'] = CFile::GetPath(5);
                    }
                    
                    $productItem['ELEMENT_ID'] = $productItem['ID'];
                    unset($productItem['ID']);
                    
                    $arResult['PRODUCT_ITEMS'][$productItem['ELEMENT_ID']] = $productItem;
                }
                
                if(!empty($arResult['BASKET_ITEMS']) && !empty($arResult['PRODUCT_ITEMS']))
                {
                    foreach($arResult['BASKET_ITEMS'] as &$basketItem)
                    {
                        $basketItem = array_merge($basketItem, $arResult['PRODUCT_ITEMS'][$basketItem['PRODUCT_ID']]);
                    }
                    
                    // if is filter value then filtration
                    
                    if(isset($arParams['FILTER_VALUE']))
                    {
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/TextHandler/textHandler.php');
                        
                        $textHandler = new TextHandlerContext\TextHandler;
                        $arParams['FILTER_VALUE'] = $textHandler->textToSafeState($arParams['FILTER_VALUE']);
                        
                        foreach($arResult['BASKET_ITEMS'] as $basketItemKey => &$basketItem)
                        {
                            if(!preg_match('/' . $arParams['FILTER_VALUE'] . '/', $basketItem['NAME']) && !preg_match('/' . $arParams['FILTER_VALUE'] . '/', $basketItem['NAME']))
                            {
                                unset($arResult['BASKET_ITEMS'][$basketItemKey]);
                            }
                        }
                    }
                }
            }
        }
        
        /*echo '<pre>';
        print_r($arResult['BASKET_ITEMS']);
        echo '</pre>';
        die();*/
    }
}

$this->includeComponentTemplate();
?>