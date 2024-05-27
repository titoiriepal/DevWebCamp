<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo ?></h2>
    <p class="auth__texto">Coloca tu nuevo password</p>

    <?php 
        
        require_once __DIR__ . '/../templates/alertas.php';

        if($token_valido){
    ?>

    <form class="formulario" method="POST">
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Nuevo Password</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Tu nuevo Password"
                id="password"
                name="password"
            />
        </div>

        </div>

        <input type="submit" class="formulario__submit" value="Cambiar Password">

        <div class="acciones">
            
            <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Crea una</a>

        </div>

    </form>

    <?php 
        } 
    ?>
</main>