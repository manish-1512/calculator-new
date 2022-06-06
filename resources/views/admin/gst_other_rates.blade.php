@extends('admin.layout')

@section('content')



<div class="row">

    <h3 class="text-center">  </h3>
    
    <div class="col-lg-12 margin-tb mx-auto ">
      <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#add_policy">Add new Type</button>

</div>

</div>


<table id="dtHorizontalExample" class="table table-striped  table-bordered table-dark ">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Policy </th>
                  <th>Gst On Basic (%)</th>
                  <th>Gst On Rest (%)</th>
                  <th>IMT 23 (%)</th>
                  <th>LPG/CNG %</th>
                  <th>LPG/CNG Addition On Tp(₹)</th>
                  <th>Electrical % </th>
                  <th>Action</th>
                </tr>
              </thead>
         
          @if (isset($gst_other_rate_data))
       
               <tbody>

                @foreach ($gst_other_rate_data as $key =>  $data)

                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$data->policy }}</td>                       
                    <td>{{$data->gst_on_basic_liability}}</td>
                    <td>{{$data->gst_on_rest_of_other}} </td>
                    <td>{{$data->imt_23}} </td>
                    <td>{{$data->lpg_cng_percentage}} </td>
                    <td>{{$data->lpg_cng_additional_on_tp}} </td>
                    <td>{{$data->electrical_percentage}} </td>


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

                  <form action="{{route('admin.gst_and_other_rates.store')}}"  method="POST" id="gst_other_rates_create"  >

                          @csrf                  

                    <div class="form-group">
                      <label for="name">Select Policy</label>
                      <select name="id" id="id" class="form-control" required> 
                        @if($policies !== null)
                            @foreach ( $policies as $policy)
                            <option value="{{$policy->id}}">{{$policy->name}}</option>                              
                            @endforeach
                        @endif
                      </select>
                      <span class="text-danger error-text error_id "></span>
                    </div>
               
                    <div class="form-group">
                      <label for="image_order">Gst On Basic Liabilities (%)</label>
                      <input type="text" class="form-control" value=""  name="gst_on_basic_liability" >
                      <span class="text-danger error-text gst_on_basic_liability_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">Gst On Rest Of Others (%) </label>
                      <input type="text" class="form-control" value=""  name="gst_on_rest_of_other" >
                      <span class="text-danger error-text gst_on_rest_of_other_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">IMT 23  (%)</label>
                      <input type="text" class="form-control" value=""  name="imt_23" >
                      <span class="text-danger error-text imt_23_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">LPG/CNG (%) </label>
                      <input type="text" class="form-control" value=""  name="lpg_cng_percentage" >
                      <span class="text-danger error-text lpg_cng_percentage_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">LPG/CNG  Additional On TP (₹)</label>
                      <input type="text" class="form-control" value=""  name="lpg_cng_additional_on_tp" >
                      <span class="text-danger error-text lpg_cng_additional_on_tp_error "></span>
                    </div>

                    <div class="form-group">
                      <label for="image_order">Electrical Item  (%) </label>
                      <input type="text" class="form-control" value=""  name="electrical_percentage" >
                      <span class="text-danger error-text electrical_percentage_error "></span>
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
                  <form action="{{route('admin.gst_and_other_rates.update')}}"  method="POST" id="gst_other_rates_update"  >

                    @csrf                  

              <div class="form-group">
                        <input type="hidden" class="form-control" id="edit_id" value=""  name="id" >
                </select>
                <span class="text-danger error-text id_error "></span>
              </div>
         
              <div class="form-group">
                <label for="image_order">Gst On Basic Liabilities (%)</label>
                <input type="text" class="form-control" id="edit_gst_on_basic_liability" value=""  name="gst_on_basic_liability" >
                <span class="text-danger error-text gst_on_basic_liability_error "></span>
              </div>

              <div class="form-group">
                <label for="image_order">Gst On Rest Of Others (%) </label>
                <input type="text" class="form-control" id="edit_gst_on_rest_of_other" value=""  name="gst_on_rest_of_other" >
                <span class="text-danger error-text gst_on_rest_of_other_error "></span>
              </div>

              <div class="form-group">
                <label for="image_order">IMT 23  (%)</label>
                <input type="text" class="form-control" value="" id="edit_imt_23"  name="imt_23" >
                <span class="text-danger error-text imt_23_error "></span>
              </div>

              <div class="form-group">
                <label for="image_order">LPG/CNG (%) </label>
                <input type="text" class="form-control" value="" id="edit_lpg_cng_percentage" name="lpg_cng_percentage" >
                <span class="text-danger error-text lpg_cng_percentage_error "></span>
              </div>

              <div class="form-group">
                <label for="image_order">LPG/CNG  Additional On TP (₹)</label>
                <input type="text" class="form-control" value="" id="edit_lpg_cng_additional_on_tp"  name="lpg_cng_additional_on_tp" >
                <span class="text-danger error-text lpg_cng_additional_on_tp_error "></span>
              </div>

              <div class="form-group">
                <label for="image_order">Electrical Item  (%) </label>
                <input type="text" class="form-control" value="" id="edit_electrical_percentage"  name="electrical_percentage" >
                <span class="text-danger error-text electrical_percentage_error "></span>
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
      
      $("#gst_other_rates_create").on('submit',function(e){

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

                        $('#gst_other_rates_create')[0].reset();

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
      url:  "{{APP_PATH}}"+"admin/gst-and-others-rates/edit/"+rate_chart_id,


              success:function(response){

                console.log(response);
            
            if(response.status == 404){
                
                Swal.fire(
                                        response.message,
                                        'no data found',
                                        
                                );
            }else{

                $('#edit_id').val(response.gst_and_other_rates_data.id);
                $('#edit_gst_on_basic_liability').val(response.gst_and_other_rates_data.gst_on_basic_liability );
                $('#edit_gst_on_rest_of_other').val(response.gst_and_other_rates_data.gst_on_rest_of_other );
                $('#edit_imt_23').val(response.gst_and_other_rates_data.imt_23 );
                $('#edit_lpg_cng_percentage').val(response.gst_and_other_rates_data.lpg_cng_percentage );
                $('#edit_lpg_cng_additional_on_tp').val(response.gst_and_other_rates_data.lpg_cng_additional_on_tp );
                $('#edit_electrical_percentage').val(response.gst_and_other_rates_data.electrical_percentage );
        
            }  
    

}

});

});




$("#gst_other_rates_update").on('submit',function(e){

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

                        $('#gst_other_rates_update')[0].reset();

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
    url: "{{APP_PATH}}"+"admin/gst-and-others-rates/delete/"+policy_id,

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



 



