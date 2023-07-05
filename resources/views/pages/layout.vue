<script setup>
import 'mdb-vue-ui-kit/css/mdb.min.css';
import {MDBContainer} from 'mdb-vue-ui-kit';
</script>

<template>

    <div class="p-5">

        <h1 class="text-center text-dark">
          URL Shortener
    </h1>

    </div>



    <MDBContainer style="display: grid; place-items: center;">

        <router-view>

</router-view>


</MDBContainer>




</template>
