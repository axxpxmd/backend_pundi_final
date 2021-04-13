<div class="card my-3">
    <div class="card-header white">
        <h6>DASHBOARD</h6>
    </div>
    <div class="card-body p-0">
        <div class="lightSlider" data-item="6" data-item-xl="4" data-item-md="2" data-item-sm="1" data-pause="5000" data-pager="false" data-auto="true" data-loop="true">
            <?php $no = 0;?>
            @foreach ($categoryTotal as $i)
            <?php $no++ ;?>
            @if ($no % 2 == 0)
                <div class="p-5 light">
                    <h5 class="font-weight-normal s-14">{{ $i->n_category }}</h5>
                    <span class="s-48 font-weight-lighter text-primary">{{ $i->totalArtikel }}</span>
                </div>
                @else
                <div class="p-5">
                    <h5 class="font-weight-normal s-14">{{ $i->n_category }}</h5>
                    <span class="s-48 font-weight-lighter amber-text">{{ $i->totalArtikel }}</span>
                </div>
                @endif
            @endforeach
            <div class="p-5">
                <h5 class="font-weight-normal s-14">Konsultasi</h5>
                <span class="s-48 font-weight-lighter amber-text">{{ $consultationTotal }}</span>
            </div>
            <div class="p-5 light">
                <h5 class="font-weight-normal s-14">Pertanyaan</h5>
                <span class="s-48 font-weight-lighter text-primary">{{ $questionTotal }}</span>
            </div>
        </div>
    </div>
</div>
