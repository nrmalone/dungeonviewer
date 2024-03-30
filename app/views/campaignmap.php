<?php include_once '../app/components/jquery.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>
<!-- https://phppot.com/php/simple-php-chat-using-websocket/
will test manually creating WebSockets w/ JS & PHP for handling w/ this tutorial -->
<script>
    function showMessage(messageHTML) {
        $('#chat-box').append(messageHTML);
    }

    $(document).ready(function() {
        var websocket = new WebSocket("<?=str_replace("https://", "ws://", PRIVATEROOT)?>core/ws.php");

        websocket.onopen = function(event) {
            showMessage("<div class='chat-connection-ack'>Connection established!</div>");
            $('#chat-message').val('');
        };

        websocket.onmessage = function(event) {
            var Data = JSON.parse(event.data);
            showMessage("<div class='"+Data.message_type+"'>"+Data.message+"</div>");
            $('#chat-message').val('');
        };

        websocket.onerror = function(event) {
            showMessage("<div class='error'>Unexpected error with chat connection</div>");
        };

        websocket.onclose = function(event) {
            showMessage("div class='chat-connection-ack'>Connection Closed</div>");
        };
        
        $('#frmChat').on("submit",function(event) {
            event.preventDefault();
            $('chat-user').attr("type","hidden");
            var messageJSON = {
                chat_user: $('#chat-user').val(),
                chat_message: $('#chat-message').val()
            };
            websocket.send(JSON.stringify(messageJSON));
        });
    });
</script>

<form name="frmChat" id="frmChat">
    <div id="chat-box"></div>
    <input type="text" name="chat-user" id="chat-user" placeholder="Name" class="chat-input" required />
    <input type="text" name="chat-message" id="chat-message" placeholder="Message"  class="chat-input chat-message" required />
    <input type="submit" id="btnSend" name="send-chat-message" value="Send" >
</form>

<?php include_once '../app/components/pagefooter.php'; ?>