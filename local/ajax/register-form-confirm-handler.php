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
        
        if($USER->Add($_SESSION['REGISTRATION_USER_DATA_TEMP']))
        {
            unset($_SESSION['REGISTRATION_USER_DATA_TEMP']);
            
            LocalRedirect('/?REGISTER_CONFIRM=1');
        }
        else
        {
            LocalRedirect('/?REGISTER_CONFIRM=0');
        }
    }
}
?>