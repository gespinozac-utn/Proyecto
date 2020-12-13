<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

            <section class="addCategory">
                <form action="/category/update" method="POST">
                <input type="hidden" name="id" value="<?php echo $category->id; ?>">
                        <h3 style="text-align: center;">Edit category</h3>
                        <div class="row">
                            <div class="six columns">
                                <label for="name">Name</label>
                                <input type="text" class="u-full-width" name="name" placeholder="Name" value="<?php echo $category->name; ?>" required>
                            </div>
                            <div class="six columns">
                            <label for="name">Parent</label>
                                <!-- SELECT COMBOBOX  -->
                                <select name="parent" id="parent" class="u-full-width">
                                    <option value="---">---</option>
                                    <?php
                                        foreach($categories as $cat){
                                            if($cat->name == $category->parent){
                                                echo "
                                                    <option value='$cat->name' selected='selected'>$cat->name</option>
                                                ";
                                            }else{
                                                echo "
                                                    <option value='$cat->name'>$cat->name</option>
                                                ";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <h6><?php echo $this->session->flashdata('message'); ?></h6>
                        <div class="row">
                            <input type="submit" value="Update" class="button-primary u-pull-right">
                        </div>
                    </form>
            </section>
        </div>
        