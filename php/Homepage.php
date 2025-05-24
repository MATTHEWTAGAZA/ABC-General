<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Centralized Animal Management System - Providing 24/7 animal bite care and rabies prevention services.">
    <title>Centralized Animal Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif; /* Updated font family */
            margin: 0;
            background-color: #1e6a48; /* Dark green background */
            color: #1e6a48;
            line-height: 1.6;
            box-sizing: border-box; /* Ensure padding and borders are included in element width/height */
        }

        * {
            box-sizing: inherit; /* Inherit box-sizing for all elements */
        }

       
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 10px 0 0;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .hero {
            position: relative;
            text-align: center;
            color: white;
            background-color: #1e6a48; /* Lighten the background color */
            padding: 50px 20px 40px; /* Add padding-top to account for the header height */
            margin-bottom: 20px; /* Add margin to separate from the next section */
        }

        .hero-text {
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .hero-text h2 {
            font-size: 2em;
            margin: 0;
        }

        .hero-text p {
            font-size: 1.2em;
        }

        .container {
            width: 80%;
            margin: 40px auto;
            max-width: 1200px;
        }

        .overview, .contact, .first-aid, .understanding-rabies {
            background-color: #e8f5e9;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .overview h2, .contact h2, .first-aid h2, .understanding-rabies h2 {
            text-align: center;
            color: #1b5e20;
            margin-bottom: 20px;
        }

        .services {
            margin-bottom: 40px;
        }

        .services h2 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 30px;
        }

        .service-list {
            display: flex;
            flex-wrap: wrap; /* Allow items to wrap to the next row */
            justify-content: space-between;
            gap: 20px;
        }

        .service-item {
            flex: 1 1 calc(33.333% - 20px); /* Ensure items fit within the container */
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .service-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .service-item h3 {
            margin-bottom: 10px;
            color: #1e6a48;
        }

        footer {
            background-color: #1e6a48;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <main>
        <section class="hero" role="region" aria-label="Hero Section" style="background-color: #1e6a48;">
            <div class="hero-text">
                <h2>Centralized Animal Management System, San Pablo City</h2>
                <p>Providing 24/7 animal bite care and rabies prevention services.</p>
                <nav aria-label="Main Navigation">
                <ul>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="Homepage.php">Information</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
                <div style="margin-top: 20px; background-color: rgba(0, 0, 0, 0.6); padding: 20px; border-radius: 10px; text-align: left;">
                    <h3 style="color: #f2f2f2; margin-bottom: 10px;">Available Animal Bite Centers:</h3>
                    <div style="color: #f2f2f2; margin-bottom: 15px;">
                        <strong>ABC-1:</strong><br>
                        Address: 09 Werner Schetelig Avenue, San Pablo City, Laguna.<br>
                        Clinic Schedule: MON - SUN 8AM-6PM
                    </div>
                    <div style="color: #f2f2f2; margin-bottom: 15px;">
                        <strong>ABC-2:</strong><br>
                        Address: ELQ Commercial Building Purok 4, Brgy. San Rafael, San Pablo City, Laguna.<br>
                        Clinic Schedule: MON-SUN 10AM-6PM
                    </div>
                    <div style="color: #f2f2f2;">
                        <strong>ABC-3:</strong><br>
                        Address: Maharlika Highway Brgy. San Rafael, San Pablo City, Laguna.<br>
                        Clinic Schedule: MON-SUN 8AM-6PM
                    </div>
                </div>
            </div>
        </section>

        <section class="overview" role="region" aria-label="Overview Section">
            <div class="container">
                <h2>Overview</h2>
                <p>The Centralized Animal Management System is dedicated to providing comprehensive care for individuals exposed to animal bites. Our goal is to prevent rabies and other infections through timely and effective treatment. We work closely with healthcare professionals to ensure the highest standards of care and accessibility for all patients.</p>
                <p>Our services include pre-exposure and post-exposure prophylaxis, rabies immunoglobulin administration, and booster vaccinations. We are committed to raising awareness about rabies prevention and ensuring that every patient receives the care they need.</p>
            </div>
        </section>

        <section class="services" role="region" aria-label="Services Section">
            <div class="container">
                <h2>Our Services</h2>
                <div class="service-list">
                    <div class="service-item">
                        <img src="images/service1.jpg" alt="Pre-exposure Prophylaxis">
                        <h3>Pre-exposure Prophylaxis</h3>
                        <p>Vaccination for individuals at high risk of rabies exposure, such as veterinarians, animal handlers, and travelers to high-risk areas. This service provides immunity before potential exposure to rabies.</p>
                    </div>
                    <div class="service-item">
                        <img src="images/service2.jpg" alt="Post-exposure Prophylaxis">
                        <h3>Post-exposure Prophylaxis</h3>
                        <p>Immediate treatment after exposure to potentially rabid animals. This includes wound cleaning, rabies vaccination, and, if necessary, rabies immunoglobulin to neutralize the virus at the site of the bite.</p>
                    </div>
                    <div class="service-item">
                        <img src="images/service3.jpg" alt="Rabies Immunoglobulin (RIG)">
                        <h3>Rabies Immunoglobulin (RIG)</h3>
                        <p>Administration of rabies immunoglobulin (either ERIG or HRIG) for individuals with severe exposure to rabies. This provides immediate passive immunity while the rabies vaccine builds active immunity.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="first-aid" role="region" aria-label="First Aid Treatment Section">
            <div class="container">
                <h2>First Aid Treatment</h2>
                <p>Immediate first aid is crucial after an animal bite to reduce the risk of infection and rabies transmission. Follow these steps:</p>
                <ul>
                    <li>Wash the wound thoroughly with soap and running water for at least 15 minutes.</li>
                    <li>Apply an antiseptic solution, such as iodine or alcohol, to disinfect the wound.</li>
                    <li>Avoid covering the wound with bandages unless advised by a healthcare professional.</li>
                    <li>Seek medical attention immediately for further evaluation and treatment.</li>
                </ul>
                <p>Remember, timely medical intervention can save lives.</p>
            </div>
        </section>

        <section class="understanding-rabies" role="region" aria-label="Understanding Rabies Section">
            <div class="container">
                <h2>Understanding Rabies</h2>
                <p>Rabies is a deadly viral disease that affects the central nervous system of mammals, including humans. It is primarily transmitted through the saliva of infected animals via bites or scratches.</p>
                <h3>Key Facts About Rabies:</h3>
                <ul>
                    <li>Rabies is preventable through timely vaccination and treatment.</li>
                    <li>Common carriers include dogs, bats, raccoons, and other wild animals.</li>
                    <li>Symptoms in humans include fever, headache, muscle weakness, and neurological issues.</li>
                    <li>Once symptoms appear, rabies is almost always fatal, making prevention critical.</li>
                </ul>
                <p>Awareness and prompt action are essential to prevent rabies and protect lives.</p>
            </div>
        </section>
    </main>

    <footer role="contentinfo">
        <div class="footer-container">
            <p>&copy; <?php echo date("Y"); ?> Centralized Animal Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
