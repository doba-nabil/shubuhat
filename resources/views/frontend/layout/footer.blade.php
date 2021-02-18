<!-- footer -->
<footer class="section footer-classic context-dark bg-image py-5">
    <div class="container">
        <div class="row row-30">
            <div class="col-md-4 pigmartop">
                <h5 class="d-center">من نحن</h5>
                <h4 class="d-center">
                    {{ $option->footer_text }}
                </h4>
                <ul class="nav-list m-0 d-colm">
                    <li>
                        <i class="fas fa-phone-alt mr-2 "></i>
                        {{ $option->phone }}</li>
                    <li>
                        <i class="far fa-envelope-open mr-2 "></i>
                        {{ $option->email }}</li>
                    <li>
                        <i class="fab fa-whatsapp  mr-2"></i>
                         {{ $option->whatsapp }}
                    </li>
                </ul>

            </div>
            <div class="col-md-4 pigmartop">
                <h5 class="d-center">مواضيع مهمة</h5>
                <ul class="nav-list d-colm">
                    @foreach($pages->slice(0, 5) as $page)
                        <li><a href="{{ route('web_page' , $page->slug) }}">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-4 pigmartop">
                <h5 class="d-center">الإشتراك في النشرة البريدية</h5>
                <ul class="nav-list d-colm">
                    <li>إشترك في النشرة البريديةليصلك جديد الموقع والتحديثات الدورية</li>
                </ul>
                <div class="mt-3">
                    <div class="input-group mb-3 footer-input">
                        <input name="email" type="email" class="form-control search-box" id="kk" value=""
                               placeholder="البريد الالكتروني" required>
                        <i class="far fa-envelope-open mr-2"></i>
                    </div>
                    <button class="btn footerbtn sub-submit" type="submit" data-token="{{ csrf_token() }}">
                        ارسال
                    </button>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
<!-- last bottom  -->
<div class="labot">
    <div class="container allasfot d-colm">
        <div class="rightfot mt-2">
            <p class="d-colm">جميع الحقوق محفوظة لموقع الشبهات سؤال وجواب 2020</p>
        </div>
        <div class="rightfot">
            <div class="socialhead">
                @if(!empty($option->facebook))
                    <a href="{{ $option->facebook }}"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(!empty($option->twitter))
                    <a href="{{ $option->twitter }}"><i class="fab fa-twitter"></i></a>
                @endif
                @if(!empty($option->youtube))
                    <a href="{{ $option->youtube }}"><i class="fab fa-youtube"></i></a>
                @endif
                @if(!empty($option->insta))
                    <a href="{{ $option->insta }}"><i class="fab fa-instagram"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- last bottom  -->
</div>

<script src="{{ asset('frontend') }}/js/all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="{{ asset('frontend') }}/js/wow.min.js"></script>
<script src="{{ asset('frontend') }}/js/green-audio-player.js"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{ asset('frontend') }}/js/bootstrap-input-spinner.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('frontend') }}/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('frontend') }}/js/doba.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('.example').DataTable({
            "language": {
                "url": "{{ asset('frontend/js/ar_table.json') }}"
            }
        });
    });
</script>

<script type="text/javascript">
    var scrolltotop={setting:{startline:100,scrollto:0,scrollduration:1e3,fadeduration:[500,100]},controlHTML:'<i class="fas fa-angle-up"></i>',controlattrs:{offsetx:5,offsety:5},anchorkeyword:"#top",state:{isvisible:!1,shouldvisible:!1},scrollup:function(){this.cssfixedsupport||this.$control.css({opacity:0});var t=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);t="string"==typeof t&&1==jQuery("#"+t).length?jQuery("#"+t).offset().top:0,this.$body.animate({scrollTop:t},this.setting.scrollduration)},keepfixed:function(){var t=jQuery(window),o=t.scrollLeft()+t.width()-this.$control.width()-this.controlattrs.offsetx,s=t.scrollTop()+t.height()-this.$control.height()-this.controlattrs.offsety;this.$control.css({left:o+"px",top:s+"px"})},togglecontrol:function(){var t=jQuery(window).scrollTop();this.cssfixedsupport||this.keepfixed(),this.state.shouldvisible=t>=this.setting.startline?!0:!1,this.state.shouldvisible&&!this.state.isvisible?(this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]),this.state.isvisible=!0):0==this.state.shouldvisible&&this.state.isvisible&&(this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]),this.state.isvisible=!1)},init:function(){jQuery(document).ready(function(t){var o=scrolltotop,s=document.all;o.cssfixedsupport=!s||s&&"CSS1Compat"==document.compatMode&&window.XMLHttpRequest,o.$body=t(window.opera?"CSS1Compat"==document.compatMode?"html":"body":"html,body"),o.$control=t('<div id="topcontrol">'+o.controlHTML+"</div>").css({position:o.cssfixedsupport?"fixed":"absolute",bottom:o.controlattrs.offsety,right:o.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"Scroll to Top"}).click(function(){return o.scrollup(),!1}).appendTo("body"),document.all&&!window.XMLHttpRequest&&""!=o.$control.text()&&o.$control.css({width:o.$control.width()}),o.togglecontrol(),t('a[href="'+o.anchorkeyword+'"]').click(function(){return o.scrollup(),!1}),t(window).bind("scroll resize",function(t){o.togglecontrol()})})}};scrolltotop.init();
</script>
<noscript>Not seeing a <a href="https://www.scrolltotop.com/">Scroll to Top Button</a>? Go to our FAQ page for more info.</noscript>
@section('frontend-footer')

@show

