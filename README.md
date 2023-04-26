<p>Сайт библиотеки с категориями, реализованный на Laravel.</p>
<br>
<p>Пользователи и персонал реализованы в одной таблице с помощью разных ролей, поэтому администратор может назначать сотрудниками любых пользователей или наоборот ограничивать в правах. Регистрация возможна как со стороны администратора, так и со стороны гостя.
Сотрудники могут администрировать пользователей и сотрудников, создавать/редактировать категории, создавать/редактировать книги, чистить комментарии. Пользователи могут оставлять комментарии.
Рализация отношений: при удалении категорий удаляются все связанные с ними книги и комментарии. При удалении книги - удаляются комментарии. При удалении пользователя - удаляются все его комментарии.</p>
<p>Реализовано динамическое создание уникальных slug для категорий и книг при обновлении модели в базе (через Observers). При каждом сохранении проверяется уникальность каждого slug идописывается порядковый номер при совпадении.</p>
<p>Реализована подгрузка изображений и модификация на лету под стандарт сайта (для примера) через Intervation/Image. Загруженные файлы сохраняются физически в storage/app/public/covers через symlink в папке /public/, потому как public_path() работает напрямую с директорией. Поэтому при ошибках в работе с загрузкой изображений - желательно запустить команду <b>artisan storage:link</b>.</p>
<br>
<p>Инициализация таблиц полностью автоматизирована и делается через стандартную команду <b>artisan migrate:fresh --seed</b></p>
<p>К книгам привязаны демо-обложки, а функционал удаления обложек при удалении книг отключен (потому что обложки общие).</p>
<br>
<p>Планируется внедрение Livewire и создание страниц с динамическим контентом (например пагинация).</p>
<br>
<b>Спасибо за внимание!</b>
