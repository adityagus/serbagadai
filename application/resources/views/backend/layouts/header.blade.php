<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <li class="dropdown dropdown-user">
            <a class="dropdown-toggle padding-besides" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                Hi, {{ \Auth::user()->name }}
            </a>
        </li>
        <li class="dropdown dropdown-user">
            <a class="dropdown-toggle padding-besides" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="fa fa-envelope"></i>
                <span style="font-size: 10px;margin-top: -6px;margin-left: -1px;position: absolute;">{{ $notification['count'] }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
                @foreach($notification['list'] as $notifKey => $notif)
                    @if($notifKey == 6)
                    @break
                    @endif
                <li>
                    <a href="{{ route(\App\Util\Constant::NOTIFICATION_LINK[$notif->type]) }}">
                        <i class="fa fa-{{ \App\Util\Constant::NOTIFICATION_ICON[$notif->type] }}"></i> {{ $notif->subject }} </a>
                </li>
                @endforeach
                <li><a href="" class="text-center alert-success">Lihat Selengkapnya</a></li>
                <li><a href="javascipt:;" onclick="clearNotification()" class="text-center alert-danger">Kosongkan Notifikasi</a></li>
            </ul>
        </li>
        <li class="dropdown dropdown-quick-sidebar-toggler">
            <a href="{{url('logout')}}" class="dropdown-toggle">
                <span class="logout-text">Logout</span> <i class="icon-logout"></i>
            </a>
        </li>
    </ul>
</div>
