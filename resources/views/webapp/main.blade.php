@extends('webapp.layout')

@section('content')
    <div id="app" style="width: 100%; height: 100%;"></div>
@endsection

@push('scripts')
    <script type="text/javascript">
        window.initData = @json($initData);
    </script>
    @vite(['resources/js/app.js'])
@endpush
