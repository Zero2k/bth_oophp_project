<div class="footer">
    <div class="container">
        <div class="row ">
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                <div class="footer-widget ">
                    <div class="footer-title">elite<b>appeal</b></div>
                    <ul class="list-unstyled">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Legal & Privacy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                <div class="footer-widget ">
                    <div class="footer-title">Quick Links</div>
                    <ul class="list-unstyled">
                        <li><a href="#">News</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                <div class="footer-widget ">
                    <div class="footer-title">Social</div>
                    <ul class="list-unstyled">
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Google +</a></li>
                        <li><a href="#">Linked In</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-6 col-6 ">
                <div class="footer-widget">
                    <h3 class="footer-title">Subscribe Newsletter</h3>
                    <form>
                        <div class="newsletter-form">
                            <input class="form-control" placeholder="Enter Your Email address" type="text">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center ">
                <div class="footer-copyright">
                    <p>© Copyright 2016. All Rights Reserved. Created by Viktor Bengtsson (https://github.com/Zero2k)</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php foreach ($javascript as $js) : ?>
    <script src="<?= $this->asset($js) ?>"></script>
<?php endforeach; ?>
