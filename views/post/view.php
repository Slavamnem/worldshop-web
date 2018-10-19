<? include "/library/PostWidget.php"; ?>
<? include "/library/CommentWidget.php"; ?>
<style>
    #post{
        border:2px solid black;
        padding:20px;
        border-radius:15px;
    }
</style>
<div class="container">

    <section id="post">
        <h3><?= $post['title'] ?></h3><br><br>
        <?= PostWidget::get(['type' => 'full', 'post' => $post]); ?>
        <br>
    </section>
    <br>

    <h3>Add a comment</h3>
    <p>Fields marked as <span style="color:#ff0b0e">*</span> is required</p>

    <form action="javascript:void(null);" onsubmit="add_comment()" method="POST" id="add_comment">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <div class="form-group">
            <label class="my-1 mr-2">Name</label>
            <input type="text" class="form-control" id="inputName" name="name">
        </div>
        <br>

        <div class="form-group">
            <label class="my-1 mr-2">Email</label>
            <input type="text" class="form-control" id="inputEmail" name="email">
        </div>
        <br>

        <div class="form-group">
            <label for="textareaComment">Comment</label>
            <textarea class="form-control" id="textareaComment" rows="10" name="comment"></textarea>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Send comment</button>
    </form>

    <br><br>

    <div id="comments">
        <h4>Comments (<?= count($comments) ?>)</h4><br>
        <? foreach ($comments as $comment): ?>
            <?= CommentWidget::get($comment); ?>
        <? endforeach; ?>
    </div>
</div>