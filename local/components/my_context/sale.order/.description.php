<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SALE_ORDER_TITLE"),
	"DESCRIPTION" => GetMessage("SALE_ORDER_TITLE"),
	"CACHE_PATH" => "Y",
	"SORT" => 71,
	"PATH" => array(
		"ID" => "utilities",
		"CHILD" => array(
			"ID" => "sale.order",
			"NAME" => GetMessage("SALE_ORDER_TITLE"),
			"SORT" => 31
		)
	)
);

?>