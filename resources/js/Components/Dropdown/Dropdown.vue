<template>
    <div class="dropdown p-2 bg-[#2D2D2D] text-center text-white rounded inline-block">
        <slot class="inline-block"></slot>
        <button type="button" @click="toggleDropdown" class="dropdown-button">
            {{ selectedOption || placeholder }}
        </button>
        <AngleDownIcon class="ml-3 inline-block"/>
        <ul v-if="isOpen" class="dropdown-list">
            <li v-for="{id, name} in options" :key="id" @click="selectOption({id, name})" class="text-start cursor-pointer py-2">
                {{ name }}
            </li>
        </ul>
    </div>
</template>

<script>
import AngleDownIcon from "@/Components/Icons/AngleDownIcon.vue";
export default {
    components: {AngleDownIcon},
    props: {
        options: {
            type: Array,
            required: true
        },
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
