<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS ."header.php") ?>

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center" style="font-family:verdana;">Login</h1></br>
            <h4 style="color:red;" class="text-center bg-warning"> <?php display_message(); ?> </h4>
            <h4 style="color:green;" class="text-center bg-success"> <?php display_message2(); ?> </h4>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post" enctype="multipart/form-data">

                <?php login_user(); ?>

                <div class="form-group"><label for="">
                    username<input type="text" name="username" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="text" name="password" class="form-control"></label>

                </div>

                <div class="form-group">
                  &nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-primary" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                 
                </form>

        </div>  


    </header>

                 

<?php include(TEMPLATE_FRONT . DS ."footer.php") ?>
        