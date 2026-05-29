<x-app-layout>
        <div class="donation-page">

            <!-- HERO -->
            <section class="hero">
                <div class="hero-content">
                    <h1>Make an Impact Today</h1>
                    <p>Support disaster recovery and help communities rebuild faster.</p>

                    <div class="hero-stats">
                        <div>
                            <h3>Rs. 1.2M+</h3>
                            <span>Raised</span>
                        </div>
                        <div>
                            <h3>850+</h3>
                            <span>Donors</span>
                        </div>
                        <div>
                            <h3>12</h3>
                            <span>Campaigns</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- QUICK DONATE -->
            <section class="quick-donate">
                <form>
                    <input type="number" placeholder="Enter amount (LKR)">
                    <button>Donate Now</button>
                </form>
            </section>

            <!-- CHARITIES -->
            <section class="section">
                <h2>Trusted Organizations</h2>
                <div class="grid">

                    <div class="card">
                        <h3>Red Cross</h3>
                        <p>Emergency response and disaster relief worldwide.</p>
                        <a href="#">Visit →</a>
                    </div>

                    <div class="card">
                        <h3>UNICEF</h3>
                        <p>Helping children affected by disasters.</p>
                        <a href="#">Visit →</a>
                    </div>

                    <div class="card">
                        <h3>WFP</h3>
                        <p>Providing food assistance during crises.</p>
                        <a href="#">Visit →</a>
                    </div>

                </div>
            </section>

            <!-- IMPACT -->
            <section class="impact">
                <div class="impact-text">
                    <h2>Real Impact</h2>
                    <p>We deliver essential supplies, shelter, and medical aid to affected areas.</p>
                </div>

                <div class="impact-image">
                    <img src="{{ asset('images/donation1.jpg') }}">
                </div>
            </section>

            <!-- RECENT DONATIONS -->
            <section class="section">
                <h2>Recent Contributions</h2>

                <div class="timeline">
                    <div class="timeline-item">
                        <strong>Rs. 5,000</strong> donated for Flood Relief
                        <span>2 hours ago</span>
                    </div>

                    <div class="timeline-item">
                        <strong>Rs. 12,000</strong> donated for Medical Aid
                        <span>Yesterday</span>
                    </div>
                </div>
            </section>

            <!-- CONTACT -->
            <section class="cta">
                <h2>Partner With Us</h2>
                <p>Contact us for large donations or collaborations</p>
                <a href="/contact">Contact Now</a>
            </section>

        </div>

    <style>
        .donation-page {
            padding: 30px;
        }

        /* HERO */
        .hero {
            background: var(--primary-gradient);
            color: white;
            border-radius: 20px;
            padding: 60px;
            text-align: center;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 30px;
        }

        .hero-stats h3 {
            font-size: 24px;
        }

        /* QUICK DONATE */
        .quick-donate {
            margin-top: -30px;
            display: flex;
            justify-content: center;
        }

        .quick-donate form {
            display: flex;
            gap: 10px;
            background: var(--card-bg);
            padding: 15px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }

        .quick-donate input {
            padding: 10px;
            border: none;
            border-radius: 8px;
        }

        /* GRID */
        .grid {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            flex: 1;
            background: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* IMPACT */
        .impact {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .impact img {
            width: 100%;
            border-radius: 12px;
        }

        /* TIMELINE */
        .timeline {
            margin-top: 20px;
        }

        .timeline-item {
            padding: 15px;
            background: var(--card-bg);
            border-radius: 10px;
            margin-bottom: 10px;
        }

        /* CTA */
        .cta {
            text-align: center;
            padding: 50px;
            background: var(--secondary-gradient);
            border-radius: 20px;
            color: white;
        }
    </style>

</x-app-layout>
