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
                                <!-- createOrders($user->get_id()); -->
                            </tbody>
                        </table>
                    </div>
                    <div class="six columns u-full-width details">
                        <h5>Details</h5>
                        <!-- createDeatils($idOrder);  -->
                    </div>
                </div>
            </section>
        </div>