<nav class="navbar px-navbar">
    <!-- Header -->
    <div class="navbar-header">
    <a class="navbar-brand px-demo-brand" href="{{ urlBackend('dashboard/index') }}">Cpanel Admin</a>
    </div>

    <!-- Navbar togglers -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-demo-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="px-demo-navbar-collapse">
      <ul class="nav navbar-nav">

        
      </ul>

      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="hidden-md">{{ getUser()->username }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ urlBackend('profile/index') }}"><span class="label label-warning pull-xs-right"><i class="fa fa-asterisk"></i></span>Profile</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('login/logout') }}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
          </ul>
        </li>
        
        <li class="dropdown">
          <a href="https://google.com" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="px-navbar-icon fa fa-bell font-size-24"></i>
            <span class="px-navbar-icon-label">Income messages</span>
            <?php
            $counter = 0;
            if (count($notif) > 0) {
              foreach ($notif as $key => $value) {
                if ($value->read == 'pending') $counter += 1;
              }
            } 
            
            ?>
            <span class="px-navbar-label label @if($counter > 0) label-danger @endif notif-counter" style="padding: 2px;font-size: 11px">{{ $counter }}</span>
          </a>
          <div class="dropdown-menu p-a-0">
            <div id="navbar-messages" style="height: 200px; position: relative;">
              @if($notif)
              @foreach($notif as $event)
              <div class="widget-messages-alt-item " @if($event->read == 'read') style="background-color:#ccc" @endif>
                <div class="widget-messages-alt-avatar font-size-24"><i class="fa fa-envelope"></i></div>
                <?php
                $detail = ($event->type == 'cooperation') ? 'cooperation-category' : 'usulan-kerjasama';
                ?>
                <a href="javascript:void(0)" data-href="{{ urlBackend($detail.'/update/'.$event->id.'/notif')}}" class="widget-messages-alt-subject text-truncate" data-id="{{$event->id}}" data-type="{{$event->type}}">{{ $event->title }}</a>
                <!-- <div class="widget-messages-alt-description">from <a href="#">Administrator</a></div> -->
                <!-- <div class="widget-messages-alt-date">2h ago</div> -->
              </div>
              @endforeach
              @endif
              
            </div>

            <!-- <a href="#" class="widget-more-link">MORE MESSAGES</a> -->
          </div> <!-- / .dropdown-menu -->
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </nav>

  @push('script-js')
    <script type="text/javascript">
  
      $('.text-truncate').click(function(){
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var url = $(this).attr('data-href');
          
        $.ajax({
          type : 'get',
          url : '{{ urlBackend("dashboard/open-notif") }}',
          data : {
            id : id,
            type : type,
          },
          success : function(data){
            

            if (data.status == true) {
              window.location.href=url;
            }
            
          },
        });
      })
    </script>
  @endpush