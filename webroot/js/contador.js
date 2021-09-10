(
    function () {

        //Función checkTime, se encarga de completar el formato de hora con un cero en caso de que lo requiera.
        function checkTime(i) {
            return (i < 10) ? "0" + i : i;
        }


        function transcurrido(){
            var dateInicio = document.querySelector(".horaInicio");
            var hora = dateInicio.textContent;
            var [hi, mi, si] = hora.split(':');
            var inicio = new Date();
            inicio.setHours(parseInt(hi), parseInt(mi), parseInt(si));
            var final = new Date();
            var diferencia = Math.abs(final - inicio);
            

            const ms = 1000;
            const msm = ms * 60;
            const msh = msm * 60;

            var h = checkTime(Math.floor(diferencia / msh));
            var m = checkTime(Math.floor((diferencia % msh) / msm));
            var s = checkTime(Math.floor((diferencia % msm) / ms));

            document.querySelector('.stTime').innerHTML =( h + ":" + m + ":" + s);

            //Configura recursividad para ejecutar la función cada determinado tiempo.
            t = setTimeout(function () {
                transcurrido()
            }, 500);
        }
        transcurrido();
    }
)();