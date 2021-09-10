// SHOW NAV BAR

const showMenu = (headerToggle, navbarId) => {
    const toggleBtn = document.getElementById(headerToggle),
    nav = document.getElementById(navbarId);

    //Valida la existencias de las variables.
    if (headerToggle && navbarId){
        toggleBtn.addEventListener('click', () => {
            nav.classList.toggle('show-menu')

            //cambia el ícono.
            toggleBtn.classList.toggle('fa-window-close')
        })
    }
}

showMenu('header-toggle', 'navbar')

//LINK ACTIVO.
const linkColor = document.querySelectorAll('.nav__link');
function colorLink(){
    linkColor.forEach( l => l.classList.remove('active'));
    this.classList.add('active');
}

linkColor.forEach( l => l.addEventListener('click', colorLink));