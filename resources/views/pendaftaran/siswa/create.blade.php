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
                        <h5 class="title">{{__(" Daftar siswa")}}</h5>
                    </div>

                    @csrf
                    @include('alerts.errors')
                    @include('alerts.success')
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Email akun")}}</label>
                                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email akun" value="{{ old('email') }}">
                                        @include('alerts.feedback', ['field' => 'email'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Nama lengkap")}}</label>
                                        <input type="text" name="nama_lengkap" class="form-control {{ $errors->has('nama_lengkap') ? ' is-invalid' : '' }}" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}">
                                        @include('alerts.feedback', ['field' => 'nama_lengkap'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Nama panggilan")}}</label>
                                        <input type="text" name="nama_panggilan" class="form-control {{ $errors->has('nama_panggilan') ? ' is-invalid' : '' }}" placeholder="Nama panggilan" value="{{ old('nama_panggilan') }}">
                                        @include('alerts.feedback', ['field' => 'nama_panggilan'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Tempat lahir")}}</label>
                                        <input type="text" name="tempat_lahir" class="form-control {{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" placeholder="Tempat lahir" value="{{ old('tempat_lahir') }}">
                                        @include('alerts.feedback', ['field' => 'tempat_lahir'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Tanggal lahir")}}</label>
                                        <input type="date" name="tanggal_lahir" class="form-control {{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" placeholder="Tanggal lahir" value="{{ old('tanggal_lahir') }}">
                                        @include('alerts.feedback', ['field' => 'tanggal_lahir'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Agama")}}</label>
                                        <input type="text" name="agama" class="form-control {{ $errors->has('agama') ? ' is-invalid' : '' }}" placeholder="Agama" value="{{ old('agama') }}">
                                        @include('alerts.feedback', ['field' => 'agama'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Kewarganegaraan")}}</label>
                                        <input type="text" name="kewarganegaraan" class="form-control {{ $errors->has('kewarganegaraan') ? ' is-invalid' : '' }}" placeholder="Kewarganegaraan" value="{{ old('kewarganegaraan') }}">
                                        @include('alerts.feedback', ['field' => 'kewarganegaraan'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Anak ke")}}</label>
                                        <input type="number" min="0" name="anak_ke" class="form-control {{ $errors->has('anak_ke') ? ' is-invalid' : '' }}" placeholder="Anak ke" value="{{ old('anak_ke') }}">
                                        @include('alerts.feedback', ['field' => 'anak_ke'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Jumlah saudara kandung")}}</label>
                                        <input type="number" min="0" name="jumlah_saudara_kandung" class="form-control {{ $errors->has('jumlah_saudara_kandung') ? ' is-invalid' : '' }}" placeholder="Jumlah saudara kandung" value="{{ old('jumlah_saudara_kandung') }}">
                                        @include('alerts.feedback', ['field' => 'jumlah_saudara_kandung'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Jumlah saudara tiri")}}</label>
                                        <input type="number" min="0" name="jumlah_saudara_tiri" class="form-control {{ $errors->has('jumlah_saudara_tiri') ? ' is-invalid' : '' }}" placeholder="Jumlah saudara tiri" value="{{ old('jumlah_saudara_tiri') }}">
                                        @include('alerts.feedback', ['field' => 'jumlah_saudara_tiri'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Jumlah saudara angkat")}}</label>
                                        <input type="number" min="0" name="jumlah_saudara_angkat" class="form-control {{ $errors->has('jumlah_saudara_angkat') ? ' is-invalid' : '' }}" placeholder="Jumlah saudara angkat" value="{{ old('jumlah_saudara_angkat') }}">
                                        @include('alerts.feedback', ['field' => 'jumlah_saudara_angkat'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Bahasa sehari hari")}}</label>
                                        <input type="Text"  name="bahasa_sehari_hari" class="form-control {{ $errors->has('bahasa_sehari_hari') ? ' is-invalid' : '' }}" placeholder="Bahasa sehari hari" value="{{ old('bahasa_sehari_hari') }}">
                                        @include('alerts.feedback', ['field' => 'bahasa_sehari_hari'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Alamat")}}</label>
                                        <input type="Text"  name="alamat" class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="Alamat" value="{{ old('alamat') }}">
                                        @include('alerts.feedback', ['field' => 'alamat'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Kelurahan")}}</label>
                                        <input type="text"  name="kelurahan" class="form-control {{ $errors->has('kelurahan') ? ' is-invalid' : '' }}" placeholder="Kelurahan" value="{{ old('kelurahan') }}">
                                        @include('alerts.feedback', ['field' => 'kelurahan'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Kecamatan")}}</label>
                                        <input type="text"  name="kecamatan" class="form-control {{ $errors->has('kecamatan') ? ' is-invalid' : '' }}" placeholder="kecamatan" value="{{ old('kecamatan') }}">
                                        @include('alerts.feedback', ['field' => 'kecamatan'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Kota")}}</label>
                                        <input type="text"  name="kota" class="form-control {{ $errors->has('kota') ? ' is-invalid' : '' }}" placeholder="Kota" value="{{ old('kota') }}">
                                        @include('alerts.feedback', ['field' => 'kota'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Kode pos")}}</label>
                                        <input type="text"  name="kode_pos" class="form-control {{ $errors->has('kode_pos') ? ' is-invalid' : '' }}" placeholder="Kode pos" value="{{ old('kode_pos') }}">
                                        @include('alerts.feedback', ['field' => 'kode_pos'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Nomor telepon")}}</label>
                                        <input type="text"  name="nomor_telepon" class="form-control {{ $errors->has('nomor_telepon') ? ' is-invalid' : '' }}" placeholder="Nomor telepon" value="{{ old('nomor_telepon') }}">
                                        @include('alerts.feedback', ['field' => 'nomor_telepon'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Nama pemilik tempat alamat")}}</label>
                                        <input type="text"  name="nama_pemilik_tempat_alamat" class="form-control {{ $errors->has('nama_pemilik_tempat_alamat') ? ' is-invalid' : '' }}" placeholder="Nama pemilik tempat alamat" value="{{ old('nama_pemilik_tempat_alamat') }}">
                                        @include('alerts.feedback', ['field' => 'nama_pemilik_tempat_alamat'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Jarak ke sekolah (dalam km)")}}</label>
                                        <input type="number" min="0"  name="jarak_ke_sekolah" class="form-control {{ $errors->has('jarak_ke_sekolah') ? ' is-invalid' : '' }}" placeholder="Jarak ke sekolah" value="{{ old('jarak_ke_sekolah') }}">
                                        @include('alerts.feedback', ['field' => 'jarak_ke_sekolah'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Riwayat Rawat")}}</label>
                                        <input type="text"  name="riwayat_rawat" class="form-control {{ $errors->has('riwayat_rawat') ? ' is-invalid' : '' }}" placeholder="Riwayat Rawat" value="{{ old('riwayat_rawat') }}">
                                        @include('alerts.feedback', ['field' => 'riwayat_rawat'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Kelainan Jasmani")}}</label>
                                        <input type="text"  name="kelainan_jasmani" class="form-control {{ $errors->has('kelainan_jasmani') ? ' is-invalid' : '' }}" placeholder="Kelainan Jasmani" value="{{ old('kelainan_jasmani') }}">
                                        @include('alerts.feedback', ['field' => 'kelainan_jasmani'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Tinggi Nadan")}}</label>
                                        <input type="number"  name="tinggi_badan" class="form-control {{ $errors->has('tinggi_badan') ? ' is-invalid' : '' }}" placeholder="Tinggi Badan" value="{{ old('tinggi_badan') }}">
                                        @include('alerts.feedback', ['field' => 'tinggi_badan'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Berat Badan")}}</label>
                                        <input type="number"  name="berat_badan" class="form-control {{ $errors->has('berat_badan') ? ' is-invalid' : '' }}" placeholder="Berat Badan" value="{{ old('berat_badan') }}">
                                        @include('alerts.feedback', ['field' => 'berat_badan'])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Nama Sekolah Asal")}}</label>
                                        <input type="text"  name="nama_sekolah_asal" class="form-control {{ $errors->has('nama_sekolah_asal') ? ' is-invalid' : '' }}" placeholder="Nama Sekolah Asal" value="{{ old('nama_sekolah_asal') }}">
                                        @include('alerts.feedback', ['field' => 'nama_sekolah_asal'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Tanggal Ijazah")}}</label>
                                        <input type="date"  name="tanggal_ijazah" class="form-control {{ $errors->has('tanggal_ijazah') ? ' is-invalid' : '' }}" placeholder="Tanggal Ijazah" value="{{ old('tanggal_ijazah') }}">
                                        @include('alerts.feedback', ['field' => 'tanggal_ijazah'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Nomor Ijazah")}}</label>
                                        <input type="text"  name="nomor_ijazah" class="form-control {{ $errors->has('nomor_ijazah') ? ' is-invalid' : '' }}" placeholder="Nomor Ijazah" value="{{ old('nomor_ijazah') }}">
                                        @include('alerts.feedback', ['field' => 'nomor_ijazah'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Tanggal SKHUN")}}</label>
                                        <input type="date"  name="tanggal_skhun" class="form-control {{ $errors->has('tanggal_skhun') ? ' is-invalid' : '' }}" placeholder="Tanggal SKHUN" value="{{ old('tanggal_skhun') }}">
                                        @include('alerts.feedback', ['field' => 'tanggal_skhun'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Nomor SKHUN")}}</label>
                                        <input type="text"  name="nomor_skhun" class="form-control {{ $errors->has('nomor_skhun') ? ' is-invalid' : '' }}" placeholder="Nomor SKHUN" value="{{ old('nomor_skhun') }}">
                                        @include('alerts.feedback', ['field' => 'nomor_skhun'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Lama Belajar")}}</label>
                                        <input type="number"  name="lama_belajar" class="form-control {{ $errors->has('lama_belajar') ? ' is-invalid' : '' }}" placeholder="Lama Belajar" value="{{ old('lama_belajar') }}">
                                        @include('alerts.feedback', ['field' => 'lama_belajar'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" NISN")}}</label>
                                        <input type="text"  name="nisn" class="form-control {{ $errors->has('nisn') ? ' is-invalid' : '' }}" placeholder="NISN" value="{{ old('nisn') }}">
                                        @include('alerts.feedback', ['field' => 'nisn'])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 pr-1">
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
                                </div>
                            </div>
                            <div id="pindah" style="display: none">
                                <div class="row">
                                    <div class="col-md-10 pr-1" >
                                        <div class="form-group">
                                            <label>{{__(" Nama Riwayat Sekolah")}}</label>
                                            <input type="text"  name="nama_riwayat_sekolah" class="form-control {{ $errors->has('nama_riwayat_sekolah') ? ' is-invalid' : '' }}" placeholder="Nama Riwayat Sekolah" value="{{ old('nama_riwayat_sekolah') }}">
                                            @include('alerts.feedback', ['field' => 'nama_riwayat_sekolah'])
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-10 pr-1">
                                        <div class="form-group">
                                            <label>{{__(" Tanggal_Pindah")}}</label>
                                            <input type="date"  name="tanggal_pindah" class="form-control {{ $errors->has('tanggal_pindah') ? ' is-invalid' : '' }}" placeholder="Tanggal Pindah" value="{{ old('tanggal_pindah') }}">
                                            @include('alerts.feedback', ['field' => 'tanggal_pindah'])
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-10 pr-1">
                                        <div class="form-group">
                                            <label>{{__(" Alasan Pindah")}}</label>
                                            <input type="text"  name="alasan_pindah" class="form-control {{ $errors->has('alasan_pindah') ? ' is-invalid' : '' }}" placeholder="Alasan Pindah" value="{{ old('alasan_pindah') }}">
                                            @include('alerts.feedback', ['field' => 'alasan_pindah'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{__(" Data KK")}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" Pilih data kk")}}</label>
                                        <select id ="pilih_data_kk" name="pilih_data_kk" onclick="show_kk()" class="form-control {{ $errors->has('pilih_data_kk') ? ' is-invalid' : '' }}">
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
                                </div>
                            </div>
                            <div class="row" id="kk">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>{{__(" No kk")}}</label>
                                        <input type="text" id="no_kk" name="no_kk" class="form-control {{ $errors->has('no_kk') ? ' is-invalid' : '' }}" placeholder="No kk" value="{{ old('no_kk') }}">
                                        @include('alerts.feedback', ['field' => 'no_kk'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="data_kk_baru" style="display: block">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="title">{{__(" Data orang tua")}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Nama Ayah") }}</label>
                                                    <input type="text" name="nama_ayah" class="form-control {{ $errors->has('nama_ayah') ? ' is-invalid' : '' }}" placeholder="Nama Ayah" value="{{ old('nama_ayah') }}" required>
                                                    @include('alerts.feedback', ['field' => 'nama_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Nama Ibu") }}</label>
                                                    <input type="text" name="nama_ibu" class="form-control {{ $errors->has('nama_ibu') ? ' is-invalid' : '' }}" placeholder="Nama Ibu" value="{{ old('nama_ibu') }}"required>
                                                    @include('alerts.feedback', ['field' => 'nama_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Tempat Lahir Ayah") }}</label>
                                                    <input type="text" name="tempat_lahir_ayah" class="form-control {{ $errors->has('tempat_lahir_ayah') ? ' is-invalid' : '' }}" placeholder="Tempat Lahir Ayah" value="{{ old('tempat_lahir_ayah') }}"required>
                                                    @include('alerts.feedback', ['field' => 'tempat_lahir_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Tempat Lahir Ibu") }}</label>
                                                    <input type="text" name="tempat_lahir_ibu" class="form-control {{ $errors->has('tempat_lahir_ibu') ? ' is-invalid' : '' }}" placeholder="Tempat Lahir Ibu" value="{{ old('tempat_lahir_ibu') }}"required>
                                                    @include('alerts.feedback', ['field' => 'tempat_lahir_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{__(" Tanggal Lahir Ayah")}}</label>
                                                    <input type="date"  name="tanggal_lahir_ayah" class="form-control {{ $errors->has('tanggal_lahir_ayah') ? ' is-invalid' : '' }}" placeholder="Tanggal Lahir Ayah" value="{{ old('tanggal_lahir_ayah') }}"required>
                                                    @include('alerts.feedback', ['field' => 'tanggal_lahir_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{__(" Tanggal Lahir Ibu")}}</label>
                                                    <input type="date"  name="tanggal_lahir_ibu" class="form-control {{ $errors->has('tanggal_lahir_ibu') ? ' is-invalid' : '' }}" placeholder="Tanggal Lahir Ibu" value="{{ old('tanggal_lahir_ibu') }}"required>
                                                    @include('alerts.feedback', ['field' => 'tanggal_lahir_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Kewarganegaraan Ayah") }}</label>
                                                    <input type="text" name="kewarganegaraan_ayah" onfocusout="kwn_ayah()" class="form-control {{ $errors->has('kewarganegaraan_ayah') ? ' is-invalid' : '' }}" placeholder="Kewarganegaraan Ayah" value="{{ old('kewarganegaraan_ayah') }}"required>
                                                    @include('alerts.feedback', ['field' => 'kewarganegaraan_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Kewarganegaraan Ibu") }}</label>
                                                    <input type="text" name="kewarganegaraan_ibu" onfocusout="kwn_ibu()" class="form-control {{ $errors->has('kewarganegaraan_ibu') ? ' is-invalid' : '' }}" placeholder="Kewarganegaraan Ibu" value="{{ old('kewarganegaraan_ibu') }}"required>
                                                    @include('alerts.feedback', ['field' => 'kewarganegaraan_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div id="nik_ayah" style="display: block">
                                            <div class="row">
                                                <div class="col-md-10 pr-1">
                                                    <div class="form-group">
                                                        <label>{{ __("NIK Ayah") }}</label>
                                                        <input type="text" name="nik_ayah" class="form-control {{ $errors->has('nik_ayah') ? ' is-invalid' : '' }}" placeholder="NIK Ayah" value="{{ old('nik_ayah') }} "required>
                                                        @include('alerts.feedback', ['field' => 'nik_ayah'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="nik_ibu" style="display: block">
                                            <div class="row">
                                                <div class="col-md-10 pr-1">
                                                    <div class="form-group">
                                                        <label>{{ __("NIK Ibu") }}</label>
                                                        <input type="text" name="nik_ibu" class="form-control {{ $errors->has('nik_ibu') ? ' is-invalid' : '' }}" placeholder="NIK Ibu" value="{{ old('nik_ibu') }}"required>
                                                        @include('alerts.feedback', ['field' => 'nik_ibu'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Agama Ayah") }}</label>
                                                    <input type="text" name="agama_ayah" class="form-control {{ $errors->has('agama_ayah') ? ' is-invalid' : '' }}" placeholder="Agama Ayah" value="{{ old('agama_ayah') }}"required>
                                                    @include('alerts.feedback', ['field' => 'agama_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Agama Ibu") }}</label>
                                                    <input type="text" name="agama_ibu" class="form-control {{ $errors->has('agama_ibu') ? ' is-invalid' : '' }}" placeholder="Agama Ibu" value="{{ old('agama_ibu') }}"required>
                                                    @include('alerts.feedback', ['field' => 'agama_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Pendidikan Ayah") }}</label>
                                                    <input type="text" name="pendidikan_ayah" class="form-control {{ $errors->has('pendidikan_ayah') ? ' is-invalid' : '' }}" placeholder="Pendidikan Ayah" value="{{ old('pendidikan_ayah') }}"required>
                                                    @include('alerts.feedback', ['field' => 'pendidikan_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Pendidikan Ibu") }}</label>
                                                    <input type="text" name="pendidikan_ibu" class="form-control {{ $errors->has('pendidikan_ibu') ? ' is-invalid' : '' }}" placeholder="Pendidikan Ibu" value="{{ old('pendidikan_ibu') }}"required>
                                                    @include('alerts.feedback', ['field' => 'pendidikan_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Ijazah Ayah") }}</label>
                                                    <input type="text" name="ijazah_ayah" class="form-control {{ $errors->has('ijazah_ayah') ? ' is-invalid' : '' }}" placeholder="Ijazah Ayah" value="{{ old('ijazah_ayah') }}">
                                                    @include('alerts.feedback', ['field' => 'ijazah_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Ijazah Ibu") }}</label>
                                                    <input type="text" name="ijazah_ibu" class="form-control {{ $errors->has('ijazah_ibu') ? ' is-invalid' : '' }}" placeholder="Ijazah Ibu" value="{{ old('ijazah_ibu') }}">
                                                    @include('alerts.feedback', ['field' => 'ijazah_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Pekerjaan Ayah") }}</label>
                                                    <input type="text" name="pekerjaan_ayah" class="form-control {{ $errors->has('pekerjaan_ayah') ? ' is-invalid' : '' }}" placeholder="Pekerjaan Ayah" value="{{ old('pekerjaan_ayah') }}">
                                                    @include('alerts.feedback', ['field' => 'pekerjaan_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Pekerjaan Ibu") }}</label>
                                                    <input type="text" name="pekerjaan_ibu" class="form-control {{ $errors->has('pekerjaan_ibu') ? ' is-invalid' : '' }}" placeholder="Pekerjaan Ibu" value="{{ old('pekerjaan_ibu') }}">
                                                    @include('alerts.feedback', ['field' => 'pekerjaan_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Penghasilan Ayah") }}</label>
                                                    <input type="number" name="penghasilan_ayah" class="form-control {{ $errors->has('penghasilan_ayah') ? ' is-invalid' : '' }}" placeholder="Penghasilan Ayah" value="{{ old('penghasilan_ayah') }}">
                                                    @include('alerts.feedback', ['field' => 'penghasilan_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Penghasilan Ibu") }}</label>
                                                    <input type="number" name="penghasilan_ibu" class="form-control {{ $errors->has('penghasilan_ibu') ? ' is-invalid' : '' }}" placeholder="Penghasilan Ibu" value="{{ old('penghasilan_ibu') }}">
                                                    @include('alerts.feedback', ['field' => 'penghasilan_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Alamat Kerja Ayah") }}</label>
                                                    <input type="text" name="alamat_kerja_ayah" class="form-control {{ $errors->has('alamat_kerja_ayah') ? ' is-invalid' : '' }}" placeholder="Alamat Kerja Ayah" value="{{ old('alamat_kerja_ayah') }}">
                                                    @include('alerts.feedback', ['field' => 'alamat_kerja_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Alamat Kerja Ibu") }}</label>
                                                    <input type="text" name="alamat_kerja_ibu" class="form-control {{ $errors->has('alamat_kerja_ibu') ? ' is-invalid' : '' }}" placeholder="Alamat Kerja Ibu" value="{{ old('alamat_kerja_ibu') }}">
                                                    @include('alerts.feedback', ['field' => 'alamat_kerja_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Alamat Rumah Ayah") }}</label>
                                                    <input type="text" name="alamat_rumah_ayah" class="form-control {{ $errors->has('alamat_rumah_ayah') ? ' is-invalid' : '' }}" placeholder="Alamat Rumah Ayah" value="{{ old('alamat_rumah_ayah') }}">
                                                    @include('alerts.feedback', ['field' => 'alamat_rumah_ayah'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Alamat Rumah Ibu") }}</label>
                                                    <input type="text" name="alamat_rumah_ibu" class="form-control {{ $errors->has('alamat_rumah_ibu') ? ' is-invalid' : '' }}" placeholder="Alamat Rumah Ibu" value="{{ old('alamat_rumah_ibu') }}">
                                                    @include('alerts.feedback', ['field' => 'alamat_rumah_ibu'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Status Hidup") }}</label>
                                                    <input type="text" name="status_hidup" class="form-control {{ $errors->has('status_hidup') ? ' is-invalid' : '' }}" placeholder="Status Hidup" value="{{ old('status_hidup') }}" required>
                                                    @include('alerts.feedback', ['field' => 'status_hidup'])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="title">{{__(" Data wali")}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Nama Wali") }}</label>
                                                    <input type="text" name="nama_wali" class="form-control {{ $errors->has('nama_wali') ? ' is-invalid' : '' }}" placeholder="Nama Wali" value="{{ old('nama_wali') }}">
                                                    @include('alerts.feedback', ['field' => 'nama_wali'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Tempat Lahir Wali") }}</label>
                                                    <input type="text" name="tempat_lahir_wali" class="form-control {{ $errors->has('tempat_lahir_wali') ? ' is-invalid' : '' }}" placeholder="Tempat Lahir Wali" value="{{ old('tempat_lahir_wali') }}">
                                                    @include('alerts.feedback', ['field' => 'tempat_lahir_wali'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{__(" Tanggal Lahir Wali")}}</label>
                                                    <input type="date"  name="tanggal_lahir_wali" class="form-control {{ $errors->has('tanggal_lahir_wali') ? ' is-invalid' : '' }}" placeholder="Tanggal Lahir Wali" value="{{ old('tanggal_lahir_wali') }}">
                                                    @include('alerts.feedback', ['field' => 'tanggal_lahir_wali'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Kewarganegaraan Wali") }}</label>
                                                    <input type="text" name="kewarganegaraan_wali" onfocusout="kwn_wali()" class="form-control {{ $errors->has('kewarganegaraan_wali') ? ' is-invalid' : '' }}" placeholder="Kewarganegaraan Wali" value="{{ old('kewarganegaraan_wali') }}">
                                                    @include('alerts.feedback', ['field' => 'kewarganegaraan_wali'])
                                                </div>
                                            </div>
                                        </div>
                                        <div id="nik_wali" style="display: block">
                                            <div class="row">
                                                <div class="col-md-10 pr-1">
                                                    <div class="form-group">
                                                        <label>{{ __("NIK Wali") }}</label>
                                                        <input type="text" name="nik_wali" class="form-control {{ $errors->has('nik_wali') ? ' is-invalid' : '' }}" placeholder="NIK Wali" value="{{ old('nik_wali') }}">
                                                        @include('alerts.feedback', ['field' => 'nik_wali'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Agama Wali") }}</label>
                                                    <input type="text" name="agama_wali" class="form-control {{ $errors->has('agama_wali') ? ' is-invalid' : '' }}" placeholder="Agama Wali" value="{{ old('agama_wali') }}">
                                                    @include('alerts.feedback', ['field' => 'agama_wali'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Hubungan Keluarga") }}</label>
                                                    <input type="text" name="hubungan_keluarga" class="form-control {{ $errors->has('hubungan_keluarga') ? ' is-invalid' : '' }}" placeholder="Hubungan Keluarga" value="{{ old('hubungan_keluarga') }}">
                                                    @include('alerts.feedback', ['field' => 'hubungan_keluarga'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Ijazah Wali") }}</label>
                                                    <input type="text" name="ijazah_wali" class="form-control {{ $errors->has('ijazah_wali') ? ' is-invalid' : '' }}" placeholder="Ijazah Wali" value="{{ old('ijazah_wali') }}">
                                                    @include('alerts.feedback', ['field' => 'ijazah_wali'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Pekerjaan Wali") }}</label>
                                                    <input type="text" name="pekerjaan_wali" class="form-control {{ $errors->has('pekerjaan_wali') ? ' is-invalid' : '' }}" placeholder="Pekerjaan Wali" value="{{ old('pekerjaan_wali') }}">
                                                    @include('alerts.feedback', ['field' => 'pekerjaan_wali'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Penghasilan Wali") }}</label>
                                                    <input type="number" name="penghasilan_wali" class="form-control {{ $errors->has('penghasilan_wali') ? ' is-invalid' : '' }}" placeholder="Penghasilan Wali" value="{{ old('penghasilan_wali') }}">
                                                    @include('alerts.feedback', ['field' => 'penghasilan_wali'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Alamat Rumah Wali") }}</label>
                                                    <input type="text" name="alamat_rumah_wali" class="form-control {{ $errors->has('alamat_rumah_wali') ? ' is-invalid' : '' }}" placeholder="Alamat Rumah Wali" value="{{ old('alamat_rumah_wali') }}">
                                                    @include('alerts.feedback', ['field' => 'alamat_rumah_wali'])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>{{ __("Nomor Telp Wali") }}</label>
                                                    <input type="text" name="nomor_telp_wali" class="form-control {{ $errors->has('nomor_telp_wali') ? ' is-invalid' : '' }}" placeholder="Nomor Telp Wali" value="{{ old('nomor_telp_wali') }}">
                                                    @include('alerts.feedback', ['field' => 'nomor_telp_wali'])
                                                </div>
                                            </div>
                                        </div>
                                    <div class="card-footer ">
                                        <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
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
    function show_pindah(){
        if (document.getElementById("tipe_riwayat_sekolah").value === "1"){
            document.getElementById("pindah").style.display = "block";
            document.getElementsByName("nama_riwayat_sekolah")[0].value="";
            document.getElementsByName("alasan_pindah")[0].value="";
            document.getElementsByName("tanggal_pindah")[0].value="";

        }else{
            document.getElementById("pindah").style.display = "none";
        }
    }
    function kwn_wali(){
        if (document.getElementsByName("kewarganegaraan_wali")[0].value.toLowerCase() === "indonesia"){
            document.getElementById("nik_wali").style.display = "block";
            document.getElementsByName("nik_wali")[0].value="";
        }else{
            document.getElementById("nik_wali").style.display = "none";
        }
    }
    function kwn_ibu(){
        if (document.getElementsByName("kewarganegaraan_ibu")[0].value.toLowerCase() === "indonesia"){
            document.getElementById("nik_ibu").style.display = "block";
            document.getElementsByName("nik_ibu")[0].value="";
        }else{
            document.getElementById("nik_ibu").style.display = "none";
        }
    }
    function kwn_ayah(){
        if (document.getElementsByName("kewarganegaraan_ayah")[0].value.toLowerCase() === "indonesia"){
            document.getElementById("nik_ayah").style.display = "block";
            document.getElementsByName("nik_ayah")[0].value="";
        }else{
            document.getElementById("nik_ayah").style.display = "none";
        }
    }
    function show_kk(){
        if (document.getElementsByName("pilih_data_kk")[0].value.toLowerCase() === "0"){
            document.getElementById("data_kk_baru").style.display = "block";
            document.getElementById("no_kk").value="";
            document.getElementById("kk").style.display = "block";
        }else{
            document.getElementById("data_kk_baru").style.display = "none";
            document.getElementById("no_kk").value=document.getElementsByName("pilih_data_kk")[0].value;
            document.getElementById("kk").style.display = "none";
        }
    }
</script>
@endpush
