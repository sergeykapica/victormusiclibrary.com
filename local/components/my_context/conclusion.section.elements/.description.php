<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("CONCLUSION_SECTION_ELEMENTS_TITLE"),
	"DESCRIPTION" => GetMessage("CONCLUSION_SECTION_ELEMENTS_TITLE"),
	"CACHE_PATH" => "Y",
	"SORT" => 71,
	"PATH" => array(
		"ID" => "utilities",
		"CHILD" => array(
			"ID" => "conclusion.section.elements",
			"NAME" => GetMessage("CONCLUSION_SECTION_ELEMENTS_TITLE"),
			"SORT" => 31
		)
	)
);

?>