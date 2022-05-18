$(document).ready(function () {
    var modal = $('#profileModal')
    var confirmProfileBtn = modal.find('.modal-footer #confirmProfileBtn')
    confirmProfileBtn.click(function (event) {

        //stop submit the form, we will post it manually.
        event.preventDefault();
    
        // Get form
        var form = $('#fileUploadForm')[0];
    
        // Create an FormData object 
        var data = new FormData(form);
    
    
        // disabled the submit button
        confirmProfileBtn.prop("disabled", true);
    
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "../post/profile_edit.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {
    
                data = JSON.parse(data);
                if (data.success) {
                    console.log("Profile has been changed.");
                    console.log(data)
                    $("#topLeftName").text($('#inputFirstName').val());
                    $("#tableProfile").load(window.location.href + " #tableProfile > *");
                    $("#linkAvatar").attr("src", $('#fileToUpload').val());
                    modal.modal('hide');
                    location.reload(true); 


                }
                else {
                    if (data.systemError) {
                        console.log(data.systemError);
                        modal.find('.modal-content').append('<small class="warning_error"><i class="fas fa-exclamation-triangle"></i>' + ' ' +
                            "Error from server, operation cancelled" +
                            '</small>');

                    }
                    else {
                        if (data.userName) {
                            modal.find('#formUserName').append('<small class="warning_error"><i class="fas fa-exclamation-triangle"></i>' + ' ' +
                                data.userName +
                                '</small>');
                        }
                        if (data.firstName) {
                            console.log('first name');
                            modal.find('#formFirstName').append('<small class="warning_error"><i class="fas fa-exclamation-triangle"></i>' + ' ' +
                                data.firstName +
                                '</small>');
                        }
                        if (data.lastName) {
                            modal.find('#formLastName').append('<small class="warning_error"><i class="fas fa-exclamation-triangle"></i>' + ' ' +
                                data.lastName +
                                '</small>');
                        }
                        if (data.email) {
                            modal.find('#formEmail').append('<small class="warning_error"><i class="fas fa-exclamation-triangle"></i>' + ' ' +
                                data.email +
                                '</small>');
                        }
                        if (data.phone) {
                            modal.find('#formPhone').append('<small class="warning_error"><i class="fas fa-exclamation-triangle"></i>' + ' ' +
                                data.phone +
                                '</small>');
                        }
                        if (data.birthday) {
                            modal.find('#formBirthday').append('<small class="warning_error"><i class="fas fa-exclamation-triangle"></i>' + ' ' +
                                data.birthday +
                                '</small>');
                        }
                        if (data.avatar) {
                            modal.find('#formAvatar').append('<small class="warning_error"><i class="fas fa-exclamation-triangle"></i>' + ' ' +
                                data.avatar +
                                '</small>');
                        }
                    }
                    modal.modal('handleUpdate');
                }
            }, 
        return: false,
    })
    modal.on('show.bs.modal', function (event) {
        modal.find('.warning_error').remove();
    })})})