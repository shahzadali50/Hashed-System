@extends('layouts.admin')
@push('css')
<style>
     input[type="color"] {
        height: 40px !important;
    }

</style>


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
				<h6 class="mb-0">Website Theme</h6>
			</div>
            <div class="card-body mt-5">

                <form action="{{ route('admin.updateBussineesSetting') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Primary Color -->
                    <div class="form-group row mt-3">
                        <label class="col-md-3 col-form-label">Primary Color</label>
                        <div class="col-md-8">
                            <input
                                type="color"
                                name="primary_color"
                                id="primary_color"
                                value="{{ old('primary_color', business_setting('primary_color')) }}"
                                class="form-control"
                                onchange="updatePreview()">
                            <small>Choose the primary color for your theme.</small>
                        </div>
                    </div>

                    <!-- Secondary Color -->
                    <div class="form-group row mt-3">
                        <label class="col-md-3 col-form-label">Secondary Color</label>
                        <div class="col-md-8">
                            <input
                                type="color"
                                name="secondary_color"
                                id="secondary_color"
                                value="{{ old('secondary_color', business_setting('secondary_color')) }}"
                                class="form-control"
                                onchange="updatePreview()">
                            <small>Choose the secondary color for your theme.</small>
                        </div>
                    </div>

                    <!-- Font Selection -->
                    <div class="form-group row mt-3">
                        <label class="col-md-3 col-form-label">Font Family</label>
                        <div class="col-md-8">
                            <select
                            class="form-control"
                            name="font_family"
                            id="font_family"
                            onchange="updatePreview()">
                            <option value="Arial" {{ old('font_family', business_setting('font_family')) == 'Arial' ? 'selected' : '' }}>Arial</option>
                            <option value="Verdana" {{ old('font_family', business_setting('font_family')) == 'Verdana' ? 'selected' : '' }}>Verdana</option>
                            <option value="Tahoma" {{ old('font_family', business_setting('font_family')) == 'Tahoma' ? 'selected' : '' }}>Tahoma</option>
                            <option value="Roboto" {{ old('font_family', business_setting('font_family')) == 'Roboto' ? 'selected' : '' }}>Roboto</option>
                            <option value="Open Sans" {{ old('font_family', business_setting('font_family')) == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                            <option value="Lato" {{ old('font_family', business_setting('font_family')) == 'Lato' ? 'selected' : '' }}>Lato</option>
                            <option value="Montserrat" {{ old('font_family', business_setting('font_family')) == 'Montserrat' ? 'selected' : '' }}>Montserrat</option>
                            <option value="Poppins" {{ old('font_family', business_setting('font_family')) == 'Poppins' ? 'selected' : '' }}>Poppins</option>
                        </select>
                            <small>Choose a font family for your site.</small>
                        </div>
                    </div>

                    <!-- Layout Selection -->
                    <div class="form-group row mt-3">
                        <label class="col-md-3 col-form-label">Layout</label>
                        <div class="col-md-8">
                            <select
                                class="form-control"
                                name="layout"
                                id="layout"
                                onchange="updatePreview()">
                                <option value="boxed" >Boxed</option>
                                <option value="wide" >Wide</option>
                            </select>
                            <small>Choose a layout style for your site.</small>
                        </div>
                    </div>

                    <!-- Preview Section -->
                    <div class="form-group row mt-3">
                        <label class="col-md-3 col-form-label">Preview</label>
                        <div class="col-md-8">
                            <div id="theme_preview" style="border: 1px solid #ccc; padding: 20px;">
                                <h2 style="margin: 0;">Live Preview</h2>
                                <p>This is how your site will look with the selected settings.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-end mt-4">
                        <button
                            onclick="this.form.submit(); this.disabled=true; this.innerHTML='<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span> Please wait...';"
                            type="submit"
                            class="btn btn-primary">
                            Save Settings
                        </button>
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
    function updatePreview() {
    const primaryColor = document.getElementById('primary_color').value;
    const secondaryColor = document.getElementById('secondary_color').value;
    const fontFamily = document.getElementById('font_family').value;
    const layout = document.getElementById('layout').value;

    const preview = document.getElementById('theme_preview');

    // Update styles dynamically
    preview.style.color = primaryColor;
    preview.style.backgroundColor = secondaryColor;
    preview.style.fontFamily = fontFamily;
    preview.style.maxWidth = layout === 'boxed' ? '800px' : '100%';
    preview.style.margin = layout === 'boxed' ? '0 auto' : '0';
}

</script>

@endpush
