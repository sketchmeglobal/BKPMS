<script>
$(".remove").click(function() {
    $(this).closest('tr').remove();
});

//Show Modal
$('#addNewRecord').on('click', function() {
    $("#s_myFormName").trigger("reset");
    $('#myModal').modal('show');
})
$('#closeModal1, #closeModal').on('click', function() {
    $('#myModal').modal('hide');
})


//Validation Form
function validateForm() {
    $headofficeName = $('#headofficeName').val().replace(/^\s+|\s+$/gm, '');
    $headofficeLocation = $('#headofficeLocation').val().replace(/^\s+|\s+$/gm, '');

    $status = true;
    $formValidMsg = '';

    if ($headofficeName == '') {
        $status = false;
        $formValidMsg += 'Please enter Head office name';
        $('#headofficeName').removeClass('is-valid');
        $('#headofficeName').addClass('is-invalid');
    } else {
        $('#headofficeName').removeClass('is-invalid');
        $('#headofficeName').addClass('is-valid');
    }

    if ($headofficeLocation == '') {
        $status = false;
        $formValidMsg += ', location';
        $('#headofficeLocation').removeClass('is-valid');
        $('#headofficeLocation').addClass('is-invalid');
    } else {
        $('#headofficeLocation').removeClass('is-invalid');
        $('#headofficeLocation').addClass('is-valid');
    }

    $('#formValidMsg').html($formValidMsg);

    $('#s_submitForm_spinner').hide();
    $('#s_submitForm_spinner_text').hide();
    $('#s_submitForm_text').show();

    return $status;
} //en validate form

//Submit Form
$('#s_submitForm').click(function() {
    $('#s_submitForm_spinner').show();
    $('#s_submitForm_spinner_text').show();
    $('#s_submitForm_text').hide();
    $('#formValidMsg').hide();

    setTimeout(function() {
        $formVallidStatus = validateForm();

        if ($formVallidStatus == true) {
            console.log('form validated, save data & populate the data table')
            $('#formValidMsg').hide();
            $("#s_myFormName").trigger("reset");

            //Creat the row
            var row = $('<tr>')
                .append('<td>#</td>')
                .append('<td>Headoffice Bagnan</td>')
                .append('<td>Bagnan</td>')
                .append(
                    '<td class="d-flex justify-content-evenly"><a href="#" class="edit_class" data-table_id="3"><i class="fa fa-edit"></i></a> <a class="remove" href="#"><i class="fas fa-times"></i></a></td>'
                )

            //Prepend row with Table
            //myTable.row.add(row);
            $('#myTable tbody').prepend(row);

            //Hide Modal
            $('#myModal').modal('hide');
        } else {
            console.log('form validation Error')
            $('#formValidMsg').show();
        }

    }, 500)
})

//Edit Function
$('#myTable').on('click', '.edit_class', function() {
    $table_id = $(this).data('table_id');
    $('#table_id').val($table_id);
    $('#headofficeName').val('Baazar Kolkata');
    $('#headofficeLocation').val('Newtown');
    $('#myModal').modal('show');

})
</script>