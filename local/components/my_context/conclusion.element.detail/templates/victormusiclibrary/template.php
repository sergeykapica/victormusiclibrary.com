<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="item-detail-wrapper">
    <?if(!empty($arResult['GOODS_ITEM_FIELDS'])):?>
        <div class="item-detail-left">
            <div class="item-detail-icon" style="background-image: url(<?=$arResult['GOODS_ITEM_FIELDS']['DETAIL_PICTURE'];?>);"></div>
        </div>
        <div class="item-detail-right">
            <section class="detail-right-section">
                <div class="detail-headline"><?=$arResult['GOODS_ITEM_FIELDS']['NAME'];?></div>
            </section>
            <section class="detail-right-section">
                <div class="detail-description"><?=$arResult['GOODS_ITEM_FIELDS']['DETAIL_TEXT'];?></div>
            </section>
            <section class="detail-right-section">
                <?$APPLICATION->IncludeComponent(
                    'my_context:player',
                    'victormusiclibrary_audio',
                    array(
                        'AUDIO_URL' => $arResult['GOODS_ITEM_FIELDS']['PROPERTY_PREVIEW_SOUND_VALUE']
                    )
                );?>
            </section>
            <section class="detail-right-section">
                <span class="detail-price">
                    <?=$arResult['GOODS_ITEM_FIELDS']['CATALOG_PRICE_1'];?>
                    <?
                    if($arResult['GOODS_ITEM_FIELDS']['CATALOG_CURRENCY_1'] == 'RUB')
                    {
                        echo '&nbsp;<img src="' . SITE_TEMPLATE_PATH . '/images/icons/ruble.gif" class="ruble-icon"/>';
                    }
                    else if($arResult['GOODS_ITEM_FIELDS']['CATALOG_CURRENCY_1'] == 'USD')
                    {
                        echo '&nbsp;&#36;';
                    }
                    else if($arResult['GOODS_ITEM_FIELDS']['CATALOG_CURRENCY_1'] == 'UAH')
                    {
                        echo '&#8372;';
                    }
                    else
                    {
                        echo '&euro;';
                    }
                    ?>
                </span>
                <?if(isset($arResult['GOODS_ITEM_FIELDS']['ID_GOOD_FROM_BASKET']) && !empty($arResult['GOODS_ITEM_FIELDS']['ID_GOOD_FROM_BASKET'])):?>
                    <button type="button" data-good-id="<?=$arResult['GOODS_ITEM_FIELDS']['ID'];?>" data-good-id-basket="<?=$arResult['GOODS_ITEM_FIELDS']['ID_GOOD_FROM_BASKET'];?>" class="add-basket-button remove-good-basket"><?=GetMessage('REMOVE_FROM_BASKET_TITLE');?></button>
                <?else:?>
                    <button type="button" data-good-id="<?=$arResult['GOODS_ITEM_FIELDS']['ID'];?>" class="add-basket-button"><?=GetMessage('ADD_TO_BASKET_TITLE');?></button>
                <?endif;?>
            </section>
        </div>
    <?else:?>
        <div class="detail-fields-empty"><?=GetMessage('DETAIL_FIELDS_EMPTY_TITLE');?></div>
    <?endif;?>
</div>
<div class="good-comments-wrapper">
    <?$APPLICATION->IncludeComponent(
        "my_context:catalog.comments",
        "victormusiclibrary",
        Array(
            "BLOG_TITLE" => "Комментарии",
            "BLOG_URL" => "comments_for_goods",
            "BLOG_USE" => "Y",
            "CACHE_TIME" => "0",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMMENTS_COUNT" => "20",
            "ELEMENT_CODE" => "",
            "ELEMENT_ID" => $arResult['GOODS_ITEM_FIELDS']['ID'],
            "EMAIL_NOTIFY" => "N",
            "FB_APP_ID" => "",
            "FB_COLORSCHEME" => "light",
            "FB_ORDER_BY" => "social",
            "FB_TITLE" => "Facebook",
            "FB_USE" => "N",
            "FB_USER_ADMIN_ID" => "",
            "IBLOCK_ID" => "3",
            "IBLOCK_TYPE" => "goods",
            "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
            "SHOW_DEACTIVATED" => "N",
            "SHOW_RATING" => "N",
            "SHOW_SPAM" => "Y",
            "TEMPLATE_THEME" => "blue",
            "URL_TO_COMMENT" => "",
            "VK_USE" => "N",
            "WIDTH" => ""
        )
    );?>
</div>

<script type="text/javascript">
    $(window).ready(function()
    {
        let addBasketButton = $('.add-basket-button');
        
        addBasketButton.on('click', function()
        {
            var thisButton = $(this);
            
            if(!thisButton.hasClass('remove-good-basket'))
            {
                var url = '/local/ajax/personal/add-good-to-basket.php';
                url = url + '?GOOD_ID=' + thisButton.attr('data-good-id');
            }
            else
            {
                var url = '/local/ajax/personal/remove-good-from-basket.php';
                url = url + '?GOOD_ID=' + thisButton.attr('data-good-id-basket');
            }
            
            $.ajax({
                url: url,
                method: 'GET',
                success: function(res)
                {
                    if(res != false)
                    {
                        if(!thisButton.hasClass('remove-good-basket'))
                        {
                            thisButton.text('<?=GetMessage('REMOVE_FROM_BASKET_TITLE');?>');
                            thisButton.addClass('remove-good-basket');
                        }
                        else
                        {
                            thisButton.text('<?=GetMessage('ADD_TO_BASKET_TITLE');?>');
                            thisButton.removeClass('remove-good-basket');
                        }
                    }
                }
            });
        });
    });
</script>