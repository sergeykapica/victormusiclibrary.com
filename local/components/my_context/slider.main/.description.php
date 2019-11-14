<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SLIDER_MAIN_NAME"),
	"DESCRIPTION" => GetMessage("SLIDER_MAIN_NAME"),
	"CACHE_PATH" => "Y",
	"SORT" => 71,
	"PATH" => array(
		"ID" => "utilities",
		"CHILD" => array(
			"ID" => "slider.main",
			"NAME" => GetMessage("SLIDER_MAIN_NAME"),
			"SORT" => 31
		)
	)
);

?>