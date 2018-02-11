<!DOCTYPE HTML>
<meta charset="utf-8">
<title>BAE Framework</title>
<link rel="stylesheet" type="text/css" href="./styles/default.css"></link>
<script type="text/javascript" src="./js/jquery.js"></script>
<body>
<?php if((isset($_SESSION['login'])) && ($_SESSION['login'] == 1)){
	print "<a href='/?mode=main&method=exit'>Выход</a>";
} ?>
