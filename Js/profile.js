
$(document).ready(function() {
  $.ajax({
    url: "/test/guvi/php/profile.php",
    type: "GET",
    dataType: "json",
    success: function(data) {

      console.log(data);
      $('#Name').text(data.Name);
      $("#emailV").html(data.Email);
      $("#phoneValue").html(data.Phone);
      $("#ph").html(data.Age);
      $("#nice").html(data.id);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  });

  $('#regs').click(function() {{

    var phone = $('#phoneValue').val();
    var nice = $('#nice').val();
    $.ajax({
      url: "/test/guvi/php/update.php",
      type: "POST",
      data: {
        phone:phone,
        nice:nice,
      },
      success: function(data) {
        console.log("Success");
      },
      error: function(jqXHR, textStatus, errorThrown) {
        
      }
  });
  }
});



function resetToDefaultValue() {
  var passwordInput = document.getElementById("passwordInput");
  passwordInput.value = defaultPassword;
}

function updateDefaultValue() {
  var passwordInput = document.getElementById("passwordInput");
  var currentValue = passwordInput.value;

  if (currentValue !== defaultPassword) {
    defaultPassword = currentValue;
  }
}

function editField(fieldId) {
    var fieldValue = document.getElementById(fieldId);
    fieldValue.contentEditable = true;
    fieldValue.focus();
  }

