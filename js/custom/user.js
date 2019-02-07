var li;
var t;
$(document).ready(function () {
    li = links();
    t = values2();
    $("#con").hide();
});


var incre = values();

function values() {


    return 0;
}

function values2() {
    var v = [];


    return v;
}

function t2() {

    $("#sub").hide();
    $("#con").show();

}

function ttt(id) {

    $("#modals").dialog({
        modal: true,
        dialogClass: 'noTitleStuff'
    });
    $(".img").show();


    $("#sub").hide();
    $("#con").show();


    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'user_access/sub_menu',
        data: {id: id},
        success: function (data) {

            if (document.getElementById(id + "c").checked) {


                var stuff = "";

                $.each(data.posts, function (key, val) {


                    stuff = stuff + "<input onclick=t2() name='active' id='" + val.id + "' value='" + id + ":" + val.id + "' type='checkbox' checked>" + val.name + "";

                });


                document.getElementById(id + "p").innerHTML = stuff;

            }

            else {

                $.each(data.posts, function (key, val) {
                    $("#" + val.id).attr('checked', false);

                });
            }


            $(".img").hide();
            $("#modals").dialog("close");


        },
        error: function () {
            alert("Server Error");
        }
    });


}

function downLoad_access(id) {


    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'user_access/menu',
        data: {id: id},
        success: function (data) {

            var stuff = "";

            $.each(data.posts, function (key, val) {
                stuff = stuff + "<div class='row'>"

                    + "<input onclick=ttt(" + val.id + ") value='" + val.id + ":0' name='active' id='" + val.id + "c' type='checkbox'>" + val.name + ""

                    + "<div class='col-sm-12' id='" + val.id + "p'></div>"
                    + "</div>";

            });


            document.getElementById("user_list").innerHTML = stuff;

        },
        error: function () {
            alert("Server Error");
        }
    });


}

function getUser(id, type, ware) {


    $("#user_list").empty();
    $("#sub").val(id);


    $("#modals").dialog({
        modal: true,
        dialogClass: 'noTitleStuff'
    });


    $(".img").show();

}


function getParent(id) {


    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'user_access/getUserList',
        data: {id: id, ware: ware, type: type},
        success: function (data) {


            if (data.id == 3) {


                $("#user").val('you can t access');


            }
            else {


                if (type == 2) {


                    var stuff = "<option value=" + type + ">Admin</option>";


                }
                else if (type == 3) {

                    var stuff = "<option value=" + type + ">User</option>";

                    downLoad_access(id);

                }


                document.getElementById("type_u").innerHTML = stuff;

                var acc = "";

                $.each(data.access, function (key, val) {

                    acc = acc + "<li>" + val.name + "</li>";

                });


                $.each(data.users, function (key, val) {
                    var wares = "";
                    var wares_id = "";

                    $.each(data.posts, function (key, val) {

                        $("#user").val(val.user);
                        $("#password").val(val.password);

                        wares = val.ware;
                        wares_id = val.ware2;


                    });

                    if (val.sup != 0) {


                        var stuff = "<option value=" + wares_id + ">" + wares + "</option>";

                        document.getElementById("shop").innerHTML = stuff;
                        document.getElementById("accs").innerHTML = acc;


                    }
                    else {

                        var stuff = "";

                        $.each(data.ware, function (key, val) {

                            stuff = stuff + "<option value=" + val.id + ">" + val.name + "</option>";

                        });


                        document.getElementById("shop").innerHTML = stuff;


                    }


                });


            }


        },
        error: function (jqXHR, textStatus, errorThrown) {
            //alert("Server Error");
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found.');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error.');
            } else if (errorThrown === 'parsererror') {
                alert('Requested JSON parse failed');
            } else if (errorThrown === 'timeout') {
                alert('Time out error');
            } else if (errorThrown === 'abort') {
                alert('Ajax request aborted ');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }

        }
    });


    var lin = "";
    if (id == 0)
        lin = "user_access/menu/";

    else
        lin = "user_access/sub_menu/";

    var k = li + "" + lin;

    $("#modals").dialog({
        modal: true,
        dialogClass: 'noTitleStuff'
    });
    $(".img").show();


    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: k,
        data: {id: id},
        success: function (data) {


            addData(data, id);

            $(".img").hide();
            $("#modals").dialog("close");

        },
        error: function (xhr, status) {
            alert(status);
        }
    });


    //return incre;


}

function addData(data, id) {

    if (id == 0) {

        $.each(data.posts, function (key, val) {

            if (document.getElementById(val.id + "c").checked) {


                var c = $("#" + val.id + "c").val();


                t[incre] = c;

                //alert(c);
                //alert(t[incre]);


                getParent(val.id);
            }
            else {

                t[incre] = 0 + ":" + 0;


            }

            incre++;
        });

    }
    else {


        $.each(data.posts, function (key, val) {


            if (document.getElementById(val.id).checked) {

                var c = $("#" + val.id).val();


                t[incre] = c;

                //alert(c);


            }
            else {


                t[incre] = 0 + ":" + 0;

            }
            incre++;

        });


    }

    //$("#check").val(incre);

    //	alert(incre);
    //create_user(incre);

}

function create_user2() {

    var user = $("#user").val();
    var pass = $("#password").val();
    var shop = $("#shop").val();
    if (user == '' || pass == '' || shop == '') {

        alert('information not complete');
    }
    else {

        $("#sub").show();
        $("#con").hide();

        incre = 0;

        getParent(0);
    }
}

function user_update() {

    var active = $('input[name=active]:checked').val();
    var user = $("#user").val();
    var pass = $("#password").val();
    var type = $("#type_u").val();
    var shop = $("#shop").val();
    var id = $("#sub").val();


    if (user == '' || pass == '' || shop == '') {

        alert('information not complete');


    }
    else {


        $("#modals").dialog({
            modal: true,
            dialogClass: 'noTitleStuff'
        });
        $(".img").show();


        if (type == 3) {

            getParent(0);

            incre = 0;
            var jsonString = JSON.stringify(t);

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: li + 'user_access/addUserAccessUpdate',
                data: {data: jsonString, active: active, user: user, pass: pass, type: type, shop: shop, id: id},
                cache: false,
                success: function (data) {


                    alert('user update successful');
                    window.location = li + "admin/user_all";


                },
                error: function (xhr, status) {
                    ///window.location=li+"admin/user_all";


                    alert(status);


                }
            });


        }

        else {


            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: li + 'user_access/addAdminAccessUpdate',
                data: {active: active, pass: pass, id: id},
                cache: false,
                success: function (data) {
                    window.location = li + "admin/user_all";

                },
                error: function (xhr, status) {
                    window.location = li + "admin/user_all";
                }
            });


        }


    }

}

/*function create_user(){




var active=$('input[name=active]:checked').val();
var user=$("#user").val();
var pass=$("#password").val();
var type=$("#type").val();
var shop=$("#shop").val();



if(user == '' || pass == '' || shop == ''){

    alert('information not complete');



}
else{


    if(type == 3)
    {


    getParent(0);

        incre=0;
    var jsonString = JSON.stringify(t);



    $.ajax({
    type:'POST',
    dataType:'json',
    url:li+'jquery_data/addUserAccess',
    data:{data : jsonString,active:active,user:user,pass:pass,type:type,shop:shop},
    cache: false,
    success:function(data)
    {
            if(data.id == 1){

                alert('user name already created');

            }
        else{
            window.location=li+"admin/create_user";
                alert('inserted');
        }

    },
    error:function(xhr, status)
    {
        alert(status);
    }
    });







    }
    else{

        $.ajax({
    type:'POST',
    dataType:'json',
    url:li+'jquery_data/addUser',
    data:{active:active,user:user,pass:pass,type:type,shop:shop},
    success:function(data)
    {
            if(data.id == 1){

                alert('user name already created');

            }
        else{

        alert('inserted');

        window.location=li+"admin/create_user";

        }

    },
    error:function(xhr, status)
    {
        alert(status);
    }
    });


    }






}



}*/


$("#sp").click(function () { //to show password, call from create_user.php page
    if ($(this).is(":checked")) {
        $("#password").attr('type', 'text');
    }
    else {
        $("#password").attr('type', 'password');
    }
});


function create_user() {


    var active = $('input[name=active]:checked').val();
    var user = $("#user").val();
    var pass = $("#password").val();
    var type = $("#type").val();
    var shop = $("#shop").val();


    if (user == '' || pass == '' || shop == '') {

        alert('information not complete');


    }
    else {
        $("#modals").dialog({
            modal: true,
            dialogClass: 'noTitleStuff'
        });
        $(".img").show();


        if (type == 3) {


            getParent(0);

            incre = 0;
            var jsonString = JSON.stringify(t);


            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: li + 'user_access/addUserAccess',
                data: {data: jsonString, active: active, user: user, pass: pass, type: type, shop: shop},
                cache: false,
                success: function (data) {
                    if (data.id == 1) {

                        alert('user name already created');

                    }
                    else {

                        alert('inserted');


                        window.location = li + "admin/create_user";

                    }

                },
                error: function (xhr, status) {
                    alert(status);
                }
            });


        }
        else {

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: li + 'user_access/addUser',
                data: {active: active, user: user, pass: pass, type: type, shop: shop},
                success: function (data) {
                    if (data.id == 1) {

                        alert('user name already created');

                    }
                    else {

                        alert('inserted');

                        window.location = li + "admin/create_user";

                    }

                },
                error: function (xhr, status) {
                    alert(status);
                }
            });


        }


    }
    $(".img").hide();
    $("#modals").dialog("close");


}

function type_per() {


    var id = $("#type").val();


    if (id == 3) {

        $("#modals").dialog({
            modal: true,
            dialogClass: 'noTitleStuff'
        });
        $(".img").show();



        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'user_access/menu',
            data: {id: id},
            success: function (data) {

                var stuff = "";

                $.each(data.posts, function (key, val) {
                    stuff = stuff + "<div class='row'>"

                        + "<input onclick=ttt(" + val.id + ") value='" + val.id + ":0' name='active' id='" + val.id + "c' type='checkbox'>" + val.name + ""

                        + "<div class='col-sm-12' id='" + val.id + "p'></div>"
                        + "</div>";

                });

                $(".img").hide();
                $("#modals").dialog("close");

                document.getElementById("per").innerHTML = stuff;

            },
            error: function () {
                alert("Server Error");
            }
        });


    }
    else {


        $("#per").empty();
    }

}


$("#supplier").click(function () {

    var name = $("#name").val();
    var phone = $("#phone").val();
    var opening = $("#opening").val();


    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'admin/supplier_add',
        data: {name: name, phone: phone, opening: opening},
        success: function (data) {

            window.location = li + "admin/supplier_new/";

        },
        error: function () {
            //alert("Server Error");
        }
    });


});


$("#customer").click(function () {

    var name = $("#name").val();
    var phone = $("#phone").val();
    var opening = $("#opening").val();
    var region = $("#region").val();


    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'admin/customer_add',
        data: {name: name, phone: phone, opening: opening, region: region},
        success: function (data) {

            window.location = li + "admin/customer_new/";

        },
        error: function () {
            //alert("Server Error");
        }
    });


});

function process_p2() {


    var name = $("#wname").val();
    var theme = $("#wtheme").val();
    var address = $("#waddress").val();
    var phone = $("#wphone").val();

    var vat = $("#wvat").val();
    var printer = $('input[name=printer]:checked').val();

    if (name == '') {


        alert('information incomplete');
    }
    else {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'user_access/addwirehouse',
            data: {printer: printer, name: name, theme: theme, address: address, phone: phone, vat: vat},
            success: function (data) {


                window.location = li + "admin/create_user";


            },
            error: function (error) {
                alert("Server Error");
            }
        });

    }
}


$("#sug").keyup(function () {


    var ch = $("#sug").val();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'jquery_data/getCitis',
        data: {ch: ch},
        success: function (data) {
            var stuff = "";

            $.each(data.posts, function (key, val) {
                stuff = stuff + "<option value=" + val.id + ">" + val.name + "</option>";

            });

            document.getElementById("shop").innerHTML = stuff;


        },
        error: function (error) {
            alert("Server Error");
        }
    });


});
