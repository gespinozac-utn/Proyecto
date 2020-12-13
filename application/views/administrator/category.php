    <?php
    defined('BASEPATH') or exit('No direct script access allowed');
    ?>

            <section class="category">
                <h3 style="text-align: center;">Category</h3>
                <div class="container">
                    <div class="row">
                        <div class="four columns">
                            <a href="/category/add" class="button button-primary">Create</a>
                        </div>
                        <div class="three columns">
                            <p style="color: red;"></p>
                        </div>
                        <div class="five columns">
                            <div class="u-pull-right">
                                <form action="/category" method="GET">
                                    <input type="text" placeholder="Search" name="search" title="Search for name">
                                    <button type="submit"><i class="fas fa-search" style="color:grey"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="u-full-width">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Parent</th>
                                <th>Utility</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($categories as $category){
                                    echo '
                                        <tr>
                                            <td>' . $category->id . '</td>
                                            <td> ' . $category->name . '</td>
                                            <td> ' . $category->parent . '</td>
                                            <td>
                                                <a href="/product/edit/'.$category->id.'">Edit</a> |
                                                <a href="/product/delete/'.$category->id.'" onclick="return confirm(\'Are you sure?\');">Delete</a>
                                            </td>
                                        </tr>
                                    ';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>