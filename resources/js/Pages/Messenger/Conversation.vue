<template>
    <section class="flex flex-col flex-auto border-l border-gray-800">
        <div class="chat-header px-6 py-4 flex flex-row flex-none justify-between items-center shadow">
            <div class="flex">
                <div class="text-sm">
                    <p class="font-bold">{{conversation ? conversation.participant.name : 'Select a contact'}}</p>
                </div>
            </div>
        </div>
        <div class="chat-body p-4 flex-1 overflow-y-scroll">

            <MessageList :conversation="conversation" :messages="messages"/>

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
        conversation:{
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
            if(!this.conversation)
            {
                return;
            }
            axios.post(route('conversations.send.message'),{
                withId: this.conversation.id,
                message: text
            })
                .then((response)=>{
                    // console.log(response)
                    this.$emit('new', response.data.message)
                })
        }
    },
    components: {MessageComposer,MessageList}
}

</script>

<style scoped>

</style>
