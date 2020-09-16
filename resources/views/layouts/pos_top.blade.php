<!-- Navbar -->
<nav class="navbar navbar-expand navbar-dark navbar-indigo">
  
  <ul class="navbar-nav d-flex align-items-baseline">

    <li class="nav-item mr-4">

      <i class="fas fa-user text-white"></i> 
      
      <span class="text-white">User : <span class="ml-1">{{ Auth::user()->u_name }}</span></span>

    </li>

    <li class="nav-item">

      <button class="btn-calculator btn btn-sm btn-light"><i class="fas fa-calculator mr-1"></i> Kalkulator</button>

    </li>

  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto align-items-baseline">

    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">

      <li class="nav-item">

        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        
      </li>

      <li class="nav-item">

        <a class="nav-link btn-fullscreen" onclick="toggleFullScreen(document.body)">

          <i class="fas fa-compress"></i>
        
        </a>

      </li>

      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <a href="#" class="dropdown-item">

          <!-- Message Start -->
          <div class="media">
            
            <img src="" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            
            <div class="media-body">

              <h3 class="dropdown-item-title">
                
                Brad Diesel
                
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              
              </h3>

              <p class="text-sm">Call me whenever you can...</p>
              
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            
            </div>

          </div>
          <!-- Message End -->
        </a>

        <div class="dropdown-divider"></div>

        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>

      </div>

    </li>

    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">

      <a class="nav-link" data-toggle="dropdown" href="#">

        <i class="far fa-bell"></i>

        <span class="badge badge-warning navbar-badge">15</span>

      </a>

      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <span class="dropdown-item dropdown-header">15 Notifications</span>

        <div class="dropdown-divider"></div>

        <a href="#" class="dropdown-item">

          <i class="fas fa-envelope mr-2"></i> 4 new messages

          <span class="float-right text-muted text-sm">3 mins</span>

        </a>

        <div class="dropdown-divider"></div>

        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      
      </div>
    
    </li>
    
  </ul>
  
</nav>
<!-- /.navbar -->