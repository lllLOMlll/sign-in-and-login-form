$(document).ready(function() {

  // ******************************* REGISTRATION FORM  - RESET THE FORM **************************************
  $('#buttonResetRegister').on('click', function() {
    $('#usernameRegister').val('');
    $('#emailRegister').val('');
    $('#passwordRegister').val('');
    $('#passwordConfirmRegister').val('');
    $('#avatarUploadRegister').val('');

  });

  // Dont exit the modal if there is any error
     if (showErrorModal) {  // I initialize that variable before the modal in the index.php
        $('#registerModal').modal('show');
    }

        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
    }, 1000); // Time in milliseconds

});
