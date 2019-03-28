<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - 管理后台</title>
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}?version={{ time() }}">
</head>
<body>
<div id="app">
    后台
</div>
<script>window.Laravel = {'apiUrl':'{{ route('admin') }}'};</script>
<script src="{{ asset('backend/js/app.js') }}?version={{ time() }}"></script>
</body>
</html>