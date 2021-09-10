<!-- Header -->
<header class="header">
    <!-- Contenedor del Header -->
    <div class="header__container">
        <!-- Datos del Perfil - Posible Imagen de Logo-->
        <div class="header__image">
            <a href="<?= $this->Url->build('/projects/list') ?>">
                <?= $this->Html->image('LogoKirebe.jpg', ['class' => 'header__img','alt' => 'Kirebe']); ?>
            </a>
        </div>

        <!-- Botón de Menu -->
        <div class="header__toggle">
            <i class="fas fa-bars" id="header-toggle"></i>
        </div>

    </div>

</header>