$(document).ready(function() {
    $('#regs').click(function() {
        var profileName = $('#pf-name').val();
        var email = $('#e-mail').val();
        var password = $('#passw').val();
        var rpassword = $('#rpassw').val();

        if (profileName === '') {
            $('msg').html('Name is required').removeClass('d-none');
            return;
        }

        if (email === '') {
            $('msg').html('Enter Email Id').removeClass('d-none');
            return;
        }

        if (password === '') {
            $('#msg').html('Please enter your password').removeClass('d-none');
            return;
        }

        if (rpassword !== password) {
            $('#msg').html('Passwords do not match').removeClass('d-none');
            return;
        }

        // Send AJAX request to register.php
        $.ajax({
            url: '/test/guvi/php/register.php',
            type: 'POST',
            data: {
                name: profileName,
                email: email,
                password: password
            },
            success: function(response) {
                var data = JSON.parse(response); 
                if(data.message==='Successfully'){
                $('#msg').html('Registration successful').removeClass('d-none');
                $('#pf-name').val('');
                $('#e-mail').val('');
                $('#passw').val('');
                $('#rpassw').val('');
                }else if (data.message==='Email'){
                    $('#msg').html('This Email is Already exists').removeClass('d-none');
                }
                else{
                    $('#msg').html('Registration Failder').removeClass('d-none');
                }
                
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    });
});
