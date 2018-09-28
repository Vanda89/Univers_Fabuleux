var memory = {
  // Niveau de difficulté
  mode: null,
  // Nombre total de paires de cartes sur le plateau
  totalPair: 0,
  // Nombre de paires trouvées
  playerPair: 0,
  // Tableau pour stocker les cartes révélées
  cardsReveal: [],
  // Permet d'afficher ou non une nouvelle carte
  canShowingCard: true,
  // Démarrage du jeu
  gameStart: false,
  // 
  playerGameTime: new Timer(),

  playerTime: null,


  init: function () {
    // Lancement du jeu
    memory.startGame();
  },

  // Génère le conteneur 'game' en HTML et appelle createMenu()
  startGame: function () {
    $('<div>').attr('id', 'memory')
      .addClass('game d-flex flex-column justify-content-between align-items-center')
      .appendTo('#memory-container')

    memory.createMenu();
  },

  // Permet de mélanger le tableau de cartes
  shuffleCards: function (array) {
    for (var i = array.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var x = array[i];
      array[i] = array[j];
      array[j] = x;
    }
    return array;
  },

  // Génère en HTML des boutons de difficulté et de leur conteneur, et ajoute sur eux des évènements
  // pour avoir la difficulté appropriée
  createMenu: function () {
    $('<div>').addClass('difficulty-container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-around align-items-center')
      .append($('<div>')
        .attr('id', 'easy')
        .addClass('btn mb-4 mr-lg-2')
        .text('Facile'))
      .append($('<div>')
        .attr('id', 'normal')
        .addClass('btn mb-4 mr-lg-2')
        .text('Normal'))
      .append($('<div>')
        .attr('id', 'hard')
        .addClass('btn  mb-4 mr-lg-2')
        .text('Difficile'))
      .appendTo('#memory');
   
    $('#easy').click(function () {
      memory.createBoard('easy')
    });
   
    $('#normal').click(function () {
      memory.createBoard('normal')
    });
    $('#hard').click(function () {
      memory.createBoard('hard')
    });
  },

  // Supprime l'interface du menu pour générer le board avec association 
  // de la difficulté du jeu avec les paramètres grâce aux objets
  createBoard: function (level) {
    memory.gameStart = true;
    memory.playerGameTime.start();
  
    $('.difficulty-container').remove();

    var easy = {
      timer: 240,
      board: 12,
      mode: 'Facile',
    };
    var normal = {
      timer: 300,
      board: 18,
      mode: 'Normal',
    };
    var hard = {
      timer: 360,
      board: 24,
      mode: 'Difficile',
    };
    var timer;
    var cardsNumber;

    switch (level) {
      case 'easy':
        timer = easy.timer;
        cardsNumber = easy.board;
        memory.mode = easy.mode;
        break;
      case 'normal':
        timer = normal.timer;
        cardsNumber = normal.board;
        memory.mode = normal.mode;
        break;
      case 'hard':
        timer = hard.timer;
        cardsNumber = hard.board;
        memory.mode = hard.mode;
        break;
    }

    memory.totalPair = cardsNumber / 2;

    $('<div>')
      .attr('id', 'memory-board')
      .addClass('game-board d-flex flex-wrap justify-content-around align-items-center col-sm-10 col-xl-8')
      .appendTo('#memory')

    memory.generateCards(cardsNumber);
    memory.score();
    memory.startTimer(timer);

  },

  // Génère les cartes avec la bonne taille, association par paire, mélange de la pile 
  // et les ajoute sur le plateau
  generateCards: function (cardsBoard) {
    var cards = [];
    var cardsSize = 100;
    // sprite Css ajouté + 100 pour une image
    var backgroundPos = 0;
    var pair = 1;
    var id = 1;
    for (var cardNumber = 0; cardNumber < cardsBoard; cardNumber++) {
     
      cards[cardNumber] = $('<div>')
        .addClass('card')
        .on('click', memory.showCard)
        .data('id', id)
        .data('isPair', false)
        .append($('<div>').addClass('flipper')
          .append($('<div>').addClass('card-back'))
          .append($('<div>').addClass('card-front').css('background-position', '0px ' + backgroundPos + 'px')));
      pair++;

      if (screen.width >= 1440) {
        cardsSize = 100;
      } else if (window.screen.width >= 1024) {
        cardsSize = 100;
      } else if (window.screen.width >= 768) {
        cardsSize = 75;
      } else if (window.screen.width < 768) {
        cardsSize = 100;
      }
      
      if (pair > 2) {
        backgroundPos += cardsSize;
        pair = 1;
        id++
      }
    }
  
    memory.shuffleCards(cards);
   
    cards.forEach(function (card) {
      card.appendTo('#memory-board');
    })
  },

  // Fait apparaître directement les cartes avec un effet de flip si les conditions sont bonnes
  // data = isPair empêche un nouvel affichage si une paire est trouvée
  showCard: function () {
    
    if (!$(this).data('isPair') && memory.cardsReveal.length < 2 && memory.canShowingCard) {
      $(this).data('isPair', true);
      $(this).addClass('flip');
      $(this).addClass('flip');
      // Ajoute une carte révélée en mémoire
      memory.cardsReveal.push($(this));
    }
    // S'il y a 2 cartes en mémoire et si on peut plus cliqué sur une autre carte, les cartes sont comparées
    if (memory.cardsReveal.length === 2 && memory.canShowingCard) {
      memory.isSameCards();
    }
  },
 
  isSameCards: function () {
    var delayClean = 2600;
    var delayShowResult = 350;

    // Compare si les deux cartes révélées ont le même id
    if (memory.cardsReveal[0].data('id') === memory.cardsReveal[1].data('id')) {
      memory.canShowingCard = false;
      memory.playerPair++;

      // Affiche le message de victoire et incrémente le score
      setTimeout(function () {
        memory.showResult(true);
        memory.updateScore();
      }, delayShowResult);

      // Efface le message et passe à une autre lettre
      setTimeout(function () {
        $('.resultMessage').text('');
        memory.canShowingCard = true;
      }, delayClean);


      // Teste si le nombre total de paires trouvé est égal au nombre total de paires sur le plateau et si true...
      // Affiche le tableau de score et envoit  les stats en Ajax
      if (memory.playerPair === memory.totalPair) {
        setTimeout(function () {
          memory.showEndResult();
          memory.sendStatsInAjax(memory.mode, memory.currentIndex, memory.playerTime);
        }, delayShowResult);
      }

      // Réinitialise les cartes actuelles pour les comparer en mémoire
      memory.cardsReveal = [];

    } else {
        setTimeout(function () {
          // Affiche le message de défaite
          memory.showResult(false);
        }, delayShowResult);
        memory.canShowingCard = false;

      // Efface le message
      setTimeout(function () {
        $('.resultMessage').text('');
      }, delayClean);

      // Cache les cartes
      setTimeout(memory.hideCard, delayClean);
    }
  },

  // Cache les cartes avec un effet de flip
  // data = isPair empêche un nouvel affichage si une paire est trouvée
  hideCard: function () {
    for (var card = 0; card < memory.cardsReveal.length; card++) {
      memory.cardsReveal[card].removeClass('flip');
      memory.cardsReveal[card].removeClass('flip');
      memory.cardsReveal[card].data('isPair', false);
      memory.canShowingCard = true;
    }
    // Réinitialise les cartes actuelles pour les comparer en mémoire
    memory.cardsReveal = [];
  },

  // Lancement de l'animation de la barre servant de timer, quand elle est finie affiche le tableau de score
  startTimer: function (timer) {
    $('<div>').addClass('game-timer align-self-start mb-5').appendTo('#memory');
    $('.game-timer').animate({
      width: "100%"
    }, timer * 1000, memory.showEndResult)
  },

  // Génération HTML du score et des messages de réussites ou d'échec
  score: function () {
    $('<div>').attr('id', 'memory-infos').addClass('game-infos d-flex flex-column-reverse align-items-center justify-content-around text-center my-3')
      .append($('<div>')
        .addClass('resultMessage'))
      .append($('<div>').attr('id', 'memory-score-container').addClass('score-container d-flex flex-row justify-content-around')
        .append($('<div>')
          .addClass('score pr-1'))
        .append($('<i>')
          .addClass('star fas fa-star d-flex')))
      .appendTo('#memory-board');
    $('.score').text(memory.playerPair);
  },

  // Incrémentation du score
  updateScore: function () {
    $('.score').text(memory.playerPair);
  },

  // Remplissage des messages de réussite ou d'échec avec animation du texte
  showResult: function (isWin) {
    if (isWin === true) {
      $('.resultMessage').text('bravo').removeClass('pulse flash').addClass('win animated tada infinite');
    } else {
      $('.resultMessage').text('essaye encore !').removeClass('flash tada').addClass('tryAgain animated pulse infinite');
    }
  },

  // Méthode de fin de jeu effaçant le plateau et le timer, et affichant le tableau de score ainsi que le bouton 'Rejouer'
  showEndResult: function () {
    console.log('showendresult');

    if (memory.gameStart === true) {
      memory.gameStart = false;
      memory.playerTime = memory.playerGameTime.getTimeValues().toString();
      console.log(memory.playerTime);

      memory.playerGameTime.stop();
      $('#memory-board').remove();
      $('.game-timer').remove();

      $('<div>').attr('id', 'memory-end-result').addClass('end-game-infos d-flex flex-column align-items-center justify-content-between')
        .append($('<div>')
          .addClass('messageEndGame d-flex flex-column justify-content-around text-center')
          .append($('<p>').addClass('bravo animated tada text-uppercase mb-0').text('Bravo')))
        .append($('<div>').addClass('score-container d-flex flex-row justify-content-around my-3')
          .append($('<p>')
            .addClass('score pr-1')
            .text(memory.playerPair))
          .append($('<i>')
            .addClass('star fas fa-star d-flex')))
        .append($('<button>')
          .addClass('btn replay animated pulse infinite d-flex justify-content-center align-items-center text-uppercase mb-3 mb-lg-0 py-3')
          .text('rejouer'))
        .appendTo('#memory');

      $('.replay').click(function () {
        memory.resetGame();
      });
    }
  },

  // Méthode remise à zéro des paramètres et relancement du jeu
  resetGame: function () {
    $('#memory').remove();
    memory.playerPair = 0;
    memory.totalPair = 0;
    memory.canShowingCard = true;
    memory.cardsReveal = [];

    memory.startGame();
    memory.updateScore();
  },

  // Envoi des statistiques en Ajax pour qu'ils soient introduits en bdd
  sendStatsInAjax: function () {
    $.ajax({
      url: "./setStats",
      method: 'POST',
      dataType: 'json',
      data: {
        'game': 'Memory',
        'mode': memory.mode,
        'score': memory.playerPair,
        'time': memory.playerTime
      }
    }).done(function (response) {
      console.log(response);
    });
  },

};

$(memory.init);