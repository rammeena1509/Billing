var bill=new Array();
var detail=new Array();
var i=0;
var id;
var pid;
var sum;
var discount;
$(document).ready(function(){
    $("#batch").click(function(){
        $.post(link+"managerrequest/fetch_product/",function(result){
            if(result['error_code']){
                $("#product-form").css('display','none');
                $("#batch-form").css('display','block');
                var str="";
                $.each(result['data'],function(key,val){
                    str+="<option value='"+val.product_id+"'>"+val.product_id+"("+val.product_name+")"+"</option>";
                });
                $("#batch-form #pid").html(str);
            }
            else{
                alert(result['response_string']);
            }
        });
    });
    
    $("#product").click(function(){
        $("#batch-form").css('display','none');
        $("#product-form").css('display','block');
    });
    
    $("#add-button").click(function(){
        $("#add-button").attr('disabled','disabled');
        var pid=$("#add-product").val();
        if(pid){
            var validation = /^[0-9A-Z]+$/;
            if(pid.match(validation) && pid.length==16){
                id=pid.substring(0,6);
                bid=pid.substring(6,16);
                var j=1;
                if(bill.length>0){
                   var index=bill.findIndex(getItemInfo);
                   if(index!=-1){
                       j=0;
                        var table = document.getElementById("product-info");
                        var discount=bill[index]['product_discount'];
                       var quantity=bill[index]['quantity'];
                       if(quantity==bill[index]['total_quantity']){
                            alert("no more item available");
                            $("#add-button").removeAttr('disabled');
                            return;
                        }
                        bill[index]['quantity']+=1;
                        quantity=bill[index]['quantity'];
                        var unit_price=bill[index]['product_price'];
                        var total=quantity*unit_price;
                        if(bill[index]['discount_type']==0)
                            discount=parseInt(total*.01*discount);
                        else
                            discount=quantity*bill[index]['product_discount']
                        if(discount<bill[index]['max_discount']){
                            bill[index]['discount']=discount;
                        }
                        else{
                            bill[index]['discount']=bill[index]['max_discount'];
                        }
                       table.rows[index].cells[4].innerHTML=bill[index]['quantity'];
                       table.rows[index].cells[5].innerHTML=total;
                       table.rows[index].cells[6].innerHTML=bill[index]['discount'];
                   }
                }
                if(j){
                $.getJSON(link+'cashierrequest/getItem',{p_id:pid},function(data){
                    if(data['error_code']){
                        bill.push(data['data']);
                        bill[i]['quantity']=1;
                        var table = document.getElementById("product-info");
                        var row = table.insertRow(i);
				        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
				        var cell3 = row.insertCell(2);
				        var cell4 = row.insertCell(3);
				        var cell5 = row.insertCell(4);
				        var cell6 = row.insertCell(5);
				        var cell7 = row.insertCell(6);
				        var cell8 = row.insertCell(7);
				        if(bill[i]['discount_type']==0){
                            var discount=bill[i]['product_discount'];
                            var quantity=bill[i]['quantity'];
                            var unit_price=bill[i]['product_price'];
                            var total=quantity*unit_price;
                            discount=total*.01*discount;
                            if(discount<bill[i]['max_discount']){
                                bill[i]['discount']=discount;
                            }
                            else{
                                bill[i]['discount']=bill[i]['max_discount'];
                            }
                            cell1.innerHTML=i+1;
                            cell2.innerHTML=bill[i]['product_id']+bill[i]['batch_id'];
                            cell3.innerHTML=bill[i]['product_name'];
                            cell4.innerHTML=bill[i]['product_price'];
                            cell5.innerHTML=bill[i]['quantity'];
                            cell6.innerHTML=total;
                            cell7.innerHTML=bill[i]['discount'];
                            cell8.innerHTML='<i class="fa fa-minus-circle" id="'+bill[i]['product_id']+bill[i]['batch_id']+'"style="color:red;cursor:pointer;font-size:32px;"onclick="updateQuantity(this.id,-1)"></i>&nbsp;<button class="btn btn-danger" id="'+bill[i]['product_id']+bill[i]['batch_id']+'"onclick="deleteRow(this.id)">Remove</button>&nbsp;&nbsp;</span><i class="fa fa-plus-circle" id="'+bill[i]['product_id']+bill[i]['batch_id']+'"style="color:blue;cursor:pointer;font-size:32px;"onclick="updateQuantity(this.id,1)"></i>';
                        }
				        else{
                            var discount=bill[i]['product_discount'];
                            var quantity=bill[i]['quantity'];
                            var unit_price=bill[i]['product_price'];
                            var total=quantity*unit_price;
                            //discount=total*.01*discount;
                            if(discount<bill[i]['max_discount']){
                                bill[i]['discount']=discount;
                            }
                            else{
                                bill[i]['discount']=bill[i]['max_discount'];
                            }
                            cell1.innerHTML=i+1;
                            cell2.innerHTML=bill[i]['product_id']+bill[i]['batch_id'];
                            cell3.innerHTML=bill[i]['product_name'];
                            cell4.innerHTML=bill[i]['product_price'];
                            cell5.innerHTML=bill[i]['quantity'];
                            cell6.innerHTML=total;
                            cell7.innerHTML=bill[i]['discount'];
                            cell8.innerHTML='<i class="fa fa-minus-circle" id="'+bill[i]['product_id']+bill[i]['batch_id']+'"style="color:red;cursor:pointer;font-size:32px;"onclick="updateQuantity(this.id,-1)"></i>&nbsp;<button class="btn btn-danger" id="'+bill[i]['product_id']+bill[i]['batch_id']+'"onclick="deleteRow(this.id)">Remove</button>&nbsp;&nbsp;</span><i class="fa fa-plus-circle" id="'+bill[i]['product_id']+bill[i]['batch_id']+'"style="color:blue;cursor:pointer;font-size:32px;"onclick="updateQuantity(this.id,1)"></i>';
                        }
                        i++;
                        if(i==1){
                            $("#proceed").removeAttr('disabled');
                        }
                    }
                    else{
                        alert(data['response_string']);
                    }
                });
                }
            }
            else{
                alert("ENTER A VALID PRODUCT ID");
            }
        }
        else{
            alert("ENTER PRODUCT ID");
        }
        $("#add-button").removeAttr('disabled');
    });
    
    $("#proceed").click(function(){
        sum=0;
        discount=0;
        var table = document.getElementById("bill-info");
        for(var j=0;j<bill.length;j++){
            var row = table.insertRow(j);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            cell1.innerHTML=j+1;
            cell2.innerHTML=bill[j]['product_id']+bill[j]['batch_id'];
            cell3.innerHTML=bill[j]['product_name'];
            cell4.innerHTML=bill[j]['product_price'];
            cell5.innerHTML=bill[j]['quantity'];
            cell6.innerHTML=bill[j]['quantity']*bill[j]['product_price'];
            cell7.innerHTML=bill[j]['discount'];
            sum+=bill[j]['quantity']*bill[j]['product_price'];
            discount+=parseInt(bill[j]['discount']);
        }
        $("#stotal").html(sum);
        $("#bdiscount").html(discount);
        $("#myModal").css('display','block');
    });
    
    $("#verify-number").click(function(){
        var number=$("#cmobile").val();
        if(!valid_mobile(number)){
            alert("enter valid mobile number");
        }
        else{
            var count=detail.length;
            var k;
            for(k=0;k<count;k++){
                detail.pop();
            }
            $.getJSON(link+"cashierrequest/verifyUser",{mobile:number,total:sum},function(data){
                if(data['error_code']==1){
                    detail.push(data['data'][0]);
                    detail.push(data['data'][1]);
                    var table=document.getElementById("discount-table");
                    var rowCount = $('#discount-table tr').length;
                    for(var j=rowCount;j>2;j--){
                        table.deleteRow(j-1);
                    }
                    var j=2;
                    if(data['data'][1]['discount']>0){
                        var row = table.insertRow(j);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        cell1.innerHTML="<b>Coupon Discount</b>";
                        cell2.innerHTML=data['data'][1]['discount'];
                        j++;
                    }
                    if(data['data'][1]['reward_discount']>0){
                        var row = table.insertRow(j);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        cell1.innerHTML="<b>Reward Discount</b>";
                        cell2.innerHTML=data['data'][1]['reward_discount'];
                        j++;
                    }
                    $("#message").css('color','green');
                    $('#message').html(data['response_string']);
                    $("#generate-bill").removeAttr("disabled");
                }
                else{
                    $("#message").css('color','red');
                    $('#message').html(data['response_string']);
                }
            });
        }
    });
    
    $("#customer-register").click(function(){
        var cname=$("#c-name").val();
        var cmobile=$("#c-mobile").val();
        var cmail=$("#c-mail").val();
        var j=3;
        if(cname.length==0){
            alert("enter customer name");
            j--;
            return;
        }
        if(!valid_mobile(cmobile)){
            alert("enter correct mobile number");
            j--;
            return;
        }
        if(!valid_email(cmail)){
            alert("enter correct email id");
            j--;
            return;
        }
        var count=detail.length;
        var k;
        for(k=0;k<count;k++){
            detail.pop();
        }
        if(j==3){
            $.getJSON(link+'cashierrequest/registerUser/',{name:cname,mobile:cmobile,email:cmail,total:sum},function(data){
                if(data['error_code']==1){
                    detail.push(data['data'][0]);
                    detail.push(data['data'][1]);
                    var table=document.getElementById("discount-table");
                    var rowCount = $('#discount-table tr').length;
                    for(var j=rowCount;j>2;j--){
                        table.deleteRow(j-1);
                    }
                    var j=2;
                    if(data['data'][1]['discount']>0){
                        var row = table.insertRow(j);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        cell1.innerHTML="<b>Coupon Discount</b>";
                        cell2.innerHTML=data['data'][1]['discount'];
                        j++;
                    }
                    $("#reg-msg").css('color','green');
                    $('#reg-msg').html(data['response_string']);
                    $("#generate-bill").removeAttr("disabled");
                 }
                else{
                    $("#reg-msg").css('color','red');
                    $('#reg-msg').html(data['response_string']);
                }
            });
        }
    });
    
    $("#generate-bill").click(function(){
        var data = [bill,detail];
        $("#msg").html("Generating Bill...Please Wait!");
        $.ajax({
              url:link+"cashierrequest/generateBill",
              type: "POST",
              data: {order: JSON.stringify(data)},
              dataType: "json",
              beforeSend: function(x) {
                if (x && x.overrideMimeType) {
                  x.overrideMimeType("application/j-son;charset=UTF-8");
                }
              },
              xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                    $('#pp').text(percentComplete + '%');
                                    $('.myprogress').css('width', percentComplete + '%');
                                }
                            }, false);
                            return xhr;
                        },
              success: function(result) {
                if(result['error_code']){
                    window.location=link+'cashier/generateInvoice/'+result['data'];
                }
                else{
                     $(".myprogress").removeClass('progress-bar-success');
                     $(".myprogress").addClass('progress-bar-danger');
                     $("#msg").html(result['response_string']); 
                  }
              }
        });
    });
    
    $("#customer-form").submit(function(e){
        e.preventDefault();
        var mobile=$("#cmobile").val();
        var email=$("#cmail").val();
        var name=$("#cname").val();
        var k=3;
        if(!valid_name(name)){
            alert("Enter Valid Name");
            $("#cname").focus();
            k--;
            return;
        }
        if(!valid_mobile(mobile)){
            alert("Enter Valid Mobile Number");
            $("#cmobile").focus();
            k--;
            return;
        }
        if(!valid_email(email)){
            alert("Enter Valid Email Address");
            $("#cmail").focus();
            k--;
            return;
        }
        
        if(k==3){
            $('#customer-form').unbind('submit').submit();
        }
        
    });
    
    $("#cashier-form").submit(function(e){
        e.preventDefault();
        var mobile=$("#cmobile").val();
        var email=$("#cmail").val();
        var name=$("#cname").val();
        var k=3;
        if(!valid_name(name)){
            alert("Enter Valid Name");
            $("#cname").focus();
            k--;
            return;
        }
        if(!valid_mobile(mobile)){
            alert("Enter Valid Mobile Number");
            $("#cmobile").focus();
            k--;
            return;
        }
        if(!valid_email(email)){
            alert("Enter Valid Email Address");
            $("#cmail").focus();
            k--;
            return;
        }
        
        if(k==3){
            $('#cashier-form').unbind('submit').submit();
        }
        
    });
    
    $("#coupon-form").submit(function(e){
        e.preventDefault();
        var cdiscount=$("#cdiscount").val();
        var min_order=$("#min_amount").val();
        var max_redemption=$("#redemption").val();
        var max_discount=$("#mdiscount").val();
        var vfrom=$("#valid_from").val();
        var vupto=$("#valid_upto").val();
        var k=5;
        if(!valid_number1(cdiscount)){
            alert("Enter Valid Coupon Discount Value");
            $("#cdiscount").focus();
            k--;
            return;
        }
        if(!valid_number1(max_redemption)){
            alert("Enter Valid Maximum Redemption Per User Limit");
            $("#redemption").focus();
            k--;
            return;
        }
        
        if(!valid_number1(max_discount)){
            alert("Enter Valid Maximum Coupon Discount");
            $("#mdiscount").focus();
            k--;
            return;
        }
        vfrom=new Date(vfrom);
        vupto=new Date(vupto);
        if(vfrom>=vupto){
            alert("Enter valid date Range of coupon validity");
            k--;
            return;
        }
        if(!valid_number1(min_order)){
            alert("Enter Valid Minimum Order Amount");
            $("#min_amount").focus();
            k--;
            return;
        }
        
        
        if(k==5){
            $('#coupon-form').unbind('submit').submit();
        }
        
    });
    
    $(".update-customer").click(function(){
        var col= $(this).val();
        var col_val=$("#"+col).val();
        var cid=$("#"+col).attr('name');
        switch (col) {
                    case "customer_mobile":
                         if(valid_mobile(col_val)){
                             $.post(link+"cashierrequest/check_unique/",{fname:col,fvalue:col_val},function(data){
                                 if(!data['error_code']){
                                     alert(data['response_string']);
                                     return;
                                 }
                                 else{
                                     action=true;
                                 }
                             });
                         }
                         else{
                             action=false;
                         }
                        break;
                    case "customer_email":
                        if(valid_email(col_val)){
                             $.post(link+"cashierrequest/check_unique/",{fname:col,fvalue:col_val},function(data){
                                 if(!data['error_code']){
                                     alert(data['response_string']);
                                     return;
                                 }
                                 else{
                                     action=true;
                                 }
                             });
                         }
                         else{
                             action=false;
                         }
                        break;
                    case "customer_name":
                        action = valid_name(col_val);
                        break;
                }
        if(action){
            $.post(link+'cashierrequest/updatecustomer/',{id:cid,fname:col,fvalue:col_val},function(data){
                        if(data==1){
                           alert("Field Updated Successfully");
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
    
    $(".update-coupon").click(function(){
        var col= $(this).val();
        var col_val=$("#"+col).val();
        var cid=$("#"+col).attr('name');
        action= valid_number1(col_val);
        if(action){
            $.post(link+'managerrequest/update_coupon/',{id:cid,fname:col,fvalue:col_val},function(data){
                        if(data==1){
                           alert("Field Updated Successfully");
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
    
    $(".update-cashier").click(function(){
        var col= $(this).val();
        var col_val=$("#"+col).val();
        var cid=$("#"+col).attr('name');
        switch (col) {
                    case "cashier_mobile":
                         if(valid_mobile(col_val)){
                             $.post(link+"managerrequest/check_unique/",{fname:col,fvalue:col_val},function(data){
                                 if(!data['error_code']){
                                     alert(data['response_string']);
                                     return;
                                 }
                                 else{
                                     action=true;
                                 }
                             });
                         }
                         else{
                             action=false;
                         }
                        break;
                    case "cashier_email":
                        if(valid_email(col_val)){
                             $.post(link+"managerrequest/check_unique/",{fname:col,fvalue:col_val},function(data){
                                 if(!data['error_code']){
                                     alert(data['response_string']);
                                     return;
                                 }
                                 else{
                                     action=true;
                                 }
                             });
                         }
                         else{
                             action=false;
                         }
                        break;
                    case "cashier_name":
                        action = valid_name(col_val);
                        break;
                }
        if(action){
            $.post(link+'managerrequest/update_cashier/',{id:cid,fname:col,fvalue:col_val},function(data){
                        if(data==1){
                           alert("Field Updated Successfully");
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
    
    $(".update-bill").click(function(){
        id=$(this).val();
        bid=$(this).attr('id');
        var index=order.findIndex(getItemInfo);
        $("#product_name").val(order[index]['product_name']);
        $("#product_price").val(order[index]['product_price']);
        $("#product_quantity").val(order[index]['quantity']);
        $("#sub_total").val(order[index]['quantity']*order[index]['product_price']);
        $("#quantity-update").val(order[index]['product_id']+order[index]['batch_id']);
        $("#remove-product").val(order[index]['product_id']+order[index]['batch_id']);
        $("#myModal").css('display','block');
    });
    
    $("#quantity-update").click(function(){
        var quantity=$("#product_quantity").val();
        if(valid_number(quantity)){
        pid=$(this).val();
        id=pid.substring(0,6);
        bid=pid.substring(6,16);
        var index=order.findIndex(getItemInfo);
        var diff=quantity-order[index]['quantity'];
        if(diff!=0){
        if(confirm("Are You Sure to Update Product Quantity")){
        if(order[index]['discount_type']==0){
            discount=order[index]['product_discount']*diff*.01*order[index]['product_price'];
        }
        else{
            discount=order[index]['product_discount']*diff;
        }
        var discount=parseInt($("#order_discount").val())+discount;
        var sum=parseInt($("#total_price").val())+(order[index]['product_price']*diff);
        var update={order_id:order[index]['order_id'],batch_id:bid,product_id:id,product_quantity:quantity,quantity_difference:diff,updated_discount:discount,updated_price:sum};
        $.post(link+"cashierrequest/update_bill/",{detail:update},function(data){
            alert(data['response_string']);
            if(data['error_code']){
                window.location=link+'cashier/generateInvoice/'+order[index]['order_id'];
            }
        });
        }
        }
    }
    else{
         alert("Enter valid quantity");                       
    }
    });
    
    $("#remove-product").click(function(){
        if(confirm("Are You Sure to Remove Product")){
        pid=$(this).val();
        id=pid.substring(0,6);
        bid=pid.substring(6,16);
        var index=order.findIndex(getItemInfo);
        var quantity=order[index]['quantity'];
        if(order[index]['discount_type']==0){
            discount=order[index]['product_discount']*quantity*.01*order[index]['product_price'];
        }
        else{
            discount=order[index]['product_discount']*quantity;
        }
        var discount=parseInt($("#order_discount").val())-discount;
        var sum=parseInt($("#total_price").val())-(order[index]['product_price']*quantity);
        var update={order_id:order[index]['order_id'],batch_id:bid,product_id:id,updated_discount:discount,updated_price:sum,product_quantity:quantity};
        $.post(link+"cashierrequest/remove_bill_product/",{detail:update},function(data){
            alert(data['response_string']);
            if(data['error_code']){
                window.location=link+'cashier/generateInvoice/'+order[index]['order_id'];
            }
        });
        }
    });
    
    $("#product-form").submit(function(e){
        e.preventDefault();
        var pid=$("#pid").val();
        var pname=$("#pname").val();
        var category=$("#category").val();
        discount=$("#discount").val();
        var subcat=$("#subcat").val();
        var price=$("#price").val();
        var mdiscount=$("#mdiscount").val();
        var discription=$("#discription").val();
        var k=8;
        if(!valid_pid(pid)){
            alert("Enter Valid Product Id");
            $("#pid").focus();
            k--;
            return;
        }
        if(!valid_name(pname)){
            alert("Enter Valid Product Name");
            $("#pname").focus();
            k--;
            return;
        }
        
        if(!valid_name(category)){
            alert("Enter Valid Category Name");
            $("#category").focus();
            k--;
            return;
        }
        if(!valid_number1(discount)){
            alert("Enter Valid Discount");
            $("#discount").focus();
            k--;
            return;
        }
        if(!valid_name(subcat)){
            alert("Enter Valid Sub-Category Name");
            $("#subcat").focus();
            k--;
            return;
        }
        if(!valid_number1(price)){
            alert("Enter Valid Price");
            $("#price").focus();
            k--;
            return;
        }
        if(!valid_number1(mdiscount)){
            alert("Enter Valid Maximum Discount Amount");
            $("#mdiscount").focus();
            k--;
            return;
        }
        if(!valid_name(discription)){
            alert("Enter Valid Product Discription");
            $("#discription").focus();
            k--;
            return;
        }
        
        $.post(link+"managerrequest/check_unique_productid/",{product_id:pid},function(result){
            if(result['error_code']){
                if(k==8){
                    $('#product-form').unbind('submit').submit();
                }
            }
            else{
                alert(result['response_string']);
                $("#product-form #pid").focus();
            }
        });
    });
    
    $("#batch-form").submit(function(e){
        e.preventDefault();
        var pid=$("#batch-form #pid").val();
        var bid=$("#bid").val();
        var mdate=$("#mdate").val();
        var edate=$("#edate").val();
        var quantity=$("#quantity").val();
        var remark=$("#remark").val();
        var k=4;
        if(!valid_bid(bid)){
            alert("Enter Valid Batch Id");
            $("#bid").focus();
            k--;
            return;
        }
        
        mdate=new Date(mdate);
        edate=new Date(edate);
        if(mdate>=edate){
            alert("Enter valid date Range");
            k--;
            return;
        }
        
        if(!valid_number1(quantity) || quantity<1){
            alert("Enter Valid Quantity");
            $("#quantity").focus();
            k--;
            return;
        }
        
        if(!valid_name(remark)){
            alert("Enter Valid Remark");
            $("#remark").focus();
            k--;
            return;
        }
        $.post(link+"managerrequest/check_unique_batchid/",{batch_id:bid},function(result){
            if(result['error_code']){
                if(k==4){
                    $('#batch-form').unbind('submit').submit();
                }
            }
            else{
                alert(result['response_string']);
                $("#bid").focus();
            }
        });
    });
    
    $(".update-product").click(function(){
        var col= $(this).val();
        var col_val=$("#"+col).val();
        switch (col) {
                    case "product_price":
                         action= valid_number1(col_val);
                        break;
                    case "product_discount":
                        action = valid_number1(col_val);
                        break;
                    case "max_discount":
                        action = valid_number1(col_val);
                        break;
                    default:
                        action=valid_name(col_val);
                        break;
                }
        if(action || col=="discount_type"){
            $.post(link+'managerrequest/update_product/',{id:product_id,fname:col,fvalue:col_val},function(data){
                        if(data==1){
                           alert("Field Updated Successfully");
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
    
    $("#update_batch").on('change',function(){
        var bid=$(this).val();
        $.post(link+'managerrequest/fetch_batch/',{batch_id:bid},function(result){
            if(result['error_code']){
                $("#manufacturing_date").val(result['data']['manufacturing_date']);
                $("#expiry_date").val(result['data']['expiry_date']);
                $("#remark").val(result['data']['remark']);
                $("#product_quantity").val(result['data']['product_quantity']);
            }
            else{
                alert($result['response_string']);
            }
         });
    });
    
    $(".update-batch").click(function(){
        var col= $(this).val();
        var col_val=$("#"+col).val();
        bid=$('#update_batch').val();
        switch (col) {
                    case "product_quantity":
                         action= valid_number1(col_val);
                        break;
                    case "remark":
                        action = valid_name(col_val);
                        break;
                 }
        if(action){
            $.post(link+'managerrequest/update_batch/',{id:bid,fname:col,fvalue:col_val},function(data){
                        if(data==1){
                           alert("Field Updated Successfully");
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
    
    $("#change-password").click(function(){
        var op=$("#opassword").val();
        var np=$("#npassword").val();
        var cnp=$("#cnpassword").val();
        if(op.length==0){
            alert("Enter Old Password");
            return;
        }
        if(np.length==0){
            alert("Enter New Password");
            return;
        }
        if(np!=cnp){
               alert("Password not match");
                return; 
            }
        $(this).attr('disabled','disabled');
        $.getJSON(link+"Managerrequest/updatePassword/",{npassword:np,opassword:op},function(data){
            alert(data['response_string']);
            if(data['error_code']){
                $("#modal-close").click();
            }
        });
        $(this).removeAttr('disabled');
    });
    
    $("#change-pass").click(function(){
        var op=$("#opassword").val();
        var np=$("#npassword").val();
        var cnp=$("#cnpassword").val();
        if(op.length==0){
            alert("Enter Old Password");
            return;
        }
        if(np.length==0){
            alert("Enter New Password");
            return;
        }
        if(np!=cnp){
               alert("Password not match");
                return; 
            }
        $.getJSON(link+"cashierrequest/updatePassword/",{npassword:np,opassword:op},function(data){
            alert(data['response_string']);
            if(data['error_code']){
                $("#modal-close").click();
            }
        });
    });
    
    $("#get-stats").click(function(){
        var sdate=$("#start-date").val();
        var edate=$("#end-date").val();
        if(sdate && edate){
            sdate=new Date(sdate);
            edate=new Date(edate);
            if(sdate>=edate){
                alert("Enter valid date Range");
                return;
            }
            else{
                sdate=$("#start-date").val();
                edate=$("#end-date").val();
                $("#stats-div").css('display','none');
                $("#charts-div").css('display','none');
                $.post(link+"managerrequest/get_statistics/",{start_date:sdate,end_date:edate},function(data){
                    if(data['error_code']){
                        var stats=data['data']['stats'];
                        $("#bill-amount").html(stats['amount']);
                        $("#bill-generated").html(stats['bills']);
                        $("#distinct-cashier").html(stats['cashiers']);
                        $("#distinct-user").html(stats['users']);
                        $("#distinct-product").html(stats['products']);
                        $("#total-income").html(stats['income']);
                        $("#tax-received").html(stats['tax']);
                        $("#discount-given").html(stats['discount']);
                        $("#quantity-sell").html(stats['quantity']);
                        $("#stats-div").slideDown(1000);
                        $("#chart-div").css('display','block');
                        var pieData=new Array();
                        $.each(data['data']['graphs'],function(key,val){
                                 pieData.push({value:val.quantity,color:getRandomColor(),label:val.product_name});
                               });
                        var barChartData = {
									labels : ["Jan","Feb","March","April","May","June","July"],
									datasets : [
										{
											fillColor : "rgba(233, 78, 2, 0.9)",
											strokeColor : "rgba(233, 78, 2, 0.9)",
											highlightFill: "#e94e02",
											highlightStroke: "#e94e02",
											data : [65,59,90,81,56,55,40]
										},
										{
											fillColor : "rgba(79, 82, 186, 0.9)",
											strokeColor : "rgba(79, 82, 186, 0.9)",
											highlightFill: "#4F52BA",
											highlightStroke: "#4F52BA",
											data : [40,70,55,20,45,70,60]
										}
									]
									
								};
								var lineChartData = {
									labels : ["Jan","Feb","March","April","May","June","July"],
									datasets : [
										{
											fillColor : "rgba(242, 179, 63, 1)",
											strokeColor : "#F2B33F",
											pointColor : "rgba(242, 179, 63, 1)",
											pointStrokeColor : "#fff",
											data : [70,60,72,61,75,59,80]

										},
										{
											fillColor : "rgba(97, 100, 193, 1)",
											strokeColor : "#6164C1",
											pointColor : "rgba(97, 100, 193,1)",
											pointStrokeColor : "#9358ac",
											data : [50,65,51,67,52,64,50]

										}
									]
									
								};
								
                        	//new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
							//new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
							new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
                    }
                    else{
                        alert(data['response_string']);
                    }
                });
            }
        }
        else{
            alert("Enter valid date range");
        }
    });
    
});

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

function getItemInfo(t){
        return t.product_id==id && t.batch_id==bid;
    }

function deleteRow(pid){
        id=pid.substring(0,6);
        bid=pid.substring(6,16);	
        if(bill.length>0){
        var index=bill.findIndex(getItemInfo);
        bill.splice(index,1);
        document.getElementById('product-info').deleteRow(index);
        }
        i--;
        if(i==0){
            $("#proceed").attr('disabled','disabled');
        }
    }

function updateQuantity(pid,status){
    id=pid.substring(0,6);
    bid=pid.substring(6,16);
    if(bill.length>0){
        var index=bill.findIndex(getItemInfo);
        var quantity=bill[index]['quantity'];
        if(status==1 && quantity==bill[index]['total_quantity']){
            alert("no more item available");
            return;
        }
        if(status==-1 && quantity==1){
            alert("minimum quantity reached");
            return;
        }
        var table = document.getElementById("product-info");
        var discount=bill[index]['product_discount'];
        bill[index]['quantity']+=status;
        quantity=bill[index]['quantity'];
        var unit_price=bill[index]['product_price'];
        var total=quantity*unit_price;
        if(bill[index]['discount_type']==0)
            discount=parseInt(total*.01*discount);
        else
            discount=quantity*bill[index]['product_discount']
        if(discount<bill[index]['max_discount']){
            bill[index]['discount']=discount;
        }
        else{
            bill[index]['discount']=bill[index]['max_discount'];
        }
        table.rows[index].cells[4].innerHTML=bill[index]['quantity'];
        table.rows[index].cells[5].innerHTML=total;
        table.rows[index].cells[6].innerHTML=bill[index]['discount'];
     }
}

function valid_mobile(mobile){
  var phoneno = /^\d{10}$/;
    if(!mobile.match(phoneno)){
        return false;
    }
    else{
        return true;
    }
}

function valid_name(name){
    return /^[A-Za-z\s]+$/.test(name);
}

function valid_number(number){
    return /^[1-9]+$/.test(number);
}

function valid_number1(number){
    return /^[0-9]+$/.test(number);
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

function valid_pid(pid){
    id=pid.substring(4,6);
    var digit = /^\d{2}$/;
    if(!id.match(digit)||pid.length!=6 || pid.indexOf("PROD")!=0) 
              {
               return false;
              }
    else{
        return true;
    }
}

function valid_bid(bid){
    var letterNumber = /^[0-9A-Z]+$/;
    if(!bid.match(letterNumber)||bid.length!=10) 
              {
               return false;
              }
    else{
        return true;
    }
}

window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        $("#bill-info").empty();
        $("#message").empty();
        $("#reg-msg").empty();
        $("#c-name").empty();
        $("#c-mobile").empty();
        $("#cmobile").empty();
       $("#c-mail").empty();
        var table=document.getElementById("discount-table");
            var rowCount = $('#discount-table tr').length;
            for(var j=rowCount;j>2;j--){
            table.deleteRow(j-1);
        }
        $("#cmobile").val("");
        $("#generate-bill").attr('disabled','disabled');
        modal.style.display = "none";
    }
}