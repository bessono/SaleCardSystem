<div class="panel" style="width:600px; margin:auto;">
<h3 style="text-align:center;">
Настройка программы
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
</h3>
</div>

