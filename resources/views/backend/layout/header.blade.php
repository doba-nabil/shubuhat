<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav @if(Auth::user()->dark_mode == 1) navbar-dark @else navbar-light @endif navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a
                                    class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                        class="ficon feather icon-menu"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                    class="ficon feather icon-maximize"></i></a></li>
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                                                                           data-toggle="dropdown"><i
                                    class="ficon feather icon-bell"></i><span
                                    class="badge badge-pill badge-primary badge-up">
                                {{ $question_no + $comment_no + $user_no + $contact_no + $message_no + $send_question_no }}
                            </span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <h3 class="white">{{ $question_no + $comment_no + $user_no + $contact_no + $message_no + $send_question_no }}</h3>
                                    <span class="notification-title">اشعار جديد</span>
                                </div>
                            </li>
                            <li class="scrollable-container media-list">
                                @foreach (Auth::user()->unreadNotifications as $notification)
                                    <a notification="{{ $notification->id }}" data-token="{{ csrf_token() }}"
                                       class="marked_as_read" href="
                                @if ($notification->type == 'App\Notifications\OrderNotification')
                                    {{ route('questions.show', $notification->data['question']['slug']) }}
                                    @elseif ($notification->type == 'App\Notifications\UsercommNotification')
                                    {{ route('comments.show', $notification->data['usercomment']['id']) }}
                                    @elseif ($notification->type == 'App\Notifications\UserNotification')
                                    {{ route('persons.edit', $notification->data['user']['id']) }}
                                    @elseif ($notification->type == 'App\Notifications\contactnotification')
                                    {{ route('contacts.show', $notification->data['contact']['id']) }}
                                    @elseif ($notification->type == 'App\Notifications\newMessage')
                                    {{ route('subscribers') }}
                                    @elseif ($notification->type == 'App\Notifications\SendQuestionNotification')
                                    {{ route('question_moderator' , $notification->data['question']['slug']) }}
                                    @endif
                                            "
                                    >
                                        <div class="media d-flex align-items-start">
                                            @if ($notification->type == 'App\Notifications\OrderNotification')
                                                <div class="media-left"><i
                                                            class="fa fa-question-circle font-medium-5 primary"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="primary media-heading">سؤال جديد</h6>
                                                    <small class="notification-text">
                                                        تم استقبال سؤال جديد.
                                                        {{ $notification->data['question']['mini_question'] ?? '' }}
                                                    </small>
                                                </div>
                                                <small>
                                                    <time class="media-meta">{{ $notification->created_at->diffForHumans() }}</time>
                                                </small>
                                            @elseif ($notification->type == 'App\Notifications\UsercommNotification')
                                                <div class="media-left"><i
                                                            class="fa fa-comment-o font-medium-5 danger"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="danger media-heading">تعليق جديد</h6>
                                                    <small class="notification-text">
                                                        <?php
                                                            $user = \App\User::find($notification->data['usercomment']['user_id']);
                                                        ?>
                                                        تعليق جديد من قبل المستخدم {{ $user->name }}
                                                    </small>
                                                </div>
                                                <small>
                                                    <time class="media-meta">{{ $notification->created_at->diffForHumans() }}</time>
                                                </small>
                                            @elseif ($notification->type == 'App\Notifications\UserNotification')
                                                <div class="media-left"><i
                                                            class="fa fa-user-plus font-medium-5 success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="success media-heading">عضوية جديدة</h6>
                                                    <small class="notification-text">
                                                        عضوية جديدة بأسم.
                                                        {{ $notification->data['user']['name'] ?? '' }}
                                                    </small>
                                                </div>
                                                <small>
                                                    <time class="media-meta">{{ $notification->created_at->diffForHumans() }}</time>
                                                </small>
                                            @elseif ($notification->type == 'App\Notifications\contactnotification')
                                                <div class="media-left"><i
                                                            class="fa fa-envelope-o font-medium-5 info"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="info media-heading">رسالة جديدة</h6>
                                                    <small class="notification-text">
                                                        رسالة جديدة من
                                                        {{ $notification->data['contact']['name'] ?? '' }}
                                                    </small>
                                                </div>
                                                <small>
                                                    <time class="media-meta">{{ $notification->created_at->diffForHumans() }}</time>
                                                </small>
                                            @elseif ($notification->type == 'App\Notifications\newMessage')
                                                <div class="media-left"><i
                                                            class="fa fa-handshake-o font-medium-5 warning"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="warning media-heading">متابعة جديدة</h6>
                                                    <small class="notification-text">
                                                        البريد :
                                                        {{ $notification->data['message']['email'] ?? '' }}
                                                    </small>
                                                </div>
                                                <small>
                                                    <time class="media-meta">{{ $notification->created_at->diffForHumans() }}</time>
                                                </small>
                                            @elseif ($notification->type == 'App\Notifications\SendQuestionNotification')
                                                <div class="media-left"><i
                                                            class="fa fa-handshake-o font-medium-5 warning"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="warning media-heading">سؤال جديد مرسل للاجابة</h6>
                                                    <small class="notification-text">
                                                        السؤال :
                                                        {{ $notification->data['question']['mini_question'] ?? '' }}
                                                    </small>
                                                </div>
                                                <small>
                                                    <time class="media-meta">{{ $notification->created_at->diffForHumans() }}</time>
                                                </small>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center"></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a title="تفعيل الوضع الليلي" class="nav-link nav-link-label" ad="{{ Auth::user()->id }}"
                           role="button" style="cursor: pointer" id="dark_btn" data-token="{{ csrf_token() }}"><i
                                    class="ficon feather icon-moon"></i></a>
                        <a title="تفعيل الوضع النهاري" class="nav-link nav-link-label" ad="{{ Auth::user()->id }}"
                           role="button" style="cursor: pointer" id="light_btn" data-token="{{ csrf_token() }}"><i
                                    class="ficon feather icon-sun"></i></a>
                    </li>
                    <li title="تسجيل خروج" class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-label" href="{{ route('logoutt') }}"><i
                                    class="ficon feather icon-log-out"></i></a>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span
                                        class="user-name text-bold-600">{{--{{ Auth::user()->name }}--}}</span><span
                                        class="user-status"></span></div>
                            <span>{{--<img class="round" src="{{ asset('backend') }}/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40">--}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- END: Header-->