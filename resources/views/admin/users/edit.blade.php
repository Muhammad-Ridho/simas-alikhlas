@extends('admin.users.layout')

@section('users.content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{ implode('/', ['','users']) }}"> Users</a></li>
                <li class="breadcrumb-item">@lang('Edit User') #{{$user->id}}</li>
            </ol>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', compact('user')) }}" method="POST" class="m-0 p-0">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{@old('name', $user->name)}}" required />
                        @if($errors->has('name'))
                        <div class='error small text-danger'>{{$errors->first('name')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{@old('email', $user->email)}}" required />
                        @if($errors->has('email'))
                        <div class='error small text-danger'>{{$errors->first('email')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" value="{{@old('password')}}" required />
                        @if($errors->has('password'))
                        <div class='error small text-danger'>{{$errors->first('password')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role saat ini sebagai: 
                            @if( $user->role == 'admin' )
                                Admin
                            @elseif( $user->role == 'kabagSarpras' )
                                Kabag Sarpras
                            @elseif( $user->role == 'pengelolaCabang' )
                                Pengelola Cabang
                            @else
                                Pimpinan
                            @endif    
                        </label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="admin" value="1" {{ @old('role') == '1' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="inlineRadio1">Admin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="kabag_sarpras" value="2" {{ @old('role') == '2' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="inlineRadio1">Kabag Sarpras</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="pengelola_cabang" value="3" {{ @old('role') == '3' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="inlineRadio1">Pengelola Cabang</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="pimpinan" value="0" {{ @old('role') == '0' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="inlineRadio2">Pimpinan</label>
                            </div>
                        </div>
                        @if($errors->has('role'))
                        <div class='error small text-danger'>{{$errors->first('role')}}</div>
                        @endif
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <a href="{{ route('users.index', []) }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">@lang('Update User')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection