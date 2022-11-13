<div class="section" id="about">
    <div class="container">
        <div class="card" data-aos="fade-up" data-aos-offset="10">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card-body">
                        <div class="h4 mt-0 title">About</div>
                        <p id="about_text" class="read_more"></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card-body">
                        <div class="h4 mt-0 title">Basic Information</div>
                        <div class="row">
                            <div class="col-sm-4"><strong class="text-uppercase">Age:</strong></div>
                            <div class="col-sm-8"><?php echo $db_query->calculateYearDifference(date('Y-m-d'),$web_setting->dob); ?></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><strong class="text-uppercase">Email:</strong></div>
                            <div class="col-sm-8"><?php echo $web_setting->email; ?></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><strong class="text-uppercase">Phone:</strong></div>
                            <div class="col-sm-8"><?php echo $web_setting->phone; ?></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><strong class="text-uppercase">Address:</strong></div>
                            <div class="col-sm-8"><?php echo $web_setting->address; ?></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><strong class="text-uppercase">Language:</strong></div>
                            <div class="col-sm-8"><?php echo $web_setting->languages; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>