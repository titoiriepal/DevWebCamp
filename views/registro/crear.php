<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo ?></h2>
    <p class="registro__descripcion">Elige tu plan</p>

    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Gratuito</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
            </ul>
            <p class="paquete__precio">0€</p>

            <form method="POST" action="/finalizar-registro/gratis">
                <input type="submit" value="Inscripción Gratis" class="paquetes__submit">
            </form>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a Talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y bebida</li>
            </ul>
            <p class="paquete__precio">199€</p>
            <div id="smart-button-container">
            <div style="text-align: center;">
                <div id="paypal-button-container"></div>
            </div>
</div>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Enlace a Talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
            </ul>
            <p class="paquete__precio">49€</p>
        </div>

    </div>
</main>

<script src="https://www.paypal.com/sdk/js?client-id=AelfqyoVOx5IsrKSSMBIOBqxSTcgw7I4Fu0rNrFj804O63uMeQgpWtcp2mVjRf3DSEhy8F8FwguXaaNC&enable-funding=venmo&currency=EUR" data-sdk-integration-source="button-factory"></script>
 
<script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"1","amount":{"currency_code":"EUR","value":199}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
 

            const datos = new FormData();
            datos.append('paquete_id', orderData.purchase_units[0].description);
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

            fetch('/finalizar-registro/pagar',{
                method: 'POST',
                body: datos
            }).then( respuesta => respuesta.json())
            .then(resultado =>{
                if(resultado.resultado){
                    actions.redirect('http://localhost:3000/finalizar-registro/conferencias');
                }
            })
            
            // Full available details
            //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
 
            // Show a success message within this page, e.g.
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '';
            // element.innerHTML = '<h3>Muchas gracias por tu compra</h3>';
 
            // Or go to another URL:  actions.redirect('thank_you.html');
            
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
 
  initPayPalButton();
</script>


<!-- <script src="https://www.paypal.com/sdk/js?client-id=BAAbf7TQQzxx9HizFhdT1VAjReT10-DHpRGIXdisJyAufBq4Ig6DtOom3-wxhwXRKzEtCeAl4Dl9Q62tBA&components=hosted-buttons&disable-funding=venmo&currency=EUR"></script>

<script>
  paypal.HostedButtons({
    hostedButtonId: "48KXHCHS2ZZSQ",
  }).render("#paypal-container-48KXHCHS2ZZSQ")
</script> -->