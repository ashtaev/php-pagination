<nav aria-label="Page navigation example">
    <ul class="pagination my-4">
        <?php foreach ($pages as $page): ?>
            <?php if($page['url']): ?>
                <li class="page-item"><a class="page-link" href="<?= $page['url'] ?>"><?= $page['num'] ?></a></li>
            <?php else: ?>
                <li class="page-item disabled"><a class="page-link" href="#"><?= $page['num'] ?></a></li>
            <?php endif ?>
        <?php endforeach; ?>
    </ul>
</nav>