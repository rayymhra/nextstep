{{-- resources/views/chatbot/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-robot me-2"></i>Career Assistant
                        </h4>
                        <span class="badge bg-light text-primary">Demo</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    {{-- Chat Container --}}
                    <div id="chat-container" class="p-4" style="height: 400px; overflow-y: auto; background: #f8f9fa;">
                        {{-- Welcome Message --}}
                        <div class="chat-message bot-message mb-4">
                            <div class="message-bubble bot-bubble">
                                <div class="message-content">
                                    <strong>Career Assistant:</strong> Hello! I'm your AI career assistant. I can help you with resume tips, interview advice, career guidance, and more. What would you like to know?
                                </div>
                                <div class="message-time text-muted small mt-1">{{ now()->format('g:i A') }}</div>
                            </div>
                        </div>
                        
                        {{-- Chat messages will be appended here --}}
                    </div>

                    {{-- Quick Suggestions --}}
                    <div class="p-3 border-top">
                        <div class="mb-2">
                            <small class="text-muted">Quick questions:</small>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-outline-primary btn-sm quick-question" data-question="How to improve my resume?">
                                Resume Tips
                            </button>
                            <button class="btn btn-outline-primary btn-sm quick-question" data-question="Interview preparation advice">
                                Interview Tips
                            </button>
                            <button class="btn btn-outline-primary btn-sm quick-question" data-question="Career growth strategies">
                                Career Growth
                            </button>
                            <button class="btn btn-outline-primary btn-sm quick-question" data-question="What skills should I learn?">
                                Skills Development
                            </button>
                        </div>
                    </div>

                    {{-- Input Area --}}
                    <div class="p-3 border-top bg-light">
                        <form id="chat-form">
                            @csrf
                            <div class="input-group">
                                <input type="text" id="message-input" class="form-control" 
                                       placeholder="Type your career question here..." maxlength="500" required>
                                <button type="submit" class="btn btn-primary" id="send-button">
                                    <i class="fas fa-paper-plane"></i> Send
                                </button>
                            </div>
                            <div class="form-text text-muted">
                                This is a demo chatbot with predefined responses for career guidance.
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Tips Card --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Career Tips</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex mb-3">
                                <i class="fas fa-file-alt text-primary me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">Update Your Portfolio</h6>
                                    <p class="small text-muted mb-0">Keep your portfolio current with recent projects and achievements.</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <i class="fas fa-graduation-cap text-success me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">Learn New Skills</h6>
                                    <p class="small text-muted mb-0">Check our Academy for courses to enhance your career.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex mb-3">
                                <i class="fas fa-network-wired text-info me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">Network Regularly</h6>
                                    <p class="small text-muted mb-0">Connect with professionals in your industry.</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <i class="fas fa-bullseye text-warning me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">Set Clear Goals</h6>
                                    <p class="small text-muted mb-0">Define your career objectives and create a plan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.chat-message {
    display: flex;
    margin-bottom: 1rem;
}

.user-message {
    justify-content: flex-end;
}

.bot-message {
    justify-content: flex-start;
}

.message-bubble {
    max-width: 70%;
    padding: 12px 16px;
    border-radius: 18px;
    position: relative;
}

.user-bubble {
    background: #007bff;
    color: white;
    border-bottom-right-radius: 4px;
}

.bot-bubble {
    background: white;
    border: 1px solid #dee2e6;
    border-bottom-left-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.message-time {
    font-size: 0.75rem;
}

.quick-question {
    font-size: 0.8rem;
    padding: 4px 8px;
}

#chat-container {
    scroll-behavior: smooth;
}

/* Scrollbar styling */
#chat-container::-webkit-scrollbar {
    width: 6px;
}

#chat-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

#chat-container::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

#chat-container::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message-input');
    const chatContainer = document.getElementById('chat-container');
    const sendButton = document.getElementById('send-button');

    // Quick question buttons
    document.querySelectorAll('.quick-question').forEach(button => {
        button.addEventListener('click', function() {
            messageInput.value = this.getAttribute('data-question');
            chatForm.dispatchEvent(new Event('submit'));
        });
    });

    // Handle form submission
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const message = messageInput.value.trim();
        if (!message) return;

        // Add user message to chat
        addMessageToChat(message, 'user');
        messageInput.value = '';
        sendButton.disabled = true;

        // Send message to server
        fetch('{{ route("chatbot.message") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            // Add bot response to chat
            setTimeout(() => {
                addMessageToChat(data.bot_response, 'bot');
                sendButton.disabled = false;
            }, 1000); // Simulate typing delay
        })
        .catch(error => {
            console.error('Error:', error);
            addMessageToChat('Sorry, I encountered an error. Please try again.', 'bot');
            sendButton.disabled = false;
        });
    });

    function addMessageToChat(message, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `chat-message ${sender}-message`;
        
        const bubbleDiv = document.createElement('div');
        bubbleDiv.className = `message-bubble ${sender}-bubble`;
        
        const contentDiv = document.createElement('div');
        contentDiv.className = 'message-content';
        contentDiv.innerHTML = sender === 'user' ? message : `<strong>Career Assistant:</strong> ${message}`;
        
        const timeDiv = document.createElement('div');
        timeDiv.className = 'message-time text-muted small mt-1';
        timeDiv.textContent = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        
        bubbleDiv.appendChild(contentDiv);
        bubbleDiv.appendChild(timeDiv);
        messageDiv.appendChild(bubbleDiv);
        
        chatContainer.appendChild(messageDiv);
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Enable/disable send button based on input
    messageInput.addEventListener('input', function() {
        sendButton.disabled = !this.value.trim();
    });
});
</script>
@endsection