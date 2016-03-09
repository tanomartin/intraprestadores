<!DOCTYPE html>
<html>
<head>
<title>O.S.P.I.M. - Intranet Prestadores</title>
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width,initial-scale=1,maximum-scale=1" />
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link href='https://fonts.googleapis.com/css?family=Roboto:500,700'
	rel='stylesheet' type='text/css'>
<script type="text/javascript" src="include/js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="include/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="row" align="center">
			<form class="form-signin mg-btm">
				<h3 class="heading-desc">Recupero Contrase&ntilde;a</h3>
				<div class="main">
					<div class="input-group">
						<span class="input-group-addon"><i
							class="glyphicon glyphicon-user"></i></span> <input type="text"
							required="required" class="form-control" placeholder="Usuario">
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i
							class="glyphicon glyphicon-envelope"></i></span> <input
							type="password" class="form-control" required="required"
							placeholder="E-mail">
					</div>
					<div class="row">
						<div class="col-xs-8 col-md-8" style="text-align: left;">
							<button type="button" id="volver" class="btn btn-large pull-left">Volver</button>
						</div>
						<div class="col-xs-4 col-md-4 pull-right">
							<button type="submit" class="btn btn-large btn-success pull-right">Recuperar</button>
						</div>
					</div>
				</div>
				<span class="clearfix"></span>
			</form>
		</div>
	</div>
</body>
</html>

<script  type="text/javascript">
	$("#volver").click(function() {
		window.location.href = "index.php";
	});
</script>
