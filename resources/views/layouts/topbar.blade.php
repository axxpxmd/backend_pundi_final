<div class="has-sidebar-left ">
    <div class="sticky">
        <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
            <div class="relative">
                <div class="d-flex">
                    <div>
                        <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                            <i></i>
                        </a>
                    </div>
                    <div class="row m-t-12">
                        <li type="none" class="mr-1 ml-2 fs-13 text-white">
                            <i class="icon icon-calendar-check-o"></i>
                            <a id="hari"></a>
                            ,
                            <a id="tanggal"></a>
                            <a id="bulan"></a>
                            <a id="tahun"></a>
                            /
                        </li>
                        <li type="none" class="fs-13 text-white">
                            <a id="jam"></a>
                            :
                            <a id="menit"></a>
                            :
                            <a id="detik"></a>
                        </li>
                    </div>
                </div>
            </div>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages -->
                    <li class="dropdown custom-dropdown messages-menu">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <i class="icon-message "></i>
                            <span class="badge badge-success badge-mini rounded-circle">{{ $questions->count() + $consultations->count() }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <ul class="menu pl-2 pr-2">
                                    <!-- message from question -->
                                    <li class="header font-weight-bold bg-light p-1 mt-1">({{ $questions->count() }}) Pertanyaan</li>
                                    @forelse ($questions->take(3) as $i)
                                    <li>
                                        <a href="#">
                                            <div class="avatar float-left mr-3">
                                                <span class="avatar-letter avatar-letter-{{ strtolower(substr($i->name,0,1)) }} circle"></span>
                                            </div>
                                            <h4>
                                                {{ $i->name }}
                                            </h4>
                                            <p class="text-truncate" style="max-width: 250px;">{{ $i->question }}</p>
                                        </a>
                                    </li>
                                    @empty
                                    <p class="text-center s-12">Tidak ada data</p>
                                    @endforelse
                                    @if ($questions->count() > 3)
                                    <li class="footer s-12 text-center"><a href="#" class="text-primary">Lihat Semua +{{ $questions->count() - 3 }}</a></li>
                                    @endif
                                    
                                    <!-- message from consultation -->
                                    <li class="header font-weight-bold bg-light p-1">({{ $consultations->count() }}) Konsultasi</li>
                                    @forelse ($consultations->take(3) as $c)
                                    <li>
                                        <a href="#">
                                            <div class="avatar float-left mr-3">
                                                <span class="avatar-letter avatar-letter-{{ strtolower(substr($c->name,0,1)) }} circle"></span>
                                            </div>
                                            <h4>
                                                {{ $c->name }}
                                            </h4>
                                            <p class="text-truncate" style="max-width: 250px;">{{ $c->consultation }}</p>
                                        </a>
                                    </li>
                                    @empty
                                    <p class="text-center s-12">Tidak ada data</p>
                                    @endforelse
                                    @if ($consultations->count() > 3)
                                    <li class="footer s-12 text-center"><a href="#" class="text-primary">Lihat Semua + {{ $consultations->count() - 3 }}</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- Notifications -->
                    <li class="dropdown custom-dropdown notifications-menu">
                        <a href="#" class=" nav-link" data-toggle="dropdown" aria-expanded="false">
                            <i class="icon-notifications "></i>
                            <span class="badge badge-danger badge-mini rounded-circle">{{ $newUser + $newArticle }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="header text-center text-black font-weight-bold">{{ $newUser + $newArticle }} Pemberitahuan</li>
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="icon icon-data_usage text-success"></i> {{ $newUser }} User baru bulan ini
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon icon-data_usage text-danger"></i> {{ $newArticle }} Artikel baru bulan ini
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown custom-dropdown user user-menu ">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <img height="30" width="30" style="margin-top: -10px" class="rounded-circle img-circular" src="{{ config('app.ftp_src').'images/ava/'.Auth::user()->adminDetail->photo }}" alt="User Image">
                            <i class="icon-more_vert"></i>
                        </a>
                        <div class="dropdown-menu p-4 dropdown-menu-right" style="width:255px">
                            <div class="box justify-content-between">
                                <div class="col">
                                    <a href="{{ route('profile.index') }}">
                                        <i class="icon-user amber-text lighten-2 avatar r-5"></i>
                                        <div class="pt-1">Profil</div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action mt-2"><i class="mr-2 icon-power-off text-danger"></i>Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    // Hours
    window.setTimeout("waktu()", 1000);

    function addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function waktu() {
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        document.getElementById("jam").innerHTML = addZero(waktu.getHours());
        document.getElementById("menit").innerHTML = addZero(waktu.getMinutes());
        document.getElementById("detik").innerHTML = addZero(waktu.getSeconds());
    }

    // Day
    arrHari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"]
    Hari = new Date().getDay();
    document.getElementById("hari").innerHTML = arrHari[Hari];

    // Date
    Tanggal = new Date().getDate();
    document.getElementById("tanggal").innerHTML = Tanggal;

    // Month
    arrbulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    Bulan = new Date().getMonth();
    document.getElementById("bulan").innerHTML = arrbulan[Bulan];

    // Year
    Tahun = new Date().getFullYear();
    document.getElementById("tahun").innerHTML = Tahun;

</script>