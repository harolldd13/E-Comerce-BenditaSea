<div class="topbar sh">
    <ul>
        <li class="hide-in-desktop">
            <a href="#" id="trigger_sidebar"><i class="bi bi-grid"></i></a>
        </li>
    </ul>
    <ul>
        @section('topbar_main')
        @show
        <li>
            <a href="{{url('/profile/edit')}}" class="avatar">
                <span>{{explode('', Auth::user()->name[0])}}</span>
                @if(is_null(Auth::user()->avatar))
                    <img src="{{url('/static/images/default_avatar.png')}}"> 
                 @else  
                     <img src="{{getFileUrl(Auth::user()->avatar, '64')}}"> 
                @endif
            </a>
        </li>
        <li>
            <a href="{{url('/logout')}}" data-bs-toggle="tooltip" data-bs-title="Salir"
            data-bs-placement="left">
             <i class="bi bi-box-arrow-right"></i>
            </a>
        </li>
       
  
    </ul>
</div>