    <?php
    defined('BASEPATH') or exit('No direct script access allowed');
    ?>

            <section>
                <form action="/product/new" method="POST" enctype="multipart/form-data">
                    <h3 style="text-align: center;">Create Product</h3>

                    <div class="row">
                        <div class="six columns">
                            <label for="name">SKU code</label>
                            <input type="text" class="u-full-width" name="sku" placeholder="SKU Code" required>
                        </div>
                        <div class="six columns">
                            <label for="parent">Product name</label>
                            <input type="text" name="name" placeholder="Product name" class="u-full-width" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="six columns">
                            <label for="parent">Image URL</label>
                            <input type="file" name="imageURL" placeholder="Image URL" class="u-full-width" accept="image/png,image/jpg,image/jpeg">
                        </div>
                        <div class="six columns">
                            <label for="name">Category</label>
                            <!-- SELECT COMBOBOX  -->
                            <select name="category" id="category" class="u-full-width">
                                <!-- <option value="---">---</option> -->
                                <?php
                                    foreach($categories as $category){
                                        echo "
                                            <option value='$category->id'>$category->name</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="six columns">
                            <label for="name">Stock</label>
                            <input type="text" name="stock" placeholder="Stock" class="u-full-width">
                        </div>
                        <div class="six columns">
                            <label for="parent">Price</label>
                            <input type="text" name="price" placeholder="Price" class="u-full-width">
                        </div>
                    </div>
                    <div class="row">
                        <div class="tewlve columns">
                            <label for="name">Description</label>
                            <textarea class="u-full-width" name="description" placeholder="Description" required></textarea>
                        </div>
                    </div>
                    <h6><?php echo $this->session->flashdata('message'); ?></h6>
                    <div class="row">
                        <input type="submit" value="Create" class="button-primary u-pull-right">
                    </div>
                </form>
            </section>
        </div>
        