<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('sale'))
{
    $arResult = array();
    
	$paySystemSelectFields = array(
		'ID',
		'NAME',
		'CODE'
	);

	$paySystemList = CSalePaySystemAction::GetList(array('ID' => 'ASC', 'NAME' => 'ASC'), array(), false, false, $paySystemSelectFields);

	while($paySystem = $paySystemList->GetNext())
	{
		$arResult['PAYSYSTEM_LIST'][] = $paySystem;
	}
}

/*

$arResult['PAYSYSTEMS'] = array(
    'YANDEX_MONEY' => 'Яндекс деньги',
    'PAYEER' => 'Payeer',
    'PAYPAL' => 'PayPal'
);

*/

$this->includeComponentTemplate();
?>