@section('backend-footer')
@show
<!-- BEGIN: sweett alert JS-->
<script src="{{ asset('backend') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="{{ asset('backend') }}/app-assets/vendors/js/extensions/polyfill.min.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/ui/data-list-view.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/extensions/sweet-alerts.js"></script>
<!-- END: sweett alert JS-->
<script src="{{ asset('backend') }}/custom-sweetalert.js"></script>
<script src="{{ asset('backend') }}/mine.js"></script>
<script>
    var base_url = $('#base_url').val();
    $('.marked_as_read').click(function() {
        var token = $(this).data('token');
        var id = $(this).attr('notification');
        $.ajax({
            url: base_url + '/read',
            type: 'post',
            data: '_token=' + token + '&notificationID=' + id,
            dataType: 'json',
        });
    });
</script>
