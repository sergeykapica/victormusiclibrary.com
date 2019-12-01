<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul class="head-menu">
    <?
    $previousLevel = 0;
    $depthOneItemCount = 0;
    
    foreach($arResult as $arIt):
    
        if($arIt['DEPTH_LEVEL'] == 1):
            $depthOneItemCount += 1;
        endif;
    
    endforeach;
    
    $countItems = 0;
    
    /*echo '<pre>';
    print_r($arResult);
    echo '</pre>';*/
    
    foreach($arResult as $arItem):
    ?> 
        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
            <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
        <?endif?>
    
        <?if ($arItem["IS_PARENT"]):?>

            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <?$countItems++;?>
                <li class="head-menu-item <?=( $countItems !== $depthOneItemCount ? 'menu-item-indentation' : '' );?> <?=( $arItem["SELECTED"] ? 'head-menu-active' : '' );?>"><a href="<?=$arItem["LINK"]?>" class="menu-item-link has-submenu"><?=$arItem["TEXT"]?></a>
                    <ul class="head-submenu-wrapper">
            <?else:?>
                <li class="head-menu-item submenu-item <?=( $arItem["SELECTED"] ? 'head-menu-active' : '' );?> parent"><a href="<?=$arItem["LINK"]?>" class="menu-item-link has-submenu"><?=$arItem["TEXT"]?></a>
                    <ul class="head-submenu-wrapper">   
            <?endif?>
            
        <?else:?>
                        
            <?if ($arItem["PERMISSION"] > "D"):?>

                <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                    <?$countItems++;?>
                    <li class="head-menu-item <?=( $countItems !== $depthOneItemCount ? 'menu-item-indentation' : '' );?> <?=( $arItem["SELECTED"] ? 'head-menu-active' : '' );?>"><a href="<?=$arItem["LINK"]?>" class="menu-item-link"><?=$arItem["TEXT"]?></a></li>
                <?else:?>
                    <li class="head-menu-item submenu-item <?=( $arItem["SELECTED"] ? 'head-menu-active' : '' );?>"><a href="http://<?=$arItem["ADDITIONAL_LINKS"][0];?>" class="menu-item-link"><?=$arItem["TEXT"]?></a></li>
                <?endif?>

            <?else:?>

                <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                    <?$countItems++;?>
                    <li class="head-menu-item <?=( $countItems !== $depthOneItemCount ? 'menu-item-indentation' : '' );?> <?=( $arItem["SELECTED"] ? 'head-menu-active' : '' );?>"><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>" class="menu-item-link"><?=$arItem["TEXT"]?></a></li>
                <?else:?>
                    <li class="head-menu-item submenu-item <?=( $arItem["SELECTED"] ? 'head-menu-active' : '' );?> denied"><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>" class="menu-item-link"><?=$arItem["TEXT"]?></a></li>
                <?endif?>

            <?endif?>
        
        <?endif?>
        
        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
    <?
    endforeach;
    ?>
                        
    <?if ($previousLevel > 1):?>
        <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>
                        
</ul>

<?/*Standart menu*/?>
<?/*<ul id="horizontal-multilevel-menu">
    
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul>
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<div class="menu-clear-left"></div>*/?>
                
<?endif?>