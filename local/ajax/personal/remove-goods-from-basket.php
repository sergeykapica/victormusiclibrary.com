<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/TextHandler/textHandler.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(CModule::IncludeModule('sale'))
    {
        $textHandler = new TextHandlerContext\TextHandler;
        $goodsIDs = json_decode($_POST['GOODS_IDS']);
        
        function filterValues($value)
        {
            global $textHandler;
            return $textHandler->textToSafeState($value);
        }
        
        $goodsIDs = array_filter($goodsIDs, 'filterValues');
        $error = false;
        $oBasket = new CSaleBasket;
        
        foreach($goodsIDs as $goodID)
        {
            if(!$oBasket->Delete($goodID))
            {
                $error = true;
            }
        } 

        if($error == false)
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