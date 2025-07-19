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
            <h5 class="title">Pastikan data sudah benar karena tidak akan dapat diubah setelah dibuat</h5>
          </div>
          <div class="card-body">
            <table class="table">
                <thead>
                    <th scope="col">ID Siswa</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">NISN</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">SPP</th>
                    <th scope="col">Potongan</th>
                    <th scope="col">Bukti Potongan</th>
                    <th scope="col">Tagihan</th>
                </thead>
                <tbody>
                    @foreach ($data as $siswa )
                        <tr>
                            <td>{{ $siswa->id }}</td>
                            <td>{{ $siswa->nama_lengkap }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->id_NIS }}</td>
                            <td>{{ $siswa->nama_kelas }}</td>
                            <td>{{ $siswa->tahun_ajaran }}</td>
                            <td>RP. {{ number_format($siswa->nominal,2,',','.') }}</td>
                            @if ($siswa->nominal_potongan==0)
                                <td colspan="2">Tidak ada potongan</td>
                            @else
                                <td>RP. {{ number_format($siswa->nominal_potongan,2,',','.') }}</td>
                                <td><a href="{{ route('DownloadFile', $siswa->bukti_potongan) }}" class="btn btn-primary btn-sm"><i class="material-icons">file_download</i></a> </td>
                            @endif
                            <td>RP. {{ number_format($siswa->nominal-$siswa->nominal_potongan,2,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $data->links() }}</div>

            <form method="post" action="{{ route('transaksi.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @include('alerts.errors')
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-5 pr-1">
                        <div class="form-group">
                            <label>{{__("Bulan")}}</label>
                            <select id="bulan" name="bulan" class="form-control {{ $errors->has('bulan') ? ' is-invalid' : '' }}">
                                <option value="1"
                                    @if ( old('bulan')=='1')
                                        selected
                                    @endif>
                                    Juli
                                </option>
                                <option value="2"
                                    @if ( old('bulan')=='2')
                                        selected
                                    @endif>
                                    Agustus
                                </option>
                                <option value="3"
                                    @if ( old('bulan')=='3')
                                        selected
                                    @endif>
                                    September
                                </option>
                                <option value="4"
                                    @if ( old('bulan')=='4')
                                        selected
                                    @endif>
                                    Oktober
                                </option>
                                <option value="5"
                                    @if ( old('bulan')=='5')
                                        selected
                                    @endif>
                                    November
                                </option>
                                <option value="6"
                                    @if ( old('bulan')=='6')
                                        selected
                                    @endif>
                                    Desember
                                </option>
                            </select>
                            @include('alerts.feedback', ['field' => 'bulan'])
                        </div>
                        <div class="form-group">
                            <label>{{__("Semester")}}</label>
                            <select id="semester" name="semester" class="form-control {{ $errors->has('semester') ? ' is-invalid' : '' }}">
                                <option value="0"
                                    @if ( old('semester')=='0')
                                        selected
                                    @endif>
                                    Gasal
                                </option>
                                <option value="1"
                                    @if ( old('semester')=='1')
                                        selected
                                    @endif>
                                    Genap
                                </option>
                            </select>
                            @include('alerts.feedback', ['field' => 'semester'])
                        </div>
                        {{-- <div class="form-group">
                            <label>{{__("Tahun ajaran")}}</label>
                            <select name="tahun_ajar" class="form-control {{ $errors->has('tahun_ajar') ? ' is-invalid' : '' }}">
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
                            @include('alerts.feedback', ['field' => 'Semester'])
                        </div> --}}
                    </div>
                </div>
              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script>
    const semester = document.getElementById('semester');
    const bulan = document.getElementById('bulan');

    semester.addEventListener('change', function() {
        if (this.value == 0) {
            for (let i = 0; i < bulan.options.length; i++) {
                if (bulan.options[i].value == 1) {
                    bulan.options[i].text = 'Juli';
                }
                if (bulan.options[i].value == 2) {
                    bulan.options[i].text = 'Agustus';
                }
                if (bulan.options[i].value == 3) {
                    bulan.options[i].text = 'September';
                }
                if (bulan.options[i].value == 4) {
                    bulan.options[i].text = 'Oktober';
                }
                if (bulan.options[i].value == 5) {
                    bulan.options[i].text = 'November';
                }
                if (bulan.options[i].value == 6) {
                    bulan.options[i].text = 'Desember';
                }
            }
        }else if (this.value == 1) {
            for (let i = 0; i < bulan.options.length; i++) {
                if (bulan.options[i].value == 1) {
                    bulan.options[i].text = 'Januari';
                }
                if (bulan.options[i].value == 2) {
                    bulan.options[i].text = 'Februari';
                }
                if (bulan.options[i].value == 3) {
                    bulan.options[i].text = 'Maret';
                }
                if (bulan.options[i].value == 4) {
                    bulan.options[i].text = 'April';
                }
                if (bulan.options[i].value == 5) {
                    bulan.options[i].text = 'Mei';
                }
                if (bulan.options[i].value == 6) {
                    bulan.options[i].text = 'Juni';
                }
            }
        }
    });
</script>
@endpush
