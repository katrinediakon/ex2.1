<?
//Обработчик в файле /bitrix/php_interface/init.php
AddEventHandler("main", "OnBeforeEventAdd", array("MyClass", "OnBeforeEventAddHandler"));
class MyClass
{
    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if ($event == 'FEEDBACK_FORM') {
            global $USER;
            if($USER->GetID()) {
                CEventLog::Add(array(
                    "SEVERITY" => "FEEDBACK_FORM",
                    "AUDIT_TYPE_ID" => "FEEDBACK_FORM",
                    "MODULE_ID" => "main",
                    "ITEM_ID" => 123,
                    "DESCRIPTION" => "Замена данных в отсылаемом письме – " . $arFields['AUTHOR'] ,
                ));
                $arFields['AUTHOR'] = "Пользователь авторизован: $USER->GetID() ($USER->GetLogin()) $USER->GetFullName, данные из формы:." . $arFields['AUTHOR'] ;
            } else {
                $arFields['AUTHOR'] = "Пользователь не авторизован, данные из формы:." . $arFields['AUTHOR'] ;
            }
        }
    }
}
?>