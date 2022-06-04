
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/fa6267ab13.js" crossorigin="anonymous"></script>

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">  
  
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- bootstrap -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

  <!-- angular -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.9/angular.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-route/1.7.9/angular-route.js"></script>

  <!-- angular -->
  <!--  -->

@yield('top_script')

  <!-- Daterange picker -->
  <style>

body{
    margin: 0;
    padding: 0;

}

    /* card css */

    .card {
    background-color: #fff;
    border-radius: 10px;
    border: none;
    position: relative;
    margin-bottom: 30px;
    box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,0.1), 0 0.9375rem 1.40625rem rgba(90,97,105,0.1), 0 0.25rem 0.53125rem rgba(90,97,105,0.12), 0 0.125rem 0.1875rem rgba(90,97,105,0.1);
}
.l-bg-cherry {
    background: linear-gradient(to right, #493240, #f09) !important;
    color: #fff;
}

.l-bg-blue-dark {
    background: linear-gradient(to right, #373b44, #4286f4) !important;
    color: #fff;
}

.l-bg-green-dark {
    background: linear-gradient(to right, #0a504a, #38ef7d) !important;
    color: #fff;
}

.l-bg-orange-dark {
    background: linear-gradient(to right, #a86008, #ffba56) !important;
    color: #fff;
}

.l-bg-purple-dark {
    background: linear-gradient(to right, #a86008, #ede6ec) !important;
    color: #fff;
}

.card .card-statistic-3 .card-icon-large .fas, .card .card-statistic-3 .card-icon-large .far, .card .card-statistic-3 .card-icon-large .fab, .card .card-statistic-3 .card-icon-large .fal {
    font-size: 110px;
}

.card .card-statistic-3 .card-icon {
    text-align: center;
    line-height: 50px;
    margin-left: 15px;
    color: #000;
    position: absolute;
    right: -5px;
    top: 20px;
    opacity: 0.1;
}

.l-bg-cyan {
    background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
    color: #fff;
}

.l-bg-green {
    background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
    color: #fff;
}

.l-bg-orange {
    background: linear-gradient(to right, #f9900e, #ffba56) !important;
    color: #fff;
}

.l-bg-cyan {
    background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
    color: #fff;
}

    /* card css end  */
          @media (min-width: 1025px) {
      .h-custom {
      height: 100vh !important;
      }
      }
      .card-registration .select-input.form-control[readonly]:not([disabled]) {
      font-size: 1rem;
      line-height: 2.15;
      padding-left: .75em;
      padding-right: .75em;
      }
      .card-registration .select-arrow {
      top: 13px;
      }

      .gradient-custom-2 {
      /* fallback for old browsers */
      background: #a1c4fd;

      /* Chrome 10-25, Safari 5.1-6 */
      background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
      background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
      }

      .bg-indigo {
      background-color: #4835d4;
      }
      @media (min-width: 992px) {
      .card-registration-2 .bg-indigo {
      border-top-right-radius: 15px;
      border-bottom-right-radius: 15px;
      }
      }
      @media (max-width: 991px) {
      .card-registration-2 .bg-indigo {
      border-bottom-left-radius: 15px;
      border-bottom-right-radius: 15px;
      }
}

.dtHorizontalExampleWrapper {
  max-width: 600px;
  margin: 0 auto;
}
#dtHorizontalExample th, td {
  white-space: nowrap;
}

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
  
 bottom: .5em;
}



</style>
  <!-- summernote -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">

     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa-solid fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
    
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

     
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">  admin_panel </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="#" class="d-block text-decoration-none mb-2" >Hi {{ Auth::user()->name }} </a>

         <div>
         <a href="{{route('admin.logout')}}" class=" btn btn-sm btn-danger  ">logout  </a>
         </div>
           
         


          
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{  (request()->segment(2) =='dashboard')? 'active':''; }} ">
              
            <img  src="{{asset('images/dashboard.png')}}" alt="" height="25" width="30">
              <p class="ps-3">Dashboard</p>
            </a>

          </li>

          <li class="nav-item menu-open">
            
            <a href="{{route('admin.users.index')}}" class="nav-link {{  (request()->segment(2) =='dashboard')? 'active':''; }} ">
              
            <img  src="{{asset('images/dashboard.png')}}" alt="" height="25" width="30">
              <p class="ps-3">Users</p>
            </a>

          </li>
          <!--  -->
          <li class="nav-item">
            <a href="{{route('admin.moter_policies.index')}}" class="nav-link {{  (request()->segment(2) =='moter-policies')? 'active':''; }} ">
            <img  src="{{asset('images/policy.png')}}" alt="" height="25" width="30">
              <p class="ps-3"> MOTER POLICIES </p>
            </a>
          </li>
              <!--  -->
          <!--  -->
          <li class="nav-item">
            <a href="{{route('admin.categories')}}" class="nav-link {{  (request()->segment(2) =='moter-policies')? 'active':''; }} ">
            <img  src="{{asset('images/policy.png')}}" alt="" height="25" width="30">
              <p class="ps-3"> MOTER POLICIES View </p>
            </a>
          </li>
              <!--  -->




          <li class="nav-item">
            <a href="{{route('admin.moter_policies.index')}}" class="nav-link {{  (request()->segment(2) =='user-management')? 'active':''; }} ">
            <img  src="{{asset('images/policy.png')}}" alt="" height="25" width="30">
              <p class="ps-3"> MOTER POLICIES <i class="fa-solid fa-angle-down ps-2"></i> </p>
            </a>

            <ul class="nav nav-treeview " >

              <li class="nav-item">                       
                  <a href="{{route('admin.two_wheeler_one_year.index')}}" class="nav-link {{  (request()->segment(2) =='two-wheeler-one-year')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>  TWO WHEELER PREMIUM </p>
                  
                  </a>
              </li> 
              <li class="nav-item">                       
                  <a href="{{route('admin.private_car.index')}}" class="nav-link {{  (request()->segment(2) =='private-car')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>  PRIVATE CAR PREMIUM </p>
                  
                  </a>
              </li> 

              <li class="nav-item">                       
                  <a href="{{route('admin.goods_carrying_public.index')}}" class="nav-link {{  (request()->segment(2) =='goods-carrying-public')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>GOODS CARRYING PUBLIC (other then 3 Wheeler)  </p>
                  </a>
              </li> 

              <li class="nav-item">                       
                  <a href="{{route('admin.goods_carrying_private.index')}}" class="nav-link {{  (request()->segment(2) =='goods-carrying-private')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>GOODS CARRYING PRIVATE (other then 3 Wheeler)  </p>
                  </a>
              </li> 
              <li class="nav-item">                       
                  <a href="{{route('admin.three_wheeler_goods_carrying_public.index')}}" class="nav-link {{  (request()->segment(2) =='three-wheeler-goods-carrying-public')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>THREE WHEELER GOODS CARRYING PUBLIC  </p>
                  </a>
              </li> 
              <li class="nav-item">                       
                  <a href="{{route('admin.three_wheeler_goods_carrying_private.index')}}" class="nav-link {{  (request()->segment(2) =='three-wheeler-goods-carrying-private')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>THREE WHEELER GOODS CARRYING PRIVATE  </p>
                  </a>
              </li> 

              <li class="nav-item">                       
                  <a href="{{route('admin.three_wheeler_pcv_upto_6_passengers.index')}}" class="nav-link {{  (request()->segment(2) =='three-wheeler-pcv-upto-6-passengers')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>THREE WHEELER PCV UP TO 6 PASSENGERS </p>
                  </a>
              </li> 
              <li class="nav-item">                       
                  <a href="{{route('admin.three_wheeler_pcv_upto_17_passengers.index')}}" class="nav-link {{  (request()->segment(2) =='three-wheeler-pcv-upto-17-passengers')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>THREE WHEELER PCV > 6 UP TO 17 PASSENGERS </p>
                  </a>
              </li> 
              <li class="nav-item">                       
                  <a href="{{route('admin.four_wheeler_upto_6_passengers_taxi.index')}}" class="nav-link {{  (request()->segment(2) =='three-wheeler-pcv-upto-17-passengers')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>FOUR WHEELER UP TO 6 PASSENGERS TAXI </p>
                  </a>
              </li> 
              <li class="nav-item">                       
                  <a href="{{route('admin.four_wheeler_bus_above_6_passengers_basic_rates.index')}}" class="nav-link {{  (request()->segment(2) =='three-wheeler-pcv-upto-17-passengers')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>FOUR WHEELER ABOVE 6 PASSENGERS BUS </p>
                  </a>
              </li> 

              <li class="nav-item">                       
                  <a href="{{route('admin.misc_special_vehicles.index')}}" class="nav-link {{  (request()->segment(2) =='three-wheeler-pcv-upto-17-passengers')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>MISC SPECIAL VEHICLE</p>
                  </a>
              </li> 

              <li class="nav-item">                       
                  <a href="{{route('admin.two_wheeler_ev.index')}}" class="nav-link {{  (request()->segment(2) =='three-wheeler-pcv-upto-17-passengers')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Two Wheeler EV </p>
                  </a>
              </li> 
              <li class="nav-item">                       
                  <a href="{{route('admin.private_car_ev.index')}}" class="nav-link {{  (request()->segment(2) =='three-wheeler-pcv-upto-17-passengers')? 'active':''; }} ">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Private Car EV </p>
                  </a>
              </li> 
            </ul>
           </li>



        

  

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">CALCUATOR</h1>
          </div>
          <div class="col-sm-6 text-right">
            <img src="{{asset('/website/images/logo.png')}}" alt="" height="80px" >
          </div>
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      
    @yield('content')

    </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{date("Y") ;}} <a href="#" class="text-decoration-none text-reset"  > calculator </a>.</strong>
    All rights reserved.
  
  </footer>

  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- <script src="/plugins/jquery/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- jquery and bootstrap js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->

<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>

@yield('script')



</body>
</html>
