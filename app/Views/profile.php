<main class="row my-5">
  <section class="profile-container container d-flex flex-column align-items-center justify-content-between col-xs-12 col-md-10 col-xl-7 my-5 ">
    <header class="profile-form-header row d-flex justify-content-center align-self-center my-5">
      <h2 class="profile-form-title text-center text-capitalize font-weight-bold">espace personnel</h2>
    </header>
    <form action="" class="profile-form row d-flex justify-content-center mt-4">
      <div class="form-group container">
        <div class="row d-flex flex-column">
          <h3 class="title-category d-flex align-items-center justify-content-around mb-3">Profil de l'enfant</h3>
          <div class="form-row d-flex flex-column col-12">
            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="name" class="profile-form-label text-capitalize font-weight-bold mb-2">prénom :</label>
              <input type="text" class="form-control col-md-10" name="name" id="name" required="required">
            </div>
            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="age" class="profile-form-label font-weight-bold mb-2">Date de naissance :</label>
              <input type="date" class="form-control col-md-8 col-xl-8" name="age" id="age" required="required">
            </div>
            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="sex" class="profile-form-label text-capitalize font-weight-bold mb-2">sexe :</label>
              <select class="form-control col-md-10" id="sex" required>
                <option value="predef"></option>
                <option value="F" class="text-capitalize">fille</option>
                <option value="G" class="text-capitalize">garçon</option>
              </select>
            </div>
            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="wallpaper" class="profile-form-label font-weight-bold mb-2">Fond d'écran choisi :</label>
              <select class="form-control col-md-8 col-xl-8" id="wallpaper" required>
                <option value="predef"></option>
                <option value="" class="text-capitalize"></option>
                <option value="" class="text-capitalize"></option>
                <option value="" class="text-capitalize"></option>
                <option value="" class="text-capitalize"></option>
                <option value="" class="text-capitalize"></option>
                <option value="" class="text-capitalize"></option>
                <option value="" class="text-capitalize"></option>
                <option value="" class="text-capitalize"></option>
                <option value="" class="text-capitalize"></option>
              </select>
            </div>
            <div class="form-inline d-flex justify-content-start col-xs-10 col-md-12  mb-4">
              <label for="color" class="profile-form-label text-capitalize font-weight-bold mr-5 mb-2">couleur :</label>
              <input type="color" value="#fad345" name="color" id="color" class="form-control col-4 col-md-2 ml-2 p-2">
            </div>
          </div>
        </div>
      </div>
      <div class="form-group container mt-5">
        <div class="row d-flex flex-column align-items-center justify-content-around">
          <h3 class="title-category mb-3">Informations de compte</h3>
          <div class="form-row d-flex flex-column col-12">
            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="mail" class="profile-form-label font-weight-bold mb-2">Adresse mail actuelle :</label>
              <input type="email" class="form-control col-md-8 col-xl-8" name="mail" id="mail" required="required">
            </div>
            <div class="d-flex justify-content-start col-xs-10 col-md-12 mb-4">
              <input id="reset-pswd" class="form-control col-md-6 pl-1" type="button" value="Réinitialiser votre mot de passe" onclick="window.location.href='mailto:me@example.com'"
              />
            </div>
            <div class="form-inline d-flex justify-content-between col-xs-10 col-md-12 mb-4">
              <label for="color" class="profile-form-label font-weight-bold mb-2">Temps de connexion :</label>
              <input type="text" value="" id="connectionTime" class="form-control col-md-8 col-xl-8" readonly>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="profile-form-btn row btn btn-dark btn-lg text-capitalize mb-5" name="profile-btn">enregistrer</button>
    </form>

    <div class="row align-self-center d-flex justify-content-center my-5">
      <h3 class="title-category text-capitalize mb-4">statistiques</h3>
      <div class="container d-flex flex-column justify-content-center align-items-center align-items-lg-stretch col-lg-12">
        <div class="games-row row d-flex flex-column flex-md-row justify-content-around align-items-around ">
          <div id="game-1" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3 mr-2">
            <p id="score-game-1" class="text-capitalize">score</p>
            <p id="time-game-1" class="text-capitalize">time</p>
          </div>
          <div id="game-2" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3 mr-2">
            <p id="score-game-2" class="text-capitalize">score</p>
            <p id="time-game-2" class="text-capitalize">time</p>
          </div>
          <div id="game-3" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3">
            <p id="score-game-3" class="text-capitalize">score</p>
            <p id="time-game-3" class="text-capitalize">time</p>
          </div>
        </div>
        <div class="games-row row d-flex flex-column flex-md-row justify-content-around align-items-around">
          <div id="game-4" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3 mr-2">
            <p id="score-game-4" class="text-capitalize">score</p>
            <p id="time-game-4" class="text-capitalize">time</p>
          </div>
          <div id="game-5" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3 mr-2">
            <p id="score-game-5" class="text-capitalize">score</p>
            <p id="time-game-5" class="text-capitalize">time</p>
          </div>
          <div id="game-6" class="stats-game d-flex flex-column justify-content-center align-items-center mb-3">
            <p id="score-game-6" class="text-capitalize">score</p>
            <p id="time-game-6" class="text-capitalize">time</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>