<div id="London" class="tabcontent">
    <div class="firsttab pigmartop">
        <!--  callus  -->
        <div class="callus">
            <div class="aboutus">
                <div class="">
                    <div class="allaboutus">
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
                                <label for="phone">رقم الهاتف <small> ( غير الزامي ) </small> </label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}"
                                       placeholder="+9669999999">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="religion">الديانة </label>
                                <input type="text" name="religion" class="form-control" id="religion" value="{{ $user->religion }}"
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
                </div>
            </div>
        </div>
        <!-- end callus  -->
    </div>
</div>


