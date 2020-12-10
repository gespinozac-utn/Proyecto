<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

            <section class="addCategory">
                <form action="/CRUD/CRUDCategories.php?action=add" method="POST">
                        <h3 style="text-align: center;">Create category</h3>

                        <div class="row">
                            <div class="six columns">
                                <label for="name">Category name</label>
                                <input type="text" class="u-full-width" name="name" placeholder="Name" required>
                            </div>
                            <div class="six columns">
                                <label for="parent">Category parent</label>
                                <input type="text" name="parent" placeholder="Parent" class="u-full-width">
                            </div>
                        </div>
                        <h6><?php echo $this->session->flashdata('message'); ?></h6>
                        <div class="row">
                            <input type="submit" value="Create" class="button-primary u-pull-right">
                        </div>
                    </form>
            </section>
        </div>
