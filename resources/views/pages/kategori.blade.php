@extends('layouts.app')

@section('content')
    @push('style')
        @include('components.styles.datatables')
    @endpush
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Kategori Berita</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Kategori Berita</a></li>
                <li class="breadcrumb-item">Berita</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Kategori Berita</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                @can('create_kategori')
                    <button type="button" class="my-3 btn btn-primary" onclick="create()">Tambah Kategori Berita</button>
                @endcan
                <table class="table table-hover table-striped table-border" id="table"
                >

                    <thead>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </thead>

                    <tbody></tbody>
                </table>
            </div>
          </div>
        </div>
        @include('components.modals.kategori.create')
        @include('components.modals.kategori.edit')
        <!-- /.card -->

      </section>
      <!-- /.content -->
      @push('script')
        @include('components.scripts.datatables')
        @include('components.scripts.sweetalert')
        @include($script)
      @endpush
@endsection
