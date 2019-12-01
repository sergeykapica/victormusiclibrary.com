<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if(CModule::IncludeModule('sale') && isset($_GET['TOTAL_ORDER_PRICE']))
{
    define('SITE_CODE', 's1');
    
    // Save basket to order

    $orderFields = array(
        "LID" => SITE_CODE,
        "PERSON_TYPE_ID" => 1,
        "PAYED" => "N",
        "CANCELED" => "N",
        "STATUS_ID" => "N",
        "PRICE" => htmlspecialcharsBX($_GET['TOTAL_ORDER_PRICE']),
        "CURRENCY" => CSaleLang::GetLangCurrency(SITE_CODE),
        "USER_ID" => IntVal($USER->GetID()),
        "PAY_SYSTEM_ID" => 1,
        "DELIVERY_ID" => 0,
        "DISCOUNT_VALUE" => 0,
        "TAX_VALUE" => 0,
        "DATE_STATUS" => date('d.m.Y H:i:s'),
        "DATE_INSERT" => date('d.m.Y H:i:s'),
        "DATE_UPDATE" => date('d.m.Y H:i:s')
    );

    if(CSaleOrder::Add($orderFields))
    {
    
        // get payed order entry with status = N

        $orderNavParams = array(
            'nPageSize' => 1
        );

        $orderFilterFields = array(
            '=PAYED' => 'N',
            '=USER_ID' => $USER->GetID()
        );

        $orderSelectFields = array(
            'ID',
            'PRICE',
            'CURRENCY'
        );

        $CSaleOrderEntry = CSaleOrder::GetList(array('DATE_STATUS' => 'DESC'), $orderFilterFields, false, false, $orderSelectFields);

        if($CSaleOrderEntry && $order = $CSaleOrderEntry->Fetch())
        {
            require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/AdditionalMethods/CSaleUserAccountAdditionalMethods.php');

            $userData = CSaleUserAccountAdditionalMethods::getCurrentBill();
            $userData['CURRENT_BUDGET'] = round($userData['CURRENT_BUDGET']);

            if($userData['CURRENT_BUDGET'] >= $order['PRICE'])
            {
                $currentBill = $userData['CURRENT_BUDGET'] - $order['PRICE'];

                if(CSaleUserAccountAdditionalMethods::setCurrentBill($currentBill))
                {
                    // set payed status to order

                    $orderFields = array(
                        'PAYED' => 'Y'
                    );

                    if(CSaleOrder::Update($order['ID'], $orderFields))
                    {
                        // get current basket items

                        $basketFilterFields = array(
                            'FUSER' => CSaleBasket::GetBasketUserID(),
                            'LID' => SITE_CODE,
                            'ORDER_ID' => ''
                        );

                        $basketSelectFields = array(
                            'ID',
                            'PRODUCT_ID'
                        );

                        $basketItems = CSaleBasket::GetList(array(), $basketFilterFields, false, false, $basketSelectFields);

                        if($basketItems)
                        {
                            $productIDs = array();

                            while($basketItem = $basketItems->GetNext())
                            {
                                $productIDs[$basketItem['ID']] = $basketItem['PRODUCT_ID'];
                            }

                            // get goods by id

                            if(!empty($productIDs))
                            {
                                $goodsFilterFields = array(
                                    'ID' => $productIDs,
                                    'IBLOCK_ID' => 3
                                );

                                $goodsSelectFields = array(
                                    'ID',
                                    'IBLOCK_ID',
                                    'NAME',
                                    'PROPERTY_FULL_SOUND'
                                );

                                $goodsList = CIBlockElement::GetList(array('DATE_CREATE' => 'DESC'), $goodsFilterFields, false, false, $goodsSelectFields);

                                if($goodsList)
                                {
                                    function addOrderedGood($fields)
                                    {
                                        global $goodsIBlock;

                                        $goodsIBlock->Add($fields);
                                    }

                                    $goodsIBlock = new CIBlockElement;

                                    // set to ordered goods table

                                    while($goodsItem = $goodsList->GetNext())
                                    {
                                        $addOrderedGoodsProperties = array(
                                            'FULL_SOUND' => $goodsItem['PROPERTY_FULL_SOUND_VALUE'],
                                            'ORDERED_USER' => $USER->GetID()
                                        );

                                        $addOrderedGoodsFields = array(
                                            'IBLOCK_ID' => 4,
                                            'NAME' => $goodsItem['NAME'],
                                            'CODE' => CUtil::translit($goodsItem['NAME'], 'ru'),
                                            'PROPERTY_VALUES' => $addOrderedGoodsProperties
                                        );

                                        addOrderedGood($addOrderedGoodsFields);
                                    }

                                    // delete from basket by ids

                                    $productIDs = array_keys($productIDs);
                                    $error = false;

                                    foreach($productIDs as $productIDInBasket)
                                    {
                                        if(!CSaleBasket::Delete($productIDInBasket))
                                        {
                                            $error = true;
                                        }
                                    }

                                    if(!$error)
                                    {
                                        LocalRedirect('/personal/order/result.php?EXECUTED_ORDER_STATUS=SUCCESS');
                                    }
                                    else
                                    {
                                        LocalRedirect('/personal/order/result.php?EXECUTED_ORDER_STATUS=FAILED');
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else
            {
                LocalRedirect('/personal/order/result.php?EXECUTED_ORDER_STATUS=NOT_MONEY');
            }

            $userFields = array(

            );
        }
    }
}
?>