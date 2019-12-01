<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?>

<?if(isset($_GET['EXECUTED_ORDER_STATUS'])):?>

<?$APPLICATION->IncludeComponent(
	'my_context:order.result',
	'victormusiclibrary',
	array(
		'EXECUTED_ORDER_STATUS' => htmlspecialcharsBX($_GET['EXECUTED_ORDER_STATUS'])
	)
);?>

<?endif;?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>