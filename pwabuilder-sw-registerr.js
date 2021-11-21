// This is the service worker with the Cache-first network

// Add this below content to your HTML page, or add the js file to your page at the very top to register service worker

// Check compatibility for the browser we're running this in
if ("serviceWorker" in navigator) {
  if (navigator.serviceWorker.controller) {
    console.log("[PWA Builder] active service worker found, no need to register");
  } else {
    // Register the service worker
    navigator.serviceWorker
      .register("./pwabuilder-sw.js", {
        scope: "./"
      })
      .then(
			function(serviceWorkerRegistration) {
				serviceWorkerRegistration.pushManager.subscribe().then(
				  function(pushSubscription) {
					console.log(pushSubscription.subscriptionId);
					console.log(pushSubscription.endpoint);
					// Detail langganan push dibutuhkan aplikasi
					// server kini tersedia, dan dapat di kirimkan menggunakan,
					// XMLHttpRequest misalnya.
				  }, function(error) {
					// Pada saat pengembangan menampilkan log ke konsole sangatlah membantu
					// Di lingkungan produksi juga dapat bermanfaat untuk mengirimkan 
					// informasi error kembali ke aplikasi server.
					console.log(error);
				  }
				);
			}
		);
  }
  
  
  
}
