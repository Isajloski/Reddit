<template>
    <div class="dropdown p-2 bg-[#141414] text-center text-white rounded inline-block cursor-pointer">
        <div @click="toggleDropdown">
            <slot class="inline-block"></slot>
            <UserIcon class="mr-2 w-7 inline-block" v-if="this.navbar"/>
            <button type="button" class="dropdown-button">
                {{ selectedOption || placeholder }}
            </button>
            <AngleDownIcon class="ml-3 inline-block"/>
        </div>
        <ul v-if="isOpen" class="dropdown-list">
            <li v-for="{id, name} in options" :key="id" @click="selectOption({id, name})" class="text-start cursor-pointer py-2">
                {{ name }}
            </li>
        </ul>
    </div>
</template>

<script>
import AngleDownIcon from "@/Components/Icons/AngleDownIcon.vue";
import UserIcon from "@/Components/Icons/UserIcon.vue";
export default {
    components: {AngleDownIcon, UserIcon},
    props: {
        options: {
            type: Array,
        },
        navbar: Boolean,
        placeholder: {
            type: String,
            default: 'Select an option',
        },
    },
    data() {
        return {
            isOpen: false,
            selectedOption: null,
        };
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        selectOption({id, name}) {
            this.selectedOption = name;
            this.isOpen = false;
            this.$emit('option-selected', id);
        },

    },
};
</script>
