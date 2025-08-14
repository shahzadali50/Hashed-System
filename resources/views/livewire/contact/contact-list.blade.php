<div>

    <div class="card">
        <div class="card-header bg-dark h4" style="margin-bottom: 49px;">
            <h3 class="m-0 text-white">Contact List</h3>
        </div>
        <div class="card-datatable text-nowrap px-3">
            <table class="table table-striped ">
                <thead>
                    <tr class="bg-primary">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($contact->message, 20) }}</td>
                            <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td> <!-- Formatting the created_at -->
                            <td>

                            <button  wire:click="contactView({{ $contact->id }})" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                View
                            </button>


                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
           <div class="mt-4">
            {{  $contacts->links() }}
           </div>

        </div>
    </div>

      <!-- Modal -->
<div  wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Contact View</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <form >
                <div class="row gy-4">
                    <!-- Name Field -->
                    <div class="col-md-6">
                        <input type="text" wire:model="name" class="form-control " placeholder="Your Name">

                    </div>

                    <!-- Email Field -->
                    <div class="col-md-6">
                        <input type="email" wire:model="email" class="form-control" placeholder="Your Email">

                    </div>

                    <!-- Subject Field -->
                    <div class="col-md-12">
                        <input type="text" wire:model="subject" class="form-control " placeholder="Subject">

                    </div>

                    <!-- Message Field -->
                    <div class="col-md-12">
                        <textarea wire:model="message" class="form-control " rows="8" placeholder="Message"></textarea>

                    </div>


                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

