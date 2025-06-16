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
          @include('alerts.errors')
          @include('alerts.success')
          <div class="card-header">
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('jabatan.create') }}">Tambah Jabatan</a>
                <h4 class="card-title">Jabatan kosong</h4>
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
                            <td  style="white-space: nowrap;width:1%; ">
                                <table class="table table-bordered " cellspacing="0" >
                                    <tbody class="text-right " >
                                        <form method="post" action="{{route('jabatan_insert',$jabatan->id_jabatan)}}" >
                                        @csrf
                                            <tr id="{{ "isi_jabatan_sekolah_".$jabatan->id_jabatan }}" style="display: none;">
                                                <td >
                                                    <select style="width: 150px" name="user_id" class=" form-control">
                                                        @foreach ($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary" onclick="show_isi_jabatan_sekolah({{$jabatan->id_jabatan}})">Isi</button>
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </td>

                        @elseif ($jabatan->jenis_jabatan==1)
                            <td>
                                Wali
                            </td>
                            <td  style="white-space: nowrap;width:1%; ">
                                <table class="table table-bordered " cellspacing="0" >
                                    <tbody class="text-right " >
                                        <form method="post" action="{{route('jabatan_insert',$jabatan->id_jabatan)}}" >
                                        @csrf
                                            <tr id="{{ "isi_jabatan_sekolah_".$jabatan->id_jabatan }}" style="display: none;">
                                                <td >
                                                    <input style="width: 150px"  type="text" placeholder="Masukan nama wali" name="user_id" class="form-control" >
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary" onclick="show_isi_jabatan_sekolah({{$jabatan->id_jabatan}})">Isi</button>
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </td>
                        @endif

                        <td>
                            <form method="POST" action="{{route('jabatan.destroy',$jabatan->id_jabatan)}}" onsubmit="return hapus()">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Creation date</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach ( $users as $user)
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->role}}
                        </td>
                        <td>
                            {{$user->created_at}}
                        </td>
                        <td>
                            <form method="POST" action="{{route('user.destroy',$user->id)}}" onsubmit="return hapus()">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach --}}
              </tbody>
            </table>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Creation date</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach ( $users as $user)
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->role}}
                        </td>
                        <td>
                            {{$user->created_at}}
                        </td>
                        <td>
                            <form method="POST" action="{{route('user.destroy',$user->id)}}" onsubmit="return hapus()">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach --}}
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
        if (table.style.display === "inline-block") {
            table.style.display = "none";
        }else if (table.style.display === "none") {
            table.style.display = "inline-block";
        }
    }
</script>
@endpush
