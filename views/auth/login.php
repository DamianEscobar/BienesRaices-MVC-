<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST" class="formulario" action="/login">

        <fieldset>
            <legend>Cuenta</legend>

            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" placeholder="Tu E-mail" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Tu Password" required>

        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>

</main>