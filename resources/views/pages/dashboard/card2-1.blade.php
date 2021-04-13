
<div class="card">
    <div class="card-header white">
        <div class="row justify-content-end">
            <div class="col">
                <ul class="nav nav-tabs card-header-tabs nav-material">
                    <li class="nav-item">
                        <a class="nav-link active show" id="w1-tab1" data-toggle="tab" href="#v-pills-w1-tab1">KESELURUHAN DATA</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body no-p">
        <div class="tab-content">
            <div class="tab-pane animated fadeInRightShort show active" id="v-pills-w1-tab1" role="tabpanel" aria-labelledby="v-pills-w1-tab1">
                <div class="row p-3">
                    <div class="col-md-5 pt-2">
                        @include('pages.dashboard.chart')
                    </div>
                    <div class="col-md-7">
                        <div class="card-body pt-0">
                            <h6></h6>
                            <div class="my-3">
                                <div class="float-right">
                                    <a href="#" class="btn-fab btn-fab-sm btn-primary r-5">
                                        <i class="icon-mail-envelope-closed2 p-0"></i>
                                    </a>
                                    <a href="#" class="btn-fab btn-fab-sm btn-success r-5">
                                        <i class="icon-star p-0"></i>
                                    </a>
                                </div>
                                <div class="mr-3 float-left">
                                    <img src="{{ asset('images/template/logo.png') }}" width="50" alt="">
                                </div>
                                <div>
                                    <strong><a href="http://pundi.or.id/" target="blank">PUNDI.OR.ID</a></strong>
                                </div>
                                <div>
                                    <small>Pegiat Pendidikan Indonesia</small>
                                </div>
                                <div class="table-responsive mt-5">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr class="no-b">
                                            <th></th>
                                            <th>Judul</th>
                                            <th>Dilihat</th>
                                        </tr>
                                        @foreach ($totalView as $index => $i)
                                        <tr>
                                            <td class="text-center">{{ $index+1 }}</td>
                                            <td class="text-uppercase">{{ $i->title }}</td>
                                            <td class="sc-counter">{{ $i->views }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>