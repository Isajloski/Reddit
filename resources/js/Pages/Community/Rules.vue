<template>
    <div class="inline-block bg-[#2D2D2D] px-5 lg:px-10 py-5 rounded-2xl">
        <div class="text-lg text-white pb-3">Rules</div>
        <div class="text-xs lg:text-sm text-white line-clamp-6 lg:line-clamp-none">
            {{rules}}
        </div>
    </div>
</template>

<script>
export default {
    name: "Rules",
    props: {
        rules: String
    }
}
</script>

<style scoped>

</style>
