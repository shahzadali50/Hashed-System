<div class="card" style="height: 600px;">
    <div class="row h-100 g-0 px-2">
        <h5 class="text-center py-2">Chat System</h5>
        <!-- Sidebar -->
        <div class="col-4 border-end d-flex flex-column p-0" style="background: #f8f9fa;">
            <div class="p-3 border-bottom bg-white">
                <strong>Users</strong>
            </div>
            <ul class="list-unstyled flex-grow-1 overflow-auto mb-0" style="max-height: 500px;">

                @foreach ($users as $user)
                    <li wire:click="selectUser({{ $user->id }})"
                        class="p-2 border-bottom d-flex align-items-center user-item {{ $selectedUser->id == $user->id ? 'active-chat-user' : '' }}"
                        style="cursor:pointer; transition: background 0.2s;"
                        onmouseover="this.style.background='#f1f1f1'" onmouseout="this.style.background=''">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" class="rounded-circle me-2"
                            style="width: 40px; height: 40px;" alt="">
                        <span>{{ $user->name }}</span>
                    </li>
                @endforeach
                <!-- Add more users as needed -->
            </ul>
        </div>
        <!-- Chat Area -->
        <div class="col-8 d-flex flex-column p-0 h-100">
            <!-- Chat Header -->
            <div class="d-flex align-items-center border-bottom p-3 bg-white">
                <img src="https://www.w3schools.com/howto/img_avatar.png" style="width: 40px; height: 40px;"
                    class="rounded-circle me-2" alt="">
                <div>
                    <div class="fw-bold">{{ $selectedUser->name }}</div>
                    <div class="text-success small">Online</div>
                </div>
            </div>
            <!-- Messages -->
            <div class="flex-grow-1 overflow-auto p-3" style="background: #f5f5f5; min-height: 0;">
                <div class="d-flex flex-column gap-2">
                    @foreach ($selectUserMessages as $message)
                        <div
                            class="d-flex {{ $message->sender_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                            <div class=" rounded px-3 py-2 {{ $message->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-light text-dark' }}"
                                style="max-width: 70%;">{{ $message->message }}</div>
                        </div>
                    @endforeach

                </div>

            </div>
            <p id="typing-indicator"></p>
            <!-- Input -->
            <form wire:submit.prevent="sendMessage" class="d-flex border-top p-3 bg-white">
                <input type="text" wire:model.live="message"
                    class="form-control me-2 @error('message') is-invalid @enderror" placeholder="Type your message..."
                    id="messageInput">
                <button type="submit" class="btn btn-primary">Send</button>
            </form>

            <script>
                let typingTimer;
                let isTyping = false;

                document.addEventListener('livewire:initialized', () => {
                    Livewire.on('messageSent', () => {
                        document.getElementById('messageInput').value = '';
                    });

                    Livewire.on('userTyping', (event) => {
                        console.log(event);
                        if (!isTyping) {
                            isTyping = true;
                            window.Echo.private(`chat.${event.selectedUserId}`).whisper("typing", {
                                userID: event.userID,
                                userName: event.userName,
                                selectedUserId: event.selectedUserId,
                                isTyping: true
                            });
                        }

                        // Clear existing timer
                        clearTimeout(typingTimer);

                        // Set new timer to stop typing after 1 second of no input
                        typingTimer = setTimeout(() => {
                            isTyping = false;
                            window.Echo.private(`chat.${event.selectedUserId}`).whisper("typing", {
                                userID: event.userID,
                                userName: event.userName,
                                selectedUserId: event.selectedUserId,
                                isTyping: false
                            });
                        }, 2000);
                    });

                    window.Echo.private(`chat.{{ $loginID }}`).listenForWhisper('typing', (event) => {
                        var t = document.getElementById('typing-indicator');
                        if (event.isTyping) {
                            t.innerText = `${event.userName} is typing...`;
                        } else {
                            t.innerText = '';
                        }
                    });

                    // Handle input focus and blur
                    const messageInput = document.getElementById('messageInput');
                    messageInput.addEventListener('focus', () => {
                        // Don't show typing on focus, only when actually typing
                    });

                    messageInput.addEventListener('blur', () => {
                        // Stop typing when input loses focus
                        if (isTyping) {
                            isTyping = false;
                            clearTimeout(typingTimer);
                            window.Echo.private(`chat.{{ $selectedUser->id }}`).whisper("typing", {
                                userID: {{ $loginID }},
                                userName: '{{ Auth::user()->name }}',
                                selectedUserId: {{ $selectedUser->id }},
                                isTyping: false
                            });
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
