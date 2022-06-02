@extends('admin.layout')

@section('content')

<script>


</script>

<div class="row ">
    <h3 class="text-center">Basic rates and tp charges details for Private Car EV  </h3>
    <div class="col-lg-12 margin-tb">

   <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#add_policy">Add new Type</button>
   <a href="{{route('admin.private_car_ev.kw_tp.index')}}" class="btn btn-info">KW And Tp For 2 Wheeler EV </a>

</div>

</div>

@endsection