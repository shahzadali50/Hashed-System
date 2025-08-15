@extends('layouts.admin')
@section('title', 'Leads List')

@section('content')

<div class="row">
    <div class="col-12">
        @livewire('lead.lead-list')

    </div>

</div>
@endsection
