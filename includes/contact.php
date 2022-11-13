<div class="section" id="contact">
    <div class="cc-contact-information" style="background-image: url('images/staticmap.png')">
        <div class="container">
            <div class="cc-contact">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-0" data-aos="zoom-in">
                            <div class="h4 text-center title">Contact Me</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <form>
                                            <div class="p pb-3"><strong>Feel free to contact me </strong></div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                                        <input class="form-control" type="text" id="name" placeholder="Name" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                                        <input class="form-control" type="text" id="subject" placeholder="Subject" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                        <input class="form-control" type="email" id="reply_email" placeholder="E-mail" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="message" placeholder="Your Message" required="required"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn btn-primary" id="contact_form" type="button">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <p class="mb-0"><strong>Address </strong></p>
                                        <p class="pb-2"><?php echo $web_setting->address; ?></p>
                                        <p class="mb-0"><strong>Phone</strong></p>
                                        <p class="pb-2"><?php echo $web_setting->phone; ?></p>
                                        <p class="mb-0"><strong>Email</strong></p>
                                        <p><?php echo $web_setting->email; ?></p>
                                    </div>
                                </div>
                            </div>
                            <p class="p pb-3 h5 text-center" id="contact_status"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>