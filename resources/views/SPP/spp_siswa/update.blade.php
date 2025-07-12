@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'SPP Siswa Index',
    'activePage' => 'SPP Siswa',
    'activeMenu' => 'SPP',
])
@section('content')
  <div class="panel-header panel-header-sm"></div>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit SPP siswa")}}</h5>
            <p class="text-left">{{__("ID Siswa : ")}} {{$SPP_Siswa->id_siswa}}</p>
            <p class="text-left">{{__("Nama siswa : ")}} {{$siswa->nama_lengkap}}</p>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('SPPsiswa.update', $SPP_Siswa->id_spp_siswa) }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @include('alerts.errors')
              @include('alerts.success')
              @method('PUT')
              <div class="row">
              </div>
              <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Nominal SPP")}}</label>
                            <select name="Nominal_SPP" class="form-control {{ $errors->has('Nominal_SPP') ? ' is-invalid' : '' }}">
                                @foreach ($nominal_spp as $as )
                                    <option value="{{$as->id_nominal}}"
                                        @if ( old('Nominal_SPP')==$as->id_nominal||$SPP_Siswa->id_nominal==$as->id_nominal)
                                            selected
                                        @endif>
                                        Nama : {{$as->nama_bayaran}} | Nominal : Rp, {{ number_format($as->nominal,2,',','.')}}
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
                            <select name="Potongan_SPP" class="form-control {{ $errors->has('Potongan_SPP') ? ' is-invalid' : '' }}" onclick="bukti_potongan()" required>
                                <option value="-1"
                                @if ( old('Potongan_SPP')=='-1')
                                    selected
                                @endif>Tidak ada</option>
                                @foreach ($potongan_spp as $as )
                                    <option value="{{$as->id_potongan}}"
                                        @if ( old('Potongan_SPP')==$as->id_potongan||$SPP_Siswa->id_potongan==$as->id_potongan)
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
                <div class="row" id="bukti_potongan" style="display: {{ $SPP_Siswa->id_potongan == null ? 'none' : 'block' }}">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Bukti Potongan")}}</label>
                            <div class="custom-file">
                                <input type="file" name="Bukti_Potongan" class="form-control {{ $errors->has('Bukti_Potongan') ? ' is-invalid' : '' }}"  required  >
                                <label id="customFile" class="custom-file-label" for="customFile">{{ old('Bukti_Potongan', $SPP_Siswa->bukti_potongan) }}</label>
                                <input id="file_name" type="hidden" name="file_name" value="{{ old('file_name', $SPP_Siswa->bukti_potongan) }}">
                            </div>
                            @include('alerts.feedback', ['field' => 'Bukti_Potongan'])
                        </div>
                    </div>
                </div>
              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
              </div>
              <hr class="half-rule"/>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
<script>
    function bukti_potongan(){
        if (document.getElementsByName("Potongan_SPP")[0].value === "-1") {
            document.getElementById("bukti_potongan").style.display = "none";
        }else{
            document.getElementById("bukti_potongan").style.display = "block";
        }
    }
    const fileInput = document.getElementsByName('Bukti_Potongan')[0];
    const fileNameDisplay = document.getElementById('customFile');
    const file_name = document.getElementById('file_name');

    fileInput.addEventListener('change', (event) => {
        const files = event.target.files;
        if (files.length > 0) {
            const fileName = files[0].name;
            fileNameDisplay.textContent = `File pdf yang dipilih: ${fileName}`;
            file_name.value = fileName;
        } else {
            fileNameDisplay.textContent = 'Pilih file pdf.';
        }
    });
</script>
@endpush
