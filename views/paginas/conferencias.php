<main class="agenda">
    <h2 class="agenda__heading">Worshops y Conferencias</h2>
    <p class="agenda__descripcion">Talleres y conferencias dictados por expertos en desarrollo web</p>

    <div class="eventos">
        <h3 class="eventos__heading">&lt;Conferencias /></h3>
        <p class="eventos__fecha">Sábado 7 de Diciembre</p>

        <div class="eventos__listado slider swiper">

            <div class="swiper-wrapper">
                <?php 
                    foreach($eventos['conferencias_s'] as $evento){ 
                        include __DIR__ . '../../templates/evento.php';
                    } 
                ?>
            </div> 

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>

        <p class="eventos__fecha">Domingo 8 de Diciembre</p>

        <div class="eventos__listado slider swiper">

            <div class="swiper-wrapper">
                <?php 
                    foreach($eventos['conferencias_d'] as $evento){ 
                        include __DIR__ . '../../templates/evento.php';
                    } 
                ?>
            </div> 

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

    </div>


    <div class="eventos eventos--workshops">
        <h3 class="eventos__heading">&lt;Workshops /></h3>
        <p class="eventos__fecha">Sábado 7 de Diciembre</p>

        <div class="eventos__listado slider swiper">

            <div class="swiper-wrapper">
                <?php 
                    foreach($eventos['workshops_s'] as $evento){ 
                        include __DIR__ . '../../templates/evento.php';
                    } 
                ?>
            </div> 

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <p class="eventos__fecha">Domingo 8 de Diciembre</p>

        <div class="eventos__listado slider swiper">

            <div class="swiper-wrapper">
                <?php 
                    foreach($eventos['workshops_d'] as $evento){ 
                        include __DIR__ . '../../templates/evento.php';
                    } 
                ?>
            </div> 

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

    </div>
</main>