<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
        </flux:navlist>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Administrator')" class="grid">
                    @can('isAdmin')
                    <flux:navlist.group heading="Administrator" expandable>
                        <flux:navlist.item icon="user" :href="route('admin.kelola-admin')"
                            :current="request()->routeIs('admin.kelola-admin')" wire:navigate>{{ __('Admin') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="user" :href="route('admin.kelola-kader')"
                            :current="request()->routeIs('admin.kelola-kader')" wire:navigate>{{ __('Kader') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="user" :href="route('admin.kelola-pemdes')"
                            :current="request()->routeIs('admin.kelola-pemdes')" wire:navigate>{{ __('Pemdes') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="user" :href="route('admin.kelola-user')"
                            :current="request()->routeIs('admin.kelola-user')" wire:navigate>{{ __('Pengguna') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                    @endcan
                    @can('isAdminBidanKader')
                        <flux:navlist.group heading="Pemeriksaan" expandable>
                            <flux:navlist.item icon="newspaper" :href="route('pemeriksaan.bumil')"
                                :current="request()->routeIs('pemeriksaan.bumil')" wire:navigate>{{ __('Ibu Hamil') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="newspaper" :href="route('pemeriksaan.anak')"
                                :current="request()->routeIs('pemeriksaan.anak')" wire:navigate>{{ __('Anak') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endcan
                    <flux:navlist.item icon="newspaper" :href="route('view.laporan-kegiatan')"
                        :current="request()->routeIs('view.laporan-kegiatan')" wire:navigate>{{ __('Inf. Kegiatan') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="book-open" :href="route('view.edukasi')"
                        :current="request()->routeIs('view.edukasi')" wire:navigate>{{ __('Edukasi') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>
        @can('isPemdes')
            <flux:navlist.group :heading="__('Data')" class="grid">
                <flux:navlist.item icon="newspaper" :href="route('pemdes.laporan-kegiatan')"
                    :current="request()->routeIs('pemdes.laporan-kegiatan')" wire:navigate>{{ __('Inf. Kegiatan') }}
                </flux:navlist.item>
            </flux:navlist.group>
        @endcan
        <flux:spacer />

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
