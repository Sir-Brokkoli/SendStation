<?php include('Style/header.php'); ?>

<!-- Intro -->
<section class="bg-dark text-light p-3 mt-5 text-center text-sm-start">
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="p-5"> 
                <h1> All aboard the <span class="text-col2">send train!</span> </h1>
                <p class="lead my-4">
                    Our team of experts spend 2 hours to find 39 of the very best climbs around Innsbruck! So what are you waiting for? 
                    Pack your shit, start the freaking engine and bring this old train to new glory!
                </p>
                <button class="btn btn-lg btn-col2 text-light" data-bs-toggle="modal" data-bs-target="#logInModal">Start the engine!</button>
            </div>
            <img 
                src="https://images.unsplash.com/photo-1527498348926-888801f0a493?isxid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1470&q=80" 
                alt="" 
                style="box-shadow: 10px 10px 5px rgb(0.9,0.9,0.9);"
                class="img-fluid w-100 d-none d-md-block">
        </div>
    </div>
</section>

<!-- Sign up bar -->
<section class="text-light p-5 bg-col2">
    <div class="container">
        <div class="d-md-flex justify-content-between align-items-center">
            <div class="px-5">
                <h3 class="mb-0 mb-md-0"> You do not own a train? </h3>
                <p class="lead"> No problem, sign up for one here and join the competition!</p>
            </div>
            
            <button type="button" class="btn btn-lg btn-col1 text-dark mx-5" data-bs-toggle="modal" data-bs-target="#signUpModal"> Sign up! </button>
        </div>
    </div>
</section>

<!-- Short Description -->
<section class="p-5">
    <div class="container" id="bgTrain">
        <div class="row text-center g-4">
            <div class="col-md">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="card-title">Who?</h3>
                        <p class="card-text">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat neque iusto quos quisquam molestias fuga?
                        </p>
                        <a href="#" class="btn btn-col2 text-light">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card bg-secondary text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="bi bi-signpost-split"></i>
                        </div>
                        <h3 class="card-title">Where?</h3>
                        <p class="card-text">
                            All the routes included in this competition are located in the direct vicinity of Innsbruck! 
                            In total, they group in 9 crags such as Dschunglebuch, Gallerie and Höttinger Steinbruch!
                        </p>
                        <a href="routes.php" class="btn btn-col1";>Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <h3 class="card-title">Why?</h3>
                        <p class="card-text">
                            Are you silly? Just gonna send it! The primary goal of this competition is to have a good time, to connect and to freaking send it!
                            Moreover, we want to help people to acknowledge the beauty of good rock quality.
                        </p>
                        <a href="#" class="btn btn-col2 text-light">Read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('Style/footer.php'); ?>