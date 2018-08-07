<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$this->e($title); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Fichier Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
  <!-- Fichiers CSS -->
  <link rel="stylesheet" href="<?= $basePath; ?>/css/style.css" type="text/css">
  <!-- Favicon -->
  <!-- <link rel="icon" href="/images/favicon.png" type="image/x-icon"> -->
  <!-- Fichier Fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
</head>

<body>
  <div class="main-wrapper container flex-column justify-content-between col-12">
    <header class="row d-flex justify-content-center align-items-center my-3">
      
       <?= $this->insert('partials/nav'); ?>

       <?= $this->insert('partials/hidden-nav'); ?>

    </header>

   <?= $this->section('content'); ?>

      <footer class="page-footer row d-flex flex-column py-4 mt-4">
        <div class="footer-copyright text-light text-center font-weight-bold py-3">&COPY; 2018 Copyright</div>
      </footer>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
  <!-- Fichier JS -->
  <script src="<?= $basePath; ?>/js/app.js"></script>
</body>

</html>