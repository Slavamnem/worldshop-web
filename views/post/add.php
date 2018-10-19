<div class="container">
    <h3>Add Post</h3><br><br>

    <form action="/app/RequestHandler.php?action=create_post" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label class="my-1 mr-2">Post Title</label>
            <input type="text" class="form-control" id="inputTitle" name="title" required>
        </div><br>

         <div class="form-group">
             <label for="content">Post Content</label>
             <textarea class="form-control" id="content" rows="10" name="content"></textarea>
         </div><br>

         <div class="form-group">
             <label for="image">Image</label>
             <input type="file" class="form-control-file" id="image" name="image">
         </div><br>

         <input type="hidden" name="author_login" value="<?=$_SESSION['user']['login']?>">

         <button type="button" class="btn btn-danger" onClick="window.location='/';">Cancel</button>
         <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <br><br>
</div>