// GENERAL
$('.envoyer_general').click(function(){
    var title = $('.input_title_general').val(),
        text = $('.input_text_general').val(),
        foot = $('.input_title_foot').val(),
        action = $.ajax({
            url: 'php/modif_general.php',
            type: 'POST',
            data: 'title=' + title + '&text=' + text + '&foot=' + foot
        });
    action.done(function(data){
        alert(data);
    });
});


function modifTextAll(id, tableName){
    $(location).attr("href", "php/modif.php?id=" + id + "&tableName=" + tableName);
}


// DEVOIRS
$('.ajouter_devoirs').click(function(){
    var block = $('.div_ajout_devoirs');
    if(block.css('display') == "none"){
        block.slideDown(300);
        $('.a_envoyer_devoirs').click(function(){
            var title = prompt('Title'),
                jour = prompt('Jour en Lettres'),
                j = prompt('Jour en chiffre'),
                m = prompt('Mois en Chiffre'),
                text = $('.textarea_devoirs').val(),
                action = $.ajax({
                    url: 'php/modif_devoirs.php',
                    type: 'POST',
                    data: 'title=' + title + '&text=' + text + '&action=add&jour=' + jour + '&date=' + j + '&month=' + m
                });
            action.done(function(data){
                $('.textarea_devoirs').val('');
                alert(data);
            });
        });
    }
    else{
        block.slideUp(300);
    }
});

function suppr_devoirs(tagid){
    if(prompt("Ecrire \"oui\" pour supprimer") == "oui"){
        var action = $.ajax({
            url: 'php/modif_devoirs.php',
            type: 'POST',
            data: 'id=' + tagid + '&action=suppr'
        });
        action.done(function(data){
            alert(data);
        });
    }
}



// QCM
$('.ajouter_qcm').click(function(){
    var block = $('.div_ajout_qcm');
    if(block.css('display') == "none"){
        block.slideDown(300);
        $('.a_envoyer_qcm').click(function(){
            var title = prompt('Title'),
                text = $('.textarea_qcm').val(),
                action = $.ajax({
                    url: 'php/modif_qcm.php',
                    type: 'POST',
                    data: 'title=' + title + '&text=' + text + '&action=add'
                });
            action.done(function(data){
                $('.textarea_qcm').val('');
                alert(data);
            });
        });
    }
    else{
        block.slideUp(300);
    }
});

function suppr_qcm(tagid){
    if(prompt("Ecrire \"oui\" pour supprimer") == "oui"){
        var action = $.ajax({
            url: 'php/modif_qcm.php',
            type: 'POST',
            data: 'id=' + tagid + '&action=suppr'
        });
        action.done(function(data){
            alert(data);
        });
    }
}

// Infos
$('.ajouter_infos').click(function(){
    var block = $('.div_ajout_infos');
    if(block.css('display') == "none"){
        block.slideDown(300);
        $('.a_envoyer_infos').click(function(){
            var title = prompt('Title'),
                text = $('.textarea_infos').val(),
                action = $.ajax({
                    url: 'php/modif_infos.php',
                    type: 'POST',
                    data: 'title=' + title + '&text=' + text + '&action=add'
                });
            action.done(function(data){
                $('.textarea_infos').val('');
                alert(data);
            });
        });
    }
    else{
        block.slideUp(300);
    }
});

function suppr_infos(tagid){
    if(prompt("Ecrire \"oui\" pour supprimer") == "oui"){
        var action = $.ajax({
            url: 'php/modif_infos.php',
            type: 'POST',
            data: 'id=' + tagid + '&action=suppr'
        });
        action.done(function(data){
            alert(data);
        });
    }
}

// MODOS DEVOIRS

function suppr_devoirs_modo(id){
    var action = $.ajax({
        url: "php/modo.php",
        type: "POST",
        data: 'id=' + id + '&action=del'
    });
    action.done(function(data){
        alert(data);
    });
}

function add_devoir_modo(id){
    var action = $.ajax({
        url: "php/modo.php",
        type: "POST",
        data: 'id=' + id + '&action=add'
    });
    action.done(function(data){
        alert(data);
    });
}



// PAGES



function charge_page(page){
    $('.pages_text').load('php/get_pages.php?url=' + page);
    charge('#pages');
}

var show = false;
function show_area_pages(){
    if(show){
        $('.pages_text_contain').css('display', 'block');
        $('.pages_form').css('display', 'none');
        show = false;
    }
    else{
        $('.pages_text_contain').css('display', 'none');
        $('.pages_form').css('display', 'block');
        show = true;
    }
    }
function envoyer_pages(url){
    var title = $('.pages_input_title').val(),
        text = encodeURIComponent($('.pages_area_text').val()),
        reff = prompt('Afficher dans le nav ? (oui - non)'),
        action = $.ajax({
            url: 'php/modif_pages.php',
            type: 'POST',
            data: 'action=modif&url=' + url + '&title=' + title + '&text=' + text + '&reff=' + reff
        });
        action.done(function(data){
            alert(data);
        });
}

function ajout_pages(){
    var title = prompt('Titre de la page ?'),
        reff = prompt('Afficher la page dans le menu de navigation ? (oui - non)'),
        confir = confirm('Créer la page ?');
    if(confir){
        var action = $.ajax({
            url: 'php/modif_pages.php',
            type: 'POST',
            data: 'action=add&title=' + title + '&reff=' + reff
        });
        action.done(function(data){
            alert(data);
        });
    }
    
}

function supprimer_pages(url){
    var confirm = prompt('Vraiment supprimer la page ? (oui - non)');
    if(confirm == "oui"){
        var action = $.ajax({
            url: "php/modif_pages.php",
            type: 'POST',
            data: 'action=delete&url=' + url
        });
        action.done(function(data){
            alert(data);
        });
    }
    else{
        alert('Annulé !');
    }
}
