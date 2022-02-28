var telInput = $("#phone"),
  errorMsg = $("#error-msg"),
  validMsg = $("#valid-msg");

// initialise plugin
telInput.intlTelInput({
  utilsScript: "src/js/utils.js"
});

var reset = function() {
  telInput.removeClass("error");
  errorMsg.addClass("hide");
  validMsg.addClass("hide");
};

// on blur: validate
telInput.blur(function() {

  reset();
  if ($.trim(telInput.val())) {
    if (telInput.intlTelInput("isValidNumber")) {
      validMsg.removeClass("hide");
      var str =$("#phone").intlTelInput("getNumber");
      
      str = str.replace("+"+$("#phone").intlTelInput("getSelectedCountryData").dialCode, "");
      $("#Nubr").val(str);
      //var countryCode = telInput.intlTelInput("getSelectedCountryData").iso2;
      $("#CCode").val($("#phone").intlTelInput("getSelectedCountryData").dialCode);
      document.getElementById('Country_input').value="+"+$("#phone").intlTelInput("getSelectedCountryData").dialCode;
      $("#Country_input").prop('disabled',true);
    } else {
      telInput.addClass("error");
      errorMsg.removeClass("hide");
      $("#Nubr").val('');
      $("#CCode").val('');
    }
  }
});

// on keyup / change flag: reset
telInput.on("keyup change", reset);