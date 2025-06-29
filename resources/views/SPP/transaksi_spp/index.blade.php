@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Tramsaksi SPP Siswa Index',
    'activePage' => 'Tramsaksi SPP',
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
                            <h4 class="card-title">Transaksi SPP</h4>
                        </td>
                        <td scope="col" class="col-12 text-right w-100 m-auto pull-right">
                            <form action="{{ route('transaksi.cari') }}" method="GET">
                                @csrf
                                <input type="text" name="cari_siswa" placeholder="Cari Siswa" style="width: 80%; float: left;"class="form-control m-3 p-2" value="{{ request('cari_siswa') }}">
                                <button type="submit" class="btn btn-primary btn-round text-white pull-right m-3 p-2" style="width: 10%">Cari</button>
                            </form>
                        </td>
                        <td scope="col" class="col-2">
                            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('transaksi.create') }}">Buat SPP untuk semua siswa aktif</a>
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
                  <th>SPP</th>
                  <th>Potongan</th>
                  <th>Tagihan</th>
                  <th>Bulan</th>
                  <th>Semester</th>
                  <th>Tahun ajaran</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $siswa)
                    <tr>
                    <td>{{$siswa->nama_lengkap}}</td>
                    <td>{{$siswa->nisn}}</td>
                    <td>RP. {{ number_format($siswa->spp,2,',','.') }}</td>
                    <td>RP. {{ number_format($siswa->potongan,2,',','.') }}</td>
                    <td>RP. {{ number_format($siswa->spp-$siswa->potongan,2,',','.') }}</td>
                    <td>{{$siswa->bulan }}</td>
                    <td>{{$siswa->semester==0?"Ganjil": "Genap" }}</td>
                    <td>{{$siswa->tahun_ajaran}}</td>
                    <td class="td-actions text-left">
                      <table>
                        <tr>
                          <td>
                            <form method="GET" action="{{route('transaksi.edit',$siswa->id_transaksi)}}" onsubmit="return pembayaran()">
                              @csrf
                              <button type="submit" class="btn" style="width: 12em;"><i class="material-icons">Lunas</i></button>
                            </form>
                          </td>
                          @if ( Auth::user()->role=='Admin')
                            <td>
                                <form method="POST" action="{{route('transaksi.destroy',$siswa->id_transaksi)}}" onsubmit="return hapus()">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger" style="width: 12em;"><i class="material-icons">Hapus</i></button>
                                </form>
                            </td>
                          @endif
                        </tr>
                      </table>
                    </td>
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
