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
            <div class="col-12 mt-2">
                <table class="w-100">
                    <tr>
                        <td scope="col" class="col-2">
                            <h4 class="card-title">Siswa</h4>
                        </td>
                        <td scope="col" class="col-13 text-right w-100 m-auto pull-right">
                            <form action="{{ route('pendaftaran_siswa_cari') }}" method="GET">
                                @csrf
                                <input type="text" name="cari" placeholder="Masukan nama siswa" style="width: 80%; float: left;"class="form-control m-3 p-2" value="{{ request('cari') }}">
                                <button type="submit" class="btn btn-primary btn-round text-white pull-left" >cari</button>
                            </form>
                        </td>
                        <td scope="col" class="col-2">
                             <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('siswa.create') }}">Daftar siswa</a>
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
                  <th>Nama siswa</th>
                  <th>Jenis kelamin</th>
                  <th>Tanggal lahir</th>
                  <th>Alamat</th>
                  <th>Nama wali</th>
                  <th>No wali</th>
                  <th>nama_ayah</th>
                  <th>nama_ibu</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $siswa)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $siswa->nama_lengkap }}</td>
                  <td>{{ $siswa->jenis_kelamin == 0? "Laki-laki" :  "Perempuan" }}</td>
                  <td>{{ $siswa->tanggal_lahir }}</td>
                  <td>{{ $siswa->alamat }}</td>
                  <td>{{ $siswa->nama_wali }}</td>
                  <td>{{ $siswa->nomor_telp_wali }}</td>
                  <td>{{ $siswa->nama_ayah }}</td>
                  <td>{{ $siswa->nama_ibu }}</td>
                  <td>
                    <table>
                        <td>
                            <div>
                                <button popovertarget="popover_siswa_{{ $siswa->id }}" type="button" class="btn btn-primary" >Detail siswa</button>
                            </div>
                            <div popover id="popover_siswa_{{ $siswa->id }}" style="width: 50em; height: 25em;overflow-y: scroll;">
                                <div class="card">
                                    <div class="popover-header">
                                        <h3 class="popover-title">Detail Siswa</h3>
                                    </div>
                                    <div class="popover-body">
                                        <div>
                                            <label for="id_account">{{__(" id_account")}}</label>
                                            <p>{{ $siswa->id_account }}</p>
                                        </div>

                                        <div>
                                            <label for="nama_lengkap">{{__(" nama_lengkap")}}</label>
                                            <p>{{ $siswa->nama_lengkap }}</p>
                                        </div>

                                        <div>
                                            <label for="nama_panggilan">{{__(" nama_panggilan")}}</label>
                                            <p>{{ $siswa->nama_panggilan }}</p>
                                        </div>

                                        <div>
                                            <label for="jenis_kelamin">{{__(" jenis_kelamin")}}</label>
                                            <p>{{ $siswa->jenis_kelamin == 0? "Laki-laki" :  "Perempuan" }}</p>
                                        </div>

                                        <div>
                                            <label for="tempat_lahir">{{__(" tempat_lahir")}}</label>
                                            <p>{{ $siswa->tempat_lahir }}</p>
                                        </div>

                                        <div>
                                            <label for="tanggal_lahir">{{__(" tanggal_lahir")}}</label>
                                            <p>{{ $siswa->tanggal_lahir }}</p>
                                        </div>
                                        <div>
                                            <label for="agama">{{__(" agama")}}</label>
                                            <p>{{ $siswa->agama }}</p>
                                        </div>
                                        <div>
                                            <label for="kewarganegaraan">{{__(" kewarganegaraan")}}</label>
                                            <p>{{ $siswa->kewarganegaraan }}</p>
                                        </div>
                                        <div>
                                            <label for="anak_ke">{{__(" anak_ke")}}</label>
                                            <p>{{ $siswa->anak_ke }}</p>
                                        </div>
                                        <div>
                                            <label for="jumlah_saudara_kandung">{{__(" jumlah_saudara_kandung")}}</label>
                                            <p>{{ $siswa->jumlah_saudara_kandung }}</p>
                                        </div>
                                        <div>
                                            <label for="jumlah_saudara_tiri">{{__(" jumlah_saudara_tiri")}}</label>
                                            <p>{{ $siswa->jumlah_saudara_tiri }}</p>
                                        </div>
                                        <div>
                                            <label for="jumlah_saudara_angkat">{{__(" jumlah_saudara_angkat")}}</label>
                                            <p>{{ $siswa->jumlah_saudara_angkat }}</p>
                                        </div>
                                        <div>
                                            <label for="status_anak">{{__(" status_anak")}}</label>
                                            <p>{{ $siswa->status_anak }}</p>
                                        </div>
                                        <div>
                                            <label for="bahasa_sehari_hari">{{__(" bahasa_sehari_hari")}}</label>
                                            <p>{{ $siswa->bahasa_sehari_hari }}</p>
                                        </div>
                                        <div>
                                            <label for="alamat">{{__(" alamat")}}</label>
                                            <p>{{ $siswa->alamat }}</p>
                                        </div>
                                        <div>
                                            <label for="NO_KK">{{__(" NO_KK")}}</label>
                                            <p>{{ $siswa->NO_KK }}</p>
                                        </div>
                                        <div>
                                            <label for="kelurahan">{{__(" kelurahan")}}</label>
                                            <p>{{ $siswa->kelurahan }}</p>
                                        </div>
                                        <div>
                                            <label for="kecamatan">{{__(" kecamatan")}}</label>
                                            <p>{{ $siswa->kecamatan }}</p>
                                        </div>
                                        <div>
                                            <label for="kota">{{__(" kota")}}</label>
                                            <p>{{ $siswa->kota }}</p>
                                        </div>
                                        <div>
                                            <label for="kode_pos">{{__(" kode_pos")}}</label>
                                            <p>{{ $siswa->kode_pos }}</p>
                                        </div>
                                        <div>
                                            <label for="nomor_telepon">{{__(" nomor_telepon")}}</label>
                                            <p>{{ $siswa->nomor_telepon }}</p>
                                        </div>
                                        <div>
                                            <label for="tempat_alamat">{{__(" tempat_alamat")}}</label>
                                            <p>
                                                @switch($siswa->tempat_alamat)
                                                    @case(0)
                                                        Milik
                                                        @break
                                                    @case(1)
                                                        Sewa
                                                        @break
                                                    @default
                                                        Tidak ada
                                                        @break
                                                @endswitch
                                            </p>
                                        </div>
                                        <div>
                                            <label for="nama_pemilik_tempat_alamat">{{__(" nama_pemilik_tempat_alamat")}}</label>
                                            <p>{{ $siswa->nama_pemilik_tempat_alamat }}</p>
                                        </div>
                                        <div>
                                            <label for="jarak_ke_sekolah">{{__(" jarak_ke_sekolah")}}</label>
                                            <p>{{ $siswa->jarak_ke_sekolah }}</p>
                                        </div>
                                        <div>
                                            <label for="metode_transportasi">{{__(" metode_transportasi")}}</label>
                                            <p>
                                                @switch($siswa->metode_transportasi)
                                                    @case(0)
                                                        Antar
                                                        @break
                                                    @case(1)
                                                        Sendiri
                                                        @break
                                                    @default
                                                        Tidak ada
                                                        @break
                                                @endswitch
                                            </p>
                                        </div>
                                        <div>
                                            <label for="golongan_darah">{{__(" golongan_darah")}}</label>
                                            <p>{{ $siswa->golongan_darah }}</p>
                                        </div>
                                        <div>
                                            <label for="riwayat_rawat">{{__(" riwayat_rawat")}}</label>
                                            <p>{{ $siswa->riwayat_rawat }}</p>
                                        </div>
                                        <div>
                                            <label for="riwayat_penyakit">{{__(" riwayat_penyakit")}}</label>
                                            <p>
                                                @switch($siswa->riwayat_penyakit)
                                                    @case(0)
                                                        Tidak ada
                                                        @break
                                                    @case(1)
                                                        Ada
                                                        @break
                                                    @default
                                                        Tidak ada
                                                        @break
                                                @endswitch
                                            </p>
                                        </div>
                                        <div>
                                            <label for="kelainan_jasmani">{{__(" kelainan_jasmani")}}</label>
                                            <p>{{ $siswa->kelainan_jasmani }}</p>
                                        </div>
                                        <div>
                                            <label for="tinggi_badan">{{__(" tinggi_badan")}}</label>
                                            <p>{{ $siswa->tinggi_badan }}</p>
                                        </div>
                                        <div>
                                            <label for="berat_badan">{{__(" berat_badan")}}</label>
                                            <p>{{ $siswa->berat_badan }}</p>
                                        </div>
                                        <div>
                                            <label for="nama_sekolah_asal">{{__(" nama_sekolah_asal")}}</label>
                                            <p>{{ $siswa->nama_sekolah_asal }}</p>
                                        </div>
                                        <div>
                                            <label for="tanggal_ijazah">{{__(" tanggal_ijazah")}}</label>
                                            <p>{{ $siswa->tanggal_ijazah }}</p>
                                        </div>
                                        <div>
                                            <label for="nomor_ijazah">{{__(" nomor_ijazah")}}</label>
                                            <p>{{ $siswa->nomor_ijazah }}</p>
                                        </div>
                                        <div>
                                            <label for="tanggal_skhun">{{__(" tanggal_skhun")}}</label>
                                            <p>{{ $siswa->tanggal_skhun }}</p>
                                        </div>
                                        <div>
                                            <label for="nomor_skhun">{{__(" nomor_skhun")}}</label>
                                            <p>{{ $siswa->nomor_skhun }}</p>
                                        </div>
                                        <div>
                                            <label for="lama_belajar">{{__(" lama_belajar")}}</label>
                                            <p>{{ $siswa->lama_belajar }}</p>
                                        </div>
                                        <div>
                                            <label for="nisn">{{__(" nisn")}}</label>
                                            <p>{{ $siswa->nisn }}</p>
                                        </div>
                                        <div>
                                            <label for="tipe_riwayat_sekolah">{{__(" tipe_riwayat_sekolah")}}</label>
                                            <p>{{ $siswa->tipe_riwayat_sekolah }}</p>
                                        </div>
                                        <div>
                                            <label for="nama_riwayat_sekolah">{{__(" nama_riwayat_sekolah")}}</label>
                                            <p>{{ $siswa->nama_riwayat_sekolah }}</p>
                                        </div>
                                        <div>
                                            <label for="tanggal_pindah">{{__(" tanggal_pindah")}}</label>
                                            <p>{{ $siswa->tanggal_pindah }}</p>
                                        </div>
                                        <div>
                                            <label for="alasan_pindah">{{__(" alasan_pindah")}}</label>
                                            <p>{{ $siswa->alasan_pindah }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <button popovertarget="popover_wali_{{ $siswa->id }}" type="button" class="btn btn-primary" >Detail wali</button>
                            </div>
                            <div popover id="popover_wali_{{ $siswa->id }}" style="width: 50em; height: 25em;overflow-y: scroll;">
                                <table>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="nama_ayah">{{__(" Status hidup")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->status_hidup }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-12" colspan="2">
                                            <h4 class="card-title">Detail ayah</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="nama_ayah">{{__(" nama_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->nama_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="tempat_lahir_ayah">{{__(" tempat_lahir_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->tempat_lahir_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="tanggal_lahir_ayah">{{__(" tanggal_lahir_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->tanggal_lahir_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="nik_ayah">{{__(" nik_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->nik_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="agama_ayah">{{__(" agama_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->agama_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="kewarganegaraan_ayah">{{__(" kewarganegaraan_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->kewarganegaraan_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="pendidikan_ayah">{{__(" pendidikan_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->pendidikan_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="ijazah_ayah">{{__(" ijazah_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->ijazah_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="pekerjaan_ayah">{{__(" pekerjaan_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->pekerjaan_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="alamat_kerja_ayah">{{__(" alamat_kerja_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->alamat_kerja_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="penghasilan_ayah">{{__(" penghasilan_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->penghasilan_ayah }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="alamat_rumah_ayah">{{__(" alamat_rumah_ayah")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->alamat_rumah_ayah }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td scope="col" class="col-12" colspan="2">
                                            <h4 class="card-title">Detail ibu</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="nama_ibu">{{__(" nama_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->nama_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="tempat_lahir_ibu">{{__(" tempat_lahir_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->tempat_lahir_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="tanggal_lahir_ibu">{{__(" tanggal_lahir_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->tanggal_lahir_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="nik_ibu">{{__(" nik_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->nik_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="agama_ibu">{{__(" agama_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->agama_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="kewarganegaraan_ibu">{{__(" kewarganegaraan_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->kewarganegaraan_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="pendidikan_ibu">{{__(" pendidikan_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->pendidikan_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="ijazah_ibu">{{__(" ijazah_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->ijazah_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="pekerjaan_ibu">{{__(" pekerjaan_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->pekerjaan_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="alamat_kerja_ibu">{{__(" alamat_kerja_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->alamat_kerja_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="penghasilan_ibu">{{__(" penghasilan_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->penghasilan_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="alamat_rumah_ibu">{{__(" alamat_rumah_ibu")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->alamat_rumah_ibu }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-12" colspan="2">
                                            <h4 class="card-title">Detail wali</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="nama_wali">{{__(" nama_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->nama_wali }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="tempat_lahir_wali">{{__(" tempat_lahir_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->tempat_lahir_wali }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="tanggal_lahir_wali">{{__(" tanggal_lahir_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->tanggal_lahir_wali }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="nik_wali">{{__(" nik_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->nik_wali }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="agama_wali">{{__(" agama_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->agama_wali }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="kewarganegaraan_wali">{{__(" kewarganegaraan_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->kewarganegaraan_wali }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="hubungan_keluarga">{{__(" hubungan_keluarga")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->hubungan_keluarga }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="ijazah_wali">{{__(" ijazah_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->ijazah_wali }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="pekerjaan_wali">{{__(" pekerjaan_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->pekerjaan_wali }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="penghasilan_wali">{{__(" penghasilan_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->penghasilan_wali }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="alamat_rumah_wali">{{__(" alamat_rumah_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->alamat_rumah_wali }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="col-2">
                                            <label for="nomor_telp_wali">{{__(" nomor_telp_wali")}}</label>
                                        </td>
                                        <td scope="col" class="col-10">
                                            <p>{{ $siswa->nomor_telp_wali }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        {{-- <tr>
                            <td class="td-actions text-left">
                                <a href="{{ route('siswa.edit', $siswa->id) }}">
                                    <i class="material-icons">edit siswa</i>
                                </a>
                            </td>
                            <td class="td-actions text-left">
                                <a href="{{ route('wali.edit', $siswa->id) }}">
                                    <i class="material-icons">edit wali</i>
                                </a>
                            </td>
                            <td class="td-actions text-left">
                                <a href="{{ route('wali.edit', $siswa->id) }}">
                                    <i class="material-icons">show</i>
                                </a>
                            </td> --}}
                            <td class="td-actions text-left">
                                <form method="POST" action="{{route('siswa.destroy',$siswa->id)}}" onsubmit="return hapus()">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger" style="width: 12em;"><i class="material-icons">Hapus</i></button>
                                </form>
                            </td>
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
