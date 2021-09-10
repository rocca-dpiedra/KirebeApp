(function () {

    //Función checkTime, se encarga de completar el formato de hora con un cero en caso de que lo requiera.
    function checkTime(i) {
        return (i < 10) ? "0" + i : i;
    }

    //Función Start Time.. crea los objetos de fecha necesarios para obtener los valores sobre los cuales va a trabajar.
    function startTime() {
        //Crea un objeto de tipo Date y actualiza la hora actual a través de la función check time.
        var today = new Date(),
            h = checkTime(today.getHours()),
            m = checkTime(today.getMinutes()),
            s = checkTime(today.getSeconds());

        //Escribe la hora en pantalla la hora actual.
        document.getElementById('time').innerHTML = h + ":" + m + ":" + s;

        //Configura recursividad para ejecutar la función cada determinado tiempo.
        t = setTimeout(function () {
            startTime()
        }, 500);
    }

    startTime();

})();