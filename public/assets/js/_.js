//fonction existant au niveau de la page de l'internaute
// elle permet à un patient connecté d'accéder à la page d'ajout d'un rendez-vous sinon
// on aura une redirection à la page authentification
function rv_(id, role,idM) {

    //console.log(id, role);
    //$('#loader').show();
    $.ajax({
        type:"GET",
        data:{
            id_medecien: idM,
            id_Patient: id,
            role: role
        },
        url: "/rendez/vous/ajouter",
        cache: !1,
        success: function(data) {
           // console.log(data);
            //s'il y a un ulitisateur(patient) connecté alors on va ajouter un rendez-vous
            // sinon on aura une redirection à la page login
            if (data == 1){
                //$("#myModal").modal('show');
              // window.location.href = '/rendez/vous/new/'+id;
                //$("#loader").hide();
            } else window.location.href = '/login';
            //$('#form_ajout_fourniture').html(data);

        }
    });
}

//fonction permettant de créer un compte pour un patient donné
function patient_ajouter_(action = false, idMedecin) {

    //recupération des variables provenant de formulaire de sign up pour patient
    let name = action ? $('#name').val() : '';
    let username = action ? $('#username').val() : '';
    let email = action ? $('#email').val() : '';
    let password = action ? $('#password').val() : '';
    let newpassword = action ? $('#newPassword').val() : '';
    if ( password === newpassword ) {
        $.ajax({
            type: "GET",
            data: {
                name: name,
                username: username,
                email: email,
                password: password,
                newpassword: newpassword,
                id : idMedecin,
            },
            url: "/patient/ajouter",
            cache: !1,
            success: function (data) {
              //  console.log(name, username, email, password, newpassword);
                $('#patient_a').html(data);
                $('#patient_ajouter').modal('show');
            }
        });
    } else {
        password = null;
        newpassword = null;
    }
}

function liste(idPatient, idMed) {
console.log(idPatient);
    $.ajax({
        type: "GET",
        data: {
            id_medecien: idMed,
            id_Patient: idPatient
        },
        url:"/rendez/vous/"+idPatient+"/patient",
        //cache: !1,
        success: function (data) {
            //window.location.href = "/rendez/vous/"+idPatient+"/patient";
        }
    })
}

function rv_libre(date) {
    //console.log($('#heure_rv').val());
    $.ajax({
        type: "GET",
        data:{
            date: $('#heure_rv').val()
        },
        url: '/rendez/vous/libre',
        success: function (res) {
            $('#rv_libre').html(res);
        }
    })
}
function envoyer_rv() {

    rv_heur = $('#heure').val();
    date_rv = $('#heure_rv').val();

    $.ajax({
        type: "GET",
        url: '/rendez/vous/modifier/' + rv_heur + '/' + date_rv,
        success: function (res) {
            console.log(res);
            $('#myModal').modal('hide');
            //$('#rv_libre').html(res);
        }
    })
}