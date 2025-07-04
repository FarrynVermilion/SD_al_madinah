
@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Verifikasi SPP Siswa',
    'activePage' => 'Verifikasi_SPP',
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
            <div class="col-12 mt-2">
                <table class="w-100">
                    <tr>
                        <td scope="col" class="col-2">
                            <h4 class="card-title">Verifikasi SPP</h4>
                        </td>
                        <td scope="col" class="col-12 text-right w-100 m-auto pull-right">
                            <form action="{{ route('verifikasi_cari') }}" method="GET">
                                @csrf
                                <input type="text" name="cari_siswa" placeholder="Cari Siswa" style="width: 80%; float: left;"class="form-control m-3 p-2" value="{{ request('cari_siswa') }}">
                                <button type="submit" class="btn btn-primary btn-round text-white pull-right m-3 p-2" style="width: 10%">Cari</button>
                            </form>
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
                  <th>Nama siswa</th>
                  <th>NISN</th>
                  <th>NIS</th>
                  <th>Kelas</th>
                  <th>SPP</th>
                  <th>Potongan</th>
                  <th>Tagihan</th>
                  <th>Bulan</th>
                  <th>Semester</th>
                  <th>Tahun ajaran</th>
                  <th>Verifikasi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $siswa)
                    <tr>
                        <td>{{$siswa->nama_lengkap}}</td>
                        <td>{{$siswa->nisn}}</td>
                        <td>{{$siswa->id_NIS}}</td>
                        <td>{{$siswa->nama_kelas}}</td>
                        <td>RP. {{ number_format($siswa->spp,2,',','.') }}</td>
                        <td>RP. {{ number_format($siswa->potongan,2,',','.') }}</td>
                        <td>RP. {{ number_format($siswa->spp-$siswa->potongan,2,',','.') }}</td>
                        <td>{{$siswa->bulan }}</td>
                        <td>{{$siswa->semester==0?"Ganjil": "Genap" }}</td>
                        <td>{{$siswa->tahun_ajaran}}</td>
                        <td>{{$siswa->status_verifikasi==0?"Belum diverifikasi wali":"Sudah diverifikasi wali"}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $data->links() }}</div>
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
    function pembayaran(){
        if(confirm("Anda yakin akan melunasi pembayaran data pembayaran tidak akan terlihat lagi")){
            return true;
        }else{
            return false;
        }
    }
</script>
@endpush
