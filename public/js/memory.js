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

  gameStart: false,

  playerGameTime: new Timer(),

  playerTime: null,



  init: function () {
    console.log('memory init');
    // Lancement du jeu
    memory.startGame();

  },

  startGame: function () {

    // Génère le conteneur 'game' en HTML
    $('<div>').attr('id', 'memory')
      .addClass('game d-flex flex-column justify-content-between align-items-center')
      .appendTo('#memory-container')

    // Génère le menu 
    memory.createMenu();
  },

  shuffleCards: function (array) {
    // Permet de mélanger le tableau de cartes
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
    // Ajout d'un événement aux boutons pour générer le jeu avec la difficulté memoryropriée
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

  createBoard: function (level) {
    memory.gameStart = true;
    memory.playerGameTime.start();
    // Supprime l'interface précédente
    $('.difficulty-container').remove();

    // Objets servant à paramètrer le jeu
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

    // Associe la difficulté du jeu avec les paramètres
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
    // Génération du plateau de jeu avec HTML la taille appropriée
    $('<div>')
      .attr('id', 'memory-board')
      .addClass('game-board d-flex flex-wrap justify-content-around align-items-center col-sm-10 col-xl-8')
      .appendTo('#memory')
    // Ajoute les cartes au plateau
    memory.generateCards(cardsNumber);
    // 
    memory.score();
    // Et lance le compteur
    memory.startTimer(timer);

  },

  generateCards: function (cardsBoard) {
    var cards = [];
    var cardsSize = 100;
    // sprite Css ajouté + 100 pour une image
    var backgroundPos = 0;
    // Pour l'association de cartes par paires
    var pair = 1;
    var id = 1;
    for (var cardNumber = 0; cardNumber < cardsBoard; cardNumber++) {
      // Génération HTML des cartes
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
      // Association des cartes par paire.
      if (pair > 2) {
        backgroundPos += cardsSize;
        pair = 1;
        id++
      }
    }
    // Mélange de la pile de cartes
    memory.shuffleCards(cards);
    // Et les ajoute sur le plateau
    cards.forEach(function (card) {
      card.appendTo('#memory-board');
    })
  },

  showCard: function () {
    // Fait apparaître directement les cartes avec un effet de flip si les conditions sont bonnes
    // data = isPair empêche un nouvel affichage si une paire est trouvée
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

    // console.log(memory.playerPair); 
    // console.log(memory.totalPair);
    console.log(memory.cardsReveal[0].data('id'));
    console.log(memory.cardsReveal[1].data('id'));


    // Compare si les deux cartes révélées ont le même id
    if (memory.cardsReveal[0].data('id') === memory.cardsReveal[1].data('id')) {
      memory.canShowingCard = false;
      memory.playerPair++;

      setTimeout(function () {
        // Affiche le message de victoire
        memory.showResult(true);
        memory.updateScore();
      }, delayShowResult);

      // Efface le message
      setTimeout(function () {
        $('.resultMessage').text('');
        memory.canShowingCard = true;
      }, delayClean);


      // Teste si le nombre total de paires trouvé est égal au nombre total de paires sur le plateau
      if (memory.playerPair === memory.totalPair) {
        setTimeout(function () {
          // Affiche le tableau de score
          memory.showEndResult();
          memory.sendStatsInAjax(memory.mode, memory.currentIndex, memory.playerTime);
        }, delayShowResult);
      }

      // Réinitialise les cartes actuelles pour les comparer en mémoire
      memory.cardsReveal = [];

    } else {
      // Empêche de cliquer sur une autre carte
      memory.canShowingCard = false;
      setTimeout(function () {
        // Affiche le message de défaite
        memory.showResult(false);
      }, delayShowResult);

      // Efface le message
      setTimeout(function () {
        $('.resultMessage').text('');
      }, delayClean);

      // Cache les cartes
      setTimeout(memory.hideCard, delayClean);
    }
  },

  hideCard: function () {
    // Cache les cartes avec un effet de flip
    // data = isPair empêche un nouvel affichage si une paire est trouvée
    for (var card = 0; card < memory.cardsReveal.length; card++) {
      memory.cardsReveal[card].removeClass('flip');
      memory.cardsReveal[card].removeClass('flip');
      memory.cardsReveal[card].data('isPair', false);
      memory.canShowingCard = true;
    }
    // Réinitialise les cartes actuelles pour les comparer en mémoire
    memory.cardsReveal = [];
  },

  startTimer: function (timer) {
    // Quand le compteur est fini, le jeu est fini
    $('<div>').addClass('game-timer align-self-start mb-5').appendTo('#memory');
    $('.game-timer').animate({
      width: "100%"
    }, timer * 1000, memory.showEndResult)
  },

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

    // this.score = this.currentIndex;
    $('.score').text(memory.playerPair);

  },

  updateScore: function () {
    $('.score').text(memory.playerPair);
  },

  // Messages après fin du jeu
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

  resetGame: function () {
    // Réinitialise tout le jeu
    $('#memory').remove();
    memory.playerPair = 0;
    memory.totalPair = 0;
    memory.canShowingCard = true;
    memory.cardsReveal = [];
    //restarting game
    memory.startGame();
    memory.updateScore();
  },

  // Méthode permettant l'envoi des statistiques
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