@extends('admin.kategoris.layout')

@section('kategori.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','kategoris']) }}"> Kategori</a></li>
                <li class="breadcrumb-item">@lang('Edit Kategori') #{{$kategori->id}}</li>
            </ol>
        </div>
        <div class="card-body">
            <form action="{{ route('kategoris.update', compact('kategori')) }}" method="POST" class="m-0 p-0">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{@old('name', $kategori->name)}}" required />
                        @if($errors->has('name'))
                        <div class='error small text-danger'>{{$errors->first('name')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="masa_manfaat" class="form-label">Masa Manfaat:</label>
                        <input type="text" name="masa_manfaat" id="masa_manfaat" class="form-control" value="{{@old('masa_manfaat', $kategori->masa_manfaat)}}" required />
                        @if($errors->has('masa_manfaat'))
                        <div class='error small text-danger'>{{$errors->first('masa_manfaat')}}</div>
                        @endif
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <a href="{{ route('kategoris.index', []) }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">@lang('Update Kategori')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection