@extends('admin.layout')

@section('content')

<script>


</script>

<div class="row ">
    <h3 class="text-center">Policies</h3>
    <div class="col-lg-12 margin-tb">

   <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#add_policy">Add new policy</button>

</div>

</div>


<table id="dtHorizontalExample" class="table table-striped  table-bordered table-dark ">

              <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Order</th>
                  <th>tag</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
         
          @if (isset($policy_data))
  
               <tbody>
         
                @foreach ($policy_data as $key =>  $data)

                  <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>                    
                    <td>
                      @if(isset($data->image))
                      <img src="{{  asset(POLICIES_IMAGES_URL.$data->image)}}" alt="" width="250px" height="120px">
                      @endif
                    </td>        
                    <td>{{$data->order}}</td>
                    <td>{{$data->tag}}</td>

                    @if($data->is_active =='1')
                  
                    <td>  <span class="badge badge-success">Active</span> </td>
                    
                    @else
                    <td><span class="badge badge-danger">Inactive</span></td>
                    
                    @endif 

                    <td style="width: 220px;">

                        <form action="" method="POST">
                          
                        {{-- <a href="{{route('admin.moter_policies.status',$data->id)}}" class="btn btn-warning btn-sm" >Status</a> --}}
                        <button type="button" data-bs-toggle="modal" data-bs-target="#edit_policy" class="edit_policy btn-sm  btn btn-primary "  value="{{$data->id }}" >Edit</button>
                        {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#delete_policy" class="delete_policy btn-sm  btn btn-danger" value="{{$data->id }}" >Delete</button> --}}
                        {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#" class=" btn-sm  btn btn-info" value="{{$data->id }}" >view</button> --}}
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
        <h5 class="modal-title" id="exampleModalLabel">Add New Policy </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                    
                <div class="container" >

                  <form action="{{route('admin.moter_policies.store')}}"  method="POST" id="policy_create" enctype="multipart/form-data" >

                          @csrf                  

                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" value="" name="name" >
                      <span class="text-danger error-text name_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="name">Image</label>
                      <input type="file" class="form-control" value="" name="image" >
                      <span class="text-danger error-text image_error "></span>
                    </div>
                    <div class="form-group">
                      <label for="name">Tag</label>
                      <input type="text" class="form-control" value="" name="tag" >
                      <span class="text-danger error-text tag_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">Order </label>
                      <input type="text" class="form-control" value="" name="order" >
                      <span class="text-danger error-text order_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="">Is Active</label>
                      <select name="is_active" id="" class="form-control" required> 
                        <option value="1">Yes</option>
                          <option value="0">No</option>
                      </select>
                      <span class="text-danger error-text  is_active_error "></span>
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

                <form action="{{route('admin.moter_policies.update')}}"  method="POST" id="policy_update" enctype="multipart/form-data" >
                          @csrf                  

                    <div class="form-group">
                    <input type="hidden" id="edit_id" name="id">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" value="" id="edit_name" name="name" >
                      <span class="text-danger error-text name_error "></span>
                    </div>


                    <div class="form-group">
                      <label for="name">Image</label>
                   
                      <input type="file" class="form-control" value=""  name="image" >
                      <span class="text-danger error-text image_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="name">Tag</label>
                      <input type="text" class="form-control" value="" name="tag" id="edit_tag" >
                      <span class="text-danger error-text tag_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order"> Order </label>
                      <input type="text" class="form-control" value="" name="order" id="edit_order" >
                      <span class="text-danger error-text order_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="">IS Active</label>
                      <select name="is_active" id="edit_is_active" class="form-control" required> 
                        <option value="1">Yes</option>
                          <option value="0">No</option>
                      </select>
                      <span class="text-danger error-text  is_active_error "></span>
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
      
      $("#policy_create").on('submit',function(e){

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

                        $('#policy_create')[0].reset();

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

      let policy_id = $(this).val();

      console.log(policy_id);

      $.ajax({

      type:"GET",
      url:  "{{APP_PATH}}"+"admin/moter-policies/edit/"+policy_id,


              success:function(response){

            
            if(response.status == 404){
                
                Swal.fire(
                                        response.message,
                                        'no data found',
                                        
                                );
            }else{

                $('#edit_id').val(policy_id);
                $('#edit_name').val(response.policy_data.name);
                $('#edit_tag').val(response.policy_data.tag);
                $('#edit_is_active').val(response.policy_data.is_active);
                $('#edit_order').val(response.policy_data.order);   

            }  
    

}

});

});




$("#policy_update").on('submit',function(e){

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

                        $('#policy_update')[0].reset();

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
    url: "{{APP_PATH}}"+"admin/moter-policies/delete/"+policy_id,

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



 



