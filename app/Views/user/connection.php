<?php $this->layout('layout', ['title' => 'Connexion']); ?>

<main class="row mt-2 mb-5">
  <section class="form-container container d-flex flex-column align-items-center col-xs-12 col-md-10 col-xl-7 my-5 p-0">
    <header class="section-header row justify-content-center align-self-center text-capitalize mt-5 mb-3">
      <h2 id="connection-title" class="section-title text-center font-weight-bold">connexion</h2>
    </header>
    
    <div class="errors alert errors-hide row text-center px-2" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="errorsContent d-flex align-items-center justify-content-center text-center pt-2 pl-1"></div>
    </div>   

    <form action="" method="post" id="formLogin" class="connection-form row d-flex justify-content-around align-items-center p-0">
      <div class="container d-flex justify-content-around align-items-center p-0">
        <div class="row d-flex justify-content-around align-items-center col-md-8 p-0">
          <div class="form-group text-capitalize col-11 mt-3 mb-5 px-1">
            <label for="mail" class="mail"></label>
            <input type="email" class="mail form-control form-control-lg" name="mail" id="mail" placeholder="Adresse mail">
          </div>

          <div class="form-group col-11 mb-5 px-1">
            <label for="password" class="password"></label>
            <input type="password" class="password form-control form-control-lg" name="password" id="password" placeholder="Mot de passe">
          </div>
        </div>
      </div>
      <button type="submit" class="form-btn row btn btn-dark btn-lg mb-5" name="connection-btn">Connexion</button>
    </form>
  </section>
</main>

<?php $this->push('js'); ?>
<script src="<?= $basePath; ?>/js/app.js"></script>
<?php $this->end(); ?>
