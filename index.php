<!DOCTYPE html>
<html lang="en">
<head>
	<title>FitBot - AI Coursework 2 - By E227421 & E221345</title>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bot.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="chat-container">
		<div class="chat-header">
			FitBot
			<h5>This is a ChatBot for the domain of Fitness</h5>
		</div>
		<div class="chat-body">
			<div class="message bot">
				Hello! How can I assist you today?
			</div>
		</div>
		<div class="chat-footer">
			<input class="form-control" placeholder="Type a message..." type="text" autofocus>
			<button class="btn btn-primary" >Send</button>
		</div>
	</div>

	<div style="position: fixed; top: 0px; right: 0px; width: 100%;">
		<div class="card">
			<p style="text-align: center; margin-top: 10px;">This is FitBot, a chatbot for Health & Fitness related questions & Answeres. 
				<b>Developed by E227421 TK Mohanatheesan</b> and <b>E221345 Jaeson HBS</b>
				<a href="admin/" class="btn btn-sm btn-primary" target="_blank">Manage ChatBot</a>
				</p>
		</div>
	</div>

	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> 
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	
</body>
</html>

<script>
	$(document).ready(function() {
		$('.chat-footer button').click(function() {
			var message = $('.chat-footer input').val();
			if (message.trim() !== '') {
				$('.chat-body').append('<div class="message user">' + message + '</div>');
				// make input empty
				$('.chat-footer input').val('');
				$('.chat-body').scrollTop($('.chat-body')[0].scrollHeight);

				// get response
				//alert(message);
				$.ajax({
	                url: "manage.php",
	                method: "post",
	                data:{message:message},
	                success: function(data){
						//$('.chat-body').append('<div class="message bot">' + data + '</div>');
						$('.chat-body').append(data);
						$('.chat-body').scrollTop($('.chat-body')[0].scrollHeight);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.error("AJAX error: " + textStatus + ' : ' + errorThrown);
					}
				});
			}
		});

		$('.chat-footer input').keypress(function(e) {
			if (e.which == 13) {
				$('.chat-footer button').click();
			}
		});
	});

</script>