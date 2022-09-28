<li>
    <p class="name">{{ $comment->name }}</p>
    <p class="date">{{ date('d-m-Y', strtotime($comment->created_at)) }}</p>
    <p class="msg">{{ $comment->comment }}</p>
</li>