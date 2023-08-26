@extends('admin.jnspengadaans.layout')

@section('jnspengadaans.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','jnspengadaans']) }}"> Jnspengadaans</a></li>
                <li class="breadcrumb-item">@lang('Edit Jnspengadaan') #{{$jnspengadaan->id}}</li>
            </ol>
        </div>
        <div class="card-body">
            <form action="{{ route('jnspengadaans.update', compact('jnspengadaan')) }}" method="POST" class="m-0 p-0">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{@old('name', $jnspengadaan->name)}}" required />
                        @if($errors->has('name'))
                        <div class='error small text-danger'>{{$errors->first('name')}}</div>
                        @endif
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <a href="{{ route('jnspengadaans.index', []) }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">@lang('Update Jnspengadaan')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection