<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!isset($_GET['AJAX_MODE']))
{
	$APPLICATION->ShowHead();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="pagination-items">

    <?/*if ($arResult["NavPageNomer"] > 1):?>

        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="pagination-prev"></a>

    <?else:?>
        <span class="pagination-prev pagination-prev-active"></span>
    <?endif*/?>

    <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

        <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
            <a class="pagination-item pagination-item-active <?=( $arResult["nStartPage"] != $arResult["nEndPage"] ? 'pagination-item-indentation' : '' );?>"><?=$arResult["nStartPage"]?></a>
        <?else:?>
            <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="pagination-item <?=( $arResult["nStartPage"] != $arResult["nEndPage"] ? 'pagination-item-indentation' : '' );?>"><?=$arResult["nStartPage"]?></a>
        <?endif?>

        <?$arResult["nStartPage"]++?>
    <?endwhile?>


    <?/*if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="pagination-next"></a>
    <?else:?>
        <span class="pagination-next pagination-next-active"></span>
    <?endif*/?>
    
</div>