<div class="panel" style="width:600px; margin:auto; background-image: url('/images/background.png');">
<h3 style="text-align:center;">
Настройка программы
</h3>
<br>
<fieldset><legend>Настройка PIN кодов</legend>
<table>
<tr>
<td>PIN-код рядового сотрудника:</td>
<td><input type="text" id="pin_manager" value="<?php print $this->view_data['pins']['manager']; ?>"></td>
</tr>
<tr>
<td>PIN-код руководства:</td>
<td><input type="text" id="pin_admin" value="<?php print $this->view_data['pins']['admin']; ?>"></td>
</tr>
</table>
<input type="button" style="margin:auto" onclick="update_pins();" value="Сохранить PIN коды">
</fieldset>
<br>
<fieldset style="margin-top:30px;"><legend>Настройка бонусов</legend>
<table>
<tr>
<td>Укажите процент начисления бонуса <br>от сммы покупки</td>
<td><input type="text" style="width:40px;" id="bonus_percent" value='<?php print $this->view_data['settings']['bonus_percent'] ?>'>%</td>	
</tr>
</table>
<input type="button" value="Сохранить процент" onclick='updateBonusPercent();'>
</fieldset>
<fieldset>
<legend>Настройка типа начисления дисконтного процента</legend>
<span style="margin:auto;">При изменении типа досконтный процент и бонусы сохраняются</span>
<table>
<tr>
<td>
Система парога покупки: Начисление дисконтного процента производится в зависиммости от суммы <b>покупки</b>.<br>
3000р. = 2%<br>
6000р. = 3%<br>
9000р. = 5%<br>
</td>
<td>
<input type="radio" id="percent_system_old" name="percent_system" value="old" <?php if($view_data['settings']['percent_system'] == "old") print "checked=\"check\""; ?>>
</td>
</tr>
<tr>
<td>Система по увеличению пожизненого процента на карточке, согласно порогу <b>общей</b> суммы покупки:</td>
<td><br><input type="radio" id="percent_system_new" name="percent_system" value="new" <?php if($view_data['settings']['percent_system'] == "new") print "checked=\"check\""; ?>><br><br>
Укажите порог:<input type="text" id="percent_step" value="<?php print $this->view_data['settings']['percent_step']; ?>">р.
</td>
</tr>
</table>
<input type="button" value="Сохранить" onclick="setPercentSystem();">
</fieldset>
</div>

