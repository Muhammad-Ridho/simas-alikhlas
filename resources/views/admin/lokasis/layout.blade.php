@extends('layouts.appSimas')

@section('content')
@if ($errors->any())
<div class="container">
    <div class="alert alert-danger rounded-0">
        <ol class="py-0 my-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
</div>
@endif

@if (session('success') || session('error'))
<div class="container">
    <div class="alert alert-{{session('error') ? 'danger' : 'success'}} alert-dismissible fade show" role="alert">
        {{ session('success') ? : session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Data Lokasi') }}</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @yield('lokasi.content')
    </div>
</section>
@endsection