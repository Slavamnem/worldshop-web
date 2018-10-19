<?php
// Widget displaing a block of one post in two variations, preview form and full form
class PostWidget
{
    public static function get(array $params)
    {
        extract($params);
        if ($type and $post) {
            if ($type == "full"): ?>
                <div class="row">
                    <?php if($post['image'] != ""): ?>
                        <div class="col-md-3">
                            <img src="/img/<?= $post['image'] ?>" alt="" style="width:220px; height:220px;">
                        </div>
                        <div class="col-md-9">
                            <p class="mb-1"><?= $post['content']; ?></p>
                        </div>
                    <? endif; ?>
                    <?php if($post['image'] == ""): ?>
                        <div class="col-md-12">
                            <p class="mb-1"><?= $post['content']; ?></p>
                        </div>
                    <? endif; ?>
                </div>
            <? endif;
            if ($type == "preview"): ?>
                <li class="list-group-item" style="margin-bottom:10px; border-width:0px;">
                    <div class="card">
                        <div class="card-header">
                            <a href="/post/view/<?= $post['id'] ?>">
                                <h5><?= $post['title']; ?></h5>
                            </a>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?= $post['content']; ?>
                            </p>
                            <p align="right">
                                <a style="margin-right:20px;" href="/post/edit/<?= $post['id'] ?>">edit</a>
                                <a href="/app/RequestHandler.php?action=delete_post&id=<?= $post['id'] ?>">delete</a>
                            </p>
                        </div>
                    </div>
                    <div class="subordinates-<?= $post['id'] ?>"></div>
                </li>
            <? endif;
        }
    }
}
?>