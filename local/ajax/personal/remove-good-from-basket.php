<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/TextHandler/textHandler.php');

if(isset($_GET['GOOD_ID']))
{
    if(CModule::IncludeModule('sale'))
    {
        $textHandler = new TextHandlerContext\TextHandler;
        $goodID = $textHandler->textToSafeState($_GET['GOOD_ID']);

        $oBasket = new CSaleBasket;
        
        if($oBasket->Delete($goodID))
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }
}
?>