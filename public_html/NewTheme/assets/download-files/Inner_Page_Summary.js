$(function()
{
    $('#MName').load("Handlers/Common-Values.ashx?Vs=RefLinkHome");
//    $('#MemID').load("Handlers/Common-Values.ashx?Vs=RefLinkHome");
    DashboardSummary();
    
   
})
/////////
function dashFlag() {
       $.getJSON('Handlers/Current-Vistors.ashx?Typ=2',
        
        function (tst) {
            if (tst.length == 0) { 
            $('#DashFlag').html('');                                
            }
            else {
                var dd = formatOrder(tst);
                $('#DashFlag').html(dd);                
            }
        });  
}
//////
function formatOrder(tst) {
    var pp1l='';    
    for (var i = 0; i < tst.length; i++) {   
    
        pp1l=pp1l+"<a class='dropdown-item' href='#'><i class='flag-icon flag-icon-"+ tst[i].Code+"'></i> "+tst[i].Country+"</a>";
       
    }
    $('#DashFlag').html('');
    return pp1l;
}
////////// 
function DashboardSummary() {
///////
    
// $('#Mem_Name').html('<img src="../UserProfileImg/loading2.gif" />');
///////
        $.getJSON('Handlers/Inner_Page_Summary.ashx',
        function (OrjsonDS) {
            if (OrjsonDS.length == 0) {   
            }
            else {
                var wa='';
                for (var i = 0; i < OrjsonDS.length; i++) {       
                ///// for Dashboard details...
//                  MemID = OrjsonDS[i].MemID;
//                  callbackXpub(MemID);
                    $('#TOTAL_DEPOSIT').html('' + OrjsonDS[i].TOTAL_DEPOSIT+'<span class="vert">INR</span>');
                 $('#TotWithdrawal').html(''+OrjsonDS[i].WithdrawalTotal+'<span class="vert">INR</span>');
                  $('#Totbussiness').html('Rs. '+OrjsonDS[i].Teambsns);
                 
                  $('#Lastdpamt').html(OrjsonDS[i].Lastdpamt);
                 
                 $('#TotTeam2').html(OrjsonDS[i].TotTeam2);
                 $('#TotTeambsns').html(OrjsonDS[i].TotTeam);                 
              
                $('#Active1').html(OrjsonDS[i].TOTACT1);
                $('#Inactive1').html(OrjsonDS[i].TOTINACT1);
               
               $('#Active2').html(OrjsonDS[i].TOTACT1);
                

                $('#Inactive2').html(OrjsonDS[i].TOTINACT1);


                $('#MName').html(OrjsonDS[i].MemName);
                $('#MemID').html(OrjsonDS[i].MemID);

                
                $('#Block1').html(OrjsonDS[i].totBlock1);
                 $('#sts').html(OrjsonDS[i].MemSts1);
                $('#acttm').val(OrjsonDS[i].TOTACT1);
                $('#incttm').val(OrjsonDS[i].TOTINACT1);
                $('#bltm').val(OrjsonDS[i].totBlock1);
                $('#actrf').val(OrjsonDS[i].ACTIVE_REFERAL);
                $('#inctrf').val(OrjsonDS[i].INACTIVE_REFERAL);
                $('#blrf').val(OrjsonDS[i].Block_REFERAL);
                 ///
                 $('#TOTAL_REFERRALS').html(OrjsonDS[i].TOTAL_REFERRALS);
                ///
                 $('#prof_pic').html("<img src='../" + OrjsonDS[i].Mem_Profl_Pic + "' alt='user'/>");
                //
                $('#Mem_Profl_Pic').html("<img width='44' height='44' src='../"+OrjsonDS[i].Mem_Profl_Pic+"' alt='user'/>");

                $('#Mem_Profl_Pic1').html("<img width='44' height='44' src='../" + OrjsonDS[i].Mem_Profl_Pic + "' alt='user'/>"); 
                
                
                // $('#Mem_Profl_cc').html("<img style='height: auto;width: 50px;' src='../"+OrjsonDS[i].Mem_Profl_Pic+"' alt='user'/>"); 
                
                ///
               // $("#MemPic").attr('src',"../"+OrjsonDS[i].Mem_Profl_Pic+"");
                //
               // $("#MemPic1").attr('src',"../"+OrjsonDS[i].Mem_Profl_Pic+"");
                //  $("#MemPic2").attr('src',"../"+OrjsonDS[i].Mem_Profl_Pic+"");
                ///
                $('#Mem_Name').html(OrjsonDS[i].MemName);
                $('#MemName').html(OrjsonDS[i].MemName);
               // $('#MemName').html(OrjsonDS[i].MemName + " (" + OrjsonDS[i].MemID + ")");
                 
                 
                  $('#MemNam2').html(OrjsonDS[i].MemName);
                  
                             
                  $('#Lastdpamt').text(OrjsonDS[i].LastDepAmt);
                
                ///
                $('#Totte').html("Team "+OrjsonDS[i].TotTeam);

                $('#MemID4').html(OrjsonDS[i].Mem_Name.toUpperCase() + ' (' + OrjsonDS[i].MemID + ')');
                ///
                $('#TotRef').html("Directs "+OrjsonDS[i].TOTAL_REFERRALS);
                ///
                $('#mememail').html(OrjsonDS[i].email1);
                $('#mememail1').html(OrjsonDS[i].email1);
                 //$('#txtmemiddeposit').val(OrjsonDS[i].email1);
                 
               
                $('#memid1').html(OrjsonDS[i].MemID);   
                $('#RefLink99').val(OrjsonDS[i].MemID);

            
                ///
                /////////////for deposit/////////
               if(OrjsonDS[i].NewBTCapi != '')
                  {
//                  $("#showconfdiv").show();
//                     $("#showpaymtdiv").show();
                // $('#RecBtcdep').html(OrjsonDS[i].NewBTCapi);
                 //$('#depamt').html(OrjsonDS[i].depmt);
                 //$('#btcaddAPI').val(OrjsonDS[i].NewBTCapi);
                 //$('#NewBTCapiQR').html("<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl="+ OrjsonDS[i].NewBTCapi +"' width='150' height='150'>");
                  }
                //////////////////////////////////
                
                $('#btcadd').val(OrjsonDS[i].BTCAddress);
                ///
                //init_data();
                  $('#ethadd').val(OrjsonDS[i].ETHAddress);                 
                  $('#NewETH').text(OrjsonDS[i].ETHAddress);
                  $('#NewBTC').text(OrjsonDS[i].BTCAddress);
                  
                  if(OrjsonDS[i].BTCAddress != '')
                  {
                  $('#NewBTCQR').html("<img src='//chart.googleapis.com/chart?chs=300x300&cht=qr&chl="+ OrjsonDS[i].BTCAddress +"' width='150' height='150'>");
                  }
                  
                  if(OrjsonDS[i].ETHAddress != '')
                   {
                   $('#NewETHQR').html("<img src='//chart.googleapis.com/chart?chs=300x300&cht=qr&chl="+ OrjsonDS[i].ETHAddress +"' width='100' height='100'>");
                   }
                ////
                $('#paytmadd').val(OrjsonDS[i].PaytmID);
                ///
                $('#upiadd').val(OrjsonDS[i].UPIID);
                ///
                $('#bankacno').val(OrjsonDS[i].BankAccNo);
                ///
                $('#bankname').val(OrjsonDS[i].BankName);
                ///
                $('#bankifsc').val(OrjsonDS[i].BankIFSC);
                ///
                $('#bankacholder').val(OrjsonDS[i].AcHolderName);
                ///
                //$('#txtmemiddeposit').val(OrjsonDS[i].MemID);
                ///
                $('#profJoin').html("You have join system on - "+OrjsonDS[i].Sign_UpOn+" & Actived on : "+OrjsonDS[i].Actived_On);
                ///
                if(OrjsonDS[i].Actived_On =="Not Active")
                {
                $('#Activeon').html("....");
                //$('#Activeon1').text("....");
                }
                else
                {
                 $('#Activeon').html(OrjsonDS[i].Actived_On);
                 //$('#Activeon1').text(OrjsonDS[i].Actived_On);
                }
                
                $('#signon').html(OrjsonDS[i].Sign_UpOn);
                
               
                    $('#TOTAL_DEPOSITBTC').html('Rs. '+OrjsonDS[i].TOTAL_DEPOSITBTC);
                      $('#TOTAL_DEPOSITBTC1').html('Rs. '+OrjsonDS[i].TOTAL_DEPOSITBTC);
                    
                 
                
                if(OrjsonDS[i].TOTAL_DEPOSITeth > 0)
                    {
                    $('#TOTAL_DEPOSITeth').html('<span class="sky-skin"><i class="fa fa-usd"></i></span><p><i class="fa  fa-arrow-up up"></i>Deposit By ETH </p><h3 >Rs'+OrjsonDS[i].TOTAL_DEPOSITeth+'</h3>');
                    }
                    else
                    {
                     $('#TOTAL_DEPOSITeth').html('<span class="sky-skin"><i class="fa fa-usd"></i></span><p><i class="fa  fa-arrow-down down"></i>Deposit By ETH </p><h3 >Rs'+OrjsonDS[i].TOTAL_DEPOSITeth+'</h3>');
                    }
               
                
                $('#TOTAL_DEPOSITWALLET').html('Rs. '+OrjsonDS[i].TOTAL_DEPOSITWALLET);
                $('#TOTAL_DEPOSITWALLET1').html('Rs. '+OrjsonDS[i].TOTAL_DEPOSITWALLET);
                
                
//                 if(OrjsonDS[i].TOTAL_DEPOSITWALLET > 0)
//                    {
//                    $('#TOTAL_DEPOSITWALLET').html('<span class="purple-skin"><i class="fa fa-bullhorn"></i></span><p><i class="fa  fa-arrow-up up"></i>Deposit For Self</p><h3 >$'+OrjsonDS[i].TOTAL_DEPOSITWALLET+'</h3>');
//                    }
//                    else
//                    {
//                     $('#TOTAL_DEPOSITWALLET').html('<span class="purple-skin"><i class="fa fa-bullhorn"></i></span><p><i class="fa  fa-arrow-down down"></i>Deposit For Self </p><h3 >Rs'+OrjsonDS[i].TOTAL_DEPOSITWALLET+'</h3>');
//                    }
               
               
                  $('#Totteamdep').html('Rs. '+OrjsonDS[i].TOTAL_downlindeposit);
                   
//                   if(OrjsonDS[i].TOTAL_downlindeposit > 0)
//                    {
//                    $('#Totteamdep').html('<span class="pink-skin"><i class="fa fa-shopping-cart"></i></span><p><i class="fa   fa-arrow-up up"></i>DOWNLINE DEPOSIT </p><h3 >'+OrjsonDS[i].TOTAL_downlindeposit+'</h3>');
//                   
//                    }
//                    else
//                    {
//                      $('#Totteamdep').html('<span class="pink-skin"><i class="fa fa-shopping-cart"></i></span><p><i class="fa  fa-arrow-down down"></i>DOWNLINE DEPOSIT</p><h3 >'+OrjsonDS[i].TOTAL_downlindeposit+'</h3>');
//                    }
//                  
                  
                
                $('#TotalRef').html(OrjsonDS[i].TOTAL_REFERRALS);
                $('#Active').html(OrjsonDS[i].ActTeam);
                $('#Inactive').html(OrjsonDS[i].Inactive);
                $('#Block').html(OrjsonDS[i].totBlock);
                $('#Topup').html(OrjsonDS[i].TotTeamDeposit);
                $('#Bonus').html(OrjsonDS[i].TotTeamBonus);
                $('#footertext').html(OrjsonDS[i].CompanyName);
                
                
                 $('#LastDepositOn').html(OrjsonDS[i].LastDepositOn);
                


                $('#Tot_Msg_Cunt').html(OrjsonDS[i].Tot_Msg_Cunt);
                //
                $('#Msg_Cunt').html(OrjsonDS[i].Msg_Cunt);
                //
                $('#Msg_CuntTP').html(OrjsonDS[i].Msg_Cunt);
                
                
                 $('#ACTIVE_REFERAL').html(OrjsonDS[i].ACTIVE_REFERAL);
                  $('#INACTIVE_REFERAL').html(OrjsonDS[i].INACTIVE_REFERAL);
                   $('#Block_REFERAL').html(OrjsonDS[i].Block_REFERAL);
              
                //////////////
                   $('#BWalletBal').html("Rs. " + OrjsonDS[i].BWalletBal);
                $('#TotBTCReq').html("Rs. "+OrjsonDS[i].TotBTCReq);
                $('#TotETHReq').html("Rs. "+OrjsonDS[i].TotETHReq);
                //////////////
                 $('#LastbtcReq').html(OrjsonDS[i].LastbtcReq);
                 $('#LastethReq').html(OrjsonDS[i].LastethReq);
                 
                  $('#LastDepositOnBTC').html(OrjsonDS[i].LastDepositOnBTC);
                  
                   $('#LastDepositOnBTC').html(OrjsonDS[i].LastDepositOnBTC);
                 
                 
                  //////////////////ALL WALLET BAL/////////////////
                 $('#offerBonus').html(OrjsonDS[i].ofrBns);
  
                   
                   $('#RBal').html(OrjsonDS[i].RBal);
                    $('#ProfitBal').val(OrjsonDS[i].RBal);
                    $('#RBalsh').html('Rs. ' +  OrjsonDS[i].RBal+'');
                   $('#Rcr').html( + OrjsonDS[i].Rcr+'');
                   $('#Rdr').html( + OrjsonDS[i].Rdr+'');
                   
                   $('#FBal').html(OrjsonDS[i].FBal);
                   $('#FBald').html('' +  OrjsonDS[i].FBal);
                     $('#FBald58').html('Rs. ' +  OrjsonDS[i].FBal);
                    $('#FBald62').html('Rs. ' +  OrjsonDS[i].FBal);
                   $('#Fcr').html(+ OrjsonDS[i].Fcr+'');
                   $('#Fdr').html( + OrjsonDS[i].Fdr+'');
                   
                   $('#IBal').html('Rs. '+OrjsonDS[i].IBal);
                   $('#BonusBal').val(OrjsonDS[i].IBal);
                   $('#IBalsh').html('Rs. '+OrjsonDS[i].IBal);
                   $('#Icr').html('Rs. '+ OrjsonDS[i].Icr+'');
                   $('#Idr').html('Rs. '+OrjsonDS[i].Idr+'');

                   $('#Totcnffr').html('Rs. ' + OrjsonDS[i].Totcnffr);
                   $('#Totfr').html('Rs. ' + OrjsonDS[i].Totfr);
                   
                    $('#DBal').html('Rs. ' + OrjsonDS[i].DBal);
                     $('#Dcr').html('Rs. ' + OrjsonDS[i].Dcr);
                     $('#Ddr').html('Rs. ' + OrjsonDS[i].Ddr);


                     $('#PIBal').html('Rs. ' + OrjsonDS[i].PIBal);
                     $('#PIDcr').html('Rs. ' + OrjsonDS[i].PIDcr);
                     $('#PIDdr').html('Rs. ' + OrjsonDS[i].PIDdr);


                     $('#PLBal').html('Rs. ' + OrjsonDS[i].PLBal);
                     $('#PLcr').html('Rs. ' + OrjsonDS[i].PLcr);
                     $('#PLdr').html('Rs. ' + OrjsonDS[i].PLdr);

                     $('#AIBal').html('Rs. ' + OrjsonDS[i].AIBal);
                     $('#PIBal').html('Rs. ' + OrjsonDS[i].PIBal); 
                     

                   
                    $('#Srcr').html('Rs. ' + OrjsonDS[i].Srcr);
                     $('#Srdr').html('Rs. ' + OrjsonDS[i].Srdr);
                     $('#SrBal').html('Rs. ' + OrjsonDS[i].SrBal);  
                    
                    
                     $('#SRin').html('Rs. ' + OrjsonDS[i].Srcr);
                     $('#SRout').html('Rs. ' + OrjsonDS[i].Srdr);
                     
                      $('#TmPsBal').html('Rs. ' + OrjsonDS[i].TmPsBal);
                     $('#TmPsIn').html('Rs. ' + OrjsonDS[i].TmPsIn);
                     $('#TmPsOut').html('Rs. ' + OrjsonDS[i].TmPsOut);
                     
                      $('#RlupBal').html('Rs. ' + OrjsonDS[i].RlupBal);
                     $('#RlupIn').html('Rs. ' + OrjsonDS[i].RlupIn);
                     $('#RlupOut').html('Rs. ' + OrjsonDS[i].RlupOut);

                    
                     
                     $('#RoyalBal').html('' + OrjsonDS[i].SrBal+'<span class="vert">INR</span>');
                     $('#dirwaltBal').html('' + OrjsonDS[i].DBal+'<span class="vert">INR</span>');
                     $('#profwalBal').html('' + OrjsonDS[i].RBal+'<span class="vert">INR</span>');
                     $('#teamprofsharingBal').html('' + OrjsonDS[i].TmPsBal+'<span class="vert">INR</span>');
                     $('#rankbonBal').html('' + OrjsonDS[i].IBal + '<span class="vert">INR</span>');
                     $('#amzingincbal').html('' + OrjsonDS[i].PLBal + '<span class="vert">INR</span>');
                     $('#promotionincbal').html('' + OrjsonDS[i].PIBal + '<span class="vert">INR</span>');
                     
                     $('#hdRoyaltyBal').val(OrjsonDS[i].IBal);     
                     $('#hddirectbonusBal').val(OrjsonDS[i].DBal);
                     $('#hdProfitSharing').val(OrjsonDS[i].RBal);
                     $('#hdteamprofitsharing').val(OrjsonDS[i].TmPsBal);
                     $('#RoyalBonus').val(OrjsonDS[i].SrBal);
                     $('#AmazingincBonus').val(OrjsonDS[i].PLBal);
                     $('#PromotionalIncBonus').val(OrjsonDS[i].PIBal);
                 
                   //////////////////END/////////////////
                   if(OrjsonDS[i].MemSts=="GREEN")
                   {
                    $('#AwalletList').show();
                    $('#AwalletListmsg').html("");
                   }
                   else
                   {
                    $('#AwalletList').hide();
                     $('#AwalletListmsg').html("<div class='alert alert-danger m-b-10'><strong>Sorry!</strong> No Tips found</div>");
                   }
//                $('#MinAmt').html("$"+ OrjsonDS[i].MinAmt);
//                $('#MaxAmt').html("$"+OrjsonDS[i].MaxAmt);
//                $('#MltAmt').html("$"+OrjsonDS[i].MltAmt);
                                                               
                }               
            }
        }); 
   }


   function actrfsh() {
   
       var rf = $('#rfs').val();
       if (rf == "Active") {
           $('#rfnm').html('<i style="font-size: 13px;">Total Active : </i>');
           $('#ACTIVE_REFERAL').html($('#actrf').val());
       }
       if (rf == "InActive") {
           $('#rfnm').html('<i style="font-size: 13px;">Total In-Active: </i>');
           $('#ACTIVE_REFERAL').html($('#inctrf').val());
       }
       if (rf == "Block") {
           $('#rfnm').html('<i style="font-size: 13px;">Total Block: </i>');
           $('#ACTIVE_REFERAL').html($('#blrf').val());
       }
   }



   function acttmsh() {
       var tm = $('#tms').val();
       if (tm == "Active") {
           $('#tmnm').html('<i style="font-size: 13px;">Total Active : </i>');
           $('#Active1').html($('#acttm').val());
       }
       if (tm == "In Active") {
           $('#tmnm').html('<i style="font-size: 13px;">Total In-Active : </i>');
           $('#Active1').html($('#incttm').val());
       }
       if (tm == "Block") {
           $('#tmnm').html('<i style="font-size: 13px;">Total Block : </i>');
           $('#Active1').html($('#bltm').val());
       }
   }
  
  
  
   
//  
//  function callbackXpub(MemID)
//  {
//   $.getJSON('https://api.blockchain.info/v2/receive?xpub=xpub6DG21zHUsx6hmUzTiJ2UHiBEGbFRNtsvDtoZJgsGzQ5uWEbAqrYaDeq6NRjUkAxfYkLLV6m6UE7mWodPmNL5GhU3ZwS5H6A8sNvMFgyhNt8&key=f38981ae-1329-42cf-b02b-0ae9893ecfc8&callback=https%3A%2F%2Fdream21.in%2FBTC-API-457-CB.ashx%3Fsecret%3DSucces24!7H1p%26ODsID%3D='+MemID, function (data) {             
//      
//        var address = JSON.stringify(data.address);    
//         var index = JSON.stringify(data.index);        
//       
//     });  
//     
//   } 
   



   
   
 
   
  