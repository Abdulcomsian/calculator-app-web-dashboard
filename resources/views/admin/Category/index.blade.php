@extends('layouts.master', ['page_title' => 'Dashboard'])
@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/css/adminpage_css.css') }}">
@endpush
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex justify-content-end flex-stack">
                <a href="#" class="btn btn-primary hover-elevate-up" data-bs-toggle="modal"
                    data-bs-target="#addNewServiceModal">Add Category</a>
            </div>
        </div>
        <section class="card">
            <table class="table table-admin-services">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="{{ $category->id }}"
                                    data-title="{{ $category->title }}" data-description="{{ $category->description }}">
                                    Edit
                                </button>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No categories available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <div class="modal fade" id="addNewServiceModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('category.save') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="exampleFormControlInput1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Description</label>
                                <textarea class="form-control" name="description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editForm" action="{{ route('category.update', 0) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editTitle" class="form-label">Title</label>
                                <input type="text" name="title" id="editTitle" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="editDescription" class="form-label">Description</label>
                                <textarea name="description" id="editDescription" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var title = button.getAttribute('data-title');
            var description = button.getAttribute('data-description');

            var form = document.getElementById('editForm');
            form.action = form.action.replace('/0', '/' + id);

            var modalTitleInput = form.querySelector('#editTitle');
            var modalDescriptionTextarea = form.querySelector('#editDescription');

            modalTitleInput.value = title;
            modalDescriptionTextarea.value = description;
        });

        editModal.addEventListener('hidden.bs.modal', function(event) {
            var form = document.getElementById('editForm');
            form.action = form.action.replace(/\/\d+$/, '/0');
        });
    });
</script>
