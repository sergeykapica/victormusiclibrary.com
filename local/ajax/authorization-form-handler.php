<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/TextHandler/textHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/Encryption/Encryption.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if($APPLICATION->CaptchaCheckCode(htmlspecialcharsEx($_POST["captcha_word"]), htmlspecialcharsEx($_POST["captcha_sid"])))
    {  
        $textHandler = new TextHandlerContext\TextHandler;
        $authorizationUserLogin = $textHandler->textToSafeState($_POST['AUTHORIZATION_USER_LOGIN']);
        $authorizationUserPassword = EncryptionScope\Encryption::GetEncryptedString($textHandler->textToSafeState($_POST['AUTHORIZATION_USER_PASSWORD']));
        
        if($USER->Login($authorizationUserLogin, $authorizationUserPassword) === true)
        {
            echo 'CORRECT_PASSWORD_AND_LOGIN';
        }
        else
        {
            echo 'INVALID_PASSWORD_OR_LOGIN';
        }
    }
    else
    {
        echo 'CAPTCHA_RESPONSE_FAILED';
    }
}
?>