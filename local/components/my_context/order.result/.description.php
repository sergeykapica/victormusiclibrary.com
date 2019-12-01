<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("ORDER_RESULT_TITLE"),
	"DESCRIPTION" => GetMessage("ORDER_RESULT_TITLE"),
	"CACHE_PATH" => "Y",
	"SORT" => 71,
	"PATH" => array(
		"ID" => "utilities",
		"CHILD" => array(
			"ID" => "order.result",
			"NAME" => GetMessage("ORDER_RESULT_TITLE"),
			"SORT" => 31
		)
	)
);

?>