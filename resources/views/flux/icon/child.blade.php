{{-- Credit: Heroicons (https://heroicons.com) --}}

@props([
    'variant' => 'outline',
])

@php
    $classes = Flux::classes('shrink-0')->add(
        match ($variant) {
            'outline' => '[:where(&)]:size-6',
            'solid' => '[:where(&)]:size-6',
            'mini' => '[:where(&)]:size-5',
            'micro' => '[:where(&)]:size-4',
        },
    );
@endphp

<?php switch ($variant): case ('outline'): ?>
<svg {{ $attributes->class($classes) }} data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 550 550" fill="currentColor" aria-hidden="true" data-slot="icon"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 128C256 92.7 284.7 64 320 64C355.3 64 384 92.7 384 128C384 163.3 355.3 192 320 192C284.7 192 256 163.3 256 128zM304 448L304 544C304 561.7 289.7 576 272 576C254.3 576 240 561.7 240 544L240 351.8L219.1 385C209.7 400 189.9 404.4 175 395C160.1 385.6 155.5 365.9 164.9 351L204.8 287.7C229.7 248 273.2 224 320 224C366.8 224 410.3 248 435.2 287.6L475.1 351C484.5 366 480 385.7 465.1 395.1C450.2 404.5 430.4 400 421 385.1L400 351.8L400 544C400 561.7 385.7 576 368 576C350.3 576 336 561.7 336 544L336 448L304 448z"/></svg>

<?php break; ?>

<?php case ('solid'): ?>
<svg {{ $attributes->class($classes) }} data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 128C256 92.7 284.7 64 320 64C355.3 64 384 92.7 384 128C384 163.3 355.3 192 320 192C284.7 192 256 163.3 256 128zM304 448L304 544C304 561.7 289.7 576 272 576C254.3 576 240 561.7 240 544L240 351.8L219.1 385C209.7 400 189.9 404.4 175 395C160.1 385.6 155.5 365.9 164.9 351L204.8 287.7C229.7 248 273.2 224 320 224C366.8 224 410.3 248 435.2 287.6L475.1 351C484.5 366 480 385.7 465.1 395.1C450.2 404.5 430.4 400 421 385.1L400 351.8L400 544C400 561.7 385.7 576 368 576C350.3 576 336 561.7 336 544L336 448L304 448z"/></svg>

<?php break; ?>

<?php case ('mini'): ?>
<svg {{ $attributes->class($classes) }} data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 128C256 92.7 284.7 64 320 64C355.3 64 384 92.7 384 128C384 163.3 355.3 192 320 192C284.7 192 256 163.3 256 128zM304 448L304 544C304 561.7 289.7 576 272 576C254.3 576 240 561.7 240 544L240 351.8L219.1 385C209.7 400 189.9 404.4 175 395C160.1 385.6 155.5 365.9 164.9 351L204.8 287.7C229.7 248 273.2 224 320 224C366.8 224 410.3 248 435.2 287.6L475.1 351C484.5 366 480 385.7 465.1 395.1C450.2 404.5 430.4 400 421 385.1L400 351.8L400 544C400 561.7 385.7 576 368 576C350.3 576 336 561.7 336 544L336 448L304 448z"/></svg>

<?php break; ?>

<?php case ('micro'): ?>
<svg {{ $attributes->class($classes) }} data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
    fill="currentColor" aria-hidden="true" data-slot="icon">
    <path fill-rule="evenodd"
        d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z"
        clip-rule="evenodd" />
</svg>

<?php break; ?>

<?php endswitch; ?>
