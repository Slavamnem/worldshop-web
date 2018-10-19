<div class="container">
    <h3>Edit Post</h3><br><br>

    <form action="/app/RequestHandler.php?action=update_post" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$post['id']?>">

        <div class="form-group">
            <label class="my-1 mr-2">Post Title</label>
            <input type="text" class="form-control" id="inputTitle" name="title" value="<?=$post['title']?>" required>
        </div><br>

         <div class="form-group">
             <label for="content">Post Content</label>
             <textarea class="form-control" id="content" rows="10" name="content"><?=$post['content'];?></textarea>
         </div><br>

         <div class="form-group">
             <label for="image">Image</label>
             <?php if($post['image'] != ""): ?>
                 <br><br><img src="/img/<?=$post['image']?>" alt="" style="width:250px; height:250px;"><br><br>
             <?php endif; ?>
             <input type="file" class="form-control-file" id="image" name="image">
         </div><br>

         <button type="button" class="btn btn-danger" onClick="window.location='/';">Cancel</button>
         <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <br><br>
</div>