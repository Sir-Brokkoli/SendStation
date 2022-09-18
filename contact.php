<?php include('Style/header.php'); ?>

<div class="d-flex flex-column flex-fill bgMountains">
    <section class="p-5 mt-5">
        <div class="container bg-dark text-light p-5">
            <h2>Contact</h2>
            <div class="container">
                <p>
                    Leave a message for the developer if you got any questions, ideas or concerns! This way of contact is 
                    anonymous, so do not expect any answer.
                </p>
                
                <form action="contact.commit.php" method="post">
                    <div class="mb-3">
                        <label for="#contactTextField" class="h6">Your message:</label>
                        <textarea class="form-control" name="msg" id="contactTextField" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send message</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include('Style/footer.php'); ?>