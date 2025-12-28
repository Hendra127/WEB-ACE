@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
  <div class="row g-4">

    <!-- SIDEBAR -->
    <div class="col-lg-3">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
          <h5 class="mb-0">
            <i class="fas fa-cog"></i> Menu Administrasi
          </h5>
        </div>
        <div class="list-group list-group-flush">

          <a href="/admin/dashboard"
             class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $page=='dashboard' ? 'active bg-primary' : '' }}"
             style="{{ $page=='dashboard' ? 'border-left: 4px solid #007bff;' : '' }}">
            <span><i class="fas fa-chart-line me-2"></i>Dashboard</span>
            @if($page=='dashboard')<i class="fas fa-check-circle"></i>@endif
          </a>

          <a href="/admin/aoutus" 
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $page=='aboutus' ? 'active bg-primary' : '' }}"
            style="{{ $page=='aboutus' ? 'border-left: 4px solid #007bff;' : '' }}">
            <span><i class="fas fa-info-circle me-2"></i>Tentang Kami</span>
            @if($page=='aboutus')<i class="fas fa-check-circle"></i>@endif
          </a>

          <a href="/admin/pembina" 
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $page=='pembina' ? 'active bg-primary' : '' }}"
            style="{{ $page=='pembina' ? 'border-left: 4px solid #007bff;' : '' }}">
            <span><i class="fas fa-user-tie me-2"></i>Pembina</span>
            @if($page=='pembina')<i class="fas fa-check-circle"></i>@endif
          </a>

          <a href="/admin/pengurus" 
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $page=='pengurus' ? 'active bg-primary' : '' }}"
            style="{{ $page=='pengurus' ? 'border-left: 4px solid #007bff;' : '' }}">
            <span><i class="fas fa-users me-2"></i>Pengurus</span>
            @if($page=='pengurus')<i class="fas fa-check-circle"></i>@endif
          </a>

          <a href="/admin/galeri"
             class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $page=='galeri' ? 'active bg-primary' : '' }}"
             style="{{ $page=='galeri' ? 'border-left: 4px solid #007bff;' : '' }}">
            <span><i class="fas fa-images me-2"></i>Galeri</span>
            @if($page=='galeri')<i class="fas fa-check-circle"></i>@endif
          </a>

          <a href="/admin/upcoming-event"
             class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $page=='upcoming-event' ? 'active bg-primary' : '' }}"
             style="{{ $page=='upcoming-event' ? 'border-left: 4px solid #007bff;' : '' }}">
            <span><i class="fas fa-calendar-alt me-2"></i>Upcoming Event</span>
            @if($page=='upcoming-event')<i class="fas fa-check-circle"></i>@endif
          </a>

          <a href="/admin/mitrakami"
             class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $page=='mitra' ? 'active bg-primary' : '' }}"
             style="{{ $page=='mitra' ? 'border-left: 4px solid #007bff;' : '' }}">
            <span><i class="fas fa-handshake me-2"></i>Mitra</span>
            @if($page=='mitra')<i class="fas fa-check-circle"></i>@endif
          </a>

          <a href="/admin/lowongan"
             class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $page=='lowongan' ? 'active bg-primary' : '' }}"
             style="{{ $page=='lowongan' ? 'border-left: 4px solid #007bff;' : '' }}">
            <span><i class="fas fa-briefcase me-2"></i>Lowongan</span>
            @if($page=='lowongan')<i class="fas fa-check-circle"></i>@endif
          </a>

        </div>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="col-lg-9">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">
          @includeIf('admin.pages.'.$page)
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
