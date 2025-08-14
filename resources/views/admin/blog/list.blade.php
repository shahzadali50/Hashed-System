@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header bg-dark h4 d-flex justify-content-between "  style="margin-bottom: 49px;">
                <h3 class="m-0 text-white">Blog List( <span style="font-size: 18px;">{{ $category->slug }}</span> )</h3>
                <div>
                    <a class="btn btn-primary" href="{{ route('admin.blogs.categories') }}">Back</a>
                    <a class="btn btn-info" href="{{ route('admin.blog.create',$category->id) }}">Add Blog</a>
                </div>

            </div>
            <div class="card-datatable text-nowrap px-3">
                <table class="table table-striped  dataTable">
                    <thead>
                        <tr class="bg-primary">
                            <th scope="col">ID</th>
                            <th scope="col">Blog Thumbnail</th>
                            <th scope="col">Blog title</th>
                            <th scope="col">Blog Content</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Blogs as $Blog)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>

                            <td>
                                @if ($Blog->thumbnail)
                                <img class="img-fluid object-fit-cover border rounded" src="{{ asset('storage/' . $Blog->thumbnail) }}" alt="Thumbnail" style="width: 60px; height: 60px;">
                                @else
                                No Thumbnail
                                @endif
                            </td>

                            <td>{{ Str::limit($Blog->title, 20, '...') }}</td>
                            <td>{{ Str::limit($Blog->sub_title, 20, '...') }}</td>
                            <td>{{ $Blog->created_at->format('d M Y h:i A') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-label-secondary  waves-effect" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                    <ul class="dropdown-menu" style="">
                                      <li><a class="dropdown-item waves-effect" href="{{ route('admin.blog.view',$Blog->id) }}"><i class="fa fa-eye pe-2" aria-hidden="true"></i>View</a></li>
                                      <li><a class="dropdown-item waves-effect" href="{{ route('admin.blog.edit',$Blog->id) }}"><i class="fa fa-pencil-square-o pe-2" aria-hidden="true"></i>Edit</a></li>


                                      <li><form action="{{ route('admin.blog.delete', $Blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-75">
                                            <i class="fa fa-trash-o pe-2" aria-hidden="true"></i> Delete
                                        </button>
                                    </form></li>
                                    </ul>
                                  </div>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
@endsection
