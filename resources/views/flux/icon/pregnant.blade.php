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
<svg {{ $attributes->class($classes) }} data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 550 550" fill="currentColor" aria-hidden="true" data-slot="icon"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M320 144C350.9 144 376 118.9 376 88C376 57.1 350.9 32 320 32C289.1 32 264 57.1 264 88C264 118.9 289.1 144 320 144zM400 465.2C408.6 460.7 416.8 455.2 424.3 448.7L428.3 445.3C450.9 425.9 464 397.6 464 367.7C464 331.8 445.2 298.6 414.4 280.1L384 261.9L384 260.1C384 213.6 346.3 176 299.9 176C271.8 176 245.5 190.1 229.9 213.5L149.4 334.2C139.6 348.9 143.6 368.8 158.3 378.6C173 388.4 192.9 384.4 202.7 369.7L231.7 326.2L201.2 439.7C198.6 449.3 200.6 459.6 206.7 467.5C212.8 475.4 222 480 232 480L240 480L240 576C240 593.7 254.3 608 272 608C289.7 608 304 593.7 304 576L304 480L336 480L336 576C336 593.7 350.3 608 368 608C385.7 608 400 593.7 400 576L400 465.2z"/></svg>

<?php break; ?>

<?php case ('solid'): ?>
<svg {{ $attributes->class($classes) }} data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M320 144C350.9 144 376 118.9 376 88C376 57.1 350.9 32 320 32C289.1 32 264 57.1 264 88C264 118.9 289.1 144 320 144zM400 465.2C408.6 460.7 416.8 455.2 424.3 448.7L428.3 445.3C450.9 425.9 464 397.6 464 367.7C464 331.8 445.2 298.6 414.4 280.1L384 261.9L384 260.1C384 213.6 346.3 176 299.9 176C271.8 176 245.5 190.1 229.9 213.5L149.4 334.2C139.6 348.9 143.6 368.8 158.3 378.6C173 388.4 192.9 384.4 202.7 369.7L231.7 326.2L201.2 439.7C198.6 449.3 200.6 459.6 206.7 467.5C212.8 475.4 222 480 232 480L240 480L240 576C240 593.7 254.3 608 272 608C289.7 608 304 593.7 304 576L304 480L336 480L336 576C336 593.7 350.3 608 368 608C385.7 608 400 593.7 400 576L400 465.2z"/></svg>

<?php break; ?>

<?php case ('mini'): ?>
<svg {{ $attributes->class($classes) }} data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M320 144C350.9 144 376 118.9 376 88C376 57.1 350.9 32 320 32C289.1 32 264 57.1 264 88C264 118.9 289.1 144 320 144zM400 465.2C408.6 460.7 416.8 455.2 424.3 448.7L428.3 445.3C450.9 425.9 464 397.6 464 367.7C464 331.8 445.2 298.6 414.4 280.1L384 261.9L384 260.1C384 213.6 346.3 176 299.9 176C271.8 176 245.5 190.1 229.9 213.5L149.4 334.2C139.6 348.9 143.6 368.8 158.3 378.6C173 388.4 192.9 384.4 202.7 369.7L231.7 326.2L201.2 439.7C198.6 449.3 200.6 459.6 206.7 467.5C212.8 475.4 222 480 232 480L240 480L240 576C240 593.7 254.3 608 272 608C289.7 608 304 593.7 304 576L304 480L336 480L336 576C336 593.7 350.3 608 368 608C385.7 608 400 593.7 400 576L400 465.2z"/></svg>

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
