<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="/inventory/favicon.ico">

		<title>Inventory CMS</title>

		<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">
		<!-- Bootstrap core CSS -->
		<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="https://getbootstrap.com/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="/inventory/js/dataTables/jquery.dataTables.min.js"></script>
		<!--<script src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>-->
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>
		<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

		<script src="<? $var = "/inventory/js/main.js"; echo $var. "?s=" . filesize($_SERVER['DOCUMENT_ROOT'] .$var);  ?>"></script>
		<link rel="stylesheet" type="text/css" href="/inventory/css/DataTables/site.css?_=b05357026107a2e3ca397f642d976192">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
			<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
		<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
		<script src="https://kit.fontawesome.com/bfe8c28d02.js" crossorigin="anonymous"></script>
		<script src="<? $var = "/inventory/js/cf_api_1.0.20201101.js"; echo $var. "?s=" . filesize($_SERVER['DOCUMENT_ROOT'] .$var);  ?>"></script>
		<link rel="stylesheet" href="<? $var = "/inventory/css/main.css"; echo $var. "?s=" . filesize($_SERVER['DOCUMENT_ROOT'] .$var);  ?>">
		 <link rel="stylesheet" href="<? $var = "/inventory/css/app_scanner.css"; echo $var. "?s=" . filesize($_SERVER['DOCUMENT_ROOT'] .$var);  ?>">
	</head>
	<body>
		<div id="loading">
			<img id="loading-image" src="https://i.gifer.com/CVyf.gif" alt="Loading...">
		</div>
		<div id="loading_min" style="display: none;">
			<img id="loading-image" src="https://i.gifer.com/CVyf.gif" alt="Loading...">
		</div>
		<div id="main_content">
			<div id="spoverlay"></div>
				<div class="container-fluid">
					<div class="row">