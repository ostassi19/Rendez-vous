function rv_(id, role) {

    //console.log(id, role);
    //$('#loader').show();
    $.ajax({
        type:"GET",
        data_:{
            id_medecien: id,
            role: role
        },
        url: "/rendez/vous/ajouter?id_medecien="+id+"&role="+role+"&date=&commentaire=",
        cache: !1,
        success: function(data) {
            //console.log(data, data == 1);
            if (data == 1){
                $("#myModal").modal('show');
                //$("#loader").hide();
            } else window.location.href = '/login';
            //$('#form_ajout_fourniture').html(data);

        }
    });
}

function patient_ajouter_(action = false) {

    let name = action ? $('#name').val() : '';
    let username = action ? $('#username').val() : '';
    let email = action ? $('#email').val() : '';
    let password = action ? $('#password').val() : '';
    let newpassword = action ? $('#newPassword').val() : '';

    //if ( name != '' && username != '' && email != '' && password != '' && newpassword != ''){
    $.ajax({
        type:"GET",
        data:{
          name: name,
          username: username,
          email: email,
          password: password,
          newpassword: newpassword,
        },
        url: "/patient/ajouter?id_medecien="+"&role="+"&date=&commentaire=",
        cache: !1,
        success: function(data) {
            $('#patient_a').html(data);
            $('#patient_ajouter').modal('show');
        }
    });
}
