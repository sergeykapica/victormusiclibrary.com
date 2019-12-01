<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('iblock'))
{
    $arResult = array();
    
    $orderedGoodsFilter = array(
        'IBLOCK_ID' => 4,
        'PROPERTY_ORDERED_USER' => $USER->GetID()
    );
    
    $orderedGoodsSelect = array(
        'ID',
        'IBLOCK_ID',
        'NAME',
        'PROPERTY_FULL_SOUND',
        'PROPERTY_ORDERED_USER'
    );

    $orderedGoods = CIBlockElement::GetList(array('ID' => 'DESC'), $orderedGoodsFilter, false, false, $orderedGoodsSelect);

    if($orderedGoods)
    {
        while($orderedGood = $orderedGoods->GetNext())
        {
            $arResult['GOODS_LIST'][] = $orderedGood;
        } 
    }

    $this->includeComponentTemplate();
}
?>