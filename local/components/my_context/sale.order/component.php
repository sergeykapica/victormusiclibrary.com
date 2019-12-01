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
        'MODULE',
        'NOTES',
        'ORDER_PAYED',
        'ORDER_PRICE',
        'ORDER_CANCELED',
        'DETAIL_PAGE_URL',
        'FUSER_ID',
        'USER_ID',
        'ORDER_ID',
        'DATE_INSERT',
        'DATE_UPDATE',
        'DISCOUNT_PRICE'
    );

    $filterFields = array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL"
    );
    
    $basket = CSaleBasket::GetList(array('DATE_INSERT' => 'DESC'), $filterFields, false, false, $selectFields);
    
    if($basket)
    {
        $productIDs = array();
        $basketProductIDs = array();
        
        while($basketItem = $basket->GetNext())
        {
            $basketProductIDs[] = $basketItem['ID'];
            $productIDs[] = $basketItem['PRODUCT_ID'];
            $basketItem['PRICE'] = round($basketItem['PRICE']);
            
            $arResult['BASKET_ITEMS'][] = $basketItem;
            $arResult['TOTAL_ORDER_PRICE'] += $basketItem['PRICE'];
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
                }
            }
        }
    }
}

$this->includeComponentTemplate();
?>