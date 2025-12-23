@extends('layouts.app')

@section('content')
<div class="row">

  <!-- SIDEBAR -->
  <div class="col-md-3">
    <div class="list-group">

      <a href="/admin/dashboard"
         class="list-group-item {{ $page=='dashboard' ? 'active' : '' }}">
        Dashboard
      </a>

      <a href="/admin/galeri"
         class="list-group-item {{ $page=='galeri' ? 'active' : '' }}">
        Galeri
      </a>

      <a href="/admin/mitra"
         class="list-group-item {{ $page=='mitra' ? 'active' : '' }}">
        Mitra
      </a>

    </div>
  </div>

  <!-- CONTENT -->
  <div class="col-md-9">
    @includeIf('admin.pages.'.$page)
  </div>

</div>
@endsection
