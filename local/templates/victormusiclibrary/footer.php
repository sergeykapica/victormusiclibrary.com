                </div>
            </main>
            <?if(!$USER->IsAuthorized()):?>
                <div class="wrapper-popup-background">
                    <div class="auth-forms-wrapper">
                        <div class="auth-buttons-container">
                            <button class="auth-buttons tab-button-active" data-id="auth-authorization">Авторизация</button>
                            <button class="auth-buttons" data-id="auth-register">Регистрация</button>
                            <button class="aform-close-button"></button>
                        </div>
                        <div class="auth-buttons-tabs">
                            <div class="auth-tabs tab-open" id="auth-authorization">
                                <?$APPLICATION->IncludeComponent(
                                    'my_context:main.authorization',
                                    'victormusiclibrary',
                                    array(
                                        'USE_CAPTCHA' => 'Y'
                                    )
                                );?>
                            </div>
                            <div class="auth-tabs" id="auth-register">
                                <?$APPLICATION->IncludeComponent(
                                    "my_context:main.register",
                                    "victormusiclibrary",
                                    Array(
                                        "AUTH" => "N",
                                        "REQUIRED_FIELDS" => array("EMAIL", "NAME", "LAST_NAME", "PERSONAL_GENDER"),
                                        "SET_TITLE" => "Y",
                                        "SHOW_FIELDS" => array("EMAIL", "NAME", "LAST_NAME", "PERSONAL_GENDER", "PERSONAL_BIRTHDAY", "PERSONAL_PHOTO", "PERSONAL_MOBILE", "PERSONAL_STREET", "PERSONAL_CITY", "PERSONAL_COUNTRY"),
                                        "SUCCESS_PAGE" => "/",
                                        "USER_PROPERTY" => array(),
                                        "USER_PROPERTY_NAME" => "",
                                        "USE_BACKURL" => "Y"
                                    )
                                );?>
                            </div>
                        </div>
                    </div>
                </div>
            <?endif;?>
		</div>

        <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/other-functions.js"></script>
        <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/captcha-change.js"></script>

        <script type="text/javascript">
            $(window).ready(function()
            {
                var wrapperHeaderHead = $('.wrapper-header-head');
                wrapperHeaderHead.sticky({
                    topSpacing: 0
                });
                
                oOtherFunctions.setTabs($('.auth-buttons'), $('.auth-tabs'), function(tab)
                {
                    let captchaWrapper = $(tab.find('#authorization-captcha-wrapper')[0] || tab.find('#register-captcha-wrapper')[0]);
                    
                    captchaChange(captchaWrapper);
                });
                
                let headAuthButton = $('.head-auth-button');
                let wrapperPopupBackground = $('.wrapper-popup-background');
                
                headAuthButton.on('click', function()
                {
                    wrapperPopupBackground.fadeIn(500);
                });
                
                wrapperPopupBackground.on('click', function(e)
                {
                    console.log($(this)[0].classList[0]);
                    if(target.hasClass($(this)[0].classList[0]) || target.hasClass('aform-close-button'))
                    {
                        wrapperPopupBackground.fadeOut(500);
                    }
                });
            });
        </script>
	</body>
</html>