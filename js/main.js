function login(){
var name = $('#name').val();
var pass = $('#pass').val();
$.ajax({
    method: "POST",
    url: "../login.php",
    data: {
        "auth": 1,
        "name": name,
        "pass": pass
    },
    cache: false,
    success: function(html){
            location.reload();
    }
});
}
function add_avans_group(){
    $.ajax({
        url: "../func/app_avans_group.php",
        cache: false,
        success: function(html){
            $("#block_avans_group").html(html);
        }
    })
}

function show_window_alert(){
    $("#window_alert").show();
}

function show()
{$.ajax({
        url: "../func/app_workers.php",
        cache: false,
        success: function(html){
            $("#block_workers").html(html);
        }
    });}
function show_objects()
{$.ajax({
        url: "../func/app_objects.php",
        cache: false,
        success: function(html){
            $("#block_objects").html(html);
        }
    });}

function show_avans()
{$.ajax({
    url: "../func/app_avans.php",
    cache: false,
    success: function(html){
        $("#block_avans").html(html);
    }
});}

function show_tabel(pole1,pole2,pole3)
{$.ajax({
    method: "POST",
    url: "../func/app_tabel.php",
    data: {
        "pole1": pole1,
        "pole2": pole2,
        "pole3": pole3
    },
    cache: false,
    success: function(html){
        $("#block_tabel").html(html);
        $("#saveuserss").show();
        $("#adduser").show();
    }
});}

function show_zarplata(pole1,pole2,pole3)
{$.ajax({
    method: "POST",
    url: "../func/app_zarplata.php",
    data: {
        "pole1": pole1,
        "pole2": pole2,
        "pole3": pole3
    },
    cache: false,
    success: function(html){
        $("#block_zarplata").html(html);
        $("#save_zp").show();
        $("#update_zp").show();
    }
});}

function show_select_objects()
{$.ajax({
    url: "../func/select_objects.php",
    cache: false,
    success: function(html){
        $("#sel1").html(html);
    }
});}

function show_select_objects_export()
{$.ajax({
    url: "../func/select_objects_export.php",
    cache: false,
    success: function(html){
        $("#sel10").html(html);
        $("#sel12").html(html);

    }
});}
function show_select_objects11()
{$.ajax({
    url: "../func/select_objects11.php",
    cache: false,
    success: function(html){
        $("#sel11").html(html);
    }
});}
function show_select_objects111()
{$.ajax({
    url: "../func/select_objects111.php",
    cache: false,
    success: function(html){
        $("#sel111").html(html);
    }
});}
function show_select_objects1111()
{$.ajax({
    url: "../func/select_objects1111.php",
    cache: false,
    success: function(html){
        $("#sel1111").html(html);
    }
});}

function show_select_objects2()
{$.ajax({
    url: "../func/select_objects_tabel.php",
    cache: false,
    success: function(html){
        $("#sel2").html(html);
    }
});}

function show_select_objects3()
{$.ajax({
    url: "../func/select_objects_zarplata.php",
    cache: false,
    success: function(html){
        $("#sel4").html(html);
    }
});}


function show_select_people()
{$.ajax({
    url: "../func/select_avans.php",
    cache: false,
    success: function(html){
        $("#sel3").html(html);
    }
});}

function show_select_people_tabel()
{$.ajax({
    url: "../func/select_people_tabel.php",
    cache: false,
    success: function(html){
        $("#sel7").html(html);
    }
});}

function show_edit_card(id_avans)
{$.ajax({
    url: "../func/app_avans_edit.php",
    method: 'POST',
    data:{
        'delobj': id_avans
    },
    success: function(html){
        $("#sel_edit_avans").html(html);
    }
});}

function show_edit_worker(id_worker)
{$.ajax({
    url: "../func/app_worker_edit.php",
    method: 'POST',
    data:{
        'delobj': id_worker
    },
    success: function(html){
        $("#sel_edit_worker").html(html);
    }
});}

function show_edit_object(id_object)
{$.ajax({
    url: "../func/app_object_edit.php",
    method: 'POST',
    data:{
        'delobj': id_object
    },
    success: function(html){
        $("#sel_edit_object").html(html);
    }
});}


function dellete_objects(hi)
{$.ajax({
    url: '../func/deletecard_objects.php',
    method: 'POST',
    data:{
        'delobj': hi
    },
    success: function(html){
        show_objects();
        $("#block_objects").html(html);
    }
});}

function dellete_avans(hiii)
{$.ajax({
    url: '../func/deletecard_avans.php',
    method: 'POST',
    data:{
        'delava': hiii
    },
    success: function(html){
        show_avans();
        $("#block_avans").html(html);
    }
});}

function dellete_tabel(id_worker,id_object,year,month)
{$.ajax({
    url: '../func/deletecard_tabel.php',
    method: 'POST',
    data:{
        'pole1': id_worker,
        'pole2': id_object,
        'pole3': year,
        'pole4': month
    },
    success: function(html){
        show_tabel(id_object,year,month)
    }
});}
function dellete_zarplata(id_worker,id_object,year,month)
{$.ajax({
    url: '../func/deletecard_zarplata.php',
    method: 'POST',
    data:{
        'pole1': id_worker,
        'pole2': id_object,
        'pole3': year,
        'pole4': month
    },
    success: function(html){
        show_zarplata(id_object,year,month)
    }
});}

function edit_avans(hh)
{$.ajax({
    url: '../func/editcard_avans.php',
    method: 'POST',
    data:{
        'edava': hh
    },
    success: function(html){
        show_avans();
        $("#block_avans").html(html);
    }
});}

function dellete_workers(hii)
{$.ajax({
    url: '../func/deletecard.php',
    method: 'POST',
    data:{
        'delwor': hii
    },
    success: function(html){
        show();
        $("#block_workers").html(html);
    }
});}

