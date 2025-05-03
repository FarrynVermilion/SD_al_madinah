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
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('siswa.create') }}">Daftar siswa</a>
            <h4 class="card-title">Siswa</h4>
            <div class="col-12 mt-2"></div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            @csrf
            @include('alerts.errors')
            @include('alerts.success')
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama siswa</th>
                  <th>Nama wali</th>
                  <th>Jenis kelamin</th>
                  <th>Tanggal lahir</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $siswa)
                <tr>
                  <td>{{ $siswa->id }}</td>
                  <td>{{ $siswa->nama_siswa }}</td>
                  <td>{{ $siswa->nama_wali }}</td>
                  <td>{{ $siswa->jenis_kelamin }}</td>
                  <td>{{ $siswa->tanggal_lahir }}</td>
                  <td>
                    <table>
                        <tr>
                            <td class="td-actions text-left">
                                <a href="{{ route('siswa.edit', $siswa->id) }}"><i class="material-icons">edit</i></a>
                            </td>
                            <td class="td-actions text-left">
                                <a href="{{ route('wali.edit', $siswa->id) }}"><i class="material-icons">edit</i></a>
                            </td>
                            <td class="td-actions text-left"><i class="material-icons">show</i></td>
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
