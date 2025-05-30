@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'SPP Siswa Index',
    'activePage' => 'SPP Siswa',
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
            <h5 class="title">{{__(" Buat SPP siswa")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('SPPsiswa.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @include('alerts.errors')
              @include('alerts.success')
              <div class="row">
              </div>
                <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Nominal SPP")}}</label>
                            <select name="Nominal_SPP" class="form-control {{ $errors->has('Nominal_SPP') ? ' is-invalid' : '' }}">
                                @foreach ($nominal_spp as $as )
                                    <option value="{{$as->id_nominal}}"
                                        @if ( old('Nominal_SPP')==$as->id_nominal)
                                            selected
                                        @endif>
                                        Nama : {{$as->nama_bayaran}} | Nominal : Rp. {{ number_format($as->nominal,2,',','.')}}
                                    </option>
                                @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'Nominal_SPP'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Potongan SPP")}}</label>
                            <select name="Potongan_SPP" class="form-control {{ $errors->has('Potongan_SPP') ? ' is-invalid' : '' }}">
                                <option value="-1"
                                @if ( old('Potongan_SPP')=='-1')
                                    selected
                                @endif>Tidak ada</option>
                                @foreach ($potongan_spp as $as )
                                    <option value="{{$as->id_potongan}}"
                                        @if ( old('Potongan_SPP')==$as->id_potongan)
                                            selected
                                        @endif>
                                        Nama : {{$as->nama_potongan}} | Nominal : Rp. {{ number_format($as->nominal_potongan,2,',','.')}}
                                    </option>
                                @endforeach
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
