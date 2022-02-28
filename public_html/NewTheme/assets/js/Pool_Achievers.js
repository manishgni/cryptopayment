function amazingpool(poolno) {

    $('#Our-Team').html("<img src='../images/ajax-loader.gif'/>");
    
  
    $.getJSON('Handlers/Pool_Achievement.ashx?pol=' + poolno,
            function (Orjson) {

                if (Orjson.length == 0) {



                }
                else {

                    var d = formatOrder_cartquantity(Orjson);
                  
                    if (poolno == 1) {
                     $('#Our-Team').html(d); 
                    }

                 else if (poolno == 2) {
                     $('#Our-Team2').html("<img src='../images/ajax-loader.gif'/>");
                        $('#Our-Team2').html(d);
                    }

                    else if (poolno == 3) {
                        $('#Our-Team3').html("<img src='../images/ajax-loader.gif'/>");
                        $('#Our-Team3').html(d);
                    }

                

                }
            });
}


function formatOrder_cartquantity(Orjson) {
    var pp1 = '';
 
 
    for (var i = 0; i < Orjson.length; i++) {
       
        pp1 = pp1 + "<div class='col-md-4 col-sm-6 col-12'>";
        pp1 = pp1 + "<div class='dt-contact-info-short'>";
        pp1 = pp1 + "<div class='dt-avatar-wrapper'>";
        pp1 = pp1 + "<img class='dt-avatar'  src='../" + Orjson[i].ProfilPic + "' alt=''>";
        pp1 = pp1 + "<div class='dt-avatar-info'>";
        pp1 = pp1 + "<a href='#' class='dt-avatar-name text-dark' style='text-transform:capitalize'>" + Orjson[i].Mname + "</a>";
        pp1 = pp1 + "<span class='f-12 text-light-gray'>" + Orjson[i].MemID + "</span>";
        pp1 = pp1 + "</div>";
        pp1 = pp1 + "</div>";
        pp1 = pp1 + "</div>";
        pp1 = pp1 + "</div>";

}
  
    return pp1;
   

}


