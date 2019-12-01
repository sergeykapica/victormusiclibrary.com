<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/AdditionalMethods/CSaleUserAccountAdditionalMethods.php');

$userData = CSaleUserAccountAdditionalMethods::getCurrentBill();

$arResult['USER_DATA'] = array(
    'CURRENT_BILL' => round($userData['CURRENT_BUDGET']),
    'CURRENT_CURRENCY' => $userData['CURRENCY']
);
?>