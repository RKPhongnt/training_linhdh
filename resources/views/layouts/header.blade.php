<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="{{route('home')}}"><img src="http://rikkeisoft.com/wp-content/themes/rikkei/images/common/logo.png" style="width: 180px; padding: 10px" ></a>
    </div>
    <!-- /.navbar-header -->
    <div>
         <form action="{{ route('switchLang') }}" class="form-lang" method="post" style="float: right;">
            <select name="locale" onchange='this.form.submit();'>
                <option value="en">English</option>
                <option value="vi"{{ Lang::locale() === 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
            </select>
            {{ csrf_field() }}
            </form>
    </div>
    <ul class="nav navbar-top-links navbar-right" style="margin-top: 36px;">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                {{Auth::user()->name}}
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                @if(Auth::user()->isAdmin)
                    <li><a href="{{url("/admin/")}}"><i class="fa fa-user fa-fw"></i> {{trans('text.admin_page')}}</a></li>
                @endif
                <li><a href="{{url("/users/".Auth::user()->id)}}"><i class="fa fa-user fa-fw"></i> {{trans('text.user_profile')}}</a>
                </li>
                </li>
                <li><a href="{{route('divisions.index')}}"><i class="fa fa-gear fa-fw"></i> {{trans('text.division')}}</a>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i> {{trans('text.logout')}}</a>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    
    <!-- /.navbar-static-side -->
</nav>
