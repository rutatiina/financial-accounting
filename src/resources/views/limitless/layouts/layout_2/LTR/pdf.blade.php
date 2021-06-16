<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>

	<base href="{{ url('template/limitless/layout_2/LTR/default') }}/">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Global stylesheets -->
	{{--<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">--}}
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

	<link href="assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<link href="rutatiina/styles.css" rel="stylesheet" type="text/css">



	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<script>
        var rg_decimal_places = 2;
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
        var APP_URL = "{{url('/')}}";
        var TENANT_ID = "{{optional($tenant)->id}}";
	</script>



</head>

<body class="navbar-top @yield('bodyClass')">



	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Secondary sidebar -->
			@yield('sidebar_secondary')
			<!-- /secondary sidebar -->


			<!-- Main content -->
			@yield('content')
			<!-- /main content -->

			<!-- Opposite sidebar -->
			@yield('sidebar_opposite')
			<!-- /opposite sidebar -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	{{--<div action="/import" class="dropzone" id="rg-dropzone" style="display:none;"></div><!-- used for items and contactas packages -->--}}

	<style>
		@media (min-width: 480px) {
			.navbar-form.navbar-left {
				width: 35%;
			}
		}

        @media (min-width: 769px) {
            .sidebar-xs .header-highlight .navbar-header .navbar-brand {
                background: url(/timthumb.php?src=/logo-white.png&w=35&h=35&zc=2) no-repeat center center;
            }
        }
    </style>
    @yield('javascript')

</body>
</html>
