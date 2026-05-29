<x-app-layout>
    <main class="about-container">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">Saving Lives Through Technology</h1>
                <p class="hero-subtitle">A comprehensive real-time disaster management and emergency response system</p>
                <div class="hero-stats">
                    <div class="stat-box">
                        <span class="stat-number">50K+</span>
                        <span class="stat-label">Lives Protected</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">100+</span>
                        <span class="stat-label">Cities Covered</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Monitoring</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">15min</span>
                        <span class="stat-label">Average Response Time</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="floating-elements">
                    <div class="floating-icon map"><i class="fas fa-map-marked-alt"></i></div>
                    <div class="floating-icon alert"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="floating-icon rescue"><i class="fas fa-helicopter"></i></div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="mission-vision">
            <div class="mission-card">
                <div class="card-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Our Mission</h3>
                <p>To leverage cutting-edge technology for proactive disaster prediction, real-time monitoring, and swift emergency response, minimizing loss of life and property during natural disasters.</p>
            </div>
            <div class="vision-card">
                <div class="card-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Our Vision</h3>
                <p>A world where communities are resilient, prepared, and protected through intelligent disaster management systems that anticipate, alert, and act with precision.</p>
            </div>
        </section>

        <!-- What We Do -->
        <section class="services-section">
            <div class="section-header">
                <h2>What We Do</h2>
                <p>Comprehensive disaster management solutions</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon prediction">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Real-time Prediction</h4>
                    <p>Advanced AI models analyze weather patterns, seismic activity, and historical data to predict potential disasters with 92% accuracy.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon alerting">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h4>Instant Alert System</h4>
                    <p>Multi-channel notification system (SMS, App, Email) that alerts residents and authorities within seconds of detection.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon coordination">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <h4>Emergency Coordination</h4>
                    <p>Centralized platform connecting emergency services, volunteers, and government agencies for efficient response coordination.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon resources">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h4>Resource Management</h4>
                    <p>Real-time tracking of emergency shelters, medical supplies, and rescue equipment across affected regions.</p>
                </div>
            </div>
        </section>

        <!-- Partners -->
        <section class="partners-section">
            <div class="section-header">
                <h2>Our Partners</h2>
                <p>Collaborating for a safer world</p>
            </div>
            <div class="partners-grid">
                <div class="partner-logo">
                    <i class="fas fa-globe-asia"></i>
                    <span>World Disaster Org</span>
                </div>
                <div class="partner-logo">
                    <i class="fas fa-cross"></i>
                    <span>Red Cross</span>
                </div>
                <div class="partner-logo">
                    <i class="fas fa-university"></i>
                    <span>Govt. Agencies</span>
                </div>
                <div class="partner-logo">
                    <i class="fas fa-hospital"></i>
                    <span>Health Ministry</span>
                </div>
                <div class="partner-logo">
                    <i class="fas fa-cloud-sun"></i>
                    <span>Weather Bureau</span>
                </div>
            </div>
        </section>

        <!-- Contact CTA -->
        <section class="contact-cta">
            <div class="cta-content">
                <h2>Want to Contact us?</h2>
                <p>Whether you're a volunteer, researcher, or partner organization, we'd love to hear from you.</p>
                <div class="cta-buttons">
                    <a href="contact.html" class="btn-cta outline">
                        <i class="fas fa-envelope"></i>
                        Contact Us
                    </a>
                </div>
            </div>
        </section>
    </main>
    <style>
        /* About Container */
        .about-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Hero Section */
        .hero-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            margin-bottom: 6rem;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            border-radius: 30px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: var(--primary-gradient);
            border-radius: 50%;
            opacity: 0.1;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .stat-box {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .stat-box:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }

        .stat-number {
            display: block;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-image {
            position: relative;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .floating-elements {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .floating-icon {
            position: absolute;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: float 6s ease-in-out infinite;
        }

        .floating-icon.map {
            background: var(--primary-gradient);
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-icon.alert {
            background: var(--danger-gradient);
            top: 60%;
            left: 70%;
            animation-delay: 2s;
        }

        .floating-icon.rescue {
            background: var(--success-gradient);
            top: 10%;
            left: 70%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Mission & Vision */
        .mission-vision {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 6rem;
        }

        .mission-card, .vision-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .mission-card::before, .vision-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
        }

        .mission-card::before {
            background: var(--primary-gradient);
        }

        .vision-card::before {
            background: var(--secondary-gradient);
        }

        .mission-card:hover, .vision-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }

        .card-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .mission-card .card-icon {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .vision-card .card-icon {
            background: rgba(79, 172, 254, 0.1);
            color: #4facfe;
        }

        .mission-card h3, .vision-card h3 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: var(--text-primary);
        }

        .mission-card p, .vision-card p {
            color: var(--text-secondary);
            line-height: 1.8;
            font-size: 1.1rem;
        }

        /* Services Section */
        .services-section {
            margin-bottom: 6rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .section-header p {
            font-size: 1.2rem;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            text-align: center;
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--hover-shadow);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2rem;
            color: white;
        }

        .service-icon.prediction {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .service-icon.alerting {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .service-icon.coordination {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .service-icon.resources {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .service-card h4 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .service-card p {
            color: var(--text-secondary);
            line-height: 1.6;
            font-size: 1rem;
        }

        /* Team Section */
        .team-section {
            margin-bottom: 6rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .team-member {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            text-align: center;
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }

        .member-image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .member-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .team-member:hover .member-image img {
            transform: scale(1.1);
        }

        .member-social {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .team-member:hover .member-social {
            opacity: 1;
            transform: translateY(0);
        }

        .member-social a {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .member-social a:hover {
            background: var(--primary-gradient);
            color: white;
            transform: translateY(-5px);
        }

        .team-member h4 {
            font-size: 1.3rem;
            margin: 1.5rem 0 0.5rem;
            color: var(--text-primary);
        }

        .member-role {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .member-bio {
            color: var(--text-secondary);
            padding: 0 1.5rem 2rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Technology Section */
        .tech-section {
            margin-bottom: 6rem;
        }

        .tech-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 2rem;
        }

        .tech-item {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .tech-item:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
            background: var(--primary-gradient);
            color: white;
        }

        .tech-item:hover i,
        .tech-item:hover span {
            color: white;
        }

        .tech-item i {
            color: var(--primary-color);
            transition: color 0.3s ease;
        }

        .tech-item span {
            font-weight: 600;
            color: var(--text-primary);
            transition: color 0.3s ease;
        }

        /* Partners Section */
        .partners-section {
            margin-bottom: 6rem;
        }

        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .partner-logo {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .partner-logo:hover {
            transform: scale(1.05);
            box-shadow: var(--hover-shadow);
        }

        .partner-logo i {
            font-size: 3rem;
            color: var(--primary-color);
        }

        .partner-logo span {
            font-weight: 600;
            color: var(--text-primary);
            text-align: center;
        }

        /* Contact CTA */
        .contact-cta {
            background: var(--primary-gradient);
            padding: 5rem 2rem;
            border-radius: 30px;
            text-align: center;
            color: white;
            margin-bottom: 4rem;
        }

        .cta-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .cta-content p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 3rem;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-cta {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            transition: all 0.3s ease;
        }

        .btn-cta.primary {
            background: white;
            color: var(--primary-color);
        }

        .btn-cta.primary:hover {
            background: #f8f9fa;
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-cta.secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-cta.secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-5px);
        }

        .btn-cta.outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .btn-cta.outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
            transform: translateY(-5px);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-section {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 3rem;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .mission-vision {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-cta {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .about-container {
                padding: 1rem;
            }

            .hero-section {
                padding: 2rem 1rem;
                margin-bottom: 3rem;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-stats {
                grid-template-columns: 1fr;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .tech-grid, .partners-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .floating-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .mission-card, .vision-card {
                padding: 2rem;
            }
        }
    </style>
</x-app-layout>
