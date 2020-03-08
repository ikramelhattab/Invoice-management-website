<?php
use NumberToWords\NumberToWords;

?>

@extends('adminlte::page')

@section('htmlheader_title')
show facture
@endsection


@section('main-content')


<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DL PRO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
 
        </head>             
	<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> DL PRO


            <small class="pull-right">Date : <?php $now = new DateTime();
echo $now->format('d-m-Y');
?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
    

        <div>
         <center><b>Invoice number :</b> {{$data->id}}</center>
        </div>

         <div>
         <p><label><b>Customer name :</b></label> {{$data->nom}}</p>
        </div>


         <div>
         <p> <label><b>Registration number :</b> </label>{{$data->matricule}}</p>
        </div>


         <div>
         <p> <label><b>Adress :</b></label> {{$data->adresse}}</p>
        </div>


        <!-- /.col -->
      </div>

      <br>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          
                   <?php echo $output; ?>

          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row no-print">
        <div class="col-xs-12">
          <a href="" target="_blank"  onclick="window.print();"><i></i></a>
                  </div>
                  <div class="col-xs-12">
                    <a href="{{url('/facture/pdf/' . $fac_id)}}" type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF</a>
</div>

      </div>


    </section>

@endsection


