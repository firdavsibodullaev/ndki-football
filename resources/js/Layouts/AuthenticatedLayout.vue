<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    Bars3Icon,
    BellIcon,
    XMarkIcon,
    ChevronLeftIcon,
} from "@heroicons/vue/24/outline";
import { route } from "@/utils/routes.js";
import DefaultUser from "@/Components/DefaultUser.vue";
import navigation from "@/utils/navigation.js";

const { props } = usePage();
const user = props.auth.user;
const userNavigation = [route("admin.profile.edit"), route("logout")];

const showingNavigationDropdown = ref(false);
const showingUserNavigationDropdown = ref(false);

function toggleCollapse(target, event) {
    const element = document.querySelector(target);
    const activeElement = event.target;
    const icon =
        activeElement.tagName === "BUTTON"
            ? activeElement.querySelector(".chevron-icon")
            : activeElement.tagName === "SPAN"
            ? activeElement.nextElementSibling
            : activeElement.tagName === "path"
            ? activeElement.parentElement
            : activeElement;

    element.classList.toggle("h-full");
    element.classList.toggle("h-0");
    icon.classList.toggle("-rotate-90");
}
</script>

<template>
    <div class="min-h-full">
        <div class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <ApplicationLogo
                                class="block h-9 w-auto fill-current text-gray-300"
                            />
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <button
                                type="button"
                                class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            >
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="h-6 w-6" aria-hidden="true" />
                            </button>

                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative ml-3">
                                <div>
                                    <MenuButton
                                        class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    >
                                        <span class="sr-only"
                                            >Open user menu</span
                                        >
                                        <DefaultUser
                                            v-if="!user.avatar"
                                            class="h-8 w-8 rounded-fill fill-current"
                                        />
                                        <img
                                            v-else
                                            class="h-8 w-8 rounded-full"
                                            :src="user.avatar"
                                            alt=""
                                        />
                                    </MenuButton>
                                </div>
                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <MenuItem
                                            v-for="item in userNavigation"
                                            :key="item.name"
                                            v-slot="{ active }"
                                        >
                                            <Link
                                                :href="item.path"
                                                :as="
                                                    item.method === 'post'
                                                        ? 'button'
                                                        : 'a'
                                                "
                                                :method="item.method ?? 'get'"
                                                :class="[
                                                    active ? 'bg-gray-100' : '',
                                                    'block px-4 py-2 text-sm text-gray-700',
                                                ]"
                                            >
                                                {{ item.text }}
                                            </Link>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <div
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon
                                v-if="!showingNavigationDropdown"
                                class="block h-6 w-6"
                                aria-hidden="true"
                            />
                            <XMarkIcon
                                v-else
                                class="block h-6 w-6"
                                aria-hidden="true"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="md:hidden overflow-hidden"
                :class="{
                    'h-0': !showingNavigationDropdown,
                    'h-full': showingNavigationDropdown,
                }"
            >
                <div class="border-b border-gray-700 pb-3 pt-4">
                    <div class="flex items-center px-5">
                        <div
                            class="flex items-center w-full"
                            @click="
                                showingUserNavigationDropdown =
                                    !showingUserNavigationDropdown
                            "
                        >
                            <div class="flex-shrink-0">
                                <DefaultUser
                                    v-if="!user.avatar"
                                    class="h-10 w-10 rounded-full fill-current"
                                />
                                <img
                                    v-else
                                    class="h-10 w-10 rounded-full"
                                    :src="user.avatar"
                                    alt=""
                                />
                            </div>
                            <div class="ml-3">
                                <div
                                    class="text-base font-medium leading-none text-white"
                                >
                                    {{ user.name }}
                                </div>
                                <div
                                    class="text-sm font-medium leading-none text-gray-400"
                                >
                                    {{ user.username }}
                                </div>
                            </div>
                        </div>
                        <button
                            type="button"
                            class="ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div
                        :class="{ hidden: !showingUserNavigationDropdown }"
                        class="mt-3 space-y-1 px-2"
                    >
                        <Link
                            v-for="item in userNavigation"
                            :key="item.name"
                            :method="item.method"
                            :href="item.path"
                            :as="item.method === 'post' ? 'button' : 'a'"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                        >
                            {{ item.text }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row">
            <div class="sidebar">
                <div
                    :class="{
                        'h-0': !showingNavigationDropdown,
                        'h-[100vh]': showingNavigationDropdown,
                    }"
                    class="w-full md:w-96 bg-gray-800 md:h-[100vh] overflow-y-hidden"
                >
                    <div class="space-y-1 px-2 pb-3 pt-8 sm:px-3">
                        <div v-for="(item, key) in navigation" :key="item.name">
                            <Link
                                v-if="!item.children"
                                :href="item.path"
                                class="block rounded-md px-3 my-2 py-2 text-base font-medium active:bg-gray-600"
                                :class="{
                                    'bg-gray-900 text-white': item.current,
                                    'text-gray-300 hover:bg-gray-700 hover:text-white':
                                        !item.current,
                                }"
                                :aria-current="
                                    item.current ? 'page' : undefined
                                "
                                >{{ item.text }}
                            </Link>
                            <ul v-else>
                                <li>
                                    <button
                                        @click="
                                            toggleCollapse(
                                                '#dropdown-' + key,
                                                $event
                                            )
                                        "
                                        class="block w-full rounded-md mt-2 px-3 py-2 relative text-left active:bg-gray-600"
                                        :class="{
                                            'bg-gray-900 text-white':
                                                item.current,
                                            'text-gray-300 hover:bg-gray-700 hover:text-white':
                                                !item.current,
                                        }"
                                    >
                                        <span
                                            class="w-full text-base font-medium"
                                        >
                                            {{ item.text }}
                                        </span>
                                        <ChevronLeftIcon
                                            class="block h-6 w-6 absolute top-2 right-1 chevron-icon"
                                            aria-hidden="true"
                                        />
                                    </button>
                                    <ul
                                        :id="'dropdown-' + key"
                                        class="rounded-b-md overflow-y-hidden h-0"
                                        :class="{
                                            'bg-gray-900 text-white':
                                                item.current,
                                            'text-gray-300 hover:bg-gray-700 hover:text-white':
                                                !item.current,
                                        }"
                                    >
                                        <li
                                            class="border-t border-gray-800 px-7 py-2"
                                            v-for="child in item.children"
                                            :key="item.name + child.name"
                                        >
                                            <Link :href="child.path"
                                                >{{ child.text }}
                                            </Link>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block flex-auto">
                <header class="bg-white shadow">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>
                <main>
                    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                        <slot />
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<!--<template>-->
<!--    <div>-->
<!--        <div class="min-h-screen bg-gray-100">-->
<!--            <nav class="bg-white border-b border-gray-100">-->
<!--                &lt;!&ndash; Primary Navigation Menu &ndash;&gt;-->
<!--                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">-->
<!--                    <div class="flex justify-between h-16">-->
<!--                        <div class="flex">-->
<!--                            &lt;!&ndash; Logo &ndash;&gt;-->
<!--                            <div class="shrink-0 flex items-center">-->
<!--                                <Link :href="route('admin.index')">-->
<!--                                    <ApplicationLogo-->
<!--                                        class="block h-9 w-auto fill-current text-gray-800"-->
<!--                                    />-->
<!--                                </Link>-->
<!--                            </div>-->

<!--                            &lt;!&ndash; Navigation Links &ndash;&gt;-->
<!--                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">-->
<!--                                <NavLink :href="route('admin.index')" :active="route().current('admin')">-->
<!--                                    Dashboard-->
<!--                                </NavLink>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="hidden sm:flex sm:items-center sm:ml-6">-->
<!--                            &lt;!&ndash; Settings Dropdown &ndash;&gt;-->
<!--                            <div class="ml-3 relative">-->
<!--                                <Dropdown align="right" width="48">-->
<!--                                    <template #trigger>-->
<!--                                        <span class="inline-flex rounded-md">-->
<!--                                            <button-->
<!--                                                type="button"-->
<!--                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"-->
<!--                                            >-->
<!--                                                {{ $page.props.auth.user.name }}-->

<!--                                                <svg-->
<!--                                                    class="ml-2 -mr-0.5 h-4 w-4"-->
<!--                                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                                    viewBox="0 0 20 20"-->
<!--                                                    fill="currentColor"-->
<!--                                                >-->
<!--                                                    <path-->
<!--                                                        fill-rule="evenodd"-->
<!--                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"-->
<!--                                                        clip-rule="evenodd"-->
<!--                                                    />-->
<!--                                                </svg>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                                    </template>-->

<!--                                    <template #content>-->
<!--                                        <DropdownLink :href="route('admin.profile.edit')"> Profile </DropdownLink>-->
<!--                                        <DropdownLink :href="route('logout')" method="post" as="button">-->
<!--                                            Log Out-->
<!--                                        </DropdownLink>-->
<!--                                    </template>-->
<!--                                </Dropdown>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        &lt;!&ndash; Hamburger &ndash;&gt;-->
<!--                        <div class="-mr-2 flex items-center sm:hidden">-->
<!--                            <button-->
<!--                                @click="showingNavigationDropdown = !showingNavigationDropdown"-->
<!--                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"-->
<!--                            >-->
<!--                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">-->
<!--                                    <path-->
<!--                                        :class="{-->
<!--                                            hidden: showingNavigationDropdown,-->
<!--                                            'inline-flex': !showingNavigationDropdown,-->
<!--                                        }"-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        stroke-width="2"-->
<!--                                        d="M4 6h16M4 12h16M4 18h16"-->
<!--                                    />-->
<!--                                    <path-->
<!--                                        :class="{-->
<!--                                            hidden: !showingNavigationDropdown,-->
<!--                                            'inline-flex': showingNavigationDropdown,-->
<!--                                        }"-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        stroke-width="2"-->
<!--                                        d="M6 18L18 6M6 6l12 12"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash; Responsive Navigation Menu &ndash;&gt;-->
<!--                <div-->
<!--                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"-->
<!--                    class="sm:hidden"-->
<!--                >-->
<!--                    <div class="pt-2 pb-3 space-y-1">-->
<!--                        <ResponsiveNavLink :href="route('admin.index')" :active="route().current('admin')">-->
<!--                            Dashboard-->
<!--                        </ResponsiveNavLink>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Responsive Settings Options &ndash;&gt;-->
<!--                    <div class="pt-4 pb-1 border-t border-gray-200">-->
<!--                        <div class="px-4">-->
<!--                            <div class="font-medium text-base text-gray-800">-->
<!--                                {{ $page.props.auth.user.name }}-->
<!--                            </div>-->
<!--                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>-->
<!--                        </div>-->

<!--                        <div class="mt-3 space-y-1">-->
<!--                            <ResponsiveNavLink :href="route('admin.profile.edit')"> Profile </ResponsiveNavLink>-->
<!--                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">-->
<!--                                Log Out-->
<!--                            </ResponsiveNavLink>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </nav>-->

<!--            &lt;!&ndash; Page Heading &ndash;&gt;-->
<!--            <header class="bg-white shadow" v-if="$slots.header">-->
<!--                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">-->
<!--                    <slot name="header" />-->
<!--                </div>-->
<!--            </header>-->

<!--            &lt;!&ndash; Page Content &ndash;&gt;-->
<!--            <main>-->
<!--                <slot />-->
<!--            </main>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->
