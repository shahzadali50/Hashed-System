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
				<h6 class="mb-0">Website Logo</h6>
			</div>
            <div class="card-body mt-5">

                <form action="{{ route('admin.updateBussineesSetting') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                       <!-- Facebook Link -->
                       <div class="form-group row mb-2">
                        <div class="col-md-3">
                            <label class="col-form-label">Website name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{{ old('website_name', business_setting('website_name')) }}" name="website_name" placeholder="Video | Editor" class="form-control @error('website_name') is-invalid @enderror">
                            @error('website_name') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label class="col-form-label">Header Logo</label>
                            <br>
                            @php
                            $headerLogo = business_setting('header_logo');

                        @endphp
                            @if ($headerLogo) <!-- Check if the logo path exists -->
                            <img style="max-width: 150px;" class="img-thumbnail" src="{{ asset('storage/' . $headerLogo) }}" alt="Header Logo Preview"/>
                        @else
                        <span class="badge bg-label-secondary rounded-pill mb-1"> No logo uploaded yet</span>
                        @endif
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input id="header_logo" name="header_logo" type="file" class="form-control @error('header_logo') is-invalid @enderror " accept="image/png, image/jpeg, image/jpg">
                                @error('header_logo')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Allowed formats: jpg, png, jpeg. Max size: 3MB.</small>
                            </div>
                            <div>
                                <img class="img-thumbnail" id="header_logo_preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;" />
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
                                    @if ($site_icon) <!-- Check if the logo path exists -->
                                    <img style="max-width: 150px;" class="img-thumbnail" src="{{ asset('storage/' . $site_icon) }}" alt="Header Logo Preview"/>
                                @else
                                <span class="badge bg-label-secondary rounded-pill mb-1">No image uploaded yet.</span>
                                @endif
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input id="site_icon" name="site_icon" type="file" class="form-control @error('site_icon') is-invalid @enderror " accept="image/png, image/jpeg, image/jpg">
                                    @error('site_icon')
                                    <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">Allowed formats: jpg, png, jpeg. Max size: 3MB.</small>
                                </div>
                                <div>
                                    <img class="img-thumbnail" id="site_icon_preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;" />
                                </div>
                            </div>

                        </div>
                    <div class="col-12 text-end mt-4">
                        <button onclick="this.form.submit(); this.disabled=true; this.innerHTML='<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span> Please wait...';" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-10 col-12 mx-auto mt-3">

        <div class="card">
            <div class="card-header border-bottom">
				<h6 class="mb-0">Social Links</h6>
			</div>
            <div class="card-body mt-5">

                <form action="{{ route('admin.updateBussineesSetting') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Facebook Link -->
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label class="col-form-label">Facebook</label>
                        </div>
                        <div class="col-md-8">
                            <input type="url" value="{{ old('facebook_link', business_setting('facebook_link')) }}" name="facebook_link" placeholder="https://www.facebook.com/" class="form-control @error('facebook_link') is-invalid @enderror">
                            @error('facebook_link') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- YouTube Link -->
                    <div class="form-group row mt-3">
                        <div class="col-md-3">
                            <label class="col-form-label">YouTube</label>
                        </div>
                        <div class="col-md-8">
                            <input type="url" value="{{ old('youtube_link', business_setting('youtube_link')) }}" name="youtube_link" placeholder="https://www.youtube.com/" class="form-control @error('youtube_link') is-invalid @enderror">
                            @error('youtube_link') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Twitter Link -->
                    <div class="form-group row mt-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Twitter</label>
                        </div>
                        <div class="col-md-8">
                            <input type="url" value="{{ old('twitter_link', business_setting('twitter_link')) }}" name="twitter_link" placeholder="https://www.twitter.com/" class="form-control @error('twitter_link') is-invalid @enderror">
                            @error('twitter_link') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Instagram Link -->
                    <div class="form-group row mt-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Instagram</label>
                        </div>
                        <div class="col-md-8">
                            <input type="url" value="{{ old('instagram_link', business_setting('instagram_link')) }}" name="instagram_link" placeholder="https://www.instagram.com/" class="form-control @error('instagram_link') is-invalid @enderror">
                            @error('instagram_link') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <!-- Instagram Link -->
                    <div class="form-group row mt-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Linkedin</label>
                        </div>
                        <div class="col-md-8">
                            <input type="url" value="{{ old('Linkedin_link', business_setting('Linkedin_link')) }}" name="Linkedin_link" placeholder="https://www.LinkedIn.com/" class="form-control @error('Linkedin_link') is-invalid @enderror">
                            @error('Linkedin_link') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group row mt-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Email</label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" value="{{ old('email', business_setting('email')) }}" name="email" placeholder="example@domain.com" class="form-control @error('email') is-invalid @enderror">
                            @error('email') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group row mt-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Phone Number</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{{ old('phone_number', business_setting('phone_number')) }}" name="phone_number" placeholder="123-456-7890" class="form-control @error('phone_number') is-invalid @enderror">
                            @error('phone_number') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="form-group row mt-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Address</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter your business address">{{ old('address', business_setting('address')) }}</textarea>
                            @error('address') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button onclick="this.form.submit(); this.disabled=true; this.innerHTML='<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span> Please wait...';" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script>

    // image handle javascript 👇
    document.addEventListener('DOMContentLoaded', function() {
  function validateImageInput(fileInputId, previewImageId) {
      const fileInput = document.getElementById(fileInputId);
      const previewImage = document.getElementById(previewImageId);
      const maxSize = 3 * 1024 * 1024; // 3MB in bytes
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
                  alert(`The file "${file.name}" exceeds the 3MB size limit.`);
                  event.target.value = ''; // Clear the input
                  valid = false; // Set validity to false
                  break;
              }

              // Check for allowed file types
              if (!allowedTypes.includes(file.type)) {
                  alert(`The file "${file.name}" is not a valid image. Only JPG, PNG, and JPEG are allowed.`);
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
});
</script>

@endpush
