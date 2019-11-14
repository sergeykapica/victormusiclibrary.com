<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="goods-list-wrapper">
    <?if(!empty($arResult['GOODS_LIST'])):?>
        <?foreach($arResult['GOODS_LIST'] as $goodsItem):?>
            <section class="goods-list-item list-item-separator">
                <a href="<?=$goodsItem['GOODS_ITEM_PART_URL'];?>" class="list-item-url">
                    <div class="list-item-icon" style="background-image: url(<?=$goodsItem['DETAIL_PICTURE'];?>);"></div>
                </a>
                <div class="list-item-headline"><?=$goodsItem['NAME'];?></div>
                <span class="list-item-price">
                    <?=$goodsItem['CATALOG_PRICE_1'];?>
                    <?
                    if($goodsItem['CATALOG_CURRENCY_1'] == 'RUB')
                    {
                        echo '&nbsp;<img src="' . SITE_TEMPLATE_PATH . '/images/icons/ruble.gif" class="ruble-icon"/>';
                    }
                    else if($goodsItem['CATALOG_CURRENCY_1'] == 'USD')
                    {
                        echo '&nbsp;&#36;';
                    }
                    else if($goodsItem['CATALOG_CURRENCY_1'] == 'UAH')
                    {
                        echo '&nbsp;';
                    }
                    else
                    {
                        echo '&nbsp;&euro;';
                    }
                    ?>
                </span>
            </section>
        <?endforeach;?>
    <?else:?>
        <div class="goods-list-empty"><?=GetMessage('GOODS_LIST_EMPTY');?></div>
    <?endif;?>
</div>
