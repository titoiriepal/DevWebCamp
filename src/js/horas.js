(function(){
    const horas = document.querySelector('#horas');
    if(horas){



        const categoria = document.querySelector('[name= "categoria_id"]')
        const dias = document.querySelectorAll('[name= "dia"]');
        const inputHiddenDia = document.querySelector('[name= "dia_id"]');
        const inputHiddenHora = document.querySelector('[name= "hora_id"]');

        categoria.addEventListener('change', terminoBusqueda);
        dias.forEach( dia => dia.addEventListener('change', terminoBusqueda))


        let busqueda = {
            categoria_id: +categoria.value || '',
            dia: +inputHiddenDia.value || ''
        }

        
        if(!Object.values(busqueda).includes('')){ //Si hay algún campo vacío en el objeto de busqueda

            async function MarcarHoraSeleccionada () {
              await buscarEventos();

             //Resaltar la hora actual
            const horaSeleccionadaid = inputHiddenHora.value;
            const horaSeleccionada = document.querySelector(`[data-hora-id="${horaSeleccionadaid}"]`);
            horaSeleccionada.classList.remove('horas__hora--deshabilitada');  
            horaSeleccionada.classList.add('horas__hora--seleccionada'); 
            horaSeleccionada.onclick = seleccionarHora; 
            }

            MarcarHoraSeleccionada();
            

        }

       

        function terminoBusqueda(e){
            
        
            busqueda[e.target.name] = e.target.value;

            //Reiniciar los campos ocultos y la hora seleccionada
            inputHiddenHora.value = '';
            inputHiddenDia.value = '';
            const horaAnterior = document.querySelector('.horas__hora--seleccionada');
            if(horaAnterior){
                horaAnterior.classList.remove('horas__hora--seleccionada');
            }
            
            if(Object.values(busqueda).includes('')){ //Si hay algún campo vacío en el objeto de busqueda
                return;
            }
            buscarEventos();
            
        }

        async function buscarEventos(){
            const{dia, categoria_id} = busqueda;

            const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`
           

            const resultado = await fetch(url);
            const eventos = await resultado.json();
            
            
            obtenerHorasDisponibles(eventos);

        }

        function obtenerHorasDisponibles(eventos){

            //Comprobar eventos ya tomados y quitar la variable de deshabilitado

            const horasTomadas = eventos.map (evento => evento.hora_id);


            const listadoHoras = document.querySelectorAll('#horas li');
            listadoHoras.forEach(li => {
                    li.classList.add('horas__hora--deshabilitada');
                    li.removeEventListener('click', seleccionarHora);
                
                });
            const listadoHorasArray = Array.from(listadoHoras);

            const resultado = listadoHorasArray.filter( li => !horasTomadas.includes(li.dataset.horaId));
            resultado.forEach( li => li.classList.remove('horas__hora--deshabilitada'));

            const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');
            horasDisponibles.forEach(hora => hora.addEventListener('click', seleccionarHora))
        }

        function seleccionarHora(e){

            //Deshabilitar la hora previa si existe
            const horaAnterior = document.querySelector('.horas__hora--seleccionada');
            if(horaAnterior){
                horaAnterior.classList.remove('horas__hora--seleccionada');
            }

            // Agregamos clase de seleccionado
            e.target.classList.add('horas__hora--seleccionada');

            inputHiddenHora.value = e.target.dataset.horaId;

            //LLenamos el campo oculto del dia

            inputHiddenDia.value = document.querySelector('[name = "dia"]:checked').value;
            
        }
    }
})();
