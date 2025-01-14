function showErrors(err) {
    let errors = err.responseJSON.errors;

    for (i in errors) {
        $.notify({message: '<i class="fa fa-fw fa-times"></i>&nbsp; ' + errors[i][0]}, {type: 'danger'});
    }
}
