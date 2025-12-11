{{-- @extends('layout.master')
@section('title', $category->name)

@section('content')
<div class="container mt-5">

    <h2 class="mb-4">Category: {{ $category->name }}</h2>

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100" style="width: 18rem;">
                @if ($product->picture)
                    <img src="{{ asset('storage/' . $product->picture) }}"
                         class="card-img-top"
                         alt="{{ $product->name }}"
                         style="height: 210px; object-fit: cover">
                @else
                    <img src="https://via.placeholder.com/300x210?text=No+Image"
                         class="card-img-top"
                         alt="No image">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Category: {{ $product->category->name }}
                    </li>
                    <li class="list-group-item">
                        Description: {{ $product->description }}
                    </li>
                </ul>

                <div class="card-body d-flex justify-content-between">
                    <a href="{{ route('showdetail',[  'category_id' => $product->category_id,
                         'product_id' => $product->id]) }}"
                       class="btn btn-primary">See More</a>
                </div>
            </div>
        </div>
        @endforeach

        @if ($products->isEmpty())
            <p class="text-muted px-3">No products found in this category.</p>
        @endif
    </div>
</div>
@endsection --}}


@section('title', $category->name ?? 'Tools')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style-tools.css') }}">
@endpush
@extends('layout.master')

@section('content')
<div class="tools-page">
  <main>
    <section class="hero-section">
      <div class="container">
        <h1 class="section-title">{{ $category->name ?? 'Tools' }}</h1>
        <p class="hero-sub">Browse curated tools in this category.</p>

        <div class="search-container">
          <i class="fas fa-search search-icon"></i>
          <input type="text" class="search-bar" id="toolSearch" placeholder="Search tools" />
          <div class="sort-dropdown">
            <button type="button" class="sort-dropdown-btn" id="sortDropdownBtn">
              <i class="fas fa-sort"></i> Sort By
            </button>
            <div class="sort-dropdown-menu" id="sortDropdownMenu">
              <a href="#" class="sort-option" id="sortLiked" data-sort="liked">
                <i class="fas fa-heart"></i> Most Liked
              </a>
              <a href="#" class="sort-option" id="sortBookmarked" data-sort="bookmarked">
                <i class="fas fa-bookmark"></i> Most Bookmarked
              </a>
              <a href="#" class="sort-option active" id="sortDefault" data-sort="default">
                <i class="fas fa-redo"></i> Default
              </a>
            </div>
          </div>
        </div>

        <div class="tools-grid-container">
          <div class="tools-grid" id="toolsGrid">
            @forelse ($products as $product)
              <a href="{{ route('showdetail', ['category_id' => $product->category_id, 'product_id' => $product->id]) }}" class="tool-card-link" data-tool-name="{{ strtolower($product->name) }}" data-likes="{{ $product->likes()->count() }}" data-bookmarks="{{ $product->bookmarks()->count() }}">
                <div class="tool-card">
                  <div class="tool-logo-container">
                    @if ($product->picture)
                      <img src="{{ asset('storage/' . $product->picture) }}" class="tool-logo" alt="{{ $product->name }}">
                    @else
                      <img src="https://via.placeholder.com/200x200?text=No+Image" class="tool-logo" alt="No image">
                    @endif
                  </div>
                  <h3 class="tool-name">{{ $product->name }}</h3>
                  <div class="tool-description">{{ Str::limit($product->description, 20, '...') }}</div>
                </div>
              </a>
            @empty
              <p class="text-muted">No products found in this category.</p>
            @endforelse
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('toolSearch');
            const toolsGrid = document.getElementById('toolsGrid');
            const toolCards = Array.from(toolsGrid.querySelectorAll('.tool-card-link'));
            const emptyMessage = toolsGrid.querySelector('.text-muted');
            const sortDropdownBtn = document.getElementById('sortDropdownBtn');
            const sortDropdownMenu = document.getElementById('sortDropdownMenu');
            const sortOptions = document.querySelectorAll('.sort-option');
            let currentSort = 'default';

            // Toggle dropdown menu
            sortDropdownBtn.addEventListener('click', function(e) {
              e.preventDefault();
              sortDropdownMenu.classList.toggle('open');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
              if (!e.target.closest('.sort-dropdown')) {
                sortDropdownMenu.classList.remove('open');
              }
            });

            function updateDisplay() {
              const searchTerm = searchInput.value.toLowerCase().trim();
              let filtered = toolCards.filter(card => {
                const toolName = card.getAttribute('data-tool-name');
                return toolName.includes(searchTerm);
              });

              // Sort based on current sort option
              if (currentSort === 'liked') {
                filtered.sort((a, b) => parseInt(b.getAttribute('data-likes')) - parseInt(a.getAttribute('data-likes')));
              } else if (currentSort === 'bookmarked') {
                filtered.sort((a, b) => parseInt(b.getAttribute('data-bookmarks')) - parseInt(a.getAttribute('data-bookmarks')));
              }

              // Reorder DOM elements based on filtered/sorted array
              filtered.forEach(card => {
                toolsGrid.appendChild(card);
              });

              // Hide cards not in filtered array
              toolCards.forEach(card => {
                if (!filtered.includes(card)) {
                  card.style.display = 'none';
                } else {
                  card.style.display = '';
                }
              });

              // Show/hide empty message
              if (searchTerm && filtered.length === 0 && emptyMessage) {
                emptyMessage.style.display = 'block';
              } else if (emptyMessage) {
                emptyMessage.style.display = 'none';
              }
            }

            searchInput.addEventListener('input', updateDisplay);

            sortOptions.forEach(option => {
              option.addEventListener('click', function(e) {
                e.preventDefault();
                const sortValue = this.getAttribute('data-sort');
                currentSort = sortValue;

                // Update active state
                sortOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');

                // Update button text by finding and replacing only the text node
                const text = this.textContent.trim();
                let textNodeFound = false;
                for (let i = 0; i < sortDropdownBtn.childNodes.length; i++) {
                  const node = sortDropdownBtn.childNodes[i];
                  if (node.nodeType === 3 && node.textContent.trim() !== '') {
                    node.textContent = ' ' + text;
                    textNodeFound = true;
                    break;
                  }
                }
                if (!textNodeFound) {
                  sortDropdownBtn.appendChild(document.createTextNode(' ' + text));
                }

                // Close dropdown and update display
                sortDropdownMenu.classList.remove('open');
                updateDisplay();
              });
            });
          });
        </script>

      </div>
    </section>
  </main>
</div>
@endsection