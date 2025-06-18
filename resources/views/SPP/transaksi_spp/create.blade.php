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
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Buat Transaksi SPP siswa")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('transaksi.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @include('alerts.errors')
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Bulan")}}</label>
                            <select name="bulan" class="form-control {{ $errors->has('bulan') ? ' is-invalid' : '' }}">
                                <option value="1"
                                    @if ( old('bulan')=='1')
                                        selected
                                    @endif>
                                    1
                                </option>
                                <option value="2"
                                    @if ( old('bulan')=='2')
                                        selected
                                    @endif>
                                    2
                                </option>
                                <option value="3"
                                    @if ( old('bulan')=='3')
                                        selected
                                    @endif>
                                    3
                                </option>
                                <option value="4"
                                    @if ( old('bulan')=='4')
                                        selected
                                    @endif>
                                    4
                                </option>
                                <option value="5"
                                    @if ( old('bulan')=='5')
                                        selected
                                    @endif>
                                    5
                                </option>
                                <option value="6"
                                    @if ( old('bulan')=='6')
                                        selected
                                    @endif>
                                    6
                                </option>
                            </select>
                            @include('alerts.feedback', ['field' => 'bulan'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Semester")}}</label>
                            <select name="semester" class="form-control {{ $errors->has('semester') ? ' is-invalid' : '' }}">
                                <option value="0"
                                    @if ( old('semester')=='0')
                                        selected
                                    @endif>
                                    Ganjil
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
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
                        </div>
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

</script>
@endpush
