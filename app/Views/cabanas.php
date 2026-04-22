<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2 class="text-center mb-5">🌲 Nuestras Cabañas</h2>

<div class="row g-4">

<?php foreach ($cabanas as $cabana): ?>

    <div class="col-md-4 d-flex">
        <div class="card shadow w-100 h-100">

            <!-- Imagen -->
            <img src="<?= base_url('assets/img/' . $cabana['imagen']) ?>" 
                 class="card-img-top img-cabana" 
                 alt="Imagen cabaña">

            <!-- Contenido -->
            <div class="card-body d-flex flex-column">

                <h5 class="card-title"><?= $cabana['nombre'] ?></h5>

                <p class="card-text flex-grow-1">
                    <?= $cabana['descripcion'] ?>
                </p>

                <p class="fw-bold text-success fs-5">
                    $<?= $cabana['precio'] ?> / noche
                </p>

               <?php if (session()->get('usuario_id')): ?>

    <a href="<?= site_url('reservar/' . $cabana['id']) ?>" 
       class="btn btn-success w-100 mt-2">
       Reservar
    </a>

<?php else: ?>

    <a href="<?= site_url('login') ?>" 
       class="btn btn-secondary w-100 mt-2">
       🔐 Iniciar sesión para reservar
    </a>

<?php endif; ?>

            </div>
        </div>
    </div>

<?php endforeach; ?>

</div>

<?= $this->endSection() ?>