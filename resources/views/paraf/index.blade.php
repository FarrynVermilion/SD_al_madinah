@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Paraf Tata Usaha Index',
    'activePage' => 'Paraf',
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
                        <td scope="col" class="col-1">
                            <h4 class="card-title">Kelas</h4>
                        </td>
                        <td scope="col" class="col-12 text-right w-100 m-auto pull-right">
                            <button popovertarget="popover_paraf_create" type="button" class="btn btn-primary" >Buat Paraf</button>
                        </td>
                        <div popover id="popover_paraf_create">
                            <div style="width: 50em; height: 25em;" >
                                <div class="container w-100 h-100 align-items-center align-content-center justify-content-center bg-secondary">
                                    <form method="post" action="{{route('paraf.store')}}" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Buat Paraf Untuk : {{Auth::user()->name}}</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>{{__("File Paraf")}}</label>
                                                            <div class="custom-file">
                                                                <input type="file" id ="paraf" name="paraf" class="form-control {{ $errors->has('paraf') ? ' is-invalid' : '' }}"   >
                                                                <label id="customFile" class="custom-file-label" for="customFile">Pilih file jpg / png / jpeg / svg</label>
                                                            </div>
                                                            @include('alerts.feedback', ['field' => 'paraf'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-round pull-right">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                  <th>Paraf</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $paraf)
                <tr>
                  <td>{{ $paraf->id_paraf }}</td>
                    <td>
                        <button><a href="{{route('paraf.show', $paraf->id_paraf)}}"><i class="btn btn-primary">Lihat paraf</i></a></button>
                    </td>

                  <td class="text-right">
                    <form action="{{ route('kelas.destroy', $paraf->id_paraf) }}" method="POST" onsubmit="return hapus()">
                      @csrf
                      <input name="_method" type="hidden" value="DELETE">
                      <button type="submit" class="btn btn-danger">
                            Hapus
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center">
              {{ $data->links() }}
            </div>
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

    const fileInput = document.getElementById('paraf');
    const fileNameDisplay = document.getElementById('customFile');
    fileInput.addEventListener('change', (event) => {
        const files = event.target.files;
        if (files.length > 0) {
            const fileName = files[0].name;
            fileNameDisplay.textContent = `File pdf yang dipilih: ${fileName}`;
        } else {
            fileNameDisplay.textContent = 'Pilih file jpg / png / jpeg / svg';
        }
    });
</script>
@endpush
