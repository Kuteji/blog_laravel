 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <form method="POST" action="{{ route('admin.posts.store', '#create') }}">
     {{ csrf_field() }}
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Agrega el titulo de la publicacion</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="form-group">
                     {{-- <label {{ $errors->has('title') ? 'class=text-danger' : ''}}>Titulo de la publicacion</label> --}}
                     <input
                         type="text"
                         id="post-title"
                         name="title"
                         value="{{ old('title') }}"
                         class="form-control {{ $errors->has('title') ? 'border border-danger' : ''}}"
                         placeholder="Ingresa aqui el titulo de la publicacion"
                         autofocus
                         required
                         >
                         {!! $errors->first('title', '<span class="form-text text-danger">:message</span>' ) !!}
                 </div>

                

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button class="btn btn-primary">Crear publicacion</button>
             </div>
         </div>
     </div>
 </form>
</div>
@push('scripts')
<script>
    if(window.location.hash === '#create')
    {
      $('#exampleModal').modal('show');
    }
  
    $('#exampleModal').on('hide.bs.modal', function(){
      window.location.hash = '#'
    });
  
    $('#exampleModal').on('shown.bs.modal', function(){
      $('#post-title').focus();
      window.location.hash = '#create'
    });
  </script>
@endpush