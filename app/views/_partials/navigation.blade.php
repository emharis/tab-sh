<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container"> 
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </a>
            <a class="brand" href="index.html">.: eTAB - Sistem Tabungan Sekolah :. SDI Sabilil Huda </a>
            <div class="nav-collapse">
                
            </div>
            <!--/.nav-collapse --> 
        </div>
        <!-- /container --> 
    </div>
    <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
    <div class="subnavbar-inner">
        <div class="container">
            <ul class="mainnav">
                <li class="{{ Request::is('home*') ? 'active' : '' }}" ><a href="{{ URL::route('home.index') }}"><i class="icon-home"></i><span>HOME</span> </a> </li>
                <li class="{{ Request::is('master*') ? 'active dropdown' : 'dropdown' }}" ><a href="{{ URL::route('master.akun.index') }}"> <i class="icon-briefcase"></i><span>DAFTAR AKUN</span></a>
                </li>
<!--                <li class="{{ Request::is('master*') ? 'active dropdown' : 'dropdown' }}" ><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-folder-open"></i><span>MASTER</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('master.akun.index') }}">Profil</a></li>
                        <li><a href="{{ URL::route('master.akun.index') }}">Data Akun Siswa</a></li>
                    </ul>
                </li>-->
                <!--<li class="{{ Request::is('*debet*') ? 'active' : '' }}" ><a href="{{ URL::route('transaksi.debet.index') }}"><i class="icon-money"></i><span>TRANSAKSI</span> </a> </li>-->
                <li class="{{ Request::is('transaksi*') ? 'active dropdown' : 'dropdown' }}" ><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-money"></i><span>TRANSAKSI</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('transaksi.bayar.index') }}">DEBET</a></li>
                        <li><a href="{{ URL::route('transaksi.kredit.index') }}">KREDIT</a></li>
                    </ul>
                </li>
                <!--<li class="{{ Request::is('*tutup') ? 'active' : '' }}" ><a href="{{ URL::route('transaksi.tutup.index') }}"><i class="icon-bolt"></i><span>TUTUP BUKU</span> </a> </li>-->
                <li class="{{ Request::is('rekap*') ? 'active' : '' }}"><a href="{{ URL::route('rekap.rekap.index') }}"><i class="icon-list-alt"></i><span>REKAP</span> </a> </li>
                <!--<li class="{{ Request::is('setting*') ? 'active' : '' }}"><a href="{{ URL::route('rekap.rekap.index') }}"><i class="icon-cogs"></i><span>SETTING</span> </a> </li>-->
                <li ><a class="btn-logout" href="{{ URL::to('login/logout') }}"><i class="icon-off" style="color: #DB613B;"></i><span style="color: #DB613B;">KELUAR</span> </a> </li>
                <li><a href="charts.html"><span></span> </a> </li>
            </ul>
        </div>
        <!-- /container --> 
    </div>
    <!-- /subnavbar-inner --> 
</div>