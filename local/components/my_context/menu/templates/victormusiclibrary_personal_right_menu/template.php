<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<nav id="user-profile-menu">
    <?foreach($arResult as $arKey => $arItem):?>
        <?if((string) $arKey != 'USER_DATA'):?>
            <?if($arItem['PARAMS']['SYMBOL_CODE'] != 'user-bill'):?>
                <a href="<?=$arItem['LINK'];?>" class="profile-menu-item" id="<?=$arItem['PARAMS']['SYMBOL_CODE'];?>"></a>
            <?else:?>
                <a class="profile-menu-item" id="user-bill-wrapper">
                    <span class="user-bill"><?=$arResult['USER_DATA']['CURRENT_BILL'];?></span>
                    <?
                    if($arResult['USER_DATA']['CURRENT_CURRENCY'] == 'RUB')
                    {
                        echo '<div id="user-bill-icon" style="background-image: url(/local/components/my_context/menu/templates/victormusiclibrary_personal_right_menu/images/user-profile-icons.png);"></div>';
                    }
                    else if($arResult['USER_DATA']['CURRENT_CURRENCY'] == 'USD')
                    {
                        echo '<div id="user-bill-icon">&#36;</div>';
                    }
                    else if($arResult['USER_DATA']['CURRENT_CURRENCY'] == 'UAH')
                    {
                        echo '<div id="user-bill-icon">&#8372;</div>';
                    }
                    else
                    {
                        echo '<div id="user-bill-icon">&euro;</div>';
                    }
                    ?>
                </a>
            <?endif;?>
        <?endif;?>
    <?endforeach;?>
</nav>
                
<?endif?>