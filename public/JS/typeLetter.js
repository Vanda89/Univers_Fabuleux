var typeLetter = {
  // Niveau de difficulté
  mode: null,
  // Tableau pour stocker les lettres mélangées
  mixedLetters: [],
  // Index des lettres et score
  currentIndex: 0,
  // Lettre tapé par le joueur
  playerLetter: null,
  // Démarrage du jeu
  gameStart: false,
  // Possibilité de taper une lettre
  canTypeLetter : true,

  playerGameTime: new Timer(),

  playerTime: null,

  date: new Date(),

  init: function () {
    console.log('typeLetter init');
    typeLetter.gameStart = false;
   
    // Lancement du jeu
    typeLetter.startGame();
  },

  // Méthode de démarrage du jeu écoutant la touche tapé par le joueur
  startGame: function () {
    
      // Génère le conteneur 'game' en HTML
      $('<div>').attr('id', 'typeLetter')
        .addClass('game d-flex flex-column justify-content-between align-items-center')
        .appendTo('#typeLetter-container')
      // Génère le menu 
      typeLetter.createMenu();

    // Affectation des lettres mélangées au tableau mixedLetters
    typeLetter.mixedLetters = typeLetter.shuffleLetters(data.alphabetLetters);
    // console.log(typeLetter.mixedLetters);

    $('body').keyup(function (evt) {
      // console.log(evt.originalEvent.key);
      // console.log(typeLetter.canTypeLetter);
      
      // S'il peut taper une lettre et que c'est bien une lettre -> affichage
      if (typeLetter.canTypeLetter === true && typeLetter.isValidLetter(evt.originalEvent.key)) {
        $('#playerLetter').text(evt.originalEvent.key);

        // Si c'est la bonne lettre, on incrémente, on félicite et on modif le score
        if (typeLetter.isGoodLetter(evt.originalEvent.key)) { 
          typeLetter.currentIndex++;
          typeLetter.showResult(true);
          typeLetter.updateScore();

          
          // Teste si il reste encore des lettres à trouver
            setTimeout(function () {
            if (typeLetter.mixedLetters.length  != typeLetter.currentIndex) {
             typeLetter.updateLetters(typeLetter.mixedLetters[typeLetter.currentIndex]);
              $('#playerLetter').empty();
              $('.resultMessage').text('');
            }
            // Fin du jeu avec impossibilité d'inscrire une lettre 
            else {
              typeLetter.canTypeLetter = false;
              typeLetter.showEndResult();
              typeLetter.sendStatsInAjax(typeLetter.mode, typeLetter.currentIndex, typeLetter.playerTime);
            }
          }, 2200);
      
          // Si c'est pas la bonne lettre mais qu'il reste des lettres
        } else if (typeLetter.playerLetter != typeLetter.mixedLetters[typeLetter.currentIndex].letter && typeLetter.mixedLetters.length - 1 != typeLetter.currentIndex) {
          typeLetter.showResult(false);
        }

        // Empêche de taper une lettre avant l'analyse
         typeLetter.canTypeLetter = false;
         setTimeout(function () {
           typeLetter.canTypeLetter = true;
         }, 2500);

         // S'il peut inscrire une lettre mais que ce n'est pas une lettre
      } else if (typeLetter.canTypeLetter === true && (typeLetter.isValidLetter(evt.originalEvent.key) === false)) {
        $('.resultMessage').text('Appuie sur une lettre !').removeClass('pulse tada infinite').addClass('animated flash infinite');        
      }
    });
  },

  // Méthode permettant de mélanger le tableau de lettres
  shuffleLetters: function (array) {
    for (var i = array.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var x = array[i];
      array[i] = array[j];
      array[j] = x;
    }
    return array;
  },


  // Génération du menu avec les boutons de difficulté et des écouteurs d'événement dessus pour générer le jeu avec la difficulté appropriée
  createMenu: function () {
    $('<div>').addClass('difficulty-container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-around align-items-center mt-3')
      .append($('<button>')
        .attr('id', 'uppercase')
        .addClass('btn d-flex justify-content-center align-items-center mb-4 mb-lg-0')
        .text('A B C'))
      .append($('<button>')
        .attr('id', 'lowercase')
        .addClass('btn d-flex justify-content-center align-items-center my-4 my-lg-0')
        .text('a b c'))
      .appendTo('#typeLetter');

    $('#uppercase').click(function () {
      typeLetter.createBoard('uppercase')
    });
    $('#lowercase').click(function () {
      typeLetter.createBoard('lowercase')
    });
  },

  // Méthode permettant la génération du tableau correspondant au mode demandé
  createBoard: function (level) {
    typeLetter.gameStart = true;
    typeLetter.playerGameTime.start();
    // Supprime l'interface précédente
    $('.difficulty-container').remove();

    // this.timer = 6000;

    // Objets servant à paramètrer le jeu
    var uppercase = {
      timer: 300,
      textTransform: 'uppercase', 
      mode: 'Majuscules',
    };

    var lowercase = {
      timer: 360,
      textTransform: 'lowercase',
      mode: 'Minuscules',
    };
   
    var timer;
    var textTransform;
   
    // Associe la difficulté du jeu avec les paramètres
    switch (level) {
      case 'uppercase':
        timer = uppercase.timer;
        textTransform = uppercase.textTransform;
        typeLetter.mode = uppercase.mode;
        break;

      case 'lowercase':
        timer = lowercase.timer;
        textTransform = lowercase.textTransform;
        typeLetter.mode = lowercase.mode;
        break;
    }
    
    $('<div>').attr('id', 'typeLetter-board').addClass('game-board d-flex flex-column align-items-center justify-content-around mt-3')
      .append($('<div>')
        .attr('id', 'typeLetter-letters')
        .addClass('d-flex flex-column flex-lg-row align-items-center justify-content-around mb-3')
        .append($('<div>')
          .attr('id', 'letter')
          .addClass('playerLetters d-flex justify-content-center align-items-center mb-3 mb-lg-0')
          .css('textTransform', textTransform))
        .append($('<div>')
          .attr('id', 'playerLetter')
          .addClass('playerLetters d-flex justify-content-center align-items-center mt-3 mt-lg-0' )
          .css('textTransform', textTransform)))
      .append($('<div>').attr('id', 'typeletter-infos').addClass('game-infos d-flex flex-column-reverse align-items-center justify-content-around text-center my-3')
        .append($('<div>')
          .addClass('resultMessage'))
        .append($('<div>').attr('id', 'typeletter-score-container').addClass('score-container d-flex flex-row justify-content-around')
          .append($('<div>')
            .addClass('score pr-1'))
          .append($('<i>')
            .addClass('star fas fa-star d-flex'))))
      .append($('<div>').addClass('game-timer align-self-start mb-5').appendTo('#typeLetter'))
      .appendTo('#typeLetter');

    // Ajout des cartes au plateau, lancement du compteur de score et du timer
    typeLetter.updateLetters(this.mixedLetters[this.currentIndex]);
    typeLetter.score(this.currentIndex);
    typeLetter.startTimer(timer);
  },

  // Méthode permettant de passer à une autre lettre après l'avoir trouvée 
  updateLetters: function (currentIndex) {
    $('#letter').text(currentIndex['letter']);
  },

  // Méthode qui permet, dans la méthode startGame(), de vérifier si la touche appuyé est bien une lettre de l'alphabet
  isValidLetter: function (letter) {
    var alphabet = 'abcdefghijklmnopqrstuvwxyz';
    
    for (var value of alphabet) {
      if (letter === value) {
        console.log(value);
        return true    
      }
    }
    return false;
  },

  // Méthode qui permet, dans la méthode startGame(), de vérifier si la lettre appuyé est bien celle demandée
  isGoodLetter: function (playerLetter) {    
    return  playerLetter === this.mixedLetters[this.currentIndex].letter 
  },

  // Méthode de paramétrage du timer 
  startTimer: function (timer) {
    
    $('.game-timer').animate({
      width: "100%"
    }, timer * 1000, typeLetter.showEndResult);
  },

  // Méthode d'affichage du score
  score: function () {
    $('.score').text(typeLetter.currentIndex);

  },

   // Méthode permettant la mise à jour du score
  updateScore: function () {
    $('.score').text(typeLetter.currentIndex);
  },

  // Méthode permettant l'affichage des messages de résultat après chaque comparaison de lettres
  showResult: function (isWin) {
    if (isWin === true) {
      $('.resultMessage').text('bravo').removeClass('pulse flash').addClass('win animated tada infinite');
    } else {
      $('.resultMessage').text('essaye encore !').removeClass('flash tada').addClass('tryAgain animated pulse infinite');
    }
  },

  // Méthode de fin de jeu effaçant le plateau et affichant le tableau de score et le bouton 'Rejouer'
  showEndResult: function () {
    console.log('showendresult');

    if (typeLetter.gameStart === true) {
      typeLetter.gameStart = false;
      typeLetter.playerTime = typeLetter.playerGameTime.getTimeValues().toString();
      console.log(typeLetter.playerTime);
      
      typeLetter.playerGameTime.stop();
      $('#typeLetter-board').remove();
  
      $('<div>').attr('id', 'typeletter-end-result').addClass('end-game-infos d-flex flex-column align-items-center justify-content-around')
        .append($('<div>')
          .addClass('messageEndGame d-flex flex-column justify-content-around text-center')
          .append($('<p>').addClass('bravo animated tada text-uppercase').text('Bravo')))
        .append($('<div>').addClass('score-container d-flex flex-row justify-content-around my-3')
          .append($('<p>')
            .addClass('score pr-1')
            .text(typeLetter.currentIndex))
          .append($('<i>')
            .addClass('star fas fa-star d-flex')))
        .append($('<button>')
          .addClass('btn replay animated pulse infinite d-flex justify-content-center align-items-center text-uppercase mb-3 mb-lg-0 py-3')
          .text('rejouer'))
        .appendTo('#typeLetter');
  
  
      $('.replay').click(function () {
        typeLetter.resetGame();
      });
    }
  },

  // Méthode remise à zéro des paramètres et relancement du jeu
  resetGame: function () {
    $('#typeLetter').remove();
    typeLetter.currentIndex = 0;
    typeLetter.mixedLetters = [];
    typeLetter.canTypeLetter = true;
    // Relancement du jeu
    typeLetter.startGame();
    typeLetter.updateScore();
  },

  // Méthode permettant l'envoi des statistiques
  sendStatsInAjax: function () {
    $.ajax({
      url: "./setStats",
      method: 'POST',
      dataType: 'json',
      data: {
        'game': 'Tape-lettre',
        'mode': typeLetter.mode,
        'score': typeLetter.currentIndex,
        'time': typeLetter.playerTime,
      }
    }).done(function (response) {
        console.log(response);
    });
  },
};

$(typeLetter.init);