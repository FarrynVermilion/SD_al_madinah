@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Jabatan Create',
    'activePage' => 'jabatan',
    'activeMenu'=>'User'
])
@section('content')
<div class="panel-header panel-header-sm">
</div>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Buat Jabatan Baru")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('jabatan.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @include('alerts.errors')
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Nama Jabatan")}}</label>
                            <input type="text" name="nama_jabatan" class="form-control {{ $errors->has('nama_jabatan') ? ' is-invalid' : '' }}" placeholder="Nama jabatan" value="{{ old('nama_jabatan') }}">
                            @include('alerts.feedback', ['field' => 'nama_jabatan'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Jenis Jabatan")}}</label>
                            <select name="jenis_jabatan" class="form-control {{ $errors->has('jenis_jabatan') ? ' is-invalid' : '' }}">
                                <option value="0"
                                @if ( old('jenis_jabatan')=='0')
                                    selected
                                @endif>Sekolah</option>
                                <option value="1"
                                @if ( old('jenis_jabatan')=='1')
                                    selected
                                @endif>Wali murid</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'Potongan_SPP'])
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

@push('js')
<script>

</script>
@endpush

