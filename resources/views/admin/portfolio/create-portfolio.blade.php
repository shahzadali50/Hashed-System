@extends('layouts.admin')
@push('css')
<style>

</style>

@endpush

@section('content')
<div class="row">

   <div class="col-lg-8">
    <div class="card">
        <div class="card-header border-bottom d-flex flex-wrap justify-content-between align-items-center">
            <h6 class="mb-0">Add Portfolio</h6>
            <div class="d-flex">

                <div class="alert alert-secondary" role="alert">
                    {{ $category->slug }}
                  </div>
                  <div>
                    <a class="btn btn-info mx-2" href="{{ route( 'admin.portfolio-list',$category->id) }}">List</a>

                  </div>
            </div>

        </div>
        <div class="card-body mt-5">

            <form action="{{ route('admin.store-portfolio') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <input type="text" name="category_id" value="{{ $category->id }}" hidden>
                   <!-- Facebook Link -->
                   <div class="form-group row mb-2">
                    <div class="col-md-3">
                        <label class="col-form-label">Portfolio Image</label>
                        <div>
                            <img class="img-thumbnail" id="profile_image_preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="file" id="profile_image"  name="image" placeholder="Category Name" class="form-control @error('image') is-invalid @enderror">
                        @error('image') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                </div>
                   <div class="form-group row mb-2">
                    <div class="col-md-3">
                        <label class="col-form-label">Portfolio title <span class="text-success">(Optional)</span></label>
                    </div>
                    <div class="col-md-8">
                        <input type="text"  name="title" placeholder="Portfolio Name" class="form-control @error('title') is-invalid @enderror">
                        @error('title') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                </div>
                   <div class="form-group row mb-2">
                    <div class="col-md-3">
                        <label class="col-form-label">Portfolio description <span class="text-success">(Optional)</span></label>
                    </div>
                    <div class="col-md-8">
                        <input type="text"  name="description" placeholder="Portfolio Name" class="form-control @error('description') is-invalid @enderror">
                        @error('description') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="col-12 text-end mt-4">
                    <a class="btn btn-info" href="{{ route(name: 'admin.portfolio.categories') }}">Back</a>
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
  validateImageInput('profile_image', 'profile_image_preview');
});
</script>

@endpush



