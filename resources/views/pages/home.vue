<script setup>

import { MDBInput, MDBBtn , MDBListGroup , MDBListGroupItem  } from 'mdb-vue-ui-kit';
import { ref } from "vue";



const url = ref("");
const shorts = ref([]);


// send request for generate short url
function generate (event) {
    axios.post("/api/shorturl",{url:url.value}).then(
        (e)=> shorts.value.push(e.data)
    )

}

// copy the short url
function copy (text,element) {

    const textarea = document.createElement('textarea');
    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    textarea.remove()

    // change the text of the buuton
    element.srcElement.innerText = "copied ✔️"
    // reback the the text to button
    setTimeout(()=>element.srcElement.innerText = "copy" ,5000 )



}





</script>



<template >




    <div style="width: 55%" >



        <MDBInput

    inputGroup
    :formOutline="false"
    wrapperClass="mb-3"
    v-model="url"
    placeholder="URL"
    aria-label="Recipient's username"
    aria-describedby="button-addon2"
  >
    <MDBBtn @click="generate" color="primary" :ripple="{ color: 'dark' }">
        Shorten URL
    </MDBBtn>

    </MDBInput>




    </div>


    <div style="width: 55%;" >

        <MDBListGroup light style="min-width: 22rem" v-for="item in shorts">
  <MDBListGroupItem style="margin-bottom: 15px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;"
    class="d-flex justify-content-between align-items-center"
  >
  <div style="justify-content: space-between; width: 100%;  padding: 0 26px;" class="d-flex align-items-center">


    <span>{{ item.short }}</span>

    <button @click="(e)=> copy(item.short,e) " class="btn btn-link btn-rounded btn-sm"  role="button"
      > copy </button
    >

  </div>

  </MDBListGroupItem>
  </MDBListGroup>


</div>







</template>
