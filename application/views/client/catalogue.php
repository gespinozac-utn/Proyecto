<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

            <section class="catalogue">
                <section class="catalogue">

                    <div class="side-menu">
                        <ul>
                            <span><strong>Category</strong></span>
                            <li>
                                <a href="/catalogue">All</a>
                            </li>
                            <?php 
                                if(isset($parent)){
                                    createListItem($parent, true);
                                    //create children categories
                                    $childs = $category;
                                    if (!empty($childs)) {
                                        echo '<span><strong>SubCategory</strong></span>';
                                        foreach ($childs as $child) {
                                            createListItem($child);
                                        }
                                    }
                                }else{
                                    foreach($category as $cat){
                                        createListItem($cat);
                                    }
                                }

                                function createListItem($category, $active = false)
                                {
                                    $name = $active ? '<strong> > </strong>' . $category->name : $category->name;
                                    echo '
                                    <li>
                                        <a href="/catalogue/search/' . $category->id . '">' . $name . '</a>
                                    </li>
                                    ';
                                }
                            ?>
                        </ul>
                    </div>

                    <div class="content">
                        <?php

                            if(isset($catalogue) && !isset($preview)){
                                foreach($catalogue as $product){
                                    createProductCard($product);
                                }
                            }
                            function createProductCard($product)
                            {
                                echo '
                                <div class="product-card">
                                    <a href="/catalogue/preview/' . $product->id . '">
                                        <div class="product-image">
                                            <img src="http://proyecto.com/' . $product->imageURL . '">
                                        </div>
                                    <div class="product-info">
                                        <h5>' . $product->name . '</h5>
                                        <h6>&#8353;' . $product->price . '</h6>
                                    </div>
                                    </a>
                                </div>';
                            }
                            if(isset($preview)){
                                $preview->user = $user;
                                previewProduct($preview);
                            }
                            function previewProduct($product)
                            {
                                echo '
                                <div class="row u-full-width">
                                    <div class="three columns u-full-width"> &nbsp;</div>
                                    <div class="nine columns">
                                        <h2>' . $product->name . '</h2>
                                    </div>
                                </div>

                                <div class="row u-full-width">
                                    <div class="one column">&nbsp;</div>
                                    <div class="four columns">
                                        <img src="http://proyecto.com/'.$product->imageURL . '" style="height:200px;width:200px;">
                                    </div>
                                    <div class="seven columns">
                                        <p>' . $product->description . '</p>
                                    </div>
                                </div>

                                <div class="row u-wull-width">
                                    <div class="twelve columns u-full-width">
                                        <h5><strong>' . $product->sku . '</strong></h5>
                                    </div>
                                </div>

                                <div class="row u-full-width">
                                    <div class="four columns u-full width">
                                        <h4><strong>Price:</strong>&#8353; ' . $product->price . '</h4>
                                    </div>
                                    <div class="six columns u-full width">
                                        <h5 class="u-pull-right"><strong>Stock:</strong> ' . $product->stock . '</h5>
                                    </div>
                                </div>
                                
                                <div class="row u-full-width">
                                    <form action="/basket/add" method=POST>
                                        <input type="hidden" name="idUser" value="'.$product->user->id.'">
                                        <input type="hidden" name="idProduct" value="'.$product->id.'">
                                        <div class="nine columns">
                                            <input type="number" name="quantity" class="u-pull-right" value="1" min="1" max="' . $product->stock . '" require>
                                        </div>
                                        <div class="one columns">
                                            &nbsp;
                                        </div>
                                        <div class="two colmuns">
                                            <input type="submit" value="Add"  class="button button-primary">
                                        </div>
                                    </form>
                                </div>
                                ';
                            }
                        ?>
                    </div>

                </section>
            </section>
        </div>