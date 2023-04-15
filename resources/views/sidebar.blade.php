<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{route('homepage')}}">
                <i class="bi bi-grid"></i>
                <span>Genel Tablo</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Veriler</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('sector_operation')}}">
                        <i class="bi bi-circle"></i><span>Bölüme Ameliyat Ekle</span>
                    </a>
                </li>

            </ul>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('sector')}}">
                        <i class="bi bi-circle"></i><span>Bölüm</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('operation')}}">
                        <i class="bi bi-circle"></i><span>Ameliyat</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('surgeon')}}">
                        <i class="bi bi-circle"></i><span>Cerrah</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

    </ul>

</aside>
