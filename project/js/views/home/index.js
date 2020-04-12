var oYApp = new yApp();                                                                             // elemento html del framework

/* Only register a service worker if it's supported */
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/labs/artists/service-worker.js');
}

window.addEventListener('beforeinstallprompt', (event) => {
  console.log('x2', 'beforeinstallprompt', event);
  // Stash the event so it can be triggered later.
  window.deferredPrompt = event;
  // Remove the 'hidden' class from the install button container
  divInstall.classList.toggle('hidden', false);
});

window.addEventListener('appinstalled', (event) => {
  console.log('x4', 'appinstalled', event);
});

butInstall.addEventListener('click', () => {
  console.log('x3.1', 'butInstall-clicked');
  const promptEvent = window.deferredPrompt
  if (!promptEvent) {
    // The deferred prompt isn't available.
    return;
  }
  // Show the install prompt.
  promptEvent.prompt();
  // Log the result
  promptEvent.userChoice.then((result) => {
    console.log('x3', 'userChoice', result);
    // Reset the deferred prompt variable, since 
    // prompt() can only be called once.
    window.deferredPrompt = null;
    // Hide the install button.
    divInstall.classList.toggle('hidden', true);
  });
});

$( document ).ready( function() {
    //console.log( "Seteado con el framework" );

    // la vista se encarga de definir la ruta donde se encuentran los conjuntos de archivos con
    // dijerente contenido para el/los paneles
    // 2018.02.26 - esto fue desarrollado antes de la creacion de la clase de php para cada 
    // componente. De hecho, casi todos los componentes de layout no lo tienen implementado.
    //var s_path = sClie + "project/view/includes/panels/ficha/[view]_ajax.php";
    //YOBI.LAYOUT.PANEL_LEFT.ajax_path = s_path;
    //YOBI.LAYOUT.PANEL_RIGHT.ajax_path = s_path;

    //YOBI.APP.load_containers();
});

function formCallBack( jValo ) {
    var sForm = jValo.sForm;
    
    console.log( sForm )
    console.log( jValo );
            
    switch( sForm ) 
    {
        /*
        case "form_buscar":
            var s_url = sClie + "search?" + jValo.aDato.busqueda_valor;
            console.log( s_url );
            location.href = s_url;
            break; 
        */
        default:
        break;
    }
}