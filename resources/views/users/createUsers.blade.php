@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'users',
    'activePage' => 'users',
    'activeMenu'=>'User',
])

@section('content')
<div class="panel-header panel-header-sm">
</div>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Create User")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('create') }}" autocomplete="off"
            enctype="multipart/form-data">
              @csrf
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Name")}}</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}">
                                @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" role")}}</label>
                                <select name="role" class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}" placeholder="Pilih role" value="{{ old('role') }}">
                                    <option value="0" @if (old('role')==="0")selected @endif>Admin</option>
                                    <option value="1" @if (old('role')==="1")selected @endif>Tata Usaha</option>
                                    <option value="2" @if (old('role')==="2")selected @endif>Guru</option>
                                    <option value="3" @if (old('role')==="3")selected @endif>Siswa</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'role'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__(" Email address")}}</label>
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email')}} ">
                                @include('alerts.feedback', ['field' => 'email'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                      <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label>{{__(" Password")}}</label>
                        <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" required>
                        @include('alerts.feedback', ['field' => 'password'])
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                      <label>{{__(" Confirm Password")}}</label>
                      <input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required>
                    </div>
                  </div>
                </div>
              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
