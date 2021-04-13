<div class="col-md-4">
    <div class="white">
        <div class="card">
            <div class="card-header bg-primary text-white b-b-light">
                <div class="row justify-content-end">
                    <div class="col">
                        <ul id="myTab4" role="tablist" class="nav nav-tabs card-header-tabs nav-material nav-material-white float-right">
                            <li class="nav-item">
                                <a class="nav-link active show" id="tab1" data-toggle="tab" href="#v-pills-tab1" role="tab" aria-controls="tab1" aria-expanded="true" aria-selected="true">HARI INI</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab2" data-toggle="tab" href="#v-pills-tab2" role="tab" aria-controls="tab2" aria-selected="false">BULAN INI</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body no-p">
                <div class="tab-content">
                    <div class="tab-pane animated fadeIn show active" id="v-pills-tab1" role="tabpanel" aria-labelledby="v-pills-tab1">
                        <div class="bg-primary text-white lighten-2">
                            <div class="pt-2 pb-2 pl-5 pr-5">
                                <h5 class="font-weight-normal s-14">Artikel Dilihat</h5>
                                <span class="s-48 font-weight-lighter text-primary">{{ $todayTotalView->count() }}</span>
                                <div class="float-right">
                                    <span class="icon icon-eye s-48"></span>
                                </div>
                            </div>
                            <canvas width="378" 
                                    height="20" 
                                    data-chart="spark"     
                                    data-chart-type="line"
                                    data-dataset="[[28,530,200,430]]" 
                                    data-labels="['a','b','c','d']"
                                    data-dataset-options="[{ borderColor:  'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235,1)' }]">
                            </canvas>
                        </div>
                        <div class="slimScroll b-b" data-height="245">
                            <div class="table-responsive">
                                <table class="table table-hover earning-box">
                                    <thead class="no-b">
                                        <tr>
                                            <th width="40" class="text-center">No</th>
                                            <th>Judul</th>
                                            <th>Dilihta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($todayTotalView->take(5) as $index => $i)
                                        <tr>
                                            <td class="text-center">{{ $index+1 }}</td>
                                            <td>{{ $i->article->title }}</td>
                                            <td>{{ $i->totalView }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane animated fadeIn" id="v-pills-tab2" role="tabpanel" aria-labelledby="v-pills-tab2">
                        <div class="bg-primary text-white lighten-2">
                            <div class="pt-2 pb-2 pl-5 pr-5">
                                <h5 class="font-weight-normal s-14">Artikel Dilihat</h5>
                                <span class="s-48 font-weight-lighter text-primary">{{ $monthTotalView->count() }}</span>
                                <div class="float-right">
                                    <span class="icon icon-eye s-48"></span>
                                </div>
                            </div>
                            <canvas width="378" 
                                    height="20" 
                                    data-chart="spark"     
                                    data-chart-type="line"
                                    data-dataset="[[28,530,200,430]]" 
                                    data-labels="['a','b','c','d']"
                                    data-dataset-options="[{ borderColor:  'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235,1)' }]">
                            </canvas>
                        </div>
                        <div class="slimScroll b-b" data-height="245">
                            <div class="table-responsive">
                                <table class="table table-hover earning-box">
                                    <thead class="no-b">
                                        <tr>
                                            <th width="40" class="text-center">No</th>
                                            <th>Judul</th>
                                            <th>Dilihat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monthTotalView->take(5) as $index => $i)
                                        <tr>
                                            <td class="text-center">{{ $index+1 }}</td>
                                            <td>{{ $i->article != null ? $i->article->title : '-'}}</td>
                                            <td>{{ $i->totalView }}</td>
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