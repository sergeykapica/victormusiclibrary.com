<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>

<?$APPLICATION->IncludeComponent(
	"my_context:sale.basket",
	"victormusiclibrary"
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>