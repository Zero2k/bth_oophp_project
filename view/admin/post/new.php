<div class="jumbotron jumbotron-fluid bg-header text-white">
    <div class="container">
        <div class="row">
            <h1 class="display-4">Add Post</h1>
            <p class="lead">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.
            </p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">
        <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputTitle">Title</label>
                            <input type="text" class="form-control-custom" name="title" placeholder="Title" required>
                        </div>
                        <div class="col">
                            <label>Category</label>
                            <select class="form-control-custom" name="category">
                                <option value="news">News</option>
                                <option value="offers">Offers</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputImage">Content</label>
                            <textarea id="form-element-content" class="form-control-textarea" name="content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputImage">Image</label>
                            <input type="text" class="form-control-custom" name="image" placeholder="Image">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-user">Add Post</button>
            </form>
        </div>
        
        <div class="col-md-3 col-sm-12">
            <?php if ($this->regionHasContent("sidebar")) : ?>
                <div>
                    <?php $this->renderRegion("sidebar") ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
