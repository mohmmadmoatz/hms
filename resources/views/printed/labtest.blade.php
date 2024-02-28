<!DOCTYPE html>
<html>
<head>
  <title>طباعة فحوصات مختبر</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    type="text/css">
  <link rel="stylesheet" href="theme.css" type="text/css">
</head>

<style>
        @font-face {
  font-family: tajwal;
  src: url({{asset('css/Tajawal-Regular.ttf')}});
}
    body {
    font-family: tajwal;
    font-size:22px;

  }
  h3{
    font-family: tajwal !important;
  }
  h4{
    font-family: tajwal !important;
  }
  h5{
    font-family: tajwal !important;
  }

  table{
      text-align: right;
  }

  

 .table-striped tbody tr:nth-of-type(odd) th {
    background-color: rgba(0, 0, 0, .05)!important;
}




@media print {
  #spacer {height: 2em;} /* height of footer + a little extra */
  #footer {
    position: fixed;
    bottom: 0;
  }
}

</style>


@php

$id = $_GET['id'];
$lab = App\Models\Lab::find($id);
$tests = App\Models\PatTests::where("lab_id",$lab->id)->get();

$testSameCategory = $tests->groupBy('category_id');  
//dd($testSameCategory);

@endphp

<body>


@foreach($testSameCategory as $item)
  <div class="py-2">
    <div class="container">
      <div class="row">
        <div class="col-md-12" align="center">
          <img  src="{{asset('headerimage.png')}}?changed=1" width="100%">
        </div>
      </div>



      <div class="row py-3">
        <table class="table table-bordered table-striped" style="text-align:left">
               <tr>
                   <th>Name: <span style="float:right"> {{$lab->patient->name}} </span> </th>
                   <th>Age:  <span style="float:right"> {{$lab->patient->age}} </span> </th>
              
               </tr>
               <tr>
                   <th>Consultant:</th>
                   <th>Date: {{$lab->created_at->format("Y-m-d")}} </th>
                  
               </tr>
               <tr>
                   <th>Sample Time:</th>
                   <th>Report time:</th>
                   
               </tr>
               <tr>
                <th>Barcode</th>
                <th> <svg class="barcode"
  jsbarcode-value="GS-{{$lab->id}}"
  jsbarcode-height="40"
  jsbarcode-textmargin="0"
  jsbarcode-fontoptions="bold">
</svg></th>
               </tr>
        </table>

  


        @foreach($item as $test)
        <div class="container-fluid content-block">
        <h2 align="center" style="font-weight:bold;color:red">{{$test->test->name ??""}}</h2>
        <hr>
        </div>

        <table class="table table-bordered table-striped content-block" style="text-align:left">
        <thead>
            <tr>
                <th>TEST</th>
                <th>RESULT</th>
                <th>UNIT</th>
                <th>Normal Range</th>
            </tr>
        </thead>
       
        <tbody>
            @foreach(App\Models\PatTestComponet::where("pat_test_id",$test->id)->get() as $sub)
        <tr>
                <th>{{$sub->componet->name ??""}}</th>
                <th>{{$sub->result ??""}}</th>

                <th>{{$sub->componet->unit ??""}}</th>

                <th style="white-space: pre;">{{$sub->componet->normal_range ??""}}</th>

            </tr>
            @endforeach
        </tbody>

        <tfoot>
    <tr>
      <td id="spacer" colspan="4"></td>
    </tr>
  </tfoot>
        </table>

        @endforeach
    


     




      </div>
     
    </div>
  </div>


  


  <img id="footer" src="{{asset('d.png')}}" width="100%">

  </div>
  <div style="page-break-before: always"></div>
  @endforeach

  @if($lab->image)
  <img src="{{asset('storage/'.$lab->image)}}" width="100%">
  @endif
</body>

<script src="{{asset('js/barcode.js')}}"></script>
 <script>
     JsBarcode(".barcode").init();

 </script>

</html>