@extends('admin.transactions.layout')

@section('transactions.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','transactions']) }}"> Transactions</a></li>
                <li class="breadcrumb-item">@lang('Create new')</li>
            </ol>
        </div>

        <div class="card-body">
            <form action="{{ route('transactions.store', []) }}" method="POST" class="m-0 p-0">
                <div class="card-body">
                    @csrf
                    <div class="mb-3">
                        <label for="asset_id" class="form-label">Asset:</label>
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <select name="asset_id" id="asset_id" class="form-control form-select flex-grow-1" required>
                                <option value="">Select Asset</option>
                                @foreach($assets as $asset)
                                <option value="{{ $asset->id }}" {{ @old('asset_id') == $asset->id ? "selected" : "" }}>{{ $asset->name }}</option>
                                @endforeach
                            </select>

                            <a class="btn btn-light text-nowrap" href="{{route('assets.create', compact([]))}}"><i class="fa fa-plus-circle"></i> New</a>
                        </div>
                        @if($errors->has('asset_id'))
                        <div class='error small text-danger'>{{$errors->first('asset_id')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="tgl_transaksi" class="form-label">Tgl Transaksi:</label>
                        <input type="date" name="tgl_transaksi" id="tgl_transaksi" class="form-control" required />
                        @if($errors->has('tgl_transaksi'))
                        <div class='error small text-danger'>{{$errors->first('tgl_transaksi')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="jns_transaksi" class="form-label">Jns Transaksi:</label>
                        <select name="jns_transaksi" id="jns_transaksi" class="form-control form-select" required>
                            <option value="">Select Jns Transaksi</option>
                            @foreach(["perbaikan" => "Perbaikan", "pemeliharaan" => "Pemeliharaan", "penambahan nilai aset" => "Penambahan Nilai Aset"] as $value => $label )
                            <option value="{{ $value }}" {{ @old('jns_transaksi') == $value ? "selected" : "" }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('jns_transaksi'))
                        <div class='error small text-danger'>{{$errors->first('jns_transaksi')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nilai_transaksi" class="form-label">Nilai Transaksi:</label>
                        <input type="number" name="nilai_transaksi" id="nilai_transaksi" class="form-control" value="{{@old('nilai_transaksi')}}" required />
                        @if($errors->has('nilai_transaksi'))
                        <div class='error small text-danger'>{{$errors->first('nilai_transaksi')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan:</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" required>{{@old('keterangan')}}</textarea>
                        @if($errors->has('keterangan'))
                        <div class='error small text-danger'>{{$errors->first('keterangan')}}</div>
                        @endif
                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <a href="{{ route('transactions.index', []) }}" class="btn btn-light">@lang('Cancel')</a>
                        <button type="submit" class="btn btn-primary">@lang('Create new Transaction')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // sett tanggal laporan
    document.addEventListener("DOMContentLoaded", function() {
        const reportDateInput = document.getElementById("tgl_transaksi");
        const today = new Date();
        const formattedDate = formatDate(today);

        reportDateInput.value = formattedDate;
    });

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, "0");
        const day = String(date.getDate()).padStart(2, "0");
        return `${year}-${month}-${day}`;
    }
</script>
@endsection