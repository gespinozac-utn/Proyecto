    <body>
        <div class="container">

            <section class="navbar u-full-width">
                <div class="row">
                    <div class="twelve columns">
                        <nav>
                            <a href="/" title="Home"><i class="fas fa-home fa-2x"></i></a>
                            <a href="#" title="Create account" class="u-pull-right"><i class="fas fa-plus fa-2x"></i></a>
                        </nav>
                    </div>
                </div>
            </section>

            <section class="create">
                <form action="/client/addUser" method="POST" autocomplete="off">
                    <div class="row">
                        <div class="six columns">
                            <label for="name">Full name</label>
                            <input type="text" name="name" class="u-full-width" placeholder="Name" required>
                        </div>
                        <div class="six columns">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="u-full-width" placeholder="ExampleEmail@email.com" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="six columns">
                            <label for="phone">Phone number</label>
                            <input type="text" name="phone" class="u-full-width" placeholder="Phone number" required>
                        </div>
                        <div class="six columns">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="u-full-width" placeholder="Address" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="four columns">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="u-full-width" placeholder="Username" required>
                        </div>
                        <div class="four columns">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="u-full-width" placeholder="Password" required>
                        </div>
                        <div class="four columns">
                            <label for="repeatPassword">Confirm Password</label>
                            <input type="password" name="repeatPassword" class="u-full-width" placeholder="Confirm password" required>
                        </div>
                    </div>
                    <h6><?php echo $this->session->flashdata('message');?></h6>
                    <div class="row">
                        <input type="submit" value="Create Account" class="button u-full-width">
                    </div>
                </form>
            </section>
        </div>