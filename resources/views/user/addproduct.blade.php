    {{-- @extends('layout.master')
    @section('title', 'add product')

    @section('content')

    <div class="col-md-6 offset-md-3 mt-5">
        <h1>Add New Product</h1>

        <form action="{{ route('create-product') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="InputName">Tool Name</label>
                <input type="text" name="name" class="form-control" id="InputName" placeholder="Enter product name" required>
            </div>

            <div class="form-group mb-3">
                <label for="InputVersion">Version</label>
                <input type="text" name="version" class="form-control" id="InputVersion" placeholder="Enter Version" required>
            </div>

            <div class="form-group mb-3">
                <label for="inputToolCategory">Tool Category</label>
                <select class="form-control" id="inputToolCategory" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="InputDescription">Description</label>
                <input type="text" name="description" class="form-control" id="InputDescription" placeholder="Enter product description" required>
            </div>

            <div class="form-group mb-3">
                <label for="InputInstallationSteps">Installation Steps</label>
                <input type="text" name="installation_steps" class="form-control" id="InputInstallationSteps" placeholder="Enter installation steps" required>
            </div>

            <div class="form-group mb-3">
                <label for="InputDocument">Documents / File</label>
                <input type="file" name="tool_document" class="form-control" id="InputDocument" required>
            </div>

            <div class="form-group mb-3">
                <label class="mr-2">Banner Design</label>
                <input type="file" name="picture" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>

    @endsection --}}


@extends('layout.master')
@section('title', 'Upload Your Tool')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style-uploadtool.css') }}">
@endpush

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "{{ route('profile') }}";
        }, 2000);
    </script>
@endif

<div class="uploadtool-page">
    <div class="page-header">
        <h1 class="page-title">Upload Your Tool</h1>
        <p class="page-subtitle">Share your security tools with the community.</p>
    </div>

    <div class="upload-container">
        <div class="upload-card">
            <form action="{{ route('create-product') }}" method="POST" enctype="multipart/form-data" class="upload-form" id="uploadForm">
                @csrf

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-toolbox"></i>
                        Tool Name
                    </label>
                    <input type="text" name="name" class="form-input" placeholder="e.g., Autopsy Digital Forensics" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-code-branch"></i>
                            Version
                        </label>
                        <input type="text" name="version" class="form-input" placeholder="e.g., 1.0.0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tags"></i>
                            Category
                        </label>
                        <select class="form-input" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-align-left"></i>
                        Description
                    </label>
                    <textarea name="description" id="InputDescription" class="form-input" placeholder="Describe your tool in detail..." required></textarea>
                </div>

               <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-download"></i>
                        Installation Steps
                    </label>
                    <textarea name="installation_steps" class="form-input" placeholder="1. Download the tool...
                2. Install dependencies...
                3. Run setup...
                4. Configure settings..." required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-file-alt"></i>
                        Documentation/File
                    </label>
                    <div class="file-upload-container">
                        <input type="text" class="form-input file-input" placeholder="No file selected" readonly id="docFileName">
                        <button type="button" class="file-upload-btn" id="uploadDocBtn">
                            <i class="fas fa-upload"></i>
                            Upload File
                        </button>
                        <input name="tool_document" type="file" id="docFileInput" style="display: none;" accept=".pdf,.doc,.docx,.zip,.rar,.tar,.gz">
                    </div>
                    <div class="file-preview" id="docFilePreview" style="display: none;">
                        No file selected
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-image"></i>
                        Banner Design
                    </label>
                    <div class="file-upload-container">
                        <input type="text" class="form-input file-input" placeholder="No image selected" readonly id="bannerFileName">
                        <button type="button" class="file-upload-btn" id="uploadBannerBtn">
                            <i class="fas fa-upload"></i>
                            Upload Image
                        </button>
                        <input name="picture" type="file" id="bannerFileInput" style="display: none;" accept=".jpg,.jpeg,.png,.svg,.gif">
                    </div>
                    <div class="file-preview" id="bannerFilePreview" style="display: none;">
                        No image selected
                    </div>
                </div>

                <div class="submit-btn-container">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-cloud-upload-alt"></i>
                        Upload Tool
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Documentation/file upload
            var uploadDocBtn = document.getElementById('uploadDocBtn');
            var docFileInput = document.getElementById('docFileInput');
            var docFileName = document.getElementById('docFileName');
            var docFilePreview = document.getElementById('docFilePreview');

            if (uploadDocBtn && docFileInput) {
                uploadDocBtn.addEventListener('click', function () {
                    docFileInput.click();
                });

                docFileInput.addEventListener('change', function () {
                    if (docFileInput.files && docFileInput.files.length > 0) {
                        var f = docFileInput.files[0];
                        if (docFileName) docFileName.value = f.name;
                        if (docFilePreview) {
                            docFilePreview.style.display = 'block';
                            docFilePreview.textContent = f.name;
                        }
                    } else {
                        if (docFileName) docFileName.value = '';
                        if (docFilePreview) {
                            docFilePreview.style.display = 'none';
                            docFilePreview.textContent = 'No file selected';
                        }
                    }
                });
            }

            // Banner/image upload
            var uploadBannerBtn = document.getElementById('uploadBannerBtn');
            var bannerFileInput = document.getElementById('bannerFileInput');
            var bannerFileName = document.getElementById('bannerFileName');
            var bannerFilePreview = document.getElementById('bannerFilePreview');

            if (uploadBannerBtn && bannerFileInput) {
                uploadBannerBtn.addEventListener('click', function () {
                    bannerFileInput.click();
                });

                bannerFileInput.addEventListener('change', function () {
                    if (bannerFileInput.files && bannerFileInput.files.length > 0) {
                        var f = bannerFileInput.files[0];
                        if (bannerFileName) bannerFileName.value = f.name;
                        if (bannerFilePreview) {
                            bannerFilePreview.style.display = 'block';
                            // If image, show thumbnail; otherwise show filename
                            if (f.type && f.type.startsWith('image/')) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    bannerFilePreview.innerHTML = '<img src="' + e.target.result + '" alt="banner preview" style="max-width:100%;height:auto;border-radius:6px">';
                                };
                                reader.readAsDataURL(f);
                            } else {
                                bannerFilePreview.textContent = f.name;
                            }
                        }
                    } else {
                        if (bannerFileName) bannerFileName.value = '';
                        if (bannerFilePreview) {
                            bannerFilePreview.style.display = 'none';
                            bannerFilePreview.textContent = 'No image selected';
                        }
                    }
                });
            }
        });
    </script>
@endsection