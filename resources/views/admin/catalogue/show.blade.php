@extends('layout.master')
@section('title', 'Review Tool Request')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style-uploadtool.css') }}">
@endpush

@section('content')
<div class="uploadtool-page">
    <div class="page-header">
        <h1 class="page-title">Requested Tool</h1>
        <p class="page-subtitle">Review and approve or reject this tool submission.</p>
    </div>

    <div class="upload-container">
        <div class="upload-card">
            <div class="upload-form">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-toolbox"></i>
                        Tool Name
                    </label>
                    <div class="form-display">{{ $product->name }}</div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-code-branch"></i>
                            Version
                        </label>
                        <div class="form-display">{{ $product->version }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tags"></i>
                            Category
                        </label>
                        <div class="form-display">{{ $product->category->name }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-align-left"></i>
                        Description
                    </label>
                    <div class="form-display" style="white-space:pre-wrap;line-height:1.6">{{ $product->description }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-download"></i>
                        Installation Steps
                    </label>
                    <div class="form-display" style="white-space:pre-wrap;line-height:1.6">{{ $product->installation_steps }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-file-alt"></i>
                        {{ $product->tool_document ? 'Document Uploaded' : 'No Document Uploaded' }}
                    </label>
                    @if($product->tool_document)
                        <div class="form-display">
                            <a href="{{ asset('storage/' . $product->tool_document) }}" target="_blank" style="color:#FDC17F;text-decoration:none;font-weight:600">
                                <i class="fas fa-download"></i> Open Document
                            </a>
                        </div>
                    @else
                        <div class="form-display text-muted">No document uploaded.</div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-image"></i>
                        {{ $product->picture ? 'Banner Uploaded' : 'No Banner Uploaded' }}
                    </label>
                    @if($product->picture)
                        <div class="form-display">
                            <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}" style="max-width:100%;height:auto;border-radius:8px;max-height:280px;object-fit:cover;margin-top:10px">
                        </div>
                    @else
                        <div class="form-display text-muted">No picture uploaded.</div>
                    @endif
                </div>

                <div class="submit-btn-container">
                    <div style="display:flex;gap:15px;justify-content:center;flex-wrap:wrap;width:100%">
                        <form action="{{ route('admin.publish', $product->id) }}" method="POST" onsubmit="return confirm('Approve and publish this tool?');" style="margin:0">
                            @csrf
                            <button type="submit" class="submit-btn" style="background:linear-gradient(45deg,#4CAF50,#45a049);box-shadow:0 5px 25px rgba(76,175,80,0.3)">
                                <i class="fas fa-check"></i>
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('admin.reject', $product->id) }}" method="POST" onsubmit="return confirm('Reject this tool submission?');" style="margin:0">
                            @csrf
                            <button type="submit" class="submit-btn" style="background:linear-gradient(45deg,#f44336,#da190b);box-shadow:0 5px 25px rgba(244,67,54,0.3)">
                                <i class="fas fa-times"></i>
                                Reject
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-display {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    padding: 14px 18px;
    color: #FFFFFF;
    font-size: 15px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.text-muted {
    color: rgba(255, 255, 255, 0.5) !important;
}
</style>

@endsection

