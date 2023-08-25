@extends('admin.lokasis.layout')

@section('lokasi.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','lokasis']) }}"> Lokasi</a></li>
                <li class="breadcrumb-item">@lang('Edit Lokasi') #{{$lokasi->id}}</li>
            </ol>
        </div>
        <div class="card-body">
            <form action="{{ route('lokasis.update', compact('lokasi')) }}" method="POST" class="m-0 p-0">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{@old('name', $lokasi->name)}}" required />
                        @if($errors->has('name'))
                        <div class='error small text-danger'>{{$errors->first('name')}}</div>
                        @endif
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <a href="{{ route('lokasis.index', []) }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">@lang('Update Lokasi')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection