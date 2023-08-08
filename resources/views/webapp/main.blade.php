@extends('webapp.layout')

@section('content')
    <div id="app" style="width: 100%; height: 100%;"></div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
    <script>
        window.initText = "{{ $text }}";
        window.initUser = {{ $user_id ?? 'null' }};
        window.initFingerprint = "{{ $fingerprint }}";
    </script>

@endpush
