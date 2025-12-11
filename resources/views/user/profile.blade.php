@extends('layout.master')
@section('title', 'User Profile')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style-profile.css') }}">
<style>
    .tool-card-wrapper {
        position: relative;
    }
    .delete-tool-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 24px;
        height: 24px;
        background: #e74c3c;
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .delete-tool-btn:hover {
        background: #c0392b;
        transform: scale(1.1);
    }
    .most-liked-section {
        margin-top: 50px;
    }
    .bookmarked-section {
        margin-top: 50px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    .stat-card {
        background-color: #1C1C1C;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .stat-card-title {
        font-size: 24px;
        background: linear-gradient(180deg, #716C66, #DBA890, #FFE4C7);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 15px;
    }
    .stat-card-item {
        padding: 12px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        margin-bottom: 10px;
        border-left: 3px solid #CA6E0A;
    }
    .stat-card-item:last-child {
        margin-bottom: 0;
    }
    .tool-name-stat {
        font-weight: 600;
        color: #FFE4C7;
    }
    .likes-count {
        font-size: 14px;
        color: #CA6E0A;
        margin-top: 5px;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        align-items: center;
        justify-content: center;
    }
    .modal.show {
        display: flex;
    }
    .modal-content {
        background: linear-gradient(171deg, #402100 20%, #AA661C);
        border-radius: 12px;
        padding: 30px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }
    .modal-header {
        font-size: 28px;
        color: #fff;
        margin-bottom: 20px;
        font-weight: 600;
    }
    .modal-close {
        float: right;
        font-size: 24px;
        cursor: pointer;
        color: #fff;
        background: none;
        border: none;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        color: #FFE4C7;
        font-size: 16px;
        margin-bottom: 8px;
        font-weight: 500;
    }
    .form-group input[type="text"],
    .form-group input[type="file"] {
        width: 100%;
        padding: 12px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 6px;
        background: rgba(0, 0, 0, 0.3);
        color: #fff;
        font-size: 14px;
    }
    .form-group input[type="text"]::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    .form-group input[type="file"]::file-selector-button {
        background: #CA6E0A;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
    }
    .form-group input[type="file"]::file-selector-button:hover {
        background: #B85C08;
    }
    .preview-image {
        max-width: 100%;
        max-height: 200px;
        margin-top: 10px;
        border-radius: 6px;
    }
    .modal-buttons {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }
    .btn-save {
        background: #CA6E0A;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(202, 110, 10, 0.4);
    }
    .btn-cancel {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>
@endpush

@section('content')

<div class="profile-page">
    <main>
        <section class="hero-section">
            <div class="container">
                <h1 class="hero-title">Profile</h1>
                <p class="hero-sub">Manage your account and published tools.</p>

                <div class="profile-container">
                    <div class="profile-wrapper">
                        <div class="profile-card-container">
                            <div class="profile-card">
                                <div class="profile-pic-container">
                                    @if($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}?t={{ time() }}" alt="Profile Picture" class="profile-pic" onerror="this.style.display='none'">
                                    @endif
                                </div>
                                <div class="profile-name">{{ $user->name }}</div>
                

                                <div class="divider-line"></div>

                                <button class="update-profile-btn" onclick="openEditModal()">Update Profile</button>
                            </div>
                        </div>

                        <div class="profile-content">
                            <div>
                                {{-- <h2 class="section-title">Profile</h2> --}}
                                <div class="info-card">
                                    <div class="info-field">
                                        <div class="field-label">Email Address</div>
                                        <div class="field-value" id="email-field">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="tools-section">
                                <h2 class="section-title">My Tools</h2>

                                <div class="tools-container">
                                    <div class="tools-row">
                                        @forelse($publishedTools as $tool)
                                            <div class="tool-card-wrapper">
                                                <button class="delete-tool-btn" onclick="confirmDeleteTool({{ $tool->id }})">×</button>
                                                <div class="tool-card">
                                                    <div class="tool-icon">
                                                        @if($tool->picture)
                                                            <img src="{{ asset('storage/' . $tool->picture) }}" alt="{{ $tool->name }}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                                                        @else
                                                            <i class="fas fa-box"></i>
                                                        @endif
                                                    </div>
                                                    <div class="tool-name">{{ $tool->name }}</div>
                                                    <div class="tool-category">{{ $tool->category->name ?? 'Uncategorized' }}</div>
                                                    <div class="tool-status">Status: {{ ucfirst($tool->status) }}</div>
                                                    <a href="{{ route('showdetail', [$tool->category_id, $tool->id]) }}" class="see-all-link" style="margin-top:10px; display:block; text-align:center;">View</a>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted">No published tools.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            @if($publishedTools->count() > 0)
                                <div class="most-liked-section">
                                    <h2 class="section-title">Most Liked Tools</h2>
                                    <div class="stats-grid">
                                        @php
                                            $sortedByLikes = $publishedTools->sortByDesc(function($tool) {
                                                return $tool->likes()->count();
                                            })->take(3);
                                        @endphp
                                        @forelse($sortedByLikes as $tool)
                                            <div class="stat-card">
                                                <div class="stat-card-title">{{ $tool->name }}</div>
                                                <div class="stat-card-item">
                                                    <span class="tool-name-stat">{{ $tool->name }}</span>
                                                    <div class="likes-count">❤️ {{ $tool->likes()->count() }} Likes</div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted">No likes yet.</p>
                                        @endforelse
                                    </div>
                                </div>
                            @endif

                            @if($bookmarkedTools->count() > 0)
                                <div class="bookmarked-section">
                                    <h2 class="section-title">Bookmarked Tools</h2>
                                    <div class="tools-container">
                                        <div class="tools-row">
                                            @foreach($bookmarkedTools as $tool)
                                                <div class="tool-card">
                                                    <div class="tool-icon">
                                                        @if($tool->picture)
                                                            <img src="{{ asset('storage/' . $tool->picture) }}" alt="{{ $tool->name }}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                                                        @else
                                                            <i class="fas fa-bookmark"></i>
                                                        @endif
                                                    </div>
                                                    <div class="tool-name">{{ $tool->name }}</div>
                                                    <div class="tool-category">{{ $tool->category->name ?? 'Uncategorized' }}</div>
                                                    <a href="{{ route('showdetail', [$tool->category_id, $tool->id]) }}" class="see-all-link" style="margin-top:10px; display:block; text-align:center;">View</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
</div>

<!-- Edit Profile Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeEditModal()">×</button>
        <div class="modal-header">Edit Profile</div>
        
        <form id="editProfileForm" action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" value="{{ $user->name ?? '' }}">
            </div>

            <div class="form-group">
                <label for="photo">Profile Picture</label>
                <input type="file" id="photo" name="photo" accept="image/*">
                @if($user->photo)
                    <div style="margin-top: 10px;">
                        <small style="color: #FFE4C7;">Current photo:</small>
                        <img src="{{ asset('storage/' . $user->photo) }}?t={{ time() }}" alt="Current" class="preview-image" onerror="this.style.display='none'">
                    </div>
                @endif
                <img id="photoPreview" class="preview-image" style="display: none;">
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal() {
        document.getElementById('editModal').classList.add('show');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('show');
        document.getElementById('photoPreview').style.display = 'none';
    }

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Preview image before upload
        const photoInput = document.getElementById('photo');
        if (photoInput) {
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const preview = document.getElementById('photoPreview');
                        preview.src = event.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Handle form submission - just close modal on submit
        const editForm = document.getElementById('editProfileForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                // Allow normal form submission
                closeEditModal();
            });
        }
    });

    function confirmDeleteTool(toolId) {
        if (confirm('Are you sure you want to delete this tool?')) {
            deleteTool(toolId);
        }
    }

    async function deleteTool(toolId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        if (!csrfToken) {
            alert('CSRF token not found. Please reload the page.');
            return;
        }
        
        try {
            const response = await fetch(`/tool/${toolId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            });
            
            if (!response.ok) {
                const errorData = await response.json();
                alert('Error: ' + (errorData.error || 'Failed to delete tool'));
                return;
            }
            
            const data = await response.json();
            
            if (data.success) {
                alert('Tool deleted successfully!');
                location.reload();
            } else {
                alert('Error: ' + (data.error || 'Failed to delete tool'));
            }
        } catch (error) {
            console.error('Delete error:', error);
            alert('Network error: ' + error.message);
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target === modal) {
            closeEditModal();
        }
    }
</script>

@endsection

