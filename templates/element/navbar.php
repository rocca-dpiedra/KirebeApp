<!-- Navegación -->
<div class="nav" id="navbar">
    <nav class="nav__container">
        <div>
            <a href="<?= $this->Url->build('/users/miPerfil') ?>" class="nav__link nav__logo">
                <i class="fas fa-compact-disc nav__icon"></i>
                <span class="nav__logo-name"> <?= $current_user['fullname']?> </span>
            </a>
            
            <div class="nav__list">
                <!-- Subtitulo Información-->
                <h3 class="nav__subtitle"> Información</h3>
                <div class="nav__info">
                    <i class="far fa-clock nav__icon"></i>
                    <span class="nav__name">Hora: </span>
                    <div id="time">

                    </div>  
                </div>
                <?php if($activo) : ?>
                    <div class="nav__info-group">
                        <div class="nav__info">
                            <i class="fas fa-play nav__icon"></i>
                            <span class="nav__name">Inicio:</span>
                            <p class="horaInicio"><?= $registro['starttime'] ?></p>
                        </div>
                        <div class="nav__info">
                            <i class="fas fa-stopwatch nav__icon"></i>
                            <span class="nav__name">Duración:</span>
                            <p class="stTime"> </p>
                        </div>
                    </div>
                <?php  endif ; ?>

                <!-- Subtitulo Menú -->
                <?php if($current_user['role'] !== 'usuario'): ?>
                <h3 class="nav__subtitle"> Menú</h3>
                <!-- Usuarios -->
                <div class="nav__dropdown">
                    <a href="#" class="nav__link">
                    <i class="fas fa-users nav__icon"></i>
                        <span class="nav__name">Usuarios</span>
                        <i class="fas fa-chevron-circle-down nav__icon nav__dropdown-icon"></i>
                    </a>
                    <!-- SubMenú de Usuarios -->
                    <div class="nav__dropdown-collapse">
                        <div class="nav__dropdown-content">
                            <a href="<?= $this->Url->build('/users/add') ?>" class="nav__dropdown-item"> Crear Usuario</a>
                            <a href="<?= $this->Url->build('/users/index') ?>" class="nav__dropdown-item"> Lista de Usuarios</a>
                        </div>
                    </div>
                </div>
                <!-- Proyectos -->
                <div class="nav__dropdown">
                    <a href="#" class="nav__link">
                        <i class="fas fa-building nav__icon"></i>
                        <span class="nav__name">Proyectos</span>
                        <i class="fas fa-chevron-circle-down nav__icon nav__dropdown-icon"></i>
                    </a>
                    <!-- SubMenú de Usuarios -->
                    <div class="nav__dropdown-collapse">
                        <div class="nav__dropdown-content">
                            <a href="<?= $this->Url->build('/projects/add') ?>" class="nav__dropdown-item"> Crear Proyecto</a>
                            <a href="<?= $this->Url->build('/projects/index') ?>" class="nav__dropdown-item"> Lista de Proyectos</a>
                            <a href="<?= $this->Url->build('/projects/list') ?>" class="nav__dropdown-item"> Manejo de Sesiones</a>
                        </div>
                    </div>
                </div>

                <div class="nav__dropdown">
                    <a href="#" class="nav__link">
                        <i class="fas fa-database nav__icon"></i>
                        <span class="nav__name">Reportes</span>
                        <i class="fas fa-chevron-circle-down nav__icon nav__dropdown-icon"></i>
                    </a>

                    <div class="nav__dropdown-collapse">
                        <div class="nav__dropdown-content">
                            <a href="<?= $this->Url->build('/timelogs/projectRes') ?>" class="nav__dropdown-item"> Resumen Proyectos</a>
                            <a href="<?= $this->Url->build('/timelogs/userRes') ?>" class="nav__dropdown-item"> Resumen Usuarios</a>
                            <a href="<?= $this->Url->build('/timelogs/projectDetail') ?>" class="nav__dropdown-item"> Detalle Sesiones</a>
                            <a href="<?= $this->Url->build('/timelogs/activeList') ?>" class="nav__dropdown-item"> Sesiones Activas</a>
                            <a href="<?= $this->Url->build('/timelogs/repCustom') ?>" class="nav__dropdown-item"> Personalizado</a>
                        </div>

                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <a href="<?= $this->Url->build('/users/logout') ?>" class="nav__link nav__logout">
            <i class="fas fa-sign-out-alt nav__icon"></i>
            <span class="nav__name">Salir</span>
        </a>
    </nav>
</div>