@extends('layouts.pimpinan.appSimas')

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
                <h1 class="m-0">{{ __('Data Manajemen Aset') }}</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @yield('assets.content')
    </div>
</section>
@endsection

@section('script')

<!-- view data with currency format -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currencyElements = document.querySelectorAll('.currency');
        currencyElements.forEach(function(element) {
            const amount = parseFloat(element.textContent.replace(/\D/g, '')); // Mengambil angka dari teks
            const formattedAmount = numeral(amount).format('0,0'); // Format angka dengan Numeral.js
            element.textContent = 'Rp. ' + formattedAmount; // Tampilkan kembali ke elemen
        });
    });
</script>
@endsection