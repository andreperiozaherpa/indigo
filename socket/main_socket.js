
var socket = require( 'socket.io' );
var express = require('express');
var fs = require('fs');
var app = express();
var server = require('https').createServer({
	key: fs.readFileSync('sumedang.key'),
	cert: fs.readFileSync('sumedang.crt')
}, app);
var io = socket.listen( server );

var port = process.env.PORT || 3000;
server.listen(port, function () {
	console.log('Example app listening on port 3000! Go to https://localhost:3000/')
})
io.set('origins', '*:*');


var CronJob = require('cron').CronJob;

var job = new CronJob('0 */1 * * * *', function() {
	io.sockets.emit('refresh_all_notification');
	console.log("Refresed on 1 minute");
});
job.start();

io.on('connection', function (socket) {
	socket.on( 'new_notification', function( data ) {
		console.log("Ada verifikasi baru");
		io.sockets.emit('new_notification',data);
	});
	socket.on('refresh_notification', function(data) {
		console.log("Refresh Notifikasi For User ID "+data.user_id);
		io.sockets.emit('refresh_notification',data);
	});
	socket.on( 'refresh_all_notification', function() {
		console.log("Refresh All Notifikasi");
		io.sockets.emit('refresh_all_notification');
	});
});