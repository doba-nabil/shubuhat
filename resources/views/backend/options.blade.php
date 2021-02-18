@extends('backend.layout.master')
@section('backend-main')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">  Store Option</div>
                <div class="panel-body">
                    @include('common.done')
                    @include('common.errors')
                    <form method="post" action="{{ route('optionsSave') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name_ar">  Name in arabic</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="name_ar" name="name_ar" class="form-control" placeholder="Name in arabic" value="{{ $option->name_ar }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name_en">  Name in English</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="name_en" name="name_en" class="form-control" placeholder=" Name in English" value="{{ $option->name_en }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="description_ar">Descreption in Arabic </label>
                                </div>
                                <div class="col-md-10">
                                    <textarea name="description_ar" id="description_ar" cols="30" rows="5" class="form-control" placeholder="Descreption in Arabic">{{ $option->description_ar }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="description_en"> Description in English</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea name="description_en" id="description_en" cols="30" rows="5" class="form-control" placeholder="Description in English ">{{ $option->description_en }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="tags_ar">  Tags in Arabic</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="tags_ar" name="tags_ar" class="form-control" placeholder="   Tags in Arabic" value="{{ $option->tags_ar }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="tags_en">Tags in English  </label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="tags_en" name="tags_en" class="form-control" placeholder="     Tags in English" value="{{ $option->tags_en }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="email">Email </label>
                                </div>
                                <div class="col-md-10">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="   Email" value="{{ $option->email }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="phone"> Phone</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="{{ $option->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="address_ar"> Address in Arabic - Optinal</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="address_ar" name="address_ar" class="form-control" placeholder=" Address in Arabic - Optinal" value="{{ $option->address_ar }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="address_en">Address in English - Optinal </label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="address_en" name="address_en" class="form-control" placeholder=" Address in English - Optinal" value="{{ $option->address_en }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="facebook"> Facebook Account</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="facebook" name="facebook" class="form-control" placeholder="Facebook Account" value="{{ $option->facebook }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="twitter"> Twitter Account</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="twitter" name="twitter" class="form-control" placeholder="Twitter Account" value="{{ $option->twitter }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="google">Google Acount</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="google" name="google" class="form-control" placeholder="Google Acount" value="{{ $option->google }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="youtube"> youtube channel</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="youtube" name="youtube" class="form-control" placeholder=" youtube channel" value="{{ $option->youtube }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="instagram"> Instagram account</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="instagram" name="instagram" class="form-control" placeholder=" Instagram account" value="{{ $option->instagram }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="rights_ar"> Allrights in arabic  </label>
                                </div>
                                <div class="col-md-10">
                                    <textarea name="rights_ar" id="rights_ar" cols="30" rows="3" class="form-control" placeholder="Allrights in arabic">{{ $option->rights_ar }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="rights_en"> Allrights in english</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea name="rights_en" id="rights_en" cols="30" rows="3" class="form-control" placeholder="Allrights in english">{{ $option->rights_en }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-success form-control" value="Save">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
