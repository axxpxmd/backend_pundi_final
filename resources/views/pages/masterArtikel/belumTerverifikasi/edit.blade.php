<div class="tab-pane animated fadeInUpShort show" id="edit-data" role="tabpanel">
    <form id="form" action="{{ route('artikel.publish.update', $article->id) }}" method="POST"  enctype="multipart/form-data">
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
            <!-- Arikel -->
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
                        <input type="text" class="form-control text-black mt-3 mb-3" name="title" value="{{ $article->title }}">
                        <textarea name="content" id="editor">{{ $article->content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>