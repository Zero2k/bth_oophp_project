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
                            <label for="inputStock">Stock</label>
                            <input type="number" class="form-control-custom" name="stock" value="<?= $product->stock ?>" placeholder="Stock">
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
                            <?php $ignore = array(".", ".."); ?>
                            <?php foreach ($images as $image) : ?>
                                <?php if (!in_array($image, $ignore)) : ?>
                                    <option <?= $product->image === $image ? ' selected="selected"' : '' ?> value="<?= $image ?>"><?php echo $image ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputImage">Additional Images</label>
                    <div class="form-row">
                        <div class="col">
                            <select class="form-control-custom" name="image_two">
                                <option value=""></option>
                            <?php $ignore = array(".", ".."); ?>
                            <?php foreach ($images as $image) : ?>
                                <?php if (!in_array($image, $ignore)) : ?>
                                    <option <?= $product->image_two === $image ? ' selected="selected"' : '' ?> value="<?= $image ?>"><?php echo $image ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control-custom" name="image_three">
                                <option value=""></option>
                            <?php $ignore = array(".", ".."); ?>
                            <?php foreach ($images as $image) : ?>
                                <?php if (!in_array($image, $ignore)) : ?>
                                    <option <?= $product->image_three === $image ? ' selected="selected"' : '' ?> value="<?= $image ?>"><?php echo $image ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- <div class="col">
                            <select class="form-control-custom" name="image_four">
                                <option value=""></option>
                            <?php $ignore = array(".", ".."); ?>
                            <?php foreach ($images as $image) : ?>
                                <?php if (!in_array($image, $ignore)) : ?>
                                    <option <?= $product->image_four === $image ? ' selected="selected"' : '' ?> value="<?= $image ?>"><?php echo $image ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div> -->
                    </div>
                </div>
                <div class="form-group">
                    <label>Categories (Use Ctrl to select multiple)</label>
                    <select class="form-control-multiselect" name="categories[]" multiple="multiple">
                        <?php $arr = array_column($productImages, 'categoryId'); ?>
                        <?php foreach ($categories as $cat) : ?>
                            <!-- <option value="<?= $cat->id ?>"><?php echo ucfirst($cat->category) ?></option> -->
                                <?php if (in_array($cat->id, $arr) === true) : ?>
                                    <option selected="selected" value="<?= $cat->id ?>"><?php echo ucfirst($cat->category) ?></option>
                                <?php else : ?>
                                    <option value="<?= $cat->id ?>"><?php echo ucfirst($cat->category) ?></option>
                                <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputOffer">Offer</label>
                            <select id="inputOffer" name="offer" class="form-control-custom">
                                <option value="0" selected>Select...</option>
                                <option <?= $product->offer === 1 ? ' selected="selected"' : '' ?> value="1">True</option>
                                <option <?= $product->offer === 0 ? ' selected="selected"' : '' ?> value="0">False</option>
                            </select>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputFeatured">Featured</label>
                            <select id="inputFeatured" name="featured" class="form-control-custom">
                                <option value="0" selected>Select...</option>
                                <option <?= $product->featured === 1 ? ' selected="selected"' : '' ?> value="1">True</option>
                                <option <?= $product->featured === 0 ? ' selected="selected"' : '' ?> value="0">False</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-user">Update Product</button>
            </form>
            <!-- <?= var_dump($values) ?>
            <?= print_r($values) ?> -->
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
