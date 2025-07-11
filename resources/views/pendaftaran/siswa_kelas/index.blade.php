@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Pendaftaran Siswa Index',
    'activePage' => 'siswa kelas',
    'activeMenu' => 'Pendaftaran',
])
@section('content')
<div class="panel-header panel-header-sm">
</div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          <div class="card-header">
            <div class="col-12 mt-2">
                <table class="w-100">
                    <tr>
                        <td scope="col" class="col-2">
                            <h4 class="card-title">Belum ada kelas</h4>
                        </td>
                        <td scope="col" class="text-right w-100 m-auto pull-right">
                            <form action="{{ route('pendaftaran_siswa_cari') }}" method="GET">
                                @csrf
                                <table class="pull-right w-auto">
                                    <tr>
                                        <td class="col-md-8">
                                            <input type="text" name="cari" placeholder="Masukan nama siswa" class="form-control pull-right" value="{{ request('cari') }}">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary btn-round text-white pull-right " >cari</button>
                                         </td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
          </div>
          <div class="card-body">
            @csrf
            @include('alerts.errors')
            @include('alerts.success')
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NISN</th>
                  <th>Nama siswa</th>
                  <th>NIS</th>
                  <th>Kelas</th>
                  <th>Tahun ajaran</th>
                  <th class="disabled-sorting text-left">Penerimaan Siswa</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($NotHaveKelas as $siswa)
                <tr>
                  <td>{{ $loop->iteration}}</td>
                  <td>{{ $siswa->nisn }}</td>
                  <td>{{ $siswa->nama_lengkap }}</td>
                  <form action="{{ route('siswa_kelas.store') }}" method="post">
                    @csrf
                    <td>
                        <input type="text" class="form-control" placeholder="Masukan NIS" name="nis" value="{{ $siswa->nis }}">
                    </td>
                    <td>
                        <select name="id_kelas" class="form-control">
                        @foreach ($kelas as $kls)
                            <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                        @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="tahun_ajaran" class="form-control {{ $errors->has('tahun_ajar') ? ' is-invalid' : '' }}">
                            <option value="{{ (date('Y')-1) . '/' . date('Y') }}"
                                @if ( old('tahun_ajar') == ( (date('Y')-1) . '/' . date('Y') ) )
                                    selected
                                @endif>
                                {{ (date('Y')-1) . '/' . date('Y') }}
                            </option>
                            <option value="{{ date('Y') . '/' . (date('Y')+1) }}"
                                @if ( old('tahun_ajar') == ( date('Y') . '/' . (date('Y')+1) ) )
                                    selected
                                @endif>
                                {{ date('Y') . '/' . (date('Y')+1) }}
                            </option>
                        </select>
                    </td>
                    <td class="text-right">
                        <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                        <button type="submit" class="btn btn-primary">
                            Penerimaan Siswa
                        </button>
                    </td>
                  </form>
                </tr>

                @endforeach
              </tbody>
            </table>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
        <div class="card">
          <div class="card-header">
            <div class="card-header">
            <table width="100%">
              <tr>
                <td class="text-left">
                    <h4 class="card-title">Ada kelas</h4>
                </td>

                <td class="text-right w-100 m-auto pull-right">
                    <form action="{{ route('naik_kelas') }}" method="POST">
                        @csrf
                    <table class="pull-right">
                        <tr class="w-100">
                            <td class="col-md-8">
                                <div class="form-group ">
                                    <select name="id_kelas" class="form-control">
                                        @foreach ($kelas as $kls)
                                            <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                    <select name="tahun_ajaran" class="form-control {{ $errors->has('tahun_ajar') ? ' is-invalid' : '' }}">
                                        <option value="{{ (date('Y')-1) . '/' . date('Y') }}"
                                            @if ( old('tahun_ajar') == ( (date('Y')-1) . '/' . date('Y') ) )
                                                selected
                                            @endif>
                                            {{ (date('Y')-1) . '/' . date('Y') }}
                                        </option>
                                        <option value="{{ date('Y') . '/' . (date('Y')+1) }}"
                                            @if ( old('tahun_ajar') == ( date('Y') . '/' . (date('Y')+1) ) )
                                                selected
                                            @endif>
                                            {{ date('Y') . '/' . (date('Y')+1) }}
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td class="col-md-4">
                                <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Naik Kelas</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
              </tr>
          </div>
          </div>
          <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NISN</th>
                  <th>Nama siswa</th>
                  <th>NIS</th>
                  <th>Kelas</th>
                  <th>Tahun ajaran</th>
                  <th class="disabled-sorting text-left">Pilih</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($HaveKelas as $siswa )
                    <tr>
                        <td>
                            {{ $loop->iteration}}
                        </td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->nama_lengkap }}</td>
                        <td>{{ $siswa->id_NIS }}</td>
                        <td>{{ $siswa->nama_kelas }}</td>
                        <td>{{ $siswa->tahun_ajaran }}</td>
                        <td class="">
                            <div>
                                <input type="checkbox" name="id_siswa[]" value="{{ $siswa->id }}">
                            </div>
                        </td>
                    </tr>
                @endforeach
                </form>
              </tbody>
            </table>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
    <!-- end row -->
@endsection

@push('js')
<script>
    function hapus(){
        if(confirm("Anda yakin akan menghapus")){
            return true;
        }else{
            return false;
        }
    }

    function show_isi_jabatan_sekolah(id_jabatan){
        let table = document.getElementById("isi_jabatan_sekolah_"+id_jabatan);
        if (table.style.display === "block") {
            table.style.display = "none";
        }else if (table.style.display === "none") {
            table.style.display = "block";
        }
    }
</script>
@endpush
