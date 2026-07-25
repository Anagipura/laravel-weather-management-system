<x-app-layout>
        <div class="donation-page">

            <!-- HERO -->
            <section class="hero">
                <div class="hero-content">
                    <h1>Make an Impact Today</h1>
                    <p>Every contribution helps disaster-affected communities recover faster.
                        Our Disaster Management System connects you with trusted humanitarian
                        organizations accepting donations for emergency relief, food, shelter,
                        healthcare, and recovery programs.
                    </p>

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

            <section class="quick-donate">
                <div class="donation-notice">
                    <h3>Donate Through Verified Organizations</h3>
                    <p>
                        Our Disaster Management System does not process payments directly.
                        We connect you with trusted humanitarian organizations where you can
                        donate securely.
                    </p>

                    <a href="https://www.donate.gov.lk" target="_blank" class="btn-primary">
                        Visit Official Donation Portal<br/>
                        www.donate.gov.lk
                    </a>
                </div>
            </section>

            <!-- CHARITIES -->
            <section class="section">
                <h2>Trusted Organizations</h2>
                <div class="grid">

                    <div class="card">
                        <h3>Red Cross</h3>
                        <img src="{{asset("build/assets/REDCROSS.jpg")}}" alt="RedCress logo image">
                        <p>Emergency response and disaster relief worldwide.</p>
                        <a href="#">Visit →</a>
                    </div>

                    <div class="card">
                        <h3>UNICEF</h3>
                        <img src="{{asset("build/assets/UNICEF.png")}}" alt="UNICEF icon">
                        <p>Helping children affected by disasters.</p>
                        <a href="#">Visit →</a>
                    </div>

                    <div class="card">
                        <h3>WFP</h3>
                        <img src="{{asset("build/assets/WFP.jpg")}}" alt="WFP icon">
                        <p>Providing food assistance during crises.</p>
                        <a href="#">Visit →</a>
                    </div>

                </div>
            </section>

            <!-- IMPACT -->
            <section class="impact">
                <div class="impact-text">
                    <h2>Why your Donation Matters</h2>
                    <p>Why Your Donation Matters
                        Every disaster leaves families in urgent need of food,
                        clean water, medical care, and temporary shelter.
                        By supporting verified humanitarian organizations,
                        your contribution helps communities recover faster
                        and rebuild their lives with dignity. Every donation,
                        whether financial or in-kind, plays an important role
                        in emergency response and long-term recovery.</p>
                </div>

                <div class="impact-image">
                    <img src="{{ asset("build/assets/impactImage.webp") }}">
                </div>
            </section>

            <!-- RECENT DONATIONS -->
            <section class="section-description">
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
        .donation-page{
            margin:30px;
            padding:var(--spacing-xl);
        }

        .hero{
            background:var(--primary-gradient);
            border-radius:var(--border-radius-lg);
            color:#fff;
            padding:4rem;
            text-align:center;
            margin-bottom:3rem;
            box-shadow:var(--card-shadow);
        }

        .hero-content h1{
            font-size:3rem;
            font-weight:700;
            margin-bottom:1rem;
        }

        .hero-content p{
            max-width:720px;
            margin:0 auto 2.5rem;
            line-height:1.8;
            color:rgba(255,255,255,.92);
        }

        /* Stats */

        .hero-stats{
            display:flex;
            justify-content:center;
            gap:4rem;
            flex-wrap:wrap;
        }

        .hero-stats div{
            text-align:center;
        }

        .hero-stats h3{
            font-size:2rem;
            margin-bottom:.3rem;
        }

        .hero-stats span{
            color:rgba(255,255,255,.85);
        }

        .quick-donate{
            display: flex;
            justify-content: center;
            margin-bottom: 4rem;
        }

        .donation-notice{
            width: 100%;
            max-width: 900px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--border-radius-lg);
            padding: 2.5rem;
            text-align: center;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }

        .donation-notice::before{
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-gradient);
        }

        .donation-notice h3{
            font-size: 1.8rem;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .donation-notice p{
            color: var(--text-secondary);
            line-height: 1.8;
            max-width: 650px;
            margin: 0 auto 2rem;
        }

        .btn-primary{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;

            padding: .9rem 2rem;

            background: var(--primary-gradient);
            color: #fff;

            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;

            transition: var(--transition-normal);
            box-shadow: 0 8px 20px rgba(102,126,234,.25);
        }

        .btn-primary:hover{
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(102,126,234,.35);
        }

        @media(max-width:768px){

            .donation-notice{
                padding: 2rem 1.5rem;
            }

            .donation-notice h3{
                font-size: 1.5rem;
            }

            .btn-primary{
                width: 100%;
            }

        }
        .section{
            margin-bottom:5rem;
        }

        .section h2{
            text-align:center;
            margin-bottom:2rem;
            color:var(--text-primary);
            font-size:2rem;
        }


        .grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:1.5rem;
        }

        .card{
            background:var(--card-bg);
            border-radius:var(--border-radius-md);
            padding:2rem;
            border:1px solid var(--card-border);
            box-shadow:var(--card-shadow);
            transition:var(--transition-normal);
            justify-content: center;
        }

        .card:hover{
            transform:translateY(-6px);
        }

        .card h3{
            color:var(--text-primary);
            margin-bottom:.8rem;
        }

        .card p{
            color:var(--text-secondary);
            line-height:1.7;
            margin-bottom:1.3rem;
        }

        .card a{
            text-decoration:none;
            color:#667eea;
            font-weight:600;
        }

        .impact{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:1rem;
            align-items:center;
            margin-bottom:5rem;
        }

        .impact-text h2{
            color:var(--text-primary);
            margin-bottom:1rem;
        }

        .impact-text p{
            color:var(--text-secondary);
            line-height:1.8;
        }

        .impact-image img{
            width:100%;
            border-radius:var(--border-radius-lg);
            box-shadow:var(--card-shadow);
            object-fit:cover;
        }

        .timeline{
            display:flex;
            flex-direction:column;
            gap:1rem;
        }

        .timeline-item{
            background:var(--card-bg);
            padding:1.3rem 1.5rem;
            border-radius:var(--border-radius-md);
            box-shadow:var(--card-shadow);
            border-left:5px solid #667eea;
        }

        .timeline-item strong{
            display:block;
            color:var(--text-primary);
            margin-bottom:.4rem;
        }

        .timeline-item span{
            display:block;
            margin-top:.5rem;
            color:var(--text-light);
            font-size:.9rem;
        }

        .cta{
            background:var(--primary-gradient);
            color:white;
            border-radius:var(--border-radius-lg);
            padding:3rem;
            text-align:center;
        }

        .cta h2{
            margin-bottom:.8rem;
        }

        .cta p{
            margin-bottom:2rem;
            color:rgba(255,255,255,.9);
        }

        .cta a{
            display:inline-block;
            text-decoration:none;
            background:white;
            color:#667eea;
            padding:.9rem 2rem;
            border-radius:50px;
            font-weight:600;
            transition:var(--transition-normal);
        }

        .cta a:hover{
            transform:translateY(-3px);
        }

        @media(max-width:900px){

            .hero{
                padding:3rem 2rem;
            }

            .hero-content h1{
                font-size:2.3rem;
            }

            .impact{
                grid-template-columns:1fr;
            }

            .hero-stats{
                gap:2rem;
            }

        }

        @media(max-width:768px){

            .donation-page{
                padding:1rem;
            }

            .quick-donate form{
                flex-direction:column;
                border-radius:20px;
            }

            .quick-donate button{
                width:100%;
            }

        }
    </style>

</x-app-layout>
