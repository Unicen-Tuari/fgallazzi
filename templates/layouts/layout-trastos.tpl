<!DOCTYPE html>
<html lang="es">
<head>
	<title>{$title}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <!-- CSS Clases Adaptas de Bootstrap -->
    <link href="css/bootstrap-trastos.css" rel="stylesheet" media="screen">
    {block name=head} {/block}
</head>
<body>

	{include file="nav-bar$pathUser/navbar.tpl"}


	{block name=body}{/block}


	<!-- Libreria JQuery -->
	<script type="text/javascript" src = "js/jquery-2.1.1.min.js"></script>
	
	<!-- Libreria Bootstrap -->
	<script type="text/javascript" src = "js/bootstrap.min.js"></script>
	
	{block name=scriptJS}{/block}

</body>
</html>