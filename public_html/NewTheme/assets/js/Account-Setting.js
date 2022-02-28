//////////
$.getJSON("Handlers/get-Profile-Details.ashx",
function (tjson) {
if (tjson.length == 0) {               
}
else {
        var d=''
        for (var i = 0; i < tjson.length; i++) 
        {
            $('#txtFirstName').text(tjson[i].mname);
            $('#FirstName').text(tjson[i].mname);
            $('#txtEmailid').text(tjson[i].email);

            $('#txtFirstName1').val(tjson[i].mname);
            $('#txtEmailid1').val(tjson[i].email);
            $('#txtMobileNo1').val(tjson[i].mobile);
            $('#txtCity1').val(tjson[i].city);
            $('#ddlcountry1').val(tjson[i].Country);


            $('#Emailid').text(tjson[i].email);
            $('#txtMobileNo').text(tjson[i].mobile);
            $('#txtCity').text(tjson[i].city);
            $('#ddlcountry').text(tjson[i].Country);
            //$('#ddlcountry1').text(tjson[i].Country + ", " + tjson[i].city);
            //////
            $("#txtSpeMail").text(tjson[i].SPeMail);
            $("#txtSpMob").text(tjson[i].SpMobile);
            $("#txtSPNameID").html(tjson[i].SpID);
            $('#SpCountry').text(tjson[i].SpCountry);
            $('#SpName').text(tjson[i].SpName);

         

            $("#MemName").html(tjson[i].mname);
            $("#memidrank").html(tjson[i].memid + "  (Rank: " + tjson[i].DRANK + ")");
            $('#hlat').val(tjson[i].Latitude);
            $('#hlong').val(tjson[i].Longitude);
        
        //////////////////////////////////
        if (tjson[i].KYCStatus == "Pending")
        {
//            $("#sta").html("<span class='text-info'>Your Profile Documents Status : "+tjson[i].KYCStatus+"</span>"); 
            
				
			$("#status2").html("	<div class='status1'><i class='fa fa-clock-o'></i></div>");
			$("#status").html("	<div class='status1'><i class='fa fa-clock-o'></i></div>");
			$("#status1").html("	<div class='status1'><i class='fa fa-clock-o'></i></div>");
            
             $("#sta").html("<div class='alert alert-danger m-t-10  m-b-10'> Your Profile Documents Status : "+tjson[i].KYCStatus+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: -5px;'>×</span> </button>  </div>");
        }
        else if (tjson[i].KYCStatus == "Reject")
        {
           //$("#sta").html("<span class='text-danger'>Your Profile Documents Status : "+tjson[i].KYCStatus+"</span>"); 
          $("#status2").html("	 <div class='status2'><i class='fa fa-close'></i></div>");
            $("#status").html("	 <div class='status2'><i class='fa fa-close'></i></div>");
             $("#status1").html("	 <div class='status2'><i class='fa fa-close'></i></div>");
            $("#sta").html("<div class='alert alert-danger m-t-10  m-b-10'> Your Profile Documents Status : "+tjson[i].KYCStatus+"<br/>Note : "+tjson[i].KYCRemark+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: -15px;'>×</span> </button>  </div>");
           
           //$("#KYCStatRemark").html("Note : "+tjson[i].KYCRemark);  
           
        }
        else if (tjson[i].KYCStatus == "Approved")
        {
        
          // $("#sta").html("<span class='text-success'>Your Profile Documents Status : "+tjson[i].KYCStatus+"</span>");   
             $("#status2").html("<div class='status'><i class='fa fa-check'></i></div>");
             $("#status").html("<div class='status'><i class='fa fa-check'></i></div>");
             $("#status1").html("<div class='status'><i class='fa fa-check'></i></div>");
           
            $('#sta').html("<div class='alert alert-success m-t-10  m-b-10'> Your Profile Documents Status : "+tjson[i].KYCStatus+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: -5px;'>×</span> </button> </div>");         
           
           $('#BtnSaveKYC').attr("disabled","disabled");
           $('#BtnSaveKYC').prop('onclick',null).off('click');
           
           $('#BtnSaveKYCAdd').attr("disabled","disabled");
           $('#BtnSaveKYCAdd').prop('onclick',null).off('click');
           
           
           $('#BtnSaveface').attr("disabled","disabled");
           $('#BtnSaveface').prop('onclick',null).off('click');
           
           $("#KYCID").attr('readonly','readonly');
           $("#KYCIdNo").attr('readonly','readonly'); 
           $("#KYCAddType").attr('readonly','readonly');
           
           $('#flID').attr("disabled","disabled");
           $('#flAdd').attr("disabled","disabled");
           
        }
        else 
        {
        $("#status2").html("	<div class='status1'><i class='fa fa-clock-o'></i></div>");
			$("#status").html("	<div class='status1'><i class='fa fa-clock-o'></i></div>");
			$("#status1").html("	<div class='status1'><i class='fa fa-clock-o'></i></div>");
            
             $("#sta").html("<div class='alert alert-danger alert-rounded'>Please Upload your Id & Address Proof for Profile Documents Verification<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: -5px;'>×</span> </button>  </div>");
        }
        
//        $("#ImgIDface").attr('src',"../"+tjson[i].FaceIdPath+"");
         //$("#faceiddoc").val(tjson[i].FaceIdType);
         
         if(tjson[i].KycPath!="uploads/KYC/Not_available.png")
         {
           $("#ImgID").html('<a href=../'+ tjson[i].KycPath +' target="_blank"  ><img src=../'+ tjson[i].KycPath +' /></a> <br/><div class="pndstsp">'+tjson[i].KYCStatus+'</div>');
         }
         else
         {
           $("#ImgID").html('<span class="wanki">Not Uploaded</span>');
         }
         
        
        
        
//         if (tjson[i].KYCStatus == "Pending")
//         {
//            
//         }
//         else if (tjson[i].KYCStatus == "Reject")
//         {
//         
//         }
//         else if (tjson[i].KYCStatus == "Approved")
//         {
//         
//         }
//        
        
         
         if(tjson[i].AddPath!="uploads/ADD/Not_available.jpg")
         {
         
         $("#ImgAdd").html('<a href=../'+ tjson[i].AddPath +' target="_blank"  ><img src=../'+ tjson[i].AddPath +' /></a> <br/><div class="pndstsa" >'+tjson[i].KYCStatus+'</div> ');
          
         }
         else
         {
           $("#ImgAdd").html('<span class="wanki">Not Uploaded</span>');
          // $("#ImgAdd").html('<a href=../'+ tjson[i].AddPath +' target="_blank"  ><img src=../'+ tjson[i].AddPath +' /></a> <br/><div class="pndstsa" >'+tjson[i].KYCStatus+'</div> ');
         }
        
      
      
       
         if(tjson[i].FaceIdPath!="uploads/FaceId/Not_available.png")
         {
         
         $("#ImgAddbnk").html('<a href=../'+ tjson[i].FaceIdPath +' target="_blank"  ><img src=../'+ tjson[i].FaceIdPath +' /></a> <br/><div class="pndstsa" >'+tjson[i].KYCStatus+'</div> ');
          
         }
         else
         {
           
           $("#ImgAddbnk").html('<span class="wanki">Not Uploaded</span>');
         }
        
        
        
        if(tjson[i].KycType != '')
        {
          $("#KYCID").val(tjson[i].KycType);
        }
//        else
//        {
//          $("#KYCID").val('Passport');
//        }
        $("#KYCIdNo").val(tjson[i].KycNo);
        
        $("#KYCIdNo1").text(tjson[i].KycNo);
        
        
        
 
//        if(tjson[i].BankPath != '')
//          {
//          $("#ImgBANKP").attr('src',"../"+tjson[i].BankPath+"");
//          }
//          else
//          {
//            $("#ImgBANKP").attr('src',"../uploads/BANK/Not_available.jpg");
//          }
        
        if(tjson[i].AddressType != '')
        {
           $("#KYCAddType").val(tjson[i].AddressType);
           $('#add-change').text(tjson[i].AddressType);
        }
        else
        {
         $("#KYCAddType").val('Choose Address Proof');
       
        }
         if(tjson[i].FaceIdType != '')
        {
           $("#faceiddoc").val(tjson[i].FaceIdType);
           $('#face-change').text(tjson[i].FaceIdType);
        }
        else
        {
         $("#faceiddoc").val('Choose face Id Proof');
         
        }
         if(tjson[i].KycType != '')
        {
           $("#KYCID").val(tjson[i].KycType);
           $('#photo-change').text(tjson[i].KycType);
        }
        else
        {
         $("#KYCID").val('Choose Photo Id Proof');
       
        }
       
        if(tjson[i].Kycuploddt != '')
      {
        $("#Kycuploddt").text(tjson[i].Kycuploddt);
        $("#Kycuploddt1").text(tjson[i].Kycuploddt);
        $("#Kycuplodd2").text(tjson[i].Kycuploddt);
        }
        else
        {
         $("#Kycuploddt").text("......");
        $("#Kycuploddt1").text("......");
        $("#Kycuplodd2").text("......");
        
        }
        
        
       if(tjson[i].KycDt != '')
        {
        $("#KycDt").text(tjson[i].KycDt);
          $("#KycDt1").text(tjson[i].KycDt);
           $("#KycDt2").text(tjson[i].KycDt);
        }
        else
        {
          $("#KycDt").text("......");
          $("#KycDt1").text("......");
           $("#KycDt2").text("......");
        
        }
        ///////////////////////////////////////
         
//        $("#MemPic").attr("src","../"+tjson[i].MemPic);


         
//  $("#ImgID").attr('src',"../"+tjson[i].KycPath+"");
//        $("#ImgAdd").attr('src',"../"+tjson[i].AddPath+"");
//        $("#KYCID").val(tjson[i].KycType);
//        $("#KYCIdNo").val(tjson[i].KycNo);
//        $("#KYCAddType").val(tjson[i].AddressType);

        
         $('#acdate1').text(tjson[i].acdate);
          $('#acdate2').text(tjson[i].acdate);
        
        
        $('#txtAccFName').val(tjson[i].AccountName);
        $("#txtBakName").val(tjson[i].bankname);
        $("#txtAccountNo").val(tjson[i].accno);
        $("#ddlAccType").val(tjson[i].BnkAccType);
        $("#txtIFSCode").val(tjson[i].IFSC);
        $("#txtPanCard").val(tjson[i].pan); 
        /////
        $("#txtpaytmid").val(tjson[i].Paytm);
        $("#txtupiAddress").val(tjson[i].UPI);
        
        /////
        $("#txtBitcoinAddress").val(tjson[i].BitCoin);  
        
         $("#txtEthereumAddress").val(tjson[i].Ethereum);                
        /////        
           if (tjson[i].mname !='')
           {
           $("#txtFirstName1").attr('readonly','readonly');
           }
           if (tjson[i].email !='')
           {
           $("#txtEmailid1").attr('readonly','readonly');
           }
           if (tjson[i].mobile !='')
           {
           $("#txtMobileNo1").attr('readonly','readonly');
           }
           if (tjson[i].city !='')
           {
           $("#txtCity1").attr('readonly','readonly');
           }
           if (tjson[i].Country !='')
           {
           $("#ddlcountry1").prop('disabled',true);
           }
           if (tjson[i].AccountName !='')
           {
            if (tjson[i].memid !='CWC18849')
            {
                $("#txtAccFName").attr('readonly','readonly');
            }
           }
           if (tjson[i].bankname !='')
           {
            if (tjson[i].memid !='7465881625')
            {
                $("#txtBakName").prop('disabled',true);
           //$("#txtBakName").attr('readonly','readonly');
            }    
           }
           if (tjson[i].accno !='')
           {
            if (tjson[i].memid !='7465881625')
            {
                $("#txtAccountNo").attr('readonly','readonly');
            }
           }
           if (tjson[i].accno !='')
           {
            if (tjson[i].memid !='7465881625')
            {
                $("#ddlAccType").prop('disabled',true);
            }
           }
           if (tjson[i].IFSC !='')
           {
            if (tjson[i].memid !='7465881625')
            {
                $("#txtIFSCode").attr('readonly','readonly');
            }
           }
           if (tjson[i].pan !='')
           {
           $("#txtPanCard").attr('readonly','readonly');
           }
//           if (tjson[i].PerfectMoneyId !='')
//           {
//           $("#txtPerfect").attr('readonly','readonly');
//           }
           if (tjson[i].BitCoin !='')
           {
            if (tjson[i].memid !='7465881625')
            {
               // $("#txtBitcoinAddress").attr('readonly','readonly');
            }
           }
           if (tjson[i].BitCoin !='')
           {
            if (tjson[i].memid !='7465881625')
            {
                $("#txtpaytmid").attr('readonly','readonly');
            }
           }
           if (tjson[i].BitCoin !='')
           {
            if (tjson[i].memid !='7465881625')
            {
                $("#txtupiAddress").attr('readonly','readonly');
            }
           }
           
            if (tjson[i].Ethereum !='')
           {
            if (tjson[i].memid !='7465881625')
            {
                //$("#txtEthereumAddress").attr('readonly','readonly');
            }
           }
           
        /////
//        d = d +"<a href='javascript:;'>"+tjson[i].mname+"</a> <small>"+tjson[i].doj+", "+tjson[i].Country+"</small>";
//        $('#BnkHdr').html(d); $('#PerHdr').html(d); $('#PMHdr').html(d); $('#LgHdr').html(d); $('#SecHdr').html(d);$('#BTCHdr').html(d);
        }
}
});
////////
function SavePerInfo() {

    $('#SvPInfo').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
    var od = new FormData();
    var txtFirstName = $("#txtFirstName1").val();
    var txtEmailid = $("#txtEmailid1").val();
    var txtMobileNo= $("#txtMobileNo1").val();
    var txtCity= $("#txtCity1").val();
    var ddlcountry= $("#ddlcountry1").val();  
    //var referencecode= $("#txtreferencecode").val();  
    
    od.append("txtFirstName", txtFirstName);
    od.append("txtEmailid", txtEmailid);    
    od.append("txtMobileNo", txtMobileNo);
    od.append("txtCity", txtCity);
    od.append("ddlcountry", ddlcountry);
    //od.append("referencecode", referencecode);
        $.ajax({
            url: "Handlers/Account-Settings.ashx?SaveTp=PerInfo",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                    
                      $('#SvPInfo').html("<div class='alert alert-success m-b-10'><strong>Well !</strong> " + Response.Message + " </div>");
                    //$('#SvPInfo').html(Response.Message);
                }
                else {
                  
                   $('#SvPInfo').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + Response.Message + " </div>");
                }
            },
            error: function (err) {
                $('#SvPInfo').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + err.statusText + " </div>");
               // $('#SvPInfo').html(err.statusText);
            }
        });
}
////////
function SaveBitcoinInfo() {
    $('#SvBTC').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> Please enter correct BTC Address...! </div>");
        var od = new FormData();
        var txtBitcoinAddress = $("#txtBitcoinAddress").val();
          var txtBtcOtp = $("#txtBtcOtp").val();
        ///
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "https://blockchain.info/multiaddr?cors=true&active="+txtBitcoinAddress, true);
        xmlhttp.send();
        ///
        xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        ///
            $('#SvBTC').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
        /// 
        od.append("txtBitcoinAddress", txtBitcoinAddress);
         od.append("txtBtcOtp", txtBtcOtp);
        $.ajax({
            url: "Handlers/Account-Settings.ashx?SaveTp=BTCInfo",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                     if(Response.detail == 200 )
                    {
                    
                      $('#divOtp').show();
                    }
                    else if (Response.detail == 1 )
                    {
                      $("#txtBtcOtp").val('');
                      $('#divOtp').hide();
                    }
                  $('#SvBTC').html("<div class='alert alert-success m-b-10'><strong>Welldone!</strong> " + Response.Message + " </div>");
//                      $('#SvBTC').html("<div class='alert  red-skin1 alert-rounded'><img src='images/resource/check.png' width='25' heigth='25' alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button> </div>");
                    
                   
                }
              else {
                  $('#SvBTC').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + Response.Message + " </div>");
//                    $('#SvBTC').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
                }
            },
          error: function (err) {
              $('#SvBTC').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + err.statusText + "</div>");
//                $('#SvBTC').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> "+err.statusText+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
                //$('#SvBTC').html(err.statusText);
            }
        });
        }
        }
}
////////////
////////
function SavePayTmInfo(){
$('#SvPaytm').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
    var od = new FormData();
    var txtpaytmid = $("#txtpaytmid").val();
     
     
    od.append("txtpaytmid", txtpaytmid);
     
        $.ajax({
            url: "Handlers/Account-Settings.ashx?SaveTp=SvPTM",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                    //$.messager.alert("Success", Response.Message, 'info');
                    //  $('#SvPaytm').html(Response.Message);
                    $('#SvPaytm').html("<div class='alert alert-success m-b-10'><strong>Well done!</strong> " + Response.Message + "</div>");
                }
                else {
                    //$.messager.alert("Warning", Response.Message, 'warning');
                    //                    $('#SvPaytm').html(Response.Message);
                    $('#SvPaytm').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + Response.Message + "</div>");
                }
            },
            error: function (err) {
                //$.messager.alert("Failed", err.statusText, 'error');
//                $('#SvPaytm').html(err.statusText);
                $('#SvPaytm').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + err.statusText + "</div>");
            }
        });
}
////////////
////////
function SaveUpiInfo(){
$('#SvUPI').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
    var od = new FormData();
    var txtupiAddress = $("#txtupiAddress").val();
     
     
    od.append("txtupiAddress", txtupiAddress);
     
        $.ajax({
            url: "Handlers/Account-Settings.ashx?SaveTp=SvUPI",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                    //$.messager.alert("Success", Response.Message, 'info');
//                    $('#SvUPI').html(Response.Message);
                    $('#SvUPI').html("<div class='alert alert-success m-b-10'><strong>Well Done!</strong> " + Response.Message + "</div>");
                }
                else {
                    //$.messager.alert("Warning", Response.Message, 'warning');
//                    $('#SvUPI').html(Response.Message);
                    $('#SvUPI').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + Response.Message + "</div>");
                }
            },
            error: function (err) {
                //$.messager.alert("Failed", err.statusText, 'error');
//                $('#SvUPI').html(err.statusText);
                $('#SvUPI').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + err.statusText + "</div>");
            }
        });
}
////////////
function SLoginPWD(){
//$('#SLgPWD').html('<img src="../UserProfileImg/loading2.gif" />');
$('#SLgPWD').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
    var od = new FormData();
    var txtoldpass = $("#txtoldpass").val();
     var txtnewpass = $("#txtnewpass").val();
     
    od.append("txtoldpass", txtoldpass);
     od.append("txtnewpass", txtnewpass);
        $.ajax({
            url: "Handlers/Account-Settings.ashx?SaveTp=SLgPWD",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                    $('#SLgPWD').html("<div class='alert alert-success m-b-10'> " + Response.Message + "</div>");
                    //$('#SLgPWD').html(Response.Message);
                }
                 else {

                     $('#SLgPWD').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + Response.Message + "</div>");
//                     $('#SLgPWD').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
                    //$('#SLgPWD').html(Response.Message);
                }
            },
             error: function (err) {

                 $('#SLgPWD').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + err.statusText + "</div>");
//                 $('#SLgPWD').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> "+err.statusText+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
                //$('#SLgPWD').html(err.statusText);
            }
        });
}
////////////
function SSecurityPWD(){
$('#SSecPWD').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
    var od = new FormData();
    var txtoldsecPWD = $("#txtoldsecPWD").val();
     var txtNewsecPWD = $("#txtNewsecPWD").val();
     
    od.append("txtoldsecPWD", txtoldsecPWD);
     od.append("txtNewsecPWD", txtNewsecPWD);
        $.ajax({
            url: "Handlers/Account-Settings.ashx?SaveTp=SSecPWD",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                    $('#SSecPWD').html("<div class='alert alert-success m-b-10'>" + Response.Message + "</div>");
                    
                }
                else {
                    $('#SSecPWD').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + Response.Message + "</div>");
                   
                }
            },
            error: function (err) {

                $('#SSecPWD').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> " + err.statusText + "</div>");
            }
        });
}
//////////////////////////
//////////////////////////
function SaveBankInfo() {
    $('#SvBnk').html("<div class='preloader3 loader-block'><div class='circ1 loader-warning'></div> <div class='circ2 loader-warning'></div><div class='circ3 loader-warning'></div><div class='circ4 loader-warning'></div></div>");
    var od = new FormData();
    var txtAccFName = $("#txtAccFName").val();
    var txtBakName = $("#txtBakName").val();
    var txtAccountNo= $("#txtAccountNo").val();
    var ddlAccType= $("#ddlAccType").val();
    var txtIFSCode= $("#txtIFSCode").val();
    var txtPanCard= $("#txtPanCard").val();  
    var txtbankotp= $("#txtbankotp").val();
    if (txtBakName == 'Other') {
        ////////
        txtBakName = $("#txtBankNameOtr").val();
        ////////
        if (txtBakName.length < 3) {
            alert("Please enter correct Other Bank Name!");
            return;
        }
    }
    
//     var fileUpload = $("#bankFileuplaod").get(0);
//    var files = fileUpload.files;
//    for (var i = 0; i < files.length; i++) {
//    od.append(files[i].name, files[i]);
//    }
//       
//    if(files.length ==0)
//    {
//     
//      $('#SvBnk').html("<div class='alert alert-warning border-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='icofont icofont-close-line-circled'></i></button><strong></strong>Please upload bank account proof image !</div>");
//         return
//     }  
    
    if (ddlAccType ==null)
    {
    $('#SvBnk').html("<div class='alert alert-warning border-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='icofont icofont-close-line-circled'></i></button><strong></strong>Please select  Account type</div>");
     
           return;
    }
      
     if (ddlAccType.trim() !== "Saving Account" && ddlAccType.trim() !== "Current Account" ) 
     {
       $('#SvBnk').html("<div class='alert alert-warning border-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='icofont icofont-close-line-circled'></i></button><strong></strong>Please check Account type it must be in english</div>");
        
           return;
     }
    if (txtPanCard != "") {
            PanNo = txtPanCard;
            var panPattern = /^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/;
            if (PanNo.search(panPattern) == -1) {
               
                $('#SvBnk').html("<div class='alert alert-warning border-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='icofont icofont-close-line-circled'></i></button><strong></strong>Invalid Pan No</div>");
                txtPanCard.value='';
                return;
            }
          
        }
       var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "https://ifsc.razorpay.com/"+txtIFSCode, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function () {
        $('#SvBnk').html('<img src="../UserProfileImg/loading2.gif" width="35" height="35"/>');
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            od.append("txtAccFName", txtAccFName);
            od.append("txtBakName", txtBakName);
            od.append("txtAccountNo", txtAccountNo);
            od.append("ddlAccType", ddlAccType);
            od.append("txtIFSCode", txtIFSCode);
            od.append("txtPanCard", txtPanCard);
            od.append("txtbankotp", txtbankotp);


            $.ajax({
                url: "Handlers/Account-Settings.ashx?SaveTp=BankInfo",
                type: "POST",
                contentType: false,
                processData: false,
                data: od,
                dataType: "json",
                success: function (Response) {
                    if (Response.Success) {
                        if (Response.detail == 200) {

                            $('#divbankotp').show();
                        }
                        else if (Response.detail == 1) {
                            $("#txtbankotp").val('');
                            $('#divbankotp').hide();
                        }
                        //alert(Response.Message);
                        //$.messager.alert("Success", Response.Message, 'info');
                        $('#SvBnk').html("<div class='alert alert-success border-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='icofont icofont-close-line-circled'></i></button><strong></strong>" + Response.Message + "</div>");
                    }
                    else {
                        //$.messager.alert("Warning", Response.Message, 'warning');
                        $('#SvBnk').html("<div class='alert alert-warning border-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='icofont icofont-close-line-circled'></i></button><strong></strong>" + Response.Message + "</div>");
                    }
                },
                error: function (err) {
                    //$.messager.alert("Failed", err.statusText, 'error');
                    $('#SvBnk').html("<div class='alert alert-warning border-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='icofont icofont-close-line-circled'></i></button><strong></strong>" + err.statusText + "</div>");
                }
            });
        }
        else {
            $('#SvBnk').html("Invalid IFSC code");

        }
    }
}

//////////////

function SaveEthereumInfo() {
       
        var pattern = /^0x[a-fA-F0-9]{40}$/ ;
        var od = new FormData();
        var txtEthereumAddress = $("#txtEthereumAddress").val();
        
          var txtEthOtp = $("#txtEthOtp").val();
        $('#SvETH').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
        /// 
        
        od.append("txtEthereumAddress", txtEthereumAddress);
        od.append("txtEthOtp", txtEthOtp);
          if(pattern.test(txtEthereumAddress)  && txtEthereumAddress.length == 42) {
               
                 $.ajax({
                    url: "Handlers/Account-Settings.ashx?SaveTp=ETHInfo",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: od,
                    dataType: "json",
                    success: function (Response) {
                        if (Response.Success) {     
                        
                        if(Response.detail == 200 )
                        {
                        
                          $('#divethotp').show();
                        }
                        else if (Response.detail == 1 )
                        {
                          $("#txtEthOtp").val('');
                          $('#divethotp').hide();
                        }
                        
                              $('#SvETH').html("<div class='alert  red-skin1 alert-rounded'><img src='images/resource/check.png' width='25' heigth='25' alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button> </div>");
                             
                            //$('#SvETH').html(Response.Message);
                        }
                        else {                  
                            //$('#SvETH').html(Response.Message);
                              $('#SvETH').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
                        }
                    },
                    error: function (err) {           
                        //$('#SvETH').html(err.statusText);
                         $('#SvETH').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> "+err.statusText+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
                    }
                });
            }
            else
            {
               
              
                $('#SvETH').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Invalid address format<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
            }
    
       
}



$(function() {
  var txt = $("#txtBitcoinAddress");
  var func = function() {
    txt.val(txt.val().replace(/\s/g, ''));
  }
  txt.keyup(func).blur(func);
});

//$(function() {
//  var txt = $("#txtEthereumAddress");
//  var func = function() {
//    txt.val(txt.val().replace(/\s/g, ''));
//  }
//  txt.keyup(func).blur(func);
//});












function SaveKYCInfo() {
 //$('#DvKYCUpdate').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
   // alert("ID");
    var od = new FormData();
//    var txtkycid = $("#KYCID").val();
    var txtkycidno = $("#KYCIdNo").val();
     var txtkycid = $("input:radio[name=KYCTYPE]:checked").val();

    if(txtkycidno == '')
        {
         $('#DvKYCUpdate').html("<div class='alert alert-danger m-t-10  m-b-10'>Please enter id proof no. !</div>");
         //$('#DvKYCUpdate').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please enter id proof no. !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
         return
        }
        
        
        
     
if(!$("input:radio[name=KYCTYPE]").is(":checked"))
    {
       $('#DvKYCUpdate').html("<div class='alert alert-danger m-t-10  m-b-10'>Please choose id proof !</div>");
      return
    }
    
    
    
    
//    if(txtkycid == 'Choose Id Proof')
//        {
//         $('#DvKYCUpdate').html("<div class='alert alert-danger m-t-10  m-b-10'>Please select Id Proof type !</div>");
//         //$('#DvKYCUpdate').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please select Photo Id Proof type !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
//         return
//        }
    
    
    var fileUpload = $("#IMGADDUPLOAD").get(0);
    var files = fileUpload.files;
    for (var i = 0; i < files.length; i++) {
    od.append(files[i].name, files[i]);
    }
       
    if(files.length ==0)
    {
    $('#DvKYCUpdate').html("<div class='alert alert-danger m-t-10  m-b-10'>Please choose image for upload!</div>");
     //$('#DvKYCUpdate').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please choose photo id image !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
         return
     }  
        
    od.append("txtkycid", txtkycid);
    od.append("txtkycidno", txtkycidno);    
    
    
        $.ajax({
            url: "Handlers/Account-Settings.ashx?SaveTp=KYCInfo",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
             success: function (Response) {
                if (Response.Success) {
                    // $('#DvKYCUpdate').html("<div class='alert  red-skin1 alert-rounded'><img src='images/resource/check.png' width='25' heigth='25' alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button> </div>");
                    $('#DvKYCUpdate').html("<div class='alert alert-success m-t-10  m-b-10'>"+Response.Message+"</div>");
                    window.location.href='My_Profile.html?TB=KYC';
                }
                else {
                    
                     $('#DvKYCUpdate').html("<div class='alert alert-danger m-t-10  m-b-10'>"+Response.Message+"</div>");
                   
                }
            },
            error: function (err) {
                
                  $('#DvKYCUpdate').html("<div class='alert alert-danger m-t-10  m-b-10'>"+err.statusText+"</div>");
            }
        });
        
        
        
}









function SavePorInfo() {
 //$('#DvKYCUpdate').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
 //alert('por');
    var od = new FormData();
//    var txtkycid = $("#KYCID").val();
    var txtkycidno = $("#KYCIdNo1").val();
     var txtkycid = $("input:radio[name=KYCTYPE1]:checked").val();

    if(txtkycidno == '')
        {
         $('#DvKYCUpdate1').html("<div class='alert alert-danger m-t-10  m-b-10'>Please enter id proof no. !</div>");
         //$('#DvKYCUpdate').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please enter id proof no. !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
         return
         
        }
        
        
        
     
if(!$("input:radio[name=KYCTYPE1]").is(":checked"))
    {
       $('#DvKYCUpdate1').html("<div class='alert alert-danger m-t-10  m-b-10'>Please choose id proof !</div>");
      return
    }
    
    
   
    
    var fileUpload = $("#IMGADDUPLOAD1").get(0);
    var files = fileUpload.files;
    for (var i = 0; i < files.length; i++) {
    od.append(files[i].name, files[i]);
    }
       
    if(files.length ==0)
    {
    $('#DvKYCUpdate1').html("<div class='alert alert-danger m-t-10  m-b-10'>Please choose image for upload!</div>");
     //$('#DvKYCUpdate').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please choose photo id image !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
         return
     }  
        
    od.append("txtkycid", txtkycid);
    od.append("txtkycidno", txtkycidno);    
    
    
        $.ajax({
            url: "Handlers/Account-Settings.ashx?SaveTp=PorInfo",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
             success: function (Response) {
                if (Response.Success) {
                    // $('#DvKYCUpdate').html("<div class='alert  red-skin1 alert-rounded'><img src='images/resource/check.png' width='25' heigth='25' alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button> </div>");
                    $('#DvKYCUpdate1').html("<div class='alert alert-success m-t-10  m-b-10'>"+Response.Message+"</div>");
                        window.location.href='My_Profile.html?TB=KYC';
                }
                else {
                    
                     $('#DvKYCUpdate1').html("<div class='alert alert-danger m-t-10  m-b-10'>"+Response.Message+"</div>");
                   
                }
            },
            error: function (err) {
                
                  $('#DvKYCUpdate1').html("<div class='alert alert-danger m-t-10  m-b-10'>"+err.statusText+"</div>");
            }
        });
        
        
        
}






function SavePorInfo6() {
 //$('#DvKYCUpdate').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
 
    var od = new FormData();
//    var txtkycid = $("#KYCID").val();
    var txtkycidno = $("#bankidNo2").val();
     var txtkycid = $("input:radio[name=BANKPROF2]:checked").val();
   
    if(txtkycidno == '')
        {
         $('#DvKYCUpdate56').html("<div class='alert alert-danger m-t-10  m-b-10'>Please enter id proof no. !</div>");
         //$('#DvKYCUpdate').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please enter id proof no. !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
         return
         
        }
        
        
        
     
if(!$("input:radio[name=BANKPROF2]").is(":checked"))
    {
       $('#DvKYCUpdate56').html("<div class='alert alert-danger m-t-10  m-b-10'>Please choose id proof !</div>");
      return
    }
    
    
   
    
    var fileUpload = $("#IMGADDUPLOAD5").get(0);
    var files = fileUpload.files;
    for (var i = 0; i < files.length; i++) {
    od.append(files[i].name, files[i]);
    }
       
    if(files.length ==0)
    {
    $('#DvKYCUpdate56').html("<div class='alert alert-danger m-t-10  m-b-10'>Please choose image for upload!</div>");
     //$('#DvKYCUpdate').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please choose photo id image !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
         return
     }  
     
    od.append("txtkycid", txtkycid);
    od.append("txtkycidno", txtkycidno);  
    
    
        $.ajax({
            url: "Handlers/Account-Settings.ashx?SaveTp=PorInfo6",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
             success: function (Response) {
                if (Response.Success) {
                    // $('#DvKYCUpdate').html("<div class='alert  red-skin1 alert-rounded'><img src='images/resource/check.png' width='25' heigth='25' alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button> </div>");
                    $('#DvKYCUpdate56').html("<div class='alert alert-success m-t-10  m-b-10'>"+Response.Message+"</div>");
                        window.location.href='My_Profile.html?TB=KYC';
                }
                else {
                    
                     $('#DvKYCUpdate56').html("<div class='alert alert-danger m-t-10  m-b-10'>"+Response.Message+"</div>");
                   
                }
            },
            error: function (err) {
                
                  $('#DvKYCUpdate56').html("<div class='alert alert-danger m-t-10  m-b-10'>"+err.statusText+"</div>");
            }
        });
        
        
        
}






//function SaveKYCAddInfo() {

//$('#DvKYCUpdate1').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
//    var od = new FormData();
//    var txtkycid = $("#KYCAddType").val();
//        
//        if(txtkycid == 'Choose Address Proof')
//        {
//        
//         $('#DvKYCUpdate1').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please select address type !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
//         return
//        }
//        
//        
//        
//    var fileUpload = $("#flAdd").get(0);
//    var files = fileUpload.files;
//    for (var i = 0; i < files.length; i++) {
//    od.append(files[i].name, files[i]);
//    }    
//    
//    if(files.length == 0)
//    {
//    
//     $('#DvKYCUpdate1').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please choose address image !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
//         return
//     }    
//        
//    od.append("txtkycid", txtkycid);          
//        $.ajax({
//            url: "Handlers/Account-Settings.ashx?SaveTp=KYCAddInfo",
//            type: "POST",
//            contentType: false,
//            processData: false,
//            data: od,
//            dataType: "json",
//            success: function (Response) {
//                if (Response.Success) {
//                   
//                    $('#DvKYCUpdate1').html("<div class='alert  red-skin1 alert-rounded'><img src='images/resource/check.png' width='25' heigth='25' alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button> </div>");
//                }
//                else {
//                    $('#DvKYCUpdate1').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
//                }
//            },
//            error: function (err) {
//              $('#DvKYCUpdate1').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> "+err.statusText+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
//              
//               
//            }
//        });
//}




//function SaveFaceIdInfo() {

//$('#DvKYCUpdateface').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
//    var od = new FormData();
//    var txtkycid = $("#faceiddoc").val();
//    
//    if(txtkycid == 'Choose face Id Proof')
//        {
//        
//         $('#DvKYCUpdateface').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please select Photo Id Proof type !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
//         return
//        }
//    
//        
//    var fileUpload = $("#flIDface").get(0);
//    var files = fileUpload.files;
//    for (var i = 0; i < files.length; i++) {
//    od.append(files[i].name, files[i]);
//    }  
//    
//    if(files.length ==0)
//    {
//    
//     $('#DvKYCUpdateface').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> Please choose face id image !<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
//         return
//     }         
//    od.append("txtkycid", txtkycid);          
//        $.ajax({
//            url: "Handlers/Account-Settings.ashx?SaveTp=FaceIdInfo",
//            type: "POST",
//            contentType: false,
//            processData: false,
//            data: od,
//            dataType: "json",
//            success: function (Response) {
//                if (Response.Success) {
//                   
//                    $('#DvKYCUpdateface').html("<div class='alert  red-skin1 alert-rounded'><img src='images/resource/check.png' width='25' heigth='25' alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button> </div>");
//                }
//                else {
//                    $('#DvKYCUpdateface').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> "+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
//                }
//            },
//            error: function (err) {
//              $('#DvKYCUpdateface').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> "+err.statusText+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
//              
//               
//            }
//        });
//}





function ShowImagePreview1(input) 
 {  
  
    if (input.files && input.files[0]) 
    {
        var FileSize = input.files[0].size / 1024 ; // in KB
        if (FileSize > 500) 
        {
           
             $('#DvKYCUpdate').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> File size exceeds 500 KB<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
            return;
            // $(file).val(''); //for clearing with Jquery
        }
        else 
        { 
            var reader = new FileReader();
            reader.onload = function (e) 
            {
                $('#ImgID').prop('src', e.target.result);                
            };
            reader.readAsDataURL(input.files[0]);
        }
     }
     else 
     {
         $('#ImgID').prop('src', 'UserProfileImg/Not_available.jpg');
     } 
 }
 
 
   
 
 
 
 
 function ShowImagePreview2(input) 
 {
       
    if (input.files && input.files[0]) 
    {
        var FileSize = input.files[0].size / 1024 ; // in KB
        if (FileSize > 500) 
        {
          $('#DvKYCUpdate').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> File size exceeds 500 KB<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
            return;
            // $(file).val(''); //for clearing with Jquery
        }
        else 
        { 
        
            var reader = new FileReader();
            reader.onload = function (e) 
            {
                $('#ImgAdd789').prop('src', e.target.result);
                  $('#ImgAdd789').show();               
            };
            reader.readAsDataURL(input.files[0]);
        }
     }
     else 
     {
         $('#ImgAdd789').prop('src', '../UserProfileImg/Not_available.jpg');
      }
    
 }
 
 function ShowImagePreview98(input) 
 {
       
    if (input.files && input.files[0]) 
    {
        var FileSize = input.files[0].size / 1024 ; // in KB
        if (FileSize > 500) 
        {
          $('#DvKYCUpdate1').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> File size exceeds 500 KB<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
            return;
            // $(file).val(''); //for clearing with Jquery
        }
        else 
        { 
        
            var reader = new FileReader();
            reader.onload = function (e) 
            {
                $('#ImgAdd78985').prop('src', e.target.result);
                  $('#ImgAdd78985').show();               
            };
            reader.readAsDataURL(input.files[0]);
        }
     }
     else 
     {
         $('#ImgAdd78985').prop('src', '../UserProfileImg/Not_available.jpg');
      }
    
 }
 
 
  function ShowImagePreview9889(input) 
 {
       
    if (input.files && input.files[0]) 
    {
        var FileSize = input.files[0].size / 1024 ; // in KB
        if (FileSize > 500) 
        {
          $('#DvKYCUpdate56').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> File size exceeds 500 KB<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
            return;
            // $(file).val(''); //for clearing with Jquery
        }
        else 
        { 
        
            var reader = new FileReader();
            reader.onload = function (e) 
            {
                $('#ImgAdd7898558').prop('src', e.target.result);
                  $('#ImgAdd7898558').show();               
            };
            reader.readAsDataURL(input.files[0]);
        }
     }
     else 
     {
         $('#ImgAdd7898558').prop('src', '../UserProfileImg/Not_available.jpg');
      }
    
 }
  
 
// 
// function ShowImagePreviewface(input) 
// {  
//  
//    if (input.files && input.files[0]) 
//    {
//        var FileSize = input.files[0].size / 1024 ; // in KB
//        if (FileSize > 300) 
//        {
//              $('#DvKYCUpdateface').html("<div class='alert red-skin alert-rounded'><img src='images/close-button.png'width='25' heigth='25'  alt=''> File size exceeds 300 KB<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>×</span> </button>  </div>");
//            return;
//            // $(file).val(''); //for clearing with Jquery
//        }
//        else 
//        { 
//            var reader = new FileReader();
//            reader.onload = function (e) 
//            {
//                $('#ImgIDface').prop('src', e.target.result);                
//            };
//            reader.readAsDataURL(input.files[0]);
//        }
//     }
//     else 
//     {
//         $('#ImgIDface').prop('src', '../UserProfileImg/Not_available.jpg');
//     } 
// }

 //////////////////////////upload file/////////////////////

 var handleRenderjQueryFileUpload = function () {
     $("#flID").fileupload({
         url: "Handlers/Account-Settings.ashx?SaveTp=KYCAddInfo",
         disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
         maxFileSize: 999e3,
         acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
     }), $("#flID").bind("fileuploadchange", function (e, l) {
         $("#flID .empty-row").hide()
     }), $("#flID").bind("fileuploadfail", function (e, l) {
         "abort" === l.errorThrown && 1 == $("#flID .files tr").not(".empty-row").length && $("#flID .empty-row").show()
     }), $.support.cors && $.ajax({
         url: "Handlers/Account-Settings.ashx?SaveTp=KYCAddInfo",
         type: "HEAD"
     }).fail(function () {
         var e = '<div class="alert alert-danger m-b-0 m-t-15">Upload server currently unavailable - ' + new Date + "</div>";
         $("#flID #error-msg").html(e)
     })
 },
    jQueryFileUpload = function () {
        "use strict";
        return {
            init: function () {
                handleRenderjQueryFileUpload()
            }
        }
    } ();
// function addchange()
// {
// 
// var add  =  $('#KYCAddType :selected').text();
// 
// $('#add-change').text(add);
// 
//  var add  =  $('#faceiddoc :selected').text();
// 
// $('#face-change').text(add);
// 
//  var add  =  $('#KYCID :selected').text();
// 
// $('#photo-change').text(add);
// }
 
 function getifsc(ifsc)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","https://ifsc.razorpay.com/"+ifsc, true);
    xmlhttp.send();
    ///   
            xmlhttp.onreadystatechange = function() 
            {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                {  
                    var jsontext=xmlhttp.responseText;
                    var data = JSON.parse(jsontext);
                    
                    $('#ifscdt').html("<div class='alert alert-success border-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='icofont icofont-close-line-circled'></i></button><strong>"+data.IFSC+", "+data.BANK+", "+data.ADDRESS+"</strong> </div>");         
                     
                     
                }
                else
                {
                    $('#ifscdt').html("<div class='alert alert-danger border-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='icofont icofont-close-line-circled'></i></button><strong>Invalid ifsc code: " + ifsc + "</strong> </div>");         
                  
                }
             }
             
}





//function ShowBankImg(input) 
// {  
//  
//    if (input.files && input.files[0]) 
//    {
//        var FileSize = input.files[0].size / 1024 ; // in KB
//        if (FileSize > 500) 
//        {
//        $('#SvBnk').html('<span style="color:#d84e4e;">File size exceeds 500 KB</span>');      
//            return;
//        }
//        else 
//        { 
//            var reader = new FileReader();
//            reader.onload = function (e) 
//            {
//                $('#ImgBANKP').show();
//                $('#ImgBANKP').prop('src', e.target.result);                
//            };
//            reader.readAsDataURL(input.files[0]);
//        }
//     }
//     else 
//     { 
//         $('#ImgBANKP').prop('src', '../uploads/BANK/Not_available.jpg');
//     } 
// }
