<div class="container-fluid relative animatedParent animateOnce">
    <div class="tab-content" id="v-pills-tabContent">
        <div class="card-header white no-b mt-3">
            <h6>DATA ARTIKEL</h6>
        </div>
        <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
            <div class="row my-2">
                <div class="col-md-3">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-4">
                            <div class="float-right">
                                <span class="icon icon-user-circle-o amber-text s-48"></span>
                            </div>
                            <div class="counter-title">User</div>
                            <h5 class="mt-3 sc-counter">{{ $userTotal }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-4">
                            <div class="float-right">
                                <span class="icon icon-comments blue-text s-48"></span>
                            </div>
                            <div class="counter-title ">Komen</div>
                            <h5 class="mt-3 sc-counter">{{ $commentTotal }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-4">
                            <div class="float-right">
                                <span class="icon icon-document2 green-text s-48"></span>
                            </div>
                            <div class="counter-title">Total Artikel</div>
                            <h5 class="mt-3 sc-counter">{{ $totalArticle }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-4">
                            <div class="float-right">
                                <span class="icon icon-eye red-text s-48"></span>
                            </div>
                            <div class="counter-title">Total View</div>
                            <h5 class="sc-counter mt-3">{{ $totalViewAll }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>