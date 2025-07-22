@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Nominal SPP Index',
    'activePage' => 'Nominal SPP',
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
                        <td>
                            <h4 class="card-title">SPP</h4>
                        </td>
                        <td class="text-right w-auto m-auto pull-right">
                            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('nominal.create') }}">Buat SPP baru</a>
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
                  <th>Nama Bayaran</th>
                  <th>Biaya bayaran</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($data as $nominal_spp)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $nominal_spp->id_nominal}}</td>
                  <td>{{ $nominal_spp->nama_bayaran }}</td>
                  <td>Rp. {{ number_format($nominal_spp->nominal,2,',','.') }}</td>
                  @if ( Auth::user()->role=='Admin')
                    <td class="td-actions text-left">
                        <form method="POST" action="{{route('nominal.destroy',$nominal_spp)}}" onsubmit="return hapus()">
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
