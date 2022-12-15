<ul class="list-group">
    <?php foreach ($errors as $error): ?>
        <li class="list-group-item list-group-item-danger"><?= esc($error) ?></li>
        <?php endforeach ?>
</ul>