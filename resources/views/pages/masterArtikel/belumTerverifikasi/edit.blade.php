<div class="tab-pane animated fadeInUpShort show" id="edit-data" role="tabpanel">
    <form id="form" action="{{ route('artikel.publish.update', $article->id) }}" method="POST" class="needs-validation" novalidate  enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-md-3 pr-0">
                <!-- Author -->
                @include('pages.masterArtikel.penulis')
                <!-- Action -->
                <div class="card  mt-2">
                    <div class="card-header white text-center">
                        <strong>AKSI UNTUK ARTIKEL</strong>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <button class="btn btn-sm btn-success mr-1"><i class="icon-save mr-1"></i>Simpan</button>
                            <button class="btn btn-sm btn-secondary">
                                    <a class="text-white" href="{{ route('artikel.publish.index') }}"><i class="icon-arrow_back mr-1"></i>Kembali</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Arikel -->
            <div class="col-md-9">
                <div class="card ">
                    <div class="card-header white text-center">
                        <strong>ARTIKEL</strong>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="editor_id" value="{{ Auth::user()->id }}">
                        <img class="mx-auto d-block img-fluid rounded" width="300"  src="{{ config('app.ftp_src').'/images/artikel/'.$article->image }}" id="preview" alt="photo">
                        <div class="form-row form-inline">
                            <div class="col-md-12">
                                <div class="form-group justify-content-center mt-3">
                                    <input type="file" name="image" id="file" class="input-file" onchange="tampilkanPreview(this,'preview')">
                                    <label for="file" class="btn-tertiary js-labelFile col-md-3">
                                        <i class="icon icon-image mr-2 m-b-1"></i>
                                        <span class="js-fileName">Pilih Gambar</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 ml-3">
                            <label for="source_image" class="fs-14 font-weight-bold">Sumber Gambar</label>
                            <input type="text" name="source_image" class="form-control col-md-12" value="{{ $article->source_image }}" autocomplete="off" required/>
                        </div>
                        <div class="mt-2 ml-3">
                            <label for="title" class="fs-14 font-weight-bold">Judul</label>
                            <input type="text" name="title" class="form-control col-md-12" value="{{ $article->title }}" autocomplete="off" required/>
                        </div>
                        <div class="mt-2 ml-3">
                            <label for="tag" class="fs-14 font-weight-bold">Tagar</label>
                            <input type="text" name="tag" class="form-control col-md-12" value="{{ $article->tag }}" autocomplete="off" required/>
                            <i class="text-danger fs-11">Pisahkan dengan koma</i>
                        </div>
                        <div class="mt-2 ml-3">
                            <label for="content" class="fs-14 font-weight-bold">Isi</label>
                            <textarea name="content" id="editor">{{ $article->content }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        $(this).addClass('was-validated');
    });
</script>