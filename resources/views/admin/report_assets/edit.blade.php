@extends('admin.report_assets.layout')

@section('reportAssets.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','report_assets']) }}"> Report Assets</a></li>
                <li class="breadcrumb-item">@lang('Edit Report Asset') #{{$reportAsset->id}}</li>
            </ol>
        </div>
        <div class="card-body">
            <form action="{{ route('report_assets.update', compact('reportAsset')) }}" method="POST" class="m-0 p-0">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{@old('name', $reportAsset->name)}}" required />
                        @if($errors->has('name'))
                        <div class='error small text-danger'>{{$errors->first('name')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="asset_id" class="form-label">Asset:</label>
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <select name="asset_id" id="asset_id" class="form-control form-select flex-grow-1" required>
                                <option value="">Select Asset</option>
                                @foreach($assets as $asset)
                                <option value="{{ $asset->id }}" {{ @old('asset_id', $reportAsset->asset_id) == $asset->id ? "selected" : "" }}>{{ $asset->name }}</option>
                                @endforeach
                            </select>

                            <a class="btn btn-light text-nowrap" href="{{route('assets.create', compact([]))}}"><i class="fa fa-plus-circle"></i> New</a>
                        </div>
                        @if($errors->has('asset_id'))
                        <div class='error small text-danger'>{{$errors->first('asset_id')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_laporan" class="form-label">Tanggal Laporan:</label>
                        <input type="date" name="tanggal_laporan" id="tanggal_laporan" class="form-control" value="{{@old('tanggal_laporan', $reportAsset->tanggal_laporan)}}" required />
                        @if($errors->has('tanggal_laporan'))
                        <div class='error small text-danger'>{{$errors->first('tanggal_laporan')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nilai_perolehan" class="form-label">Nilai Perolehan:</label>
                        <input type="number" name="nilai_perolehan" id="nilai_perolehan" class="form-control" value="{{@old('nilai_perolehan', $reportAsset->nilai_perolehan)}}" required />
                        @if($errors->has('nilai_perolehan'))
                        <div class='error small text-danger'>{{$errors->first('nilai_perolehan')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="umur_aset" class="form-label">Umur Aset:</label>
                        <input type="number" name="umur_aset" id="umur_aset" class="form-control" value="{{@old('umur_aset', $reportAsset->umur_aset)}}" required />
                        @if($errors->has('umur_aset'))
                        <div class='error small text-danger'>{{$errors->first('umur_aset')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="penyusutan_per_tahun" class="form-label">Penyusutan Per Tahun:</label>
                        <input type="number" name="penyusutan_per_tahun" id="penyusutan_per_tahun" class="form-control" value="{{@old('penyusutan_per_tahun', $reportAsset->penyusutan_per_tahun)}}" required />
                        @if($errors->has('penyusutan_per_tahun'))
                        <div class='error small text-danger'>{{$errors->first('penyusutan_per_tahun')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nilai_saat_ini" class="form-label">Nilai Saat Ini:</label>
                        <input type="number" name="nilai_saat_ini" id="nilai_saat_ini" class="form-control" value="{{@old('nilai_saat_ini', $reportAsset->nilai_saat_ini)}}" required />
                        @if($errors->has('nilai_saat_ini'))
                        <div class='error small text-danger'>{{$errors->first('nilai_saat_ini')}}</div>
                        @endif
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <a href="{{ route('report_assets.index', []) }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">@lang('Update Report Asset')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection