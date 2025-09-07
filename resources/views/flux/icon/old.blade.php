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
<svg {{ $attributes->class($classes) }} data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 550 550"
    fill="currentColor" aria-hidden="true" data-slot="icon"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M328 32C358.9 32 384 57.1 384 88C384 118.9 358.9 144 328 144C297.1 144 272 118.9 272 88C272 57.1 297.1 32 328 32zM240 300.7L193.7 363.1C183.2 377.3 163.1 380.3 148.9 369.7C134.7 359.1 131.7 339.1 142.3 324.9L212.8 229.9C238 196 277.7 176 320 176C362.3 176 402 196 427.2 229.9L497.7 324.9C508.2 339.1 505.3 359.1 491.1 369.7C476.9 380.3 456.9 377.3 446.3 363.1L400 300.7L400 576C400 593.7 385.7 608 368 608C350.3 608 336 593.7 336 576L336 416C336 407.2 328.8 400 320 400C311.2 400 304 407.2 304 416L304 576C304 593.7 289.7 608 272 608C254.3 608 240 593.7 240 576L240 300.7zM488 448C483.6 448 480 451.6 480 456C480 469.3 469.3 480 456 480C442.7 480 432 469.3 432 456C432 425.1 457.1 400 488 400C518.9 400 544 425.1 544 456L544 584C544 597.3 533.3 608 520 608C506.7 608 496 597.3 496 584L496 456C496 451.6 492.4 448 488 448z"/></svg>

<?php break; ?>

<?php case ('solid'): ?>
<svg {{ $attributes->class($classes) }} data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M328 32C358.9 32 384 57.1 384 88C384 118.9 358.9 144 328 144C297.1 144 272 118.9 272 88C272 57.1 297.1 32 328 32zM240 300.7L193.7 363.1C183.2 377.3 163.1 380.3 148.9 369.7C134.7 359.1 131.7 339.1 142.3 324.9L212.8 229.9C238 196 277.7 176 320 176C362.3 176 402 196 427.2 229.9L497.7 324.9C508.2 339.1 505.3 359.1 491.1 369.7C476.9 380.3 456.9 377.3 446.3 363.1L400 300.7L400 576C400 593.7 385.7 608 368 608C350.3 608 336 593.7 336 576L336 416C336 407.2 328.8 400 320 400C311.2 400 304 407.2 304 416L304 576C304 593.7 289.7 608 272 608C254.3 608 240 593.7 240 576L240 300.7zM488 448C483.6 448 480 451.6 480 456C480 469.3 469.3 480 456 480C442.7 480 432 469.3 432 456C432 425.1 457.1 400 488 400C518.9 400 544 425.1 544 456L544 584C544 597.3 533.3 608 520 608C506.7 608 496 597.3 496 584L496 456C496 451.6 492.4 448 488 448z"/></svg>

<?php break; ?>

<?php case ('mini'): ?>
<svg {{ $attributes->class($classes) }} data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M328 32C358.9 32 384 57.1 384 88C384 118.9 358.9 144 328 144C297.1 144 272 118.9 272 88C272 57.1 297.1 32 328 32zM240 300.7L193.7 363.1C183.2 377.3 163.1 380.3 148.9 369.7C134.7 359.1 131.7 339.1 142.3 324.9L212.8 229.9C238 196 277.7 176 320 176C362.3 176 402 196 427.2 229.9L497.7 324.9C508.2 339.1 505.3 359.1 491.1 369.7C476.9 380.3 456.9 377.3 446.3 363.1L400 300.7L400 576C400 593.7 385.7 608 368 608C350.3 608 336 593.7 336 576L336 416C336 407.2 328.8 400 320 400C311.2 400 304 407.2 304 416L304 576C304 593.7 289.7 608 272 608C254.3 608 240 593.7 240 576L240 300.7zM488 448C483.6 448 480 451.6 480 456C480 469.3 469.3 480 456 480C442.7 480 432 469.3 432 456C432 425.1 457.1 400 488 400C518.9 400 544 425.1 544 456L544 584C544 597.3 533.3 608 520 608C506.7 608 496 597.3 496 584L496 456C496 451.6 492.4 448 488 448z"/></svg>

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
