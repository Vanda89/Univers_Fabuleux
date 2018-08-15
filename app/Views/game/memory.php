<?php $this->layout('layout', ['title' => 'Memory',
                                'gameStyle' => 'memory', ]); ?>

<main class="row mt-2 mb-5">
  <section id="memory-container" class="game-container container d-flex flex-column justify-content-start align-items-center">
    <hgroup class="game-header row d-flex flex-column justify-content-center align-items-center mb-5">
      <h1 class="text-capitalize">memory</h1>
      <p class="instructions mb-5">Retourne une carte et trouve sa paire.</p>
    </hgroup>
    
  </section>
</main>

<?php $this->push('js'); ?>
<script src="<?= $basePath; ?>/js/memory.js"></script>
<?php $this->end(); ?>