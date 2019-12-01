<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?if($arParams['EXECUTED_ORDER_STATUS'] == 'SUCCESS'):?>
    <div class="order-result-message" id="order-result-success"><?=GetMessage('ORDER_RESULT_STATUS_SUCCESS');?></div>
    <div class="order-result-message" id="order-result-files">
        <?if(isset($arResult['GOODS_LIST']) && !empty($arResult['GOODS_LIST'])):?>
            <div id="oresult-files-wrapper">
                <h3><?=GetMessage('ORDER_RESULT_FILES_LIST');?>:</h3>
                <ul class="oresult-files-list">
                    <?foreach($arResult['GOODS_LIST'] as $good):?>
                        <ol class="oresult-files-item">
                            <span><?=$good['NAME'];?></span>&nbsp;
                            <a href="/personal/order/download/<?=$good['PROPERTY_FULL_SOUND_VALUE'];?>" class="oresult-file-url">Скачать</a>
                        </ol>
                    <?endforeach;?>
                </ul>
            </div>
        <?endif;?>
    </div>
<?elseif($arParams['EXECUTED_ORDER_STATUS'] == 'NOT_MONEY'):?>
    <div class="order-result-message" id="order-result-failed"><?=GetMessage('ORDER_RESULT_STATUS_NOT_MONEY');?></div>
<?else:?>
    <div class="order-result-message" id="order-result-failed"><?=GetMessage('ORDER_RESULT_STATUS_FAILED');?></div>
<?endif;?>