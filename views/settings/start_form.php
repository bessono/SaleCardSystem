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
</div>

