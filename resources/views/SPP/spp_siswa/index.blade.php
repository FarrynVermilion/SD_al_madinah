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
            <div class="col-12 mt-2">
                <table class="w-100">
                    <tr>
                        <td scope="col" class="col-5">
                            <h4 class="card-title">Siswa belum aktif</h4>
                        </td>
                        <td scope="col" class="col-12 text-right w-100 m-auto pull-right">
                            <form action="{{ route('spp.siswa.cari') }}" method="GET">
                                @csrf
                                <input type="text" name="cari_siswa" placeholder="Cari Siswa" style="width: 80%; float: left;"class="form-control m-3 p-2" value="{{ request('cari_siswa') }}">
                                <button type="submit" class="btn btn-primary btn-round text-white pull-right" style="width: 10%">Cari</button>
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
                  <th>No</th>
                  <th>Nama siswa</th>
                  <th>NISN</th>
                  <th>NIS</th>
                  <th>Kelas</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data1 as $siswa)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $siswa->nama_lengkap }}</td>
                  <td>{{ $siswa->nisn }}</td>
                  <td>{{ $siswa->id_NIS }}</td>
                  <td>{{ $siswa->nama_kelas }}</td>
                  <td class="td-actions text-left">
                    <table>
                      <tr>
                        <td>
                          <form method="HEAD" action="{{route('spp.SPPsiswa.createSPP',$siswa->id)}}">
                            @csrf
                            <button type="submit" class="btn" style="width: 12em;"><i class="material-icons">Buat SPP</i></button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{route('siswa.destroy',$siswa)}}" onsubmit="return hapus()">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-danger" style="width: 12em;"><i class="material-icons">Hapus</i></button>
                          </form>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $data1->links() }}</div>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
        <div class="card">
          <div class="card-header">
            <div class="col-12 mt-2">
                <table class="w-100">
                    <tr>
                        <td scope="col" class="col-5">
                            <h4 class="card-title">Siswa aktif</h4>
                        </td>
                        <td scope="col" class="col-12 text-right w-100 m-auto pull-right">
                            <form action="{{ route('spp.siswa.cari') }}" method="GET">
                                @csrf
                                <input type="text" name="cari_siswa_aktif" placeholder="Cari Siswa" style="width: 80%; float: left;"class="form-control m-3 p-2" value="{{ request('cari_siswa_aktif') }}">
                                <button type="submit" class="btn btn-primary btn-round text-white pull-right " style="width: 10%">Cari</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
          </div>
          <div class="card-body">
            @csrf
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama siswa</th>
                  <th>NISN</th>
                  <th>NIS</th>
                  <th>Kelas</th>
                  <th>SPP</th>
                  <th>Potongan</th>
                  <th>Aktif</th>
                  <th>Diubah oleh</th>
                  <th>Terakhir diubah</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data2 as $siswa)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $siswa->nama_lengkap }}</td>
                  <td>{{ $siswa->nisn }}</td>
                  <td>{{ $siswa->id_NIS }}</td>
                  <td>{{ $siswa->nama_kelas }}</td>
                  <td>{{ $siswa->nama_bayaran}}<br>RP. {{ number_format($siswa->nominal,2,',','.') }}</td>
                  <td>{!! ($siswa->id_potongan==null) ? "Tidak ada potongan":
                  nl2br(e($siswa->nama_potongan."\nRP. ".number_format($siswa->nominal_potongan,2,',','.'))) !!}</td>
                  <td>{{ $siswa->status_siswa }}</td>
                  <td>{{ $siswa->updated_by }}</td>
                  <td>{{ $siswa->updated_at }}</td>
                  <td class="td-actions text-left">
                    <table>
                      <tr>
                        <td>
                          <form method="GET" action="{{route('SPPsiswa.edit',$siswa->id_spp_siswa)}}">
                            @csrf
                            <button type="submit" class="btn" style="width: 12em;"><i class="material-icons">Edit SPP</i></button>
                          </form>
                        </td>
                        <td>
                          <form method="POST" action="{{route('SPPsiswa.destroy',$siswa->id_spp_siswa)}}" onsubmit="return nonAktifkan()">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-warning" style="width: 12em;"><i class="material-icons">Nonaktifkan</i></button>
                          </form>
                        </td>
                        @if ( Auth::user()->role=='Admin')
                        <td>
                          <form method="POST" action="{{route('spp.SPPsiswa.delete',$siswa->id_spp_siswa)}}" onsubmit="return nonAktifkan()">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-danger" style="width: 12em;"><i class="material-icons">Hapus siswa</i></button>
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
            <div class="d-flex justify-content-center">{{ $data2->links() }}</div>
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
    function nonAktifkan(){
        if(confirm("Anda yakin akan menonaktifkan siswa ini?")){
            return true;
        }else{
            return false;
        }
    }
</script>
@endpush
