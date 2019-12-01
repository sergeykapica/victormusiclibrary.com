<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<h3><?=GetMessage('SELECT_PAYSYSTEMS_TITLE');?>:</h3>
<?if(isset($arResult['PAYSYSTEM_LIST']) && !empty($arResult['PAYSYSTEM_LIST']) || count($arResult['PAYSYSTEM_LIST']) == 1 && $arResult['PAYSYSTEM_LIST'][0]['CODE'] == 'INNER_PAYSYSTEM'):?>
    <div class="paysystems-wrapper">
        <ul class="paysystems-items">
            <?foreach($arResult['PAYSYSTEM_LIST'] as $paysystemKey => $paysystemValue):?>
                <?if($paysystemValue['CODE'] != 'INNER_PAYSYSTEM'):?>
                    <li class="paysystems-item">
                        <div class="custom-radio-wrapper">
                            <label class="custom-radio-label">
                               <input type="radio" name="SELECT_PAYSYSTEM" value="<?=$paysystemValue['CODE'];?>" <?=( $paysystemKey == 1 ? 'checked' : '' );?> class="custom-radio-input"/>
                               <div class="custom-radio-circle" title="<?=GetMessage('GENDER_MALE_TITLE');?>">
                                   <div class="radio-circle-inner"></div>
                               </div>
                             </label>
                        </div>
                        <?if($paysystemValue['CODE'] == 'YANDEX_MONEY'):?>
                            <div class="paysystems-item-group" style="border-color: #efa63d;">
                                <div class="paysystems-item-icon" style="background-color: #efa63d;"></div>
                                <span class="paysystems-item-name"><?=$paysystemValue['NAME'];?></span>
                            </div>
                        <?elseif($paysystemValue['CODE'] == 'PAYEER'):?>
                            <div class="paysystems-item-group" style="border-color: #3c9def;">
                                <div class="paysystems-item-icon" style="background-color: #3c9def;"></div>
                                <span class="paysystems-item-name"><?=$paysystemValue['NAME'];?></span>
                            </div>
                        <?elseif($paysystemValue['CODE'] == 'PAYPAL'):?>
                            <div class="paysystems-item-group" style="border-color: #115a98;">
                                <div class="paysystems-item-icon" style="background-color: #115a98;"></div>
                                <span class="paysystems-item-name"><?=$paysystemValue['NAME'];?></span>
                            </div>
                        <?endif;?>
                    </li>
                <?endif;?>
            <?endforeach;?>
        </ul>
    </div>
<?else:?>
    <div class="empty-items-wrapper">
        <div class="empty-items-section">
            <div class="empty-items-icon" style="background-image: url(/local/components/my_context/sale.basket/templates/victormusiclibrary/images/icons/empty-cart.png);"></div>
            <span class="empty-items-text"><?=GetMessage('EMPTY_ITEMS_TITLE');?></span>
        </div>
    </div>
<?endif;?>
