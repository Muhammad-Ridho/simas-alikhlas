@extends('admin.assets.layout')

@section('assets.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('assets.index', compact([])) }}"> Assets</a></li>
                <li class="breadcrumb-item">@lang('Asset') #{{$asset->id}}</li>
            </ol>

            <a href="{{ route('assets.index', []) }}" class="btn btn-light"><i class="fa fa-caret-left"></i> Back</a>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">ID:</th>
                        <td>{{$asset->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Name:</th>
                        <td>{{ $asset->name ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Deskripsi:</th>
                        <td>{{ Str::limit($asset->deskripsi, 50) ?: "(blank)"}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Kategori:</th>
                        <td>{{ $asset->category->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jns Pengadaan:</th>
                        <td>{{ $asset->jnsPengadaan->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tgl Perolehan:</th>
                        <td>{{ $asset->tgl_perolehan ? $asset->tgl_perolehan->format('Y-m-d') : '' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nilai Perolehan:</th>
                        <td class="currency">{{ $asset->nilai_perolehan ?: "(blank)" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Lokasi:</th>
                        <td>{{ $asset->location->name }}</td>
                    </tr>
                    <!-- <tr>
                        <th scope="row">Assigned To User:</th>
                        <td>{{ $asset->assigned_to_user_id ?: "(blank)" }}</td>
                    </tr> -->
                    <tr>
                        <th scope="row">Department:</th>
                        <td>{{ $asset->department->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jenis Aset:</th>
                        <td>{{ $asset->is_fixed_asset ? "Tetap" : "Tidak Tetap" }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Asset Image Path:</th>
                        <td>
                            @if($asset->asset_image_path)
                            <img src="{{ asset('storage/asset_image_path/' . $asset->asset_image_path) }}" alt="{{ $asset->name }}" style="max-width: 200px; max-height: 200px;">
                            @else
                            <p>No Image Available</p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="card-footer d-flex flex-column flex-md-row align-items-center justify-content-end">
            <a href="{{ route('assets.edit', compact('asset')) }}" class="btn btn-info text-nowrap me-1"><i class="fa fa-edit"></i> @lang('Edit')</a>
            <form action="{{ route('assets.destroy', compact('asset')) }}" method="POST" class="m-0 p-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger text-nowrap"><i class="fa fa-trash"></i> @lang('Delete')</button>
            </form>
        </div>
    </div>
</div>
@endsection