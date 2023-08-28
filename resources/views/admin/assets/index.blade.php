@extends('admin.assets.layout')

@section('assets.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                <li class="breadcrumb-item"><a href="{{ route('assets.index', compact([])) }}"> Assets</a></li>
            </ol>

            <form action="{{ route('assets.index', []) }}" method="GET" class="m-0 p-0">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm me-2" name="search" placeholder="Search Assets..." value="{{ request()->search }}">
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> @lang('Go!')</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped table-responsive table-hover">
                <thead role="rowgroup">
                    <tr role="row">
                        <th role='columnheader'>No</th>
                        <th role='columnheader'>Name</th>
                        <th role='columnheader'>Kategori</th>
                        <th role='columnheader'>Tgl Perolehan</th>
                        <th role='columnheader'>Nilai Perolehan</th>
                        <th role='columnheader'>Lokasi</th>
                        <th role='columnheader'>Jenis Aset</th>
                        <th role='columnheader'>Image</th>
                        <th scope="col" data-label="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach($assets as $asset)
                    <?php $no++; ?>
                    <tr>
                        <td data-label="Name">{{ $no }}</td>
                        <td data-label="Name">{{ $asset->name ?: "(blank)" }}</td>
                        <td data-label="Kategori">{{ optional($asset->category)->name ?: "N/A" }}</td>
                        <td data-label="Tgl Perolehan">{{ $asset->tgl_perolehan ? $asset->tgl_perolehan->format('Y-m-d') : '' }}</td>
                        <td data-label="Nilai Perolehan" class="currency">{{ $asset->nilai_perolehan ?: "(blank)" }}</td>
                        <td data-label="Lokasi">{{ optional($asset->location)->name ?: "N/A" }}</td>
                        <td data-label="Is Fixed Asset">{{ $asset->is_fixed_asset ? "Tetap" : "Tidak Tetap" }}</td>
                        <td data-label="Asset Image Path">
                            @if($asset->asset_image_path)
                            <img src="{{ asset('storage/asset_image_path/' . $asset->asset_image_path) }}" alt="{{ $asset->name }}" style="max-width: 100px; max-height: 100px;">
                            @else
                            <p>No Image Available</p>
                            @endif
                        </td>

                        <td data-label="Actions:" class="text-nowrap">
                            <a href="{{route('assets.show', compact('asset'))}}" type="button" class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('assets.edit', compact('asset'))}}">@lang('Edit')</a></li>
                                    <li>
                                        <form action="{{route('assets.destroy', compact('asset'))}}" method="POST" style="display: inline;" class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">@lang('Delete')</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $assets->withQueryString()->links() }}
        </div>
        <div class="text-center my-2">
            <a href="{{ route('assets.create', []) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('Create new Asset')</a>
        </div>
    </div>
</div>
@endsection