<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .page-break {
            page-break-after: always;
        }
        .bg-grey {
            background: #F3F3F3;
        }
        .text-right {
            text-align: right;
        }

        .w-full {
            width: 100%;
        }

        .small-width {
            width: 15%;
        }
        .invoice {
            background: white;
            border: 1px solid #CCC;
            font-size: 14px;
            padding: 48px;
            margin: 20px 0;
        }
    </style>
</head>
<body class="bg-grey">

  <div class="container container-smaller">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1" style="margin-top:20px; text-align: right">
        <div class="btn-group mb-4">
          <a href="/invoice-pdf" class="btn btn-success">Save as PDF</a>
        </div>
      </div>
    </div>


    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="invoice">
              <div class="row">
                
                <div class="col-sm-6">
                  <h4>Sender Information</h4>
                  <p><strong>Name:</strong> {{$data->sender_name}}</p>
                  <p><strong>Phone:</strong> +251{{$data->sender_phone}}</p>
                  <p><strong>Sender city:</strong> {{$data->sender_city}}</p>
                </div>
  
            <div class="col-sm-6 text-right">
                <table class="w-full">
                    <tbody>
                      <tr>
                        
                        <td>Jun 24, 2019</td>
                      </tr>
                    </tbody>
                  </table>
                  <div style="display: flex; align-items: center; justify-content: space-between; margin-left: 200px;">
                    <span class="hidden-lg hidden-md hidden-sm" style="font-size: 1.5em;">WagaExpress</span>
                    <span class="visible-lg visible-md visible-sm" style="font-size: 2em;">WagaExpress</span>
                    <img src="{{ asset('backend/assets/img/logo.png') }}" alt="" style="max-height: 50px; margin-left: 10px;">
                </div>
                
                
                
                
                
                
                
            </div>
            </div>

            <div class="row">

              <div class="col-sm-7">
                <h4>Receiver Information</h4>
                <p><strong>Name:</strong> {{$data->receiver_name}}</p>
                <p><strong>Phone:</strong> +251{{$data->receiver_phone}}</p>
                <p><strong>Receiver city:</strong> {{$data->receiver_city}}</p>
              </div>


              <div class="col-sm-5 text-right">
                

                <div style="margin-bottom: 0px">&nbsp;</div>

                <table class="w-full">
                  <tbody>
                    <tr class="well" style="padding: 5px">
                     
                      <div class="col-md-12">
                        
                    </div>
                      {{-- <td style="padding: 5px"><strong> $499 </strong></td> --}}
                    </tr>
                  </tbody>
                </table>


            </div>
        </div>

        <div class="table-responsive">
            <table class="table invoice-table">
              <thead style="background: #F5F5F5;">
                <tr>
                  <th>Package Details</th>
                  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                      {{-- <strong>Service</strong> --}}
                      <p><strong>Package Type:</strong> {{ $data->package_type }}</p>
                  </td>
                  <td></td>
                  <td><p><strong>Weight:</strong> {{ $weight->weight }} Kg</p></td>
                  <td><p><strong>Price:</strong> {{$price->price}} ETB</p></td>
                  
                  
                </tr>

                

                </tbody>
              </table>
            </div><!-- /table-responsive -->

            <table class="table invoice-total">
              <tbody>
                <tr>
                 
                  <td class="text-right"><p><strong>Total Price: </strong> {{$price->price}} ETB</p></td>
                </tr>
              </tbody>
            </table>

            <hr>

            <div class="row">
              <div class="col-lg-8">
                <div class="invbody-terms">
                  Thank you for choosing WagaExpress. <br>
                  <br>
                  <h4>Payment Terms and Methods</h4>
                  <p>
                    CBE, telebirr
                  </p>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

</body>
</html>
