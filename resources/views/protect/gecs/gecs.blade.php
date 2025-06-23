@extends('layouts.app')

@section('contents')
<!-- Hero Section with Modern Design -->
<div class="container-fluid p-0">
    <div class="hero-container position-relative overflow-hidden">
        <img src="{{ asset('images/gecs6.jpg') }}" class="hero-image" alt="GECS Communications Network">
        <div class="hero-overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 text-center">
                        <div class="hero-content">
                            <h1 class="hero-title">Government Emergency Communications System</h1>
                            <p class="hero-text">Ensuring reliable communications during emergencies across the Philippines</p>
                            <a href="#about" class="btn btn-light btn-lg hero-btn">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About GECS Section -->
<section id="about" class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="mb-4" style="color: #003566; border-bottom: 3px solid #003566; padding-bottom: 10px;">What is GECS?</h2>
                <p class="lead">The Government Emergency Communications System (GECS) is a dedicated network that ensures reliable communications during disasters and emergencies throughout the Philippines.</p>
                <p>The Philippines is prone to natural calamities as it is situated in the west of the Pacific Ring of Fire. It remains on top of the list of countries suffering most from extreme weather events and sustaining weather-related losses — in 2018 and over a 20-year period from 1998 to 2018, according to the Global Climate Risk Index 2020.</p>
                <p>When major disasters like typhoons or earthquakes strike, communications systems immediately go down. This is a blindfold for emergency responders who need to know where and how to direct urgent assistance.</p>
                <div class="mt-4">
                    <a href="#features" class="btn btn-primary" style="background-color: #003566; border-color: #003566;">Discover Key Features</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 rounded shadow">
                    <img src="{{ asset('images/gecslogo.png') }}" alt="GECS Network Infrastructure" class="img-fluid rounded" style="width: 100%; object-fit: cover;">
                    <div class="bg-white p-3 mt-3 rounded shadow-sm">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-muted fst-italic">GECS-MOVE: Mobile Operations Vehicle for Emergencies - Ensuring connectivity when disaster strikes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How GECS Works - Grid Layout -->
<section class="py-5" style="background-color: #003566;">
    <div class="container">
        <h2 class="text-center mb-5 text-white">How GECS Works</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-broadcast-pin text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="text-primary">Mobile Operations</h4>
                        <p class="text-dark">Six high-tech, mobile, emergency telecommunications units have been designed and prepositioned in major disaster-prone areas of the Philippines, ready to be rapidly deployed closer to the disaster zone at first notice.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-building text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="text-primary">Reliable Connectivity</h4>
                        <p class="text-dark">When commercial telecommunications are down - as in most major disasters - coordination among responders in the local, provincial, and even national government response clusters will be supported through these temporary but reliable structures.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-people text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="text-primary">Expert Support</h4>
                        <p class="text-dark">More than 30 highly specialized technical and capacity training courses have been conducted to teach DICT personnel and disaster responders on the utilization of the GECS-MOVE units.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GECS Components Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #003566;">GECS-MOVE Unit Components</h2>
        
        <div class="row g-4">
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="{{ asset('images/gecs1.jpg') }}" class="card-img-top" alt="GECS Hub" style="height: 400px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="color: #003566;">Hub</h5>
                        <p class="card-text mb-4">A self-contained mobile operations and coordination center housed in a customized heavy-duty truck equipped with an integrated communications system where a crew of ETC experts can live and sleep.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="{{ asset('images/gecs4.jpg') }}" class="card-img-top" alt="GECS Dispatch" style="height: 400px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="color: #003566;">Dispatch</h5>
                        <p class="card-text mb-4">A self-sustained connectivity hub installed in a heavy-duty off-road vehicle which helps extend the reach of the Hub into disaster zone.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 mt-4">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="{{ asset('images/gecsmotor.jpg') }}" class="card-img-top" alt="GECS Motorcycle" style="height: 400px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="color: #003566;">Off-road Motorcycle</h5>
                        <p class="card-text mb-4">Off-road motorcycle equipped with communications equipment. This supports the crew in reaching deeper into remote and inaccessible terrain, (e.g. mountain tops) with VHF equipment.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 mt-4">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="{{ asset('images/gecsdrone.jpg') }}" class="card-img-top" alt="GECS Drones" style="height: 400px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="color: #003566;">Heavy-duty Drones</h5>
                        <p class="card-text mb-4">Two heavy-duty drones to further extend connectivity beyond what ground vehicles can reach in disaster-affected areas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GECS Projects in the Philippines - Grid Layout -->
<section class="py-5" style="background-color: #f0f4f8;">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #003566;">GECS-MOVE Deployments</h2>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="{{ asset('images/gecs5.jpg') }}" class="card-img-top" alt="Luzon Cluster" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="color: #003566;">Luzon Cluster - Batangas City</h5>
                        <p class="card-text mb-4">GECS-MOVE unit deployed in May 2021 to serve the Luzon Cluster 2 region, providing emergency communications capability during disasters.</p>
                        <span class="badge bg-success">Deployed</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="{{ asset('images/gecs3.jpg') }}" class="card-img-top" alt="Visayas Cluster" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="color: #003566;">Visayas Cluster - Tacloban City</h5>
                        <p class="card-text mb-4">GECS-MOVE unit deployed in May 2021 to serve the Visayas Cluster 2 region, enhancing disaster response capability in an area frequently affected by typhoons.</p>
                        <span class="badge bg-success">Deployed</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="{{ asset('images/gecs6.jpg') }}" class="card-img-top" alt="Mindanao Cluster" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="color: #003566;">Mindanao Cluster - Butuan City</h5>
                        <p class="card-text mb-4">GECS-MOVE unit deployed in May 2021 to serve the Mindanao Cluster 2 region, providing critical communications infrastructure during emergencies.</p>
                        <span class="badge bg-success">Deployed</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mt-4">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="{{ asset('images/gecs2.jpg') }}" class="card-img-top" alt="Luzon Cluster 2" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="color: #003566;">Luzon Cluster - Mabalacat City</h5>
                        <p class="card-text mb-4">GECS-MOVE unit deployed in June 2021 to serve as an additional asset in the Luzon Cluster 2 region, strengthening emergency response capabilities.</p>
                        <span class="badge bg-success">Deployed</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mt-4">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="{{ asset('images/gecs4.jpg') }}" class="card-img-top" alt="Davao Region" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="color: #003566;">Davao Region - Davao del Sur</h5>
                        <p class="card-text mb-4">GECS-MOVE unit deployed in December 2019, one of the first deployments in the program to serve the Davao Region.</p>
                        <span class="badge bg-success">Deployed</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mt-4">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="{{ asset('images/gecs1.jpg') }}" class="card-img-top" alt="NCR" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="color: #003566;">National Capital Region - Quezon City</h5>
                        <p class="card-text mb-4">GECS-MOVE unit stationed in the NCR to serve as the central hub for emergency communications and coordination during disasters.</p>
                        <span class="badge bg-success">Deployed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Importance and Impact - Grid Layout -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="text-center" style="color: #003566;">Implementation and Funding</h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 border-0 shadow hover-card">
                    <div class="card-header" style="background-color: #003566; color: white;">
                        <h4>Project Implementation</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex">
                                <i class="bi bi-check-circle-fill me-2" style="color: #003566;"></i>
                                <span>In December 2018, WFP signed a ground-breaking five-year partnership agreement with the Philippine Government through DICT to launch the GECS-MOVE project.</span>
                            </li>
                            <li class="list-group-item d-flex">
                                <i class="bi bi-check-circle-fill me-2" style="color: #003566;"></i>
                                <span>Completed in May 2021, the project's first phase was funded primarily by the Philippine Government with additional financial support from USAID and WFP.</span>
                            </li>
                            <li class="list-group-item d-flex">
                                <i class="bi bi-check-circle-fill me-2" style="color: #003566;"></i>
                                <span>The GECS-MOVE project is integral to WFP's work in the Philippines, and its commitment to enhance national and local government's capabilities.</span>
                            </li>
                            <li class="list-group-item d-flex">
                                <i class="bi bi-check-circle-fill me-2" style="color: #003566;"></i>
                                <span>More than 30 highly specialized technical and capacity training courses conducted from June 2019 to March 2021.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card mb-4 border-0 shadow hover-card">
                    <div class="card-header" style="background-color: #003566; color: white;">
                        <h4>Funding and Future Plans</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex">
                                <i class="bi bi-check-circle-fill me-2" style="color: #003566;"></i>
                                <span>Phase 1 funded primarily by the Philippine Government (USD $4 million; PHP 200M) with additional financial support from USAID and WFP.</span>
                            </li>
                            <li class="list-group-item d-flex">
                                <i class="bi bi-check-circle-fill me-2" style="color: #003566;"></i>
                                <span>DICT and WFP have committed to start a second phase of the GECS-MOVE project (USD $3.2m plus USD $1m from WFP).</span>
                            </li>
                            <li class="list-group-item d-flex">
                                <i class="bi bi-check-circle-fill me-2" style="color: #003566;"></i>
                                <span>Phase 2 includes building four additional sets with enhanced specifications and design.</span>
                            </li>
                            <li class="list-group-item d-flex">
                                <i class="bi bi-check-circle-fill me-2" style="color: #003566;"></i>
                                <span>Focus on soft skills training, including for new staff, to support DICT's recent mandate to lead the national ETC.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow hover-card">
                    <div class="card-body">
                        <h4 class="mb-4" style="color: #003566;">Project Funding Breakdown</h4>
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <canvas id="fundingChart" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-4">
                                <div class="funding-legend">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="legend-color" style="background-color: #003566;"></div>
                                        <div>Philippine Government (Phase 1): $4M</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="legend-color" style="background-color: #0466c8;"></div>
                                        <div>DICT (Phase 2): $3.2M</div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="legend-color" style="background-color: #002855;"></div>
                                        <div>WFP (Phase 2): $1M</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="legend-color" style="background-color: #001845;"></div>
                                        <div>USAID & WFP (Phase 1): Additional Support</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GECS Features Grid -->
<section class="py-5" style="background-color: #f0f4f8;">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #003566;">Key Partners</h2>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow feature-card">
                    <div class="card-body text-center">
                        <i class="bi bi-building" style="font-size: 3rem; color: #003566;"></i>
                        <h5 class="mt-3" style="color: #003566;">DICT</h5>
                        <p>Department of Information and Communications Technology - Leading government agency for the GECS-MOVE project implementation.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 shadow feature-card">
                    <div class="card-body text-center">
                        <i class="bi bi-globe" style="font-size: 3rem; color: #003566;"></i>
                        <h5 class="mt-3" style="color: #003566;">WFP</h5>
                        <p>World Food Programme - Providing technical expertise and support through the Emergency Telecommunications Cluster.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 shadow feature-card">
                    <div class="card-body text-center">
                        <i class="bi bi-briefcase" style="font-size: 3rem; color: #003566;"></i>
                        <h5 class="mt-3" style="color: #003566;">USAID</h5>
                        <p>United States Agency for International Development - Providing additional financial support for the GECS-MOVE initiative.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Gallery Grid -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #003566;">GECS-MOVE in Action</h2>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item">
                    <img src="{{ asset('images/gecs5.jpg') }}" class="img-fluid rounded shadow" alt="GECS Mobile Unit" style="width: 100%; object-fit: cover; height: 250px;">
                    <div class="gallery-overlay">
                        <div class="gallery-text">Mobile Operations Vehicle</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item">
                    <img src="{{ asset('images/gecs10.jpg') }}" class="img-fluid rounded shadow" alt="Emergency Communications" style="width: 100%; object-fit: cover; height: 250px;">
                    <div class="gallery-overlay">
                        <div class="gallery-text">Emergency Communications Setup</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item">
                    <img src="{{ asset('images/gecs12.jpg') }}" class="img-fluid rounded shadow" alt="Response Team" style="width: 100%; object-fit: cover; height: 250px;">
                    <div class="gallery-overlay">
                        <div class="gallery-text">Response Team in Action</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-3">
                <div class="gallery-item">
                    <img src="{{ asset('images/gecs14.jpg') }}" class="img-fluid rounded shadow" alt="Equipment" style="width: 100%; object-fit: cover; height: 300px;">
                    <div class="gallery-overlay">
                        <div class="gallery-text">Equipment Deployment</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-3">
                <div class="gallery-item">
                    <img src="{{ asset('images/gecs15.jpg') }}" class="img-fluid rounded shadow" alt="Training" style="width: 100%; object-fit: cover; height: 300px;">
                    <div class="gallery-overlay">
                        <div class="gallery-text">Personnel Training</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSS for the page -->
<style>
    /* Primary color variations */
    :root {
        --primary-color: #003566;
        --primary-light: #004b8d;
        --primary-dark: #002547;
        --light-bg: #f8f9fa;
        --accent-color: #ffc107;
    }
    
    /* Modern Hero Section */
    .hero-container {
        height: 400px; /* Thinner height */
        overflow: hidden;
    }
    
    .hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.8);
    }
    
    .hero-overlay {
        position: relative;
        width: 100%;
        height: 100%;
        margin-top: -400px; /* Match hero container height */
        background: linear-gradient(90deg, rgba(0,53,102,0.8) 0%, rgba(0,75,141,0.7) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero-content {
        padding: 2rem;
        max-width: 800px;
        width: 100%;
        background-color: rgba(0, 53, 102, 0.5);
        backdrop-filter: blur(5px);
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .hero-title {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        letter-spacing: 0.5px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    .hero-text {
        color: white;
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }
    
    .hero-btn {
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .hero-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    
    /* Custom styling */
    h2 {
        font-weight: 600;
    }
    
    /* Fix the text in How GECS Works section */
    .text-primary {
        color: #003566 !important;
    }
    
    .text-dark {
        color: #212529 !important;
    }
    
    /* Card animations and hover effects */
    .hover-card {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .hover-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 15px rgba(0,0,0,0.2);
    }
    
    /* Feature cards hover effect */
    .feature-card {
        transition: all 0.3s ease;
        border: none;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        background-color: #f8f9fa;
    }
    
    /* Gallery image hover effects */
    .gallery-item {
        position: relative;
        overflow: hidden;
        margin-bottom: 1rem;
        border-radius: 0.375rem;
        cursor: pointer;
    }
    
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 53, 102, 0.7);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }
    
    .gallery-text {
        font-size: 1.25rem;
        font-weight: 600;
        text-align: center;
        padding: 1rem;
    }
    
    /* Accordion styling */
    .accordion-button:not(.collapsed) {
        background-color: #e7f1ff;
        color: var(--primary-color);
    }
    
    .accordion-button:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(0, 53, 102, 0.25);
    }
    
    /* Funding chart legend */
    .funding-legend {
        padding: 10px;
    }
    
    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 4px;
        margin-right: 10px;
    }
    
    /* Improve responsiveness */
    @media (max-width: 1200px) {
        .hero-title {
            font-size: 2.2rem;
        }
    }
    
    @media (max-width: 992px) {
        .hero-container {
            height: 350px;
        }
        
        .hero-overlay {
            margin-top: -350px;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-text {
            font-size: 1.1rem;
        }
    }
    
    @media (max-width: 768px) {
        .hero-container {
            height: 300px;
        }
        
        .hero-overlay {
            margin-top: -300px;
        }
        
        .hero-title {
            font-size: 1.8rem;
        }
        
        .hero-text {
            font-size: 1rem;
        }
        
        .gallery-item {
            margin-bottom: 1rem;
        }
        
        .mt-4 {
            margin-top: 1.5rem !important;
        }
        
        .card {
            margin-bottom: 1rem;
        }
    }
    
    @media (max-width: 576px) {
        .hero-container {
            height: 250px;
        }
        
        .hero-overlay {
            margin-top: -250px;
        }
        
        .hero-title {
            font-size: 1.5rem;
        }
        
        .hero-text {
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .hero-btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .lead {
            font-size: 1rem;
        }
        
        h2 {
            font-size: 1.8rem;
        }
    }

    /* Add a subtle button animation */
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Make the cards uniform height within their rows */
    .row.g-4 {
        display: flex;
        flex-wrap: wrap;
    }
    
    .row.g-4 > [class*="col-"] {
        display: flex;
        flex-direction: column;
    }
    
    .row.g-4 .card {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .row.g-4 .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .card-text {
        flex-grow: 1;
    }
    
    /* Add scroll animation for sections */
    .section-fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    
    .section-fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Modern scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 5px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }
</style>

<!-- JavaScript for Funding Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Create funding chart
        var ctx = document.getElementById('fundingChart').getContext('2d');
        var fundingChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Philippine Government (Phase 1)', 'DICT (Phase 2)', 'WFP (Phase 2)', 'USAID & WFP (Additional)'],
                datasets: [{
                    data: [4, 3.2, 1, 0.8],
                    backgroundColor: [
                        '#003566',
                        '#0466c8',
                        '#002855',
                        '#001845'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': $' + context.raw + 'M USD';
                            }
                        }
                    }
                }
            }
        });
        
        // Simple scroll animation
        const sections = document.querySelectorAll('section');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });
        
        sections.forEach(section => {
            section.classList.add('section-fade-in');
            observer.observe(section);
        });
        
        // Make gallery items clickable for a lightbox effect
        const galleryItems = document.querySelectorAll('.gallery-item');
        galleryItems.forEach(item => {
            item.addEventListener('click', function() {
                const imgSrc = this.querySelector('img').src;
                const imgAlt = this.querySelector('img').alt;
                // You could implement a lightbox here
                console.log('Clicked on image:', imgSrc, imgAlt);
            });
        });
    });
</script>
@endsection