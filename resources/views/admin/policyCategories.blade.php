@extends('admin.layout')

@section('content')

<div class="col-md-10 ">
    <div class="row">

        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.two_wheeler_one_year.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    TWO WHEELER PREMIUM 
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="https://freepngimg.com/thumb/bike/23003-6-motorbike-image.png" alt="" height="100" width="100" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.two_wheeler_ev.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    Two Wheeler EV
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="{{asset('images/categories/pngegg1.png')}}" alt="" height="100" width="170" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    {{-- --}}
    
     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.private_car.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    PRIVATE CAR PREMIUM
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="{{asset('images/categories/privatecar.png')}}" alt="" height="100" width="100" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.private_car_ev.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    Private Car EV
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="{{asset('images/categories/pngegg.png')}}" alt="" height="160" width="140" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    

     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.goods_carrying_public.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    GOODS CARRYING PUBLIC (other then 3 Wheeler) 
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="{{asset('images/categories/pngegg3.png')}}" alt="" height="160" width="140" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    
     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.goods_carrying_private.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    GOODS CARRYING PRIVATE (other then 3 Wheeler) 
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="{{asset('images/categories/pngegg3.png')}}" alt="" height="160" width="140" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    
     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.three_wheeler_goods_carrying_public.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    THREE WHEELER GOODS CARRYING PUBLIC 
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="https://freepngimg.com/thumb/bike/23003-6-motorbike-image.png" alt="" height="100" width="100" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    
     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.three_wheeler_goods_carrying_private.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    THREE WHEELER GOODS CARRYING PRIVATE 
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="https://freepngimg.com/thumb/bike/23003-6-motorbike-image.png" alt="" height="100" width="100" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    
     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.three_wheeler_pcv_upto_6_passengers.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    THREE WHEELER PCV UP TO 6 PASSENGERS
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="{{asset('images/categories/pngegg4.png')}}" alt="" height="160" width="140"class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    
     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.three_wheeler_pcv_upto_17_passengers.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    THREE WHEELER PCV > 6 UP TO 17 PASSENGERS 
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="https://freepngimg.com/thumb/bike/23003-6-motorbike-image.png" alt="" height="100" width="100" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    
     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href={{route('admin.four_wheeler_upto_6_passengers_taxi.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    FOUR WHEELER UP TO 6 PASSENGERS TAXI
                                </h5>
                            </div>
                            <div class="col-12 text-center py-2">
                             <img   src="{{asset('images/categories/pngegg5.png')}}" alt="" height="180" width="140" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    
     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.four_wheeler_bus_above_6_passengers_basic_rates.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    FOUR WHEELER ABOVE 6 PASSENGERS BUS 
                                </h5>
                            </div>
                            <div class="col-12 text-center py-2">
                             <img   src="{{asset('images/categories/pngegg6.png')}}" alt="" height="180" width="140" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    
     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.misc_special_vehicles.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    MISC SPECIAL VEHICLE
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="https://freepngimg.com/thumb/bike/23003-6-motorbike-image.png" alt="" height="100" width="100" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
     {{--  --}}
        <div class="col-xl-3 col-lg-3 col-md-6">
            
            <a href="{{route('admin.e_rickshow_upto_6_passengers.index')}}" class="text-decoration-none" >

                <div class="card">
                    <div class="card-statistic-3 p-2">
                        <div class="card-icon card-icon-large"></div>
                    
                        <div class="row align-items-center d-flex">
                            <div class="col-12">
                                <h5 class="d-flex text-dark pt-1 ps-1 align-items-center mb-0">
                                    E-RickShaow (up to 6 passanger)
                                </h5>
                            </div>
                            <div class="col-12 text-center">
                             <img  src="https://freepngimg.com/thumb/bike/23003-6-motorbike-image.png" alt="" height="100" width="100" class="img-fluid">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </a>

        </div>
    
  
    
   
    
  
   

      
      
    </div>
</div>


@endsection

@section('script')

@endsection