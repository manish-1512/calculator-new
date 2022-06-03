@extends('admin.layout')

@section('content')

<div class="col-12 ">
            <div class="card l-bg-purple-dark">
                <div class="card-statistic-3 p-2">
                    <div class="row align-items-center d-flex">
                        <div class="col-12">
                        <span class="fs-4 px-3">Common</span>
                        </div>
                    </div>
                   
                </div>
            </div>
</div>


<div class="col-md-12 ">
    <div class="row ">
        <!-- //privacy policy -->
    
     
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-cherry">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">New Orders</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                3,243
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span>12.5% <i class="fa fa-arrow-up"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
</div>



@endsection

@section('script')

@endsection