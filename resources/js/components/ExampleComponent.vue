<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>

          <div class="card-body">
            <ul>
              <li v-for="(item, index) in authorJson" :key="index">
                {{
                  "No: " + item.no + " Name: " + item.name + " Age: " + item.age
                }}
              </li>
            </ul>

            <div class="card" style="width: 18rem">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <div class="card-footer">{{ footer }}</div>
        </div>
      </div>
    </div>
    <ModalComponent></ModalComponent>
  </div>
</template>

<script>
import ModalComponent from "./Modal/ModalComponent";
export default {
  props: {
    footer: {
      type: String,
    },
    author: {
      type: String,
    },
    api: {
      type: String,
      default: "",
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {
    this.$http.get("").then((response) => {
      console.log(response.data);
    });
  },
  computed: {
    authorJson() {
      return JSON.parse(this.author);
    },
  },
  components: {
    ModalComponent,
  },
};
</script>
