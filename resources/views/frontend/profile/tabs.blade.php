<div class="tab profile-tabs">
    <button id="editaccount" class="tablinks" onclick="openCity(event, 'London')">
        بياناتى
        @if(empty($user->phone) || empty($user->social_status) || empty($user->religion) ||
         empty($user->gender) )
            <i style="color:#d00000" class="fas fa-circle"></i>
        @endif
    </button>
    <button class="tablinks editaccount2 " onclick="openCity(event, 'Paris')">
        أسئلتى
        <h4>
            <span class="badge">
                {{ count($answered_questions) + count($not_answered_questions) }}
            </span>
        </h4>
    </button>
    <button class="tablinks editaccount3" onclick="openCity(event, 'Tokyo')">
        المفضلة
    </button>
    <button class="tablinks editaccount5 active" onclick="openCity(event, 'egypt')">أرسل سؤالاً</button>
    <button class="tablinks editaccount6" onclick="openCity(event, 'comments')">تعليقاتي</button>
    <a class="tablinks editaccount5" title="تسجيل الخروج" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        تسجيل الخروج
        <i class="fas fa-sign-out-alt"></i>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            {{ csrf_field() }}
        </form>
    </a>

</div>
<div class="questime">
    <h3>
        الوقت لإرسال الأسئلة
    </h3>
    <?php
        $option = \App\Models\Option::find(1);
    ?>
    <p>{{ $option->start_at }}</p>
    <p>{{ $option->end_at }}</p>
</div>