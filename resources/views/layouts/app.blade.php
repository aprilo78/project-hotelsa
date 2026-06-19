<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'DRG Hotel') — DRG Hotel</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stack('styles')
</head>
<body>
@include('components.navbar')

@if(session('success'))
    <div class="alert alert-success" style="margin:16px 24px;border-radius:8px">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger" style="margin:16px 24px;border-radius:8px">
        <ul style="margin:0;padding-left:18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

@yield('content')

@include('components.footer')
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>