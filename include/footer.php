			<div id="foorer_main"></div>
		</div>

	  	<script type="text/javascript" src="/inventory/js/app_scanner.js"></script>

		<!-- Icons -->
		<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
		<script>
		  feather.replace()
		</script>
	
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

		<script type="text/javascript"> 
			$(window).on('load', function() 
			{
				<?require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/js/load.js');?>
			});

			$(document).ready(function (){
				<?require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/js/dataTables.php');?>
				<?require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/js/ready.js');?>
			});
		</script>
	</body>
</html>