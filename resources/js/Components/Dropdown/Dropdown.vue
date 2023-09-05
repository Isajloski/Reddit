<template>
    <div class="dropdown rounded bg-[#515151] text-white p-2 inline-block">
        <button type="button" @click="toggleDropdown" class="dropdown-button">
            {{ selectedOption || placeholder }}
        </button>
        <ul v-if="isOpen" class="dropdown-list">
            <li v-for="{id, name} in options" :key="id" @click="selectOption({id, name})" class="cursor-pointer">
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
