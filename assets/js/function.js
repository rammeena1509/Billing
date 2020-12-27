function valid_mobile(mobile){
  var phoneno = /^\d{10}$/;
    if(!mobile.match(phoneno)){
        return false;
    }
    else{
        return true;
    }
}

function valid_pan(pan){
    var letterNumber = /^[0-9A-Z]+$/;
    if(!pan.match(letterNumber)||pan.length!=10) 
              {
               return false;
              }
    else{
        return true;
    }
}

function valid_adhaar(adhaar){
    var adhar = /^\d{12}$/;
    if(!adhaar.match(adhar)){
        return false;
    }
    else{
        return true;
    }
}

function valid_pincode(pincode){
    var pin = /^\d{6}$/; 
    if(!pincode.match(pin)){
        return false;
    }
    else{
        return true;
    }
}

function valid_time(time){
    var timeformat=/^([01]?[0-9]|2[0-3])(:[0-5][0-9])/;
    if (!timeformat.test(time)) { 
                return false;
    }
    else{
        return true;
    }
}

function valid_email(email){
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
  {
    return true;
  }
 else{
         return false; 
    }
    
}

function valid_url(website){
    var urlformat = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
    if (!urlformat.test(website)) { 
                return false;
    }
    else{
        return true;
    }
}

$(document).ready(function(){
            $(".update").click(function(){
                var id=$(this).val();
                var field=$("#"+id).val();
                var action="true";
                switch (id) {
                    case "mobile":
                         action= valid_mobile(field);
                        break;
                    case "email":
                        action = valid_email(field);
                        break;
                    case "adharcard":
                        action = valid_adhaar(field);
                        break;
                    case "pancard":
                        action = valid_pan(field);
                        break;
                    case "pincode":
                        action = valid_pincode(field);
                        break;
                    case "otime":
                        action = valid_time(field);
                        break;
                    case  "ctime":
                        action = valid_time(field);
                        break;
                    case  "website":
                        action = valid_url(field);
                        break;
                }
                if(action){
                    $.post(link+'adminrequest/updatevendor/',{id:kid,fname:id,fvalue:field},function(data){
                        if(data==1){
                           alert("Field Updated Successfully");
                            $("#"+id).val(field);
                        }
                        else{
                            alert("Failed To Update Field");
                        }
                    });
                }
                else{
                    alert("Enter Valid Field");
                }
            });
    
    $("#status").click(function(){
        var status=$(this).val();
        alert(status);
        if(status==1){
            var field=0;
            var ht="CLICK TO OPEN";
            var ac="btn-danger";
            var rc="btn-success";
        }
        else{
            var field=1;
            var ht="CLICK TO CLOSE";
            var rc="btn-danger";
            var ac="btn-success";
        }
         $.post(link+'adminrequest/updatevendor/',{id:kid,fname:"status",fvalue:field},function(data){
                        if(data==1){
                           alert("Status Updated Successfully");
                            $("#status").val(field);
                            $("#status").removeClass(rc);
                            $("#status").addClass(ac);
                            $("#status").val(field);
                            $("#status").html(ht);
                        }
                        else{
                            alert("Failed To Update Status");
                        }
        });
    });
    
    $(".edit").click(function(){
        var pid=$(this).val();
        var item = $("#"+pid).find("td").eq(1).html();
        var price = $("#"+pid).find("td").eq(2).html();
        var category = $("#"+pid).find("td").eq(3).html();
        $("#menu").hide();
        $("#pid").val(pid);
        $("#pname").val(item);
        $("#pprice").val(price);
        $("#pcategory").val(category);
        $("#menuedit").show();
    });
    
    $(".delete").click(function(){
        var id=$(this).val();
        if(confirm("Please Confirm to delete the menu Item")){
            $.post(link+'adminrequest/deletemenu/',{pid:id},function(data){
                            if(data==1){
                               alert("Menu Item Deleted Successfully");
                               var row = document.getElementById(id);
                                row.parentNode.removeChild(row);
                            }
                            else{
                                alert("Failed To Delete Menu");
                            }
            });
        }
    });
    
    $(".vendor").click(function(){
        var id=$(this).val();
        if(confirm("Please Confirm to delete the menu Item")){
            $.post(link+'adminrequest/deletevendor/',{kid:id},function(data){
                            if(data==1){
                               alert("Vendor Deleted Successfully");
                               window.location=link+"admin/viewvendor/";
                            }
                            else{
                                alert("Failed To Delete Vendor");
                            }
            });
        }
    });
    
    $("#cancel").click(function(){
        $("#menuedit").hide();
        $("#menu").show();
    });
    
    $("#upmenu").on('submit',function(e){
        e.preventDefault();
        var id=$("#pid").val();
        var name=$("#pname").val();
        var price=$("#pprice").val();
        var category=$("#pcategory").val();
        $.post(link+'adminrequest/updatemenu/',{pid:id,pname:name,pprice:price,pcategory:category},function(data){
                        if(data==1){
                           alert("Menu Item Updated Successfully");
                           $("#"+id).find("td").eq(1).html(name);
                           $("#"+id).find("td").eq(2).html(price);
                           $("#"+id).find("td").eq(3).html(category);
                           $("#cancel").click();
                        }
                        else{
                            alert("Failed To Update Menu");
                        }
        });
    });
    
    var _URL = window.URL || window.webkitURL;
	    $('#image').on( 'change', function() {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test( files[0].type)){ // only image file
                if(files[0].size > 4508876){
                    alert( "File Size Exceed The Limit Of 4508876 bytes: " + files[0].size);
                    $("#image").val("");
                  return;
                }
             }
            else {
                alert( "not a valid file: " + files[0].type);
                $("#image").val("");
                return;
            }
		});
    
     $("#uploadimage").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
            url: link+'adminrequest/uploadimage/', // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                    $('.myprogress').text(percentComplete + '%');
                                    $('.myprogress').css('width', percentComplete + '%');
                                }
                            }, false);
                            return xhr;
                        },
            success: function(data)   // A function to be called if request succeeds
            {
                if(data==1){
                    $('.msg').text("Image Updated Successfully");
                }
                else{
                    $('.msg').text("Failed To update Image");
                }
                $('#btn').removeAttr('disabled');
            }
            });
            }));  
    
});



