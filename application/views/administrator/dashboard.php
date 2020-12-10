<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

            <section class="dashboard">
                <div class="row">
                    <div class="four columns">&nbsp;</div>
                    <div class="six columns">
                        <h5>Clientes registrados: <strong><?php echo $totalClientes;?></strong> </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="four columns">&nbsp;</div>
                    <div class="six columns">
                        <h5>Productos Vendidos: <strong><?php echo $totalProductos;?></strong> </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="four columns">&nbsp;</div>
                    <div class="six columns">
                        <h5>Monto Total de ventas: <strong>&#8353;<?php echo $totalComprado;?></strong> </h5>
                    </div>
                </div>
            </section>
        </div>
        