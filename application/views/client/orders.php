<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
    td>a {
	display: block;
}

.details {
	border: 1px dashed black;
	padding: 25px;
	height: 300px;
	overflow-y: auto;
}

.details>ul {
	padding-left: 30px;
}

@media (min-width: 1000px) {

	thead,
	tr {
		width: 100% !important;
	}

	td,
	th {
		width: 40% !important;
	}
}
</style>

            <section class="orders">
                <!-- CODE GOES HERE -->
                <div class="row">
                    <div class="five columns u-full-width">&nbsp;</div>
                    <div class="six columns u-full-width">
                        <h2>Orders</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="six columns u-full-width">
                        <table class="u-full-width">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php    
                                    foreach($orders as $order){
                                        createOrderData($order);
                                    }

                                    function createOrderData($order)
                                    {
                                        $id = $order->id;
                                        $date = $order->purchaseDate;
                                        $total = 0;
                                        foreach($order->details as $detail){
                                            $total += $detail->total;
                                        }
                                        echo "
                                        <tr>
                                            <td><a href='/orders/view/$id'>$date</a></td>
                                            <td>&#8353;$total</td>
                                        <tr>
                                        ";
                                    }
                                ?>
                                <!-- createOrders($user->get_id()); -->
                            </tbody>
                        </table>
                    </div>
                    <div class="six columns u-full-width details">
                        <h5>Details</h5>
                        <?php 
                            if(isset($view)){
                                $total = 0;
                                foreach($view as $detail){
                                    createDetailData($detail);
                                    $total += $detail->product->price * $detail->quantity;
                                }
                                echo "</ol>
                                <p><strong>Total: </strong>&#8353;$total</p>";
                            }

                            function createDetailData($detail)
                            {
                                $quantity = $detail->quantity;
                                $product = $detail->product;
                                $productName = $product->name;
                                $productPrice = $product->price;
                                $productDescription = $product->description;
                                echo "
                                <li> <strong>-- </strong> $productName
                                    <ul>
                                        <li>Quantity: $quantity</li>
                                        <li>Description: $productDescription</li>
                                        <li>Price: &#8353;$productPrice</li>
                                    </ul>
                                </li>";
                            }
                        ?>
                        <!-- createDeatils($idOrder);  -->
                    </div>
                </div>
            </section>
        </div>