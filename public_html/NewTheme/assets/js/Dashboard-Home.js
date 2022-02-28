$(document).ready(function () {
    DashboardSummary();
//    ////
    //$('#people-list').html('<img src="../UserProfileImg/loading2.gif" />');
    $('#people-list').load("Handlers/Common-Values.ashx?Vs=TopJngs");  
    ////
    //$('#News').html('<img src="../UserProfileImg/loading2.gif" />');
    $('#News').load("Handlers/Common-Values.ashx?Vs=News");  
    ////
    //$('#RecAct').html('<img src="../UserProfileImg/loading2.gif" />');
    $('#RecAct').load("Handlers/Common-Values.ashx?Vs=RecAct");  
    ////
     $('#RefLink1').load("Handlers/Common-Values.ashx?Vs=RefLink2");           
     $('#RefLink101').load("Handlers/Common-Values.ashx?Vs=RefLink1");
       $('#RefLink102').load("Handlers/Common-Values.ashx?Vs=RefLinkHome");

$('#divTips').load("Handlers/Common-Values.ashx?Vs=Tips");  
    $('#divTipsResult').load("Handlers/Common-Values.ashx?Vs=TipsResult");  
     
     $('#ShareSM').load("Handlers/Common-Values.ashx?Vs=ShareSM");
    ////  
     $('#HowToEarn').load("Handlers/Common-Values.ashx?Vs=HowToEarn");

    // $('#Our-Team').load("Handlers/Common-Values.ashx?Vs=OurTeam");
//     $('#myteam').load("Handlers/Common-Values.ashx?Vs=MyTeam");
//     $('#pool2team').load("Handlers/Common-Values.ashx?Vs=pool2team");
//     $('#pool3team').load("Handlers/Common-Values.ashx?Vs=pool3team");
     
    ////
    //$('#DashFlag').load("Handlers/Common-Values.ashx?Vs=DashFlag");
    //dashFlag();
//    ////
//    $('#RefLink').html('<img src="../UserProfileImg/loading2.gif" />');
//    $('#RefLink').load("Handlers/Common-Values.ashx?Vs=RefLink");
//    ////
//    $('#WithList').html('<img src="../UserProfileImg/loading2.gif" />');
//    $('#WithList').load("Handlers/Common-Values.ashx?Vs=WithList"); 
//    ////
//    $('#OnlineUsr').html('<img src="../UserProfileImg/loading2.gif" />');
//    $('#OnlineUsr').load("Handlers/Common-Values.ashx?Vs=OnlineUsr");  
//    ////
//    $('#ActDrcts').html('<img src="../UserProfileImg/loading2.gif" />');
//    $('#ActDrcts').load("Handlers/Common-Values.ashx?Vs=ActDrcts");    
//    ////
//    $('#DepostHtry').html('<img src="../UserProfileImg/loading2.gif" />');
//    $('#DepostHtry').load("Handlers/Common-Values.ashx?Vs=DepostHtry");
//    //// 
//    $('#DownlineDeposit').html('<img src="../UserProfileImg/loading2.gif" />');
    //    $('#DownlineDeposit').load("Handlers/Common-Values.ashx?Vs=DownlineDepost");

             
});

// function amazingpool(poolno) {

//     $('#Our-Team').html("<img src='../images/ajax-loader.gif'/>").load("Handlers/Common-Values.ashx?Vs=OurTeam&pol=" + poolno);
//     
// }

/////////

/////////
function Save_data() {    
    ////////
   
    
     //$('#Msgs').html('<img src="../UserProfileImg/loading2.gif" />');
     var od = new FormData();
    var txtbanner=$('#txtbanner').val();
    var txtintersitial= $("#txtintersitial").val();//$("#txtTxnHas").val(); 
    var txtrewrded= $("#txtrewrded").val();
    
    ////////
    od.append("txtbanner", txtbanner);
    od.append("txtintersitial", txtintersitial);
    od.append("txtrewrded", txtrewrded);
    
    
    ///////
        $.ajax({
            url: "Handlers/Add-Unit-Ref.ashx",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                   $('#Msgs').html(Response.Message);
                    
//                    swal({
//                    title: "Congratulation!",
//                    text: Response.Message,
//                    type: "success"
//                    });
                    
                    $("#myModal .close").click()
                }
                else {
                    $('#Msgs').html(Response.Message);
                    
//                    swal({
//                    title: "Ooops!",
//                    text: Response.Message,
//                    type: "error"
//                    });
                    
                     //$("#myModal .close").click()
                }
            },
            error: function (err) {
                $('#Msgs').html(err.statusText);
//                swal({
//                    title: "Ooops!",
//                    text: err.statusText,
//                    type: "error"
//                    });
            }
        });
}


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
/*section load details*/
function formatOrder(tst) {
    var pp1l='';    
    for (var i = 0; i < tst.length; i++) {   
    
        pp1l=pp1l+"<a class='dropdown-item' href='#'><i class='flag-icon flag-icon-"+ tst[i].Code+"'></i> "+tst[i].Country+"</a>";
       
    }
    $('#DashFlag').html('');
    return pp1l;
}
//////
function DashboardSummary() {

//alert (isoCountries["Albania"]);

        $.getJSON('Handlers/Dashboard-Summary.ashx',
        
        function (OrjsonDS) {
            if (OrjsonDS.length == 0) {   
            }
            else {
                 var wa='';
                for (var i = 0; i < OrjsonDS.length; i++) {       
                ///// for Dashboard details...
//                
//                    if(OrjsonDS[i].PendingACTAMT <= 0)
//                    {
//                      window.location.href= '../Account-activation.html';
//                    }
//                    else
//                    {

                    //$('#CrntPlNo').html(OrjsonDS[i].CrntPlNo);

                    $('#TotPoolInc').html(OrjsonDS[i].TotPoolInc);
                    $('#CrntPlNo').html(OrjsonDS[i].CrntPlNo);
                    $('#PlStatus').html(OrjsonDS[i].PlStatus  +  ' !');
                    $('#CrntPlInc').html(OrjsonDS[i].CrntPlInc);
                    $('#CrntReqIDs').html(OrjsonDS[i].CrntReqIDs);
                    $('#CrntPlIDs').html(OrjsonDS[i].CrntPlIDs);
                    $('#RnGlPID').html(OrjsonDS[i].RnGlPID);
                    $('#YrGlPlID').html(OrjsonDS[i].YrGlPlID);

///////////////////////new-section////////////////////////
$('#dir_income').html('Rs. ' + OrjsonDS[i].DrctInc);
$('#R_Bouns').html('Rs. '+ OrjsonDS[i].RnkBonus);
$('#pro_income').html('Rs. ' + OrjsonDS[i].PerfrmBonus);
$('#Ro_yolti').html(' ' + OrjsonDS[i].RyltyBonus);
$('#Yo_dir').html('' + OrjsonDS[i].TOTAL_REFERRALS);
$('#las_wid').html('' + OrjsonDS[i].Last_Withdrawal);
$('#last_down').html('' + OrjsonDS[i].LastWithdrawalOn);
///////////////////////new-section////////////////////////


                    $('#Mem_Name').html(OrjsonDS[i].MemName);          
                    $('#email1').html(OrjsonDS[i].email);
                    
                    $('#Mem_Name1').html(OrjsonDS[i].MemName);
                    $('#email11').html(OrjsonDS[i].email);
                    $('#MName').html(OrjsonDS[i].MemName);
                    $('#EmailAdd').html(OrjsonDS[i].email);
                    
                    $('#profJoin').html("You have join system on - "+OrjsonDS[i].Sign_UpOn+" & Actived on : "+OrjsonDS[i].Actived_On);
                    $('#drank').html(OrjsonDS[i].DRank);   
                    
                    $('#DOJ').html('<b>Doj : </b>'+OrjsonDS[i].Sign_UpOn);
                    $('#Actived_On1').html('<b>Act. On : </b>' + OrjsonDS[i].Actived_On);

                    $('#TOTALROI').html(OrjsonDS[i].EAR);
                    $('#withLimit').html(OrjsonDS[i].withLimit);
                    if(OrjsonDS[i].ustaus =="GREEN"){  
                     //$('#ustaus').html("<button type='button' class='btn btn-success'>Active</button>");  
                      $('#ustaus').html("<a href='#' title='' style=' background: #4caf50 none repeat scroll 0 0;color: #fff; -webkit-border-radius: 5px; -moz-border-radius: 5px; -ms-border-radius: 5px; -o-border-radius: 5px; border-radius: 5px; font-family: Open Sans; font-size: 12px; margin: 0 auto;padding: 12px 27px;text-transform: uppercase;'>Active</a>");  
                     }
                     else
                     {
                      $('#ustaus').html("<a href='#' title='' style=' background: #ff6b6b none repeat scroll 0 0;color: #fff; -webkit-border-radius: 5px; -moz-border-radius: 5px; -ms-border-radius: 5px; -o-border-radius: 5px; border-radius: 5px; font-family: Open Sans; font-size: 12px; margin: 0 auto;padding: 12px 27px;text-transform: uppercase;'>In Active</a>");  
                     
                     }
                                                       
                    ///
                    $('#MemID').html(OrjsonDS[i].MemID);
                    $('#MemID1').html(OrjsonDS[i].Mem_Name.toUpperCase());
                     $('#mname1').html("ID : "+OrjsonDS[i].MemID);
                    $('#mobileno').html("Mobile : "+OrjsonDS[i].Mobile);
                    
                       $('#LastAccess').html(" : "+OrjsonDS[i].LastAccess);
                    
                    ///                     
                          if(OrjsonDS[i].withLimit =="Member"){
                        
                        }
                        else
                     {
                     $('#rank_tem').html("<img  width='110' class='img-circle' src='../UserProfileImg/" + OrjsonDS[i].withLimit + "-1.png' alt='Rank'/>");  
                         }
                      $('#prof_pic').html("<img  width='72' class='img-circle' src='../" + OrjsonDS[i].Mem_Profl_Pic + "' alt='user'/>");
                      
                       if(OrjsonDS[i].withLimit =="Member"){
                        
                        }
                        else
                     {
                     $('#mem_rank').html("<img  width='110' class='img-circle' src='../UserProfileImg/" + OrjsonDS[i].withLimit + ".png' alt='Rank'/>");  
                         }
                    $('#Mem_Profl_Pic').html("<img width='44' height='44' src='../" + OrjsonDS[i].Mem_Profl_Pic + "' alt='user'/>");
                    $('#Mem_Profl_Pic1').html("<img width='44' height='44' src='../" + OrjsonDS[i].Mem_Profl_Pic + "' alt='user'/>"); 
                    
                    ///
                    $('#TotWithdrawal').html('Rs. ' + OrjsonDS[i].Withdrawal_Total);
                    $('#LastWithdrawal').html('Last Withdrawal on: '+OrjsonDS[i].LastWithdrawalOn);
                    $('#TOTAL_DEPOSIT').html('Rs. ' + OrjsonDS[i].TOTAL_DEPOSIT);
                    $('#UnConfirmedBns').html('Rs. ' + OrjsonDS[i].UnConfirmedBns);
                    $('#RwalletBal').html('Rs. ' + OrjsonDS[i].VWalletBal);
                     
                     
                    $('#ConfirmedBns').text('Rs. ' + OrjsonDS[i].ConfirmedBns);
                     
                    
                    
                    $('#cWalletBal').html('Rs. ' + OrjsonDS[i].cWalletBal);
                     $('#Actived_On').html('Last Deposit on: '+OrjsonDS[i].LastDepositOn); 
                     $('#TBTotBal').html(OrjsonDS[i].BinaryBonus); 
                     
                     $('#ReferralsBonus').html('Rs. ' + OrjsonDS[i].LevelBonus);
                     $('#LevelBonus').html('Rs. ' + OrjsonDS[i].LevelBonus);
                     $('#TodayLevelBonus').html('Today : Rs. ' + OrjsonDS[i].TodayLevelBonus);
                     $('#TodayROI').html('Today : Rs. ' + OrjsonDS[i].TodayROI);
                     $('#TotTeam').html(OrjsonDS[i].TotTeam);
                     $('#TotTeam1').html(OrjsonDS[i].TotTeam1);

                     $('#MemSts').html(OrjsonDS[i].MemSts);

                     $('#Totbussiness').html('Rs. ' + OrjsonDS[i].TotTmTp1);
                     
                     $('#TOTAL_REFERRALS').html(OrjsonDS[i].TOTAL_REFERRALS);
                     //$('#Rollups').html(OrjsonDS[i].Rollups); 
                     //$('#email').html(OrjsonDS[i].email);
                     $('#email').html(OrjsonDS[i].MemID);
                    
                    $('#ChartAct').html(OrjsonDS[i].TOTACT);
                    $('#ChartInAct').html(OrjsonDS[i].TOTINACT);
                    $('#ChartBlock').html(OrjsonDS[i].TOTBLOCK);
                    
                    $('#txtbanner').val(OrjsonDS[i].Banner);
                    $('#txtintersitial').val(OrjsonDS[i].Intersitial);
                    $('#txtrewrded').val(OrjsonDS[i].Rewarded);
                    $('#footertext').html(OrjsonDS[i].CompanyName);

                    $('#IWallBal').html('Rs. ' + OrjsonDS[i].IWallBal);
                    //////////////////////////////  haan ye uske liye h     /////////////////////////
//                    if (OrjsonDS[i].Reward == 0) {
//                        $('#diamond').html("<li><a  ><img src='assets/img/gray-diamond.png' data-toggle='tooltip' data-placement='left'  title='Rank-Name: Diamond' /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Black Diamond'><img src='assets/img/gray-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Purple Diamond'><img src='assets/img/gray-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Pink Diamond'><img src='assets/img/gray-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Red Diamond'><img src='assets/img/gray-diamond.png'  /></a></li>");
//                    }
//                    else if (OrjsonDS[i].Reward == 1) {
//                        $('#diamond').html("<li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Diamond'><img src='assets/img/green-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Black Diamond'><img src='assets/img/gray-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Purple Diamond'><img src='assets/img/gray-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Pink Diamond'><img src='assets/img/gray-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Red Diamond'><img src='assets/img/gray-diamond.png'  /></a></li>");
//                    }
//                    else if (OrjsonDS[i].Reward == 2) {
//                        $('#diamond').html("<li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Diamond'><img src='assets/img/green-diamond.png'  /></a></li> <li><a  data-toggle='tooltip' data-placement='bottom' title='Rank-Name: Black Diamond'><img src='assets/img/black-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Purple Diamond'><img src='assets/img/gray-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Pink Diamond'><img src='assets/img/gray-diamond.png'  /></a></li> <li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Red Diamond'><img src='assets/img/gray-diamond.png'  /></a></li>");
//                    }
//                    else if (OrjsonDS[i].Reward == 3) {
//                        $('#diamond').html("<li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Diamond'><img src='assets/img/green-diamond.png'  /></a></li> <li><a  data-toggle='tooltip' data-placement='bottom' title='Rank-Name: Black Diamond'><img src='assets/img/black-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='bottom' title='Rank-Name: Purple Diamond'><img src='assets/img/purple-diamond.png' /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Pink Diamond'><img src='assets/img/gray-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Red Diamond'><img src='assets/img/gray-diamond.png'  /></a></li>");
//                    }
//                    else if (OrjsonDS[i].Reward == 4) {
//                        $('#diamond').html("<li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Diamond'><img src='assets/img/green-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='bottom' title='Rank-Name: Black Diamond'><img src='assets/img/black-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='bottom' title='Rank-Name: Purple Diamond'><img src='assets/img/purple-diamond.png' /></a></li><li><a data-toggle='tooltip' data-placement='bottom'  title='Rank-Name: Pink-Diamond'><img src='assets/img/pink-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Red Diamond'><img src='assets/img/gray-diamond.png'  /></a></li>");
//                    }
//                    else if (OrjsonDS[i].Reward == 5) {
//                        $('#diamond').html("<li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Diamond'><img src='assets/img/green-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='bottom' title='Rank-Name: Black Diamond'><img src='assets/img/black-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='bottom' title='Rank-Name: Purple Diamond'><img src='assets/img/purple-diamond.png' /></a></li><li><a  data-toggle='tooltip' data-placement='bottom'  title='Rank-Name: Pink-Diamond'><img src='assets/img/pink-diamond.png'  /></a></li><li><a  data-toggle='tooltip' data-placement='left'  title='Rank-Name: Red Diamond'><img src='assets/img/red-diamond.png' /></a></li>");
//                    }

                    //////////////////////////////  haan ye uske liye h     /////////////////////////
                     if(OrjsonDS[i].AWalletBal <= 0)
                     {
                         $('#LastDeposit11').html(' <span class="red-skin"><i class="fa fa-area-chart"></i></span><p><i class="fa  fa-arrow-down down"></i> Cresta Wallet Balance  </p><h3 >Rs. '+OrjsonDS[i].AWalletBal+'</h3>');                  
//                     <div class='alert alert-danger m-b-10'><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>
                     }
                     else
                     {
                         $('#LastDeposit11').html(' <span class="red-skin"><i class="fa fa-area-chart"></i></span><p><i class="fa  fa-arrow-up up"></i>Cresta Wallet Balance</p><h3 >Rs. ' + OrjsonDS[i].AWalletBal + '</h3>');
                     }
                     
                     if(OrjsonDS[i].BWalletBal <= 0)
                     {
                         $('#Last_Withdrawal').html(' <span class="sky-skin"><i class="fa fa-usd"></i></span><p><i class="fa  fa-arrow-down down"></i>Crypto Wallet Balance</p><h3 >Rs. ' + OrjsonDS[i].BWalletBal + '</h3>');
//                     <div class='alert alert-success m-b-10'><strong>Well done!</strong> You successfully read this important alert message.</div>
                     }
                     else
                     {
                         $('#Last_Withdrawal').html(' <span class="sky-skin"><i class="fa fa-usd"></i></span><p><i class="fa  fa-arrow-up up"></i>Crypto Wallet Balance</p><h3 >Rs. ' + OrjsonDS[i].BWalletBal + '</h3>');
                     }
                    
                     if(OrjsonDS[i].TOTAL_DEPOSIT == 0)
                     {
                       $('#TOPUPMSG').html('<div class="alert red-skin alert-rounded"><img src="images/close-button.png"width="25" heigth="25"  alt="">'+OrjsonDS[i].TopUpnNoTFMSG+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden "true">x</span> </button>  </div></div></div>');
                     }
                     else
                     {
                       $('#TOPUPMSG').html('<div class="alert  red-skin1 alert-rounded"><img src="images/resource/check.png" width="25" heigth="25" alt="">'+OrjsonDS[i].TopUpnNoTFMSG+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">x</span> </button> </div>');
                     }
                   
                     
                   
                   
                     $('#MAR').html('Rs. ' + OrjsonDS[i].cWalletBal);
                     $('#EAR').html('Rs. ' + OrjsonDS[i].EAR);
                     $('#DED').html('Rs. ' + OrjsonDS[i].DED);
                     $('#RSC').html('Rs. ' + OrjsonDS[i].RSC);
                    
                    $('#RSCt').html('Today : Rs. '+OrjsonDS[i].TodayRSC);
                    $('#MARt').html('Today : Rs. ' + OrjsonDS[i].TodayMAR);
                    $('#EARt').html('Today : Rs. ' + OrjsonDS[i].TodayEAR);
                    $('#DEDt').html('Today : Rs. ' + OrjsonDS[i].TodayDED);
                    ///////////////////////
                  
                    $('#totalwalletbalace').html('Rs. ' + OrjsonDS[i].totalwalletbalace);
                    
                    
                    
                     
                     if(OrjsonDS[i].PaymentAccount>0)
                     {
                     $('#DepCnt1').addClass('passed progress-widget__circle');
                       $('#PmAcnt').addClass('ti-check passed progress-widget__circle');
                       $('#PmAcnt').text('');
                     }
                     
                     if(OrjsonDS[i].KycCnt>0)
                     {
                     $('#DepCnt2').addClass('passed progress-widget__circle');
                       $('#KycCnt').addClass('ti-check passed progress-widget__circle');
                        $('#KycCnt').text('');
                     }
                     
                     if(OrjsonDS[i].TOTAL_DEPOSIT>0)
                     {
                      $('#DepCnt3').addClass('passed progress-widget__circle');
                       $('#DepCnt').addClass('ti-check passed progress-widget__circle');
                        $('#DepCnt').text('');
                     }
                     
                         if(OrjsonDS[i].newsgreenmemid >0)
                     {
                         if(OrjsonDS[i].newscount >0)
                         {
                           var modal = document.getElementById('myModal1');
                           modal.style.display = "block";
                          $('#news_list_dynemic').load('Handlers/GetPopupNews.ashx'); 
                         
                         }
                     }
                     
                     
                     
                    
                    }                   
                //}               
            }
        }); 
    }
    /////////
    




    function Save_link() {    
     //$('#Msgs').html('<img src="../UserProfileImg/loading2.gif" />');
     var od = new FormData();
    var txtLinkName=$('#txtLinkName').val();
    var txtLinkurl= $("#txtLinkurl").val();
   
    var re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
        if (!re.test(txtLinkurl)) { 
             swal({
                    title: "Ooops!",
                    text: "please enter valid link",
                    type: "error"
                    });
            return false;
        }
   
    od.append("txtLinkName", txtLinkName);
    od.append("txtLinkurl", txtLinkurl);
   
        $.ajax({
            url: "Handlers/Add-Ref-Link.ashx",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                    swal({
                    title: "Congratulation!",
                    text: Response.Message,
                    type: "success"
                    });
                    $("#txtLinkurl").val('');
                    $("#rfLinkmodel .close").click()
                }
                else {
                    swal({
                    title: "Ooops!",
                    text: Response.Message,
                    type: "error"
                    });
                }
            },
            error: function (err) {
                swal({
                    title: "Ooops!",
                    text: err.statusText,
                    type: "error"
                    });
            }
        }); 
}
/////////