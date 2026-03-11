<!DOCTYPE html>
<html>
<body>
    <h1>Редактирование задачи</h1>

    <?php if (session()->has('errors')): ?>
        <div style="color: red;">
            <?php foreach (session('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="/tasks/update/<?= $task['id'] ?>" method="post">
        <?= csrf_field() ?>
        
        <input type="text" name="title" value="<?= esc(old('title', $task['title'])) ?>" required>
        
        <textarea name="description"><?= esc(old('description', $task['description'])) ?></textarea>
        
        <select name="status">
            <option value="new" <?= ($task['status'] == 'new') ? 'selected' : '' ?>>New</option>
            <option value="todo" <?= ($task['status'] == 'todo') ? 'selected' : '' ?>>To Do</option>
            <option value="done" <?= ($task['status'] == 'done') ? 'selected' : '' ?>>Done</option>
        </select>
        
        <button type="submit">Сохранить изменения</button>
    </form>
    
    <a href="/tasks">Назад к списку</a>
</body>
</html>