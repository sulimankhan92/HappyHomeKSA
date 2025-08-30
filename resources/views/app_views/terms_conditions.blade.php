<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - Happy Home Sweets</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            padding: 0;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-bottom: 30px;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .last-updated {
            text-align: center;
            font-style: italic;
            color: #666;
            margin-bottom: 30px;
        }

        .policy-section {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 25px;
        }

        .policy-section h2 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.5rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .policy-section p {
            margin-bottom: 15px;
        }

        .policy-section ul {
            margin-left: 20px;
            margin-bottom: 15px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }

            .container {
                padding: 15px;
            }

            .policy-section {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 1.7rem;
            }

            .policy-section h2 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <h1>Terms and Conditions</h1>
    </div>
</header>

<main class="container">
    <p class="last-updated">Last updated: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>

    <section class="policy-section">
        <h2>1. Introduction</h2>
        <p>Welcome to Happy Home ("we," "our," or "us"). These Terms and Conditions govern your use of our mobile application and services.</p>
    </section>

    <section class="policy-section">
        <h2>2. Acceptance of Terms</h2>
        <p>By accessing or using our app, you agree to be bound by these Terms. If you disagree, please do not use our services.</p>
    </section>

    <section class="policy-section">
        <h2>3. User Accounts</h2>
        <p>To make purchases, you must create an account with accurate information. You are responsible for maintaining the confidentiality of your account credentials.</p>
    </section>

    <section class="policy-section">
        <h2>4. Purchases and Payments</h2>
        <p>All prices are in SAR. We accept [payment methods]. You authorize us to charge your selected payment method for the total amount.</p>
    </section>

    <section class="policy-section">
        <h2>5. Returns and Refunds</h2>
        <p>Our return policy lasts 2 days. To be eligible, items must be unused and in original packaging.</p>
    </section>

    <section class="policy-section">
        <h2>6. Intellectual Property</h2>
        <p>All content in the app, including text, graphics, and logos, is our property and protected by copyright laws.</p>
    </section>

    <section class="policy-section">
        <h2>7. Limitation of Liability</h2>
        <p>We shall not be liable for any indirect, incidental, or consequential damages arising from your use of the app.</p>
    </section>

    <section class="policy-section">
        <h2>8. Governing Law</h2>
        <p>These Terms shall be governed by the laws of KSA without regard to conflict of law provisions.</p>
    </section>

    <section class="policy-section">
        <h2>9. Changes to Terms</h2>
        <p>We may modify these Terms at any time. Continued use after changes constitutes acceptance of the new Terms.</p>
    </section>

    <section class="policy-section">
        <h2>10. Contact Information</h2>
        <p>For questions about these Terms, contact us at <a href="mailto:support@happyhome.com">support@happyhome.com</a>.</p>
    </section>
</main>

<footer>
    <div class="container">
        <p>&copy; {{ date('Y') }} Happy Home. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
