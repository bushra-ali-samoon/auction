<!DOCTYPE html>
<html>
<head>
    <title>Messages with {{ $partner->name }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Chat with {{ $partner->name }}</h2>

    <div id="chat-box" style="border:1px solid #ccc; padding:10px; height:250px; overflow-y:auto;">
        @foreach($messages as $msg)
            <p>
                <strong>{{ $msg->sender_id == auth()->id() ? 'You' : $partner->name }}:</strong>
                {{ $msg->message }}
            </p>
        @endforeach
    </div>
 
    <form id="messageForm">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $id }}">
        <textarea name="message" placeholder="Type your message" required></textarea><br>
        <button type="submit">Send</button>
    </form>
 
    <script>
        $('#messageForm').submit(function(e){
            e.preventDefault();

            $.ajax({
                url: "{{ route('messages.store') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(res){
                    if(res.success){
                        const msg = $('textarea[name="message"]').val();
                        $('#chat-box').append(`<p><strong>You:</strong> ${msg}</p>`);
                        $('textarea[name="message"]').val('');
                        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                    }
                }
            });
        });
    </script>
</body>
</html>

