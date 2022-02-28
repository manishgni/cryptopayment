// JScript File

 //////////
function DWalletAmtRequest(TranHas,SndrAdds,amount,PlnAmt,PayType,txndate,Deptype) {    
    ////////
    $('#Msgs').html('<img src="../UserProfileImg/loading2.gif" width="35" height="35" />');
    var od = new FormData();
    var txtBTCAddress=SndrAdds;//$("#txtBTCAddress").val();    
    var txtTxnHas= TranHas;//$("#txtTxnHas").val(); 
    var txtReqAmt= amount; 
    var PayType= PayType;  
       var reqdate =  txndate;b                
        var SeqPwd =  "";
       var PlnAmt = amount;
      var Deptype = "Fund Request";
    ////////
    od.append("txtBTCAddress", txtBTCAddress);
    od.append("txtTxnHas", txtTxnHas);
    od.append("txtReqAmt", txtReqAmt);
    od.append("PlnAmt", PlnAmt);
    od.append("PayType", PayType);        
     od.append("Deptype", Deptype);
       od.append("ReqDate", reqdate); 
       od.append("SeqPwd", SeqPwd);
       
    ///////
        $.ajax({
            url: "Handlers/DWallet-Amt_Request.ashx?Save=BTCInfo",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                    $("#txtAdPckAmt").val('');
                    $("#txtTxnHas").val(''); 
                    $("#AdPackNo").val('');                    
                                   
                     $('#Msgs').html(" <div class='alert alert-success m-t-10  m-b-10'> "+Response.Message+" <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: -5px;'>×</span> </button> </div>");
                     $('#DepostHtry').load("Handlers/Common-Values.ashx?Vs=DepostHtry");
                }
                else {                 
                     $('#Msgs').html("<div class='alert alert-danger m-t-10  m-b-10'>"+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: 0px;'>×</span> </button>  </div>");
                }
            },
            error: function (err) {
           
             $('#Msgs').html(" <div class='alert alert-danger m-t-10  m-b-10'>"+err.statusText+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: 0px;'>×</span> </button>  </div>");
              
            }
        });
}

///
  
                     
  
  
  
  
  
  
  function Save_data() {    
    ////////
    
    var paymode = $  ('#paymode').val();
    
    if (paymode == "BTC")
    {
        init_data() ;
    }
    else 
    {
        $('#Msgs').html('<img src="../UserProfileImg/loading2.gif" width="35" height="35" />');
     var od = new FormData();
    var txtBTCAddress=$('#txtBTCAddress').val();
    var txtTxnHas= $("#txtTxnHas").val();//$("#txtTxnHas").val(); 
    var txtReqAmt= $("#txtamt").val();
    var paidonbankamt= $("#paidonbankamt").val();
    var reqdate =  $("#SpDate").val();
     var PayBy =  $("#PaymentBy").val();
    //alert(paidonbankamt); 
    ////////
    od.append("txtBTCAddress", txtBTCAddress);
    od.append("txtTxnHas", txtTxnHas);
    od.append("txtReqAmt", txtReqAmt);
  od.append("paidonbankamt", paidonbankamt);
    od.append("PlnAmt", txtReqAmt);  
    od.append("ReqDate", reqdate); 
    od.append("paymode", paymode); 
     od.append("PayBy", PayBy); 
    
    
    var fileUpload = $("#fluplodBTC").get(0);
    var files = fileUpload.files;
    for (var i = 0; i < files.length; i++) {
    od.append(files[i].name, files[i]);
    }  
    
  
        var FileSize = files[0].size / 1024 ; // in KB
        if (FileSize > 500) 
        {   
         $('#Msgs').html("<div class='alert alert-danger m-t-10  m-b-10'>Upload Receipt size exceeds 500 KB<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: 0px;'>×</span> </button>  </div>");     
       
          return;
        }   
 
    ///////
        $.ajax({
            url: "Handlers/DWallet-Amt_Request.ashx?Save=BANKInfo",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                     $('#Msgs').html(" <div class='alert alert-success m-t-10  m-b-10'> "+Response.Message+" <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: -5px;'>×</span> </button> </div>");
                
                    location.reload();  
                
                }
                else {
                    $('#Msgs').html("<div class='alert alert-danger m-t-10  m-b-10'>"+Response.Message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: 0px;'>×</span> </button>  </div>");
                }
            },
            error: function (err) {
               $('#Msgs').html(" <div class='alert alert-danger m-t-10  m-b-10'>"+err.statusText+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true' style='position: relative;top: 0px;'>×</span> </button>  </div>");
            }
        });
    
    }
     
   
}


 //////////////////
 function FunctionTopMsg()
    {
     
        var paymode = $('#paymode').val(); 
        
        var btcaddress = $('#btcadd').val();
        var paytmaddress = $('#paytmadd').val();
        var upiaddress = $('#upiadd').val();
        var bankaccno = $('#bankacno').val();
        var bankname = $('#bankname').val();
        var ifsccode = $('#bankifsc').val();
        var acholder = $('#bankacholder').val();
        
        if (paymode != "")
        {
            if (paymode == "BTC")
            {
             $('#topmsg').html("Please make payment on given below BTC Address by your block chain wallet & <span style='font-size:16px; font-weight:bold;'>Enter Request Amount & Transaction hash</span>.If all details will be correct then we will accept fund request & credit amount in c-Wallet...");                
             $('#Topmsg1').html("Request Payment into BTC address : ");
             $('#NewBTC').html(btcaddress);
             $('#txtBTCAddress').val(btcaddress);
            }
            if (paymode == "BANK")
            {
             $('#topmsg').html("Please make payment on give below Bank Address by your Bank Account & <span style='font-size:16px; font-weight:bold;'>Enter Request Amount & Transaction No</span>.If all details will be correct then we will accept fund request & credit amount in c-Wallet...");                
             $('#Topmsg1').html("Request Payment into Bank Account Details : ");
             $('#NewBTC').html("Bank Name: "+bankname+", Account Name: "+acholder+", Account No: "+bankaccno+", IFS Code: "+ifsccode);
             $('#txtBTCAddress').val(ifsccode);
            }
            if (paymode == "PAYTM")
            {
             $('#topmsg').html("Please make payment on given below Paytm Address by your Paytm wallet & <span style='font-size:16px; font-weight:bold;'>Enter Request Amount & Transaction No</span>.If all details will be correct then we will accept fund request & credit amount in c-Wallet...");                
             $('#Topmsg1').html("Request Payment into Paytm address : ");
             $('#NewBTC').html("<a href='"+paytmaddress+"' target='_blank'>"+paytmaddress+"</a>");
             $('#txtBTCAddress').val(paytmaddress);
            }
            if (paymode == "UPI")
            {
             $('#topmsg').html("Please make payment on given below UPI Address by your UPI wallet & <span style='font-size:16px; font-weight:bold;'>Enter Request Amount & Transaction No</span>.If all details will be correct then we will accept fund request & credit amount in c-Wallet...");                
             $('#Topmsg1').html("Request Payment into UPI address : ");
             $('#NewBTC').html(upiaddress);
             $('#txtBTCAddress').val(upiaddress);
            }
        }
    }
    










