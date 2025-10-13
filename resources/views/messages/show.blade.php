<h2>Messages</h2>

@foreach($messages as $msg)
    <p><strong>{{ $msg->sender_id == auth()->id() ? 'You' : 'User '.$msg->sender_id }}:</strong> {{ $msg->message }}</p>
@endforeach
<form action="{{ route('messages.store') }}" method="POST">
    @csrf
<input type="hidden" name="receiver_id" value="{{ $recipient->id }}">    <textarea name="message" placeholder="Type your message"></textarea>
    <button type="submit">Send</button>
</form>

