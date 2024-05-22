<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo ?></h2>
    <p class="auth__texto">Recupera tu acceso a WebDevCamp</p>

    <form class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Tu email"
                id="email"
                name="email"
            />
        </div>

        </div>

        <input type="submit" class="formulario__submit" value="Enviar Instrucciones">

        <div class="acciones">
            
            <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Crea una</a>

        </div>

    </form>
</main>