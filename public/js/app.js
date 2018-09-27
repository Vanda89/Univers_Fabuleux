var app = {

  init: function () {
    console.log('init app');

    // Soumission de tous les formulaires
    $('#formLogin').on('submit', {
      url: "./loginSubmit"
    }, app.submitForm);

    $('#formSignup').on('submit', {
      url: "./signupSubmit"
    }, app.submitForm);

    $('#saveProfile').on('submit', {
      url: "./profile/save"
    }, app.submitForm);

    $('#changePassword').on('submit', {
      url: "./profile/password"
    }, app.submitForm);

    $('#addContent').on('submit', {
      url: "./profile/addContent"
    }, app.submitFiles);

  },

  // Méthode contenant une méthode $.ajax() qui permet de contrôler le traitement des données de type 'json' reçues des formulaires, d'afficher les modals de réussite ou d'erreurs à l'issus du traitement et de rediriger vers la route correspondante.
  submitForm: function (evt) {
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

      var $errorsDiv = $('.errors');
      var $content = $errorsDiv.find('.errorsContent');

      // Inscription 
      if (response.code == 1 && response.type === 'signup') {
        $errorsDiv.removeClass('alert-danger').addClass('alert-success');
        $content.html('Inscription réussie');
        $errorsDiv.show();

        var urlToRedirect = response.redirect;
        window.setTimeout(function () {
          location.href = urlToRedirect;
        }, 2500);
      }

      // Connexion
      else if (response.code == 1 && response.type === 'login') {
        $errorsDiv.removeClass('alert-danger').addClass('alert-success d-flex justify-content-between');
        $content.html('Connexion réussie');
        $errorsDiv.show();

        var urlToRedirect = response.redirect;
        window.setTimeout(function () {
          location.href = urlToRedirect;
        }, 2500);
      }

      // Enregistrement des données de la page de profil
      else if (response.code == 1 && response.type === 'saveProfile') {
        $errorsDiv.removeClass('alert-danger').addClass('alert-success');
        $content.html('Vos données ont bien été mises à jour');
        $errorsDiv.show();

        var urlToRedirect = response.redirect;
        window.setTimeout(function () {
          location.href = urlToRedirect;
        }, 2500);
      }

      // Change le mot de passe
      else if (response.code == 1 && response.type === 'changePassword') {
        $errorsDiv.removeClass('alert-danger').addClass('alert-success');
        $content.html('Votre mot de passe a bien été modifié');
        $errorsDiv.show();

        var urlToRedirect = response.redirect;
        window.setTimeout(function () {
          location.href = urlToRedirect;
        }, 2500);
      }

      // Sinon, il y a des erreurs à afficher
      else {
        $errorsDiv.addClass('alert-danger');
        // Effaçage des anciennes
        $content.html("");
        console.log(response);

        // Parcours des erreurs retournées par l'appel Ajax et création de la div pour y mettre le contenu qui sera insérer dans le DOM
        $.each(response.errorList, function (index, value) {
          var $currenterrorDiv = $('<div>').html = value + '<br>';
          $content.append($currenterrorDiv);
        });
        $errorsDiv.show();
        console.log($content);
      }
    });
  },

  // Méthode contenant une méthode $.ajax() qui permet de contrôler le traitement des données de type 'files' reçues du formulaire d'ajout de contenu, d'afficher les modals de réussite ou d'erreurs à l'issus du traitement et de rediriger vers la route correspondante.
  submitFiles: function (evt) {
    evt.preventDefault();
    var formData = new FormData(this);

    console.log(evt);

    $.ajax({
      url: evt.data.url,
      type: 'POST',
      enctype: "multipart/form-data",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
    }).done(function (response) {
      console.log(response);

      var $errorsDiv = $('#errors');
      var $content = $errorsDiv.find('.errorsContent');

      if (response.code == 1 && response.type === 'addContent') {
        $errorsDiv.removeClass('alert-danger').addClass('alert-success');
        $content.html('Le fichier a bien été envoyé');
        $errorsDiv.show();

        var urlToRedirect = response.redirect;
        window.setTimeout(function () {
          location.href = urlToRedirect;
        }, 2500);
      }

      else {
        $errorsDiv.addClass('alert-danger');
        $content.html("");
        console.log(response);

         // Parcours des erreurs retournées par l'appel Ajax et création de la div pour y mettre le contenu qui sera insérer dans le DOM
        $.each(response.errorList, function (index, value) {
          var $currenterrorDiv = $('<div>').html = value + '<br>';
          $content.append($currenterrorDiv);
        });
        console.log($content);
        $errorsDiv.show();
      }
    });
  },
};

$(app.init);