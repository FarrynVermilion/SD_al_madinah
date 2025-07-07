@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Pendaftaran Siswa Index',
    'activePage' => 'kelas',
    'activeMenu' => 'Pendaftaran',
])
@section('content')
<div class="panel-header panel-header-sm">
</div>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Buat Nominal SPP")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('nominal.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @include('alerts.errors')
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Nama bayaran SPP")}}</label>
                            <input type="text" name="nama_bayaran" class="form-control {{ $errors->has('nama_bayaran') ? ' is-invalid' : '' }}" placeholder="Nama bayaran" value="{{ old('nama_bayaran') }}">
                            @include('alerts.feedback', ['field' => 'nama_bayaran'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Nominal SPP")}}</label>
                            <input type="number" name="nominal" class="form-control {{ $errors->has('nominal') ? ' is-invalid' : '' }}" placeholder="Nominal SPP" value="{{ old('nominal') }}" max="999999999" min="0">
                            @include('alerts.feedback', ['field' => 'nominal'])
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
