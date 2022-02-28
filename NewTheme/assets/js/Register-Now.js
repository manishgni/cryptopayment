
///////////
function RegisterNow() {

//$('#Msgsr').html('');
 
//     var od = new FormData();
//    var firstname_input = $("#firstname_input").val();
    
//    var txtDoj="";    
//    var email_input = $("#email_input").val();
//    var phone_input= $("#Nubr").val();
    
//    var invite_input= $("#txtSponserID").val();
    
//    var password_input= $("#password_input").val();
//    var password_Sec= $("#txtsecurityPWD").val();
    
//    var CountryCode= $("#Country_input").val();
//    var Country_input=$("#Country_input").find("option:selected").text();
    //     var txtLoginip=$("#txtLoginip").val();


    $('#RMsgs').html('');

    var od = new FormData();
    var firstname_input = $("#firstname_input").val();
    //var DDLPos = $("#DDLPos").val();
     
    var email_input = $("#email_input").val();
    var phone_input = $("#Nubr").val();

    var invite_input = $("#txtSponserID").val();
    var password_input = $("#password_input").val();
    var password_Sec = $("#txtsecurityPWD").val();

    var CountryCode = $("#Country_input").val();
    var Country_input = $("#Country_input").find("option:selected").text();
     
    /////////
    
    var email = document.getElementById('email_input');
    var emailfilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//    ////////
//     if($("#checkbox-signup").prop('checked') == false){

//         $('#Msgsr').html("<p class='error hide' id='not-found' style='display: block;'>Please accept terms and conditions !</p>");
//  
//      return;
//    }
    /////////
     
   if (firstname_input!='' &  email_input!='' & 
     phone_input !='' & password_input !='' & password_Sec!='' & invite_input !='' & Country_input !='' & CountryCode !=''
    & emailfilter.test(email.value))
    {
    $('#Msgsr').html('<img src="UserProfileImg/reg.gif" width="35" height="35" />');
    ////////
    if(password_input==password_Sec)
    {
     
    //  $('#RMsgs').html("<div class='feild col-md-12'><div class='widget no-color'><div class='notify purple-skin with-color with-image'><span><img src='images/success.gif' alt=''></span><div class='notify-content'><h3>Login password & Txn password can not be same !</h3><a title='' class='close'>x</a></div></div></div></div>");  
//      $('#Msgsr').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png' width='25' heigth='25'  alt=''> Login password & Txn password can not be same !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
        $('#Msgsr').html("<p class='error hide' id='not-found' style='display: block;'>Login password & Txn password can not be same !</p>");
    }
    ////////
    else
    {
    od.append("firstname_input", firstname_input);
    od.append("email_input", email_input);    
    od.append("phone_input", phone_input);
   // od.append("DDLPos", DDLPos);
    od.append("invite_input", invite_input);
    od.append("password_input",password_input);
    od.append("password_Sec",password_Sec);
    od.append("CountryCode", CountryCode);
    od.append("Country_input", Country_input);
    //od.append("txtLoginip", txtLoginip);
        
    ////////
        $.ajax({
            url: "abi8mO/Handlers/Register-Now.ashx",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) 
                {
                    if(Response.Message=="Verification.html")
                    {}
                    else
                    {
                        $('#Msgsr').html("<p class='success hide' id='not-found' style='display: block; color: #09a909;'> " + Response.Message + "</p>");
                    }
                    
                    $("#firstname_input").val('');
                    $("#email_input").val('');
                    $("#phone").val('');
                    $("#password_input").val('');
                    $("#txtsecurityPWD").val('');
                    location.href = Response.Message;
                   
                }
                else 
                {
                    $('#Msgsr').html("<p class='error hide' id='not-found' style='display: block;color: red;'> " + Response.Message + "</p>");
                }
            },
            error: function (err) {
                $('#Msgsr').html("<p class='error hide' id='not-found' style='display: block;color: red;'>" + err.statusText + "</p>");
            }
        });
   }
   }
}
//////////////
function AccountLogin() {

     //var captcha_input_field= $("#captcha-input-field").val();
 
     //   if (captcha_input_field=='')
     //   {
        
     //    $('#Msgs').html("<p class='error ' id='not-found' style='display: block;color: red;'>Captcha validation is required</p>");            
        
     //   return;
     //   }
    var od = new FormData();
    var txtPasswordSU= $("#inputPassword").val();
    var txtUserID= $("#inputEmail").val();
      var txtCity=$("#txtCity").val();
    var txtCountry=$("#txtCountry").val();
    var txtRegion=$("#txtRegion").val();
    var txtLoginip=$("#txtLoginip").val();
    //////
    if (txtUserID!='' & txtPasswordSU !='' & txtUserID!='undefined' & txtPasswordSU !='undefined')
    {
    ////
    $('#Msgs').html('<img src="UserProfileImg/reg.gif" width="35" height="35" />');
    ///
    od.append("txtPasswordSU", txtPasswordSU);
    od.append("txtUserID",txtUserID);
     od.append("txtCity",txtCity);
    od.append("txtCountry",txtCountry);
    od.append("txtRegion",txtRegion);
    od.append("txtLoginip",txtLoginip);
    // od.append("captcha-input-field",captcha_input_field);
    
        $.ajax({
            url: "abi8mO/Handlers/Account-Login.ashx",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
            
                if (Response.Success) 
                {
               
                window.location.href=Response.Message; 
                self.undelegateEvents();
                delete self;
                }
                else 
                {
                    $('#Msgs').html("<p class='error ' id='not-found' style='display: block;color: red;'>" + Response.Message + "</p>");
                 //"<div style='text-align: center;'><span class='alert alert-danger alert-dismissable' style='display:block;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-times-circle'></i>"+Response.Message+"</span></div>");
        
           
                }
            },
            error: function (err) {

                $('#Msgs').html("<p class='error ' id='not-found' style='display: block;color: red;'>" + err.statusText + "</p>");
           //<div style='text-align: center;'><span class='alert alert-danger alert-dismissable' style='display:block;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-times-circle'></i>"+ err.statusText+"</span></div>");
           }
        });
   }
}


//////////////
function Resetmypassword1() {
        var od = new FormData();
        var recovery_email= $("#txtemailadress").val();
       // var recovery_memid= $("#txtmemid").val();
   
       
        $('#Msgsf').html('<img src="UserProfileImg/reg.gif" width="35" height="35" />');
        ////
        od.append("recovery_email", recovery_email);
        //od.append("recovery_memid", recovery_memid);
        /////
       $.ajax({
            url: "abi8mO/Handlers/Reset-Password-Step1.ashx",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                  $('#Msgsf').html('');

                  $('#Msgsf').html("<p class='success hide' id='not-found' style='display: block;color: #09a909;'>" + Response.Message + "</p>");
               
                  $("#inputEmail").val('');
                }
                else {
                     $('#Msgsf').html('');

                     $('#Msgsf').html("<p class='error hide' id='not-found' style='display: block;color: red;'>" + Response.Message + "</p>");
                   
                }
            },
            error: function (err) {        
               $('#Msgsf').html('');

               $('#Msgsf').html("<p class='error hide' id='not-found' style='display: block;color: red;'>" + err.statusText + "</p>");
               
            }
        });
  // }
}

//////////////
function Resetmypassword2() {

   
 
        var od = new FormData();
//        var recovery_email= $("#txtemailadress").val();
//        var recovery_memid= $("#txtmemid").val();

        var changing_email= $("#changing_email").val();
        var changing_code= $("#changing_code").val();
        var new_password= $("#inputPassword").val();
        var changing_memid= $("#changing_memid").val();
        
      
        $('#Msgsre').html('<img src="UserProfileImg/reg.gif" width="35" height="35"  />');
        ////
        od.append("changing_email", changing_email);
        od.append("changing_code", changing_code);
        od.append("new_password", new_password);
        od.append("changing_memid", changing_memid);
        /////
        $.ajax({
            url: "abi8mO/Handlers/Reset-Password-Step2.ashx",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                  $('#Msgsre').html('');

                  $('#Msgsre').html("<p class='success hide' id='not-found' style='display: block;color: #09a909;'>" + Response.Message + "</p>");
                   //<div style='text-align: center;'><span class='alert alert-success alert-dismissable' onclick='hided()' style='display:block;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-check-circle'></i>"+Response.Message+"</span></div>");
                
                 
                  $("#txtemailadress").val('');
                  $("#txtmemid").val('');
                }
                else {
                 $('#Msgsre').html('');

                 $('#Msgsre').html("<p class='error hide' id='not-found' style='display: block;color: red;'>" + Response.Message + "</p>");
                   //<div style='text-align: center;'><span class='alert alert-danger alert-dismissable' onclick='hided()' style='display:block;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-times-circle'></i>"+Response.Message+"</span></div>");
                   
                }
            },
            error: function (err) {     
            
            $('#Msgsre').html('');
            $('#Msgsre').html("<p class='error hide' id='not-found' style='display: block;color: red;'>" + err.statusText + "</p>");
                   //<div style='text-align: center;'><span class='alert alert-danger alert-dismissable' onclick='hided()' style='display:block;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-times-circle'></i>"+err.statusText+"</span></div>");   
              
            }
        });
  
}
//////////////
function VerifyAccount(emid) {
        var od = new FormData();
        var txtVerifCode= emid;
        /////////
        if (txtVerifCode !='')
        {
        $('#Msgs').html('<img src="UserProfileImg/reg.gif" width="35" height="35" />');
        ////
        od.append("txtVerifCode", txtVerifCode);
        /////
        $.ajax({
            url: "abi8mO/Handlers/Verify-Account.ashx",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                     //window.location.href = "signin.html?lg=done";

//                    $('#Msgs').html(Response.Message);
                    $('#Msgs').html(Response.Message);
                    $('#hide1').hide();
                    $('#hide2').hide();
                    $('#vrfcode').hide();
                   //$('#toast-container').html("<div class='toast-success' >"+Response.Message+"</div>");   
                }
                else {
                    $('#Msgs').html(Response.Message);
//                   $('#Msgs').html(Response.Message); 
                   //$('#toast-container').html("<div class='toast-error' >"+Response.Message+"</div>");  
                }
            },
            error: function (err) {

                $('#Msgs').html(err.statusText);   
//              $('#Msgs').html(err.statusText); 
              //$('#toast-container').show();   
                  // $('#toast-container').html("<div class='toast-error' ><a href='#'  style='color:#fff;' onclick='hided()' class='toast-close-button' >×</a>"+err.statusText+"</div>");  
            }
        });
   }
}


function getLoginDetails()
{
///

    var xmlhttp = new XMLHttpRequest();
                      
    xmlhttp.open("GET", "https://ipapi.co/json/", true);
    xmlhttp.send();
    ///   
            xmlhttp.onreadystatechange = function() 
            {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                {  
                    var jsontext=xmlhttp.responseText;
                    var data = JSON.parse(jsontext);
                    ///   
                                     
                    $("#txtCity").val(data.city);
                    $("#txtCountry").val(data.country_name);
                    $("#txtRegion").val(data.region_code);
                    $("#txtLoginip").val(data.ip);
                    
                    ///
                }
            }
///
}