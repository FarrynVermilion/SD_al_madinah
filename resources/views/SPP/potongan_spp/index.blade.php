@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Potongan SPP Index',
    'activePage' => 'Potongan SPP',
    'activeMenu' => 'SPP',
])
@section('content')
<div class="panel-header panel-header-sm">
</div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          @include('alerts.errors')
          @include('alerts.success')
          <div class="card-header">
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('potongan.create') }}">Buat SPP baru</a>
            <h4 class="card-title">Potongan</h4>
            <div class="col-12 mt-2"></div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            @csrf
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID</th>
                  <th>Nama Potongan</th>
                  <th>Besar Potongan</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($data as $potongan_spp)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $potongan_spp->id_potongan}}</td>
                  <td>{{ $potongan_spp->nama_potongan }}</td>
                  <td>Rp. {{ number_format($potongan_spp->nominal_potongan,2,',','.') }}</td>
                  @if ( Auth::user()->role=='Admin')
                    <td class="td-actions text-left">
                        <form method="POST" action="{{route('potongan.destroy',$potongan_spp)}}" onsubmit="return hapus()">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-danger" style="width: 12em;"><i class="material-icons">Hapus</i></button>
                        </form>
                    </td>
                  @endif

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
</script>
@endpush
