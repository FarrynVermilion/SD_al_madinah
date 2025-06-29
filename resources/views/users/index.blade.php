@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'users',
    'activePage' => 'users',
    'activeMenu'=>'User'
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
                            <h4 class="card-title">Users</h4>
                        </td>
                        <td scope="col" class="col-12 text-right w-100 m-auto pull-right">
                            <form action="{{ route('cariUser') }}" method="GET">
                                @csrf
                                <input type="text" name="cari" placeholder="Cari User" style="width: 80%; float: left;"class="form-control m-3 p-2" value="{{ request('cari') }}">
                                <button type="submit" class="btn btn-primary btn-round text-white pull-right m-3 p-2" style="width: 10%">Cari</button>
                            </form>
                        </td>
                        <td scope="col" class="col-2">
                            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('register') }}">Add user</a>
                        </td>
                    </tr>
                </table>
            </div>
          </div>

          @include('alerts.errors')
          @include('alerts.success')
          <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Creation date</th>
                  <th class="disabled-sorting text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $users as $user)
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->role}}
                        </td>
                        <td>
                            {{$user->created_at}}
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <form method="GET" action="{{route('user_edit',$user->id)}}">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{route('user.destroy',$user->id)}}" onsubmit="return hapus()">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $users->links() }}</div>
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
