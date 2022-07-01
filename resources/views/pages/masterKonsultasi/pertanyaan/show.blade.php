@extends('layouts.app')
@section('title', '| Data Pertanyaan')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row">
                <div class="col">
                    <h4>
                        <i class="icon icon-question-circle-o"> </i>
                        Menampilkan Pertanyaan
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li>
                        <a class="nav-link" href="{{ route($route.'index') }}"><i class="icon icon-arrow_back"></i>Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-question-circle-o"></i>Pertanyaan</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="tab-content my-3" id="pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="semua-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts.alerts')
                        <div class="card">
                            <h6 class="card-header"><strong>Data Pertanyaan</strong></h6>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Email :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->email }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Nama :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->name }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Isi Pertanyaan :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->question }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Dibaca Oleh :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->readBy->username }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Status dibaca :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->status == 1 ? 'Sudah' : 'Belum' }}</label>
                                    </div>
                                    @if ($data->status == 0)
                                    <div class="row mt-2">
                                        <label class="col-md-2 text-right s-12"></label>
                                        <label class="col-md-10 s-12">
                                            <a href="{{ route('pertanyaan.update-status', $data->id) }}" class="btn btn-sm btn-primary"><i class="icon icon-check"></i>Sudah dibaca</a>
                                        </label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    // 
</script>
@endsection
