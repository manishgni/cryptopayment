////////////
//$(document).ready(function () {
//GetTicketList();
//GetTicketDetails('');
//});
//////




function saveUser() {
$('#topicId').val('');
$('#EmailAddress').val('');
//$('#Msg').html('<img src="../UserProfileImg/loading2.gif" width="50" height="50" alt="Loading..." />');
$('#Msg').load("Handlers/Save-ticket.ashx");
}
/////
function GetTicketList() {
    $('#ticket_list').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
$('#ticket_list').load("Handlers/GetTicketList.ashx");
}
////
function GetTicketDetails(ticketno) {

    $('#ticket_viewIn').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
 $('#ticket_viewIn').load("Handlers/GetTicketDetails.ashx?orderId=" + ticketno);
 //////
}


var tktid = "";
function clk(id) {
  
    $('.product-list').on('change', function () {
        $('.product-list').not(this).prop('checked', false);

    });

    $('.product-list').click(function () {

        $(this).siblings('input:checkbox').prop('checked', false);
    });
    tktid = id;
    //alert(tktid);
}


function DeleteTitcketrin() {
    //var od = new FormData();
    $('#Msgs').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');

    if (tktid == "" || tktid == null || tktid == "undefined") {
//        $('#toast-container').show();
//        $('#toast-container').html("<div class='toast-success'  ><a href='#'  style='color:#fff;' onclick='hided()' class='toast-close-button' >×</a>Please select Ticket!!!</div>");
              $('#Msgs').html("<div class='alert alert-danger m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-alert f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>Please select Ticket!!!</p></div>");
}
    else {

        var ticketno = tktid; //$("#tno").val();
        $.ajax({
            url: "Handlers/Delete-Ticket.ashx?dltord=" + ticketno,
            type: "POST",
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                    //                    alert(Response.Message);
                    //                    window.location.href = 'Inbox-mail.html';
                    $('#Msgs').html("<div class='alert alert-success m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-face-smile f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + Response.Message + "</p></div>");

                    window.location.href = 'email_inbox.html';
                }
                else {

                   $('#Msgs').html("<div class='alert alert-danger m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-alert f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + Response.Message + "</p></div>");

                }
            },
            error: function (err) {

                $('#Msgs').html("<div class='alert alert-danger m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-alert f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + err.statusText + "</p></div>");

// $('#toast-container').html("<div class='toast-error'  ><a href='#'  style='color:#fff;' onclick='hided()' class='toast-close-button' >×</a>" + err.statusText + "</div>");

            }
        });
    }
}





function DeleteTitcketr(tno) {
 //var od = new FormData();
    $('#Msgs').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
 var ticketno = tno;//$("#tno").val();
        $.ajax({
            url: "Handlers/Delete-Ticket.ashx?dltord=" + ticketno,
            type: "POST",
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
//                    alert(Response.Message);
//                    window.location.href = 'Inbox-mail.html';
                $('#Msgs').html("<div class='alert alert-success m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-face-smile f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + Response.Message + "</p></div>");

                window.location.href = 'email_inbox.html';
                }
                else {
                  $('#Msgs').html("<div class='alert alert-danger m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-alert f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + Response.Message + "</p></div>");

                }
            },
            error: function (err) {
              $('#Msgs').html("<div class='alert alert-danger m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-alert f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + err.statusText + "</p></div>");

//                $('#toast-container').html("<div class='toast-error'  ><a href='#'  style='color:#fff;' onclick='hided()' class='toast-close-button' >×</a>" + err.statusText + "</div>");
          
            }
        });
}


function placeGiveHelpOrder() {

    $('#Msgs').html('<img src="../UserProfileImg/103.gif" width="35" height="35"  />');
    ////
     
    var od = new FormData();
    ////
    var fileUpload = $("#msgFile").get(0);
    var files = fileUpload.files;
    for (var i = 0; i < files.length; i++) {
    od.append(files[i].name, files[i]);
    }
    ////////   
    var topicId = $("#topicId").val();
    var IssueSummary= $("#IssueSummary").val();
    var IssueDetails = $(".note-editable").html(); //$("#IssueDetails").val();
   
    
//     var result = IssueDetails.replace(/(<span[^>]+?>|<span style='background-color: rgb(245, 245, 245); font-size: 15px; text-align: center;'>|<\/span>)/img, "");
//     var result1 = result.replace(/(<span[^>]+?>|<span style='color: rgb(98, 98, 98); font-family: Roboto, serif; font-size: 16px;'>|<\/span>)/img, "");
    var result2 = IssueDetails.replace(/(<p[^>]+?>|<p>|<br>|<\/p>)/img, "");
    
    //note-codable
    ////
    od.append("topicId", topicId);  
    od.append("IssueSummary", IssueSummary);
    od.append("IssueDetails", result2);
    
    ////
        $.ajax({
            url: "Handlers/Save-ticket.ashx",
            type: "POST",
            contentType: false,
            processData: false,
            data: od,
            dataType: "json",
            success: function (Response) {
                if (Response.Success) {
                    $('#Msgs').html(Response.Message);  
                    //alert( Response.Message); 
                 
                    $('#Msgs').html("<div class='alert alert-success m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-face-smile f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + Response.Message + "</p></div>");

//                    $('#toast-container').show();
//                    $('#toast-container').html("<div class='toast-success'  ><a href='#'  style='color:#fff;' onclick='hided()' class='toast-close-button' >×</a>" + Response.Message + "</div>");

                    window.location.href = 'email_inbox.html';
                }
                else {
//                    $('#Msgs').html(Response.Message);
//                    $('#toast-container').show();
//                    $('#toast-container').html("<div class='toast-error'  ><a href='#'  style='color:#fff;' onclick='hided()' class='toast-close-button' >×</a>" + Response.Message + "</div>");
//                
            $('#Msgs').html("<div class='alert alert-danger m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-alert f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + Response.Message + "</p></div>");
}
            },
            error: function (err) {
//            $('#Msgs').html(err.statusText); 
                    $('#Msgs').html("<div class='alert alert-danger m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-alert f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + err.statusText + "</p></div>");
}
        });
     ////
}
function ticketsaddMessage() {
    var fileUpload = $("#msgFile").get(0);
    var files = fileUpload.files;
    var test = new FormData();
    for (var i = 0; i < files.length; i++) {
        test.append(files[i].name, files[i]);
    }
    if (message == '') {

    }
   // var message = $("#messageInput").val();
    var message = $(".note-editable").html(); //$("#IssueDetails").val();
   // var result = message.replace(/(span style="background-color: rgb(245, 245, 245);"[^>]+?>|<span>|<br>|<\/span>)/img, "");

    var result = message.replace(/(<span[^>]+?>|<span style='background-color: rgb(245, 245, 245); font-size: 15px; text-align: center;'>|<\/span>)/img, "");
   // var result1 = result.replace(/(<  <span style='color: rgb(98, 98, 98); font-family: Roboto, serif; font-size: 16px;'[^>]+?>|<span>|<\/span>)/img, "");

    //var result2 = result1;
    var id = $("#tno").val();
    

    test.append("message", result);
    test.append("OrderId", id);
    
    $.ajax({
        url: "Handlers/Reply-Ticket.ashx",
        type: "POST",
        contentType: false,
        processData: false,
        data: test,
        dataType: "json",
        success: function (Response) {
            if (Response.Success) {

                //                $('#toast-container').show();
                //                $('#toast-container').html("<div class='toast-success'  ><a href='#'  style='color:#fff;' onclick='hided()' class='toast-close-button' >×</a>" + Response.Message + "</div>");

                $('#Msgs').html("<div class='alert alert-success m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-face-smile f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + Response.Message + "</p></div>");


                $("#messageInput").val('');
                parent.location.reload(true);
            }
            else {

                $('#Msgs').html("<div class='alert alert-danger m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-alert f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + Response.Message + "</p></div>");
//                $('#toast-container').show();
//                $('#toast-container').html("<div class='toast-error'  ><a href='#'  style='color:#fff;' onclick='hided()' class='toast-close-button' >×</a>" + Response.Message + "</div>");
            }
        },
        error: function (err) {
           
            $('#Msgs').html("<div class='alert alert-danger m-b-0 '><span class='close m-b-0' data-dismiss='alert' style='color: red; top: 3px; position: absolute;right: 11px;'>×</span><i class='ti-alert f-s-20 pull-left m-r-10 '></i><p class='m-b-0'>" + err.statusText + "</p></div>");
//            $('#toast-container').show();
//            $('#toast-container').html("<div class='toast-error'  ><a href='#'  style='color:#fff;' onclick='hided()' class='toast-close-button' >×</a>" + err.statusText + "</div>");
        }
    });
}

function RefLoad() {
    parent.location.reload(true);
}


function hided() {
    $('#toast-container').hide();
}

var loadFile = function (event) {

    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('output');
        output.style.display = "block";
        var removeimg = document.getElementById('removeimg');
        removeimg.style.display = "block";


        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};
function removeimg() {
    var output = document.getElementById('output');
    output.style.display = "none";
    var removeimg = document.getElementById('removeimg');
    removeimg.style.display = "none";
    $('#msgFile').val("");
}













