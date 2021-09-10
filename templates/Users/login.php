<!-- 
    //Comentario Darío ***********************************************************
    //Autenticación de Usuarios Paso # 10. Ver Paso # 11 en Templates → Layout → Default.php
    /**
     * Se agregan la vista de usuario para el login.
     * Este código está relaciodo con:  || * Model → Entity → Users || * Model → Table → Users
     * Controlador: AppController. || * Controlador: UsersController  */
-->
<?= $this->Html->css(['login']) ?>
<?= $this->Flash->render('auth') ?>

<div class="center">
    <h1> Inicio de Sesión</h1>
    <?= $this->Form->create() ?>
        <div class="campoTexto">
            <input type="email" name="email" id="email" required>
            <span></span>
            <label for="email">Correo Electrónico</label>
        </div>
        <div class="campoTexto">
            <input type="password" name="password" id="password" required>
            <span></span>
            <label for="password">Contraseña</label>
        </div>
        <input type="submit" value="Ingresar">
    <?= $this->Form->end() ?>
</div>