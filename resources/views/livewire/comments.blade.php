<div>
    <h4><div class="text-center">{{ count($comments) == 0 ? 'Комментариев нет' : '' }}</div><br></h4>

    @foreach ($comments as $el)
    <small>{{ $el->created_at }}</small> --- <strong> {{ $el->users->name }} </strong>
        <span class="text-secondary"> {{ $el->users->isAdmin != 0 ? '(сотрудник)' : '' }}  </span>

        @if(Auth::check() && Auth::user()->isAdmin)
            <button wire:click="$emit('deleteComment',{{ $el->id }})" class="btn btn-sm btn-outline-danger" style="margin-left: 30px">Удалить</button>
        @endif

        <br>
        <p>{{ $el->comment }}</p>
        <br><hr>
    @endforeach

    @guest
    <div class="text-center">
    Войдите, чтобы оставить комментарий!
    </div>
    @endguest

    @auth
    <div class="text-center">Оставьте свой комментарий:</div>
    <p>Имя пользователя: {{ Auth::user()->name }}</p>
    <form>
        <textarea class="form-control" id="comm_text" wire:model="comm_text" placeholder="Введите текст комментария..."></textarea><br>
        <button wire:click.prevent="storeComment" type="submit" class="btn btn-success">Отправить комментарий</button>
    </form>
    @endauth

    <br>
</div>
