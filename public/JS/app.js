var app = {

  init: function () {
    console.log('init app');
    // $('.hidden-header').hide();

    $('body').scroll(function () {
      var positionNavbar = $('.hidden-tag')[0].getBoundingClientRect();
      
      if (positionNavbar.top < window.innerHeight - 750) {
        // console.log('hidden');   
        $('#hidden-header').removeClass('hide');

      } else {
        $('#hidden-header').addClass('hide');
      }

    });

    // Interception du form de connexion
    $('#formLogin').on('submit', {
      url: "./loginSubmit"
    }, app.submitForm);

    $('#formSignup').on('submit', {
      url: "./signupSubmit"
    }, app.submitForm);

    $('#saveProfile').on('submit', {
      url: "./profile/save"
    }, app.submitForm);
  },

  submitForm: function (evt) {
    console.log('init app');

    evt.preventDefault();
    var $currentForm = $(this);
    var formData = $currentForm.serialize();
    
    $.ajax({
      url: evt.data.url,
      method: 'POST',
      dataType: 'json',
      data: formData
    }).done(function (response) {
      console.log(response);

      var $errorsDiv = $('#errors') ;
      var $content = $errorsDiv.find('.errorsContent');


      // Inscription 
      if (response.code == 1 && response.type === 'signup') {
         // Ajout de  la classe danger

        $errorsDiv.removeClass('alert-danger').addClass('alert-success');
       // Affichage du message de succès
        $content.html('Inscription réussie');
       // Affichage de la div
        $errorsDiv.show();

        var urlToRedirect = response.redirect;

         // Redirection après 2 secondes
        window.setTimeout(function () {
          location.href = urlToRedirect;
        }, 2000);
      } 

      // Connexion
      else if (response.code == 1 && response.type  === 'login') {
        // Ajout de  la classe danger
        $errorsDiv.removeClass('alert-danger').addClass('alert-success');
        // Affichage du message de succès
        $content.html('Connexion réussie');
        // Affichage de la div
        $errorsDiv.show();

        var urlToRedirect = response.redirect;

        // Redirection après 2 secondes
        window.setTimeout(function () {
          location.href = urlToRedirect;
        }, 2000);
      }

      // Enregistrement des données de la page de profil
      else if (response.code == 1 && response.type  === 'saveProfile') {
        // Ajout de  la classe danger
        $errorsDiv.removeClass('alert-danger').addClass('alert-success');
        // Affichage du message de succès
        $content.html('Vos données ont bien été mises à jour');
        // Affichage de la div
        $errorsDiv.show();

        var urlToRedirect = response.redirect;

        // Redirection après 2 secondes
        window.setTimeout(function () {
          location.href = urlToRedirect;
        }, 2000);
      }
      

      // Sinon, il y a des erreurs à afficher
      else {
        console.log('non');

        // J'ajoute la classe danger
        $errorsDiv.addClass('alert-danger');
        // Je vide le contenu (anciennes erreurs)
        $content.html("");
        // Je parcours les erreurs retournées par l'appel Ajax
        $.each(response.errorList, function (index, value) {
          // Je crée un élément "div" avec du code html à l'intérieur
          var $currenterrorDiv = $('<div>', {
            html: value
          });
          // J'ajoute cet élément au DOM
          $content.append($currenterrorDiv);
        });
        // J'affiche la div
        $errorsDiv.show();
      }
      
    }).fail(function () {
      $('#alertBox').modal('show');
      $('#alertBox-text').text('Une erreur est survenue !');
    });
  },
};

$(app.init);