	var socket = io.connect('https://'+server_url+':3000');
	socket.on('new_notification', function( data ) {
		if(data.user_id==user_id){
			var audio = new Audio('https://e-office.sumedangkab.go.id/socket/definite.mp3');
			audio.play();
			$.toast({
				heading: data.title,
				text: data.message,
				position: 'top-right',
				bgColor: '#6003C8',
				loaderBg:'#fff',
				icon: 'info',
				hideAfter: false, 
				stack: 6,
				url: data.link
			});
			
			// Push.Permission.request();
			// Push.create(data.title, {
			// 	body: data.message,
			// 	icon: "https://e-office.sumedangkab.go.id/data/logo/e.png",
			// 	onClick: function () {
			// 		window.focus();
			// 		window.location.href = data.link;
			// 		this.close();
			// 	}
			// });
		}
	});
	// socket.on('refresh_notification', function(data) {
	// 	if(data.user_id==user_id){
	// 		refresh_notification();
	// 	}
	// });
	// socket.on('refresh_all_notification', function() {
	// 	refresh_notification();
	// });