
<!-- Configuration-->

<?php require_once("../resources/config.php"); ?>


<!-- Header-->
<?php include(TEMPLATE_FRONT .  "/header.php");?>


     <!--Navigation -->

         <!-- Contact Section -->

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="section-heading">Fell free to comment</h2>
            <h3 class="section-subheading ">
           <!--  <?php display_message();?> --> </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form name="sentMessage" id="contactForm" method="post" >
                
                <?php comment(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control" placeholder="Your Comment *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-lg-6 text-center">
                        <div id="success"></div>
                        <button name="submit" type="submit" class="btn btn-xl">Add Comment</button>
                        <hr>
                    </div>
                </div>
            </form>

            <div class="col-md-6">
                <table class="table">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Comment</th>
                      </tr> 
                      <tr>
                       <?php get_comment();?>   
                      </tr> 



                    </thead>
                    
                </table>



        </div>
    </div>
</div>

</div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT .  "/footer.php");?>