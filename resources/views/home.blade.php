{{-- @extends('layout.master')
@section('title', 'register account')

@section('content')

  <div class="col-md-6 offset-md-3 mt-5">
    <h1>Home</h1>

       <ul>
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('showCategory', $category->id) }}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection



 --}}



@extends('layout.master')
@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style-home.css') }}">
@endpush

@section('content')

    <div class="hero-section">
        <img src="{{ asset('assets/images/cahaya-diatas-eclipse.png') }}" class="hero-light-top" alt="Top Light">
        <div class="hero-text">
            <h1>The Tools Shelf<br>For Future Hackers</h1>
            <p>Learn | Share | Exploit</p>
        </div>
        <img src="{{ asset('assets/images/eclipse-light.png') }}" class="hero-glow" alt="Glow">
        <img src="{{ asset('assets/images/eclipse-ball.png') }}" class="hero-ball" alt="Ball">
    </div>


    <section class="categories">
        <h2 class="section-title">Find Your Category</h2>
        <p class="section-subtitle">Search Whatever You Want</p>

        <div class="category-cards" id="categoryCarousel">
            @forelse($categories as $category)
                <div class="category-card {{ $loop->first ? 'active' : '' }}" data-category-id="{{ $category->id }}">
                    <h3>{{ $category->name }}</h3>
                </div>
            @empty
                <p class="text-muted">No categories available</p>
            @endforelse
        </div>

        <div class="category-actions">
            <button class="btn-nav" id="prevBtn" aria-label="Previous category">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="btn-find-tools" id="findToolsBtn">Find Tools</button>
            <button class="btn-nav" id="nextBtn" aria-label="Next category">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </section>


    <div class="cards-section">
        <div class="card-row row-1">
            <img src="{{ asset('assets/images/lock-card.png') }}" class="card-img lock-card" alt="Lock Card">
            <img src="{{ asset('assets/images/feedback-card.png') }}" class="card-img feedback-card" alt="Feedback Card">
        </div>

        <div class="card-row row-2">
            <img src="{{ asset('assets/images/1-card.png') }}" class="card-img one-card" alt="One Card">
            <img src="{{ asset('assets/images/kaachow.png') }}" class="card-img kaachow-card" alt="Kaachow Card">
        </div>
    </div>



    <div class="faq-section">
        <h2>FAQ</h2>

        <div class="faq-item">
            <div class="faq-question">
                <span>01 How do I publish a tool?</span>
                <span class="faq-icon">&gt;</span>
            </div>
            <div class="faq-answer">Go to "Add Tool" in the navbar and fill in the details about your tool. Our admin team will review and publish it.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>02 How can I report a bug?</span>
                <span class="faq-icon">&gt;</span>
            </div>
            <div class="faq-answer">Found an issue? Contact us through the About page or email our support team directly with details about the bug.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>03 Am I using "real" hacking tools?</span>
                <span class="faq-icon">&gt;</span>
            </div>
            <div class="faq-answer">Yes, all tools on HackerShelf are legitimate security and penetration testing tools used by professionals and ethical hackers.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>04 How do I request for a tool?</span>
                <span class="faq-icon">&gt;</span>
            </div>
            <div class="faq-answer">Contact us with your tool request through the About page. We'll review it and add it if it matches our criteria.</div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('categoryCarousel');
    const cards = Array.from(document.querySelectorAll('.category-card'));
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const findToolsBtn = document.getElementById('findToolsBtn');
    
    let currentIndex = 0;
    const cardsPerView = 4;
    
    function updateCarousel() {
        // Remove active class from all cards
        cards.forEach(card => card.classList.remove('active'));
        
        // Add active class to first visible card
        if (cards[currentIndex]) {
            cards[currentIndex].classList.add('active');
        }
        
        // Scroll carousel to show current position
        const cardWidth = cards[0].offsetWidth + 20; // width + gap
        carousel.scrollLeft = currentIndex * cardWidth;
        
        // Update button states
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= cards.length - cardsPerView;
    }
    
    prevBtn.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    });
    
    nextBtn.addEventListener('click', function() {
        if (currentIndex < cards.length - cardsPerView) {
            currentIndex++;
            updateCarousel();
        }
    });
    
    // Click on card to select it
    cards.forEach((card, index) => {
        card.addEventListener('click', function() {
            currentIndex = index;
            updateCarousel();
        });
    });
    
    // Find Tools button - navigate to selected category
    findToolsBtn.addEventListener('click', function() {
        const activeCard = document.querySelector('.category-card.active');
        if (activeCard) {
            const categoryId = activeCard.getAttribute('data-category-id');
            window.location.href = `/list/${categoryId}`;
        }
    });
    
    // FAQ dropdown functionality
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', function() {
            item.classList.toggle('active');
        });
    });
    
    // Initialize
    updateCarousel();
});
</script>
@endpush