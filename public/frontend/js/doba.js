$(document).ready(function() {
    // validate signup form on keyup and submit
    $(".formsty").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },

            religion: {
                required: true,
            },
            social_status: {
                required: true,
            },
            gender: {
                required: true,
            },
        },
        messages:{
            email: {
                required : 'هذا الحقل مطلوب',
                minlength : 'هذا الحقل مطلوب اقل من المسموح',
            },
            phone: {
                required : 'هذا الحقل مطلوب',
            },
            religion: {
                required : 'هذا الحقل مطلوب',
            },
            social_status: {
                required : 'هذا الحقل مطلوب',
            },
            gender: {
                required : 'هذا الحقل مطلوب',
            },
        }
    });
    $(".question_form").validate({
        rules: {
            mini_question: {
                required: true,
                maxlength:100,
            },
            question: {
                required: true,
                minlength: 10,
            },
        },
        messages:{
            mini_question: {
                required:'هذا الحق مطلوب',
                maxlength:'مدخلات اكبر من المسموح',
            },
            question: {
                required:'هذا الحق مطلوب',
                minlength: 'مدخلات اقل من المسموح',
            },
        }
    });
});
//remove-alert
$(document).on('click', '.remove-alert', function(e) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })
    Swal.fire({
        title: 'هل أنت متأكد؟',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'نعم',
        cancelButtonText: 'لا',
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            var id = $(this).attr('object_id');

            var d_url = $(this).attr('delete_url');
            var elem = $(this).parent('div').parent('div').parent('div').parent('td').parent('tr');

            $.ajax({
                type: 'post',
                url: d_url + id,
                data: {
                    _method: 'delete',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(result) {
                    elem.remove();
                    swalWithBootstrapButtons.fire({
                        icon: 'success',
                        title: 'تم الحذف  بنجاح',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        } else if (
            // / Read more about handling dismissals below /
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                icon: 'error',
                title: 'تم إلإلغاء',
                showConfirmButton: false,
                timer: 1000
            });

        }
    })

});
var base_url = $('#base_url').val();

$('.favourite_add').click(function() {
    var token = $(this).data('token');
    var id = $(this).attr('ad');
    $.ajax({
        url: base_url + '/favourite_add',
        type: 'post',
        data: '_token=' + token + '&adID=' + id,
        dataType: 'json',
        success: function() {
            Swal.fire({
                icon: 'success',
                title: 'تم الاضافة الى المفضلة  بنجاح',
                showConfirmButton: false,
                timer: 1000
            });
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'تم الحذف من المفضلة  بنجاح',
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
});
$('.favourite_add').click(function() {
    $(this).toggleClass('color');
});
$('.sub-submit').click(function() {
    var token = $(this).data('token');
    var email = document.getElementById("kk").value;
    $.ajax({
        url: base_url + '/subscribe',
        type: 'post',
        data: '_token=' + token + '&email=' + email,
        dataType: 'json',
        success:function(){
            Swal.fire({
                icon: 'success',
                title: 'تم الاشتراك بنجاح في القائمة البريدية',
                showConfirmButton: false,
                timer: 1500
            });
            document.getElementById("kk").value = '';
        },
        error:function(){
            Swal.fire({
                icon: 'error',
                title: 'بريد موجود مسبقا او يوجد خطأ',
                showConfirmButton: false,
                timer: 1500
            });
            document.getElementById("kk").value = '';
        },
    });
});
$(document).ready(function() {
    $(".login_form").validate({
        rules: {
            email: {
                required: true,
                email:true,
            },
            password: {
                required: true,
            },
        },
        messages:{
            email: {
                required : 'هذا الحقل مطلوب',
                email : 'يجب ان يكون بريد الكتروني',
            },
            password: {
                required : 'هذا الحقل مطلوب',
            },
        }
    });
    $(".register_form").validate({
        rules: {
            email: {
                required: true,
                email:true,
            },
            password : {
                required: true,
                minlength : 8,
            },
            password_confirmation : {
                required: true,
                minlength : 8,
                equalTo : "#password2",
            },
            name: {
                required: true,
            },
        },
        messages:{
            email: {
                required : 'هذا الحقل مطلوب',
                email : 'يجب ان يكون بريد الكتروني',
            },
            password : {
                required: 'هذا الحقل مطلوب',
                minlength : 'اقل من المطلوب',
            },
            password_confirmation : {
                required: 'هذا الحقل مطلوب',
                minlength : 'اقل من المطلوب',
                equalTo : "غير متوافق",
            },
            name: {
                required : 'هذا الحقل مطلوب',
            },
        }
    });
    $('body').on('hidden.bs.modal', '.modal', function () {
        $('video').trigger('pause');
    });
    $(function(){
        $('.modal').on('hidden.bs.modal', function (e) {
            $iframe = $(this).find("iframe");
            $iframe.attr("src", $iframe.attr("src"));
        });
    });
});

$(document).ready(function() {
    $('.alert-danger').fadeIn('fast').delay(4000).fadeOut('slow');
    $('.alert-success').fadeIn('fast').delay(3500).fadeOut('slow');
});