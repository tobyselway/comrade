@extends('layouts.app')

@section('title')
    Loading {{ config('app.branding', '') }} {{ config('app.name', 'Comrade') }}...
@endsection

@section('content')
    <App></App>
@endsection
