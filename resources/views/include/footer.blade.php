<style>
    footer {
        width: 100%;
        background-color: #f8f9fa; /* Light gray background */
        padding: 20px 0;
        position: relative;
        bottom: 0;
    }
    .footer-container {
        width: 80%;
        margin: auto;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .footer-section {
        flex: 1;
        min-width: 250px;
        margin-bottom: 20px;
    }
    .footer-section h6 {
        font-weight: bold;
    }
    .footer-section p {
        margin: 5px 0;
    }
    .footer-bottom {
        text-align: center;
        margin-top: 20px;
    }
</style>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h6>CUSTOMER SERVICE</h6>
            <p>Help Centre</p>
            <p>Payment methods</p>
            <p>Order Tracking</p>
            <p>Free Shipping</p>
            <p>Return & Refund</p>
            <p>Konekta guarantee</p>
            <p>Contact us</p>
        </div>
        <div class="footer-section">
            <h6>ABOUT KONEKTA</h6>
            <p>About us</p>
            <p>Privacy Policy</p>
            <p>Media Content</p>
        </div>
        <div class="footer-section">
            <h6>FOLLOW US</h6>
            <p>Facebook</p>
            <p>Instagram</p>
            <p>Twitter</p>
            <p>LinkedIn</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>
            <a href="{{ url('/privacy-policy') }}" style="text-decoration: none; color:black;">Privacy Policy</a> |
            <a href="{{ url('/terms-of-service') }}" style="text-decoration: none; color:black;">Terms & Conditions</a>
        </p>
        <p>&copy; {{ date('Y') }} Konekta. All rights reserved.</p>
    </div>
</footer>
