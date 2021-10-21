<div class="col-sm-12 col-xl-6 col-xxl-4 mb-3 min-width-home">
    <div id="userInfo" class="card bg-dark text-light p-3">
        <div class="row">
            <div class="col-4">
                <img src="<?php echo $profilePicture ?>" alt="Profile Picture" class="w-100 rounded" style="min-width: 80px; min-height: 80px">
            </div>
            <div class="col-8 d-flex flex-column justify-content-between" style="padding-left: 0px;">
                <div class="row">
                    <div class="row">
                        <div class="col">
                            <h4 class="no-overflow"><?php echo $username ?></h4>
                        </div>
                    </div>
                    <div class="row d-none d-sm-block d-md-block d-lg-block d-xl-block">
                        <div class="col">
                            sdkdfskfkdsj
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-dark col col-sm-12 col-md-4 col-lg-4 col-xl-6" data-toggle="true" id="userInfo-expand">View More</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="userInfo-more" style="display: none; max-height: 200px; overflow: hidden; padding-top: 15px;">
            <div class="col" style="max-height: 200px;">
                <img src="https://ashleybailey.me/UserData/1ff1de774005f8da13f42943881c655f/profile-picture/maxresdefault.jpg" alt="Profile Picture" class="h-100 rounded" style="min-width: 80px; min-height: 80px">
            </div>
        </div>
    </div>
</div>