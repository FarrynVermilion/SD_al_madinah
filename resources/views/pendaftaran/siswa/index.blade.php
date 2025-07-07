@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Pendaftaran Siswa Index',
    'activePage' => 'Pendaftaran Siswa',
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
                            <h4 class="card-title">Siswa</h4>
                        </td>
                        <td scope="col" class="col-13 text-right w-100 m-auto pull-right">
                            <form action="{{ route('pendaftaran_siswa_cari') }}" method="GET">
                                @csrf
                                <input type="text" name="cari" placeholder="Masukan nama siswa" style="width: 80%; float: left;"class="form-control m-3 p-2" value="{{ request('cari') }}">
                                <button type="submit" class="btn btn-primary btn-round text-white pull-left" >cari</button>
                            </form>
                        </td>
                        <td scope="col" class="col-2">
                             <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('siswa.create') }}">Daftar siswa</a>
                        </td>
                    </tr>
                </table>
            </div>
          </div>

          @include('alerts.errors')
          @include('alerts.success')
          <div class="card-body">
            @csrf
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama siswa</th>
                  <th>Jenis kelamin</th>
                  <th>Tanggal lahir</th>
                  <th>Alamat</th>
                  <th>Nama wali</th>
                  <th>No wali</th>
                  <th>nama_ayah</th>
                  <th>nama_ibu</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $siswa)
                <tr>
                  <td>{{ $siswa->id }}</td>
                  <td>{{ $siswa->nama_lengkap }}</td>
                  <td>{{ $siswa->jenis_kelamin == 0? "Laki-laki" :  "Perempuan" }}</td>
                  <td>{{ $siswa->tanggal_lahir }}</td>
                  <td>{{ $siswa->alamat }}</td>
                  <td>{{ $siswa->nama_wali }}</td>
                  <td>{{ $siswa->no_hp_wali }}</td>
                  <td>{{ $siswa->nama_ayah }}</td>
                  <td>{{ $siswa->nama_ibu }}</td>
                  <td>
                    <table>
                        {{-- <tr>
                            <td class="td-actions text-left">
                                <a href="{{ route('siswa.edit', $siswa->id) }}">
                                    <i class="material-icons">edit siswa</i>
                                </a>
                            </td>
                            <td class="td-actions text-left">
                                <a href="{{ route('wali.edit', $siswa->id) }}">
                                    <i class="material-icons">edit wali</i>
                                </a>
                            </td>
                            <td class="td-actions text-left">
                                <a href="{{ route('wali.edit', $siswa->id) }}">
                                    <i class="material-icons">show</i>
                                </a>
                            </td> --}}
                            <td class="td-actions text-left">
                                <form method="POST" action="{{route('siswa.destroy',$siswa->id)}}" onsubmit="return hapus()">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger" style="width: 12em;"><i class="material-icons">Hapus</i></button>
                                </form>
                            </td>
                        </tr>
                    </table>
                  </td>
                  @endforeach
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
</script>
@endpush
