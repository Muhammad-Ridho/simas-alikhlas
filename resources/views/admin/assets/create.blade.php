@extends('admin.assets.layout')

@section('assets.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('assets.index', compact([])) }}"> Assets</a></li>
                <li class="breadcrumb-item">@lang('Create new')</li>
            </ol>
        </div>

        <div class="card-body">
            <form action="{{ route('assets.store', []) }}" method="POST" class="m-0 p-0">
                <div class="card-body">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{@old('name')}}" required />
                        @if($errors->has('name'))
                        <div class='error small text-danger'>{{$errors->first('name')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi:</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{@old('deskripsi')}}</textarea>
                        @if($errors->has('deskripsi'))
                        <div class='error small text-danger'>{{$errors->first('deskripsi')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori:</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('kategori_id'))
                        <div class='error small text-danger'>{{$errors->first('kategori_id')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="jns_pengadaan_id" class="form-label">Jenis Pengadaan:</label>
                        <select name="jns_pengadaan_id" id="jns_pengadaan_id" class="form-control">
                            <option value="">Pilih Jenis Pengadaan</option>
                            @foreach ($procurementTypes as $jnsPengadaan)
                            <option value="{{ $jnsPengadaan->id }}">{{ $jnsPengadaan->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('jns_pengadaan_id'))
                        <div class='error small text-danger'>{{$errors->first('jns_pengadaan_id')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="tgl_perolehan" class="form-label">Tgl Perolehan:</label>
                        <input type="date" name="tgl_perolehan" id="tgl_perolehan" class="form-control" value="{{@old('tgl_perolehan')}}" required />
                        @if($errors->has('tgl_perolehan'))
                        <div class='error small text-danger'>{{$errors->first('tgl_perolehan')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nilai_perolehan" class="form-label">Nilai Perolehan:</label>
                        <input type="number" name="nilai_perolehan" id="nilai_perolehan" class="form-control" value="{{@old('nilai_perolehan')}}" placeholder="Rp." required />
                        @if($errors->has('nilai_perolehan'))
                        <div class='error small text-danger'>{{$errors->first('nilai_perolehan')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="lokasi_id" class="form-label">Lokasi:</label>
                        <select name="lokasi_id" id="lokasi_id" class="form-control">
                            <option value="">Pilih Lokasi</option>
                            @foreach ($locations as $lokasi)
                            <option value="{{ $lokasi->id }}">{{ $lokasi->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('lokasi_id'))
                        <div class='error small text-danger'>{{$errors->first('lokasi_id')}}</div>
                        @endif
                    </div>
                    <!-- <div class="mb-3">
                        <label for="assigned_to_user_id" class="form-label">Assigned To User:</label>
                        <input type="number" name="assigned_to_user_id" id="assigned_to_user_id" class="form-control" value="{{@old('assigned_to_user_id')}}" />
                        @if($errors->has('assigned_to_user_id'))
                        <div class='error small text-danger'>{{$errors->first('assigned_to_user_id')}}</div>
                        @endif
                    </div> -->
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department:</label>
                        <select name="department_id" id="department_id" class="form-control">
                            <option value="">Pilih Department</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('department_id'))
                        <div class='error small text-danger'>{{$errors->first('department_id')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="is_fixed_asset" class="form-label">Jenis Aset:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_fixed_asset" id="is_fixed_asset_yes" value="1" {{ @old('is_fixed_asset') == '1' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="inlineRadio1">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_fixed_asset" id="is_fixed_asset_no" value="0" {{ @old('is_fixed_asset') == '0' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="inlineRadio2">Tidak Aktif</label>
                            </div>
                        </div>
                        @if($errors->has('is_fixed_asset'))
                        <div class='error small text-danger'>{{$errors->first('is_fixed_asset')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="asset_image_path" class="form-label">Image:</label>
                        <input type="file" name="asset_image_path" id="asset_image_path" class="form-control" value="{{@old('asset_image_path')}}" accept="image/*"/>
                        @if($errors->has('asset_image_path'))
                            <div class='error small text-danger'>{{$errors->first('asset_image_path')}}</div>
                        @endif
                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <a href="{{ route('assets.index', []) }}" class="btn btn-light">@lang('Cancel')</a>
                        <button type="submit" class="btn btn-primary">@lang('Create new Asset')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection