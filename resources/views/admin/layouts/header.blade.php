<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!-- Nav Item - Alerts -->

        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown dropdown-notifications no-arrow ">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="icon fas fa-bell"></i>
                    @php
                        $unReadNotification = DB::table('notifications')->where('notifiable_id', Auth::user()->user_id)->where('read_at', NULL)->get();
                        $numberOfUnReadNotification = count($unReadNotification);
                    @endphp
                    <span id="noticenumberOfUnReadNotification" class="caret txt @if ($numberOfUnReadNotification<=0) hidden 
                    @endif"><span id="numberOfUnReadNotification">{{$numberOfUnReadNotification}}</span></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right menu-notification" aria-labelledby="navbarDropdown">
                <div class = "dropdown-item">
                    <a class="float-right" data-user = "0" onClick="markAllAsRead(this)">
                        {{trans('language.markAllAsRead')}}
                    </a>
                </div>
                <div id="list_notifications">
                @foreach (Auth::user()->notifications as $notification)
                    <div id="noti{{$notification->id}}">
                        <a class="dropdown-item @if (!$notification->read_at)
                            bg-info text-white
                        @endif" href="{{route('admin.payment.show',$notification->data['payment_id'])}}">
                            <span>{{ $notification->data['title'] }}</span><br>
                            <small>{{ $notification->data['content'] }}</small>
                        </a>
                        @if (!$notification->read_at)
                            <a class="float-right" data-id={{$notification->id}} data-user = "0" onClick="markAsRead(this)">
                                {{trans('language.markAsRead')}}
                            </a>
                        @endif
                        <hr>
                    </div>
                    @endforeach
                </div>
            </div>
        </li>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                <img class="img-profile rounded-circle" src="assets/admin/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('admin.logout')}}" >
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{trans('language.logout')}}
                </a>
            </div>
        </li>
    </ul>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
</nav>