<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if(CModule::IncludeModule('sale'))
{
    class CSaleUserAccountAdditionalMethods extends CSaleUserAccount {

        const SITE_CODE = 's1';

        public static function getCurrentBill()
        {
            global $USER;

            $userData = self::GetByUserID($USER->GetID(), CSaleLang::GetLangCurrency(self::SITE_CODE));

            if($userData)
            {
                return $userData;
            }
            else
            {
                return false;
            }
        }
        
        public static function setCurrentBill($newPrice)
        {
            global $USER;
            
            $basketAccountData = self::GetByUserID($USER->GetID(), CSaleLang::GetLangCurrency(self::SITE_CODE));
            
            if($basketAccountData)
            {
                $userFields = array(
                    'CURRENT_BUDGET' => $newPrice
                );

                if(self::Update($basketAccountData['ID'], $userFields))
                {
                    return true;
                }
            }
        }
    }
}
?>