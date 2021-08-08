<template>
    <div class="relative flex-grow">
        <label>
            <input v-model="message" @keydown.enter="send"
                   class="rounded-full py-2 pl-3 pr-10 w-full border border-gray-800 focus:border-gray-700 bg-gray-800 focus:bg-gray-900 focus:outline-none text-gray-200 focus:shadow-md transition duration-300 ease-in"
                   type="text"  placeholder="Message..." />
        </label>
    </div>
</template>

<script>
export default {
    name: "MessageComposer",
    data(){
        return {
            message: ''
        }
    },
    methods:{
        send(e){
            e.preventDefault();
            if(this.message == '')
            {
                return;
            }
            this.$emit('send', this.message);
            this.message = '';
        }
    }
}
</script>

<style scoped>

</style>
