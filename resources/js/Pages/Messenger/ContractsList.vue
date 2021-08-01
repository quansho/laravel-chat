<template>
    <div v-for="(contact,index) in contacts"
         :key="contact.id"
         :class="`flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative ${index == selected ? 'bg-gray-800' : ''}`"
         @click="selectContact(contact.id, contact)"
    >
        <div class="w-16 h-16 relative flex flex-shrink-0">
            <img class="shadow-md rounded-full w-full h-full object-cover"
                 :src="contact.profile_photo_url"
                 alt=""
            />
        </div>
        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
            <p>{{ contact.name }}</p>
            <div class="flex items-center text-sm text-gray-600">
                <div class="min-w-0">
                    <p class="truncate">Ok, see you at the subway in a bit.</p>
                </div>
                <p class="ml-2 whitespace-no-wrap">Just now</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ContractsList",
    props: {
        contacts: {
            type: Array,
            default: []
        }
    },
    data()
    {
        return {
            selected: 0
        }
    },
    methods: {
        selectContact(index, contact){
            this.selected = index;
            this.$emit('selected', contact)
        }
    }
}
</script>

<style scoped>

</style>
