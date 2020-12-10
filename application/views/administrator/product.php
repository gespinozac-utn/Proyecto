    <?php
    defined('BASEPATH') or exit('No direct script access allowed');
    ?>

            <section>
                <h3 style="text-align: center;">Product</h3>
                <div class="container">
                    <div class="row">
                        <div class="six columns">
                            <a href="/product/add" class="button button-primary">Create</a>
                        </div>
                        <div class="six columns">
                            <div class="u-pull-right">
                                <form action="/product.php" method="GET">
                                    <input type="text" placeholder="Search" name="search" title="Search for name">
                                    <button type="submit"><i class="fas fa-search" style="color:grey"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="u-full-width">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Utility</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>