<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

            <section class="addCategory">
                <form action="/category/new" method="POST">
                        <h3 style="text-align: center;">Create category</h3>

                        <div class="row">
                            <div class="six columns">
                                <label for="name">Name</label>
                                <input type="text" class="u-full-width" name="name" placeholder="Name" required>
                            </div>
                            <div class="six columns">
                                <label for="name">Parent</label>
                                <!-- SELECT COMBOBOX  -->
                                <select name="parent" id="parent" class="u-full-width">
                                    <option value="---">---</option>
                                    <?php
                                        foreach($categories as $category){
                                            echo "
                                                <option value='$category->name'>$category->name</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <h6><?php echo $this->session->flashdata('message'); ?></h6>
                        <div class="row">
                            <input type="submit" value="Create" class="button-primary u-pull-right">
                        </div>
                    </form>
            </section>
        </div>
