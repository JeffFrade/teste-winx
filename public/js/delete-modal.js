function deleteModal(url) {
    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let id = button.data('id');
        let modal = $(this);

        modal.find('.id-del').val(id);
    });

    $('#deleteModal').on('hide.bs.modal', function (event) {
        $('.overlay').addClass('overlay-hidden');
    });

    $('.btn-del').on('click', function (e) {
        e.preventDefault();

        $('#deleteModal').hide();

        $.ajax({
            contentType: 'application/x-www-form-urlencoded',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            method: 'DELETE',
            url: url + $('.id-del').val(),
            timeout: 0,
            success: function (response) {
                $.notify({message: '<i class="fa fa-fw fa-check"></i>&nbsp; ' + response.message}, {type: 'success'});
                setTimeout(function () {
                    location.reload();
                }, 2000);
            },
            error: function (err) {
                let error = err.responseJSON.error;

                if (error == undefined) {
                    error = err.responseJSON;
                }

                $.notify({message: '<i class="fa fa-fw fa-times"></i>&nbsp; ' + error.message}, {type: 'danger'});
                console.error(error);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        });
    });
}
