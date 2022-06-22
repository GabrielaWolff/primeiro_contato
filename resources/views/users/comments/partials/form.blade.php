@csrf
<textarea name="body" id="" cols="30" rows="10"placeholder="Comentário"> {{ $comment->body ?? old('body') }}</textarea>
<label for="visible">
    <input type="checkbox" name="visible"
    @if (isset($comment) && $comment->visible)
        checked="checked"
    @endif

    >
    Visível?
</label>
<button type="submit">
    Enviar
</button>
