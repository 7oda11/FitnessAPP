<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Assistant</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; align-items: center; background-color: #f9f9f9; height: 100vh; justify-content: center; }
        .chat-container { width: 80%; max-width: 600px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; height: 80%; overflow: hidden; }
        .chat-header { background-color: #007bff; color: white; padding: 10px; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px; }
        .chat-body { flex: 1; padding: 20px; overflow-y: auto; display: flex; flex-direction: column; }
        .chat-message { margin-bottom: 10px; }
        .chat-message.user { text-align: right; }
        .chat-message.bot { text-align: left; }
        .chat-input { display: flex; padding: 10px; border-top: 1px solid #ccc; }
        .chat-input input { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-right: 10px; }
        .chat-input button { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .chat-input button:hover { background-color: #0056b3; }
    </style>
    <script>
        async function addMessage(sender, message) {
            const chatBody = document.querySelector('.chat-body');
            const messageElement = document.createElement('div');
            messageElement.classList.add('chat-message', sender);
            messageElement.innerText = message;
            chatBody.appendChild(messageElement);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        async function sendMessage() {
            const userInput = document.querySelector('.chat-input input');
            const message = userInput.value.trim();
            if (message) {
                addMessage('user', message);
                userInput.value = '';

                try {
                    const response = await fetch('http://127.0.0.1:5000/get_response', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ user_message: message })
                    });

                    if (response.ok) {
                        const data = await response.json();
                        addMessage('bot', data.response);
                    } else {
                        addMessage('bot', 'Error: Unable to get response from the server.');
                    }
                } catch (error) {
                    addMessage('bot', 'Error: ' + error.message);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.chat-input button').addEventListener('click', sendMessage);
            document.querySelector('.chat-input input').addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        });
    </script>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h1>Chatbot Assistant</h1>
        </div>
        <div class="chat-body"></div>
        <div class="chat-input">
            <input type="text" placeholder="Type a message...">
            <button>Send</button>
        </div>
    </div>
</body>
</html>
