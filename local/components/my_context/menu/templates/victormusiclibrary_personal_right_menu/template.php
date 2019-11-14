<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<nav id="user-profile-menu">
    <?foreach($arResult as $arItem):?>
        <?if($arItem['PARAMS']['SYMBOL_CODE'] != 'user-bill'):?>
            <a href="<?=$arItem['LINK'];?>" class="profile-menu-item" id="<?=$arItem['PARAMS']['SYMBOL_CODE'];?>"></a>
        <?else:?>
            <a class="profile-menu-item" id="user-bill-wrapper">
                <span class="user-bill">1000</span>
                <div id="user-bill-icon"></div>
            </a>
        <?endif;?>
    <?endforeach;?>
</nav>
                
<?endif?>