@extends('layouts.app')

@section('contents')
<div class="nbp-container">
    <!-- Hero Section with Animation -->
    <div class="hero-container position-relative overflow-hidden">
        <div class="hero-overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 text-center">
                        <div class="hero-content">
                            <h1 class="hero-title fade-in">National Broadband Plan</h1>
                            <p class="hero-text fade-in-delay">Connecting the Philippines through enhanced digital infrastructure</p>
                            <a href="#overview" class="btn btn-light btn-lg hero-btn">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Introduction Section -->
    <section id="overview" class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4" style="color: #003566; border-bottom: 3px solid #003566; padding-bottom: 10px;">Overview</h2>
                    <p class="lead">The National Broadband Plan (NBP) provides the blueprint for a comprehensive broadband infrastructure in the Philippines. It aims to deploy fiber optic cables and wireless technologies nationwide, significantly improving internet speed and affordability for all Filipino citizens.</p>
                    <p>Through strategic government investment and policy reform, the NBP ensures universal access to high-quality broadband connectivity, bridging the digital divide and enabling citizens to participate fully in the digital economy.</p>
                    <div class="mt-4">
                        <a href="#strategies" class="btn btn-primary" style="background-color: #003566; border-color: #003566;">Key Strategies</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 rounded shadow">
                        <div class="connection-animation-container">
                            <div class="node n1"></div>
                            <div class="node n2"></div>
                            <div class="node n3"></div>
                            <div class="connection c1"></div>
                            <div class="connection c2"></div>
                        </div>
                        <div class="bg-white p-3 mt-3 rounded shadow-sm">
                            <div class="d-flex align-items-center">
                                <p class="mb-0 text-muted fst-italic">National broadband infrastructure connecting the islands of Luzon, Visayas, and Mindanao</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Strategies Section -->
    <section id="strategies" class="py-5" style="background-color: #003566;">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Key Strategies</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow hover-card">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-balance-scale text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="text-primary">Policy & Regulatory Reforms</h4>
                            <p class="text-dark">Development of key issuances to support policy and regulatory amendments in telecommunications and ICT, focusing on Administrative Reforms and Competition and Market Entry.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow hover-card">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-broadcast-pin text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="text-primary">Government Investment</h4>
                            <p class="text-dark">Implementation of national broadband infrastructure that complements existing telecom networks to ensure universal access. This strategic investment creates the backbone for nationwide connectivity.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow hover-card">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-graph-up-arrow text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="text-primary">Stimulation of Demand</h4>
                            <p class="text-dark">Establishing "pull" measures to stimulate demand and increase broadband adoption through local content development, capacity building programs, information outreach, and incentives for broadband users.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Infrastructure Components Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5" style="color: #003566;">Infrastructure Components</h2>
            
            <div class="component-timeline">
                <div class="component-item fade-in-scroll">
                    <div class="component-number">1</div>
                    <div class="component-content">
                        <h3 class="card-title mb-3" style="color: #003566;">National Fiber Backbone</h3>
                        <p class="card-text mb-4">A high-capacity fiber optic network connecting the islands of Luzon, Visayas, and Mindanao, forming the core of the country's digital infrastructure and enabling high-speed data transmission across the archipelago.</p>
                    </div>
                </div>
                
                <div class="component-item fade-in-scroll">
                    <div class="component-number">2</div>
                    <div class="component-content">
                        <h3 class="card-title mb-3" style="color: #003566;">Cable Landing Stations</h3>
                        <p class="card-text mb-4">System of cable landing stations connected via the Luzon Bypass Infrastructure, serving as the NBP's gateway to international connectivity and providing capacity for future expansion of the network.</p>
                    </div>
                </div>
                
                <div class="component-item fade-in-scroll">
                    <div class="component-number">3</div>
                    <div class="component-content">
                        <h3 class="card-title mb-3" style="color: #003566;">Tower Infrastructure</h3>
                        <p class="card-text mb-4">Strategic tower deployment catering to geographically isolated areas and identified missionary sites, covering the middle mile and last mile segments of the network to ensure connectivity reaches remote communities.</p>
                    </div>
                </div>
                
                <div class="component-item fade-in-scroll">
                    <div class="component-number">4</div>
                    <div class="component-content">
                        <h3 class="card-title mb-3" style="color: #003566;">Government Agency Interconnection</h3>
                        <p class="card-text mb-4">Expansion of DICT's fiber optic network to interconnect government agencies, providing fast, secure, and efficient connectivity that improves the delivery of public services to citizens.</p>
                    </div>
                </div>
                
                <div class="component-item fade-in-scroll">
                    <div class="component-number">5</div>
                    <div class="component-content">
                        <h3 class="card-title mb-3" style="color: #003566;">Satellite Overlay</h3>
                        <p class="card-text mb-4">Implementation of satellite technology to enable immediate broadband service to isolated locations where deployment of fiber network facilities presents significant challenges, ensuring no area is left behind.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="py-5 vision-section">
        <div class="container">
            <div class="vision-content text-center">
                <h2>Our Vision</h2>
                <p>A digitally empowered Philippines where every citizen has access to high-quality, affordable broadband connectivity, enabling participation in the digital economy and improving quality of life through enhanced access to education, healthcare, government services, and economic opportunities.</p>
                <a href="#" class="btn btn-light btn-lg hero-btn">Learn More</a>
            </div>
        </div>
    </section>
</div>

<!-- CSS for the page - INTERNAL STYLING -->
<style>
    /* Primary color variations */
    :root {
        --primary-color: #003566;
        --primary-light: #0353a4;
        --primary-dark: #001d3d;
        --accent-color: #ffd60a;
        --text-light: #ffffff;
        --text-dark: #333333;
        --bg-light: #f8f9fa;
        --bg-dark: #e9ecef;
        --card-bg: #ffffff;
        --transition-speed: 0.3s;
    }
    
    .nbp-container {
        font-family: 'Poppins', sans-serif;
        color: var(--text-dark);
    }
    
    /* Hero Section Styles */
    .hero-container {
        height: 400px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--text-light);
        overflow: hidden;
    }
    
    .hero-overlay {
        width: 100%;
        height: 100%;
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
    
    /* Connection Animation */
    .connection-animation-container {
        position: relative;
        width: 100%;
        height: 300px;
        background-color: rgba(0, 53, 102, 0.1);
        border-radius: 10px;
    }
    
    .node {
        position: absolute;
        width: 30px;
        height: 30px;
        background-color: var(--accent-color);
        border-radius: 50%;
        box-shadow: 0 0 15px rgba(255, 214, 10, 0.8);
    }
    
    .n1 {
        top: 50%;
        left: 20%;
        animation: pulse 2s infinite;
    }
    
    .n2 {
        top: 30%;
        left: 50%;
        animation: pulse 2s infinite 0.7s;
    }
    
    .n3 {
        top: 70%;
        left: 70%;
        animation: pulse 2s infinite 1.4s;
    }
    
    .connection {
        position: absolute;
        height: 2px;
        background: var(--accent-color);
        transform-origin: left;
    }
    
    .c1 {
        top: 50%;
        left: 20%;
        width: 30%;
        animation: grow 2s infinite;
    }
    
    .c2 {
        top: 30%;
        left: 50%;
        width: 20%;
        animation: grow 2s infinite 0.7s;
    }
    
    /* Component Timeline Styles */
    .component-timeline {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
    }
    
    .component-timeline:before {
        content: '';
        position: absolute;
        top: 0;
        left: 39px;
        height: 100%;
        width: 4px;
        background-color: var(--primary-light);
    }
    
    .component-item {
        display: flex;
        margin-bottom: 40px;
        position: relative;
    }
    
    .component-number {
        width: 80px;
        height: 80px;
        background-color: var(--primary-color);
        color: var(--text-light);
        font-size: 2rem;
        font-weight: 700;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        position: relative;
        z-index: 1;
        box-shadow: 0 0 0 5px rgba(0, 53, 102, 0.1);
    }
    
    .component-content {
        flex: 1;
        background-color: var(--card-bg);
        border-radius: 10px;
        padding: 30px;
        margin-left: 30px;
        box-shadow: 0 5px 20px rgba(0, 53, 102, 0.1);
    }
    
    /* Vision Section Styles */
    .vision-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--text-light);
    }
    
    .vision-content {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .vision-content h2 {
        color: var(--text-light);
        margin-bottom: 30px;
        font-weight: 600;
    }
    
    .vision-content p {
        font-size: 1.3rem;
        margin-bottom: 40px;
        line-height: 1.8;
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
    
    /* Fix the text in Strategies section */
    .text-primary {
        color: #003566 !important;
    }
    
    .text-dark {
        color: #212529 !important;
    }
    
    /* Animations */
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.2); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    @keyframes grow {
        0% { transform-origin: left; transform: scaleX(0); opacity: 0; }
        100% { transform-origin: left; transform: scaleX(1); opacity: 1; }
    }
    
    .fade-in {
        opacity: 0;
        animation: fadeIn 1s forwards;
    }
    
    .fade-in-delay {
        opacity: 0;
        animation: fadeIn 1s 0.5s forwards;
    }
    
    .fade-in-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s, transform 0.8s;
    }
    
    .fade-in-scroll.active {
        opacity: 1;
        transform: translateY(0);
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    /* Responsive Styles */
    @media (max-width: 992px) {
        .hero-title {
            font-size: 2.2rem;
        }
        
        .component-timeline:before {
            left: 24px;
        }
        
        .component-number {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }
        
        .component-content {
            margin-left: 20px;
            padding: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 1.8rem;
        }
        
        .hero-text {
            font-size: 1.1rem;
        }
        
        .vision-content p {
            font-size: 1.1rem;
        }
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

<!-- JavaScript for animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll animation for components
    const fadeElements = document.querySelectorAll('.fade-in-scroll');
    
    function checkScroll() {
        fadeElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementTop < windowHeight * 0.8) {
                element.classList.add('active');
            }
        });
    }
    
    // Check initial positions
    checkScroll();
    
    // Add scroll event listener
    window.addEventListener('scroll', checkScroll);
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 70,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>
@endsection