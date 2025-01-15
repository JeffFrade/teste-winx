$('.btn-overlay').on('click', function (e) {
    $('.overlay').removeClass('overlay-hidden');
});

$('.btn-save').on('click', function (e) {
    $('.overlay').removeClass('overlay-hidden');
});

$.notifyDefaults({
    z_index: 100000,
    element: 'body'
});

$('.form-error').each(function (index) {
    $.notify({message: '<i class="fa fa-fw fa-times"></i>&nbsp; ' + $(this).text()}, {type: 'danger'});
});

$('.form-success').each(function (index) {
    $.notify({message: '<i class="fa fa-fw fa-check"></i>&nbsp; ' + $(this).text()}, {type: 'success'});
});
