@extends('admin.layout')

@section('content')

<script>


</script>

<div class="row ">
    <h3 class="text-center text-uppercase">Basic Rates And Tp for  Three Wheeler goods Carriyng vehicle Public 
    </h3>
    <div class="col-lg-12 margin-tb mx-auto ">

      <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#add_policy">Add new Type</button>


</div>

</div>


<table id="dtHorizontalExample" class="table table-striped  table-bordered table-dark ">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Zone</th>
                  <th>Age</th>        
                  <th>Vehicle Basic Rate</th>
                  <th>Vehicle Tp Rate</th>
                  <th>Action</th>
                </tr>
              </thead>
         
          @if (isset($goods_carrying_data))
       
               <tbody>

                @foreach ($goods_carrying_data as $key =>  $data)

                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$data->zone}}</td>                       
                    <td>{{$data->age}}</td>
                    <td>{{$data->vehicle_basic_rate}}</td>
                    <td>{{$data->vehicle_tp_rate}}</td>
                    <td style="width: 220px;">

                        <form action="" method="POST">
                          
                       
                        <button type="button" data-bs-toggle="modal" data-bs-target="#edit_policy" class="edit_policy btn-sm  btn btn-primary "  value="{{$data->id }}" >Edit</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#delete_policy" class="delete_policy btn-sm  btn btn-danger" value="{{$data->id }}" >Delete</button>

                        </form>
                    </td>
                  
                 </tr>
               @endforeach 
           
              </tbody>
       
      @endif
</table>

<!-- model add loan slab -->
<div class="modal fade" id="add_policy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Rates </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                    
                <div class="container" >

                  <form action="{{route('admin.three_wheeler_goods_carrying_private.store')}}"  method="POST" id="goods_carrying_private_create" enctype="multipart/form-data" >

                          @csrf                  

                    <div class="form-group">
                      <label for="name">Select Policy</label>
                      <select name="policy_id" id="" class="form-control" required> 
                        @if($policies !== null)
                            @foreach ( $policies as $policy)
                            <option value="{{$policy->id}}">{{$policy->name}}</option>                              
                            @endforeach
                        @endif
                      </select>
                      <span class="text-danger error-text policy_id "></span>
                    </div>
                    
                    <div class="form-group">
                      <label for="">Select Zone</label>
                      <select name="zone" id="" class="form-control" required> 

                        <option >Select Zone</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                      </select>
                      <span class="text-danger error-text  zone_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="age">Vehicle  Age  </label>
                      <select name="age" id="" class="form-control" required> 
                        <option value="0_to_5">Up to 5 years</option>
                        <option value="5_to_7">5 to 7 years</option>
                        <option value="7_to_more"> > 7 years</option>
                        
                      </select>
                      <span class="text-danger error-text age_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">Vehicle Basic Rate</label>
                      <input type="text" class="form-control" value="" min="0" name="vehicle_basic_rate" required>
                      <span class="text-danger error-text vehicle_basic_rate_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">Vehicle TP Rate</label>
                      <input type="text" class="form-control" value="" min="0" name="vehicle_tp_rate" required>
                      <span class="text-danger error-text vehicle_tp_rate_error "></span>
                    </div>

                               
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>

              </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>


</div>

<!-- end model add loan slab -->
<!-- model add loan slab -->
<div class="modal fade" id="edit_policy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit Policy </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                    
                <div class="container" >
                <form action="{{route('admin.three_wheeler_goods_carrying_private.store')}}"  method="POST" id="goods_carrying_private_update" enctype="multipart/form-data" >
                      @csrf                  

                      <div class="form-group">
                      <label for="name">Select Policy</label>
                      <input type="text" name="id" id="edit_id">
                      <select name="policy_id" id="edit_policy_id" class="form-control" required> 
                      @if($policies !== null)
                        @foreach ( $policies as $policy)
                        <option value="{{$policy->id}}">{{$policy->name}}</option>                              
                        @endforeach
                      @endif
                      </select>
                      <span class="text-danger error-text policy_id "></span>
                      </div>

                      <div class="form-group">
                      <label for="">Select Zone</label>
                      <select name="zone" id="edit_zone" class="form-control" required> 
                        <option >Select Zone</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                      </select>
                      <span class="text-danger error-text  zone_error "></span>
                      </div>

                      <div class="form-group">
                      <label for="age">Vehicle  Age  </label>
                      <select name="age" id="edit_age" class="form-control" required> 

                        <option >Select Zone</option>
                        <option value="0_to_5">Up to 5 years</option>
                        <option value="5_to_7">5 to 7 years</option>
                        <option value="7_to_more"> > 7 years</option>     
                      </select>
                      <span class="text-danger error-text age_error "></span>
                    </div>

                    <!-- <div class="form-group">
                      <label for="image_order">Vehicle  Age   (<) Year  </label>
                      <input type="number" class="form-control" value="" name="age_lessthen" min="0" required>
                      <span class="text-danger error-text age_lessthen_error "></span>
                    </div> -->

                   


                      <div class="form-group">
                        <label for="image_order">Vehicle Basic Rate</label>
                        <input type="text" class="form-control" value="" name="vehicle_basic_rate" min="0" id="edit_vehicle_basic_rate" required>
                        <span class="text-danger error-text vehicle_basic_rate_error "></span>
                      </div>
                      <div class="form-group">
                        <label for="image_order">Vehicle Tp Rate</label>
                        <input type="text" class="form-control" value="" name="vehicle_tp_rate" min="0" id="edit_vehicle_tp_rate" required>
                        <span class="text-danger error-text vehicle_tp_rate_error "></span>
                      </div>

                          
                      <button type="submit" class="btn btn-primary">Submit</button>
                      </form>


                </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
</div>
</div>

<!-- end model add loan slab -->

<!-- delete model -->

<div class="modal fade" id="delete_policy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Policy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">

          <input type="hidden" id="delete_policy_id">
          <h4> Are you sure you want to delete this item? </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="delete_policy_btn  btn btn-danger">Delete</button>
      </div>
    </div>
  </div>


</div>


<script>
    $(document).ready(function () {
  $('#dtHorizontalExample').DataTable({
    "scrollX": true
  });
  $('.dataTables_length').addClass('bs-select');
});
</script>



<script>
    
    $(document).ready( function(){
      
      $("#goods_carrying_private_create").on('submit',function(e){

          e.preventDefault();

          $.ajax({

                 url:$(this).attr('action'),
             
                 method:$(this).attr('method'),
                 data:new FormData(this),
                 processData:false,
                 dataType:'json',
                 contentType:false,
                 beforeSend:function(){

                      $(document).find('span.error-text').text('')
                 },
                 success:function(data){

                  console.log(data);

                      if(data.status == 401){
                          $.each(data.error,function(prefix,val){
                              $('span.'+prefix+'_error').text(val[0]);
                          });

                      }else if(data.status == 500){

                        Swal.fire(
                                    'Oops...',
                                     data.message,
                                    'error'
                            );
                      }else if(data.status == 200){

                        $('#goods_carrying_private_create')[0].reset();

                        Swal.fire({

                          position: 'center',
                          icon: 'success',
                          title: data.message,
                          showConfirmButton: false,
                          timer: 5000
                          }
                          
                          )

                      window.location = "" 
                            
                      }

                 } 

          });

      });
  });

  
  
  $(document).on('click','.edit_policy',function(e){

      e.preventDefault();

      let rate_chart_id = $(this).val();

      console.log(rate_chart_id);

      $.ajax({

      type:"GET",
      url:  "{{APP_PATH}}"+"admin/three-wheeler-goods-carrying-private/edit/"+rate_chart_id,


              success:function(response){

            
            if(response.status == 404){
                
                Swal.fire(
                                        response.message,
                                        'no data found',
                                        
                                );
            }else{


                $('#edit_id').val(rate_chart_id);
                $('#edit_policy_id').val(response.three_wheeler_goods_carrying_private_data.policy_id );
                $('#edit_zone').val(response.three_wheeler_goods_carrying_private_data.zone );
                $('#edit_age').val(response.three_wheeler_goods_carrying_private_data.age);
                $('#edit_vehicle_basic_rate').val(response.three_wheeler_goods_carrying_private_data.vehicle_basic_rate );
                $('#edit_vehicle_tp_rate').val(response.three_wheeler_goods_carrying_private_data.vehicle_tp_rate );
                 

            }  
    

}

});

});




$("#goods_carrying_private_update").on('submit',function(e){

        e.preventDefault();

        $.ajax({

                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){

                    $(document).find('span.error-text').text('')
                },
                success:function(data){

                    if(data.status == 401){

                        $.each(data.error,function(prefix,val){
                            $('span.'+prefix+'_error').text(val[0]);
                        });

                    }else if(data.status == 200){

                        $('#goods_carrying_private_update')[0].reset();

                        Swal.fire(
                                    'Good job!',
                                    data.message,
                                    'success'
                            );

                     window.location = "";

                    }else if(data.status == 500){

                      Swal.fire(
                                    'Oops...',
                                    'Something went wrong!',
                                    'error'
                            );

                     window.location = ""     

                    }

                } 



        });

        });



//on click on delete button 
$(document).on('click','.delete_policy',function(e){

  e.preventDefault();
  let delete_policy_id = $(this).val();

  $('#delete_policy_id').val(delete_policy_id);

  $('#delete_policy').model('show');
});



$(document).on('click','.delete_policy_btn',function(e){

e.preventDefault();

var policy_id = $('#delete_policy_id').val();

$.ajax({

    type:"DELETE",
    url: "{{APP_PATH}}"+"admin/three-wheeler-goods-carrying-private/delete/"+policy_id,

    data:{'_token': '{{ csrf_token() }}' },

    success:function(response){

        if(response.status == 200 ){

        Swal.fire(
                                'Good job!',
                                response.message,
                                'success'
                    );           
        }

        window.location = "";
    }
 });

});




</script>


@endsection



 



