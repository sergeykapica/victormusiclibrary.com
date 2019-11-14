<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
?>

<?if(isset($_GET['SEARCH_VALUE'])):?>
    <?$APPLICATION->IncludeComponent(
        "my_context:sale.basket",
        "victormusiclibrary",
        array(
            'FILTER_VALUE' => htmlspecialcharsBX($_GET['SEARCH_VALUE'])
        )
    );?>
<?endif;?>