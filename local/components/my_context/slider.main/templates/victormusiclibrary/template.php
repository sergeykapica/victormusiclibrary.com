<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?if(isset($arParams['PHOTO_URL_LIST']) && !empty($arParams['PHOTO_URL_LIST'])):?>
    <div class="wrapper-slider">
        <?foreach($arParams['PHOTO_URL_LIST'] as $keyPhoto => $photo):?>
            <?if(( ( $keyPhoto + 1 ) % 3 ) == 1):?>
                <div style="z-index: <?=( ( $keyPhoto + 1 ) == 1 ? 2 : 1 );?>;" class="wrapper-slider-item fadeInLeft <?=( ( $keyPhoto + 1 ) == 1 ? 'slider-item-first' : '' );?>">
            <?elseif(( ( $keyPhoto + 1 ) % 3 ) == 2):?>
                <div style="z-index: 1;" class="wrapper-slider-item fadeIn">
            <?else:?>
                 <div style="z-index: 1;" class="wrapper-slider-item shiftToStart">
            <?endif;?>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-1"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-2"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-3"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-4"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-5"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-6"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-7"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-8"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-9"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-10"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-11"></div>

                <?/* 2 string */?>

                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-12"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-13"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-14"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-15"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-16"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-17"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-18"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-19"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-20"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-21"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-22"></div>

                <?/* 3 string */?>

                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-23"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-24"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-25"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-26"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-27"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-28"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-29"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-30"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-31"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-32"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-33"></div>

                <?/* 4 string */?>

                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-34"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-35"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-36"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-37"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-38"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-39"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-40"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-41"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-42"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-43"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-44"></div>

                <?/* 5 string */?>

                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-45"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-46"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-47"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-48"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-49"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-50"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-51"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-52"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-53"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-54"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-55"></div>

                <?/* 6 string */?>

                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-56"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-57"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-58"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-59"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-60"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-61"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-62"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-63"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-64"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-65"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-66"></div>

                <?/* 7 string */?>

                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-67"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-68"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-69"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-70"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-71"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-72"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-73"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-74"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-75"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-76"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-77"></div>

                <?/* 8 string */?>

                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-78"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-79"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-80"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-81"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-82"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-83"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-84"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-85"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-86"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment photo-segment-87"></div>
                <div style="background-image: url(<?=$photo;?>);" class="photo-segment element-end-animation photo-segment-88"></div>
            </div>
        <?endforeach;?>
    </div>
    <div class="slider-navigation-wrapper">
    <?foreach($arParams['PHOTO_URL_LIST'] as $keyPhoto => $photo):?>
        <nav data-slide-id="<?=$keyPhoto;?>" class="slider-navigation-item <?=( ( $keyPhoto + 1 ) == 1 ? 'navigation-item-active' : '' );?>"></nav>
    <?endforeach;?>
    </div>
<?endif;?>