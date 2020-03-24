@extends('admin.layout')


@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Publicación</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="fas fa-home"></i> Inicio</a></li>
                <li class="breadcrumb-item"><i class="fa fa-list"></i> Posts</li>
                <li class="breadcrumb-item active">Crear</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
     </div><!-- /.container-fluid -->
@stop

@section('content')
@if ($post->photos->count())
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                 {{-- PHOTHOS --}}
                 <div class="row">
                    @foreach($post->photos as $photo)
                        <div class="col-md-2">
                            <form method="POST" action="{{ route('admin.photos.destroy', $photo)}}">
                            {{ method_field('DELETE') }} {{ csrf_field()}}
                                    <button class="btn btn-danger btn-xs" style="position:absolute;"><i class="fa fa-times"></i></button>
                                    <img src="{{ url($photo->url) }} " class="img-fluid" alt="">
                            </form>    
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
     {{ csrf_field() }} {{ method_field('PUT') }}
     <div class="row"> 
         <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header"></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label {{ $errors->has('title') ? 'class=text-danger' : ''}}>Titulo de la publicacion</label>
                            <input
                                type="text"
                                name="title"
                                value="{{ old('title', $post->title /*valor default*/) }}"
                                class="form-control {{ $errors->has('title') ? 'border border-danger' : ''}}"
                                placeholder="Ingresa aqui el titulo de la publicacion"
                                >
                                {!! $errors->first('title', '<span class="form-text text-danger">:message</span>' ) !!}
                        </div>
                        <div class="form-group">
                            <label {{ $errors->has('body') ? 'class=text-danger' : ''}}>Contenido Publicacion</label>
                            <div class="mb-3">
                                <textarea  name="body" class="textarea form-control {{ $errors->has('body') ? 'border border-danger' : ''}}" placeholder="Ingrese el contenido copleto de la publicacion">
                                    {{ old('body',  $post->body /*valor default*/) }}
                                </textarea>
                                {!! $errors->first('body', '<span class="form-text text-danger">:message</span>' ) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label {{ $errors->has('iframe') ? 'class=text-danger' : ''}}>Contenido embebido (iframe)</label>
                            <div class="mb-3">
                                <textarea  rows="2" name="iframe" class="form-control {{ $errors->has('iframe') ? 'border border-danger' : ''}}" placeholder="Ingrese el contenido embebido (iframe) de audio o video">
                                    {{ old('iframe',  $post->iframe /*valor default*/) }}
                                </textarea>
                                {!! $errors->first('iframe', '<span class="form-text text-danger">:message</span>' ) !!}
                            </div>
                        </div>
                  </div>
             </div>
         </div>
         <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="form-group">

                        <label>Fecha de publicacion</label>
      
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                            <input type="date" class="form-control" name="published_at" value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null /*valor default*/)}}">
                        </div>
                        <!-- /.input group -->
                      </div>
                      <div class="form-group">
                          <label {{ $errors->has('category_id') ? 'class=text-danger' : ''}}>Categorias</label>
                          <select class="form-control select2{{ $errors->has('category_id') ? 'border border-danger' : ''}}" name="category_id">
                              <option value="">Selecciona una categoria</option>
                              @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id /*valor default*/) == $category->id ? 'selected' : '' }}
                                >{{ $category->name }}</option>
                              @endforeach
                          </select>
                          {!! $errors->first('category_id', '<span class="form-text text-danger">:message</span>' ) !!}
                      </div>
                      <div class="form-group">
                         <label {{ $errors->has('tags') ? 'class=text-danger' : ''}}>Etiquetas</label> 
                        <select name="tags[]" class="select2 {{ $errors->has('tags') ? 'border border-danger' : ''}}"
                                multiple="multiple"
                                data-placeholder="Selecciona una o mas etiquetas" 
                                style="width: 100%;">
                                @foreach ($tags as $tag )
                                    <!--Usamos collect para almacenar los tags seleccionados en un array-->
                                    <option {{ collect(old('tags', $post->tags->pluck('id') /*valor default*/))->contains($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                          </select>
                          {!! $errors->first('tags', '<span class="form-text text-danger">:message</span>' ) !!}
                      </div>
                      <!-- /.form group -->
                    <div class="form-group">
                        <label {{ $errors->has('excerpt') ? 'class=text-danger' : ''}}>Extracto Publicacion</label>
                        <textarea 
                            name="excerpt" 
                            class="form-control {{ $errors->has('excerpt') ? 'border border-danger' : ''}}"
                            placeholder="Ingrese un extracto de la publicacion">
                            {{ old('excerpt', $post->excerpt /*valor default*/)}}
                        </textarea>
                        {!! $errors->first('excerpt', '<span class="form-text text-danger">:message</span>' ) !!}
                    </div>

                    <div class="form-group">
                        <div class="dropzone"></div>
                    </div>

                    <div class="form-froup">
                        <button type="submit" class="btn-block btn btn-primary">Guardar Publicacion</button>
                    </div>
                </div>
            </div>
         </div>
     </div>
    </form>
@stop

@push('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css">
    <!-- summernote -->
 <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.css">
     <!-- Select2 -->
  <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css"> 
@endpush 

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>

<!-- Summernote -->
<script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Select2 -->
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote({
        height: 388,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true              
    })
  })

 $('.select2').select2({
     tags: true
 });

 const myDropzone = new Dropzone('.dropzone', {
     url: '/admin/posts/{{ $post->url }}/photos',
     paramName: 'photo',
     acceptedFiles: 'image/*',
     maxFilesize: 2, 
    //  maxFiles: 1,
     headers: {
         'X-CSRF-TOKEN': '{{ csrf_token() }}'
     },
     dictDefaultMessage: 'Aarrastra aqui las imagenes'
 });

 myDropzone.on('error', function(file, res){
    const msg = res.errors.photo[0];
    $('.dz-error-message:last > span').text(msg);
 })

 Dropzone.autoDiscover = false;
</script>
@endpush

