<!DOCTYPE html>
<html>
	<head>
		<title><?$APPLICATION->ShowTitle();?></title>
		<?
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery-3.4.1.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.sticky.js');
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/animate.css');
		$APPLICATION->ShowHead();
		?>
	</head>
	<body>
		<?
			$APPLICATION->ShowPanel();
		?>
		<div id="main-wrapper">
			<header class="main-wrapper-header">
                <div class="wrapper-header-head">
                    <div class="header-head-logotype"><span class="head-logotype-text">VLM</span></div>
                    <div class="header-head-menu">
                        <?$APPLICATION->IncludeComponent(
                            "my_context:menu",
                            "victormusiclibrary",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "topSubMenu",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "2",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "top",
                                "USE_EXT" => "Y"
                            )
                        );?>
                    </div>
                    <?if(!$USER->IsAuthorized()):?>
                        <button type="button" class="head-auth-button"><?=GetMessage('AUTH_FORM_BUTTON_TITLE');?></button>
                    <?else:?>
                        <?$APPLICATION->IncludeComponent(
                            "my_context:menu",
                            "victormusiclibrary_personal_right_menu",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "personalRightMenu",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "personalRightMenu",
                                "USE_EXT" => "Y"
                            )
                        );?>
                    <?endif;?>
                </div>
                <div class="wrapper-header-content">
                    
                    <?/* photo slider */?>
                    
                    <?
                    $photoListUrl = SITE_TEMPLATE_PATH . '/images/slider/slider-1.jpg, ' . SITE_TEMPLATE_PATH . '/images/slider/slider-2.jpg, '
                                    . SITE_TEMPLATE_PATH . '/images/slider/slider-3.jpg, ' . SITE_TEMPLATE_PATH . '/images/slider/slider-4.jpg';
                    ?>

                    <?$APPLICATION->IncludeComponent(
                        'my_context:slider.main',
                        'victormusiclibrary',
                        array(
                            'PHOTO_URL_LIST' => $photoListUrl
                        )
                    );?>
                </div>
                <?if(isset($_GET['REGISTER_CONFIRM'])):?>
                    <?$registerConfirm = htmlspecialcharsBX($_GET['REGISTER_CONFIRM']);?>
                
                    <?if($registerConfirm == 1):?>
                        <div class="response-notify-success animated fadeInLeft">
                            <div class="notify-success-icon"></div>
                            <span><?=GetMessage('RESPONSE_NOTIFY_REGISTER_CUNFIRM');?></span>
                        </div>
                    <?else:?>
                        <div class="response-notify-error animated fadeInLeft">
                            <div class="notify-error-icon"></div>
                            <span><?=GetMessage('RESPONSE_NOTIFY_REGISTER_UNCUNFIRM');?></span>
                        </div>
                    <?endif;?>
                
                    <script type="text/javascript">
                        $(window).ready(function()
                        {
                            let notifyMessage = $($('.response-notify-success')[0] || $('.response-notify-error')[0]);
                            
                            notifyMessage.on('animationend', function()
                            {
                                let thisNotifyMessage = $(this);
                                
                                setTimeout(function()
                                {
                                    thisNotifyMessage.off('animationend');
                                    
                                    thisNotifyMessage.removeClass('fadeInLeft');
                                    thisNotifyMessage.addClass('fadeOutLeft');
                                    
                                    thisNotifyMessage.on('animationend', function()
                                    {
                                        thisNotifyMessage.remove();
                                    });
                                }, 3000);
                            });
                        });
                    </script>
                <?endif;?>
            </header>
            <main class="main-wrapper-content">
                <div class="content-left-side">
                    <div class="content-advertising"></div>
                    <div class="content-advertising"></div>
                </div>
                <div class="content-right-side">