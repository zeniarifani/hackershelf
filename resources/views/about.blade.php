@extends('layout.master')
@section('title', 'About Us')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style-aboutus.css') }}">
@endpush

@section('content')

<div class="aboutus-page">
    <main>
        <section class="hero-section">
            <div class="container">
                <h1>Redefining Ethical Exploration</h1>
                <p>A curated security tools and resources for ethical learning, research, and authorized testing.</p>

                <div class="big-logo">
                    <img src="{{ asset('assets/images/logo-apk-hci.png') }}" class="logo-img">
                    <div class="big-logo-text">HACKERSHELF</div>
                </div>

                <div class="divider"></div>

                <div class="stats-section">
                    <div class="stat-item">
                        <div class="stat-number">10k+</div>
                        <div class="stat-label">Platform Users</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5k+</div>
                        <div class="stat-label">Active Downloads</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">200+</div>
                        <div class="stat-label">Learning Resources</div>
                    </div>
                </div>

                <div class="features-section">
                    <div class="feature-card">
                        <h3>For Education</h3>
                        <p>Supporting universities, cyber clubs, and training academies with structured, safe cyber security resources.</p>
                    </div>

                    <div class="feature-card">
                        <h3>For Businesses</h3>
                        <p>Helping teams strengthen security capabilities through trusted tools, research workflows, and ethical testing resources.</p>
                    </div>

                    <div class="feature-card">
                        <h3>For Enthusiasts</h3>
                        <p>Curated tools and guided learning paths to develop ethical hacking skills and build your cybersecurity career from anywhere.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

@endsection