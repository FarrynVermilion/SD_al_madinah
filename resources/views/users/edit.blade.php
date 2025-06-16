@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'users',
    'activePage' => 'users',
    'activeMenu'=>'User'
])
@section('content')
  <div class="panel-header panel-header-sm"></div>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit User")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('user_update',$edit->id ) }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @include('alerts.errors')
              @include('alerts.success')
              @method('POST')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                      <div class="form-group">
                        <label>{{__(" Nama")}}</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama', $edit->name) }}">
                        @include('alerts.feedback', ['field' => 'nama'])
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-1">
                      <div class="form-group">
                        <label>{{__(" role")}}</label>
                        <select name="role" class="form-control">
                          <option value="0"{{ $edit->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                          <option value="1"{{ $edit->role == 'Tata_Usaha' ? 'selected' : '' }}>Tata_Usaha</option>
                          <option value="2"{{ $edit->role == 'Guru' ? 'selected' : '' }}>Guru</option>
                          <option value="3"{{ $edit->role == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                        </select>
                        @include('alerts.feedback', ['field' => 'role'])
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-1">
                      <div class="form-group">
                        <label>{{__(" Email")}}</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $edit->email) }}">
                        @include('alerts.feedback', ['field' => 'email'])
                      </div>
                    </div>
                  </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
                    </div>
              <hr class="half-rule"/>
            </form>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('user.passwordEdit',$edit->id) }}" autocomplete="off">
              @csrf
              @method('get')
              @include('alerts.success', ['key' => 'password_status'])
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" Password baru")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password baru" type="password" name="password" required>
                    @include('alerts.feedback', ['field' => 'password'])
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                  <label>{{__(" Konfirmasi Password Baru")}}</label>
                  <input class="form-control" placeholder="Konfirmasi Password Baru" type="password" name="password_confirmation" required>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round ">{{__('Change Password')}}</button>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection
