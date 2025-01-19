<main class="contenedor seccion contenido-centrado">

    <?php if($mensaje === true){ ?>
        <p class='alerta exito'>Mensaje enviado Correctamente</p> 
    <?php }else if($mensaje === false) { ?>
        <p class="alerta error">El mensaje no se pudo enviar</p>
    <?php }?>


    <h1>Contacto</h1>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen contacto">
    </picture>

    <h2>Llene el formulario de Contacto</h2>

    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input
                id="nombre"
                type="text"
                name="nombre"
                placeholder="Tu Nombre"
                required
            >


            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <select name="opciones" id="opciones" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input 
                id="presupuesto" 
                type="number"
                name="presupuesto" 
                placeholder="Tu Precio o Presupuesto"
                required
            >
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input 
                    name="contacto" 
                    id="contactar-telefono" 
                    type="radio" 
                    value="telefono"
                    required
                >
                <label for="contactar-email">E-mail</label>
                <input 
                    name="contacto" 
                    id="contactar-email" 
                    type="radio" 
                    value="email"
                    required
                >
            </div>
            
            <div id="contacto"></div>


        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>