{{-- @extends('layout.master')
@section('title', 'Product Detail')

@section('content')

<div class="container mt-5">

    <h2>{{ $product->name }} (v{{ $product->version }})</h2>

    <div class="card mt-3">
        <div class="card-body">

            <p><strong>Category:</strong> {{ $product->category->name }}</p>

            @if(isset($product->description))
                <p><strong>Description:</strong> {{ $product->description }}</p>
            @endif

            <p><strong>Installation Steps:</strong></p>
            <pre>{{ $product->installation_steps }}</pre>

            <hr>

            <p><strong>Document:</strong></p>
            @if($product->tool_document)
                <a href="{{ asset('storage/' . $product->tool_document) }}" class="btn btn-primary" target="_blank">
                    Open Document
                </a>
            @else
                <span>No document uploaded.</span>
            @endif

            <hr>

            <p><strong>Banner / Picture:</strong></p>
            @if($product->picture)
                <img src="{{ asset('storage/' . $product->picture) }}" width="300" class="img-fluid rounded">
            @else
                <span>No picture uploaded.</span>
            @endif

        </div>
    </div>

</div>

@endsection --}}


@extends('layout.master')
@section('title', 'Tool Details')

@push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/style-tooldetails.css') }}">
@endpush

@section('content')
<div class="tooldetails-page">
    <div class="tool-details-wrapper">
        <div class="tool-details-container">
            <div class="tool-details-card">
                <div class="tool-header">
                    <div>
                        <h1 class="tool-name">{{ $product->name }} (v{{ $product->version }})</h1>
                    </div>

                    <div class="tool-actions">
                        <button type="button" class="action-btn" id="bookmarkBtn" data-product-id="{{ $product->id }}" title="Bookmark">
                            <svg class="icon-bookmark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span id="bookmarkCount">{{ $product->bookmarks()->count() }}</span>
                        </button>
                        <button type="button" class="action-btn" id="likeBtn" data-product-id="{{ $product->id }}" title="Like">
                            <svg class="icon-like" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                            <span id="likeCount">{{ $product->likes()->count() }}</span>
                        </button>
                    </div>
                </div>

                <div class="uploader-section">
                    <div class="uploader-pic">
                        @php
                            $uploaderPhoto = optional($product->user)->photo ?? null;
                        @endphp
                        @if($uploaderPhoto)
                            <img src="{{ asset('storage/' . $uploaderPhoto) }}" alt="Uploader" class="uploader-img">
                        @else
                            <img src="{{ asset('assets/images/Profile Picture.png') }}" alt="Uploader" class="uploader-img">
                        @endif
                    </div>
                    <div class="uploader-info">
                        <div class="uploader-name">{{ optional($product->user)->name ?? 'Unknown' }}</div>
                    </div>
                </div>

                <div class="tool-description">
                    {!! nl2br(e($product->description)) !!}
                </div>

                <div class="tool-extras">
                    <details class="install-details">
                        <summary><i class="fas fa-download"></i> Installation Steps</summary>
                        @php
                            $steps = $product->installation_steps ? preg_split('/\r\n|\r|\n/', $product->installation_steps) : [];
                        @endphp
                        @if(!empty($steps))
                            <ol class="install-list">
                                @foreach($steps as $step)
                                    <li>{{ $step }}</li>
                                @endforeach
                            </ol>
                        @else
                            <p class="muted">No installation steps provided.</p>
                        @endif
                    </details>

                    <details class="download-details">
                        <summary><i class="fas fa-code-branch"></i> Download Versions</summary>
                        <ul class="download-list">
                            @if($product->tool_document)
                                <li>
                                    <a href="{{ asset('storage/' . $product->tool_document) }}" target="_blank" download>
                                        v{{ $product->version ?? '1.0' }} - Download
                                    </a>
                                </li>
                            @else
                                <li>No downloadable files available.</li>
                            @endif
                        </ul>
                    </details>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
@auth
const likeBtn = document.getElementById('likeBtn');
const bookmarkBtn = document.getElementById('bookmarkBtn');
const productId = likeBtn ? likeBtn.dataset.productId : null;
const csrfMeta = document.querySelector('meta[name="csrf-token"]');
const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : null;

console.log('Product ID:', productId, 'CSRF:', !!csrfToken);

if (likeBtn && productId && csrfToken) {
    likeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const url = `/product/${productId}/toggle-like`;
        console.log('Sending POST to:', url);
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(r => {
            console.log('Response status:', r.status);
            return r.json();
        })
        .then(data => {
            console.log('Response data:', data);
            document.getElementById('likeCount').textContent = data.likeCount;
            likeBtn.classList.toggle('liked');
        })
        .catch(e => {
            console.error('Error:', e);
            alert('Error: ' + e.message);
        });
    });
}

if (bookmarkBtn && productId && csrfToken) {
    bookmarkBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const url = `/product/${productId}/toggle-bookmark`;
        console.log('Sending POST to:', url);
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(r => {
            console.log('Response status:', r.status);
            return r.json();
        })
        .then(data => {
            console.log('Response data:', data);
            document.getElementById('bookmarkCount').textContent = data.bookmarkCount;
            bookmarkBtn.classList.toggle('bookmarked');
        })
        .catch(e => {
            console.error('Error:', e);
            alert('Error: ' + e.message);
        });
    });
}
@else
const likeBtn = document.getElementById('likeBtn');
const bookmarkBtn = document.getElementById('bookmarkBtn');

if (likeBtn) {
    likeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = '/login';
    });
}

if (bookmarkBtn) {
    bookmarkBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = '/login';
    });
}
@endauth
</script>
@endsection