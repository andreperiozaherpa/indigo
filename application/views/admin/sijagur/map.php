<link href="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@turf/turf@5/turf.min.js"></script>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Sijagur</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li class="active">Monitoring</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-xl-9 col-lg-8">
			<div class="row">
				<div class="col-md-6">
					<div class="white-box">
						<h3 class="box-title">Pegawai terpantau</h3>
						<ul class="list-inline two-part">
							<li><i class="icon-user text-purple"></i></li>
							<li class="text-right">
								<span id="jmlPegawai">0</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="white-box">
						<h3 class="box-title">Pegawai Online</h3>
						<ul class="list-inline two-part">
							<li><i class="icon-user text-success"></i></li>
							<li class="text-right">
								<span id="jmlOnline">0</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="white-box">
						<h3 class="box-title">MONITORING KEPALA SKPD</h3>
						<div id='map' style='width: 100%; height: 500px;'></div>
						<script>
							// $(function() {
							mapboxgl.accessToken = 'pk.eyJ1Ijoia2hhbGlkaW5zYW4iLCJhIjoiY2t1eHRsYnJqMWp3YzJwcDZ4b2x1Njg5aiJ9.kd47yu7SHCwxHtwin8Qenw';
							const geojson = {
								'type': 'FeatureCollection',
								'features': [{
									'type': 'Feature',
									'geometry': {
										'type': 'Point',
										'coordinates': [107.9225288, -6.8324871]
									},
									'properties': {
										'title': 'Mapbox',
										'description': 'Map Posisi Kepala SKPD'
									}
								}]
							};
							const map = new mapboxgl.Map({
								container: 'map',
								style: 'mapbox://styles/mapbox/streets-v11',
								center: [107.9225288, -6.8324871],
								zoom: 13
							});

							var markerStore = {};
							var animatedMarker = {};

							var INTERVAL = 1000;

							function getMarkers() {
								$.get('<?= base_url() ?>sijagur/monitoring/markers', {}, function(data, resp) {
									let res = data.markers;
									let htmlPegawai = '';
									for (var i = 0, len = res.length; i < len; i++) {
										var marker_color = "#6003c8";
										var div_online = '<span class="text-muted">Terakhir dilihat :' + res[i].tanggal + ' ' + res[i].waktu + '</span>';
										var badge_online = '';
										if (res[i].online == "Y") {
											marker_color = "#28a745";
											div_online = '<span class="text-success">Sedang Online</span>';
											badge_online = '<span class="profile-status online pull-right"></span>';
										}
										//Do we have this marker already?
										if (markerStore.hasOwnProperty(res[i].id)) {
											// markerStore[res[i].id].setLngLat([res[i].position.long, res[i].position.lat]);
											animateMarker(markerStore[res[i].id], [res[i].position.long, res[i].position.lat], res[i].id, res[i].name);
											markerStore[res[i].id].getPopup().setHTML('<h5>Informasi Pegawai</h5><div style="display: flex; flex-direction:row"><div><img src="' + res[i].foto + '" alt="user-img" style=" object-fit: cover;width: 50px;height: 50px;border-radius: 50%;"></div><div style="margin-left:5px"><span class="text-purple" style="font-weight: 500;display:block">' + res[i].name + '</span><span>' + res[i].jabatan + '</span><br>' + div_online + '</div></div>');
											setMarkerColor(markerStore[res[i].id], marker_color);
										} else {
											const marker = new mapboxgl.Marker({
													"color": marker_color
												})
												.setLngLat([res[i].position.long, res[i].position.lat])
												.setPopup(
													new mapboxgl.Popup({
														offset: 25
													})
													.setHTML(
														'<h5>Informasi Pegawai</h5><div style="display: flex; flex-direction:row"><div><img src="' + res[i].foto + '" alt="user-img" style=" object-fit: cover;width: 50px;height: 50px;border-radius: 50%;"></div><div style="margin-left:5px"><span class="text-purple" style="font-weight: 500;display:block">' + res[i].name + '</span><span>' + res[i].jabatan + '</span><br>' + div_online + '</div></div>'
													)
												)
												.addTo(map);
											markerStore[res[i].id] = marker;
											animatedMarker[res[i].id] = false;
										}

										htmlPegawai += '<a id="pegawai'+res[i].id+'" href="javascript:void(0)" onclick="changePosition(' + res[i].id + ',\'' + res[i].position.lat + '\',\'' + res[i].position.long + '\')"><div class="user-img"> <img style="object-fit:cover;width:40px;height:40px" src="' + res[i].foto + '" alt="user" class="img-circle"> ' + badge_online + ' </div><div class="mail-contnet"><h5>' + res[i].name + '</h5><span class="mail-desc">' + res[i].jabatan + '</span> <span class="time">' + div_online + '</span></div></a>';
									}

									$('#jmlPegawai').html(data.summary.count);
									$('#jmlOnline').html(data.summary.online);
									$('#listPegawai').html(htmlPegawai);

									window.setTimeout(getMarkers, INTERVAL);
								}, "json");
							}

							getMarkers();



							function changePosition(id, latitude, longitude) {
								map.flyTo({
									center: [longitude, latitude],
									essential: true,
									zoom: 16 // this animation is considered essential with respect to prefers-reduced-motion
								});
								// console.log(id);
								const popups = document.getElementsByClassName("mapboxgl-popup");

								if (popups.length) {

									popups[0].remove();

								}
								markerStore[id].getPopup().addTo(map);
							}

							function setMarkerColor(marker, color) {
								var $elem = jQuery(marker.getElement());
								$elem.find('svg path[fill="' + marker._color + '"]').attr('fill', color);
								// marker._color = color;
							}


							function animateMarker(marker, newLocation, id, name) {
								//if location has changed
								// console.log([marker.getLngLat().lng, marker.getLngLat().lat] + ' ' + newLocation);
								if (!animatedMarker[id]) {
									currentLocation = [marker.getLngLat().lng, marker.getLngLat().lat];
									currentLocation[0] = parseFloat(currentLocation[0]);
									currentLocation[1] = parseFloat(currentLocation[1]);

									newLocation[0] = parseFloat(newLocation[0]);
									newLocation[1] = parseFloat(newLocation[1]);
									if (JSON.stringify(currentLocation) !== JSON.stringify(newLocation)) {
										console.log("BEGIN ANIMATE FOR " + name + "BECAUSE" + JSON.stringify(currentLocation) + " !== " + JSON.stringify(newLocation));
										
										var numDeltas = 10;
										var steps = 0;
										var deltaLat = 0;
										var deltaLng = 0;
										var position = [0, 0];
										var angle = 0;
										var deltaLng = 0;
										var deltaLat = 0;

										steps = 0;
										position = currentLocation;
										var lng = newLocation[0] - currentLocation[0];
										var lat = newLocation[1] - currentLocation[1];
										deltaLng = lng / numDeltas;
										deltaLat = lat / numDeltas;
										driveCar();


										function driveCar() {
											animatedMarker[id] = true;
											if (steps == numDeltas) {
												position[0] = newLocation[0];
												position[1] = newLocation[1];
											} else {
												position[0] += deltaLng;
												position[1] += deltaLat;
											}

											marker.setLngLat(position);
											console.log(steps + name + position);
											if (steps != numDeltas) {
												steps++;
												window.setTimeout(driveCar, 100);
												$('#pegawai'+id+' h5').addClass('text-purple');
											} else {
												animatedMarker[id] = false;
												$('#pegawai'+id+' h5').removeClass('text-purple');
											}
										};
									}
								}



							}


							// });
						</script>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-xl-3">
			<div class="white-box">
				<h3 class="box-title">Daftar Kepala SKPD</h3>
				<div class="message-center" id="listPegawai" style=" height: 665px;overflow-y: auto;">
				</div>
			</div>
		</div>
	</div>
</div>