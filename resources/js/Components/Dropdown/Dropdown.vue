<template>
    <div class="dropdown rounded bg-[#515151] text-white p-2 inline-block">
        <button @click="toggleDropdown" class="dropdown-button">
            {{ selectedOption || placeholder }}
        </button>
        <ul v-if="isOpen" class="dropdown-list">
            <li v-for="{id, name} in options" :key="id" @click="selectOption(id)" class="cursor-pointer">
                {{ name }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
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
            // options: ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
        };
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        selectOption(option) {
            this.selectedOption = option;
            this.isOpen = false;
            this.$emit('option-selected', option);
        },

    },
};
</script>
