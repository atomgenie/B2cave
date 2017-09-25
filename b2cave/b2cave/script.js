// PARTIE DEVOIRS

// Devoir fait
function ajout_fait(puce) {
    var action = $.ajax({
        url: '../php/modif_fait_devoir.php',
        type: "POST",
        data: 'id=' + puce + '&action=ajout'
    });
    action.done(function(data) {
        alertify.message(data);
        $('#all_devoirs').load('index.php #all_devoirs');
    });
}

function enlev_fait(puce) {
    var action = $.ajax({
        url: '../php/modif_fait_devoir.php',
        type: "POST",
        data: 'id=' + puce + '&action=enlev'
    });
    action.done(function(data) {
        alertify.message(data);
        $('#all_devoirs').load('index.php #all_devoirs');
    });
}

// Ajouter un devoir

function add_devoirs() {
    $('#in_surface').css('left', ($(window).width()) / 2 - 350);
    $('#in_surface').fadeIn(300);
    $('body').css('overflow', 'hidden');
    $('#surface').fadeIn(300);
}

function go_normal() {
    $('body').css('overflow', "inherit");
    $('#in_surface').fadeOut(300);
    $('#surface').fadeOut(300, function(){
                $('.surface_title').val('');
                $('.surface_jour_lettre').val('');
                $('.surface_jour_chiffre').val('');
                $('.surface_mois').val('');
                $('.surface_text').val('');
                $('#all_devoirs').load('index.php #all_devoirs');
            });
}

function envoyer_devoir() {
    var title = $('.surface_title').val(),
        jour = $('.surface_jour_lettre').val(),
        date = $('.surface_jour_chiffre').val(),
        mois = $('.surface_mois').val(),
        text = $('.surface_text').val(),
        check = $('.surface_check').is(":checked");

    if(title == "" || jour == "" || date == "" || mois == "" || text == ""){
        go_normal();
        return;
    }
    var action = $.ajax({
            url: '../php/modif_devoir.php',
            type: 'POST',
            data: 'title=' + title + '&jour=' + jour + "&date=" + date + '&mois=' + mois + '&text=' + text + '&check=' + check
        });
    action.done(function(data) {
        if(data == "yep"){
            go_normal();
            
        }
    });
}


// PARTIE NOTEPAD

function ajout_notepad() {
    alertify.prompt('Titre de la Note', 'Note', function(evt, data) {
        $('.hide_notepad').slideDown(300, function() {
            $('.textarea_notepad').focus();
        });
        $('.ajout_notepad_enr').click(function() {
            var text = $('.textarea_notepad').val(),
                action = $.ajax({
                    url: '../php/modif_notepad.php',
                    type: 'POST',
                    data: 'text=' + text + '&title=' + data + '&action=add'
                });
            action.done(function(data) {
                alertify.notify(data);
                $('.hide_notepad').slideUp(300, function() {
                    $('#all_notepad').load('index.php #all_notepad');
                    $('.hide_notepad').val('');
                });
            });
        });
    });
}


function suppr_notepad(iden) {
    alertify.confirm('Voulez-vous vraiment le supprimer ?', 'Oui', function() {
        var action = $.ajax({
            url: '../php/modif_notepad.php',
            type: 'POST',
            data: 'id=' + iden + '&action=suppr'
        });
        action.done(function(data) {
            alertify.notify(data);
            $('#all_notepad').load('index.php #all_notepad');
        });
    }, function() {
        alertify.notify('Annulé');
    });
}



function easteregg(){
    $('.alert').html('<embed src="images/projet.mp3" width=300 height=50 repeat="false" loop="false" /><br>Par Clément Davin');
}