<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				

				<div class="card mb-3">
					<div class="card-body">

						
							<div class="form-group">
								<label for="name">Ke*</label>
								<input class="form-control" type="text" name="nama" id="to" placeholder="Ke...." />
								
							</div>


							<div class="form-group">
								<label for="name">Pesan</label>
								<textarea class="form-control" name="deskripsi" id="message" placeholder="Pesan..."></textarea>
							</div>

							<input class="btn btn-success" type="submit" name="btn" id="send" value="Send" />
							<div class="form-group">
								<label for="name">Pesan</label>
								<textarea class="form-control" name="deskripsi" id="log" placeholder=""></textarea>
							</div>
					</div>

					


				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<?php $this->load->view("admin/_partials/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->


		<?php $this->load->view("admin/_partials/scrolltop.php") ?>

		<?php $this->load->view("admin/_partials/js.php") ?>
		<script type="text/javascript">
			function startApp() {
				//create websocket client
				var client = new WebSocket("ws://192.168.43.1:8989");

				//onOpen handler
				client.onopen = function (event) {
					var log = document.getElementById("log");
					log.textContent = log.textContent + "\n" + "Koneksi ke server berhasil";	
				};

				//onClose handler
				client.onclose = function (event) {
					var log = document.getElementById("log");
					log.textContent = log.textContent + "\n" + "Koneksi ke server terputus";	
				};

				//onError handler
				client.onerror = function (event) {
					var log = document.getElementById("log");
					log.textContent = log.textContent + "\n" + "Koneksi ke server error";	
				};

				//onMessage handler
				client.onmessage = function (event) {
					var response = JSON.parse(event.data);

					switch (response.type) {
						case "success" :
						// suskses mengirim sms ke server
						alert(response.message);
						break;

						case "error" :
						// gagal mengirim sms ke server
						alert(response.message);
						break;

						case "notification" :
						// laporan status pengiriman sms
						var log = document.getElementById("log");
						if (response.success) {
							log.textContent = log.textContent + "\n" + "Laporan Sukses: "+ response.message;
						} else {
							log.textContent = log.textContent + "\n" + "Laporan gagal : "+ response.message;
						}
						break;

						case "received" :
						// menerima sms
						if (confirm("SMS dari" + response.from + " :\n"
							+ response.message + "\n" +
							"Apakah ingin dibalas?")) {
							document.getElementById("to").value = response.from;
						}
						break;
					}
				};

				// aksi tombol Send SMS
				document.getElementById("send").onclick = function (){
					//mengambil value no tujuan
					var to = document.getElementById("to").value;
					//mengambil value isi pesan SMS
					var message = document.getElementById("message").value;

					var splits = to.split(",");
					if (splits.length == 1) {
						// bukan broadcast

						//membuat json
					var json = {
						to: to,
						message: message
					};

					//mengirim ke server via websocket
					client.send(JSON.stringify(json));

					} else {
						//broadcast

						//membuat json broadcast
						var json = {
							to: splits,
							message: message
						};

						//mengirim ke server via websocket
						client.send(JSON.stringify(json));
					}
				}
			}
			window.onload = startApp;
		</script>
</body>
</html>