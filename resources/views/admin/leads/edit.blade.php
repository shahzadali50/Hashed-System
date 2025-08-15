@extends('layouts.admin')
@section('title', 'Leads Edit')

@section('content')

<div class="row">
    <div class="col-12">
        @livewire('lead.edit', ['id' => $lead->id])
    </div>
</div>
@endsection
