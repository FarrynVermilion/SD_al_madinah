@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Jabatan Index',
    'activePage' => 'jabatan',
    'activeMenu'=>'User'
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
                            <h4 class="card-title">Jabatan kosong</h4>
                        </td>
                        <td scope="col" class="col-12 text-right w-100 m-auto pull-right">
                            <form action="{{ route('jabatan_cari') }}" method="GET">
                                @csrf
                                <input type="text" name="search" placeholder="Cari jabatan" style="width: 80%; float: left;"class="form-control m-3 p-2" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary btn-round text-white pull-right m-3 p-2" style="width: 10%">Cari</button>
                            </form>
                        </td>
                        <td scope="col" class="col-2">
                            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('jabatan.create') }}">Tambah Jabatan</a>
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
                  <th>Nama jabatan</th>
                  <th>Jenis jabatan</th>
                  <th class="disabled-sorting text-left">Isi</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $empty as $jabatan)
                    <tr>
                        <td>
                            {{$jabatan->nama_jabatan}}
                        </td>

                        @if ($jabatan->jenis_jabatan==0)
                            <td>
                                Sekolah
                            </td>
                            <td class="text-center">
                                <button popovertarget="popover_{{$jabatan->id_jabatan}}" type="button" class="btn btn-primary btn-round pull-right" >Isi</button>
                            </td>
                            <div popover id="popover_{{$jabatan->id_jabatan}}">
                                <div style="width: 50em; height: 25em;" >
                                    <div class="container w-100 h-100 align-items-center align-content-center justify-content-center bg-secondary">
                                        <form method="post" action="{{route('jabatan_insert',$jabatan->id_jabatan)}}" >
                                        @csrf
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Tambah jabatan wali : {{$jabatan->nama_jabatan}}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Nama</label>
                                                            <select class="form-control" name="nama" class=" form-control">
                                                                @foreach ($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <button type="submit" class="btn btn-primary btn-round pull-right">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @elseif ($jabatan->jenis_jabatan==1)
                            <td>
                                Wali
                            </td>
                            <td class="text-center">
                                <button popovertarget="popover_{{$jabatan->id_jabatan}}" type="button" class="btn btn-primary" >Isi</button>
                            </td>
                            <div popover id="popover_{{$jabatan->id_jabatan}}">
                                <div style="width: 50em; height: 25em;" >
                                    <div class="container w-100 h-100 align-items-center align-content-center justify-content-center bg-secondary">
                                        <form method="post" action="{{route('jabatan_insert',$jabatan->id_jabatan)}}" >
                                        @csrf
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Tambah jabatan wali : {{$jabatan->nama_jabatan}}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Nama</label>
                                                            <input type="text" placeholder="Masukan nama wali" name="nama" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">

                                                            <button type="submit" class="btn btn-primary btn-round pull-right">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <td>
                            <form method="POST" action="{{route('jabatan.destroy',$jabatan->id_jabatan)}}" onsubmit="return hapus()">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger">Hapus Jabatan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $empty->links() }}</div>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
        <div class="card">
          <div class="card-header">
                <h4 class="card-title">Jabatan sekolah</h4>
                <div class="col-12 mt-2">
            </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Jabatan</th>
                  <th>Nama</th>
                  <th>Role</th>
                  <th>Dibuat</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $sekolah as $Pengajar)
                    <tr>
                        <td>
                            {{$Pengajar->nama_jabatan}}
                        </td>
                        <td>
                            {{$Pengajar->name}}
                        </td>
                        <td>
                            @if ($Pengajar->role==0)
                                Admin
                            @elseif ($Pengajar->role==1)
                                Guru
                            @elseif ($Pengajar->role==2)
                                Tata usaha
                            @endif
                        </td>
                        <td>
                            {{$Pengajar->created_at}}
                        </td>
                        <td>
                            <form method="POST" action="{{ route('jabatan_pengajar_destroy') }}">
                                @csrf
                                <input name="id_transaksi_jabatan_sekolah" type="hidden" value="{{$Pengajar->id_transaksi_jabatan_sekolah}}">
                                <button type="submit" class="btn btn-danger">Copot Jabatan</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
              </tbody>
            </table>

            <div class="d-flex justify-content-center">{{ $sekolah->links() }}</div>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
        <div class="card">
          <div class="card-header">
                <h4 class="card-title">Jabatan wali</h4>
                <div class="col-12 mt-2">
            </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Jabatan</th>
                  <th>Nama</th>
                  <th>Dibuat</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $wali as $Wali)
                    <tr>
                        <td>
                            {{$Wali->nama_jabatan}}
                        </td>
                        <td>
                            {{$Wali->nama_wali}}
                        </td>
                        <td>
                            {{$Wali->created_at}}
                        </td>
                        <td>
                            <form method="POST" action="{{ route('jabatan_wali_destroy') }}">
                                @csrf
                                <input name="id_transaksi_jabatan_wali" type="hidden" value="{{$Wali->id_transaksi_jabatan_wali}}">
                                <button type="submit" class="btn btn-danger">Copot Jabatan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>

            <div class="d-flex justify-content-center">{{ $wali->links() }}</div>
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
        let btn = document.getElementById("btn_"+id_jabatan);
        if (table.style.display === "block") {
            table.style.display = "none";
            btn.innerHTML = "Isi";
        }else if (table.style.display === "none") {
            table.style.display = "block";
            btn.innerHTML = "Tutup";
        }
    }
</script>
@endpush
