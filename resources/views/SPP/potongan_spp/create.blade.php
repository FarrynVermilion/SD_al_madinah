@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Potongan SPP Index',
    'activePage' => 'Potongan SPP',
    'activeMenu' => 'SPP',
])
@section('content')
<div class="panel-header panel-header-sm">
</div>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Buat Potongan SPP")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('potongan.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @include('alerts.errors')
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Nama Potongan SPP")}}</label>
                            <input type="text" name="nama_potongan" class="form-control {{ $errors->has('nama_potongan') ? ' is-invalid' : '' }}" placeholder="Nama potongan" value="{{ old('nama_potongan') }}">
                            @include('alerts.feedback', ['field' => 'nama_potongan'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Nominal Potongan SPP")}}</label>
                            <input type="number" name="nominal_potongan" class="form-control {{ $errors->has('nominal_potongan') ? ' is-invalid' : '' }}" placeholder="Nominal potongan SPP" value="{{ old('nominal_potongan') }}" max="999999999" min="0">
                            @include('alerts.feedback', ['field' => 'nominal_potongan'])
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
