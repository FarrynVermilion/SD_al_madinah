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
      <div class="col-md-12">
        <div class="card">

          <div class="card-header">
            <div class="col-12 mt-2">
                <table class="w-100">
                    <tr>
                        <td scope="col" class="col-1">
                            <h4 class="card-title">Kelas</h4>
                        </td>
                        <td scope="col" class="col-12 text-right w-100 m-auto pull-right">
                            <form action="{{ route('kelas.store') }}" method="POST">
                                @csrf
                                <input type="text" name="kelas" placeholder="Masukan nama kelas" style="width: 80%; float: left;"class="form-control m-3 p-2" value="{{ old('kelas') }}">
                                <button type="submit" class="btn btn-primary btn-round text-white pull-right" style="width: 15%">Tambah kelas</button>
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
                    <th>NO</th>
                    <th>ID</th>
                    <th>Kelas</th>
                    <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $kelas)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kelas->id_kelas }}</td>
                    <td>{{ $kelas->nama_kelas }}</td>
                    <td class="text-right">
                        <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST" onsubmit="return hapus()">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">
                                Hapus
                        </button>
                        </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center">
              {{ $data->links() }}
            </div>
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
