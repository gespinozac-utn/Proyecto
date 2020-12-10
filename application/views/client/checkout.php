            <?php
            defined('BASEPATH') or exit('No direct script access allowed');
            ?>

            <section class="catalogue">

                <div class="side-menu">
                    <ul>
                        <li>
                            <a href="/catalogue"><i class="far fa-arrow-alt-circle-left fa-2x"> Back</i></a>
                        </li>
                    </ul>
                </div>

                <section class="content">
                    <div class="row u-full-width">
                        <div class="four columns u-full-width">&nbsp;</div>
                        <div class="eight columns u-full-width">
                            <h4>Items on the basket</h4>
                        </div>
                    </div>
                    <div class="container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>quantity</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Load orders -->
                                <?php
                                    if(isset($basket)){
                                        foreach($basket as $detail){
                                            createData($detail);
                                        }
                                    }
                                    function createData($detail)
                                    {
                                        $id = $detail->id;
                                        $quantity = $detail->quantity;
                                        $product = $detail->product;
                                        $name = $product->name;
                                        echo '
                                        <tr>
                                            <td>' . $name . '</td>
                                            <td>' . $quantity . '</td>
                                            <td><a href="/CRUD/CRUDBill.php?action=delete&id=' . $id . '"><i class="fas fa-times fa-lg"></i></a>
                                            </td>
                                        </tr>
                                        ';
                                    }
                                ?>
                                <!-- loadOrders($_SESSION['user']->get_id()); -->
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="twelve columns">
                                <form action="/CRUD/CRUDBill.php?action=checkout" method="POST">
                                    <input type="hidden" name="idU" value="id"> <!--  echo $user->get_id();   -->
                                    <input type="submit" value="Checkout" class="button u-full-width">
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>