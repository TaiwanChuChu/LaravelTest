<template>
  <div class="container">
    <ul>
      <li v-for="(item, index) in activity" :key="index">
        活動名稱: {{ item.activity_name }}
      </li>
    </ul>
    <Modal></Modal>
  </div>
</template>
<script>
import Modal from "../Modal/ModalComponent";
export default {
  data() {
    return {
      activity: "",
    };
  },
  created() {
    console.log("Activity created!");
    this.$http
      .get("/api/v1/activity")
      .then((response) => {
        console.log(response.data);
        this.activity = response.data;
      })
      .catch((error) => {
        console.log(error.response);
        if (error.response.status == 400) {
          alert("請求發生錯誤!");
        }
      });
  },
  components: {
    Modal,
  },
};
</script>