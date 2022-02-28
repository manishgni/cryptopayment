var totRcds='';

function SearchDownline()
{
 $('#sbar').show();
//$("#txtTopUpAmount").val();  
var PgSz =$("#PageSize").val();
var Pgno =$("#PageNo").val();
var Fromdt =$("#datepickerFrom").val();
var Todt =$("#datepickerTo").val();
var SearchTxt =$("#SearchTxt").val();
var sts = $("#ddlStatus").val();
var Pos =  $("#ddlPos").val();
var lvl =  $("#ddllvl").val();
loadOrders(Pgno,PgSz,SearchTxt,Fromdt,Todt,sts,Pos,lvl);
}



function ChangePagesize()
{
 getpageno();
var PgSz =$("#PageSize").val();
var Pgno =$("#PageNo").val();
var Fromdt =$("#datepickerFrom").val();
var Todt =$("#datepickerTo").val();
var SearchTxt =$("#SearchTxt").val();   
var sts = $("#ddlStatus").val();
var Pos =  $("#ddlPos").val();
var lvl =  $("#ddllvl").val();
loadOrders(Pgno,PgSz,SearchTxt,Fromdt,Todt,sts,Pos,lvl);
}

function ChangeNo()
{
 //getpageno();
var PgSz =$("#PageSize").val();
var Pgno =$("#PageNo").val();
var Fromdt =$("#datepickerFrom").val();
var Todt =$("#datepickerTo").val();
var SearchTxt =$("#SearchTxt").val();  // document.getElementById('SearchTxt');
var sts = $("#ddlStatus").val();
var Pos =  $("#ddlPos").val();
var lvl =  $("#ddllvl").val();
loadOrders(Pgno,PgSz,SearchTxt,Fromdt,Todt,sts,Pos,lvl);
}

function SelectSts()
{
 //getpageno();
  var rf = $('#ddlStatus').val();
       if (rf == "Active") {
           $('#rfnm').html('<i style="font-size: 13px;">Total Active : </i>');
           $('#ACTIVE_REFERAL').html($('#actrf').val());
       }
       if (rf == "In-Active") {
           $('#rfnm').html('<i style="font-size: 13px;">Total In-Active: </i>');
           $('#ACTIVE_REFERAL').html($('#inctrf').val());
       }
       if (rf == "Block") {
           $('#rfnm').html('<i style="font-size: 13px;">Total Block: </i>');
           $('#ACTIVE_REFERAL').html($('#blrf').val());
       }
var PgSz =$("#PageSize").val();
var Pgno =$("#PageNo").val();
var Fromdt =$("#datepickerFrom").val();
var Todt =$("#datepickerTo").val();
var SearchTxt =$("#SearchTxt").val();  // document.getElementById('SearchTxt');
var sts = $("#ddlStatus").val();
var Pos =  $("#ddlPos").val();
var lvl =  $("#ddllvl").val();

loadOrders(Pgno,PgSz,SearchTxt,Fromdt,Todt,sts,Pos,lvl);
}

function SelectPos()
{
 //getpageno();
var PgSz =$("#PageSize").val();
var Pgno =$("#PageNo").val();
var Fromdt =$("#datepickerFrom").val();
var Todt =$("#datepickerTo").val();
var SearchTxt =$("#SearchTxt").val();  // document.getElementById('SearchTxt');
var sts = $("#ddlStatus").val();
var Pos =  $("#ddlPos").val();
var lvl =  $("#ddllvl").val();
loadOrders(Pgno,PgSz,SearchTxt,Fromdt,Todt,sts,Pos,lvl);
}


function SrchLvl()
{
 //getpageno();
var PgSz =$("#PageSize").val();
var Pgno =$("#PageNo").val();
var Fromdt =$("#datepickerFrom").val();
var Todt =$("#datepickerTo").val();
var SearchTxt =$("#SearchTxt").val();  // document.getElementById('SearchTxt');
var sts = $("#ddlStatus").val();
var Pos =  $("#ddlPos").val();
var lvl =  $("#ddllvl").val();
loadOrders(Pgno,PgSz,SearchTxt,Fromdt,Todt,sts,Pos,lvl);
}


 
 

function getpageno()
{
    ////
    var TTR=Number(totRcds);
    var ttP=TTR/Number($("#PageSize").val());
    ////
    if (ttP>Math.floor(ttP))
    {
    var ttP=ttP+1;
    }
    /////
    var selectField = $("#PageNo");    
    var options = '';
    selectField.empty();
    ///
    for ( var j = 1;j <= ttP; j++) {
    ////
        if (j==1)
        {
        options += '<option value="1">No</option>';
        }
        else
        {
        options += '<option value="' + j + '">' + j + '</option>';
        }
    }
    selectField.append(options);  
    ////
}


function loadOrders(PageIndex, PageSize,MemID,Fromdt,Todt,sts,Pos,lvl) {
  
    $('#ReffList').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
   
          $.getJSON('Handlers/My-Referrals.ashx?p=' + PageIndex + "&s=" + PageSize + "&u="+MemID+ "&frdt="+Fromdt+ "&todt="+Todt+ "&sts="+sts+ "&Pos="+Pos+ "&lvl="+lvl,
        function (Orjson) {
            if (Orjson.length == 0) {    
             $('#ReffList').html('');
             $('#ReffList').html("<div class='search-sec-1' style='    box-shadow: none;'><div class='alert alert-danger m-b-10'><strong>Sorry!</strong> record not found...! </div></div> ");
          }
            else {
                var d = formatOrder(Orjson);
                $('#ReffList').html(d);                
            }
        });  
}
/*section load details*/
function formatOrder(Orjson) {
    var pp1='';
   // pp1=pp1+"<ul>";
    for (var i = 0; i < Orjson.length; i++) {
    
     $('#TotRec').html(Orjson[i].TotalRec);  
       totRcds=Orjson[i].TotalRec;
       getpageno();

 ////////start dream21///////
                pp1=pp1+" <div class='search-sec-1' >";
                pp1 = pp1 + "<div class='user-img'><span class='number'>" + Orjson[i].srno + "</span>";
                pp1 = pp1 + " <img src='" + Orjson[i].MemProfilePic + "' />";
                pp1=pp1+" </div>";
                pp1=pp1+" <div class='search-sec-2'>";
                pp1=pp1+" <div class='row'>";
                pp1 = pp1 + " <div class='col-md-2 col-sm-1 col-lg-1'>";
                pp1=pp1+" <div class='sec-left'>";
                pp1=pp1+" <div class=' position'>";
                pp1 = pp1 + " <span>" + Orjson[i].Position + "</span><br />";
                pp1=pp1+" <label>Position</label>";
                pp1=pp1+" </div>";
                pp1=pp1+"  <div class=' position'>";
                pp1 = pp1 + "  <span>" + Orjson[i].LvlNo + "</span><br />";
                pp1=pp1+"  <label>Level</label>";
                pp1=pp1+"  </div>";
                pp1=pp1+"  </div>";
                pp1=pp1+"   </div>";
                pp1 = pp1 + "  <div class='col-md-7 col-sm-8 col-lg-8'>";
                pp1=pp1+"  <div class='sec-center'>";
                pp1 = pp1 + "  <div class='name'>";
                
                if (Orjson[i].Status == 'In-Active')
                     {
                     pp1=pp1+""+ Orjson[i].NAME+"";
                     }
                     if(Orjson[i].Status == 'Active')
                     {
                    pp1=pp1+""+ Orjson[i].NAME+"";
                     }
                     if(Orjson[i].Status == 'block')
                     {
                     pp1=pp1+""+ Orjson[i].NAME+"";
                     }
                 if(Orjson[i].Designation =="Member"){
                        
                 }
                  else
                  {
                pp1 = pp1 + " <span class='star-line'> ";
                pp1 = pp1 + "  <img  width='110' src='../UserProfileImg/" + Orjson[i].Designation + "-2.png' alt='Rank'/> ";
                pp1 = pp1 + " </span>";
              }
                pp1=pp1+"   <br />";
                pp1 = pp1 + "  <span><i class='ti-email text-warning f-s-13 m-r-5'></i>" + Orjson[i].email + "   </span> <span><span style='color:#FF9500;'> ID. </span>" + Orjson[i].ReferrID + "   </span></div>";
               // pp1 = pp1 + "     <span style='color: #00877e;    font-weight: bolder;    font-size: 14px;'> " + Orjson[i].ReferrID + "</span> ";
                pp1 = pp1 + "  <div class='country'><img src='" + Orjson[i].CountryPATH + "' /> <span>" + Orjson[i].Country + "</span></div>";
                pp1=pp1+"   <div class='other-detail'>";
                pp1=pp1+"   <ul>";
                pp1 = pp1 + "<li> <span><i class='ti-mobile text-warning f-s-13 m-r-5'></i>";
                pp1 = pp1 + "Mobile No:<i class='fa fa-mobile' style='font-size: 17px;font-weight: 600;'></i><b>" + Orjson[i].Mobile + "</b> </span></li>";
                pp1 = pp1 + "<li> <span>Member since:<i class='fa fa-mobile' style='font-size: 17px;font-weight: 600;'></i><b>" + Orjson[i].SignupOn + "</b> </span></li>";
                pp1 = pp1 + "<li>  <span>Actived-On:<i class='fa fa-mobile' style='font-size: 17px;font-weight: 600;'></i><b>" + Orjson[i].ActivedOn + "</b> </span></li>";
                pp1=pp1+"</ul>";
                pp1=pp1+"<ul>";
                
                pp1 = pp1 + "<li> <span>Rank:<i class='fa fa-mobile' style='font-size: 17px;font-weight: 600;'></i><b class='text-danger' style='font-size: 16px;'>" + Orjson[i].Drank + "</b> </span></li>";
                pp1=pp1+"       </ul>";
                pp1=pp1+"      </div>";         
                pp1=pp1+"     </div>";
                pp1=pp1+"     </div>";
                pp1=pp1+"     <div class='col-md-3'>";
                pp1=pp1+"     <div class='sec-right'>";               
                pp1=pp1+"   <div class=' position'>";
                pp1 = pp1 + "  <span>" + Orjson[i].BuyProducts + "<span style='vertical-align: super;font-size: 12px;color: red;'>INR</span></span><br />";
                pp1=pp1+"  <label>Package Amt.</label>";
                pp1=pp1+"  </div>";
                pp1=pp1+"   <div class=' starus'>";
//                pp1 = pp1 + "   <span>Active</span>     ";
                if (Orjson[i].Status == 'In-Active')
                     {
                         pp1 = pp1 + "<span class='btn-primary'>In-Active</span>";
                     }
                     if(Orjson[i].Status == 'Active')
                     {
                         pp1 = pp1 + "<span class='btn-success'>Active</span>";
                     }
                     if(Orjson[i].Status == 'block')
                     {
                         pp1 = pp1 + "<span class='btn-danger'>Block</span>";
                     }
                pp1=pp1+"   </div>";
                pp1=pp1+"   </div>";
                pp1=pp1+"   </div>";
                pp1=pp1+" </div>";
                pp1=pp1+"  </div> ";
                pp1 = pp1 + "  </div>";




                $('#ReffList').html('');
    ////
    }
   // pp1=pp1+"</ul>";
    return pp1;
}





  