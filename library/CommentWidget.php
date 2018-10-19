<?php
// Widget displaing a block of one comment
class CommentWidget{
    public static function get($comment = null){ ?>
        <div class="row" style="margin-bottom:35px">
            <div class="col-md-2">
                <img src="/img/smile.jpg" alt="" style="width:140px; height:140px;">
            </div>
            <div class="col-md-10">
                <p><?=$comment['name']." ".$comment['email']; ?></p>
                <p class="mb-1"><?=$comment['comment']; ?></p>
            </div>
        </div>
    <? }
}
?>