<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/TextHandler/textHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/Encryption/Encryption.php');
require_once($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/lang/ru/ajax.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if($APPLICATION->CaptchaCheckCode(htmlspecialcharsEx($_POST["captcha_word"]), htmlspecialcharsEx($_POST["captcha_sid"])))
    {  
        $textHandler = new TextHandlerContext\TextHandler;
        $recoveryPasswordUserEmail = $textHandler->textToSafeState($_POST['RECOVERY_PASSWORD_USER_EMAIL']);
        $userData = CUser::GetList($by = 'ID', $order = 'asc', array('EMAIL' => $recoveryPasswordUserEmail), array(
            'ID',
            'NAME',
            'LOGIN',
            'CHECKWORD'
        ));
        
        if($userData)
        {
            $userData = $userData->Fetch();
            $generatedPassword = strtolower(EncryptionScope\Encryption::GetGeneratedCode(6));
            $hashGeneratedPassword = EncryptionScope\Encryption::GetEncryptedString($generatedPassword);
            
            ob_start();

            ?>
            <div id="main-wrapper" style="font-size: 16px; margin: 0; padding: 0;">
                <div id="main-wrapper-header" style="position: relative; padding: 1rem 1rem 1rem 4rem; background-color: #176FC1;">
                    <span id="main-logotype" style="position: absolute; top: 1rem; left: 1rem; color: #fff;">VLM</span>
                    <a href="" id="main-site-name" style="color: #C9644B; font-weight: 700; text-decoration: none;"><?=SITE_SERVER_NAME;?></a>
                </div>
                <div id="main-wrapper-content" style="padding: 1rem; color: #544f4f;">
                    <p id="main-content-text" style="margin: 0; margin-bottom: 1rem;">Здравствуйте, <?=$userData['NAME'];?>. Сгенерирован новый пароль для Вашего аккаунта.</p>
                    <span id="code-formalizm" style="font-weight: 700; color: #000;">Новый пароль:</span>
                    &nbsp;
                    <span id="code-color" style="color: #1495a3;"><?=$generatedPassword;?></span>
                </div>
                <div id="main-wrapper-footer" style="background-color: 
            #2f3741; padding: 2rem 0; text-align: center; color: #fff;">
                    By Marchello &copy;
                </div>
            </div>
            <?

            $letterContent = ob_get_clean();
            
            $fieldsToLetter = array(
                'RECIPIENT' => $recoveryPasswordUserEmail,
                'TOPIC' => GetMessage('FORGOTTEN_PASSWORD_RECOVERY_TITLE'),
                'LETTER_CONTENT' => $letterContent
            );

            CEvent::Send("SEND_FORGOTTEN_PASSWORD", 's1', $fieldsToLetter, 'N', '');
            CEvent::CheckEvents();
            
            $userDataUpdate = new CUser;
            if($userDataUpdate->Update($userData['ID'], array(
                'PASSWORD' => $hashGeneratedPassword,
                'CONFIRM_PASSWORD' => $hashGeneratedPassword
            )))
            {
                echo 'NEW_PASSWORD_SENT';
            }
        }
    }
    else
    {
        echo 'CAPTCHA_RESPONSE_FAILED';
    }
}
?>