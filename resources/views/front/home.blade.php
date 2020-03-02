@extends('layouts.frontendLayout.front_design')
@section('content')

  @if(session()->get('content') == 'true')
    @foreach($content as $object)

      <div style="margin-top: 10%; margin-bottom: 15%;">
        <center>
        <h3 style="margin-top: 3%">{{$object->title}}</h3>
        <p style="margin-top: 3%">{{$object->content}}</p>
        </center>
      </div>
    @endforeach
  @else
    @if(Session::has('flash_message_error'))
              <div class="alert alert-dismissable alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <strong><i class="icon fa fa-ban"></i>{!! session('flash_message_error') !!}</strong>
              </div>
          @endif
  @if(Session::has('flash_message_success'))
              <div class="alert alert-dismissable alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                      <strong><i class="icon fa fa-check"></i>{!! session('flash_message_success') !!}</strong>
              </div>
          @endif
    @foreach($page as $obj)
      @if($obj->background1 != null)    
        <div class="pimg1" style="background-image: url('/LTE/dist/img/page/{{$obj->background1}}');">
        	@if($obj->title1 != null)
          	<div class="ptext">
              <span class="border trans">
                {{$obj->title1}}			       
              </span>
          	</div>
          @endif
        </div>
      @endif
    @endforeach

    @foreach($page as $obj)
      @if($obj->content1 != null)    
        <section class="section section-light">
          @if($obj->subject1 != null)
          <center>
            <h2>{{$obj->subject1}}</h2>
          </center>
          @endif

          <?php echo $obj->content1 ?>
          
        </section>
      @endif
    @endforeach
    
    @foreach($page as $obj)
      @if($obj->background2 != null)    
        <div class="pimg2" style="background-image: url('/LTE/dist/img/page/{{$obj->background2}}');">
          @if($obj->title2 != null)
            <div class="ptext">
              <span class="border trans">
                {{$obj->title2}}             
              </span>
            </div>
          @endif
        </div>
      @endif
    @endforeach

    @foreach($page as $obj)
      @if($obj->content2 != null)    
        <section class="section section-light">
          @if($obj->subject2 != null)
          <center>
            <h2>{{$obj->subject2}}</h2>
          </center>
          @endif
          <?php echo $obj->content2 ?>
        </section>
      @endif
    @endforeach

     @foreach($page as $obj)
      @if($obj->background3 != null)    
        <div class="pimg3" style="background-image: url('/LTE/dist/img/page/{{$obj->background3}}');">
          @if($obj->title3 != null)
            <div class="ptext">
              <span class="border trans">
                {{$obj->title3}}             
              </span>
            </div>
          @endif
        </div>
      @endif
    @endforeach

    @foreach($page as $obj)
      @if($obj->content3 != null)    
        <section class="section section-light">
          @if($obj->subject3 != null)
          <center>
            <h2>{{$obj->subject3}}</h2>
          </center>  
          @endif
          <?php echo $obj->content3 ?>
        </section>
      @endif
    @endforeach

    @foreach($page as $obj)
      @if($obj->background1 != null)    
        <div class="pimg1" style="background-image: url('/LTE/dist/img/page/{{$obj->background1}}');">
          @if($obj->title1 != null)
            <div class="ptext">
              <span class="border trans">
                {{$obj->title1}}             
              </span>
            </div>
          @endif
        </div>
      @endif
    @endforeach

    @foreach($page as $obj)
      @if($obj->newsfeeds != null)    
        <section class="section section-dark">
          <center>
            <h2>NewsFeeds</h2>
          </center>
          <?php echo $obj->newsfeeds; ?>
        </section>
      @endif
    @endforeach

@endif

<section class="section section-light">
	<div class="row" style="margin-top: 5%; margin-bottom: 5%;">
       <div class="col-lg-1 col-md-1 col-sm-1">
       		
       </div>
       <div class="col-lg-2 col-md-2 col-sm-2">
       		<center>
            <h1><a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a></h1>
         		<p>Engage us and our followers - get the most out of our social feed</p>
          </center>  
       </div>
       <div class="col-lg-2 col-md-2 col-sm-2">
       		<center>
            <h1><a href=""><i style="color:red" class="fa fa-fw fa-youtube"></i></a></h1>
         		<p>Maximize your virtual workforce with our video tips</p>
          </center>
          <!-- <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                  <a>
                  <img src="/LTE/dist/img/image004.png" width="20%" style="margin-bottom: 15px; margin-top: 4px">
                  </a>
                </center>
              </div> -->
       </div>
       <div class="col-lg-2 col-md-2 col-sm-2">
       		<center>
            <h1><a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a></h1>
         		<p>Quick conversations and knowledge bites in 140 characters</p>
          </center>  
       </div>
       <div class="col-lg-2 col-md-2 col-sm-2">
       		<center>
            <h1><a class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a></h1>
         		<p>Greymouse in the professional world</p>
          </center>  
       </div>
       <div class="col-lg-2 col-md-2 col-sm-2">
       		<center>
            <h1><a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a></h1>
         		<p>Connect with us visually - Greymouse photos and monochrome stories</p>
          </center>  
       </div>
       <div class="col-lg-1 col-md-1 col-sm-1">
       		
       </div>
    </div>
</section>

<section class="section section-superdark">
	
	<div class="row">
       <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
       		
       </div>

       <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
          @foreach($page as $obj)
            @if($obj->logo != null)    
              <center>
              <img src="/LTE/dist/img/page/{{$obj->logo}}" width="80%" class="pull-left" style="margin-left: 10%;margin-bottom: 5px;">
              </center>
            @endif
          @endforeach
          
       </div>
       <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <center>
       		<p>
       			Get a free quote of any of our services.
       			<br>
       			Contact us today!
       			<br>
       			<h3><i class="fa fa-fw fa-skype"></i><i class="fa fa-fw fa-message"></i></h3>
       		</p>
          </center>
       </div>
       <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
       		<p align="left">Get in touch</p>
       		<form role="form" action="{{url('/getintouch')}}" method="post">
       		{{csrf_field()}}
       			<div class="box-body">
       			  <div class="form-group{{$errors->has('fullname')?' has-error' : ''}}">
                    <input type="text" class="form-control" name="fullname" placeholder="Full Name">
                    {!! $errors->first('fullname','<span class="help-block">:message</span>') !!}
              </div>
              <div class="form-group{{$errors->has('email')?' has-error' : ''}}">
                  <input type="email" class="form-control" name="email" placeholder="Email Address">
                  {!! $errors->first('email','<span class="help-block">:message</span>') !!}
              </div>
              <div class="form-group{{$errors->has('message')?' has-error' : ''}}">
                  <textarea placeholder="Message" class="form-control" name="message"></textarea>
                  {!! $errors->first('message','<span class="help-block">:message</span>') !!}
              </div>
              <button align="left" type="submit" class="btn btn-primary">Submit</button>
            </div>
       		</form>
       </div>
    </div>
    @foreach($page as $obj)
      @if($obj->footer != null)    
        <center>
        <p>&copy; {{$obj->footer}}</p>
        </center>
      @endif
    @endforeach
</section>

<!-- </div> -->
@endsection

<!-- 
We have delivered reliable virtual services to our clients in the South Pacific region for more than a decade now. We have helped businesses grow through our culture of honesty,  integrity, teamwork, and transparency. We believe these ideals will keep us on track towards our growth aspirations as a premium virtual workforce provider. -->



<!-- We do this  through an advocacy - alleviating poverty through employment. When you grow your business with us, you also get an opportunity to improve people's lives. -->





<!-- <section class="section section-light">
      <h2>We provide our clients with the ability to expand their operations, human capital and resources across different time zones and geographical regions.</h2>  
      <p>
        Greymouse is a Virtual Human Resource provider founded by Australian entrepreneurs Kelvin Davis and Marisa Wiman in 2005. Greymouse has since then consistently provided businesses with high quality, time-sensitive and cost effective services through off-shoring facilities based in Suva, Fiji Islands and Legazpi City, Philippines.
        <br><br>
        Way back in 2002, the word 'outsourcing' was considered a jargon for a non-existent industry. But it was when Kelvin and Marisa started to explore the possibility of starting a company built around Internet Connectivity. More than a decade later, Greymouse's journey as one of the top virtual workforce provider in the world was ambitious, but purpose and determination was the key in conquering boundaries, reaching out to clients wherever they are at the speed of Google.
        <br><br>
        Greymouse works at a socially-conscious level. We are more than just a business. Our purpose is to alleviate poverty through transformational employment. We make this possible by taking a proactive role in the personal and professional development of our team members and horing their skills in line with global standards.
      </p>
    </section> -->


<!-- <h2>VISION</h2>	
	<p>
	 	Greymouse gives entrepreneurs and business owners FREEDOM in their lives.
	 	<br><br>
	 	We do this by releasing the business owner from mundane tasks, leveraging virtual workforce to allow for focus to key business functions. Greymouse supplies a customer service experience that exceeds world standards, delighting and exciting our clients and building long-term relationships with them.
	</p> -->



<!-- <h2>MISSION</h2>	
	<p>
	 	Together, we shall achieve our Vision by using technologies and world-class talent to deliver a customer service experience built on excellence and trust.
	 	<br>
	 	Listening to our client's needs, we cement an unbreakable bond by continually learning and adapting to ensure our client's business success.
	 	<br>
	 	We will complete our client's work on time with accuracy, dedication and personal ownership of the tasks, duties and responsibilities.
	 	<br>
	 	We will delight our clients by consistently and reliably actioning and responding to their needs and wants. We do this by communicating quickly and efficiently through all point of contact.
	</p> -->