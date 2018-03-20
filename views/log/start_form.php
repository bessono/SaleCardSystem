<div class="panel" style="text-align:center; background-image: url('/images/background.png');">
	Просмотр ведомости
	<?php
	$elements = new elements();
	print $elements->select_years("year");
	print $elements->select_month("month");
	$bae = new BAEHTMLLib();
	print $bae->input("type='button' value='Просмотреть' onclick='getLogRecordByDate();'");	 
	 ?>	
	<div class="panel" id="container" style="margin-auto; text-align:center;">

	</div> 
</div>
