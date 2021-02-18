<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0"> الشبهات</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ Request::is('admin')? 'active': '' }} nav-item"><a href="{{ route('backend-home') }}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">لوحة التحكم</span></a>
            </li>
            <li class="nav-item has-sub"><a href="#"><i class="fa fa-user-secret"></i><span class="menu-title" data-i18n="Card">المشرفين</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::is('admin/moderators*')? 'active': '' }} nav-item"><a href="{{ route('moderators.index') }}"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="Dashboard">المشرفين</span></a>
                    </li>
                    <li class="{{ Request::is('admin/roles*')? 'active': '' }} nav-item"><a href="{{ route('roles.index') }}"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="Dashboard">صلاحيات المشرفين</span></a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/persons*')? 'active': '' }} nav-item"><a href="{{ route('persons.index') }}"><i class="fa fa-user"></i><span class="menu-title">مستخدمين الموقع</span></a>
            </li>
            <hr>
            <li class="nav-item has-sub"><a href="#"><i class="feather icon-align-justify"></i><span class="menu-title" data-i18n="Card">التصنيفات</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::is('admin/categories*')? 'active': '' }}"><a href="{{ route('categories.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Basic">التصنيفات الرئيسية</span></a>
                    </li>
                    <li class="{{ Request::is('admin/subcategories*')? 'active': '' }}"><a href="{{ route('subcategories.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Advance">التصنيفات الفرعية</span></a>
                    </li>
                    <li class="{{ Request::is('admin/tree/category*')? 'active': '' }}"><a href="{{ route('tree_category') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Advance">العرض الشجري للتصنيفات</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub"><a href="#"><i class="fa fa-question-circle"></i><span class="menu-title" data-i18n="Card">الشبهات</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::is('admin/questions*')? 'active': '' }} nav-item"><a href="{{ route('questions.index') }}"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="Dashboard">الشبهات واجاباتها</span></a>
                    </li>
                    <li class="{{ Request::is('admin/comments*')? 'active': '' }} nav-item"><a href="{{ route('comments.index') }}"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="Dashboard">تعليقات الشبهات</span></a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/folders*')? 'active': '' }} nav-item"><a href="{{ route('folders.index') }}"><i class="fa fa-folder-open"></i><span class="menu-title">ملفات متنوعة</span></a>
            </li>
            <li class="nav-item has-sub"><a href="#"><i class="fa fa-picture-o"></i><span class="menu-title" data-i18n="Card">مكتبة الوسائط</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::is('admin/videos*')? 'active': '' }}"><a href="{{ route('videos.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Basic">الفيديوهات</span></a>
                    </li>
                    <li class="{{ Request::is('admin/audios*')? 'active': '' }}"><a href="{{ route('audios.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Basic">الصوتيات</span></a>
                    </li>
                    <li class="{{ Request::is('admin/articles*')? 'active': '' }}"><a href="{{ route('articles.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Basic">المقالات</span></a>
                    </li>
                    <li class="{{ Request::is('admin/books*')? 'active': '' }}"><a href="{{ route('books.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Basic">الكتب</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub"><a href="#"><i class="fa fa-envelope"></i><span class="menu-title" data-i18n="Card">الرسائل المرسلة</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::is('admin/contacts*')? 'active': '' }}"><a href="{{ route('contacts.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Basic">كل الرسائل</span></a>
                    </li>
                    <li class="{{ Request::is('admin/new/contacts')? 'active': '' }}"><a href="{{ route('new_contact') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Advance">الرسائل غير المقروءة</span></a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/pages*')? 'active': '' }} nav-item"><a href="{{ route('pages.index') }}"><i class="feather icon-layout"></i><span class="menu-title">صفحات الموقع</span></a>
            </li>
            <li class="nav-item has-sub"><a href="#"><i class="fa fa-envelope"></i><span class="menu-title" data-i18n="Card">متابعين كل جديد</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::is('admin/subscribers')? 'active': '' }}"><a href="{{ route('subscribers') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Basic">كل المتابعين</span></a>
                    </li>
                    <li class="{{ Request::is('admin/emailForm')? 'active': '' }}"><a href="{{ route('emailForm') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Advance">ارسال رسالة</span></a>
                    </li>
                </ul>
            </li>
            <hr>
            <li class="{{ Request::is('admin/options*')? 'active': '' }} nav-item"><a href="{{ route('options.edit' , 1) }}"><i class="fa fa-cog"></i><span class="menu-title">اعدادات الموقع</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->