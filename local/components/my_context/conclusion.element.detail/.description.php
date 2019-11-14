<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("CONSLUSION_ELEMENT_DETAIL_TITLE"),
	"DESCRIPTION" => GetMessage("CONSLUSION_ELEMENT_DETAIL_TITLE"),
	"CACHE_PATH" => "Y",
	"SORT" => 71,
	"PATH" => array(
		"ID" => "utilities",
		"CHILD" => array(
			"ID" => "conclusion.element.detail",
			"NAME" => GetMessage("CONSLUSION_ELEMENT_DETAIL_TITLE"),
			"SORT" => 31
		)
	)
);

?>