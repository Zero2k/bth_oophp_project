<div class="jumbotron jumbotron-fluid bg-header text-white">
    <div class="container">
        <div class="row">
            <h1 class="display-4">Edit Product</h1>
            <p class="lead">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.
            </p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">
        <form method="post">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control-custom" name="name" placeholder="Name" value="<?= $product->name ?>" required>
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
                            <label for="inputImage">Text</label>
                            <textarea id="form-element-text" class="form-control-textarea" name="text"><?= $product->text ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputDescription">Description</label>
                            <input type="text" class="form-control-custom" name="description" value="<?= $product->description ?>" placeholder="Description">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputPrice">Price</label>
                            <input type="number" class="form-control-custom" name="price" value="<?= $product->price ?>" placeholder="Price" required>
                        </div>
                        <div class="col">
                            <label for="inputOldPrice">Old Price</label>
                            <input type="number" class="form-control-custom" name="oldPrice" value="<?= $product->old_price ?>" placeholder="Old Price" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="inputImage">Image</label>
                            <select class="form-control-custom" name="image">
                                <option value=""></option>
                            <?php $ignore = Array(".", ".."); ?>
                            <?php foreach( $images as $image ) : ?>
                                <?php if(!in_array($image, $ignore)) : ?>
                                    <option value="<?= $image ?>"><?php echo $image ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-user">Update Product</button>
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
