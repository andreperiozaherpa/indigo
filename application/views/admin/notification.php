

<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/push.js/bin/serviceWorker.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/push.js/bin/push.min.js"></script>
<script type="text/javascript">
	if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register('https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/push.js/bin/serviceWorker.min.js').then(function(registration) {
      // Registration was successful
      console.log('ServiceWorker registration successful with scope: ', registration.scope);
    }, function(err) {
      // registration failed :(
      console.log('ServiceWorker registration failed: ', err);
    });
  });
}

	$(document).ready(function() {
		Push.Permission.request();
		Push.create("Notifikasi", {
			body: "Tes Notifikasi",
			icon: "https://e-office.sumedangkab.go.id/data/logo/e.png",
			onClick: function () {
				window.focus();
				window.location.href = "https://www.google.com";
				this.close();
			}
		});
	});
</script>