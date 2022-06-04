@extends('admin.layout')

@section('content')


<div class="row py-2 ">
    {{--
    <div class="col-lg-10 margin-tb">

        <div>

                  <form action="{{route('admin.customer_management.index')}}" class="row" method="GET">

                        <div class="col-2">
                          <input type="text" class="form-control" placeholder="{{__('customer_management.customer_search_bar_text')}}" name="mobile_no" >
                        </div>
                        <div class="col-4">
                          <input type="text" class="form-control" placeholder="{{__('customer_management.customer_search_bar_text')}}" name="query" >
                        </div>
                        <div class="col-2">
                          <input type="text" class="form-control" placeholder="{{__('customer_management.customer_search_bar_text')}}" name="house_no" >
                        </div>
                        <div class="col-4">
                          <input type="submit" class="btn btn-primary" value="{{__('button.search')}}">
                        <a href="{{route('admin.customer_management.index')}}" class="btn btn-info" > {{__('button.show_all_customers')}}</a>
                          
                        </div>

                  </form>

          </div>

    </div>

    --}}

</div>

<div class="row py-1">  <h3 class="text-center mb-3 display-5 "> Users </h3></div>

<table class="table table-striped  table-bordered table-dark">

<thead>
            <tr>
              <th>Id</th>
              <th>Email</th>
              <th>Name</th>
              <th>Phone No</th>
              <th>status</th>
              <th>action</th>
            </tr>
          </thead>
         
          @if (isset($users_data))
  
          <tbody>
             
          
                @foreach ($users_data as $data)
              <tr>
                  <td>{{$data->id}} </td>
                  <td>{{ $data->email }}</td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->phone }}</td>
               
                  
                  @if($data->is_active =='1')
                  
                  <td>  <span class="badge badge-success">Active</span> </td>
                  
                  @else
                  <td><span class="badge badge-danger">Not Active</span></td>
                  
                  @endif          

                  <!-- <td>as</td> -->
                  <td>

                      <form action="" method="POST">
                              
                      <a href="{{route('admin.users.status',$data->id)}}" class="btn btn-warning btn-sm">Status</a>
                      {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#edit_customer" class="edit_customer   btn btn-primary btn-sm"  value="{{$data->id}}" >Edit</button> --}}
                      <button type="button" data-bs-toggle="modal" data-bs-target="#delete_customer" class="delete_customer   btn btn-danger btn-sm" value="{{$data->id}}" >delete</button>
                     
                      </form>
                  </td>
                  
              </tr>
              @endforeach 
           
          </tbody>
       
  @endif
</table>
{{--$customers_data->links('pagination::bootstrap-4') --}}


<!-- model add loan slab -->
<div class="modal fade" id="add_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('customer_management.add_customer')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                    
                <div class="container" >
                  <form action=""  method="POST" id="customer_create" >
                      @csrf
                    <div class="form-group">
                      <label for="name">{{__('formLabel.name')}}</label>
                      <input type="text" class="form-control" value="" name="name" >
                      <span class="text-danger error-text name_error "></span>
                    </div>
                    <div class="form-group">
                      <label for="email">{{__('formLabel.email')}}</label>
                      <input type="text" class="form-control" value="" name="email" >
                      <span class="text-danger error-text email_error "></span>
                    </div>
                    
                    <div class="form-group">
                      <label for="title">{{__('formLabel.phone_no')}}</label>
                      <input type="text" class="form-control" value="" name="mobile" >
                      <span class="text-danger error-text mobile_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="adress">{{__('formLabel.address')}}</label>
                      <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>     
                      <span class="text-danger error-text address_error "></span>
                    </div>


                    <div class="row">

                          <div class="form-group col-6">

                          <label for="title">{{__('formLabel.house_no')}}</label>
                          <input type="text" class="form-control" value="" name="house_no" >
                          <span class="text-danger error-text house_no_error "></span>
                                                
                         </div>

                          <div class="form-group col-6"> 
                            <label for="milk_timing">{{__('formLabel.milk_timing')}}</label>
                            <div class="form-group">
                            <select name="milk_delivery_time" id="" class="form-control" required> 
                              <option value="">Select </option>
                              <option value="morning" >Morning</option>
                              <option value="evening">Evening</option>
                              <option value="both">Both</option>
                            </select>
                            <span class="text-danger error-text  is_active_error "></span>
                            </div> 
                            <span class="text-danger error-text milk_delivery_time_error "></span>    


                          </div>

                        

                    </div>



                    <div class="row">

                      <div class="form-group col-6" id="morning">
                        <label for="title">{{__('formLabel.morning_kg')}}</label>
                        <input type="text" class="form-control" value="" name="morning_milk" >
                        <span class="text-danger error-text morning_milk_error "></span>
                      </div>   
  
                      <div class="form-group col-6" id="evening">
                        <label for="title">{{__('formLabel.evening_kg')}}</label>
                        <input type="text" class="form-control" value="" name="evening_milk"  >
                        <span class="text-danger error-text evening_milk_error "></span>
                      </div>   
                    </div>


                    <div class="row">
                      <div class="form-group col-6">
                        <label for="title">{{__('formLabel.milk_start_date')}}</label>
                        <input type="date" class="form-control" value="" name="start_date" >
                        <span class="text-danger error-text start_date_error "></span>
                      </div>

                      <div class="form-group col-6">
                        <label for="title">{{__('formLabel.milk_type')}}</label>

                        <select class="form-select" aria-label="Default select example" name="milk_type_id">
                        <option value="">Select</option>

                        @if(isset($milk_type))

                            @foreach($milk_type as $type)

                            <option value="{{$type->id}}">{{$type->name}}</option>

                            @endforeach
                        @endif

                      </select>
                      <span class="text-danger error-text milk_type_id_error "></span>
                      </div>

                      

                    </div>

                    <div class="form-group">
                    <label for="">{{__('formLabel.is_active')}}</label>
                    <select name="is_active" id="" class="form-control" required> 
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                    <span class="text-danger error-text  is_active_error "></span>
                    </div>                  
                    <button type="submit" class="btn btn-primary">{{__('button.submit')}}</button>
                  </form>

              </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('button.close')}}</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>


</div>
<!-- end model add loan slab -->


<!-- edit model box -->

<div class="modal fade" id="edit_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('customer_management.edit_customer')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                    
                <div class="container" >
                  <form action=""  method="POST" id="customer_update">
                      @csrf

                      <div class="form-group">
                      <label for="name">{{__('formLabel.name')}}</label>
                      <input type="hidden" name="id" id="edit_id">
                      <input type="text" class="form-control" value="" name="name" id="edit_name" >
                      <span class="text-danger error-text name_error "></span>
                    </div>
                      <div class="form-group">
                      <label for="email">{{__('formLabel.email')}}</label>
                      <input type="text" class="form-control" value="" name="email" id="edit_email" >
                      <span class="text-danger error-text email_error "></span>
                    </div>
                    
                    <div class="form-group">
                      <label for="title">{{__('formLabel.phone_no')}}</label>
                      <input type="text" class="form-control" value="" name="mobile" id="edit_mobile" >
                      <span class="text-danger error-text mobile_error "></span>
                    </div>


                    <div class="form-group">
                      <label for="adress">{{__('formLabel.address')}}</label>
                      <textarea class="form-control" name="address" id="edit_address" rows="3"></textarea>     
                      <span class="text-danger error-text address_error "></span>
                    </div>

                     <div class="row">
                        <div class="form-group col-6" ">
                            <label for="title">{{__('formLabel.house_no')}}</label>
                            <input type="text" class="form-control" value="" name="house_no"  id="edit_house_no">
                            <span class="text-danger error-text  house_no_error "></span>
                          </div>

                        <div class="form-group col-6" >
                        <label for="adress">{{__('formLabel.milk_timing')}}</label>
                          <select name="milk_delivery_time" id="edit_milk_delivery_time" class="form-control" required> 
                            <option value="">Select </option>
                            <option value="morning" >Morning</option>
                            <option value="evening">Evening</option>
                            <option value="both">Both</option>
                          </select>         
                          <span class="text-danger error-text milk_delivery_time_error "></span>

                          </div>

                      </div> 



                    <div class="row">

                      <div class="form-group col-6" id="morning">
                        <label for="title">{{__('formLabel.morning_kg')}}</label>
                        <input type="text" class="form-control" value="" name="morning_milk"  id="edit_morning_milk">
                        <span class="text-danger error-text  morning_milk_error "></span>
                      </div>   
  
                      <div class="form-group col-6" id="evening">
                        <label for="title">{{__('formLabel.evening_kg')}}</label>
                        <input type="text" class="form-control" value="" name="evening_milk" id="edit_evening_milk" >
                        <span class="text-danger error-text evening_milk_error "></span>
                      </div>   
                    </div>


                    <div class="row">
                      <div class="form-group col-6">
                        <label for="title">{{__('formLabel.milk_start_date')}}</label>
                        <input type="date" class="form-control" value="" name="start_date" id="edit_start_date" >
                        <span class="text-danger error-text start_date_error "></span>
                      </div>

                      <div class="form-group col-6">
                        <label for="title">{{__('formLabel.milk_type')}}</label>

                        <select class="form-select" aria-label="Default select example" name="milk_type_id" id="edit_milk_type_id">
                        <option value="">Select</option>

                        @if(isset($milk_type))

                            @foreach($milk_type as $type)

                            <option value="{{$type->id}}">{{$type->name}}</option>

                            @endforeach
                        @endif

                      </select>
                      <span class="text-danger error-text milk_type_id_error "></span>
                      </div>

                    </div>

                    <div class="form-group">
                    <label for="">{{__('formLabel.is_active')}}</label>
                    <select name="is_active" id="edit_is_active" class="form-control" required> 
                      <option value="1" >Yes</option>
                      <option value="0">No</option>
                    </select>
                    <span class="text-danger error-text  is_active_error "></span>
                    </div> 
                    
                      <button type="submit" class="update_loan_type btn btn-primary">{{__('button.submit')}}</button>

                  </form>

              </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('button.close')}}</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>


</div>


<!-- edit model  -->


<!-- delete model -->

<div class="modal fade" id="delete_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Delete User </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">

          <input type="hidden" id="delete_customer_id">
          <h4>Delete Data </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="delete_customer_btn  btn btn-danger">Delete</button>
      </div>
    </div>
  </div>


</div>





<!-- delete model end -->



<div class="modal fade" id="view_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('customer_management.customer_details')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                    
                <div class="container" >

                <section class="vh-60" style="background-color: #f4f5f7;">
                        <div class="container py-5 h-100">
                          <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-lg-12 mb-12 mb-lg-0">
                              <div class="card mb-3" style="border-radius: .5rem;">
                                <div class="row g-0">
                                  <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <img
                                      src="{{asset('images/user2.png')}}"
                                      alt="Avatar"
                                      class="img-fluid my-5"
                                      style="width: 80px;"
                                    />
                                    <h5 class="text-dark" id="view_name"></h5>
                                    <!-- <p class="text-dark">Web Designer</p> -->
                                    <i class="far fa-edit mb-5"></i>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body p-4">
                                      <h6>{{__('customer_management.Information')}}</h6>
                                      <hr class="mt-0 mb-4">
                                      <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                          <h6 >{{__('customer_management.Address')}}</h6>
                                          <p class="text-muted" id="view_address" ></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                          <h6>{{__('customer_management.mobile_no')}}</h6>
                                          <p class="text-muted" id="view_mobile"></p>
                                        </div>
                                      </div>
                                      <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                          <h6 >{{__('customer_management.house_no')}}</h6>
                                          <p class="text-muted" id="view_house_no" ></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                          <h6 >{{__('customer_management.email')}}</h6>
                                          <p class="text-muted" id="view_email" ></p>
                                        </div>
                                        
                                      </div>
                                      <h6>{{__('customer_management.milk_details')}}</h6>
                                      <hr class="mt-0 mb-4">


                                      <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                          <h6>{{__('customer_management.which_type_milk_you_get')}}</h6>
                                          <p class="text-muted" id="view_milk_type"></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                          <h6>{{__('customer_management.milk_delivery_time')}}</h6>
                                          <p class="text-muted" id="view_milk_delivery_time"></p>
                                        </div>
                                      </div>

                                      <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                          <h6>{{__('customer_management.morning_milk')}}</h6>
                                          <p class="text-muted" id="view_morning_milk"></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                          <h6>{{__('customer_management.evening_milk')}}</h6>
                                          <p class="text-muted" id="view_evening_milk"></p>
                                        </div>
                                      </div>

                                      <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                          <h6>{{__('customer_management.milk_start_date')}}</h6>
                                          <p class="text-muted" id="view_start_date"></p>
                                        </div>
                                        
                                      </div>


                                      <!-- <div class="d-flex justify-content-start">
                                        <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                      </div> -->


                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
              </section>



              </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('button.close')}}</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>


</div>


<script>
    
    $(document).ready( function(){
      
      $("#customer_create").on('submit',function(e){

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

                      }else if(data.status == 500){

                        Swal.fire(
                                    'Oops...',
                                     data.message,
                                    'error'
                            );
                      }else if(data.status == 200){

                        console.log(data);

                        $('#customer_create')[0].reset();

                        Swal.fire(
                                        'Good job!',
                                        data.message,
                                        'success'
                            ); 

                      window.location = "" 
                            
                      }

                 } 

          });

      });
  });

//on click on delete button 
$(document).on('click','.delete_customer',function(e){

        e.preventDefault();
        let customer_id = $(this).val();

        $('#delete_customer_id').val(customer_id);
        $('#delete_customer').model('show');
});



$(document).on('click','.delete_customer_btn',function(e){

        e.preventDefault();

        var customer_id = $('#delete_customer_id').val();

        $.ajax({

            type:"DELETE",
            url: "{{APP_PATH}}"+"admin/users/delete/"+customer_id,
        

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




  $(document).on('click','.edit_customer',function(e){

        e.preventDefault();

        let edit_customer_id = $(this).val();

        console.log(edit_customer_id);

        $.ajax({

        type:"GET",

        url:  "{{APP_PATH}}"+"admin/customer-management/edit/"+edit_customer_id,

        
        success:function(response){

            
          console.log(response);
            if(response.status == 404){
                
                Swal.fire(
                                        response.message,
                                        'no data found',
                                        
                       );
            }else{

              
                $('#edit_name').val(response.customer_data.name);
                $('#edit_email').val(response.customer_data.email);
                $('#edit_mobile').val(response.customer_data.mobile);
                $('#edit_address').val(response.customer_data.address);
                $('#edit_house_no').val(response.customer_data.house_no);
                $('#edit_milk_delivery_time').val(response.customer_data.milk_delivery_time);
                $('#edit_morning_milk').val(response.customer_data.morning_milk);
                $('#edit_evening_milk').val(response.customer_data.evening_milk);    
                $('#edit_milk_type_id').val(response.customer_data.milk_type_id);
                $('#edit_is_active').val(response.customer_data.is_active);
                $('#edit_start_date').val(response.customer_data.start_date);
                $('#edit_id').val(edit_customer_id);     

            }  
            

        }

        });

        });



        $(document).ready( function(){


// $(document).on('click','.update_privacy_policy',function(e){
//   e.preventDefault();
//   var privacy_policy_id = $("#edit_id").val();



$("#customer_update").on('submit',function(e){

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

                    }else{

                        $('#customer_update')[0].reset();

                        Swal.fire(
                                    'Good job!',
                                    'Successfully update !',
                                    'success'
                            );


                        window.location = "";
                    }

                } 



        });

        });


});






$(document).on('click','.view_customer',function(e){

e.preventDefault();

let view_customer_id = $(this).val();

console.log(view_customer_id);

$.ajax({

type:"GET",

url: "{{APP_PATH}}"+"admin/customer-management/view/"+view_customer_id,


success:function(response){

    
  console.log(response);

    if(response.status == 404){
        
        Swal.fire(
                                response.message,
                                'no data found',
                                
               );
    }else{

      
   
        document.getElementById("view_name").innerHTML =response.customer_data.name ;
        document.getElementById("view_mobile").innerHTML =response.customer_data.mobile ;
        document.getElementById("view_address").innerHTML =response.customer_data.address ;
        document.getElementById("view_email").innerHTML =response.customer_data.email ;
        document.getElementById("view_house_no").innerHTML =response.customer_data.house_no ;
        document.getElementById("view_morning_milk").innerHTML =response.customer_data.morning_milk ;
        document.getElementById("view_evening_milk").innerHTML =response.customer_data.evening_milk ;
        document.getElementById("view_milk_type").innerHTML =response.customer_data.milk_type;
        document.getElementById("view_milk_delivery_time").innerHTML =response.customer_data.milk_delivery_time;
        document.getElementById("view_start_date").innerHTML =response.customer_data.start_date ;
        

    }  
    

}

});

});


</script>



@endsection



