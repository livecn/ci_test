<?php $this->layout('layouts::frontend/base') ?>

<div class="container">
    <?= $this->section('header') ?>
    <div class="navbar navbar-default navbar-fixed-top">
        <?php $this->insert('partials::frontend/header') ?>
    </div>
    <div class="bs-docs-section">
        <section class="content">
            <?= $this->section('content') ?>
        </section>
        <footer>
            <?php $this->insert('partials::frontend/footer') ?>
        </footer>
    </div>
</div>



