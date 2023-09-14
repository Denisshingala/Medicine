<!-- Footer Start -->
<div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h1 class="fw-bold text-primary mb-4">Rushi <span class="text-secondary">Marketing</span></h1>
                <p>Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-square btn-outline-light rounded-circle me-1" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-outline-light rounded-circle me-1" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-outline-light rounded-circle me-1" href="#"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-square btn-outline-light rounded-circle me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Address</h4>
                <p><i class="fa fa-map-marker-alt me-3"></i><?php echo $data['address'] ?? "company address" ?></p>
                <p><i class="fa fa-phone-alt me-3"></i><?php echo $data['mobile_number'] ?? "company mobile number" ?></p>
                <p><i class="fa fa-envelope me-3"></i><?php echo $data['company_email'] ?? "company email" ?></p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Quick Links</h4>
                <a class="btn btn-link" href="contact.php">Contact Us</a>
            </div>
        </div>
    </div>
    <div class="container-fluid copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="">Rushi marketing</a>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->