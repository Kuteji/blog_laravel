@extends('admin.layout')


@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Todas las publicaciones</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
                <li class="breadcrumb-item active">Posts</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
     </div><!-- /.container-fluid -->
@stop

@section('content')
    <h1>Posts</h1>

     <!-- /.card -->

     <div class="card">
        <div class="card-header">
          <h3 class="card-title">Listado de publicaciones</h3>
          <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i class="i fas fa-plus"></i>  Crear Publicacion</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="posts-table" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Titulo</th>
              <th>Estracto</th>
              <th>Acciones</th>
            </tr>
            </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id}}</td>
                            <td>{{ $post->title}}</td>
                            <td>{{ $post->excerpt}}</td>
                            <td>
                                <a href="{{ route('post.show', $post) }}" target="_blank" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
@stop

@push('styles')
  <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush 

@push('scripts')
<script>
    $(function () {
      $('#posts-table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
  </script>

@endpush