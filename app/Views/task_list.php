<!DOCTYPE html>
<html>
<body>
    <h1>Задачи</h1>

    <form action="/tasks/store" method="post">
        <?= csrf_field() ?>
        <input type="text" name="title" placeholder="Название задачи" required>
        <textarea name="description" placeholder="Описание"></textarea>
        <button type="submit">Добавить</button>
    </form>

    <?php if (session()->has('errors')): ?>
    <div style="color: red;">
        <?php foreach (session('errors') as $error): ?>
            <p><?= esc($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

    <hr>

    <?php if (!empty($tasks)): ?>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <strong><?= esc($task['title']) ?></strong> (Статус: <?= esc($task['status']) ?>)
            <br>
            <small><?= esc($task['description']) ?></small>
            <br>
            <a href="/tasks/edit/<?= $task['id'] ?>">Редактировать</a> |
            <a href="/tasks/delete/<?= $task['id'] ?>" onclick="return confirm('Удалить?')">Удалить</a> |
            Статус: 
            <a href="/tasks/updateStatus/<?= $task['id'] ?>/new">New</a> |
            <a href="/tasks/updateStatus/<?= $task['id'] ?>/todo">To Do</a> |
            <a href="/tasks/updateStatus/<?= $task['id'] ?>/done">Done</a>
        </li>
            <?php endforeach; ?>
        </ul>

    <?php else: ?>
        <p>Задач пока нет.</p>
    <?php endif; ?>
</body>
</html>