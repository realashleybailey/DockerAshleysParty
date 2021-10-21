<?php

session_start();
require __DIR__ . '/../vendor/autoload.php';

\Ashley\API\PublicAPI\Authentication::Verify();

// VerifyLogin();

$template = TemplateLoader();
echo $template->render('header', ['title' => 'Home']);

$modules = TemplateLoader("modules");

?>


<div class="container-fluid" style="padding-left: 0px; padding-right: 0px; padding: 20px;">
    <div class="row align-items-start">

        <?php
        echo $modules->render('userInfo', ['username' => 'realashleybailey', 'profilePicture' => '']);
        ?>


        <div class="col-sm-12 col-xl-6 col-xxl-4 mb-3 min-width-home">
            <div class="card bg-dark text-light p-3">
                sda
            </div>
        </div>

        <div class="col-sm-12 col-xl-6 col-xxl-4 mb-3 min-width-home">
            <div class="card bg-dark text-light p-3">
                sda
            </div>
        </div>
    </div>
</div>

<?php
echo $template->render('modals');
echo $template->render('footer');
?>
<script>
    new AshleysParty.HomePage;
</script>