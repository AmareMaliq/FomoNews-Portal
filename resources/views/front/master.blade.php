<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @stack('before-styles')
		<link href="{{ asset('output.css') }}" rel="stylesheet" />
		<link href="{{ asset('main.css') }}" rel="stylesheet" />
		@vite('resources/css/app.css')
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
		<!-- CSS -->
	
    @stack('after-styles')

	</head>

  @yield('content')
	<x-footer/>
  {{-- before itu buat link file atau link package buat ke semua halaman --}}
  @stack('before-scripts')
	<script src="{{ asset('customjs/sliderCategory.js') }}"></script>
   {{-- aafter itu buat link file atau link package buat ke halaman tertentu aja --}}
  @stack('after-scripts')
</html>