@extends('admin.layout')

@section('content')

<script>


</script>

<div class="row ">
    <h3 class="text-center">Two Wheeler CC AND TP Rates  </h3>
    <div class="col-lg-12 margin-tb mx-auto ">

      <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#add_policy">Add New</button>
      <a href="{{route('admin.two_wheeler_one_year.index')}}" class="btn btn-info">Go Back</a>

</div>

</div>


<table id="dtHorizontalExample" class="table table-striped  table-bordered table-dark ">

              <thead>
                <tr>
                  <th>#</th>
                  <th>CC</th>
                  <th>TP One Year</th>
                  <th>Tp Five Year</th>
                  <th>Action</th>
                </tr>
              </thead>
         
          @if ( isset($two_wheeler_cc_tp_charges))
       
               <tbody>

                @foreach ($two_wheeler_cc_tp_charges as $key =>  $data)

                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$data->cc}}</td>                       
                    <td>{{$data->tp_one_year}}</td>
                    <td>{{$data->tp_five_year}}</td>
                   
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

                  <form action="{{route('admin.two_wheeler_one_year.cc_tp.store')}}"  method="POST" id="two_wheeler_cc_tp_create" enctype="multipart/form-data" >

                          @csrf                

                    <div class="form-group">
                      <label for="image_order">Vehicle CC</label>
                      <input type="text" class="form-control" value="" min="0" name="cc"  required>
                      <span class="text-danger error-text cc_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">TP One Year </label>
                      <input type="text" class="form-control" value="" min="0" name="tp_one_year"  required>
                      <span class="text-danger error-text tp_one_year_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">TP five Year</label>
                      <input type="text" class="form-control" value="" min="0" name="tp_five_year"  required>
                      <span class="text-danger error-text tp_five_year_error "></span>
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
                <form action="{{route('admin.two_wheeler_one_year.cc_tp.store')}}"  method="POST" id="two_wheeler_update" enctype="multipart/form-data" >
                      @csrf                  

                    
                      <div class="form-group">
                      <label for="image_order">Vehicle CC</label>
                      <input type="text" name="id" id="edit_id">
                      <input type="text" class="form-control" value="" min="0" name="cc" id="edit_cc" required>
                      <span class="text-danger error-text cc_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">TP One Year </label>
                      <input type="text" class="form-control" value="" min="0" name="tp_one_year" id="edit_tp_one_year" required>
                      <span class="text-danger error-text tp_one_year_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">TP five Year</label>
                      <input type="text" class="form-control" value="" min="0" name="tp_five_year" id="edit_tp_five_year" required>
                      <span class="text-danger error-text tp_five_year_error "></span>
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
      
      $("#two_wheeler_cc_tp_create").on('submit',function(e){

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

                        $('#two_wheeler_cc_tp_create')[0].reset();

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
      url:  "{{APP_PATH}}"+"admin/two-wheeler-one-year/cc-tp/edit/"+rate_chart_id,


              success:function(response){

            
            if(response.status == 404){
                
                Swal.fire(
                                        response.message,
                                        'no data found',
                                        
                                );
            }else{

                $('#edit_id').val(rate_chart_id);
                $('#edit_cc').val(response.two_wheeler_cc_tp_data.cc);
                $('#edit_tp_one_year').val(response.two_wheeler_cc_tp_data.tp_one_year );
                $('#edit_tp_five_year').val(response.two_wheeler_cc_tp_data.tp_five_year );


            }  
    

}

});

});




$("#two_wheeler_update").on('submit',function(e){

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

                        $('#two_wheeler_update')[0].reset();

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
    url: "{{APP_PATH}}"+"admin/two-wheeler-one-year/cc-tp/delete/"+policy_id,

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



 



