<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>

<? foreach ( $arResult['ITEM'] as $key => $value): ?>
    <ul>
      <li>  <?=$value['NAME']?>
        <?$str = '('?>
       <? foreach ( $value['SECTION'] as $key => $value_SEC): ?>
            <?$str .= $value_SEC .','?>
        <?endforeach?>
        <?=substr($str, 0, -1) . ')'?>
          <ul>
              <? foreach ( $value['ELEM'] as $key => $value_EL): ?>
                 <li><?=$value_EL['NAME']?> - <?=$value_EL['PROPERTY_PRICE_VALUE']?> - <?=$value_EL['PROPERTY_ARTNUMBER_VALUE']?> - <?=$value_EL['PROPERTY_MATERIAL_VALUE']?></li>


              <?endforeach?>
          </ul>
      </li>
    </ul>
<?endforeach?>


