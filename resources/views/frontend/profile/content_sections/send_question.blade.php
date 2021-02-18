<div  style="display: block" id="egypt" class="tabcontent active">
    <div class="formprogress">
        <div class="clearfix"></div>
        <div class="progresscircle">
            <h4 class="text-center mb-3 sendques">أرسل سؤالاً</h4>
            <ul class="progressbar">
                <li class="progressbar1
                    @if(!empty($user->phone) || empty(!$user->social_status) || empty(!$user->religion)
                    ||empty(!$user->gender))
                        active
                    @endif">
                    أكمل بياناتك
                </li>
                <li class="progressbar2
                    @if($user->complete == 1 && $user->verified == 1)
                        active
                     @endif
                        ">معلومات الاتصال
                </li>
                <li class="progressbar3
                    @if($user->complete == 1 && $user->verified == 1 && $user->terms == 1)
                        active
                    @endif
                    ">شروط السؤال</li>
                <li class="progressbar4 ">ارسل سؤالك</li>
            </ul>
        </div>
        <div class="clearfix"></div>
        @if(empty($user->social_status) || empty($user->religion) || empty($user->gender))
            <div class="formprdback">
                <form method="post" action="{{ route('editprofile') }}" class="formsty pt-0 pb-2 ">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="exampleFormControlInput1">الإسم</label>
                        <input class="form-control" id="exampleFormControlInput1" value="{{ $user->name }}"
                               readonly="">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">البريد الإلكترونى</label>
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                               value="{{ $user->email }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">رقم الهاتف <small> ( غير الزامي ) </small></label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}"
                               placeholder="+9669999999">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="religion">الديانة </label>
                        <input type="text" name="religion" class="form-control" id="religion"
                               value="{{ $user->religion }}"
                               placeholder="الديانة">
                        @error('religion')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="social_status">الحالة الاجتماعية</label>
                        <select class="form-control" name="social_status">
                            <option @if(empty($user->social_status))
                                    selected
                                    @endif
                                    hidden disabled>اختر الحالة الاجتماعية
                            </option>
                            <option
                                    @if($user->social_status == 'اعزب')
                                    selected
                                    @endif
                                    value="اعزب">اعزب
                            </option>
                            <option
                                    @if($user->social_status == 'مطلق')
                                    selected
                                    @endif
                                    value="مطلق">مطلق
                            </option>
                            <option
                                    @if($user->social_status == 'متزوج')
                                    selected
                                    @endif
                                    value="متزوج">متزوج
                            </option>
                            <option
                                    @if($user->social_status == 'ارمل')
                                    selected
                                    @endif
                                    value="ارمل">ارمل
                            </option>
                        </select>
                        @error('social_status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">الجنس</label>
                        <select class="form-control" name="gender">
                            <option @if(empty($user->gender))
                                    selected
                                    @endif
                                    hidden disabled>اختر الجنس
                            </option>
                            <option
                                    @if($user->social_status = 'انثى')
                                    selected
                                    @endif
                                    value="انثى">انثى
                            </option>
                            <option
                                    @if($user->social_status = 'ذكر')
                                    selected
                                    @endif
                                    value="ذكر">ذكر
                            </option>
                        </select>
                        @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="firstbtn text-center mb-2">
                        <button class="btn btnformse">حفظ</button>
                    </div>
                </form>
            </div>
        @endif
        @if($user->complete == 0 && empty($user->email))
            <div class="formprdback">
                <form method="post" action="{{ route('email') }}" class="formsty">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="form-group m-0">
                        <label for="email">البريد الالكتروني</label>
                        <input name="email" placeholder="البريد الالكتروني" class="form-control" id="email">
                    </div>
                    <div class="text-center">
                        <button class="btn mt-3">حفظ</button>
                    </div>
                </form>
            </div>
        @elseif($user->complete == 1 && $user->verified != 1)
            <div class="formprdback">
                <div class="alert alert-warning">
                    <h4>
                        يرجى تفعيل العضوية عبر زيارة البريد
                        {{ $user->email }}
                    </h4>
                </div>
            </div>
        @endif
        @if($user->complete == 1 && $user->verified == 1 && $user->terms == 0)
            <div class="formprdback">
                <p>
                    <?php
                        $option = \App\Models\Option::find(1);
                    ?>
                   {{ $option->terms }}
                </p>
                <div class="text-center">
                    <a href="{{ route('terms') }}" class="btn mt-3">متابعة</a>
                </div>
            </div>
        @endif
        @if($user->complete == 1 && $user->verified == 1 && $user->terms == 1)
            <div class="formprdback">
                <form method="post" action="{{ route('send_question') }}" class="question_form">
                    @csrf
                    <div class="form-group m-0">
                        <label for="question">نص السؤال كامل</label>
                        <textarea placeholder="أكتب نص السؤال" class="form-control" id="question"
                                  rows="5" name="question">{{ old('question') }}</textarea>
                        @error('question')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mini_question">السؤال بإختصار</label>
                        <input type="text" class="form-control" id="mini_question"
                               placeholder="أكتب حكم السؤال" name="mini_question" value="{{ old('mini_question') }}">
                        @error('mini_question')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button class="btn mt-3">أرسل سؤالك</button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>