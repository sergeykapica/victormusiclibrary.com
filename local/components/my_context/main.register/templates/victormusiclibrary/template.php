<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/validator-styles.css");

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>
<div class="bx-auth-reg">

<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
    <?
    if (count($arResult["ERRORS"]) > 0):
        foreach ($arResult["ERRORS"] as $key => $error)
            if (intval($key) == 0 && $key !== 0) 
                $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

        ShowError(implode("<br />", $arResult["ERRORS"]));

    elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
    ?>
    <p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
    <?endif;?>
    
    <form method="post" action="/local/ajax/register-form-handler.php" name="regform" enctype="multipart/form-data" id="register-form">
        <?
        if($arResult["BACKURL"] <> ''):
        ?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?
        endif;
        ?>
        
        <?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
            <?
            switch($FIELD)
            {
                case 'LOGIN':
                case 'NAME':
                case 'LAST_NAME':
                case 'EMAIL':
                    ?>
                    <section class="register-form-section">
                        <div class="register-field-question">
                            <span><?=GetMessage("REGISTER_FIELD_" . $FIELD);?></span>
                            <span class="required"></span>
                        </div>
                        <div class="register-field-answer half-width-block">
                            <input type="text" name="REGISTER[<?=$FIELD;?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="register-input validate-input"/>
                        </div>
                    </section>
                    <?
                break;
                    
                case 'PASSWORD':
                case 'CONFIRM_PASSWORD':
                    ?>
                    <section class="register-form-section">
                        <div class="register-field-question">
                            <span><?=GetMessage("REGISTER_FIELD_" . $FIELD);?></span>
                            <span class="required"></span>
                        </div>
                        <div class="register-field-answer half-width-block">
                            <input type="password" name="REGISTER[<?=$FIELD;?>]" autocomplete="off" value="<?=$arResult["VALUES"][$FIELD]?>" class="register-input validate-input <?=( $FIELD == 'PASSWORD' ? 'compare-password' : '' );?>"/>
                        </div>
                    </section>
                    <?
                break;
                    
                case 'PERSONAL_GENDER':
                    ?>
                    <section class="register-form-section">
                         <div class="register-field-question">
                            <span><?=GetMessage("REGISTER_FIELD_" . $FIELD);?></span>
                            <span class="required"></span>
                        </div>
                        <div class="register-field-answer">
                            <div id="radio-icon-m"></div>
                            <div class="register-input-separator"></div>
                            <div class="custom-radio-wrapper">
                                <label class="custom-radio-label">
                                   <input type="radio" name="REGISTER[<?=$FIELD;?>]" value="M" class="custom-radio-input validate-input"/>
                                   <div class="custom-radio-circle" title="<?=GetMessage('GENDER_MALE_TITLE');?>">
                                       <div class="radio-circle-inner"></div>
                                   </div>
                                 </label>
                            </div>
                            <div class="register-input-separator"></div>
                            <div id="radio-icon-f"></div>
                            <div class="register-input-separator"></div>
                            <div class="custom-radio-wrapper">
                                <label>
                                   <input type="radio" name="REGISTER[<?=$FIELD;?>]" value="F" class="custom-radio-input validate-input"/>
                                   <div class="custom-radio-circle" title="<?=GetMessage('GENDER_FEMALE_TITLE');?>">
                                       <div class="radio-circle-inner"></div>
                                   </div>
                                 </label>
                            </div>
                        </div>
                    </section>
                    <?
                break;
                    
                case 'PERSONAL_BIRTHDAY':
                    ?>
                    <section class="register-form-section">
                        <div class="register-field-question">
                            <span><?=GetMessage("REGISTER_FIELD_" . $FIELD);?></span>
                        </div>
                        <div class="register-field-answer half-width-block">
                            <input type="text" name="REGISTER[<?=$FIELD;?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="register-input validate-input"/>
                        </div>
                        
                        <?$APPLICATION->IncludeComponent(
                            'bitrix:main.calendar',
                            '',
                            array(
                                'SHOW_INPUT' => 'N',
                                'FORM_NAME' => 'regform',
                                'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
                                'SHOW_TIME' => 'N'
                            ),
                            null,
                            array("HIDE_ICONS"=>"Y")
                        );?>
                    </section>
                    <?
                break;
                    
                case 'PERSONAL_PHOTO':
                    ?>
                    <section class="register-form-section">
                        <div class="register-field-question">
                            <span><?=GetMessage("REGISTER_FIELD_" . $FIELD);?></span>
                        </div>
                        <div class="register-field-answer half-width-block">
                            <label>
                                <div class="register-file-wrapper">
                                    <div class="register-file-title"><?=GetMessage('SELECT_FILE_TITLE');?></div>
                                    <div class="register-file-name"></div>
                                </div>
                                <input type="file" name="<?=$FIELD;?>" class="register-file validate-input"/>
                            </label>
                        </div>
                    </section>
                    <?
                break;
                    
                case 'PERSONAL_MOBILE':
                    ?>
                    <section class="register-form-section">
                        <div class="register-field-question">
                            <span><?=GetMessage("REGISTER_FIELD_" . $FIELD);?></span>
                        </div>
                        <div class="register-field-answer half-width-block">
                            <input type="text" name="REGISTER[<?=$FIELD;?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="register-input validate-input"/>
                        </div>
                    </section>
                    <?
                break;
                    
                case 'PERSONAL_CITY':
                    ?>
                    <section class="register-form-section">
                        <div class="register-field-question">
                            <span><?=GetMessage("REGISTER_FIELD_" . $FIELD);?></span>
                        </div>
                        <div class="register-field-answer half-width-block">
                            <input type="text" name="REGISTER[<?=$FIELD;?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="register-input validate-input"/>
                        </div>
                    </section>
                    <?
                break;
                    
                case 'PERSONAL_STREET':
                    ?>
                    <section class="register-form-section">
                        <div class="register-field-question">
                            <span><?=GetMessage("REGISTER_FIELD_" . $FIELD);?></span>
                        </div>
                        <div class="register-field-answer half-width-block">
                            <input type="text" name="REGISTER[<?=$FIELD;?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="register-input validate-input"/>
                        </div>
                    </section>
                    <?
                break;
                    
                case "PERSONAL_COUNTRY":
                    ?>
                    <section class="register-form-section">
                        <div class="register-field-question">
                            <span><?=GetMessage("REGISTER_FIELD_" . $FIELD);?></span>
                        </div>
                        <div class="register-field-answer half-width-block">
                            <div class="custom-select-wrapper">
                                <div class="custom-select-container">
                                    <select name="REGISTER[<?=$FIELD;?>]" size="10" class="custom-select">
                                        <?foreach($arResult["COUNTRIES"]["reference_id"] as $key => $value):?>
                                            <option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
                                        <?endforeach;?>
                                    </select>
                                    <button type="button" class="custom-select-button select-close"></button>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?
                break;
            }
            ?>
        <?endforeach;?>
        
        <section class="register-form-section">
            <div class="register-field-question">
                <span><a href="/" class="user-rules-button"><?=GetMessage("REGISTER_FIELD_ACCEPT_RULES");?></a></span>
                <span class="required"></span>
            </div>
            <div class="register-field-answer half-width-block">
                <div class="custom-checkbox-wrapper">
                    <label class="custom-checkbox-label">
                        <input type="checkbox" name="REGISTER[CHECK_RULES]" value="1" class="custom-checkbox-input validate-input"/>
                        <div class="custom-checkbox"></div>
                    </label>
                </div>
            </div>
        </section>
        
        <?if($arResult["USE_CAPTCHA"] == 'Y'):?>
            <section class="register-form-section">
                <div class="register-field-question">
                    <span><?=GetMessage("REGISTER_FIELD_CAPTCHA_ENTRY_TITLE");?></span>
                    <span class="required"></span>
                </div>
                <div class="register-field-answer half-width-block">
                    <div class="register-captcha-wrapper" id="register-captcha-wrapper">
                        <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" class="captcha-sid"/>
				        <img src="/local/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>&SET_BORDER_COLOR=232, 202, 158" alt="CAPTCHA" class="register-captcha-image captcha-image" />
                    </div>
                    <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" class="register-input validate-input"/>
                </div>
            </section>
        <?endif;?>
        
        <section class="register-form-section">
            <div class="register-field-question">
                <div class="spinner" id="register-form-spinner"></div>
            </div>
            <div class="register-field-answer half-width-block">
                <button type="submit" class="form-submit-button submit-button-fright" id="register-submit-button"><?=GetMessage('REGISTER_SUBMIT_BUTTON_TITLE');?></button>
            </div>
        </section>
    </form>
<?endif;?>
    
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/custom-select.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/popup-notify.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/validator-object.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/upload-and-send-data-ajax.js"></script>
    
<script type="text/javascript">
    $(window).ready(function()
    {
        setCustomSelect($('.custom-select-button'));
        
        let registerFile = $('.register-file');
        
        registerFile.on('change', function()
        {
            let thisFileInput = $(this);
            let registerFileName = thisFileInput.parent().find('.register-file-name');
            
            if(registerFileName[0] !== undefined)
            {
                registerFileName.text(thisFileInput[0].files[0].name);
            }
        });
        
        let userRulesButton = $('.user-rules-button');
        
        userRulesButton.on('click', function()
        {
            setPopupNotify($('#main-wrapper'), {
                headlineText: '<?=GetMessage('USER_RULES_HEADLINE_TITLE');?>',
                contentText: `
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/local/include_files/text_content/user-rules-for-handler-data.txt"
                    )
                );?>
                `,
                indentParams: {
                    indentPopup: $('.wrapper-header-head')[0].offsetHeight,
                    contentIndent: $('.wrapper-header-content')[0].offsetHeight,
                    mainContentElement: $('.main-wrapper-content')
                }
            });
            
            return false;
        });
        
        let fieldsRules =
        {
            'REGISTER[LOGIN]':
            {
                minStr: 3,
                maxStr: 100,
                checkLogin:
                {
                    is: true
                }
            },
            
            'REGISTER[NAME]':
            {
                minStr: 3,
                maxStr: 100
            },
            
            'REGISTER[LAST_NAME]':
            {
                minStr: 3,
                maxStr: 100
            },
            
            'REGISTER[EMAIL]':
            {
                isEmail: true,
                minStr: 3,
                maxStr: 200,
                checkEmail:
                {
                    is: true
                }
                
            },
            
            'REGISTER[PASSWORD]':
            {
                minStr: 6,
                maxStr: 100
            },

            'REGISTER[CONFIRM_PASSWORD]':
            {
                minStr: 6,
                maxStr: 100
            },
            
            'REGISTER[PERSONAL_GENDER]':
            {
                isValueSelected: true
            },
            
            'REGISTER[CHECK_RULES]':
            {
                isCheckCheckbox: true
            },
            
            'captcha_word':
            {
                isEmpty: true
            }
        };
        
        let validatorObject = new ValidatorObject('.register-field-question', $('.required'), '.validate-input', fieldsRules, 'answer-error');
        
        let registerForm = $('#register-form');
        
        registerForm.on('submit', function()
        {
            let thisForm = $(this);
            
            thisForm.find('.answer-error').remove();

            validatorObject.fieldsRules['REGISTER[CONFIRM_PASSWORD]'].comparePassword = $('.compare-password').val();
            validatorObject.checkFields();
            
            if(thisForm.find('.answer-error')[0] !== undefined)
            {
                return false;
            }
            
            let formData = new FormData(thisForm[0]);
            
            function successRequest()
            {
                let responseContent = JSON.parse(this.xhr.responseText);
                
                if(responseContent.LOAD_DONE !== undefined)
                {
                    $('.bx-auth-reg').replaceWith(responseContent.LOAD_DONE);
                }
                else
                {
                    let message = this.oValidator.generateErrorMessage(responseContent.LOAD_FAILED, $('#register-submit-button').parent());
                    
                    $('#register-submit-button').parent().append(message);
                }
                
                this.spinner.removeClass('spinner-show');
                this.spinner.addClass('spinner-hide');
            }
            
            uploadAndSendData(thisForm.attr('action'), formData, successRequest, validatorObject, thisForm, $('#register-form-spinner'));
            
            return false;
        });
    });
</script>