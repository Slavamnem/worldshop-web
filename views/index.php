<div class="container bootstrap snippet">
    <div class="row">
		<div class="col-md-12">
		    <div>
                <? if(isset($_SESSION['user'])): ?>
                    <h3 class="text-success">My Test Blog</h3>
                    <hr/>
                    <a class="btn btn-primary" href="/post/add" target="blank" role="button">Add new post</a>
                    <br><br>
                    <div class="main_page_content">
                        <ul class="list-group">
                            <? $this->getUserPosts(); ?>
                        </ul>
                    </div>
                <? endif; ?>
                <? if(!isset($_SESSION['user'])): ?>
                    <br><br>
                    <h3 align="center">
                         <a href="#" data-toggle="modal" data-target="#enterModal">
                             Sign In
                         </a>
                         or
                         <a href="#" data-toggle="modal" data-target="#registrationModal">
                              Sign Up
                         </a>
                         to view your blog!
                    </h3>
                <? endif; ?>
			</div>
		</div>
	</div>
</div>