@extends('layouts.admin')
@push('css')
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-lg-10 col-12 mx-auto">

            <div class="card">
                <div class="card-header border-bottom">
                    <h6 class="mb-0">Website Banner setting</h6>
                </div>
                <div class="card-body mt-5">

                    <form action="{{ route('admin.updateBussineesSetting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label">Header Logo</label>
                                <br>
                                @php
                                    $headerLogo = business_setting('header_logo');

                                @endphp
                                @if ($headerLogo)
                                    <!-- Check if the logo path exists -->
                                    <img style="max-width: 150px;" class="img-thumbnail"
                                        src="{{ asset('storage/' . $headerLogo) }}" alt="Header Logo Preview" />
                                @else
                                    <span class="badge bg-label-secondary rounded-pill mb-1"> No logo uploaded yet</span>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input id="header_logo" name="header_logo" type="file"
                                        class="form-control @error('header_logo') is-invalid @enderror "
                                        accept="image/png, image/jpeg, image/jpg">
                                    @error('header_logo')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">Allowed formats: jpg, png, jpeg. Max size:
                                        2MB.</small>
                                </div>
                                <div>
                                    <img class="img-thumbnail" id="header_logo_preview" src="#" alt="Image Preview"
                                        style="max-width: 150px; display: none;" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-3">
                                <label class="col-form-label">Site Icon</label>
                                <div>
                                    @php
                                        $site_icon = business_setting('site_icon');
                                    @endphp
                                    @if ($site_icon)
                                        <!-- Check if the logo path exists -->
                                        <img style="max-width: 150px;" class="img-thumbnail"
                                            src="{{ asset('storage/' . $site_icon) }}" alt="Header Logo Preview" />
                                    @else
                                        <span class="badge bg-label-secondary rounded-pill mb-1">No image uploaded
                                            yet.</span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input id="site_icon" name="site_icon" type="file"
                                        class="form-control @error('site_icon') is-invalid @enderror "
                                        accept="image/png, image/jpeg, image/jpg">
                                    @error('site_icon')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">Allowed formats: jpg, png, jpeg. Max size:
                                        2MB.</small>
                                </div>
                                <div>
                                    <img class="img-thumbnail" id="site_icon_preview" src="#" alt="Image Preview"
                                        style="max-width: 150px; display: none;" />
                                </div>
                            </div>

                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-3">
                                <label class="col-form-label">Banner Image</label>
                                <div>
                                    @php
                                        $banner_image = business_setting('banner_image');
                                    @endphp
                                    @if ($banner_image)
                                        <!-- Check if the logo path exists -->
                                        <img style="max-width: 150px;" class="img-thumbnail"
                                            src="{{ asset('storage/' . $banner_image) }}" alt="Header Logo Preview" />
                                    @else
                                        <span class="badge bg-label-secondary rounded-pill mb-1">No image uploaded
                                            yet.</span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input id="banner_image" name="banner_image" type="file"
                                        class="form-control @error('banner_image') is-invalid @enderror "
                                        accept="image/png, image/jpeg, image/jpg">
                                    @error('banner_image')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">Allowed formats: jpg, png, jpeg. Max size:
                                        2MB.</small>
                                </div>
                                <div>
                                    <img class="img-thumbnail" id="banner_image_preview" src="#" alt="Image Preview"
                                        style="max-width: 150px; display: none;" />
                                </div>
                            </div>

                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-3">
                                <label class="col-form-label">Banner Youtube Link</label>
                            </div>
                            <div class="col-md-8">
                                <input type="url" value="{{ old('banner_youtube_link', business_setting('banner_youtube_link')) }}" name="banner_youtube_link" placeholder="https://www.youtube.com/watch?v=Y7f98aduV" class="form-control @error('banner_youtube_link') is-invalid @enderror">
                                @error('banner_youtube_link') <span style="color: red;">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-3">
                                <label class="col-form-label">Banner Title</label>
                            </div>
                            <div class="col-md-8">
                                <textarea name="banner_title" class="form-control @error('banner_title') is-invalid @enderror" placeholder="Enter your business address">{{ old('banner_title', business_setting('banner_title')) }}</textarea>
                                <small class="form-text text-muted">Max 50 chars allowed. Keep it short and clear.</small>
                                <br>

                                @error('banner_title') <span style="color: red;">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-3">
                                <label class="col-form-label">Banner Description</label>
                            </div>
                            <div class="col-md-8">
                                <textarea name="banner_description" class="form-control @error('banner_description') is-invalid @enderror" placeholder="Enter your business address">{{ old('banner_description', business_setting('banner_description')) }}</textarea>
                                <small class="form-text text-muted">Max 1000 chars allowed. Keep it short and clear.</small>
                                <br>

                                @error('banner_description') <span style="color: red;">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-12 text-end mt-4">
                            <button
                                onclick="this.form.submit(); this.disabled=true; this.innerHTML='<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span> Please wait...';"
                                type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('js')
    <script>
        // image handle javascript 👇
        document.addEventListener('DOMContentLoaded', function() {
            function validateImageInput(fileInputId, previewImageId) {
                const fileInput = document.getElementById(fileInputId);
                const previewImage = document.getElementById(previewImageId);
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                fileInput.addEventListener('change', function(event) {
                    const files = event.target.files;

                    // Clear any previous preview image
                    previewImage.style.display = 'none';
                    previewImage.src = '';

                    let valid = true;

                    // Loop through the selected files
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];

                        // Check for file size
                        if (file.size > maxSize) {
                            alert(`The file "${file.name}" exceeds the 2MB size limit.`);
                            event.target.value = ''; // Clear the input
                            valid = false; // Set validity to false
                            break;
                        }

                        // Check for allowed file types
                        if (!allowedTypes.includes(file.type)) {
                            alert(
                                `The file "${file.name}" is not a valid image. Only JPG, PNG, and JPEG are allowed.`);
                            event.target.value = ''; // Clear the input
                            valid = false; // Set validity to false
                            break;
                        }
                    }

                    // If the file is valid, show the preview
                    if (valid && files.length > 0) {
                        const file = files[0]; // Take the first file if multiple are selected
                        previewImage.src = URL.createObjectURL(file);
                        previewImage.style.display = 'block';
                    }
                });
            }

            // Apply the validation to both inputs
            validateImageInput('header_logo', 'header_logo_preview');
            validateImageInput('site_icon', 'site_icon_preview');
            validateImageInput('banner_image', 'banner_image_preview');
        });
    </script>
@endpush
