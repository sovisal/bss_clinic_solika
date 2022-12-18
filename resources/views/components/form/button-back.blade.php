@props([
    'href' => '#',
])
@php($url = (request()->back?: $href))
<x-form.button 
    color="danger"
    icon="bx bx-left-arrow-alt"
    :href="$url"
    label="Back"
/>