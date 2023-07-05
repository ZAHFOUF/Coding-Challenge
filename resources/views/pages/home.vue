<script setup>

import { MDBInput, MDBTable , MDBBtn , MDBListGroup , MDBListGroupItem  } from 'mdb-vue-ui-kit';
import { onMounted, ref } from "vue";



const url = ref("");
const shorts = ref([]);
const urls = ref([])


// send request for generate short url
function generate (event) {
    axios.post("/api/shorturl",{url:url.value}).then(
        (e)=> { shorts.value.push(e.data)  ; url.value = "" }
    )

}

function getUrls (){
    axios.get("/api/shorturl").then(
        (e)=>  urls.value= e.data.data
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


function dateText(time) {


// Get the current date/time
const now = new Date();

// Create a new date object with the specific date/time
const specificDate = new Date(time);


// Calculate the difference in seconds
const diffSeconds = Math.floor((now - specificDate ) / 1000);


// Calculate the difference in minutes
const diffMin = Math.floor( (now - specificDate) / (1000 * 60) )

// Calculate the difference in hours
const diffHours = Math.floor(diffMin / 60);


console.log(diffSeconds,diffMin,diffHours);

// return the right text
if (diffHours > 0) {
    return `${diffHours} hour ago`
}else if (diffMin > 0) {
    return `${diffMin} min ago`
}else if (diffSeconds > 0) {
    return `${diffSeconds} sec ago`
}else{
    return `now`
}





}


// when the componenet mounted

onMounted(()=> getUrls())




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



<div  style="margin-top: 100px; margin-bottom: 40px;" >
    <h2 class="text-center" style="margin-bottom: 32px;">list of previously shortened URLs</h2>
    <MDBTable  class="align-middle mb-0 bg-white">
    <thead class="bg-light">
      <tr>
        <th>Id</th>
        <th>Link</th>
        <th>Clicks</th>
        <th>Last Click</th>
      </tr>
    </thead>
    <tbody v-for="item in urls">
        <tr>
            <td>{{ item.id }}</td>
            <td>{{ item.short_url }}</td>
            <td>{{ item.clicks }}</td>
            <td>{{ dateText( item.lastclick ) }}</td>
        </tr>


    </tbody>
    </MDBTable>


</div>




</div>







</template>
