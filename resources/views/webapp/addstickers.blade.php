@extends('webapp.layout')

@section('content')
    <div id="app-addstickers" style="width: 100%; height: 100%;">
        Loading...
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        window.initData = @json($initData);
    </script>
    @vite(['resources/js/app.js'])
@endpush
