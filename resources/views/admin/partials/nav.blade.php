<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
         <li class="nav-item">
            <a href="{{ route('dashboard')}}" class="nav-link  {{ request()->is('admin') ? 'active' : ''}}">
              <i class="fa fa-home nav-icon"></i>
              <p>Inicio</p>
            </a>
          </li>    
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-bars nav-icon"></i>
        <p>
          Blog
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->is('admin/posts') ? 'active' : ''}}">
            <i class="fa fa-eye nav-icon"></i>
            <p>Ver todos los post</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="#" 
                data-toggle="modal"
                data-target="#exampleModal"
                class="nav-link"
                >
              <i class="fas fa-pen nav-icon"></i>
              <p>Crear un post</p>
            </a>
          </li>
      </ul>
    </li>
    {{-- <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Simple Link
          <span class="right badge badge-danger">New</span>
        </p>
      </a>
    </li> --}}
  </ul>