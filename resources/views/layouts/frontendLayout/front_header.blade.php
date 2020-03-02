
<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            @foreach($page as $obj)
              @if($obj->logo != null)
                @if($obj->logo == 'default_user.png')
                <img src="/LTE/dist/img/page/{{$obj->logo}}" width="50%" class="pull-left" style="margin-right: 2%;margin-top: 5px;margin-bottom: 5px;">
                @else
                <img src="/LTE/dist/img/page/{{$obj->logo}}" width="50%" class="pull-left" style="margin-right: 2%;margin-top: 5px;margin-bottom: 5px;">
                @endif
              @endif
            @endforeach
          </div>
          <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12" style="margin-top: 40px;color:white">
            @foreach($page as $obj)
              @if($obj->header != null)
                <?php echo $obj->header; ?>
              @endif
            @endforeach
          </div>

        </div>
        
        <div class="navbar-header">
          <a href="/greymouse" class="navbar-brand"><b>Greymouse</b>Portal</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            @foreach($parents as $obj)
              @if($obj->haschild == 'true')
                <li class="dropdown">
                    <a href="/contentmanager/{{$obj->id}}" class="dropdown-toggle" data-toggle="dropdown">{{$obj->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
              @else
                <li><a href="/contentmanager/{{$obj->id}}">{{$obj->name}}</a></li>    
              @endif

              @foreach($childs as $newobj)
                @if($obj->id == $newobj->parent)
                  <li><a href="/contentmanager/{{$newobj->id}}">{{$newobj->name}}</a></li>
                @endif
              @endforeach
              @if($obj->haschild == 'true')
                  </ul>
                </li>
              @endif
            @endforeach
            <li style=""><a data-toggle="modal" data-target="#modal-apply">Apply</a></li>

            <li style=""><a href="{{url('/admin')}}">Sign In</a></li>
          </ul>
        </div>
        <div>
        </div>
      </div>
    </nav>
  </header>


  <div class="modal modal-primary fade" id="modal-apply">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Submit Resume</h4>
              </div>
              <form enctype="multipart/form-data" action="{{url('/apply')}}" method="POST">
              <div class="modal-body">

                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" class="form-control" placeholder="Enter Full Name" name="name" autocomplete="off">
                </div>
                <div class="form-group">
                  <label>Preferred Job</label>
                  <input type="text" class="form-control" placeholder="Job" name="job" autocomplete="off">
                </div>
                <div class="form-group">
                  <label>Resume</label>
                  <input type="file" name="resume" accept=".docx, application/pdf">
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
              </form>
            </div>
          </div>
        </div>

        