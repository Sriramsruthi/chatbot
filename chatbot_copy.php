<?php
session_start();
if($_SESSION['user_id']==NULL)
{
	$a=0;
}
else
{
	$a=1;
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Chat bot UI</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>
	<style type="text/css">
		li{
	top: 20px;
	list-style-type: none;
	margin:0px;
	padding: 0px;
background: #007bff none repeat scroll 0 0;
	color: #fff;
	border-radius: 10px;
	font-size: 14px;
	margin:0;
	color: #fff;
	padding: 5px 10px 5px 12px;
	width: 100%;
	
}
	</style>
	
</head>
<body>
	<div class="container-fluid">
		<div class="right" id="user_form">
			<label for="username">*Name:</label>
  		<input type="text" id="user_name" name="username" required><br><br>
  		<label for="email">Enter your email:</label>
  		<input type="email" id="email_id" name="email"><br><br>
  		<label for="phno">*Phone number:</label>
  		<input type="tel" id="phno" name="phone" placeholder="1234567890" pattern="[0-9]{10}" required><br><br>
  		<button id="user_data">Submit</button>
		</div>


		<div class="right" id="user_chat">

		<div class="msg-header">
			<div class="msg-header-img">
				<img src="bookmystall.jpg">
			</div>
			<div class="active">
				<h4>BookMyStall</h4>
				<h6>Online..</h6>
			</div>
			<div class="header-icons">
				<i class="fa fa-phone"></i>
				
				<i class="fa fa-info-circle" ></i>
				<button data-close-button class="close-button" id="btn_close">x</button>
			</div>
		</div>
	

	   <div class="chat-page">
		<div class="msg-inbox">
			<div class="chats">
				<div class="msg-page">  <!-- Dynamic content must be appended to this div -->

					<!-- Message from AI BOT -->
					<div class="received-chats">
						<div class="received-chats-img">
							<img src="bookmystall.jpg">
						</div>

						<div class="received-msg">
							<div class="received-msg-inbox">
								<p>Hello <?php echo $_SESSION['user_id'];?> how are you doing today !! This is message from BookMyStall</p>
								<span class="time">
									11:01 PM | October 11
								</span>
							</div>
						</div>
					</div>

					<!-- Message from User -->
					<div class="outgoing-chats" id="user-chat">
						<div class="outgoing-chats-msg">
							<div class="outgoing-msg-inbox">
								<ul id="messages">
								
							</ul>
								<span class="time">
									11:01 PM | October 11
								</span>
							</div>
						</div>
						<div class="outgoing-chats-img">
							<img src="bookmystall.jpg">

						</div>
				    </div>
			</div>
			</div>
		</div>


		<div class="msg-bottom">
			 <div class="bottom-icons">
				<i class="fa fa-plus-circle"></i>
				<i class="fa fa-camera"></i>
			  </div>

			 <div class="input-group">
				<input type="text" id="input_msg" class="form-control" placeholder="write message..." name="">
				<div class="input-group-append">
					<button type="button" class="button" id="speech_btn"><span class="input-group-text"><i class="fa fa-microphone"></i></span></button>
					<button type="button" class="button" id="send"><span class="input-group-text"><i class="fa fa-paper-plane"></i>
					</span></button>
				</div>
			</div>
		</div>
		</div>
	
</div>
<!-- <div class="chat_with_us">
<button data-modal-target="#modal" class="btn btn-success btn_chat" id="chat_btn">Chat with Us</button>
</div> -->

<div class="chat_with_us right" id="chat_btn1">
<button class="btn btn-success" id="chat_btn">Chat with Us</button>
<input type="text" name="" id="inp_txt" value='<?php echo $a; ?>' hidden>
</div>

</div>

 <!-- ===============AJAX CODE=========== -->

<script>
    
	$(document).ready(function(){
		var session=$('#inp_txt').val()
		$('#user_form').hide();
		$('#user_chat').hide();
		$('#chat_btn').click(function(){
			 $('#user_form').show();
			 $('#chat_btn').hide();
			});


		if(session==0)
		{
		$('#user_data').click(function(){
			 var name=$('#user_name').val();
			 var email=$('#email_id').val();
			 var phno=$('#phno').val();
			 // var details=$('#text').val();
			 // var number=/^[a-zA-Z0-9]*$/;
		  //    if(number.test(details));
			 console.log(name,email,phno);
			 if(name=='' || phno=='')
			 {
			 	alert('Please fill the fields');
			 }

			else{
			$.ajax({
				url:'chat_insert.php',
				method:'POST',
				data:{name:name,email:email,phno:phno},
				success:function(res){
					if(res==1)
					{

					$('#user_form').hide();
					$('#user_chat').show();

					}
					else
					{
						alert("Not Inserted");
					}

				}
			});
		}


		});
	}
	else
	{
		$('#user_chat').show();
	}

	$('#send').click(function(){
		var msg=$('#input_msg').val();
		$.ajax({
			url:'msg_insert.php',
			method:'POST',
			data:{msg:msg},
			success:function(res){

			}

		});
	});


	});
</script>


 <!-- ===========EMOJI CODE============== -->

<script>
$("#input_msg").emojioneArea({
   pickerPosition:"top"
});
</script>

<!-- =============Opening and Closing Code=========== -->

<!-- <script type="text/javascript">
	const openModalButtons = document.querySelectorAll('[data-modal-target]')
	const closeModalButtons = document.querySelectorAll('[data-close-button]')

	openModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = document.querySelector(button.dataset.modalTarget)
    openModal(modal)
  })
})
closeModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = button.closest('.right')
    closeModal(modal)
  })
})
	function openModal(modal) {
  if (modal == null) return
  modal.classList.add('active')
  // overlay.classList.add('active')
}
function closeModal(modal) {
  if (modal == null) return
  modal.classList.remove('active')
  // overlay.classList.remove('active')
}
</script>
 -->

<script type="text/javascript">
var messages = document.getElementById("messages");
var textbox = document.getElementById("input_msg");
var button = document.getElementById("send");

button.addEventListener("click", function(){
     var newMessage = document.createElement("li");
     newMessage.innerHTML = textbox.value;
     messages.appendChild(newMessage);
     textbox.value = "";
});
</script>


<!-- ========== Speech to Text Conversion Code====== -->
<script>
        var message = document.querySelector('#message');

        var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
        var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

        var grammar = '#JSGF V1.0;'

        var recognition = new SpeechRecognition();
        var speechRecognitionList = new SpeechGrammarList();
        speechRecognitionList.addFromString(grammar, 1);
        recognition.grammars = speechRecognitionList;
        recognition.lang = 'en-US';
        recognition.interimResults = false;

        recognition.onresult = function(event) {
            var last = event.results.length - 1;
            var command = event.results[last][0].transcript;
            alert(command);
			document.getElementById('input_msg').value=command;
   
        };

        recognition.onspeechend = function() {
            recognition.stop();
        };

        recognition.onerror = function(event) {
            message.textContent = 'Error occurred in recognition: ' + event.error;
        }        

        document.querySelector('#speech_btn').addEventListener('click', function(){
            recognition.start();

        });


    </script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>