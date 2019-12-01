<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/validator-styles.css');
Asset::getInstance()->addCss('/local/components/my_context/sale.basket/templates/victormusiclibrary/style.css');
?>

<div class="order-head">
    <h3 class="order-headline"><?=GetMessage('GOODS_IN_ORDER');?>:</h3>
    <div class="sbasket-total"><span><?=GetMessage('TOTAL_AMOUNT_TITLE');?></span>:&nbsp;
        <span id="total-amount"><?=$arResult['TOTAL_ORDER_PRICE'];?></span>
        <?
        if($arResult['CURRENT_CURRENCY'] == 'RUB')
        {
            echo '<img src="' . SITE_TEMPLATE_PATH . '/images/icons/ruble.gif" class="ruble-icon"/>';
        }
        else if($arResult['CURRENT_CURRENCY'] == 'USD')
        {
            echo '&#36;';
        }
        else if($arResult['CURRENT_CURRENCY'] == 'UAH')
        {
            echo '&#8372;';
        }
        else
        {
            echo '&euro;';
        }
        ?>
    </div>
</div>
<?if(isset($arResult['BASKET_ITEMS']) && !empty($arResult['BASKET_ITEMS'])):?>
<div class="order-content">
    <section class="order-section">
        <table id="sbasket-table">
            <thead>
                <tr class="sbasket-header-string">
                    <th class="sbasket-cell">Фото</th>
                    <th class="sbasket-cell sbasket-cell-base">Название</th>
                    <th class="sbasket-cell sbasket-cell-base">Цена</th>
                    <th class="sbasket-cell sbasket-cell-base">Дата добавления</th>
                </tr>
                <?foreach($arResult['BASKET_ITEMS'] as $basketItem):?>
                    <tr data-good-id="<?=$basketItem['ID'];?>" class="sbasket-content-string">
                        <td class="sbasket-cell">
                            <div class="sbasket-photo" style="background-image: url(<?=$basketItem['PREVIEW_PICTURE'];?>);"></div>
                        </td>
                        <td class="sbasket-cell sbasket-cell-base"><?=$basketItem['NAME'];?></td>
                        <td class="sbasket-cell sbasket-cell-base">
                            <span class="sbasket-good-price"><?=$basketItem['PRICE'];?></span>&nbsp;

                            <?
                            if($basketItem['CURRENCY'] == 'RUB')
                            {
                                echo '<img src="' . SITE_TEMPLATE_PATH . '/images/icons/ruble.gif" class="ruble-icon"/>';
                            }
                            else if($basketItem['CURRENCY'] == 'USD')
                            {
                                echo '&#36;';
                            }
                            else if($basketItem['CURRENCY'] == 'UAH')
                            {
                                echo '&#8372;';
                            }
                            else
                            {
                                echo '&euro;';
                            }
                            ?>
                        </td>
                        <td class="sbasket-cell sbasket-cell-base"><?=$basketItem['DATE_INSERT'];?></td>
                    </tr>
                <?endforeach;?>
            </thead>
        </table>
    </section>
    <section class="order-section">
        <a href="/local/ajax/personal/execute-order.php?TOTAL_ORDER_PRICE=<?=$arResult['TOTAL_ORDER_PRICE'];?>" class="form-submit-button order-submit-button"><?=GetMessage('ORDER_GOODS_TITLE');?></a>
    </section>
<?else:?>
    <div class="empty-items-wrapper">
        <div class="empty-items-section">
            <div class="empty-items-icon" style="background-image: url(/local/components/my_context/sale.basket/templates/victormusiclibrary/images/icons/empty-cart.png);"></div>
            <span class="empty-items-text"><?=GetMessage('EMPTY_ITEMS_TITLE');?></span>
        </div>
    </div>
<?endif;?>
</div>