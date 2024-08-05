<template>
    <div>
        <div v-for="event in events" :class="{'info': event.name === 'ping', 'success': event.name === 'push'}">
            <span>{{ event.name }}</span>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const events = ref([])

const eventSource = new EventSource('http://localhost/.well-known/mercure?topic=test');
eventSource.onmessage = event => {
    // Will be called every time an update is published by the server
    events.value.push(JSON.parse(event.data))
    console.log(JSON.parse(event.data));
}
</script>

<style>
.success {
    border-radius: 5px;
    width: 220px;
    height: 30px;
    text-align: left;
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #2B3246;
    cursor:pointer;
    box-shadow:  9px 9px 18px #262c3e,
    -9px -9px 18px #30384e;
    color: #0ad406;
    margin: 20px;
}

.info {
    border-radius: 5px;
    width: 220px;
    height: 30px;
    text-align: left;
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #2B3246;
    cursor:pointer;
    box-shadow:  9px 9px 18px #262c3e,
    -9px -9px 18px #30384e;
    color: rgb(82, 125, 243);
    margin: 20px;
}

.danger {
    border-radius: 5px;
    width: 220px;
    height: 30px;
    text-align: left;
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #2B3246;
    cursor:pointer;
    box-shadow:  9px 9px 18px #262c3e,
    -9px -9px 18px #30384e;
    color: rgb(255, 10, 1);
    margin: 20px;
}
</style>
