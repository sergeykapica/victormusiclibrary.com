<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MAIN_AUTHORIZATION_TITLE"),
	"DESCRIPTION" => GetMessage("MAIN_AUTHORIZATION_TITLE"),
	"CACHE_PATH" => "Y",
	"SORT" => 71,
	"PATH" => array(
		"ID" => "authorization",
		"CHILD" => array(
			"ID" => "main.authorization",
			"NAME" => GetMessage("MAIN_AUTHORIZATION_TITLE"),
			"SORT" => 31
		)
	)
);

?>