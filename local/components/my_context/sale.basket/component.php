<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('sale') && CModule::IncludeModule('iblock'))
{
    $arResult = array();
    
    $navParams = array(
        'bShowAll' => false,
        'nPageSize' => 2
    );
    
    if(isset($arParams['FILTER_VALUE']))
    {
        $_SERVER['REQUEST_URI'] = preg_match('/&/', $_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['REQUEST_URI'] . '&';
        
        preg_match('/(.+?)\?SEARCH_VALUE=(.+?)&/i', $_SERVER['REQUEST_URI'], $finds);
        
        $urlWithoutQueryString = $finds[1];
        $searchValueQuery = $finds[2];
        
        $navParams['BASE_LINK'] = $urlWithoutQueryString . '?SEARCH_VALUE=' . $searchValueQuery . '&PAGINATION_PAGE=1';
    }
    
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
    
    $filterFields = array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL"
    );
    
    if(!isset($arParams['FILTER_VALUE']))
    {
        $basket = CSaleBasket::GetList(array('DATE_INSERT' => 'DESC'), $filterFields, false, $navParams, $selectFields);
    }
    else
    {
        $basket = CSaleBasket::GetList(array('DATE_INSERT' => 'DESC'), $filterFields, false, false, $selectFields);
    }
    
    if($basket)
    {
        $productIDs = array();
        
        while($basketItem = $basket->GetNext())
        {
            $productIDs[] = $basketItem['PRODUCT_ID'];
            $basketItem['PRICE'] = round($basketItem['PRICE']);
            $arResult['TOTAL_ORDER_PRICE'] += $basketItem['PRICE'];
            
            $arResult['BASKET_ITEMS'][] = $basketItem;
        }
        
        if(!isset($arParams['FILTER_VALUE']))
        {
            $arResult['BASKET_ITEM_PAGINATION'] = $basket->GetPageNavStringEx($backNavigation = false, 'Goods', 'victormusiclibrary', false, false, $navParams);
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
                    
                    define('SITE_CODE', 's1');
                    $arResult['CURRENT_CURRENCY'] = CSaleLang::GetLangCurrency(SITE_CODE);
                    
                    // if is filter value then filtration
                    
                    if(isset($arParams['FILTER_VALUE']))
                    {
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/TextHandler/textHandler.php');
                        
                        $textHandler = new TextHandlerContext\TextHandler;
                        $arParams['FILTER_VALUE'] = $textHandler->textToSafeState($arParams['FILTER_VALUE']);
                        
                        foreach($arResult['BASKET_ITEMS'] as $basketItemKey => &$basketItem)
                        {
                            if(!preg_match('/' . strtolower($arParams['FILTER_VALUE']) . '/i', strtolower($basketItem['NAME'])) && !preg_match('/' . strtolower($arParams['FILTER_VALUE']) . '/i', strtolower($basketItem['NAME'])))
                            {
                                unset($arResult['BASKET_ITEMS'][$basketItemKey]);
                            }
                        }
                        
                        if(!empty($arResult['BASKET_ITEMS']))
                        {
                            $oCDBResult = new CDBResult;
                            $oCDBResult->InitFromArray($arResult['BASKET_ITEMS']);
                            $oCDBResult->NavStart($navParams['nPageSize']);
                            $oCDBResult->bShowAll = false;
                            
                            $arResult['BASKET_ITEM_PAGINATION'] = $oCDBResult->GetPageNavStringEx($backNavigation = false, 'Goods', 'victormusiclibrary', false, false, $navParams);
                            
                            $arResult['BASKET_ITEMS'] = array();
                            
                            while($basketItem = $oCDBResult->GetNext())
                            {
                                $arResult['BASKET_ITEMS'][] = $basketItem;
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