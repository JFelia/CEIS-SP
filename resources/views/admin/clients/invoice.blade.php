@extends('layouts.adminLayout.admin_design')
@section('content')


<section class="content-header">
      <h1>
        Invoice
        <!-- <small>#007612</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Greymouse Investments, Ltd, Inc.
            <small class="pull-right"><?php echo date('F d, Y',strtotime(NOW())); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Greymouse Investments</strong><br>
            Tagas, Daraga, Albay, Philippines<br>
         
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <?php 
            $counter = 0;
            foreach ($messages as $object) {
              if($counter == 0){
           ?>
          <address>
            <strong>{{$object->contact_person}}</strong><br>
           
            Phone: {{$object->contact_no}}<br>
            Email: {{$object->email}}
          </address>
          <?php } $counter++;} ?>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          
          <br>
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <!-- <th>Qty</th> -->
              <th>Sender</th>
              <th>Recipient #</th>
              <th>Message</th>
              <th>Date & Time</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
             <?php 
                $bill = 0; 
                foreach($messages as $object){
                  $bill = $bill + $object->rateperhour;
              ?>
            <tr>
              <!-- <td>1</td> -->
              <td>{{$object->staff}}</td>
              <td>{{$object->number}}</td>
              <td>{{$object->message}}</td>
              <td>{{date('F d, Y - h:i:sa, l',strtotime($object->created_at))}}</td>
              <td>${{$object->rateperhour}}</td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <!-- <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="{{asset('LTE/dist/img/credit/visa.png')}}" alt="Visa">
          <img src="{{asset('LTE/dist/img/credit/mastercard.png')}}" alt="Mastercard">
          <img src="{{asset('LTE/dist/img/credit/american-express.png')}}" alt="American Express">
          <img src="{{asset('LTE/dist/img/credit/paypal2.png')}}" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-6">
          <!-- <p class="lead">Amount Due 2/22/2014</p> -->

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>${{$bill}}</td>
              </tr>
              <tr>
                <th>Tax (9.3%)</th>
                <td>${{$bill * 0.93}}</td>
              </tr>
              
              <tr>
                <th>Total:</th>
                <td>${{$bill + ($bill * 0.93)}}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <!-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
          <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button> -->
          <a href="{{url('/invoicePDF')}}" class="btn btn-primary pull-right"><i class="fa fa-download"></i> DOWNLOAD PDF</a>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>

@endsection