<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule('iblock'))
{
    // IBlock list
    
    $iBlockRequestList = CIBlock::GetList(array('ID' => 'DESC'));
    
    if($iBlockRequestList)
    {
        $iblockList = array();
        
        while($iblock = $iBlockRequestList->GetNext())
        {
            $iblockList[$iblock['ID']] = $iblock['NAME'];
        }
    }
    
    // IBlock section list
    
    $iBlockSectionsRequestList = CIBlockSection::GetList(array('ID' => 'DESC'), array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID']), false, array('ID, IBLOCK_ID, NAME'));
    
    if($iBlockSectionsRequestList)
    {
        $iBlockSectionList = array();
        
        while($iBlockSection = $iBlockSectionsRequestList->GetNext())
        {
            $iBlockSectionList[$iBlockSection['ID']] = $iBlockSection['NAME'];
        }
    }

    // IBlock field list
    
    $iBlockFields = array(
        'ACTIVE',
        'NAME',
        'TAGS',
        'PREVIEW_TEXT',
        'PREVIEW_PICTURE',
        'DETAIL_TEXT',
        'DETAIL_PICTURE',
        'CHECK_PERMISSIONS',
        'CATALOG_TYPE',
        'SORT',
        'DATE_CREATE',
        'SECTION_ID',
        'SECTION_CODE',
        'CATALOG_AVAILABLE',
        'CATALOG_CATALOG_GROUP_ID_N',
        'CATALOG_SHOP_QUANTITY_N',
        'CATALOG_QUANTITY',
        'CATALOG_WEIGHT',
        'CATALOG_STORE_AMOUNT_',
        'CATALOG_PRICE_SCALE_',
        'CATALOG_BUNDLE',
        'SHOW_COUNTER',
        'SHOW_COUNTER_START'

    );

    $arComponentParameters = array(
        "PARAMETERS" => array(
            'IBLOCK_ID' => array(
                'NAME' => GetMessage('IBLOCK_ID_TITLE'),
                'PARENT' => 'BASE',
                'TYPE' => 'LIST',
                'VALUES' => $iblockList,
                'REFRESH' => 'Y'
            ),

            'IBLOCK_SECTION_ID' => array(
                'NAME' => GetMessage('IBLOCK_SECTION_TITLE'),
                'PARENT' => 'BASE',
                'TYPE' => 'LIST',
                'VALUES' => $iBlockSectionList
            ),
            
            'IBLOCK_FIELDS' => array(
                'NAME' => GetMessage('IBLOCK_FIELDS_TITLE'),
                'PARENT' => 'BASE',
                'TYPE' => 'LIST',
                'VALUES' => $iBlockFields,
                'MULTIPLE' => 'Y'
            )
        )
    );
}
?>