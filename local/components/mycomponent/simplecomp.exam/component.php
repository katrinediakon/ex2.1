<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

if (!Loader::includeModule("iblock")) {
    ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
    return;
}

if (intval($arParams["CAT_IBLOCK_ID"]) > 0 && intval($arParams["CLASSIFIER_IBLOCK_ID"]) > 0 && !empty($arParams["KOD"])) {
   if ($this->StartResultCache()) {
        $arFilter = Array('IBLOCK_ID' => $arParams["CLASSIFIER_IBLOCK_ID"], 'GLOBAL_ACTIVE' => 'Y');
        $db_list = CIBlockSection::GetList(Array($by => $order), $arFilter, true);
        while ($ar_result = $db_list->GetNext()) {
            $arResult['ITEM'][$ar_result['ID']]['NAME'] = $ar_result['NAME'];
        }

        $section = array();
        $SectList = CIBlockSection::GetList($arSort, array("IBLOCK_ID" => $arParams["CAT_IBLOCK_ID"], "ACTIVE" => "Y"), false, array("ID", $arParams["KOD"], 'NAME'));
        while ($SectListGet = $SectList->GetNext()) {
            $arResult['ITEM'][$SectListGet[$arParams["KOD"]][0]]["SECTION"][$SectListGet['ID']] = $SectListGet['NAME'];
            $section[] = $SectListGet['ID'];
        }

        $arSelect = Array("ID", "NAME", "PROPERTY_PRICE", "PROPERTY_ARTNUMBER", "PROPERTY_MATERIAL", 'IBLOCK_SECTION_ID');
        $arFilter = Array("IBLOCK_ID" => $arParams["CAT_IBLOCK_ID"], 'IBLOCK_SECTION_ID' => $section, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNext()) {
            foreach ($arResult['ITEM'] as $key => $value) {
                if(empty($arResult['MIN']) && empty($arResult['MAX'])) {
                    $arResult['MIN'] = $arResult['MAX'] = $ob['PROPERTY_PRICE_VALUE'];
                }
                elseif($arResult['MIN'] > $ob['PROPERTY_PRICE_VALUE']) {
                    $arResult['MIN'] = $ob['PROPERTY_PRICE_VALUE'];
                }
                elseif($arResult['MAX'] < $ob['PROPERTY_PRICE_VALUE']) {
                   $arResult['MAX'] = $ob['PROPERTY_PRICE_VALUE'];
                }
                if ($value["SECTION"][$ob['IBLOCK_SECTION_ID']]) {
                    $arResult['ITEM'][$key]['ELEM'][] = $ob;
                }
            }
        }
        $arResult['COUNT'] = count($arResult['ITEM']);
       $this->SetResultCacheKeys(array('COUNT', 'MAX', 'MIN'));
        $this->includeComponentTemplate();
    }
    $APPLICATION->SetTitle(GetMessage("COUNT") . $arResult['COUNT']);
    $APPLICATION->SetPageProperty("MAX_MIN", "Максимальная цена: ". $arResult['MAX'] . "</br>Минимальная цена: " . $arResult['MIN']);
}

?>