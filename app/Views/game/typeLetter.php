<?php $this->layout('layout', ['title' => 'Tape-lettre',
                                'gameStyle' => 'typeLetter.css', ]); ?>

<main class="row mt-2 mb-5">
  <section id="typeLetter-container" class="game-container container d-flex flex-column justify-content-start align-items-center">
    <header class="game-header row d-flex flex-row flex-sm-row justify-content-center align-items-center text-center mt-4 mb-5">
      <h1 id="typeLetter-title" class="game-title text-capitalize mb-3">Tape-lettre</h1>
      <p class="instructions">Retrouve la même lettre sur ton clavier et appuie dessus.</p>
    </header>


  </section>
</main>

<?php $this->push('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/easytimer@1.1.1/src/easytimer.min.js"></script>
<script src="<?= $basePath; ?>/js/data.js"></script>
<script src="<?= $basePath; ?>/js/typeLetter.js"></script>
<?php $this->end(); ?>