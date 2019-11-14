<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/TextHandler/textHandler.php');

if(isset($_GET['GOOD_ID']))
{
    if(CModule::IncludeModule('catalog'))
    {
        $textHandler = new TextHandlerContext\TextHandler;
        $goodID = $textHandler->textToSafeState($_GET['GOOD_ID']);

        if(Add2BasketByProductID($goodID, 1))
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