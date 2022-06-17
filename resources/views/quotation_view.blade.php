<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
      
        .table ,.table th , .table  td{ border: 1px solid black;
            
        }
        
        table{
            width: 100%;
        }
        .table td{
            margin-left:10px;
        }
        table th{
            font-size: 20px;
        }
    </style>
  </head>
  <body>


      <?php 
        $od_premium = $data['premium'][0]['items'];
        $liablity_premium = $data['premium'][1]['items'];
        $total_premium = $data['premium'][2]['items'];
      ?>


        <div style="width:100%">
            <div style="text-align: center;margin-bottom:20px">
              <img src="https://assetmyws.royalsundaram.in/sites/default/files/2021-08/Royal%20Sundaram%20General%20Insurance.png?auto=format&fit=max&w=256" alt="" height="60px">
            </div>
            <div>
              <p class="text-center text-uppercase;text-align: justify; " style="font-size: 22px; margin-left:20px;color:rgb(43, 168, 226)" >Royal Sundaram Car Insurance </p>
            </div>
          
           
            <hr>

            <table style="text-align: center">
                <tr style="border: 1px solid black;background-color:rgba(43, 122, 226, 0.425);">
                  <td style="background-color:rgba(43, 122, 226, 0.425);padding:8px">Quotation#15062022_203634</td>
                  <td>Two Wheeler Quotation</td>
                  <td>15-06-2022</td>
                </tr>
            </table>

        </div>

        <div>
            <table border="1" cellspacing="0" cellpadding="0" style="text-align: left">
                <tr>
                <td style="border:1px solid rgb(0, 0, 0)">
                   
                         <ul style="list-style-type: none">
                           <li style="font-size:22px">Customer Details</li>
                            <li>  Rajkumar Sukla </li>
                            <li> Vehicle Model:  Honda  </li>
                            <li> Vehicle Make Model: Dream Yuga </li>
                            <li>Vehicle Registration No: RJ41 SC 2022  </li>
                            <li>Mobile No:9696969696 </li>
                         </ul>
                        
                    
                </td>
                <td style="border:1px solid rgb(0, 0, 0)">
                   
                    <ul style="list-style-type: none">
                        <li style="font-size:22px">Advisor Details</li>
                         <li> Name : Rajkumar Sukla </li>
                         <li> Phone:  1235847582</li>
                         <li> Email:  Abc@gmail.com </li>
                         
                         
                      </ul>
                
                </td>
                </tr>
             </table>
        </div>
          
        

        <div style="margin-top:0px;">
            <table class="table" border="0"  cellspacing="0" cellpadding="0">
                <tr>
                <td>
                   <table  cellspacing="0" style="text-align:center">
                         <tr style="background-color: rgba(43, 122, 226, 0.425)">
                           <th>Own Damage Premium</th>
                           <th>Values</th>
                         </tr>
                         @foreach ($od_premium  as  $od )

                         @if(!next($od_premium))    
                         <tr style="background-color: rgba(43, 220, 226, 0.596) ">
                           <td style="font-weight: bold">{{ ucwords( str_replace("_"," ",$od['key']))}} </td>
                           <td style="font-weight: bold">{{$od['value']}}</td>
                         </tr>
                         @else
                         <tr>
                            <td>{{ ucwords( str_replace("_"," ",$od['key']))}} </td>
                            <td>{{$od['value']}}</td>
                          </tr>
                         @endif

                         @endforeach
                   </table>    
                </td>
                <td>
                   <table  cellspacing="0" cellpadding="0" style="text-align:center">
                      <tr style="background-color: rgba(43, 122, 226, 0.425) " >
                           <th>Liablity Premium</th>
                           <th>Values</th>
                      </tr>

                      @foreach ($liablity_premium  as  $lp )
                        
                      @if(!next($liablity_premium))    
                        <tr style="background-color: rgba(43, 220, 226, 0.596)  ">
                            <td style="font-weight: bold">{{ ucwords( str_replace("_"," ",$lp['key']))}}</td>
                            <td style="font-weight: bold">{{$lp['value']}}</td>
                        </tr>
                         @else
                         <tr>
                            <td>{{ ucwords( str_replace("_"," ",$lp['key']))}}</td>
                            <td>{{$lp['value']}}</td>
                          </tr>
                     @endif


                      
                  @endforeach
                     
                </table>
                </td>
                </tr>
               </table>
               
        </div>
        <div>
            <table class="table"  cellspacing="0" cellpadding="0" style="text-align:center">
                <tr style="background-color: rgba(43, 122, 226, 0.425)">
                     <th>Total Premium</th>
                     <th>Values</th>
                </tr>
                @foreach ($total_premium  as  $tp )
                          
                    @if(!next($total_premium))    
                    <tr style="background-color: rgba(43, 220, 226, 0.596)  ">
                        <td style="font-weight: bold">{{ ucwords( str_replace("_"," ",$tp['key']))}}</td>
                        <td style="font-weight: bold">{{$tp['value']}}</td>
                      </tr>
                    @else
                    <tr >
                        <td>{{ ucwords( str_replace("_"," ",$tp['key']))}}</td>
                        <td>{{$tp['value']}}</td>
                      </tr>
                    @endif
                         
                 @endforeach
          </table>
         
        </div>
           
        <div>
            <p style="font-weight:bold;font-size:20px;"> Kindly Pay Check/DD in favor of  (Company name Is here )</p>

              <p style="font-weight: bold">Documents Required:-</p>
              <ul style="list-style-type:1">
                <li>Previous Policy Copy</li>
                <li>RC Copy</li>
                 
              </ul>
              <strong> Note: </strong> In Case of Any claim ,NCB will Be revised and heance Quotation is Subject to change 
            
        </div>

        
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
  </body>
</html>