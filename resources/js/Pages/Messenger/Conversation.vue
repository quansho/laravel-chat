<template>
    <section class="flex flex-col flex-auto border-l border-gray-800">
        <div class="chat-header px-6 py-4 flex flex-row flex-none justify-between items-center shadow">
            <div class="flex">
                <div class="w-12 h-12 mr-4 relative flex flex-shrink-0">
                    <img class="shadow-md rounded-full w-full h-full object-cover"
                         src="https://randomuser.me/api/portraits/women/33.jpg"
                         alt=""
                    />
                </div>
                <div class="text-sm">
                    <p class="font-bold">{{contact ? contact.name : 'Select a contact'}}</p>
                </div>
            </div>


        </div>
        <div class="chat-body p-4 flex-1 overflow-y-scroll">

            <MessageList :contact="contact" :messages="messages"/>


        </div>
        <div class="chat-footer flex-none">
            <div class="flex flex-row items-center p-4">

                <MessageComposer @send="sendMessage"/>

            </div>
        </div>
    </section>
</template>

<script>

import MessageList from "./MessageList";
import MessageComposer from "./MessageComposer";

export default {
    name: "Conversation",
    props: {
        contact:{
            type: Object,
            default: null
        },
        messages: {
            type: Array,
            default: []
        }
    },methods:{
        sendMessage(text)
        {
            if(!this.contact)
            {
                return;
            }
            axios.post('/conversations/send',{
                contact_id: this.contact.id,
                text: text
            })
                .then((response)=>{
                    this.$emit('new', response.data)
                })
        }
    },
    components: {MessageComposer,MessageList}
}

</script>

<style scoped>

</style>
