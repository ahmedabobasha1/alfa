

$('#btn_delete').click(function() {

    var selectedCheckboxes = $(".check-inputs:checked");

    var selectedIds = [];


    selectedCheckboxes.each(function() {
        selectedIds.push($(this).val());
    });

    if (selectedIds.length === 0) {
        Swal.fire({
            title: "@lang('messages.no_select')?"
            , text: "@lang('messages.please select at least one')"
            , icon: "warning"
            , confirmButtonColor: "#5156be"
        });
    } else {

        Swal.fire({
            title: "@lang('messages.are you sure?')"
            , text: "@lang('messages.remove checked values')"
            , icon: "warning"
            , showCancelButton: true
            , confirmButtonColor: "#3085d6"
            , cancelButtonColor: "#d33"
            , confirmButtonText: "@lang('messages.yes, delete it')!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: url + '/' + selectedIds[0]
                    , type: 'DELETE'
                    , data: {
                        selectedIds: selectedIds
                    }
                    , success: function(response) {

                        if (response.success) {
                            Swal.fire({
                                icon: "success"
                                , title: "Deleted!"
                                , text: response.message
                                , showConfirmButton: false
                                , timer: 1500
                            });

                            // Remove the rows of deleted services
                            selectedCheckboxes.each(function() {
                                $(this).closest('tr').remove();
                            });
                        } else {
                            alert('An error occurred while deleting ');
                        }
                    }
                    , error: function(error) {
                        Swal.fire({
                            title: "Error!"
                            , text: error.responseJSON.message
                            , icon: "error"
                        });
                    }
                });
            }
        });
    }
})


