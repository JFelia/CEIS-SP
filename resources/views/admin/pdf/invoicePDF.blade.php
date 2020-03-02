<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

    <section class="invoice">
    	<center>
	      	<p><b>Greymouse Investments, Ltd, Inc</b><br>
	      	<?php echo date('F d, Y',strtotime(NOW())); ?><br>
	      	<b>Invoice</b>
          </p>
      	</center>
      	<p align="right">
      			
      	</p>
      	<p>
      		From: <br>
      		<b>Greymouse Investments.</b><br>
      		
      	</p>
      	<p>
      		To: <br>
      		<?php 
            $counter = 0;
            foreach ($messages as $object) {
              if($counter == 0){
          	 ?>
            <b>{{$object->contact_person}}</b><br>
            <!-- 795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br> -->
            Phone: {{$object->contact_no}}<br>
            Email: {{$object->email}}
          	<?php } $counter++;} ?>
      	</p>
      	<p>
      		<!-- <b>Payment Due:</b> 2/22/2014	 -->
      	</p>

          <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <thead>
            <tr>
              <!-- <th>Qty</th> -->
              <th>Sender</th>
              <th>Recipient #</th>
              <th>Message</th>
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
              <td>${{$object->rateperhour}}</td>
            </tr>
            <?php } ?>
            </tbody>
          </table>

      <div class="row">
        
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
      </div>
    </section>
</body>
</html>