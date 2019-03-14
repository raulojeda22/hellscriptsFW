<section class="probootstrap-slider flexslider">
    <ul class="slides">
        <li style="background-image: url(<? echo _PROJECT_URL_ ?>/view/img/slider_3.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="slides-text probootstrap-animate">
                            <h2>Cart</h2>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>


<section class="probootstrap-section">
    <div id="cartPageContent">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading probootstrap-animate">
                    <h2 class="mb20">Your cart</h2>
                </div>
            </div>
            <div class="table-responsive" id="allTableCartDiv">
                <table class="table table-condensed table-dark" id="cartTableCart">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Price €</th>
                            <th>Remove</th>
                            <th>Count</th>
                            <th>Add</th>
                            <th>Total €</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody id="allTableCartBody">

                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-2 pull-right probootstrap-animate">
                    <h1 id="totalPrice"></h1>
                    <button id="checkoutCart" type="button" class="btn btn-primary">Checkout</button>
                </div>
            </div>
        </div>
        <script src="<? echo _PROJECT_URL_ ?>/modules/projects/view/js/projects.js?jsVersion=<? echo _JS_VERSION_ ?>"></script>
        <!-- END section -->
    </div>
</section>
<script src="<? echo _PROJECT_URL_ ?>/modules/cart/view/js/cart.js?jsVersion=<? echo _JS_VERSION_ ?>"></script>
