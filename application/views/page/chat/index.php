<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!DOCTYPE html>
<html>
	<head>
		<title><?=$title?></title>
        <link href="<?= base_url('assets/css/chat.css') ?>" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

		<script src="<?= base_url('assets/js/plugins/vue.js') ?>"></script>
		<script type="text/javascript">
			window.App = {
				"baseUrl": "<?= base_url() ?>",
				"removeDOM": "",
			};
		</script>
	</head>
	<body>
		<div class="container-fluid h-100" id="chat_page">
			<input type="hidden" id="user_id" value="<?=sesdata('id')?>">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
							<input type="text" placeholder="Search..." name="" class="form-control search">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="card-body contacts_body">
						<ul class="contacts">
							<template v-for="(list,index) in userlist">
								<li @click="getChatMessages(list.user_id)">
									<div class="d-flex bd-highlight">
										<div class="img_cont">
											<img v-bind:src="'data:image/jpeg;base64,'+list.photo" class="rounded-circle user_img">
											<span class="online_icon"></span>
										</div>
										<div class="user_info">
											<span>{{list.username}}</span>
											<p>{{list.firstname}} {{list.lastname}}</p>
										</div>
									</div>
								</li>
							</template>
						</ul>
					</div>
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div id="chat_header" class="card-header msg_head" style="display:none;">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img v-bind:src="'data:image/jpeg;base64,'+to_userdata.photo" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Chat with {{to_userdata.firstname}} {{to_userdata.lastname}}</span>
									<p>{{chatmessagescount}} Messages</p>
								</div>
							</div>
						</div>
						<div id="chat_body" class="card-body msg_card_body" style="display:none;">
							<template v-for="(list,index) in chatmessages">
								<!-- FROM USER -->
								<div v-if="list.from_user_id==user_id" class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										{{list.message_text}}
										<span class="msg_time_send">8:55 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img v-bind:src="'data:image/jpeg;base64,'+from_userdata.photo" class="rounded-circle user_img_msg">
									</div>
								</div>
								<!-- TO USER -->
								<div v-else class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img v-bind:src="'data:image/jpeg;base64,'+to_userdata.photo" class="rounded-circle user_img_msg">
									</div>
									<div class="msg_cotainer">
										{{list.message_text}}
										<span class="msg_time">8:40 AM, Today</span>
									</div>
								</div>
							</template>
						</div>
						<div id="chat_footer" class="card-footer" style="display:none;">
							<div class="input-group">
								<textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="<?= base_url("assets/template/plugins/jquery/jquery.min.js") ?>"></script>

	<script src="<?= base_url('assets/js/plugins/axios.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/script.js') ?>"></script>
	<?php if (!empty($js)) : ?>
		<?php foreach ($js as $j) : ?>
			<script src="<?= base_url('assets/js/' . $j . '?ver=') . filemtime(FCPATH) ?>"></script>
		<?php endforeach ?>
	<?php endif ?>		

	</body>
</html>