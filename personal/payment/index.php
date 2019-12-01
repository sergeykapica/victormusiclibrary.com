<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пополнение счёта");
?>

<?$APPLICATION->IncludeComponent(
	"my_context:sale.payment",
	"victormusiclibrary"
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>