<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("ORDER_RESULT_FILES_LIST_NAME"),
	"DESCRIPTION" => GetMessage("ORDER_RESULT_FILES_LIST_NAME"),
	"CACHE_PATH" => "Y",
	"SORT" => 71,
	"PATH" => array(
		"ID" => "utilities",
		"CHILD" => array(
			"ID" => "order.result.files_list",
			"NAME" => GetMessage("ORDER_RESULT_FILES_LIST_NAME"),
			"SORT" => 31
		)
	)
);

?>