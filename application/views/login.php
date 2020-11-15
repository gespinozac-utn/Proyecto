    <body>
        <div class="container">

            <section class="navbar u-full-width">
                <div class="row">
                    <div class="twelve columns">
                        <nav>
                            <a href="/index" title="Home"><i class="fas fa-home fa-2x"></i></a>
                            <a href="/register" title="Create account" class="u-pull-right"><i class="fas fa-plus fa-2x"></i></a>
                        </nav>
                    </div>
                </div>
            </section>

            <section class="login">
                <form action="/login.php" method="POST">
                    <div class="row">
                        <div class="six columns">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username" class="u-full-width" required>
                        </div>
                        <div class="six columns">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" class="u-full-width" required>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="Log in" class="button u-pull-right">
                    </div>
                </form>
            </section>

        </div>
