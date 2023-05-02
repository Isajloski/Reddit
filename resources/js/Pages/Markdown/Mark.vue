<script>
import { marked } from 'marked';
console.log(marked.parse("# This was mistaken x"));

</script>


<template>
    <nav class="bg-gray-200 h-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Navbar -->

            <div class="flex items-center h-5">
                <div class="flex-shrink-0">
                    <!-- Your logo here -->
                    <img class="h-5 w-auto" src="https://cdn-icons-png.flaticon.com/512/1313/1313649.png" alt="Logo">
                </div>
                <div class="flex">
                    <!-- Search -->
                    <input class=" nav-item rounded-md h-5 w-auto">

                    <button class="button">Log in</button>
                    <button class="button">Register</button>


                    <!-- Your other navbar items here -->
                </div>
            </div>
        </div>
    </nav>

</template>

<style>

</style>
