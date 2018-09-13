<?php $this->layout('layout', ['title' => 'Memory',
                                'gameStyle' => 'memory', ]); ?>

<main class="row mb-5">
  <section id="memory-container" class="game-container container d-flex flex-column justify-content-start align-items-center">
    <hgroup class="game-header row d-flex flex-row flex-sm-column justify-content-center align-items-center text-center mb-2">
      <h1 id="memory-title" class="game-title text-capitalize">memory</h1>
      <p class="instructions mt-1 mb-2">Retourne une carte et trouve sa paire.</p>
    </hgroup>
    
  </section>
</main>

<?php $this->push('js'); ?>
<script src="<?= $basePath; ?>/js/memory.js"></script>
<?php $this->end(); ?>