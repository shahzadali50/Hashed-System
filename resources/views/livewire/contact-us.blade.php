<form wire:submit.prevent="addContact" class="php-email-form">
    <div class="row gy-4">
        <!-- Name Field -->
        <div class="col-md-6">
            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Email Field -->
        <div class="col-md-6">
            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Subject Field -->
        <div class="col-md-12">
            <input type="text" wire:model="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject">
            @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Message Field -->
        <div class="col-md-12">
            <textarea wire:model="message" class="form-control @error('message') is-invalid @enderror" rows="8" placeholder="Message"></textarea>
            @error('message') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Success Message and Submit Button -->
        <div class="col-md-12 text-center">

            @if (session()->has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <img style="width: 30px" src="{{ url('assets/img/alert_message/success.svg') }}" alt="">
                {{ session('success_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

            <button type="submit" class="btn btn-primary">
                <span wire:loading.remove wire:target="addContact">Send Message</span>
                <span wire:loading wire:target="addContact">
                    Please wait
                    <div class="spinner-border spinner-border-sm text-light ms-2" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </span>
            </button>

        </div>
    </div>
</form>
