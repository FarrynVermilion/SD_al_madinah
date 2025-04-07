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
                  <th>Nama aset</th>
                  <th>Merek aset</th>
                  <th>Jumlah aset</th>
                  <th>Aset tersedia</th>
                  <th>Untuk</th>
                  <th>Jumlah digunakan</th>
                  <th>Pembuat</th>
                  <th>Dibuat</th>
                  <th>Editor</th>
                  <th>Diubah</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
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
