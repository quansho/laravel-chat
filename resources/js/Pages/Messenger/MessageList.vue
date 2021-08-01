<template>
    <div ref="messageList">
    <div v-for="message in messages" :key="message.id" :class="`flex flex-row ${message.user_id != contact.id ? 'justify-end' : 'justify-start'}`">
        <div class="w-8 h-8 relative flex flex-shrink-0 mr-4">
            <img class="shadow-md rounded-full w-full h-full object-cover"
                 src="https://randomuser.me/api/portraits/women/33.jpg"
                 alt=""
            />
        </div>
        <div class="messages text-sm text-gray-700 grid grid-flow-row gap-2">
            <div class="flex items-center group">
                <p class="px-6 py-3 rounded-b-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">
                   {{message.message}}</p>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    name: "MessageList",
    props:{
        contact:{
            type:Object,
        },
        messages:{
            type:Array,
            required:true
        }
    },
    methods:{
        scrollToBottom()
        {
            setTimeout(()=>{
                this.$refs.messageList.scrollTop = this.$refs.messageList.scrollHeight - this.$refs.messageList.clientHeight;
            },50);

        }
    },
    watch:{
        contact(contact){
            this.scrollToBottom();
        },
        messages(messages){
            this.scrollToBottom();
        }
    }
}
</script>

<style scoped>

</style>
