<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/validator-styles.css');
?>

<?if(!isset($arParams['FILTER_VALUE'])):?>
<div class="sbasket-wrapper">
    <?if(isset($arResult['BASKET_ITEMS']) && !empty($arResult['BASKET_ITEMS'])):?>
        <div class="sbasket-wrapper-blocks sbasket-header">
            <div class="sbasket-header-blocks sbasket-filter-wrapper">
                <input type="text" name="SEARCH_VALUE" class="filter-input" autocomplete="off"/>
            </div>
            <div class="sbasket-header-blocks sbasket-data-wrapper">
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
                <a href="/personal/order" class="form-submit-button"><?=GetMessage('TO_ORDER_TITLE');?></a>
            </div>
        </div>
    <?endif;?>
<?endif;?>
    <div class="sbasket-wrapper-blocks sbasket-content">
        <?if(isset($arResult['BASKET_ITEMS']) && !empty($arResult['BASKET_ITEMS'])):?>
            <table id="sbasket-table">
                <thead>
                    <tr class="sbasket-header-string">
                        <th class="sbasket-cell">
                            <div class="custom-checkbox-placeholder"></div>
                        </th>
                        <th class="sbasket-cell">Фото</th>
                        <th class="sbasket-cell sbasket-cell-base">Название</th>
                        <th class="sbasket-cell sbasket-cell-base">Цена</th>
                        <th class="sbasket-cell sbasket-cell-base">Дата добавления</th>
                    </tr>
                    <?foreach($arResult['BASKET_ITEMS'] as $basketItem):?>
                        <tr data-good-id="<?=$basketItem['ID'];?>" class="sbasket-content-string">
                            <td class="sbasket-cell">
                                <div class="custom-checkbox-wrapper">
                                    <label class="custom-checkbox-label">
                                        <input type="checkbox" name="SELECT_BASKET_ITEM" class="custom-checkbox-input basket-item-checkbox"/>
                                        <div class="custom-checkbox"></div>
                                    </label>
                                </div>
                            </td>
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
            <div class="pagination-wrapper basket-pagination">
                <button type="button" class="form-submit-button delete-good-button"><?=GetMessage('DELETE_BASKET_ITEM');?></button>
                <?=$arResult['BASKET_ITEM_PAGINATION'];?>
            </div>
        <?else:?>
            <div class="empty-items-wrapper">
                <div class="empty-items-section">
                    <div class="empty-items-icon" style="background-image: url(/local/components/my_context/sale.basket/templates/victormusiclibrary/images/icons/empty-cart.png);"></div>
                    <span class="empty-items-text"><?=GetMessage('EMPTY_ITEMS_TITLE');?></span>
                </div>
            </div>
        <?endif;?>
    </div>
    
    <?if(!isset($arParams['FILTER_VALUE'])):?>
        <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/input-placeholder.js"></script>
    <?endif;?>
    
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/other-functions.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/shop-methods.js"></script>
    
    <script type="text/javascript">
        $(window).ready(function()
        {
            let deleteGoodButton = $('.delete-good-button');
            
            deleteGoodButton.on('click', function()
            {
                var thisButton = $(this);
                thisButton.parent().find('.answer-error').remove();
                var basketItemCheckbox = $('.basket-item-checkbox');
                
                if(oOtherFunctions.checkSelectCheckbox(basketItemCheckbox) === false)
                {
                    let messageElement =
                    `
                    <div class="answer-error" style="top: ` + thisButton[0].offsetHeight + `px;">
                        <span><?=GetMessage('SELECT_ANY_CHECKBOX');?></span>
                        <div class="answer-error-rectangle"><div class="answer-error-rectangle2"></div></div>
                    </div>
                    `;
                    
                    thisButton.after(messageElement);
                }
                else
                {
                    var itemsIDsToDelete = [];
                    
                    basketItemCheckbox.each(function(i)
                    {
                        if(basketItemCheckbox.eq(i).prop('checked'))
                        {
                            let currentString = oOtherFunctions.findParentFromChildren(basketItemCheckbox.eq(i), $('.sbasket-content-string'));
                            itemsIDsToDelete.push(currentString.attr('data-good-id'));
                        }
                    });
                    
                    let data = 'GOODS_IDS=' + JSON.stringify(itemsIDsToDelete);
                    
                    $.ajax({
                        url: '/local/ajax/personal/remove-goods-from-basket.php',
                        method: 'POST',
                        data: data,
                        success: function(res)
                        {
                            if(res != false)
                            {
                                for(var d in itemsIDsToDelete)
                                {
                                    let currentTableString = $('.sbasket-content-string[data-good-id=' + itemsIDsToDelete[d] + ']');
                                    
                                    if(currentTableString[0] !== undefined)
                                    {
                                        currentTableString.remove();
                                    }
                                }
                                
                                if($('.sbasket-content-string').length <= 0)
                                {
                                    let emptyItemsMessage =
                                    `
                                    <div class="empty-items-wrapper">
                                        <div class="empty-items-section">
                                            <div class="empty-items-icon" style="background-image: url(/local/components/my_context/sale.basket/templates/victormusiclibrary/images/icons/empty-cart.png);"></div>
                                            <span class="empty-items-text"><?=GetMessage('EMPTY_ITEMS_TITLE');?></span>
                                        </div>
                                    </div>
                                    `;
                                    
                                    $('.sbasket-content').html(emptyItemsMessage);
                                    
                                    shopMethods.changePrice(0, $('#total-amount'));
                                }
                                else
                                {
                                    shopMethods.changePrice($('.sbasket-good-price'), $('#total-amount'));
                                }
                            }
                        }
                    });
                }
            });
            
            <?if(!isset($arParams['FILTER_VALUE'])):?>
            
                let filterInput = $('.filter-input');

                setPlaceholderToInput(filterInput, '<?=GetMessage("SEARCH_VALUE");?>', 'rgba(94, 94, 94, 0.4)');
            
                filterInput.on('input', function()
                {
                    let thisInput = $(this);

                    $.ajax({
                        url: '/local/ajax/personal/search-good-from-basket.php?SEARCH_VALUE=' + thisInput.val(),
                        method: 'GET',
                        success: function(res)
                        {
                            if(res != false)
                            {
                                let sbasketContent = $('.sbasket-content');
                                sbasketContent.replaceWith(res);
                            }
                        }
                    });
                });
            <?endif;?>
        });
    </script>
    
<?if(!isset($arParams['FILTER_VALUE'])):?>
</div>
<?endif;?>
