$(document).ready(function() {
  $('#loginbut').click(function() {
    
   var email = $('#email').val();
    var password = $('#password').val();
  
    
      if (email.trim() === '') {
        $('#login-error').html('Email is required').removeClass('d-none');
        return;
      }
      if (password.trim() === '') {
        $('#login-error').html('Password is required').removeClass('d-none');
        return;
      }
      
      $.ajax({
        url: '/test/guvi/php/login.php',
        type: 'POST',
        data: {
            email: email,
            password: password
        },
        success: function(response) {
                        
                
          var data = JSON.parse(response); 
         if(data.message === 'Success'){
          window.location.href = '/test/guvi/profile.html';
         }
         else if(data.message === 'Invalid email'){
          $('#login-error').html('Invaild Email').removeClass('d-none');
         }
         else{
          $('#login-error').html('Invaild Password').removeClass('d-none');
         }
        },
        error: function(xhr, status, error) {
          $('#login-error').html(error).removeClass('d-none');
        }
    });
  });
});
