<?
session_start();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/UploadImages/UploadImages.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/TextHandler/textHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/Encryption/Encryption.php');
require_once($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/lang/ru/ajax.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if($APPLICATION->CaptchaCheckCode(htmlspecialcharsEx($_POST["captcha_word"]), htmlspecialcharsEx($_POST["captcha_sid"])))
    {      
        $textHandler = new TextHandlerContext\TextHandler;
        
        $fields = array(
            'LOGIN' => $textHandler->textToSafeState($_POST['REGISTER']['LOGIN']),
            'EMAIL' => $textHandler->textToSafeState($_POST['REGISTER']['EMAIL']),
            'PASSWORD' => EncryptionScope\Encryption::GetEncryptedString($textHandler->textToSafeState($_POST['REGISTER']['PASSWORD'])),
            'CONFIRM_PASSWORD' => EncryptionScope\Encryption::GetEncryptedString($textHandler->textToSafeState($_POST['REGISTER']['CONFIRM_PASSWORD'])),
            'NAME' => $textHandler->textToSafeState($_POST['REGISTER']['NAME']),
            'LAST_NAME' => $textHandler->textToSafeState($_POST['REGISTER']['LAST_NAME']),
            'PERSONAL_GENDER' => $textHandler->textToSafeState($_POST['REGISTER']['PERSONAL_GENDER']),
            'PERSONAL_BIRTHDAY' => $textHandler->textToSafeState($_POST['REGISTER']['PERSONAL_BIRTHDAY']),
            'PERSONAL_PHOTO' => !empty($_FILES['PERSONAL_PHOTO']['name']) ? UploadImagesContext\UploadImages::fileCheckForConditions($_FILES['PERSONAL_PHOTO']) : '',
            'PERSONAL_MOBILE' => $textHandler->textToSafeState($_POST['REGISTER']['PERSONAL_MOBILE']),
            'PERSONAL_STREET' => $textHandler->textToSafeState($_POST['REGISTER']['PERSONAL_STREET']),
            'PERSONAL_CITY' => $textHandler->textToSafeState($_POST['REGISTER']['PERSONAL_CITY']),
            'PERSONAL_COUNTRY' => $textHandler->textToSafeState($_POST['REGISTER']['PERSONAL_COUNTRY']),
        );
        
        $generatedCode = EncryptionScope\Encryption::GetGeneratedCode(16);
        $fields['GENERATED_CODE'] = EncryptionScope\Encryption::GetEncryptedString($generatedCode);
        
        ob_start();
        
        ?>
        <div id="main-wrapper" style="font-size: 16px; margin: 0; padding: 0;">
            <div id="main-wrapper-header" style="position: relative; padding: 1rem 1rem 1rem 4rem; background-color: #176FC1;">
                <span id="main-logotype" style="position: absolute; top: 1rem; left: 1rem; color: #fff;">VLM</span>
                <a href="" id="main-site-name" style="color: #C9644B; font-weight: 700; text-decoration: none;"><?=SITE_SERVER_NAME;?></a>
            </div>
            <div id="main-wrapper-content" style="padding: 1rem; color: #544f4f;">
                <p id="main-content-text" style="margin: 0; margin-bottom: 1rem;">Здравствуйте, <?=$fields['NAME'];?>. Вот наш обещанный код, который Вы должны ввести в поле подтверждения регистрации.</p>
                <span id="code-formalizm" style="font-weight: 700; color: #000;">Код:</span>
                &nbsp;
                <span id="code-color" style="color: #1495a3;"><?=$generatedCode;?></span>
            </div>
            <div id="main-wrapper-footer" style="background-color: 
        #2f3741; padding: 2rem 0; text-align: center; color: #fff;">
                By Marchello &copy;
            </div>
        </div>
        <?
        
        $letterContent = ob_get_clean();
        
        $fieldsToLetter = array(
            'RECIPIENT' => $fields['EMAIL'],
            'TOPIC' => GetMessage('REGISTRATION_CONFIRM_CODE_TOPIC_TITLE'),
            'LETTER_CONTENT' => $letterContent
        );
        
        CEvent::Send("SEND_REGISTRATION_CONFIRM_CODE", 's1', $fieldsToLetter, 'N', '');
        
        $_SESSION['REGISTRATION_USER_DATA_TEMP'] = $fields;

        ob_start();
        ?>
        <form action="/local/ajax/register-form-confirm-handler.php" method="post" id="register-confirm-form">
            <section class="register-form-section">
                <h1 class="register-confirm-headline">Подтверждение регистрации</h1>
                <p class="register-confirm-message">
                    Мы выслали Вам код на Вашу почту <span id="register-confirm-email"><?=$fields['EMAIL'];?></span>. Просим Вас ввести его в поле ниже.
                </p>
            </section>
            <section class="register-form-section">
                <div class="register-field-question">
                    <span class="required"></span>
                </div>
                <div class="register-field-answer half-width-block">
                    <input type="text" name="REGISTER_CONFIRM_CODE" class="register-input validate-input"/>
                </div>
            </section>
            <section class="register-form-section">
                <div class="register-field-question"></div>
                <div class="register-field-answer half-width-block">
                    <button type="submit" class="form-submit-button submit-button-fleft"><?=GetMessage('REGISTER_SEND_CONFRIM_CODE_TITLE');?></button>
                </div>
            </section>
        </form>

        <script>
            $(document).ready(function()
            {
                let fieldsRules =
                {
                    'REGISTER_CONFIRM_CODE':
                    {
                        minStr: 6,
                        maxStr: 100
                    }
                };

                let validatorObject = new ValidatorObject('.register-field-question', $('.required'), '.validate-input', fieldsRules, 'answer-error');
                let registerConfirmForm = $('#register-confirm-form');

                registerConfirmForm.on('submit', function()
                {
                    let thisForm = $(this);

                    thisForm.find('.answer-error').remove();

                    validatorObject.checkFields();

                    if(thisForm.find('.answer-error')[0] !== undefined)
                    {
                        return false;
                    }
                });
            });
        </script>

        <?
        
        CEvent::CheckEvents();
        
        $responseContent = ob_get_clean();

        echo json_encode(array(
            'LOAD_DONE' => $responseContent
        ));
    }
    else
    {
        echo 'CAPTCHA_RESPONSE_FAILED';
    }
}
?>