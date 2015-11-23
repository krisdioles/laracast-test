<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link href="{{ asset('css/all.css') }}" media="all" rel="stylesheet" type="text/css" />
		<link rel='stylesheet' href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" />
	</head>

	<body>
		@include('partials.nav')

		<div class="container">
			@include('flash::message')

			@yield('content')
		</div>

		<script src="//code.jquery.com/jquery.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<script >
			$('#flash-overlay-modal').modal();
			//$('div.alert').not('.alert-important').delay(3000).slideUp(300);
		</script>

		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
		@yield('footer')
	</body>
</html>