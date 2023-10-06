<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link :href="'/'">
        <div class="justify-between flex-col items-center flex">
            <img style="width: 80px; margin-top: 10px;" src="https://lazytradernetwork.com/logo.png" alt="Lazy Trader">
            <h4 class="font-bold ml-4 text-black text-xl">
                The Lazy Trader Network
            </h4>
        </div>
    </Link>
</template>
