<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="authorization-form-wrapper">
    <form action="/local/ajax/authorization-form-handler.php" method="post" id="authorization-form">
        <section class="authorization-form-section">
            <div class="authorization-field-question">
                <span class="required"></span>
            </div>
            <div class="authorization-field-answer">
                <div class="authorization-input-wrapper">
                    <div class="authorization-input-icon" id="login-input-icon"></div>
                    <input type="text" name="AUTHORIZATION_USER_LOGIN" class="authorization-input validate-input"/>
                </div>
            </div>
        </section>
        <section class="authorization-form-section">
            <div class="authorization-field-question">
                <span class="required"></span>
            </div>
            <div class="authorization-field-answer">
                <div class="authorization-input-wrapper">
                    <div class="authorization-input-icon" id="password-input-icon"></div>
                    <input type="password" name="AUTHORIZATION_USER_PASSWORD" class="authorization-input validate-input"/>
                </div>
            </div>
        </section>
        <?if($arParams["USE_CAPTCHA"] == 'Y'):?>
            <section class="authorization-form-section">
                <div class="authorization-field-question">
                    <span class="required"></span>
                </div>
                <div class="authorization-field-answer">
                    <div class="authorization-captcha-wrapper" id="authorization-captcha-wrapper">
                        <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" class="captcha-sid" />
				        <img src="/local/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>&SET_BORDER_COLOR=232, 202, 158" alt="CAPTCHA" class="authorization-captcha-image captcha-image" />
                    </div>
                    <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" class="authorization-input validate-input"/>
                </div>
            </section>
        <?endif;?>
        <section class="authorization-form-section">
            <div class="authorization-field-question"></div>
            <div class="authorization-field-answer">
                <button type="submit" class="form-submit-button submit-button-fullwidth" id="authorization-submit-button"><?=GetMessage('LOGIN_SUBMIT_BUTTON_TITLE');?></button>
                <div class="spinner spinner-absolute" id="authorization-form-spinner"></div>
            </div>
        </section>
    </form>
    
    <a href="#forgotten-password-wrapper" type="button" class="forgotten-password-button">Забыли пароль?</a>
    
    <div id="forgotten-password-wrapper">
        <p class="main-text-headline">Восстановление пароля</p>
        <form action="/local/ajax/forgotten-password-form-handler.php" method="post" id="forgotten-password-form">
            <section class="authorization-form-section">
                <div class="forgotten-field-question">
                    <span class="required"></span>
                </div>
                <div class="forgotten-field-answer">
                    <div class="authorization-input-wrapper">
                        <div class="authorization-input-icon" id="email-input-icon"></div>
                        <input type="text" name="RECOVERY_PASSWORD_USER_EMAIL" class="authorization-input validate-forgotten-input"/>
                    </div>
                </div>
            </section>
            <?if($arParams["USE_CAPTCHA"] == 'Y'):?>
                <section class="authorization-form-section">
                    <div class="forgotten-field-question">
                        <span class="required"></span>
                    </div>
                    <div class="forgotten-field-answer">
                        <div class="authorization-captcha-wrapper" id="forgotten-captcha-wrapper">
                            <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" class="captcha-sid" />
                            <img src="/local/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>&SET_BORDER_COLOR=232, 202, 158" alt="CAPTCHA" class="authorization-captcha-image captcha-image" />
                        </div>
                        <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" class="authorization-input validate-forgotten-input"/>
                    </div>
                </section>
            <?endif;?>
            <section class="authorization-form-section">
                <div class="forgotten-field-question"></div>
                <div class="forgotten-field-answer">
                    <button type="submit" class="form-submit-button submit-button-fullwidth" id="forgotten-submit-button"><?=GetMessage('FORGOTTEN_PASSWORD_SUBMIT_BUTTON_TITLE');?></button>
                    <div class="spinner spinner-absolute" id="forgotten-form-spinner"></div>
                </div>
            </section>
        </form>
    </div>
    
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/validator-object.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/input-placeholder.js"></script>
    
    <script>
        $(window).ready(function()
        {
            setPlaceholderToInput($('input[name=AUTHORIZATION_USER_LOGIN]'), 'Логин', '#b3b0af');
            setPlaceholderToInput($('input[name=AUTHORIZATION_USER_PASSWORD]'), 'Пароль', '#b3b0af');
            setPlaceholderToInput($('#authorization-form').find('input[name=captcha_word]'), 'Введите код капчи', '#b3b0af');
            setPlaceholderToInput($('input[name=RECOVERY_PASSWORD_USER_EMAIL]'), 'Электронная почта', '#b3b0af');
            setPlaceholderToInput($('#forgotten-password-form').find('input[name=captcha_word]'), 'Введите код капчи', '#b3b0af');
            
            let fieldsRules =
            {
                'AUTHORIZATION_USER_LOGIN':
                {
                    minStr: 3,
                    maxStr: 100,
                    isPlaceHolder: 'Логин'
                },
                
                'AUTHORIZATION_USER_PASSWORD':
                {
                    minStr: 6,
                    maxStr: 100,
                    isPlaceHolder: 'Пароль'
                },
                
                'captcha_word':
                {
                    isEmpty: true,
                    isPlaceHolder: 'Введите код капчи'
                }
            };

            let validatorObject = new ValidatorObject('.authorization-field-question', $('.required'), '.validate-input', fieldsRules, 'answer-error');

            let authorizationForm = $('#authorization-form');

            authorizationForm.on('submit', function()
            {
                try
                {
                    let thisForm = $(this);

                    thisForm.find('.answer-error').remove();

                    validatorObject.checkFields();

                    if(thisForm.find('.answer-error')[0] !== undefined)
                    {
                        return false;
                    }

                    let formData = thisForm.serialize();

                    $.ajax({
                        url: thisForm.attr('action'),
                        method: thisForm.attr('method'),
                        data: formData,
                        success: function(res)
                        {
                            if(res != false)
                            {
                                if(res == 'CORRECT_PASSWORD_AND_LOGIN')
                                {
                                    location.assign('/personal');
                                }
                                else if(res == 'INVALID_PASSWORD_OR_LOGIN')
                                {  
                                    let message = validatorObject.generateErrorMessage('Логин или пароль являются неверными', $('#authorization-submit-button').parent());
                    
                                    $('#authorization-submit-button').parent().append(message);
                                }
                                else
                                {
                                    let message = validatorObject.generateErrorMessage('Код капчи не совпадает с нужным', thisForm.find('input[name=captcha_word]').parent());
                    
                                    thisForm.find('input[name=captcha_word]').parent().append(message);
                                }
                            }
                        }
                    });
                }
                catch(e)
                {
                    console.log(e);
                }
                
                return false;
            });
            
            let forgottenPasswordButton = $('.forgotten-password-button');
            
            var forgottenPasswordWrapperOpenStatus = false;
            var forgottenPasswordWrapper = $('#forgotten-password-wrapper');
            
            forgottenPasswordButton.on('click', function()
            {
                if(forgottenPasswordWrapperOpenStatus === false)
                {
                    forgottenPasswordWrapper.slideDown(500);
                    captchaChange($('#forgotten-captcha-wrapper'));
                    
                    forgottenPasswordWrapperOpenStatus = true;
                }
                else
                {
                    forgottenPasswordWrapper.slideUp(500);
                    
                    forgottenPasswordWrapperOpenStatus = false;
                }
                
                return false;
            });
            
            let fieldsRulesForForgotten =
            {
                'RECOVERY_PASSWORD_USER_EMAIL':
                {
                    minStr: 3,
                    maxStr: 100,
                    isEmail: true,
                    isPlaceHolder: 'Электронная почта'
                },
                
                'captcha_word':
                {
                    isEmpty: true,
                    isPlaceHolder: 'Введите код капчи'
                }
            };

            let validatorObject2 = new ValidatorObject('.forgotten-field-question', $('.required'), '.validate-forgotten-input', fieldsRulesForForgotten, 'answer-error');
            
            let forgottenPasswordForm = $('#forgotten-password-form');
            
            forgottenPasswordForm.on('submit', function()
            {
                let thisForm = $(this);

                thisForm.find('.answer-error').remove();

                validatorObject2.checkFields();

                if(thisForm.find('.answer-error')[0] !== undefined)
                {
                    return false;
                }

                let formData = thisForm.serialize();
                
                $.ajax({
                    url: thisForm.attr('action'),
                    method: thisForm.attr('method'),
                    data: formData,
                    success: function(res)
                    {
                        if(res != false)
                        {
                            if(res == 'NEW_PASSWORD_SENT')
                            {
                                let message = validatorObject2.generateSuccessMessage('Новый пароль успешно отправлен Вам на почту', $('#forgotten-submit-button').parent());

                                $('#forgotten-submit-button').parent().append(message);
                            }
                            else
                            {
                                let message = validatorObject2.generateErrorMessage('Логин или пароль являются неверными', $('#authorization-submit-button').parent());

                                $('#forgotten-submit-button').parent().append(message);
                            }
                        }
                    }
                });

                return false;
            });
        });
    </script>
</div>