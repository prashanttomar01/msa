$(document).ready(function () {
    $("#msa_part_data").submit(function (e) {
        e.preventDefault();
        let validForm = true;

        let msa_part_data = new FormData(this);
        // $('.required').each(function () {
        //     $(this).next('.text-danger').remove();
        //     if (validateField(this.id) == 0) {
        //         validForm = false;
        //     }
        // });
        // // if (validForm) {
        //     $(':input[type="submit"]').prop('disabled', true);
            $.ajax({
                type: "POST",
                url: "api/msa_data.php",
                data: msa_part_data,
                contentType: false,
                processData: false,
                success: function (result) {
                    console.log(result);
                    if (result == 1) {
                        new Notify({
                            title: 'Form Status',
                            text: 'MSA not Stored Successfully!!',
                            status: 'error',
                            position: 'right bottom',
                            autoclose: true,
                            autotimeout: 3000,
                            effect: 'fade',
                            speed: 300
                        });
                        $(':input[type="submit"]').prop('disabled', false);
                    } else {
                        new Notify({
                            title: 'Form Status',
                            text: 'MSA Saved Successfully!!',
                            status: 'success',
                            position: 'right bottom',
                            autoclose: true,
                            autotimeout: 3000,
                            effect: 'fade',
                            speed: 300
                        });
                        $(':input[type="submit"]').prop('disabled', true);
                    }
                }
            });
        // }
    });
});
// $('.required').keyup(function () {
//     validateField(this.id);
// });

// function dataedit(msa_id) {
//      let edit_form = new FormData();
//     $('#part_data').each(function () {
//         $(this).next('.text-danger').remove();
//         $(this).removeClass('is-invalid');
//     });
//         edit_form.append('id', id);
//     edit_form.append('form_action', 'update_msa_data');
//     $.ajax({
//         type: "POST",
//         url: 'api/msa_data.php',
//         data: edit_form,
//         contentType: false,
//         processData: false,
//         dataType: "json",
//         success: function (result) {
//             $('#part_data').val(result.part_data);
//              $('#form_action').val('update_msa_data');
//         }
//   });
// }