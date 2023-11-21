 <div id="sidebar" class="active">
     <div class="sidebar-wrapper active" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
         <div class="sidebar-header">
             <div class="d-flex justify-content-between">
                 <div class="logo">
                     <a href="#!"><img src="{{ asset('Front/img/jakilat_logo.png') }}"
                             style="width: 8rem; height: auto;" alt="Logo" srcset=""></a>
                 </div>
                 <div class="toggler">
                     <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                 </div>
             </div>
         </div>
         <div class="sidebar-menu">
             <ul class="menu">

                 @if (Auth::user()->role_id == 1)
                     <li class="sidebar-item {{ request()->routeIs('admin.HalamanDashboard*') ? 'active' : '' }}">
                         <a href="{{ route('admin.HalamanDashboard') }}" class='sidebar-link'>
                             <i class="bi bi-grid-fill"></i>
                             <span>Dashboard</span>
                         </a>
                     </li>
                     {{-- <li class="sidebar-item {{ request()->routeIs('admin.HalamanSlider*') ? 'active' : '' }}">
                         <a href="{{ route('admin.HalamanSlider') }}" class='sidebar-link'>
                             <i class="bi bi-back"></i>
                             <span>Slider</span>
                         </a>
                     </li> --}}
                     {{-- <li class="sidebar-item {{ request()->routeIs('admin.HalamanKategori*') ? 'active' : '' }}">
                         <a href="{{ route('admin.HalamanKategori') }}" class='sidebar-link'>
                             <i class="bi bi-view-stacked"></i>
                             <span>Kategori</span>
                         </a>
                     </li> --}}
                     <li class="sidebar-item {{ request()->routeIs('admin.HalamanPengguna*') ? 'active' : '' }}">
                         <a href="{{ route('admin.HalamanPengguna') }}" class='sidebar-link'>
                             <i class="bi bi-people-fill"></i>
                             <span>Pengguna</span>
                         </a>
                     </li>
                     {{-- <li class="sidebar-item {{ request()->routeIs('admin.HalamanTransaksi*') ? 'active' : '' }}">
                         <a href="{{ route('admin.HalamanTransaksi') }}" class='sidebar-link'>
                             <i class="bi bi-journal-check"></i>
                             <span>Transaksi</span>
                         </a>
                     </li> --}}
                     <li class="sidebar-item {{ request()->routeIs('admin.HalamanBilling*') ? 'active' : '' }}">
                         <a href="{{ route('admin.HalamanBilling') }}" class='sidebar-link'>
                             <i class="bi bi-list-check"></i>
                             <span>Billing</span>
                         </a>
                     </li>
                     <li class="sidebar-item {{ request()->routeIs('admin.HalamanLaporanKeuangan*') ? 'active' : '' }}">
                         <a href="{{ route('admin.HalamanLaporanKeuangan') }}" class='sidebar-link'>
                             <i class="bi bi-menu-button-wide"></i>
                             <span>Laporan Keuangan</span>
                         </a>
                     </li>
                 @elseif(Auth::user()->role_id == 2)
                     <li
                         class="sidebar-item {{ request()->routeIs('lembaga.HalamanInformasiPengguna*') ? 'active' : '' }}">
                         <a href="{{ route('lembaga.HalamanInformasiPengguna') }}" class='sidebar-link'>
                             <i class="bi bi-person-badge-fill"></i>
                             <span>Informasi Pengguna</span>
                         </a>
                     </li>
                     <li
                         class="sidebar-item {{ request()->routeIs('lembaga.HalamanSosialMediaLKP*') ? 'active' : '' }}">
                         <a href="{{ route('lembaga.HalamanSosialMediaLKP') }}" class='sidebar-link'>
                             <i class="bi bi-people-fill"></i>
                             <span>Sosial Media</span>
                         </a>
                     </li>
                     <li class="sidebar-item {{ request()->routeIs('lembaga.HalamanPromosiLKP*') ? 'active' : '' }}">
                         <a href="{{ route('lembaga.HalamanPromosiLKP') }}" class='sidebar-link'>
                             <i class="bi bi-card-image"></i>
                             <span>Iklan</span>
                         </a>
                     </li>
                 @elseif(Auth::user()->role_id == 3)
                     <li
                         class="sidebar-item {{ request()->routeIs('entrepreneur.HalamanInformasiPenggunaEntrepreneur*') ? 'active' : '' }}">
                         <a href="{{ route('entrepreneur.HalamanInformasiPenggunaEntrepreneur') }}"
                             class='sidebar-link'>
                             <i class="bi bi-person-badge-fill"></i>
                             <span>Informasi Pengguna</span>
                         </a>
                     </li>
                     <li
                         class="sidebar-item {{ request()->routeIs('entrepreneur.HalamanSosialMediaPengguna*') ? 'active' : '' }}">
                         <a href="{{ route('entrepreneur.HalamanSosialMediaPengguna') }}" class='sidebar-link'>
                             <i class="bi bi-people-fill"></i>
                             <span>Sosial Media</span>
                         </a>
                     </li>
                     <li
                         class="sidebar-item {{ request()->routeIs('entrepreneur.HalamanProdukPengguna*') ? 'active' : '' }}">
                         <a href="{{ route('entrepreneur.HalamanProdukPengguna') }}" class='sidebar-link'>
                             <i class="bi bi-card-image"></i>
                             <span>Produk</span>
                         </a>
                     </li>
                     <li
                         class="sidebar-item {{ request()->routeIs('entrepreneur.HalamanBillingPengguna*') ? 'active' : '' }}">
                         <a href="{{ route('entrepreneur.HalamanBillingPengguna') }}" class='sidebar-link'>
                             <i class="bi bi-card-image"></i>
                             <span>Billing</span>
                         </a>
                     </li>
                 @endif
                 <li class="sidebar-item {{ request()->routeIs('LogoutPengguna*') ? 'active' : '' }}">
                     <a href="{{ route('LogoutPengguna') }}" class='sidebar-link'>
                         <i class="bi bi-arrow-left-square-fill"></i>
                         <span>Keluar</span>
                     </a>
                 </li>
             </ul>
         </div>

         <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
     </div>
 </div>
