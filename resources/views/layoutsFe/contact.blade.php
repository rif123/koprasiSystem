<section id="section-contact" class="no-bottom">
<div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                                <h1>{{$section7_title}}</h1>
                                <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                                <div class="spacer-single"></div>
                            </div>

                            <div class="col-md-8 wow fadeInLeft">
                                <form name="contactForm" id='contact_form' method="post" action='/pesan'>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div id='name_error' class='error'>Please enter your name.</div>
                                            <div>
                                                <input type='text' name='name' id='name' class="form-control" placeholder="Your Name">
                                            </div>

                                            <div id='email_error' class='error'>Please enter your valid E-mail ID.</div>
                                            <div>
                                                <input type='text' name='email' id='email' class="form-control" placeholder="Your Email">
                                            </div>

                                            <div id='phone_error' class='error'>Please enter your phone number.</div>
                                            <div>
                                                <input type='text' name='phone' id='phone' class="form-control" placeholder="Your Phone">
                                            </div>
                                            <div id='captcha' class='error'>Captcha must be fill.</div>
                                            <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_SITE') }}"></div>
                                        </div>
                                        <div class="col-md-8">
                                            <div id='message_error' class='error'>Please enter your message.</div>
                                            <div>
                                                <textarea name='message' id='message' class="form-control" placeholder="Your Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <p id='submit'>
                                                <input type='submit' id='send_message' value='Submit Form' class="btn btn-line">
                                            </p>
                                            <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                                            <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-4 wow fadeInRight">

                                <div class="widget_text">
                                    <h3>Contact Info</h3>
                                    <address>
                                       <span>{{$contact->location}}</span>
                                        <span><strong>Phone:</strong>{{$contact->phone}}</span>
                                        <span><strong>Fax:</strong>{{$contact->fax}}</span>
                                        <span><strong>Email:</strong><a href="mailto:{{$contact->email}}">{{$contact->email}}</a></span>
                                        <span><strong>Web:</strong><a href="{{$contact->web}}">{{$contact->web}}</a></span>
                                    </address>
                                </div>

                            </div>
                        </div>
                    </div>
<div class="spacer-double"></div>
</section>
<script src='https://www.google.com/recaptcha/api.js'></script>