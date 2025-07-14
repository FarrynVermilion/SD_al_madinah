@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Pendaftaran Siswa Create',
    'activePage' => 'Pendaftaran Siswa',
    'activeMenu' => 'Pendaftaran',
])
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <form method="post" action="{{ route('siswa.store') }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 align-middle text-left">
                                <h5 class="title">{{__(" Data siswa")}}</h5>
                            </div>
                        </div>
                    </div>
                    @csrf
                    @include('alerts.errors')
                    @include('alerts.success')

                    <div class="card-body">
                        <div class="form-group">
                            <label>{{__(" Email akun")}}</label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email akun" value="{{ old('email') }}">
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Nama lengkap")}}</label>
                            <input type="text" name="nama_lengkap" class="form-control {{ $errors->has('nama_lengkap') ? ' is-invalid' : '' }}" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}">
                            @include('alerts.feedback', ['field' => 'nama_lengkap'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Nama panggilan")}}</label>
                            <input type="text" name="nama_panggilan" class="form-control {{ $errors->has('nama_panggilan') ? ' is-invalid' : '' }}" placeholder="Nama panggilan" value="{{ old('nama_panggilan') }}">
                            @include('alerts.feedback', ['field' => 'nama_panggilan'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Jenis kelamin")}}</label>
                            <select name="jenis_kelamin" class="form-control {{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}">
                                <option value="0"
                                @if ( old('jenis_kelamin')=='0')
                                    selected
                                @endif>Laki-laki</option>
                                <option value="1"
                                @if ( old('jenis_kelamin')=='1')
                                    selected
                                @endif>Perempuan</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'jenis_kelamin'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Tempat lahir")}}</label>
                            <input type="text" name="tempat_lahir" class="form-control {{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" placeholder="Tempat lahir" value="{{ old('tempat_lahir') }}">
                            @include('alerts.feedback', ['field' => 'tempat_lahir'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Tanggal lahir")}}</label>
                            <input type="date" name="tanggal_lahir" class="form-control {{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" placeholder="Tanggal lahir" value="{{ old('tanggal_lahir') }}">
                            @include('alerts.feedback', ['field' => 'tanggal_lahir'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Agama")}}</label>
                            <input type="text" name="agama" class="form-control {{ $errors->has('agama') ? ' is-invalid' : '' }}" placeholder="Agama" value="{{ old('agama') }}">
                            @include('alerts.feedback', ['field' => 'agama'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Kewarganegaraan")}}</label>
                            <input type="text" name="kewarganegaraan" class="form-control {{ $errors->has('kewarganegaraan') ? ' is-invalid' : '' }}" placeholder="Kewarganegaraan" value="{{ old('kewarganegaraan') }}">
                            @include('alerts.feedback', ['field' => 'kewarganegaraan'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Anak ke")}}</label>
                            <input type="number" min="0" name="anak_ke" class="form-control {{ $errors->has('anak_ke') ? ' is-invalid' : '' }}" placeholder="Anak ke" value="{{ old('anak_ke') }}">
                            @include('alerts.feedback', ['field' => 'anak_ke'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Jumlah saudara kandung")}}</label>
                            <input type="number" min="0" name="jumlah_saudara_kandung" class="form-control {{ $errors->has('jumlah_saudara_kandung') ? ' is-invalid' : '' }}" placeholder="Jumlah saudara kandung" value="{{ old('jumlah_saudara_kandung') }}">
                            @include('alerts.feedback', ['field' => 'jumlah_saudara_kandung'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Jumlah saudara tiri")}}</label>
                            <input type="number" min="0" name="jumlah_saudara_tiri" class="form-control {{ $errors->has('jumlah_saudara_tiri') ? ' is-invalid' : '' }}" placeholder="Jumlah saudara tiri" value="{{ old('jumlah_saudara_tiri') }}">
                            @include('alerts.feedback', ['field' => 'jumlah_saudara_tiri'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Jumlah saudara angkat")}}</label>
                            <input type="number" min="0" name="jumlah_saudara_angkat" class="form-control {{ $errors->has('jumlah_saudara_angkat') ? ' is-invalid' : '' }}" placeholder="Jumlah saudara angkat" value="{{ old('jumlah_saudara_angkat') }}">
                            @include('alerts.feedback', ['field' => 'jumlah_saudara_angkat'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Status anak")}}</label>
                            <select name="status_anak" class="form-control {{ $errors->has('status_anak') ? ' is-invalid' : '' }}">
                                <option value="0"
                                @if ( old('status_anak')=='0')
                                    selected
                                @endif>Kandung</option>
                                <option value="1"
                                @if ( old('status_anak')=='1')
                                    selected
                                @endif>Tiri</option>
                                <option value="2"
                                @if ( old('status_anak')=='2')
                                    selected
                                @endif>Angkat</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'status_anak'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Bahasa sehari hari")}}</label>
                            <input type="Text"  name="bahasa_sehari_hari" class="form-control {{ $errors->has('bahasa_sehari_hari') ? ' is-invalid' : '' }}" placeholder="Bahasa sehari hari" value="{{ old('bahasa_sehari_hari') }}">
                            @include('alerts.feedback', ['field' => 'bahasa_sehari_hari'])
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title">Data Alamat dan Fisik Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{__(" Alamat")}}</label>
                            <input type="Text"  name="alamat" class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="Alamat" value="{{ old('alamat') }}">
                            @include('alerts.feedback', ['field' => 'alamat'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Kelurahan")}}</label>
                            <input type="text"  name="kelurahan" class="form-control {{ $errors->has('kelurahan') ? ' is-invalid' : '' }}" placeholder="Kelurahan" value="{{ old('kelurahan') }}">
                            @include('alerts.feedback', ['field' => 'kelurahan'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Kecamatan")}}</label>
                            <input type="text"  name="kecamatan" class="form-control {{ $errors->has('kecamatan') ? ' is-invalid' : '' }}" placeholder="kecamatan" value="{{ old('kecamatan') }}">
                            @include('alerts.feedback', ['field' => 'kecamatan'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Kota")}}</label>
                            <input type="text"  name="kota" class="form-control {{ $errors->has('kota') ? ' is-invalid' : '' }}" placeholder="Kota" value="{{ old('kota') }}">
                            @include('alerts.feedback', ['field' => 'kota'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Kode pos")}}</label>
                            <input type="text"  name="kode_pos" class="form-control {{ $errors->has('kode_pos') ? ' is-invalid' : '' }}" placeholder="Kode pos" value="{{ old('kode_pos') }}">
                            @include('alerts.feedback', ['field' => 'kode_pos'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Nomor telepon")}}</label>
                            <input type="text"  name="nomor_telepon" class="form-control {{ $errors->has('nomor_telepon') ? ' is-invalid' : '' }}" placeholder="Nomor telepon" value="{{ old('nomor_telepon') }}">
                            @include('alerts.feedback', ['field' => 'nomor_telepon'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Tempat alamat")}}</label>
                            <select name="tempat_alamat" class="form-control {{ $errors->has('tempat_alamat') ? ' is-invalid' : '' }}">
                                <option value="0"
                                @if ( old('tempat_alamat')=='0')
                                    selected
                                @endif>Milik</option>
                                <option value="1"
                                @if ( old('tempat_alamat')=='1')
                                    selected
                                @endif>Sewa</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'tempat_alamat'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Nama pemilik tempat alamat")}}</label>
                            <input type="text"  name="nama_pemilik_tempat_alamat" class="form-control {{ $errors->has('nama_pemilik_tempat_alamat') ? ' is-invalid' : '' }}" placeholder="Nama pemilik tempat alamat" value="{{ old('nama_pemilik_tempat_alamat') }}">
                            @include('alerts.feedback', ['field' => 'nama_pemilik_tempat_alamat'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Jarak ke sekolah (dalam km)")}}</label>
                            <input type="number" min="0"  name="jarak_ke_sekolah" class="form-control {{ $errors->has('jarak_ke_sekolah') ? ' is-invalid' : '' }}" placeholder="Jarak ke sekolah" value="{{ old('jarak_ke_sekolah') }}">
                            @include('alerts.feedback', ['field' => 'jarak_ke_sekolah'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Metode_Transportasi")}}</label>
                            <select name="metode_transportasi" class="form-control {{ $errors->has('metode_transportasi') ? ' is-invalid' : '' }}">
                                <option value="0"
                                @if ( old('metode_transportasi')=='0')
                                    selected
                                @endif>Antar</option>
                                <option value="1"
                                @if ( old('metode_transportasi')=='1')
                                    selected
                                @endif>Sendiri</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'metode_transportasi'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Golongan_Darah")}}</label>
                            <select name="golongan_darah" class="form-control {{ $errors->has('golongan_darah') ? ' is-invalid' : '' }}">
                                <option value=""
                                @if ( old('golongan_darah')=='')
                                    selected
                                @endif>Tidak tahu</option>
                                <option value="O?"
                                @if ( old('golongan_darah')=='O?')
                                    selected
                                @endif>O?</option>
                                <option value="O+"
                                @if ( old('golongan_darah')=='O+')
                                    selected
                                @endif>O+</option>
                                <option value="O-"
                                @if ( old('golongan_darah')=='O-')
                                    selected
                                @endif>O-</option>
                                <option value="A?"
                                @if ( old('golongan_darah')=='A?')
                                    selected
                                @endif>A?</option>
                                <option value="A+"
                                @if ( old('golongan_darah')=='A+')
                                    selected
                                @endif>A+</option>
                                <option value="A-"
                                @if ( old('golongan_darah')=='A-')
                                    selected
                                @endif>A-</option>
                                <option value="B?"
                                @if ( old('golongan_darah')=='B?')
                                    selected
                                @endif>B?</option>
                                <option value="B+"
                                @if ( old('golongan_darah')=='B+')
                                    selected
                                @endif>B+</option>
                                <option value="B-"
                                @if ( old('golongan_darah')=='B-')
                                    selected
                                @endif>B-</option>
                                <option value="AB?"
                                @if ( old('golongan_darah')=='AB?')
                                    selected
                                @endif>AB?</option>
                                <option value="AB+"
                                @if ( old('golongan_darah')=='AB+')
                                    selected
                                @endif>AB+</option>
                                <option value="AB-"
                                @if ( old('golongan_darah')=='AB-')
                                    selected
                                @endif>AB-</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'golongan_darah'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Riwayat Rawat")}}</label>
                            <input type="text"  name="riwayat_rawat" class="form-control {{ $errors->has('riwayat_rawat') ? ' is-invalid' : '' }}" placeholder="Riwayat Rawat" value="{{ old('riwayat_rawat') }}">
                            @include('alerts.feedback', ['field' => 'riwayat_rawat'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Riwayat Penyakit")}}</label>
                            <select name="metode_transportasi" class="form-control {{ $errors->has('riwayat_penyakit') ? ' is-invalid' : '' }}">
                                <option value="0"
                                @if ( old('riwayat_penyakit')=='0')
                                    selected
                                @endif>Tidak ada</option>
                                <option value="1"
                                @if ( old('riwayat_penyakit')=='1')
                                    selected
                                @endif>Ada</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'riwayat_penyakit'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Kelainan Jasmani")}}</label>
                            <input type="text"  name="kelainan_jasmani" class="form-control {{ $errors->has('kelainan_jasmani') ? ' is-invalid' : '' }}" placeholder="Kelainan Jasmani" value="{{ old('kelainan_jasmani') }}">
                            @include('alerts.feedback', ['field' => 'kelainan_jasmani'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Tinggi Nadan")}}</label>
                            <input type="number"  name="tinggi_badan" class="form-control {{ $errors->has('tinggi_badan') ? ' is-invalid' : '' }}" placeholder="Tinggi Badan" value="{{ old('tinggi_badan') }}">
                            @include('alerts.feedback', ['field' => 'tinggi_badan'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Berat Badan")}}</label>
                            <input type="number"  name="berat_badan" class="form-control {{ $errors->has('berat_badan') ? ' is-invalid' : '' }}" placeholder="Berat Badan" value="{{ old('berat_badan') }}">
                            @include('alerts.feedback', ['field' => 'berat_badan'])
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{__(" Riwayat Pendidikan")}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{__(" Nama Sekolah Asal")}}</label>
                            <input type="text"  name="nama_sekolah_asal" class="form-control {{ $errors->has('nama_sekolah_asal') ? ' is-invalid' : '' }}" placeholder="Nama Sekolah Asal" value="{{ old('nama_sekolah_asal') }}">
                            @include('alerts.feedback', ['field' => 'nama_sekolah_asal'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Tanggal Ijazah")}}</label>
                            <input type="date"  name="tanggal_ijazah" class="form-control {{ $errors->has('tanggal_ijazah') ? ' is-invalid' : '' }}" placeholder="Tanggal Ijazah" value="{{ old('tanggal_ijazah') }}">
                            @include('alerts.feedback', ['field' => 'tanggal_ijazah'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Nomor Ijazah")}}</label>
                            <input type="text"  name="nomor_ijazah" class="form-control {{ $errors->has('nomor_ijazah') ? ' is-invalid' : '' }}" placeholder="Nomor Ijazah" value="{{ old('nomor_ijazah') }}">
                            @include('alerts.feedback', ['field' => 'nomor_ijazah'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Tanggal SKHUN")}}</label>
                            <input type="date"  name="tanggal_skhun" class="form-control {{ $errors->has('tanggal_skhun') ? ' is-invalid' : '' }}" placeholder="Tanggal SKHUN" value="{{ old('tanggal_skhun') }}">
                            @include('alerts.feedback', ['field' => 'tanggal_skhun'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Nomor SKHUN")}}</label>
                            <input type="text"  name="nomor_skhun" class="form-control {{ $errors->has('nomor_skhun') ? ' is-invalid' : '' }}" placeholder="Nomor SKHUN" value="{{ old('nomor_skhun') }}">
                            @include('alerts.feedback', ['field' => 'nomor_skhun'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Lama Belajar")}}</label>
                            <input type="number"  name="lama_belajar" class="form-control {{ $errors->has('lama_belajar') ? ' is-invalid' : '' }}" placeholder="Lama Belajar" value="{{ old('lama_belajar') }}">
                            @include('alerts.feedback', ['field' => 'lama_belajar'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" NISN")}}</label>
                            <input type="text"  name="nisn" class="form-control {{ $errors->has('nisn') ? ' is-invalid' : '' }}" placeholder="NISN" value="{{ old('nisn') }}">
                            @include('alerts.feedback', ['field' => 'nisn'])
                        </div>
                        <div class="form-group">
                            <label>{{__(" Tipe Riwayat Sekolah")}}</label>
                            <select id="tipe_riwayat_sekolah" name="tipe_riwayat_sekolah" onclick="show_pindah()" class="form-control {{ $errors->has('tipe_riwayat_sekolah') ? ' is-invalid' : '' }}">
                                <option value="0"
                                @if ( old('tipe_riwayat_sekolah')=='0')
                                    selected
                                @endif>Baru</option>
                                <option value="1"
                                @if ( old('tipe_riwayat_sekolah')=='1')
                                    selected
                                @endif>Pindah</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'tipe_riwayat_sekolah'])
                        </div>
                        <div id="view_pindah" style="display: none">
                            <div class="form-group">
                                <label>{{__(" Nama Sekolah Sebelumnya")}}</label>
                                <input type="text" id="nama_riwayat_sekolah" name="nama_riwayat_sekolah" class="form-control {{ $errors->has('nama_riwayat_sekolah') ? ' is-invalid' : '' }}" placeholder="Nama Riwayat Sekolah" value="{{ old('nama_riwayat_sekolah') }}">
                                @include('alerts.feedback', ['field' => 'nama_riwayat_sekolah'])
                            </div>

                            <div class="form-group">
                                <label>{{__(" Tanggal_Pindah")}}</label>
                                <input type="date" id="tanggal_pindah" name="tanggal_pindah" class="form-control {{ $errors->has('tanggal_pindah') ? ' is-invalid' : '' }}" placeholder="Tanggal Pindah" value="{{ old('tanggal_pindah') }}">
                                @include('alerts.feedback', ['field' => 'tanggal_pindah'])
                            </div>

                            <div class="form-group">
                                <label>{{__(" Alasan Pindah")}}</label>
                                <input type="text" id="alasan_pindah" name="alasan_pindah" class="form-control {{ $errors->has('alasan_pindah') ? ' is-invalid' : '' }}" placeholder="Alasan Pindah" value="{{ old('alasan_pindah') }}">
                                @include('alerts.feedback', ['field' => 'alasan_pindah'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 align-middle">
                                <h5 class="title text-left-align-middle">{{__(" Data orang tua")}}</h5>
                            </div>

                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary btn-round" >{{__('Save')}}</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label>{{__(" Pilih data kk")}}</label>
                            <select id="pilih_data_kk" name="pilih_data_kk" class="form-control {{ $errors->has('pilih_data_kk') ? ' is-invalid' : '' }}">
                                <option value="0"
                                @if ( old('pilih_data_kk')=='0')
                                    selected
                                @endif>Buat Baru</option>
                                @foreach ($kk as $no_kk )
                                    <option value="{{$no_kk}}"
                                    @if ( old('pilih_data_kk')==$no_kk)
                                        selected
                                    @endif>{{$no_kk}}</option>
                                @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'tipe_riwayat_sekolah'])
                        </div>
                        <div class="form-group" id="view_status_orang_tua">
                            <label>{{ __("Wali") }}</label>
                            <select id="status_hidup" name="status_hidup" class="form-control {{ $errors->has('status_hidup') ? ' is-invalid' : '' }}">
                                <option value="Lengkap"
                                @if ( old('status_hidup')=='Lengkap')
                                    selected
                                @endif>Lengkap</option>
                                <option value="Hanya ayah"
                                @if ( old('status_hidup')=='Hanya ayah')
                                    selected
                                @endif>Hanya ayah</option>
                                <option value="Hanya ibu"
                                @if ( old('status_hidup')=='Hanya ibu')
                                    selected
                                @endif>Hanya ibu</option>
                                <option value="Wali"
                                @if ( old('status_hidup')=='Wali')
                                    selected
                                @endif>Wali</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'status_hidup'])
                        </div>
                        <div class="form-group"id="view_kk">
                            <label>{{__(" No kk")}}</label>
                            <input type="text" id="no_kk" name="no_kk" class="form-control {{ $errors->has('no_kk') ? ' is-invalid' : '' }}" placeholder="No kk" value="{{ old('no_kk') }}" required>
                            @include('alerts.feedback', ['field' => 'no_kk'])
                        </div>
                    </div>
                </div>
                <div id="view_kk_baru" style="display: block">
                    <div class="row">
                        <!-- Data Ayah -->
                        <div class="col-md-4" id="view_ayah">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="title">{{ __("Data Ayah") }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{ __("Nama Ayah *") }}</label>
                                        <input type="text" id="nama_ayah" name="nama_ayah" class="form-control {{ $errors->has('nama_ayah') ? ' is-invalid' : '' }}" placeholder="Nama Ayah" value="{{ old('nama_ayah') }}" required>
                                        @include('alerts.feedback', ['field' => 'nama_ayah'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Tempat Lahir Ayah *") }}</label>
                                        <input type="text" id="tempat_lahir_ayah" name="tempat_lahir_ayah" class="form-control {{ $errors->has('tempat_lahir_ayah') ? ' is-invalid' : '' }}" placeholder="Tempat Lahir Ayah" value="{{ old('tempat_lahir_ayah') }}" required>
                                        @include('alerts.feedback', ['field' => 'tempat_lahir_ayah'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Tanggal Lahir Ayah *") }}</label>
                                        <input type="date" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" class="form-control {{ $errors->has('tanggal_lahir_ayah') ? ' is-invalid' : '' }}" value="{{ old('tanggal_lahir_ayah') }}" required>
                                        @include('alerts.feedback', ['field' => 'tanggal_lahir_ayah'])
                                    </div>


                                    <div class="form-group">
                                        <label>{{ __("Kewarganegaraan Ayah *") }}</label>
                                        <input type="text" id="kewarganegaraan_ayah" name="kewarganegaraan_ayah" onfocusout="kwn_ayah()" class="form-control {{ $errors->has('kewarganegaraan_ayah') ? ' is-invalid' : '' }}" placeholder="Kewarganegaraan Ayah" value="{{ old('kewarganegaraan_ayah') }}" required>
                                        @include('alerts.feedback', ['field' => 'kewarganegaraan_ayah'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("NIK Ayah *") }}</label>
                                        <input type="text" id="nik_ayah" name="nik_ayah" class="form-control {{ $errors->has('nik_ayah') ? ' is-invalid' : '' }}" placeholder="NIK Ayah" value="{{ old('nik_ayah') }}" required>
                                        @include('alerts.feedback', ['field' => 'nik_ayah'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Agama Ayah *") }}</label>
                                        <input type="text" id="agama_ayah" name="agama_ayah" class="form-control {{ $errors->has('agama_ayah') ? ' is-invalid' : '' }}" placeholder="Agama Ayah" value="{{ old('agama_ayah') }}" required>
                                        @include('alerts.feedback', ['field' => 'agama_ayah'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Pendidikan Ayah *") }}</label>
                                        <input type="text" id="pendidikan_ayah" name="pendidikan_ayah" class="form-control {{ $errors->has('pendidikan_ayah') ? ' is-invalid' : '' }}" placeholder="Pendidikan Ayah" value="{{ old('pendidikan_ayah') }}" required>
                                        @include('alerts.feedback', ['field' => 'pendidikan_ayah'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Ijazah Ayah *") }}</label>
                                        <input type="text" id="ijazah_ayah" name="ijazah_ayah" class="form-control {{ $errors->has('ijazah_ayah') ? ' is-invalid' : '' }}" placeholder="Ijazah Ayah" value="{{ old('ijazah_ayah') }}" >
                                        @include('alerts.feedback', ['field' => 'ijazah_ayah'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Pekerjaan Ayah *") }}</label>
                                        <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" class="form-control {{ $errors->has('pekerjaan_ayah') ? ' is-invalid' : '' }}" placeholder="Pekerjaan Ayah" value="{{ old('pekerjaan_ayah') }}" required>
                                        @include('alerts.feedback', ['field' => 'pekerjaan_ayah'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Penghasilan Ayah *") }}</label>
                                        <input type="number" id="penghasilan_ayah" name="penghasilan_ayah" class="form-control {{ $errors->has('penghasilan_ayah') ? ' is-invalid' : '' }}" placeholder="Penghasilan Ayah" value="{{ old('penghasilan_ayah') }}" required>
                                        @include('alerts.feedback', ['field' => 'penghasilan_ayah'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Alamat Kerja Ayah") }}</label>
                                        <input type="text"  name="alamat_kerja_ayah" class="form-control {{ $errors->has('alamat_kerja_ayah') ? ' is-invalid' : '' }}" placeholder="Alamat Kerja Ayah" value="{{ old('alamat_kerja_ayah') }}">
                                        @include('alerts.feedback', ['field' => 'alamat_kerja_ayah'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Alamat Rumah Ayah *") }}</label>
                                        <input type="text" id="alamat_rumah_ayah" name="alamat_rumah_ayah" class="form-control {{ $errors->has('alamat_rumah_ayah') ? ' is-invalid' : '' }}" placeholder="Alamat Rumah Ayah" value="{{ old('alamat_rumah_ayah') }}" required>
                                        @include('alerts.feedback', ['field' => 'alamat_rumah_ayah'])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Ibu -->
                        <div class="col-md-4" id="view_ibu">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="title">{{ __("Data Ibu") }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{ __("Nama Ibu *") }}</label>
                                        <input type="text" id="nama_ibu" name="nama_ibu" class="form-control {{ $errors->has('nama_ibu') ? ' is-invalid' : '' }}" placeholder="Nama Ibu" value="{{ old('nama_ibu') }}" required>
                                        @include('alerts.feedback', ['field' => 'nama_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Tempat Lahir Ibu *") }}</label>
                                        <input type="text" id="tempat_lahir_ibu" name="tempat_lahir_ibu" class="form-control {{ $errors->has('tempat_lahir_ibu') ? ' is-invalid' : '' }}" placeholder="Tempat Lahir Ibu" value="{{ old('tempat_lahir_ibu') }}" required>
                                        @include('alerts.feedback', ['field' => 'tempat_lahir_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Tanggal Lahir Ibu *") }}</label>
                                        <input type="date" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" class="form-control {{ $errors->has('tanggal_lahir_ibu') ? ' is-invalid' : '' }}" value="{{ old('tanggal_lahir_ibu') }}" required>
                                        @include('alerts.feedback', ['field' => 'tanggal_lahir_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Kewarganegaraan Ibu *") }}</label>
                                        <input type="text" id="kewarganegaraan_ibu" name="kewarganegaraan_ibu" onfocusout="kwn_ibu()" class="form-control {{ $errors->has('kewarganegaraan_ibu') ? ' is-invalid' : '' }}" placeholder="Kewarganegaraan Ibu" value="{{ old('kewarganegaraan_ibu') }}" required>
                                        @include('alerts.feedback', ['field' => 'kewarganegaraan_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("NIK Ibu *") }}</label>
                                        <input type="text" id="nik_ibu" name="nik_ibu" class="form-control {{ $errors->has('nik_ibu') ? ' is-invalid' : '' }}" placeholder="NIK Ibu" value="{{ old('nik_ibu') }}" required>
                                        @include('alerts.feedback', ['field' => 'nik_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Agama Ibu *") }}</label>
                                        <input type="text" id="agama_ibu" name="agama_ibu" class="form-control {{ $errors->has('agama_ibu') ? ' is-invalid' : '' }}" placeholder="Agama Ibu" value="{{ old('agama_ibu') }}" required>
                                        @include('alerts.feedback', ['field' => 'agama_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Pendidikan Ibu *") }}</label>
                                        <input type="text" id="pendidikan_ibu" name="pendidikan_ibu" class="form-control {{ $errors->has('pendidikan_ibu') ? ' is-invalid' : '' }}" placeholder="Pendidikan Ibu" value="{{ old('pendidikan_ibu') }}" required>
                                        @include('alerts.feedback', ['field' => 'pendidikan_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Ijazah Ibu *") }}</label>
                                        <input type="text" name="ijazah_ibu" class="form-control {{ $errors->has('ijazah_ibu') ? ' is-invalid' : '' }}" placeholder="Ijazah Ibu" value="{{ old('ijazah_ibu') }}">
                                        @include('alerts.feedback', ['field' => 'ijazah_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Pekerjaan Ibu *") }}</label>
                                        <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" class="form-control {{ $errors->has('pekerjaan_ibu') ? ' is-invalid' : '' }}" placeholder="Pekerjaan Ibu" value="{{ old('pekerjaan_ibu') }}" required>
                                        @include('alerts.feedback', ['field' => 'pekerjaan_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Penghasilan Ibu *") }}</label>
                                        <input type="number" id="penghasilan_ibu" name="penghasilan_ibu" class="form-control {{ $errors->has('penghasilan_ibu') ? ' is-invalid' : '' }}" placeholder="Penghasilan Ibu" value="{{ old('penghasilan_ibu') }}" required>
                                        @include('alerts.feedback', ['field' => 'penghasilan_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Alamat Kerja Ibu") }}</label>
                                        <input type="text" name="alamat_kerja_ibu" class="form-control {{ $errors->has('alamat_kerja_ibu') ? ' is-invalid' : '' }}" placeholder="Alamat Kerja Ibu" value="{{ old('alamat_kerja_ibu') }}">
                                        @include('alerts.feedback', ['field' => 'alamat_kerja_ibu'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Alamat Rumah Ibu *") }}</label>
                                        <input type="text" id="alamat_rumah_ibu" name="alamat_rumah_ibu" class="form-control {{ $errors->has('alamat_rumah_ibu') ? ' is-invalid' : '' }}" placeholder="Alamat Rumah Ibu" value="{{ old('alamat_rumah_ibu') }}" required>
                                        @include('alerts.feedback', ['field' => 'alamat_rumah_ibu'])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4" id="view_wali">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="title">{{__(" Data wali")}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{ __("Nama Wali *") }}</label>
                                        <input type="text" id="nama_wali" name="nama_wali" class="form-control {{ $errors->has('nama_wali') ? ' is-invalid' : '' }}" placeholder="Nama Wali" value="{{ old('nama_wali') }}" required>
                                        @include('alerts.feedback', ['field' => 'nama_wali'])
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __("Tempat Lahir Wali *") }}</label>
                                        <input type="text" id="tempat_lahir_wali" name="tempat_lahir_wali" class="form-control {{ $errors->has('tempat_lahir_wali') ? ' is-invalid' : '' }}" placeholder="Tempat Lahir Wali" value="{{ old('tempat_lahir_wali') }}" required>
                                        @include('alerts.feedback', ['field' => 'tempat_lahir_wali'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{__(" Tanggal Lahir Wali *")}}</label>
                                        <input type="date" id="tanggal_lahir_wali" name="tanggal_lahir_wali" class="form-control {{ $errors->has('tanggal_lahir_wali') ? ' is-invalid' : '' }}" placeholder="Tanggal Lahir Wali" value="{{ old('tanggal_lahir_wali') }}"required>
                                        @include('alerts.feedback', ['field' => 'tanggal_lahir_wali'])
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __("Kewarganegaraan Wali *") }}</label>
                                        <input type="text" id="kewarganegaraan_wali" name="kewarganegaraan_wali" onfocusout="kwn_wali()" class="form-control {{ $errors->has('kewarganegaraan_wali') ? ' is-invalid' : '' }}" placeholder="Kewarganegaraan Wali" value="{{ old('kewarganegaraan_wali') }}"required>
                                        @include('alerts.feedback', ['field' => 'kewarganegaraan_wali'])
                                    </div>
                                    <div class="form-group"id="nik_wali *" style="display: block">
                                        <label>{{ __("NIK Wali *") }}</label>
                                        <input type="text" id="nik_wali" name="nik_wali" class="form-control {{ $errors->has('nik_wali') ? ' is-invalid' : '' }}" placeholder="NIK Wali" value="{{ old('nik_wali') }}" required>
                                        @include('alerts.feedback', ['field' => 'nik_wali'])
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __("Agama Wali *") }}</label>
                                        <input type="text" id="agama_wali" name="agama_wali" class="form-control {{ $errors->has('agama_wali') ? ' is-invalid' : '' }}" placeholder="Agama Wali" value="{{ old('agama_wali') }}" required>
                                        @include('alerts.feedback', ['field' => 'agama_wali'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Hubungan Keluarga *") }}</label>
                                        <input type="text" id="hubungan_keluarga" name="hubungan_keluarga" class="form-control {{ $errors->has('hubungan_keluarga') ? ' is-invalid' : '' }}" placeholder="Hubungan Keluarga" value="{{ old('hubungan_keluarga') }}" required>
                                        @include('alerts.feedback', ['field' => 'hubungan_keluarga'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Ijazah Wali *") }}</label>
                                        <input type="text" name="ijazah_wali" class="form-control {{ $errors->has('ijazah_wali') ? ' is-invalid' : '' }}" placeholder="Ijazah Wali" value="{{ old('ijazah_wali') }}">
                                        @include('alerts.feedback', ['field' => 'ijazah_wali'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Pekerjaan Wali *") }}</label>
                                        <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" class="form-control {{ $errors->has('pekerjaan_wali') ? ' is-invalid' : '' }}" placeholder="Pekerjaan Wali" value="{{ old('pekerjaan_wali') }}" required>
                                        @include('alerts.feedback', ['field' => 'pekerjaan_wali'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Penghasilan Wali *") }}</label>
                                        <input type="number" id="penghasilan_wali" name="penghasilan_wali" class="form-control {{ $errors->has('penghasilan_wali') ? ' is-invalid' : '' }}" placeholder="Penghasilan Wali" value="{{ old('penghasilan_wali') }}" required>
                                        @include('alerts.feedback', ['field' => 'penghasilan_wali'])
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __("Alamat Rumah Wali *") }}</label>
                                        <input type="text" id="alamat_rumah_wali" name="alamat_rumah_wali" class="form-control {{ $errors->has('alamat_rumah_wali') ? ' is-invalid' : '' }}" placeholder="Alamat Rumah Wali" value="{{ old('alamat_rumah_wali') }}">
                                        @include('alerts.feedback', ['field' => 'alamat_rumah_wali'])
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __("Nomor Telp Wali *") }}</label>
                                        <input type="text" id="nomor_telp_wali" name="nomor_telp_wali" class="form-control {{ $errors->has('nomor_telp_wali') ? ' is-invalid' : '' }}" placeholder="Nomor Telp Wali" value="{{ old('nomor_telp_wali') }}" required>
                                        @include('alerts.feedback', ['field' => 'nomor_telp_wali'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
    const tipe_riwayat_sekolah = document.getElementById("tipe_riwayat_sekolah");
    const view_pindah = document.getElementById("view_pindah");
    const nama_riwayat_sekolah = document.getElementById("nama_riwayat_sekolah");
    const alasan_pindah = document.getElementById("alasan_pindah");
    const tanggal_pindah = document.getElementById("tanggal_pindah");
    function show_pindah(){
        if (tipe_riwayat_sekolah.value === "1"){
            view_pindah.style.display = "block";
            nama_riwayat_sekolah.value="";
            alasan_pindah.value="";
            tanggal_pindah.value="";

            nama_riwayat_sekolah.setAttribute("required", "");
            alasan_pindah.setAttribute("required", "");
            tanggal_pindah.setAttribute("required", "");
        }else{
            view_pindah.style.display = "none";
            nama_riwayat_sekolah.value="";
            alasan_pindah.value="";
            tanggal_pindah.value="";
            nama_riwayat_sekolah.removeAttribute("required");
            alasan_pindah.removeAttribute("required");
            tanggal_pindah.removeAttribute("required");
        }
    }
    //kurang nomor telepon ayah dan ibu
    const pilih_data_kk = document.getElementById("pilih_data_kk");
    const view_status_orang_tua =document.getElementById("view_status_orang_tua");
    const no_kk = document.getElementById("no_kk");
    const view_kk = document.getElementById("view_kk");
    const view_kk_baru = document.getElementById("view_kk_baru");
    const nama_ayah = document.getElementById("nama_ayah");
    const nama_ibu = document.getElementById("nama_ibu");
    const tempat_lahir_ayah = document.getElementById("tempat_lahir_ayah");
    const tempat_lahir_ibu = document.getElementById("tempat_lahir_ibu");
    const tanggal_lahir_ayah = document.getElementById("tanggal_lahir_ayah");
    const tanggal_lahir_ibu = document.getElementById("tanggal_lahir_ibu");
    const kewarganegaraan_ayah = document.getElementById("kewarganegaraan_ayah");
    const kewarganegaraan_ibu = document.getElementById("kewarganegaraan_ibu");
    const nik_ayah = document.getElementById("nik_ayah");
    const nik_ibu = document.getElementById("nik_ibu");
    const agama_ayah = document.getElementById("agama_ayah");
    const agama_ibu = document.getElementById("agama_ibu");
    const pendidikan_ayah = document.getElementById("pendidikan_ayah");
    const pendidikan_ibu = document.getElementById("pendidikan_ibu");
    const pekerjaan_ayah = document.getElementById("pekerjaan_ayah");
    const pekerjaan_ibu = document.getElementById("pekerjaan_ibu");
    const penghasilan_ayah = document.getElementById("penghasilan_ayah");
    const penghasilan_ibu = document.getElementById("penghasilan_ibu");
    const alamat_rumah_ayah = document.getElementById("alamat_rumah_ayah");
    const alamat_rumah_ibu = document.getElementById("alamat_rumah_ibu");
    const nama_wali = document.getElementById("nama_wali");
    const tempat_lahir_wali = document.getElementById("tempat_lahir_wali");
    const tanggal_lahir_wali = document.getElementById("tanggal_lahir_wali");
    const kewarganegaraan_wali = document.getElementById("kewarganegaraan_wali");
    const nik_wali = document.getElementById("nik_wali");
    const agama_wali = document.getElementById("agama_wali");
    const hubungan_keluarga = document.getElementById("hubungan_keluarga");
    const pekerjaan_wali = document.getElementById("pekerjaan_wali");
    const penghasilan_wali = document.getElementById("penghasilan_wali");
    const alamat_rumah_wali = document.getElementById("alamat_rumah_wali");
    const nomor_telp_wali = document.getElementById("nomor_telp_wali");

    const ayah = [nama_ayah, tempat_lahir_ayah, tanggal_lahir_ayah, kewarganegaraan_ayah, nik_ayah, agama_ayah, pendidikan_ayah, pekerjaan_ayah, penghasilan_ayah, alamat_rumah_ayah];
    const ibu = [nama_ibu, tempat_lahir_ibu, tanggal_lahir_ibu, kewarganegaraan_ibu, nik_ibu, agama_ibu, pendidikan_ibu, pekerjaan_ibu, penghasilan_ibu, alamat_rumah_ibu];
    const wali = [nama_wali, tempat_lahir_wali, tanggal_lahir_wali, kewarganegaraan_wali, nik_wali, agama_wali, hubungan_keluarga, pekerjaan_wali, penghasilan_wali, alamat_rumah_wali, nomor_telp_wali];
    pilih_data_kk.addEventListener("change", show_kk);

    function show_kk(){
        if (pilih_data_kk.value.toLowerCase() === "0"){

            view_kk_baru.style.display = "block";
            view_kk.style.display = "block";
            view_status_orang_tua.style.display = "block";
            for(const item of ayah){
                item.setAttribute("required", "");
            }
            for(const item of ibu){
                item.setAttribute("required", "");
            }
            for(const item of wali){
                item.setAttribute("required", "");
            }
        }else{
            view_kk_baru.style.display = "none";
            view_kk.style.display = "none";
            view_status_orang_tua .style.display = "none";
            no_kk.value = pilih_data_kk.value;
            for(const item of ayah){
                item.removeAttribute("required");
                item.value = "";
            }
            for(const item of ibu){
                item.removeAttribute("required");
                item.value = "";
            }
            for(const item of wali){
                item.removeAttribute("required");
                item.value = "";
            }
        }
    }
</script>
@endpush
