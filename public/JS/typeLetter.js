var typeLetter = {
  // Niveau de difficulté
  mode: null,
  // 
  mixedLetters: [],
  // Tableau pour stocker les lettres associées
  currentIndex: 0,
  //
  playerLetter: null,

  // timer: null,

  gameStart: false,

  canTypeLetter : true,

  init: function () {
    
    console.log('typeLetter init');
    // Lancement du jeu
    typeLetter.startGame();
  },

  startGame: function () {
    typeLetter.gameStart = true;
    typeLetter.mixedLetters = typeLetter.shuffleLetters(data.alphabetLetters);
    // console.log(typeLetter.mixedLetters);

    $('body').keyup(function (evt) {
      // console.log(evt.originalEvent.key);
      // console.log(typeLetter.canTypeLetter);
      
      

      if (typeLetter.canTypeLetter === true && typeLetter.isValidLetter(evt.originalEvent.key)) {
        $('#playerLetter').text(evt.originalEvent.key);

        // Si c'est la bonne lettre
        if (typeLetter.isGoodLetter(evt.originalEvent.key)) {
          typeLetter.currentIndex++;

          setTimeout(function () {
            typeLetter.updateLetters(typeLetter.mixedLetters[typeLetter.currentIndex]);
            $('#playerLetter').empty();
            $('.resultMessage').text('');
          }, 1500);

          typeLetter.showResult(true);

          typeLetter.updateScore();

          if (typeLetter.mixedLetters.length - 1 === typeLetter.currentIndex) {

            setTimeout(function () {
              typeLetter.showEndResult();
            }, 1700);
          }

          // Si c'est pas la bonne lettre mais qu'il reste des lettres
        } else if (typeLetter.playerLetter != typeLetter.mixedLetters[typeLetter.currentIndex].letter && typeLetter.mixedLetters.length - 1 != typeLetter.currentIndex) {

          typeLetter.showResult(false);
        }
         typeLetter.canTypeLetter = false;

         setTimeout(function () {
           typeLetter.canTypeLetter = true;
         }, 2000);

      } else {
        $('.resultMessage').text('Appuie sur une lettre !').removeClass('pulse tada infinite').addClass('animated flash');        
      }
    });

    // Génère le conteneur 'game' en HTML
    $('<div>').attr('id', 'typeLetter')
      .addClass('game d-flex flex-column justify-content-between align-items-center')
      .appendTo('#typeLetter-container')

    // Génère le menu et démarre le jeu avec la difficulté appropriée
    typeLetter.createMenu();
    // typeLetter.createBoard();
  },

  shuffleLetters: function (array) {
    // Permet de mélanger le tableau de lettres
    for (var i = array.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var x = array[i];
      array[i] = array[j];
      array[j] = x;
    }
    return array;
  },

  createMenu: function () {
    // Génération en HTML des boutons de difficulté et de leur conteneur
    $('<div>').addClass('difficulty-container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-around align-items-center mt-5')
      .append($('<button>')
        .attr('id', 'uppercase')
        .addClass('btn d-flex justify-content-center align-items-center mb-4 mb-lg-0')
        .text('A B C'))
      .append($('<button>')
        .attr('id', 'lowercase')
        .addClass('btn d-flex justify-content-center align-items-center my-4 my-lg-0')
        .text('a b c'))
      .appendTo('#typeLetter');

    // Ajout d'un événement aux boutons pour générer le jeu avec la difficulté appropriée
    $('#uppercase').click(function () {
      typeLetter.createBoard('uppercase')
    });
    $('#lowercase').click(function () {
      typeLetter.createBoard('lowercase')
    });
  },

  createBoard: function (level) {
    // Supprime l'interface précédente
    $('.difficulty-container').remove();

    // this.timer = 6000;

    // Objets servant à paramètrer le jeu
    var uppercase = {
      timer: 4000,
      textTransform: 'uppercase', 
      mode: 'Majuscules',
    };

    var lowercase = {
      timer: 5000,
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

    console.log(textTransform);
    
    // Génération du plateau de jeu avec HTML 
    $('<div>').attr('id', 'typeLetter-board').addClass('game-board d-flex flex-column align-items-center justify-content-around mt-5')
      .append($('<div>')
        .attr('id', 'typeLetter-letters')
        .addClass('d-flex flex-column flex-lg-row align-items-center justify-content-around mb-5')
        .append($('<div>')
          .attr('id', 'letter')
          .addClass('playerLetters d-flex justify-content-center align-items-center mb-4 mb-lg-0')
          .css('textTransform', textTransform))
        .append($('<div>')
          .attr('id', 'playerLetter')
          .addClass('playerLetters d-flex justify-content-center align-items-center mt-4 mt-lg-0' )
          .css('textTransform', textTransform)))
      .append($('<div>').attr('id', 'typeletter-infos').addClass('game-infos d-flex flex-column-reverse align-items-center justify-content-around my-3')
        .append($('<div>')
          .addClass('resultMessage'))
        .append($('<div>').attr('id', 'typeletter-score-container').addClass('score-container d-flex flex-row justify-content-around')
          .append($('<div>')
            .addClass('score pr-1'))
          .append($('<i>')
            .addClass('star fas fa-star d-flex'))))
      .append($('<div>').addClass('game-timer align-self-start mb-5').appendTo('#typeLetter'))
      .appendTo('#typeLetter');

    // Ajout des cartes au plateau
    typeLetter.updateLetters(this.mixedLetters[this.currentIndex]);
    // Lancement du compteur
    typeLetter.score(this.currentIndex);
    //
    typeLetter.startTimer(timer);

  },

  updateLetters: function (currentIndex) {
    $('#letter').text(currentIndex['letter']);
  },

  isValidLetter: function (letter) {
    var alphabet = 'abcdefghijklmnopqrstuvwxyz';
    console.log(letter);
    
    for (var value of alphabet) {
      if (letter === value) {
        console.log(value);
        return true  
            
      }
    }

    return false;
  },

  isGoodLetter: function (playerLetter) {
    // console.log(playerLetter);
    console.log(this.mixedLetters.length);
    console.log(this.currentIndex);
    
    return  playerLetter === this.mixedLetters[this.currentIndex].letter && this.mixedLetters.length - 1 != this.currentIndex 

  },

  startTimer: function (timer) {
    // Quand le compteur est fini, le jeu est fini
    $('.game-timer').animate({
      width: "100%"
    }, timer * 60, typeLetter.showEndResult);
  },

  score: function () {
    // this.score = this.currentIndex;
    $('.score').text(typeLetter.currentIndex);

  },

  updateScore: function () {
    $('.score').text(typeLetter.currentIndex);
  },

  // Messages après fin du jeu
  showResult: function (isWin) {
    // console.log("Gagné !");
  
// (isWin === true) ? 'bravo !' : 'essaye encore !';
    if (isWin === true) {
      $('.resultMessage').text('bravo').removeClass('pulse flash infinite').addClass('win animated tada');
    } else {
      $('.resultMessage').text('essaye encore !').removeClass('flash tada').addClass('tryAgain animated pulse infinite');
    }
    
  },

  showEndResult: function () {
    $('#typeLetter-board').remove();

    $('<div>').attr('id', 'typeletter-end-result').addClass('end-game-infos d-flex flex-column align-items-center justify-content-between')
      .append($('<div>')
        .addClass('messageEndGame d-flex flex-column justify-content-around text-center')
        .append($('<p>').addClass('text-uppercase mb-0').text('Bravo !'))
        .append($('<p>').text('Ton score est de :')))
      .append($('<div>').addClass('score-container d-flex flex-row justify-content-around my-5')
        .append($('<p>')
          .addClass('score pr-1')
          .text(typeLetter.currentIndex))
        .append($('<i>')
          .addClass('star fas fa-star d-flex')))
      .append($('<button>')
        .addClass('replay')
        .addClass('btn animated pulse infinite d-flex justify-content-center align-items-center mb-4 mb-lg-0')
        .text('Rejouer'))
      .appendTo('#typeLetter');

    typeLetter.gameStart = false;

    $('.replay').click(function () {
      typeLetter.resetGame();
    });

  },

  // stopGame: function () {
  //   setTimeout(typeLetter.resetGame(), 100);
  // },

  resetGame: function () {
    $('#typeLetter').remove();
    typeLetter.currentIndex = 0;
    typeLetter.mixedLetters = [];
    typeLetter.canTypeLetter = true;
    // Relancement du jeu
    typeLetter.startGame();
    typeLetter.updateScore();
  }

}
$(typeLetter.init);