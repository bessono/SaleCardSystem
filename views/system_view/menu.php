<div style='margin:auto; text-align:center; margin-top:20px; margin-bottom:20px;'>
<?php
if((isset($_SESSION['login'])) && ($_SESSION['login'] == 1)){
	print "<a href='/' class='menu_link'>Работа с клиентом</a>";
	if($_SESSION['level'] == "admin") {
	print "<a href='/?mode=settings' class='menu_link'>Настройки</a>";
	print "<a href='/?mode=log' class='menu_link'>Ведомость</a>";
	}
	print "<a href='/?mode=main&method=log_out' class='menu_link'>Выход</a>";
} ?>
</div>

