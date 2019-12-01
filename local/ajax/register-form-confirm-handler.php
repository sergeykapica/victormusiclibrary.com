<?
session_start();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/TextHandler/textHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/Encryption/Encryption.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $textHandler = new TextHandlerContext\TextHandler;
    $registerConfirmCode = EncryptionScope\Encryption::GetEncryptedString($textHandler->textToSafeState($_POST['REGISTER_CONFIRM_CODE']));
    
    if(isset($_SESSION['REGISTRATION_USER_DATA_TEMP']) && $registerConfirmCode == $_SESSION['REGISTRATION_USER_DATA_TEMP']['GENERATED_CODE'])
    {
        unset($_SESSION['REGISTRATION_USER_DATA_TEMP']['GENERATED_CODE']);
        
        $userID = $USER->Add($_SESSION['REGISTRATION_USER_DATA_TEMP']);
        
        if($userID)
        {
            unset($_SESSION['REGISTRATION_USER_DATA_TEMP']);
            
            // add sale account for user
            
            if(CModule::IncludeModule('sale'))
            {
                $userFields = array(
                    'USER_ID' => $userID,
                    'TIMESTAMP_X' => date('d.m.Y H:i:s'),
                    'CURRENCY' => CSaleLang::GetLangCurrency(SITE_CODE)
                );

                if(CSaleUserAccount::Add($userFields))
                {
                    LocalRedirect('/?REGISTER_CONFIRM=1');
                }
                else
                {
                    LocalRedirect('/?REGISTER_CONFIRM=0');
                }
            }
            else
            {
                LocalRedirect('/?REGISTER_CONFIRM=0');
            }
        }
        else
        {
            LocalRedirect('/?REGISTER_CONFIRM=0');
        }
    }
}
?>