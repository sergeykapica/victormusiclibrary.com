<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		'USE_CAPTCHA' => array(
            'NAME' => GetMessage('USE_CAPTCHA_TITLE'),
            'PARENT' => 'BASE',
            'TYPE' => 'CHECKBOX'
        )
	)
);
?>